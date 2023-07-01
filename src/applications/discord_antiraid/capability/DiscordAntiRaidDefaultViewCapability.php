<?php

final class DiscordAntiRaidDefaultViewCapability extends PhabricatorPolicyCapability {

  const CAPABILITY = 'discord.anti-raid.default.view';

  public function getCapabilityName() {
    return pht('Default View Policy');
  }

  public function shouldAllowPublicPolicySetting() {
    return true;
  }

}
