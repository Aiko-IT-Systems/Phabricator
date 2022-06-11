<?php

final class PhabricatorUserTransaction
  extends PhabricatorModularTransaction {

  public function getApplicationName() {
    return 'user';
  }

  public function getApplicationTransactionType() {
    return PhabricatorUsersUserPHIDType::TYPECONST;
  }

  public function getBaseTransactionClass() {
    return 'PhabricatorUserTransactionType';
  }

}
