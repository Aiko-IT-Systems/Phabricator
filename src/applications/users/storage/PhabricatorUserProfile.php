<?php

final class PhabricatorUserProfile extends PhabricatorUserDAO {

  protected $userPHID;
  protected $title;
  protected $birthday;
  protected $blurb;
  protected $profileImagePHID;
  protected $icon;

  public static function initializeNewProfile(PhabricatorUser $user) {
    $default_icon = PhabricatorUsersIconSet::getDefaultIconKey();

    return id(new self())
      ->setUserPHID($user->getPHID())
      ->setIcon($default_icon)
      ->setTitle('')
      ->setBlurb('')
      ->setBirthday(null);
  }

  protected function getConfiguration() {
    return array(
      self::CONFIG_COLUMN_SCHEMA => array(
        'title' => 'text255',
        'blurb' => 'text',
        'profileImagePHID' => 'phid?',
        'icon' => 'text32',
        'birthday' => 'epoch?',
      ),
      self::CONFIG_KEY_SCHEMA => array(
        'userPHID' => array(
          'columns' => array('userPHID'),
          'unique' => true,
        ),
      ),
    ) + parent::getConfiguration();
  }

  public function getDisplayTitle() {
    $title = $this->getTitle();
    if (strlen($title)) {
      return $title;
    }

    $icon_key = $this->getIcon();
    return PhabricatorUsersIconSet::getIconName($icon_key);
  }

}
