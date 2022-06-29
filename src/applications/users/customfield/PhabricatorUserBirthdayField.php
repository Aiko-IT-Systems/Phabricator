<?php

final class PhabricatorUserBirthdayField
  extends PhabricatorUserCustomField {

  private $value;

  public function getFieldValue() {
    return $this->value;
  }

  public function getFieldKey() {
    return 'user:birthday';
  }

  public function getFieldName() {
    return pht('Birthday');
  }

  public function getFieldDescription() {
    return pht('Shows user birthday.');
  }

  public function shouldAppearInApplicationTransactions() {
    return true;
  }

  public function shouldAppearInEditView() {
    return true;
  }

  public function shouldAppearInPropertyView() {
    return true;
  }

  public function getModernFieldKey() {
    return 'birthday';
  }

  public function getFieldKeyForConduit() {
    return $this->getModernFieldKey();
  }

  public function readValueFromObject(PhabricatorCustomFieldInterface $object) {
    $this->value = $object->loadUserProfile()->getBirthday();
  }

  public function getOldValueForApplicationTransactions() {
    return $this->getObject()->loadUserProfile()->getBirthday();
  }

  public function getNewValueForApplicationTransactions() {
    return $this->getFieldValue();
  }

  public function applyApplicationTransactionInternalEffects(
    PhabricatorApplicationTransaction $xaction) {
    $this->getObject()->loadUserProfile()->setBirthday($xaction->getNewValue());
  }

  private function newDateControl() {
    $control = id(new AphrontFormDateControl())
      ->setLabel($this->getFieldName())
      ->setName($this->getFieldKey())
      ->setUser($this->getViewer())
      ->setAllowNull(true)
      ->setIsTimeDisabled(true);

    // If the value is already numeric, treat it as an epoch timestamp and set
    // it directly. Otherwise, it's likely a field default, which we let users
    // specify as a string. Parse the string into an epoch.

    $value = $this->getFieldValue();
    if (!ctype_digit($value)) {
      $value = PhabricatorTime::parseLocalTime($value, $this->getViewer());
    }

    // If we don't have anything valid, make sure we pass `null`, since the
    // control special-cases that.
    $control->setValue(nonempty($value, null));

    return $control;
  }

  public function readValueFromRequest(AphrontRequest $request) {
    $control = $this->newDateControl();
    $control->setUser($request->getUser());
    $value = $control->readValueFromRequest($request);

    $this->setFieldValue($value);
  }

  public function buildFieldIndexes() {
    $indexes = array();

    $value = $this->getFieldValue();
    if (strlen($value)) {
      $indexes[] = $this->newNumericIndex((int)$value);
    }

    return $indexes;
  }

  public function buildOrderIndex() {
    return $this->newNumericIndex(0);
  }

  public function getValueForStorage() {
    $value = $this->getFieldValue();
    if (strlen($value)) {
      return (int)$value;
    } else {
      return null;
    }
  }

  public function setValueFromStorage($value) {
    if (strlen($value)) {
      $value = (int)$value;
    } else {
      $value = null;
    }
    return $this->setFieldValue($value);
  }

  public function renderEditControl(array $handles) {
    return $this->newDateControl();
  }

  public function setFieldValue($value) {
    $this->value = $value;
    return $this;
  }

  public function renderPropertyViewValue(array $handles) {
    $value = $this->getFieldValue();
    if (!$value) {
      return null;
    }

    if (!ctype_digit($value)) {
      $value = PhabricatorTime::parseLocalTime($value, $this->getViewer());
    }

    $absolute = phabricator_date($value, $this->getViewer());

    $birthDate = explode("/", date('m/d/Y', $value));
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
      ? ((date("Y") - $birthDate[2]) - 1)
      : (date("Y") - $birthDate[2]));
    
    return hsprintf('%s (%s)', $absolute, $age);
  }
  public function getApplicationTransactionTitleForFeed(
    PhabricatorApplicationTransaction $xaction) {

    $viewer = $this->getViewer();

    $author_phid = $xaction->getAuthorPHID();
    $object_phid = $xaction->getObjectPHID();

    $old = $xaction->getOldValue();
    $new = $xaction->getNewValue();

    if (!$old) {
      return pht(
        '%s set %s to %s on %s.',
        $xaction->renderHandleLink($author_phid),
        $this->getFieldName(),
        phabricator_date($new, $viewer),
        $xaction->renderHandleLink($object_phid));
    } else if (!$new) {
      return pht(
        '%s removed %s on %s.',
        $xaction->renderHandleLink($author_phid),
        $this->getFieldName(),
        $xaction->renderHandleLink($object_phid));
    } else {
      return pht(
        '%s changed %s from %s to %s on %s.',
        $xaction->renderHandleLink($author_phid),
        $this->getFieldName(),
        phabricator_date($old, $viewer),
        phabricator_date($new, $viewer),
        $xaction->renderHandleLink($object_phid));
    }
  }

  protected function newConduitSearchParameterType() {
    // TODO: Build a new "pair<epoch|null, epoch|null>" type or similar.
    return null;
  }

  protected function newConduitEditParameterType() {
    return null;
  }

  protected function newExportFieldType() {
    return new PhabricatorEpochExportField();
  }

  private function isEditable() {
    return PhabricatorEnv::getEnvConfig('account.editable');
  }
}
