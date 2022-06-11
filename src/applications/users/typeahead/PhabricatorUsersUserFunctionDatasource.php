<?php

final class PhabricatorUsersUserFunctionDatasource
  extends PhabricatorTypeaheadCompositeDatasource {

  public function getBrowseTitle() {
    return pht('Browse Users');
  }

  public function getPlaceholderText() {
    return pht('Type a username or function...');
  }

  public function getComponentDatasources() {
    $sources = array(
      new PhabricatorViewerDatasource(),
      new PhabricatorUsersDatasource(),
      new PhabricatorProjectMembersDatasource(),
    );

    return $sources;
  }

}
