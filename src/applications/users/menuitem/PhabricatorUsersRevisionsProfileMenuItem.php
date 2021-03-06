<?php

final class PhabricatorUsersRevisionsProfileMenuItem
  extends PhabricatorProfileMenuItem {

  const MENUITEMKEY = 'users.revisions';

  public function getMenuItemTypeName() {
    return pht('Revisions');
  }

  private function getDefaultName() {
    return pht('Revisions');
  }

  public function canHideMenuItem(
    PhabricatorProfileMenuItemConfiguration $config) {
    return true;
  }

  public function getDisplayName(
    PhabricatorProfileMenuItemConfiguration $config) {
    $name = $config->getMenuItemProperty('name');

    if (strlen($name)) {
      return $name;
    }

    return $this->getDefaultName();
  }

  public function buildEditEngineFields(
    PhabricatorProfileMenuItemConfiguration $config) {
    return array(
      id(new PhabricatorTextEditField())
        ->setKey('name')
        ->setLabel(pht('Name'))
        ->setPlaceholder($this->getDefaultName())
        ->setValue($config->getMenuItemProperty('name')),
    );
  }

  protected function newMenuItemViewList(
    PhabricatorProfileMenuItemConfiguration $config) {

    $user = $config->getProfileObject();
    $id = $user->getID();

    $item = $this->newItemView()
      ->setURI("/users/revisions/{$id}/")
      ->setName($this->getDisplayName($config))
      ->setIcon('fa-gear');

    return array(
      $item,
    );
  }

}
