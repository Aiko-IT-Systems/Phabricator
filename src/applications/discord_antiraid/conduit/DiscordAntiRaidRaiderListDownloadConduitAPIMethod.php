<?php

final class DiscordAntiRaidRaiderListDownloadConduitAPIMethod extends DiscordAntiRaidConduitAPIMethod {

  public function getAPIMethodName() {
    return 'discord.antiraid.raiderlist.download';
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

    return array(
      'raiderlist' => $phid,
      'guilds' => 1263726137681223,
      'raiders' => array(
        271432891647862184,
        478216748261836892,
      )
    );
  }

}
