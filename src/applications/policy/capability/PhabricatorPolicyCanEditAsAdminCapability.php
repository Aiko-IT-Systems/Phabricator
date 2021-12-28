<?php

final class PhabricatorPolicyCanEditAsAdminCapability
  extends PhabricatorPolicyCapability {

  const CAPABILITY = self::CAN_EDIT_AS_ADMIN;

  public function getCapabilityName() {
    return pht('Can Edit As Admin');
  }

  public function describeCapabilityRejection() {
    return pht('You do not have permission to edit this object.');
  }

}
