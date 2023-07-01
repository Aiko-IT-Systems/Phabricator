<?php

final class RaiderListTransactionComment
  extends PhabricatorApplicationTransactionComment {

  public function getApplicationTransactionObject() {
    return new RaiderListTransaction();
  }

}
