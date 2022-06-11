<?php

final class UsersDisableUsersCapability
  extends PhabricatorPolicyCapability {

  const CAPABILITY = 'users.disable.users';

  public function getCapabilityName() {
    return pht('Can Disable Users');
  }

  public function describeCapabilityRejection() {
    return pht('You do not have permission to disable or enable users.');
  }

}
