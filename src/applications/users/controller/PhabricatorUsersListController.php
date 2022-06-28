<?php

final class PhabricatorUsersListController
  extends PhabricatorUsersController {

  public function shouldAllowPublic() {
    return false;
  }

  public function shouldRequireAdmin() {
    return false;
  }

  public function handleRequest(AphrontRequest $request) {
    $this->requireApplicationCapability(
      UsersBrowseUserDirectoryCapability::CAPABILITY);

    $controller = id(new PhabricatorApplicationSearchController())
      ->setQueryKey($request->getURIData('queryKey'))
      ->setSearchEngine(new PhabricatorUsersSearchEngine())
      ->setNavigation($this->buildSideNavView());

    return $this->delegateToController($controller);
  }

  protected function buildApplicationCrumbs() {
    $crumbs = parent::buildApplicationCrumbs();
    $viewer = $this->getRequest()->getUser();

    if ($viewer->getIsAdmin()) {
      $crumbs->addAction(
        id(new PHUIListItemView())
        ->setName(pht('Create New User'))
        ->setHref($this->getApplicationURI('create/'))
        ->setIcon('fa-plus-square'));
    }

    return $crumbs;
  }


}
