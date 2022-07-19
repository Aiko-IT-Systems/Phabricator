<?php

final class DiscordAntiRaidApplication extends PhabricatorApplication {

  public function getBaseURI() {
    return '/discord/anti-raid/';
  }

  public function getShortDescription() {
    return pht('Discord Anti-Raid Module');
  }

  public function getName() {
    return pht('Discord Anti-Raid');
  }

  public function getIcon() {
    return 'fa-shield';
  }

  public function isBrandIcon() {
    return true;
  }

  public function getFlavorText() {
    return pht('Anti-Raid Security for Discord.');
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
      '/discord/anti-raid/' => array(
        '' => 'DiscordAntiRaidRenderController',
        'download/' => array(
          '' => 'DiscordAntiRaidDownloadController',
          'raiderlist/' => 'DiscordAntiRaidDownloadRaidersController',
        ),
      ),
    );
  }

}
