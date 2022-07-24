<?php

final class RaiderListTransaction
  extends PhabricatorModularTransaction {

  public function getApplicationName() {
    return 'discord.anti-raid.raider-list';
  }

  public function getApplicationTransactionType() {
    return DiscordAntiRaidRaiderListPHIDType::TYPECONST;
  }

  public function getApplicationTransactionCommentObject() {
    return new RaiderListTransactionComment();
  }

  public function getBaseTransactionClass() {
    return 'RaiderListTransactionType';
  }
}
