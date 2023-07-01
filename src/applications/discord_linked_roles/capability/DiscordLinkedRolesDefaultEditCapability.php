<?php

final class DiscordLinkedRolesDefaultEditCapability extends PhabricatorPolicyCapability {

  const CAPABILITY = 'discord.linked-roles.default.edit';

  public function getCapabilityName() {
    return pht('Default Edit Policy');
  }

  public function shouldAllowPublicPolicySetting() {
    return false;
  }
}
