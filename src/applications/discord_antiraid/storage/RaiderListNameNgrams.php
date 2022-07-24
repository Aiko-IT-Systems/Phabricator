<?php

final class RaiderListNameNgrams
  extends PhabricatorSearchNgrams {

  public function getNgramKey() {
    return 'raiderlist_name';
  }

  public function getColumnName() {
    return 'name';
  }

  public function getApplicationName() {
    return 'discord.anti-raid.raider-list';
  }

}
