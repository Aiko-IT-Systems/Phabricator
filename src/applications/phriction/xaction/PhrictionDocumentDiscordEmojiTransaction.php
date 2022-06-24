<?php

final class PhrictionDocumentDiscordEmojiTransaction
  extends PhrictionDocumentEditTransaction {

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

  public function getActionStrength() {
    return 140;
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

  public function getDiscordEmoji() {
    $old = $this->getOldValue();
    $new = $this->getNewValue();

    if ($old === null) {
      if ($this->getMetadataValue('stub:create:phid')) {
        return pht(
          '%s stubbed out this document when creating %s.',
          $this->renderAuthor(),
          $this->renderHandleLink(
            $this->getMetadataValue('stub:create:phid')));
      } else {
        return pht(
          '%s created this document.',
          $this->renderAuthor());
      }
    }

    return pht(
      '%s changed the discord emoji from %s to %s.',
      $this->renderAuthor(),
      $this->renderOldValue(),
      $this->renderNewValue());
  }

  public function getDiscordEmojiForFeed() {
    $old = $this->getOldValue();
    $new = $this->getNewValue();

    if ($old === null) {
      return pht(
        '%s created %s.',
        $this->renderAuthor(),
        $this->renderObject());
    }

    return pht(
      '%s changed discord emoji for %s from %s to %s.',
      $this->renderAuthor(),
      $this->renderObject(),
      $this->renderOldValue(),
      $this->renderNewValue());
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
