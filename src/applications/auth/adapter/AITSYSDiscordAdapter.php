<?php

/**
 * Authentication adapter for Discord OAuth2.
 */
final class AITSYSDiscordAdapter extends PhutilOAuthAuthAdapter {

  private $isAdmin = false;
  private $isStaff = false;
  private $isMod = false;
  private $isLeader = false;
  private $userSince;
  private $username;

  public function getAdapterType() {
    return 'discord';
  }

  public function getAdapterDomain() {
    return 'discord.com';
  }

  public function getAccountID() {
    $user = $this->getOAuthAccountData('id');
    return $user;
  }

  public function getAccountEmail() {
    $email = $this->getOAuthAccountData('email');
    $verified = $this->getOAuthAccountData('verified');
    if ($verified) {
      if (PhabricatorEnv::getEnvConfig('discord.oauth2.bot.linked_roles')) {
        $this->PushAccountMetadata($email);
      }
      if (PhabricatorEnv::getEnvConfig('discord.oauth2.bot.guild_auto_add')) {
        if ($this->isAdmin) {
          $guilds = PhabricatorEnv::getEnvConfig('discord.oauth2.bot.guild_auto_add.admin_guilds');
          if ($guilds != null) {
            foreach($guilds as $guild) {
              $this->addToDiscordGuild($guild);
            }
          }
        }
        else
        {
          $guilds = PhabricatorEnv::getEnvConfig('discord.oauth2.bot.guild_auto_add.user_guilds');
          if ($guilds != null) {
            foreach($guilds as $guild) {
              $this->addToDiscordGuild($guild);
            }
          }
        }
      }
      return $email;
    }
    else {
      return null;
    }
  }

  public function getAccountName() {
    $user = "{$this->getOAuthAccountData('username')}#{$this->getOAuthAccountData('discriminator')}";
    return $user;
  }

  public function getAccountImageURI() {
    $avatar = $this->getOAuthAccountData('avatar');
    $user_id = $this->getAccountID();
    if (strpos($avatar, "a_") === 0) {
      $avatar = "https://cdn.discordapp.com/avatars/{$user_id}/{$avatar}.gif";
    }
    else {
      $avatar = "https://cdn.discordapp.com/avatars/{$user_id}/{$avatar}.png";
    }
    return $avatar;
  }

  public function getAccountURI() {
    $id = $this->getAccountID();
    if (strlen($id)) {
      return 'https://discord.com/users/'.$id;
    }
    return null;
  }

  public function getAccountRealName() {
    return $this->getOAuthAccountData('name');
  }

  protected function getAuthenticateBaseURI() {
    return 'https://discord.com/oauth2/authorize';
  }

  protected function getTokenBaseURI() {
    return 'https://discord.com/api/oauth2/token';
  }

  public function getScope() {
    $scopes = array(
      'identify',
      'email',
      'guilds',
      'connections',
      'guilds.join',
      'guilds.members.read',
      'role_connections.write',
    );

    return implode(' ', $scopes);
  }

  public function getExtraAuthenticateParameters() {
    return array(
      'response_type' => 'code',
      'prompt' => 'none',
    );
  }

  public function getExtraTokenParameters() {
    return array(
      'grant_type' => 'authorization_code',
    );
  }

  protected function loadOAuthAccountData() {
    return id(new AITSYSDiscordFuture())
      ->setAccessToken('Bearer '.$this->getAccessToken())
      ->setRawDiscordQuery('users/@me')
      ->resolve();
  }

  public function getPhabricatorAccountUsername(string $email) {
    $fakeViewer = PhabricatorUser::getOmnipotentUser();
      $res = id(new PhabricatorUsersQuery())
      ->setViewer($fakeViewer)
      ->withEmails(array($email,))
      ->executeOne();

      if ($res == null)
      {
        return null;
      }
      $field_list = PhabricatorCustomField::getObjectFields(
        $res,
        PhabricatorCustomField::ROLE_VIEW);
      $field_list->setViewer($fakeViewer);
      $field_list->readFieldsFromStorage($res);
      $custom_field_map = array();
      foreach ($field_list->getFields() as $custom_field) {
        if (strpos($custom_field->getFieldKey(), "aitsys") === false || strpos($custom_field->getFieldKey(), "div") !== false)
        {
          continue;
        }
        phlog($custom_field->getFieldKey());
        $custom_field_key = $custom_field->getFieldKey();
        $custom_field_value = $custom_field->getValueForStorage();
        $custom_field_map[$custom_field_key] = $custom_field_value;
      }
      phlog($custom_field_map);
      $created = $res->getDateCreated();
      $datetime = new DateTime(phabricator_datetime($created, $fakeViewer));
      $this->userSince = $datetime->format(DateTime::ATOM);
      $this->isAdmin = $res->getIsAdmin();
      $this->username = $res->getUsername();
      return $this->username;
    /*try {

    }
    catch (Exception $ex) {
      return null;
    }*/
  }

  public function getAndParseCustomFields(PhabricatorUser $user) {
    $customFields = $user->getCustomFields();

    $this->isStaff = false;
    $this->isMod = false;
    $this->isLeader = false;
  }

  public function PushAccountMetadata(string $email) {
    $username = $this->getPhabricatorAccountUsername($email);
    if ($username != null) {
        $metadata = phutil_json_encode($this->generateMetadata($username));
        $url = 'users/@me/applications/'.$this->getClientID().'/role-connection';
        try {
          id(new AITSYSDiscordFuture())
            ->setMethod('PUT')
            ->setIsJson(true)
            ->setAccessToken('Bearer '.$this->getAccessToken())
            ->setRawDiscordQuery($url)
            ->setJson($metadata)
            ->resolve();
        } catch (Exception $ex) {
          phlog($ex);
        }
    }
  }

  public function generateMetadata(string $username) {
    return array(
      'platform_name' => 'AITSYS',
      'platform_username' => $username,
      'metadata' => array(
        'admin' => (int)$this->isAdmin,
        'user_since' => $this->userSince,
        '1_is_staff' => (int)$this->isStaff,
        '2_is_mod' => (int)$this->isMod,
        '3_is_leader' => (int)$this->isLeader,
      )
    );
  }

  public function supportsTokenRefresh() {
    return true;
  }

  public function getExtraRefreshParameters() {
    return array(
      'grant_type' => 'refresh_token',
    );
  }

  public function addToDiscordGuild(string $guild) {
    try {
      $url = '/guilds/'.$guild.'/members/'.$this->getAccountID();
      $metadata = phutil_json_encode(array(
        'access_token' => $this->getAccessToken(),
      ));
      $token = PhabricatorEnv::getEnvConfig('discord.bot.token');
      id(new AITSYSDiscordFuture())
        ->setMethod('PUT')
        ->setIsJson(true)
        ->setAccessToken('Bot '.$token)
        ->setRawDiscordQuery($url)
        ->setJson($metadata)
        ->resolve();
    } catch (Exception $ex) {
      phlog($ex);
    }
  }

}
