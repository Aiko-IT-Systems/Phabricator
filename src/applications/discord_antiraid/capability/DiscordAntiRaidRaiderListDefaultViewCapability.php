<?php

final class DiscordAntiRaidRaiderListDefaultViewCapability extends PhabricatorPolicyCapability {

  const CAPABILITY = 'discord.anti-raid.raider-list.default.view';

  public function getCapabilityName() {
    return pht('Default View Policy');
  }

  public function shouldAllowPublicPolicySetting() {
    return true;
  }

}
