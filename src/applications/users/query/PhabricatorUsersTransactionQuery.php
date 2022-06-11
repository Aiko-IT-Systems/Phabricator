<?php

final class PhabricatorUsersTransactionQuery
  extends PhabricatorApplicationTransactionQuery {

  public function getTemplateApplicationTransaction() {
    return new PhabricatorUserTransaction();
  }

}
