<?php

final class DiscordApplication extends PhabricatorApplication {

  public function getShortDescription() {
    return pht('Discord Base Module');
  }

  public function getName() {
    return pht('Discord');
  }

  public function getIcon() {
    return 'fa-discord';
  }

  public function isBrandIcon() {
    return true;
  }

  public function getApplicationGroup() {
    return self::GROUP_CORE;
  }

  public function isLaunchable() {
    return false;
  }

  public function canUninstall() {
    return false;
  }

  public function isPrototype() {
    return true;
  }

  public function getRoutes() {
    return array(
      '/discord/anti-raid/' => array(
        '' => 'DiscordAntiRaidRenderController',
        'history/' => 'DiscordAntiRaidRenderUIController',
        'download/' => array(
          '' => 'DiscordAntiRaidDownloadController',
          'raiderlist/' => 'DiscordAntiRaidDownloadRaidersController',
        ),
      ),
    );
  }

}
