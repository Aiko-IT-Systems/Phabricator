<?php

abstract class DiscordAntiRaidConduitAPIMethod extends ConduitAPIMethod {

  final public function getApplication() {
    return PhabricatorApplication::getByClass('DiscordAntiRaidApplication');
  }

  /*protected function loadRaiderListByPHID(PhabricatorUser $viewer, $raider_list_phid) {
    $raider_list = id(new RaiderListQuery())
      ->setViewer($viewer)
      ->withPHIDs(array($raider_list_phid))
      ->executeOne();
    if (!$raider_list) {
      throw new Exception(pht('No such raider list "%s"!', $raider_list_phid));
    }

    return $raider_list;
  }
*/
}
