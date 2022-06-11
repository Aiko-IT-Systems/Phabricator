<?php

final class PhabricatorUsersProfileMenuEngine
  extends PhabricatorProfileMenuEngine {

  const ITEM_PROFILE = 'users.profile';
  const ITEM_MANAGE = 'users.manage';
  const ITEM_PICTURE = 'users.picture';
  const ITEM_BADGES = 'users.badges';
  const ITEM_TASKS = 'users.tasks';
  const ITEM_COMMITS = 'users.commits';
  const ITEM_REVISIONS = 'users.revisions';

  protected function isMenuEngineConfigurable() {
    return false;
  }

  public function getItemURI($path) {
    $user = $this->getProfileObject();
    $username = $user->getUsername();
    $username = phutil_escape_uri($username);
    return "/p/{$username}/item/{$path}";
  }

  protected function getBuiltinProfileItems($object) {
    $viewer = $this->getViewer();

    $items = array();

    $items[] = $this->newItem()
      ->setBuiltinKey(self::ITEM_PICTURE)
      ->setMenuItemKey(PhabricatorUsersPictureProfileMenuItem::MENUITEMKEY);

    $items[] = $this->newItem()
      ->setBuiltinKey(self::ITEM_PROFILE)
      ->setMenuItemKey(PhabricatorUsersDetailsProfileMenuItem::MENUITEMKEY);

    $have_badges = PhabricatorApplication::isClassInstalledForViewer(
      'PhabricatorBadgesApplication',
      $viewer);
    if ($have_badges) {
      $items[] = $this->newItem()
        ->setBuiltinKey(self::ITEM_BADGES)
        ->setMenuItemKey(PhabricatorUsersBadgesProfileMenuItem::MENUITEMKEY);
    }

    $have_maniphest = PhabricatorApplication::isClassInstalledForViewer(
      'PhabricatorManiphestApplication',
      $viewer);
    if ($have_maniphest) {
      $items[] = $this->newItem()
        ->setBuiltinKey(self::ITEM_TASKS)
        ->setMenuItemKey(PhabricatorUsersTasksProfileMenuItem::MENUITEMKEY);
    }

    $have_differential = PhabricatorApplication::isClassInstalledForViewer(
      'PhabricatorDifferentialApplication',
      $viewer);
    if ($have_differential) {
      $items[] = $this->newItem()
        ->setBuiltinKey(self::ITEM_REVISIONS)
        ->setMenuItemKey(
          PhabricatorUsersRevisionsProfileMenuItem::MENUITEMKEY);
    }

    $have_diffusion = PhabricatorApplication::isClassInstalledForViewer(
      'PhabricatorDiffusionApplication',
      $viewer);
    if ($have_diffusion) {
      $items[] = $this->newItem()
        ->setBuiltinKey(self::ITEM_COMMITS)
        ->setMenuItemKey(PhabricatorUsersCommitsProfileMenuItem::MENUITEMKEY);
    }

    $items[] = $this->newItem()
      ->setBuiltinKey(self::ITEM_MANAGE)
      ->setMenuItemKey(PhabricatorUsersManageProfileMenuItem::MENUITEMKEY);

    return $items;
  }

}
