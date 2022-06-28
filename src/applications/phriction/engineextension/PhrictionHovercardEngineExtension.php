<?php

final class PhrictionHovercardEngineExtension
  extends PhabricatorHovercardEngineExtension {

  const EXTENSIONKEY = 'wiki';

  public function isExtensionEnabled() {
    return true;
  }

  public function getExtensionName() {
    return pht('Wiki Documents');
  }

  public function canRenderObjectHovercard($object) {
    return ($object instanceof PhrictionDocument);
  }

  public function willRenderHovercards(array $objects) {
    $phids = mpull($objects, 'getPHID');

    $wikis = id(new PhrictionDocumentQuery())
      ->withPHIDs($phids)
      ->execute();
    $wikis = mpull($users, null, 'getPHID');

    return array(
      'wikis' => $wikis,
    );
  }

  public function renderHovercard(
    PHUIHovercardView $hovercard,
    PhabricatorObjectHandle $handle,
    $object,
    $data) {
    $viewer = $this->getViewer();

    $wiki = idx($data['wikis'], $object->getPHID());
    if (!$wiki) {
      return;
    }

    $is_exiled = $hovercard->getIsExiled();

    $wiki_card = id(new PhabricatorPhrictionCardView())
      ->setWiki($wiki)
      ->setViewer($viewer)
      ->setIsExiled($is_exiled);

    $hovercard->appendChild($wiki_card);
  }

}
