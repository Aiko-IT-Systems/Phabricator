<?php

final class PhabricatorStandardCustomFieldUsers
  extends PhabricatorStandardCustomFieldTokenizer {

  public function getFieldType() {
    return 'users';
  }

  public function getDatasource() {
    return new PhabricatorUsersDatasource();
  }

  protected function getHTTPParameterType() {
    return new AphrontUserListHTTPParameterType();
  }

  protected function newConduitSearchParameterType() {
    return new ConduitUserListParameterType();
  }

  protected function newConduitEditParameterType() {
    return new ConduitUserListParameterType();
  }

}
