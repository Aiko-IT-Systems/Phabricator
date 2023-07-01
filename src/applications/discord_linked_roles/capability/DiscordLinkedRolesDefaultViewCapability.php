<?php

final class DiscordLinkedRolesDefaultViewCapability extends PhabricatorPolicyCapability {

  const CAPABILITY = 'discord.linked-roles.default.view';

  public function getCapabilityName() {
    return pht('Default View Policy');
  }

  public function shouldAllowPublicPolicySetting() {
    return true;
  }

}
