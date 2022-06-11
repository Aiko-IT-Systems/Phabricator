<?php

final class PhabricatorUsersUserEmailPHIDType
  extends PhabricatorPHIDType {

  const TYPECONST = 'EADR';

  public function getTypeName() {
    return pht('User Email');
  }

  public function newObject() {
    return new PhabricatorUserEmail();
  }

  public function getPHIDTypeApplicationClass() {
    return 'PhabricatorUsersApplication';
  }

  protected function buildQueryForObjects(
    PhabricatorObjectQuery $query,
    array $phids) {

    return id(new PhabricatorUsersUserEmailQuery())
      ->withPHIDs($phids);
  }

  public function loadHandles(
    PhabricatorHandleQuery $query,
    array $handles,
    array $objects) {

    foreach ($handles as $phid => $handle) {
      $email = $objects[$phid];
      $handle->setName($email->getAddress());
    }

    return null;
  }

}
