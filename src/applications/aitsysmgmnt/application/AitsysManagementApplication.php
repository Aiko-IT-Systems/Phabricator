<?php

final class AitsysManagementApplication extends PhabricatorApplication {

  public function getBaseURI() {
    return '/aitsys-management/';
  }

  public function getShortDescription() {
    return pht('AITSYS Management Console');
  }

  public function getName() {
    return pht('AITSYS Management');
  }

  public function getIcon() {
    return 'fa-desktop';
  }

  public function getTitleGlyph() {
    return "\xE2\x8F\x9A";
  }

  public function getFlavorText() {
    return pht('Modern Discord Management.');
  }

  public function getApplicationGroup() {
    return self::GROUP_CORE;
  }

  public function isPrototype() {
    return true;
  }

  public function getApplicationOrder() {
    return 0.1;
  }

  public function getRoutes() {
    return array(
      '/aitsys-management/' => array(
        '' => 'AitsysManagementRenderController',
        'view/(?P<class>[^/]+)/' => 'AitsysManagementRenderController',
      ),
    );
  }

}
