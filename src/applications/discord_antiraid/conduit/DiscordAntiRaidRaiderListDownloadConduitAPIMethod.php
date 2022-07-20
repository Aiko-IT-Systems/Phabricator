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
      'phid' => 'optional phid',
      'guild_raid_id' => 'optional wild',
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
    $rid = $request->getValue('guild_raid_id');

    return array(
      'raiderlist' => $phid,
      'raid_id'=> $rid,
      'guild' => 881207955029110855,
      'raiders' => array(
        271432891647862184,
        478216748261836892,
      )
    );
  }

}
