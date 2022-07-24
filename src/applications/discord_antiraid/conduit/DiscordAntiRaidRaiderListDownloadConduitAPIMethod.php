<?php

final class DiscordAntiRaidRaiderListDownloadConduitAPIMethod extends DiscordAntiRaidConduitAPIMethod {

  public function getAPIMethodName() {
    return 'discord.anti-raid.raider-list.download';
  }

  public function getMethodDescription() {
    return pht('Download a raider list from the server.');
  }

  protected function defineParamTypes() {
    return array(
      'phid' => 'required phid',
    );
  }

  protected function defineReturnType() {
    return 'nonempty mixed';
  }

  protected function defineErrorTypes() {
    return array(
      'ERR-BAD-PHID' => pht('No such raider list exists.'),
    );
  }

  protected function execute(ConduitAPIRequest $request) {
    $phid = $request->getValue('phid');

    return array (
      'actors' => array (
        856780995629154305,
        822242444070092860,
      ),
      'guild' => 881207955029110855,
      'notes' => array (
        856780995629154305 => 'Raid happened suddenly, users spammed in dms with crypto scam',
      ),
      'phid' => $phid,
      'raiders' => array (
        42183821907487860,
        43214890218324216,
        59838384934395990,
      ),
      'timestamp' => 1658154600,
      'type' => 2,
      'uri' => 'https://aitsys.dev/RL1',
    );
  }

}
