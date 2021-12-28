<?php

final class PeopleEditUsersCapability
  extends PhabricatorPolicyCapability {

  const CAPABILITY = 'people.edit.users';

  public function getCapabilityName() {
    return pht('Can edit Users');
  }

  public function describeCapabilityRejection() {
    return pht('You do not have permission to edit users.');
  }

}
