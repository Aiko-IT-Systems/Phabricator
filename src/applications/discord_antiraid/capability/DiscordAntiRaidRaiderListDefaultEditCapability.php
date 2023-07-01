<?php

final class DiscordAntiRaidRaiderListDefaultEditCapability extends PhabricatorPolicyCapability {

  const CAPABILITY = 'discord.anti-raid.raider-list.default.edit';

  public function getCapabilityName() {
    return pht('Default Edit Policy');
  }

  public function shouldAllowPublicPolicySetting() {
    return false;
  }
}
