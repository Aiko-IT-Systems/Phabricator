<?php

abstract class PhabricatorUsersInviteController
  extends PhabricatorUsersController {

  protected function buildApplicationCrumbs() {
    $crumbs = parent::buildApplicationCrumbs();
    $crumbs->addTextCrumb(
      pht('Invites'),
      $this->getApplicationURI('invite/'));
    return $crumbs;
  }

}
