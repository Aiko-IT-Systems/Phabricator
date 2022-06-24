<?php

final class PhrictionDocumentDiscordEmojiTransaction
  extends PhrictionDocumentVersionTransaction {

  const TRANSACTIONTYPE = 'discordemoji';

  public function generateOldValue($object) {
    if ($this->isNewObject()) {
      return null;
    }
    return $this->getEditor()->getOldContent()->getDiscordEmoji();
  }

  public function applyInternalEffects($object, $value) {
    $object->setStatus(PhrictionDocumentStatus::STATUS_EXISTS);

    $content = $this->getNewDocumentContent($object);

    $content->setDiscordEmoji($value);
  }

  public function getActionName() {
    $old = $this->getOldValue();
    $new = $this->getNewValue();

    if ($old === null) {
      if ($this->getMetadataValue('stub:create:phid')) {
        return pht('Stubbed');
      } else {
        return pht('Created');
      }
    }
    return pht('ReDEmoted');
  }

  public function getTitle() {
    $old = $this->getOldValue();
    $new = $this->getNewValue();

    $rOld = 'null';
    $rNew = 'null';

    if (!empty($old)) {
      $rOld = $this->renderOldValue();
    }

    if (!empty($new)) {
      $rNew = $this->renderNewValue();
    }

    return pht(
      '%s changed the discord emoji from %s to %s.',
      $this->renderAuthor(),
      $rOld,
      $rNew);
  }

  public function getTitleForFeed() {
    $old = $this->getOldValue();
    $new = $this->getNewValue();

    $rOld = 'null';
    $rNew = 'null';

    if (!empty($old)) {
      $rOld = $this->renderOldValue();
    }

    if (!empty($new)) {
      $rNew = $this->renderNewValue();
    }

    return pht(
      '%s changed discord emoji for %s from %s to %s.',
      $this->renderAuthor(),
      $this->renderObject(),
      $rOld,
      $rNew);
  }

  public function validateTransactions($object, array $xactions) {
    $errors = array();

    // NOTE: This is slightly different from the draft validation. Here,
    // we're validating that: you can't edit away a document; and you can't
    // create an empty document.

    $content = $object->getContent()->getDiscordEmoji();
    /*if ($this->isEmptyTextTransaction($content, $xactions)) {
      $errors[] = $this->newRequiredError(
        pht('Documents must have a discord emoji.'));
    }*/

    return $errors;
  }

}
