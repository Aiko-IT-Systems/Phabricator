<?php

final class PhabricatorUsersIconSet
  extends PhabricatorIconSet {

  const ICONSETKEY = 'users';

  public function getSelectIconTitleText() {
    return pht('Choose User Icon');
  }

  protected function newIcons() {
    $specifications = self::getIconSpecifications();

    $icons = array();
    foreach ($specifications as $spec) {
      $icons[] = id(new PhabricatorIconSetIcon())
        ->setKey($spec['key'])
        ->setIcon($spec['icon'])
        ->setLabel($spec['name']);
    }

    return $icons;
  }

  public static function getDefaultIconKey() {
    $specifications = self::getIconSpecifications();

    foreach ($specifications as $spec) {
      if (idx($spec, 'default')) {
        return $spec['key'];
      }
    }

    return null;
  }

  public static function getIconIcon($key) {
    $specifications = self::getIconSpecifications();
    $map = ipull($specifications, 'icon', 'key');
    return idx($map, $key);
  }

  public static function getIconName($key) {
    $specifications = self::getIconSpecifications();
    $map = ipull($specifications, 'name', 'key');
    return idx($map, $key);
  }

  private static function getIconSpecifications() {
    return self::getDefaultSpecifications();
  }

  private static function getDefaultSpecifications() {
    return array(
      array(
        'key' => 'person',
        'icon' => 'fa-solid fa-user',
        'name' => pht('User'),
        'default' => true,
      ),
      array(
        'key' => 'engineering',
        'icon' => 'fa-solid fa-code',
        'name' => pht('Engineering'),
      ),
      array(
        'key' => 'operations',
        'icon' => 'fa-solid fa-space-shuttle',
        'name' => pht('Operations'),
      ),
      array(
        'key' => 'resources',
        'icon' => 'fa-solid fa-heart',
        'name' => pht('Resources'),
      ),
      array(
        'key' => 'camera',
        'icon' => 'fa-solid fa-camera-retro',
        'name' => pht('Design'),
      ),
      array(
        'key' => 'music',
        'icon' => 'fa-solid fa-headphones',
        'name' => pht('Musician'),
      ),
      array(
        'key' => 'spy',
        'icon' => 'fa-solid fa-user-secret',
        'name' => pht('Spy'),
      ),
      array(
        'key' => 'android',
        'icon' => 'fa-solid fa-robot',
        'name' => pht('Bot'),
      ),
      array(
        'key' => 'relationships',
        'icon' => 'fa-solid fa-glass',
        'name' => pht('Relationships'),
      ),
      array(
        'key' => 'administration',
        'icon' => 'fa-solid fa-user-shield',
        'name' => pht('Administration'),
      ),
      array(
        'key' => 'security',
        'icon' => 'fa-solid fa-shield',
        'name' => pht('Security'),
      ),
      array(
        'key' => 'logistics',
        'icon' => 'fa-solid fa-truck',
        'name' => pht('Logistics'),
      ),
      array(
        'key' => 'research',
        'icon' => 'fa-solid fa-flask',
        'name' => pht('Research'),
      ),
      array(
        'key' => 'analysis',
        'icon' => 'fa-solid fa-bar-chart',
        'name' => pht('Analysis'),
      ),
      array(
        'key' => 'executive',
        'icon' => 'fa-solid fa-angle-double-up',
        'name' => pht('Executive'),
      ),
      array(
        'key' => 'animal',
        'icon' => 'fa-solid fa-paw',
        'name' => pht('Animal'),
      ),
    );
  }

}
