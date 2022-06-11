<?php

final class UserSearchConduitAPIMethod
  extends PhabricatorSearchEngineAPIMethod {

  public function getAPIMethodName() {
    return 'user.search';
  }

  public function newSearchEngine() {
    return new PhabricatorUsersSearchEngine();
  }

  public function getMethodSummary() {
    return pht('Read information about users.');
  }

}
