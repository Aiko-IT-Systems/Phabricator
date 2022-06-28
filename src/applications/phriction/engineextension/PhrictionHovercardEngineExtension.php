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
    $viewer = $this->getViewer();
    $phids = mpull($objects, 'getPHID');

    $users = id(new PhabricatorUsersQuery())
      ->setViewer($viewer)
      ->withPHIDs($phids)
      ->needAvailability(true)
      ->needProfileImage(true)
      ->needProfile(true)
      ->execute();
    $users = mpull($users, null, 'getPHID');

    return array(
      'users' => $users,
    );
  }

  public function renderHovercard(
    PHUIHovercardView $hovercard,
    PhabricatorObjectHandle $handle,
    $object,
    $data) {
    $viewer = $this->getViewer();

    $user = idx($data['users'], $object->getPHID());
    if (!$user) {
      return;
    }

    $is_exiled = $hovercard->getIsExiled();

    $user_card = id(new PhabricatorUserCardView())
      ->setProfile($user)
      ->setViewer($viewer)
      ->setIsExiled($is_exiled);

    $hovercard->appendChild($user_card);
  }

}
