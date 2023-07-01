<?php

final class DiscordLinkedRolesApplication extends DiscordApplication {

  public function getBaseURI() {
    return '/discord/linked-roles/';
  }

  public function getShortDescription() {
    return pht('Discord Linked Roles Module');
  }

  public function getName() {
    return pht('Discord Linked Roles');
  }

  public function getIcon() {
    return 'fa-link';
  }

  public function isBrandIcon() {
    return false;
  }

  public function isLaunchable() {
    return true;
  }

  public function canUninstall() {
    return true;
  }

  public function getFlavorText() {
    return pht('Linked Roles UI for Discord.');
  }

  public function getApplicationGroup() {
    return self::GROUP_UTILITIES;
  }

  public function isPrototype() {
    return true;
  }

  public function getApplicationOrder() {
    return 0.1;
  }

  public function getRoutes() {
    return array(
      '/discord/linked-roles/' => array(
        '' => 'DiscordLinkedRolesRenderController',
        'overview/' => 'DiscordLinkedRolesRenderUIController',
      ),
    );
  }

}
