<?php

final class UsersEditUsersCapability
  extends PhabricatorPolicyCapability {

  const CAPABILITY = 'users.edit.users';

  public function getCapabilityName() {
    return pht('Can edit Users');
  }

  public function describeCapabilityRejection() {
    return pht('You do not have permission to edit users.');
  }

}
