<?php

final class UsersCreateUsersCapability
  extends PhabricatorPolicyCapability {

  const CAPABILITY = 'users.create.users';

  public function getCapabilityName() {
    return pht('Can Create (non-bot) Users');
  }

  public function describeCapabilityRejection() {
    return pht('You do not have permission to create users.');
  }

}
