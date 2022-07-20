<?php

final class DiscordAntiRaidDefaultEditCapability extends PhabricatorPolicyCapability {

  const CAPABILITY = 'discord.anti-raid.default.edit';

  public function getCapabilityName() {
    return pht('Default Edit Policy');
  }

  public function shouldAllowPublicPolicySetting() {
    return false;
  }
}
