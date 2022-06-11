<?php

abstract class PhabricatorUsersController extends PhabricatorController {

  public function shouldRequireAdmin() {
    return true;
  }

  public function buildSideNavView($for_app = false) {
    $nav = new AphrontSideNavFilterView();
    $nav->setBaseURI(new PhutilURI($this->getApplicationURI()));

    $name = null;
    if ($for_app) {
      $name = $this->getRequest()->getURIData('username');
      if ($name) {
        $nav->setBaseURI(new PhutilURI('/p/'));
        $nav->addFilter("{$name}/", $name);
        $nav->addFilter("{$name}/calendar/", pht('Calendar'));
      }
    }

    if (!$name) {
      $viewer = $this->getRequest()->getUser();
      id(new PhabricatorUsersSearchEngine())
        ->setViewer($viewer)
        ->addNavigationItems($nav->getMenu());

      if ($viewer->getIsAdmin()) {
        $nav->addLabel(pht('User Administration'));
        $nav->addFilter('logs', pht('Activity Logs'));
        $nav->addFilter('invite', pht('Email Invitations'));
      }
    }

    return $nav;
  }

  public function buildApplicationMenu() {
    return $this->buildSideNavView(true)->getMenu();
  }

}
