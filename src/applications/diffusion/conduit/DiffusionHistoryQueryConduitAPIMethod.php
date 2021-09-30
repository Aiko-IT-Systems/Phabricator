<?php

final class DiffusionHistoryQueryConduitAPIMethod
  extends DiffusionQueryConduitAPIMethod {

  private $parents = array();

  public function getAPIMethodName() {
    return 'diffusion.historyquery';
  }

  public function getMethodDescription() {
    return pht(
      'Returns history information for a repository at a specific '.
      'commit and path.');
  }

  protected function defineReturnType() {
    return 'array';
  }

  protected function defineCustomParamTypes() {
    return array(
      'commit' => 'required string',
      'against' => 'optional string',
      'path' => 'required string',
      'offset' => 'required int',
      'limit' => 'required int',
      'needDirectChanges' => 'optional bool',
      'needChildChanges' => 'optional bool',
    );
  }

  protected function getResult(ConduitAPIRequest $request) {
    $path_changes = parent::getResult($request);

    return array(
      'pathChanges' => mpull($path_changes, 'toDictionary'),
      'parents' => $this->parents,
    );
  }

  protected function getGitResult(ConduitAPIRequest $request) {
    $drequest = $this->getDiffusionRequest();
    $repository = $drequest->getRepository();
    $commit_hash = $request->getValue('commit');
    $against_hash = $request->getValue('against');

    $path = $request->getValue('path');
    if (!strlen($path)) {
      $path = null;
    }

    $offset = $request->getValue('offset');
    $limit = $request->getValue('limit');

    if (strlen($against_hash)) {
      $commit_range = "${against_hash}..${commit_hash}";
    } else {
      $commit_range = $commit_hash;
    }

    $argv = array();

    $argv[] = '--skip';
    $argv[] = $offset;

    $argv[] = '--max-count';
    $argv[] = $limit;

    $argv[] = '--format=%H:%P';

    $argv[] = gitsprintf('%s', $commit_range);

    $argv[] = '--';

    if ($path !== null) {
      $argv[] = $path;
    }

    list($stdout) = $repository->execxLocalCommand(
      'log %Ls',
      $argv);

    $lines = explode("\n", trim($stdout));
    $lines = array_filter($lines);

    $hash_list = array();
    $parent_map = array();
    foreach ($lines as $line) {
      list($hash, $parents) = explode(':', $line);
      $hash_list[] = $hash;
      $parent_map[$hash] = preg_split('/\s+/', $parents);
    }

    $this->parents = $parent_map;

    if (!$hash_list) {
      return array();
    }

    return DiffusionQuery::loadHistoryForCommitIdentifiers(
      $hash_list,
      $drequest);
  }

  protected function getMercurialResult(ConduitAPIRequest $request) {
    $drequest = $this->getDiffusionRequest();
    $repository = $drequest->getRepository();
    $commit_hash = $request->getValue('commit');
    $path = $request->getValue('path');
    $offset = $request->getValue('offset');
    $limit = $request->getValue('limit');

    $path = DiffusionPathIDQuery::normalizePath($path);
    $path = ltrim($path, '/');

    // NOTE: Older versions of Mercurial give different results for these
    // commands (see T1268):
    //
    //   $ hg log -- ''
    //   $ hg log
    //
    // All versions of Mercurial give different results for these commands
    // (merge commits are excluded with the "." version):
    //
    //   $ hg log -- .
    //   $ hg log
    //
    // If we don't have a path component in the query, omit it from the command
    // entirely to avoid these inconsistencies.

    // NOTE: When viewing the history of a file, we don't use "-b", because
    // Mercurial stops history at the branchpoint but we're interested in all
    // ancestors. When viewing history of a branch, we do use "-b", and thus
    // stop history (this is more consistent with the Mercurial worldview of
    // branches).

    $path_args = array();
    if (strlen($path)) {
      $path_args[] = $path;
      $revset_arg = hgsprintf(
        'reverse(ancestors(%s))',
        $commit_hash);
    } else {
      $revset_arg = hgsprintf(
        'reverse(ancestors(%s)) and branch(%s)',
        $commit_hash,
        $drequest->getBranch());
    }

    $hg_analyzer = PhutilBinaryAnalyzer::getForBinary('hg');
    if ($hg_analyzer->isMercurialTemplatePnodeAvailable()) {
      $hg_log_template = '{node} {p1.node} {p2.node}\\n';
    } else {
      $hg_log_template = '{node} {p1node} {p2node}\\n';
    }

    list($stdout) = $repository->execxLocalCommand(
      'log --template %s --limit %d --rev %s -- %Ls',
      $hg_log_template,
      ($offset + $limit), // No '--skip' in Mercurial.
      $revset_arg,
      $path_args);

    $lines = explode("\n", trim($stdout));
    $lines = array_slice($lines, $offset);

    $hash_list = array();
    $parent_map = array();

    $last = null;
    foreach (array_reverse($lines) as $line) {
      $parts = explode(' ', trim($line));
      $hash = $parts[0];
      $parents = array_slice($parts, 1, 2);
      foreach ($parents as $parent) {
        if (!preg_match('/^0+\z/', $parent)) {
          $parent_map[$hash][] = $parent;
        }
      }
      // This may happen for the zeroth commit in repository, both hashes
      // are "000000000...".
      if (empty($parent_map[$hash])) {
        $parent_map[$hash] = array('...');
      }

      // The rendering code expects the first commit to be "mainline", like
      // Git. Flip the order so it does the right thing.
      $parent_map[$hash] = array_reverse($parent_map[$hash]);

      $hash_list[] = $hash;
      $last = $hash;
    }

    $hash_list = array_reverse($hash_list);
    $this->parents = array_reverse($parent_map, true);

    return DiffusionQuery::loadHistoryForCommitIdentifiers(
      $hash_list,
      $drequest);
  }

  protected function getSVNResult(ConduitAPIRequest $request) {
    $drequest = $this->getDiffusionRequest();
    $repository = $drequest->getRepository();
    $commit = $request->getValue('commit');
    $path = $request->getValue('path');
    $offset = $request->getValue('offset');
    $limit = $request->getValue('limit');
    $need_direct_changes = $request->getValue('needDirectChanges');
    $need_child_changes = $request->getValue('needChildChanges');

    $conn_r = $repository->establishConnection('r');

    $paths = queryfx_all(
      $conn_r,
      'SELECT id, path FROM %T WHERE pathHash IN (%Ls)',
      PhabricatorRepository::TABLE_PATH,
      array(md5('/'.trim($path, '/'))));
    $paths = ipull($paths, 'id', 'path');
    $path_id = idx($paths, '/'.trim($path, '/'));

    if (!$path_id) {
      return array();
    }

    $filter_query = qsprintf($conn_r, '');
    if ($need_direct_changes) {
      if ($need_child_changes) {
        $filter_query = qsprintf(
          $conn_r,
          'AND (isDirect = 1 OR changeType = %s)',
          DifferentialChangeType::TYPE_CHILD);
      } else {
        $filter_query = qsprintf(
          $conn_r,
          'AND (isDirect = 1)');
      }
    }

    $history_data = queryfx_all(
      $conn_r,
      'SELECT * FROM %T WHERE repositoryID = %d AND pathID = %d
        AND commitSequence <= %d
        %Q
        ORDER BY commitSequence DESC
        LIMIT %d, %d',
      PhabricatorRepository::TABLE_PATHCHANGE,
      $repository->getID(),
      $path_id,
      $commit ? $commit : 0x7FFFFFFF,
      $filter_query,
      $offset,
      $limit);

    $commits = array();
    $commit_data = array();

    $commit_ids = ipull($history_data, 'commitID');
    if ($commit_ids) {
      $commits = id(new PhabricatorRepositoryCommit())->loadAllWhere(
        'id IN (%Ld)',
        $commit_ids);
      if ($commits) {
        $commit_data = id(new PhabricatorRepositoryCommitData())->loadAllWhere(
          'commitID in (%Ld)',
          $commit_ids);
        $commit_data = mpull($commit_data, null, 'getCommitID');
      }
    }

    $history = array();
    foreach ($history_data as $row) {
      $item = new DiffusionPathChange();

      $commit = idx($commits, $row['commitID']);
      if ($commit) {
        $item->setCommit($commit);
        $item->setCommitIdentifier($commit->getCommitIdentifier());
        $data = idx($commit_data, $commit->getID());
        if ($data) {
          $item->setCommitData($data);
        }
      }

      $item->setChangeType($row['changeType']);
      $item->setFileType($row['fileType']);

      $history[] = $item;
    }

    return $history;
  }

}
