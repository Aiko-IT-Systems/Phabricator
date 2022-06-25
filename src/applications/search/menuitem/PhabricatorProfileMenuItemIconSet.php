<?php

final class PhabricatorProfileMenuItemIconSet
  extends PhabricatorIconSet {

  const ICONSETKEY = 'profilemenuitem';

  public function getSelectIconTitleText() {
    return pht('Choose Item Icon');
  }

  protected function newIcons() {
    $list = array(
      array(
        'key' => 'link',
        'icon' => 'fa-solid fa-link',
        'name' => pht('Link'),
      ),
      array(
        'key' => 'maniphest',
        'icon' => 'fa-solid fa-anchor',
        'name' => pht('Maniphest'),
      ),
      array(
        'key' => 'feed',
        'icon' => 'fa-solid fa-newspaper',
        'name' => pht('Feed'),
      ),
      array(
        'key' => 'phriction',
        'icon' => 'fa-solid fa-book',
        'name' => pht('Phriction'),
      ),
      array(
        'key' => 'conpherence',
        'icon' => 'fa-solid fa-comments',
        'name' => pht('Conpherence'),
      ),
      array(
        'key' => 'differential',
        'icon' => 'fa-solid fa-cog',
        'name' => pht('Differential'),
      ),
      array(
        'key' => 'diffusion',
        'icon' => 'fa-solid fa-code',
        'name' => pht('Diffusion'),
      ),
      array(
        'key' => 'calendar',
        'icon' => 'fa-solid fa-calendar',
        'name' => pht('Calendar'),
      ),
      array(
        'key' => 'create',
        'icon' => 'fa-solid fa-plus',
        'name' => pht('Create'),
      ),
    );

    $icons = array();
    foreach ($list as $spec) {
      $icons[] = id(new PhabricatorIconSetIcon())
        ->setKey($spec['key'])
        ->setIcon($spec['icon'])
        ->setLabel($spec['name']);
    }

    return $icons;
  }

}
