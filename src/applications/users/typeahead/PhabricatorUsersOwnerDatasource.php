<?php

final class PhabricatorUsersOwnerDatasource
  extends PhabricatorTypeaheadCompositeDatasource {

  public function getBrowseTitle() {
    return pht('Browse Owners');
  }

  public function getPlaceholderText() {
    return pht('Type a username or function...');
  }

  public function getComponentDatasources() {
    return array(
      new PhabricatorViewerDatasource(),
      new PhabricatorUsersNoOwnerDatasource(),
      new PhabricatorUsersAnyOwnerDatasource(),
      new PhabricatorUsersDatasource(),
      new PhabricatorProjectMembersDatasource(),
    );
  }

}
