<?php

final class PhabricatorUsersLogsController
  extends PhabricatorUsersController {

  public function handleRequest(AphrontRequest $request) {
   $controller = id(new PhabricatorApplicationSearchController())
      ->setQueryKey($request->getURIData('queryKey'))
      ->setSearchEngine(new PhabricatorUsersLogSearchEngine())
      ->setNavigation($this->buildSideNavView());

    return $this->delegateToController($controller);
  }

  public function buildSideNavView($for_app = false) {
    $nav = new AphrontSideNavFilterView();
    $nav->setBaseURI(new PhutilURI($this->getApplicationURI()));

    $viewer = $this->getRequest()->getUser();

    id(new PhabricatorUsersLogSearchEngine())
      ->setViewer($viewer)
      ->addNavigationItems($nav->getMenu());

    return $nav;
  }

}
