<?php

final class DiscordAntiRaidRaiderListPHIDType extends PhabricatorPHIDType {

  const TYPECONST = 'RALI';

  public function getTypeName() {
    return pht('Raider List');
  }

  public function newObject() {
    return new RaiderList();
  }

  public function getPHIDTypeApplicationClass() {
    return 'DiscordAntiRaidApplication';
  }

  protected function buildQueryForObjects(
    PhabricatorObjectQuery $query,
    array $phids) {

    return id(new PhabricatorFileQuery())
      ->withPHIDs($phids);
  }

  public function loadHandles(
    PhabricatorHandleQuery $query,
    array $handles,
    array $objects) {

    foreach ($handles as $phid => $handle) {
      $file = $objects[$phid];

      $id = $file->getID();
      $name = $file->getName();
      $uri = $file->getInfoURI();

      $handle->setName("RL{$id}");
      $handle->setFullName("RL{$id}: {$name}");
      $handle->setURI($uri);
    }
  }

  public function canLoadNamedObject($name) {
    return preg_match('/^RL\d*[1-9]\d*$/', $name);
  }

  public function loadNamedObjects(
    PhabricatorObjectQuery $query,
    array $names) {

    $id_map = array();
    foreach ($names as $name) {
      $id = (int)substr($name, 1);
      $id_map[$id][] = $name;
    }

    $objects = id(new PhabricatorFileQuery())
      ->setViewer($query->getViewer())
      ->withIDs(array_keys($id_map))
      ->execute();

    $results = array();
    foreach ($objects as $id => $object) {
      foreach (idx($id_map, $id, array()) as $name) {
        $results[$name] = $object;
      }
    }

    return $results;
  }

}
