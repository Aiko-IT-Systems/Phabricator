<?php

/**
 * Authentication adapter for Discord OAuth2.
 */
final class AITSYSDiscordAdapter extends PhutilOAuthAuthAdapter {

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
      $this->PushAccountMetadata($email);
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
      ->setAccessToken($this->getAccessToken())
      ->setRawDiscordQuery('users/@me')
      ->resolve();
  }

  public function getPhabricatorAccountUsername($email) {
    $user = null;
    try {
      $res = id(new PhabricatorUsersQuery())
      ->setViewer(PhabricatorUser::getOmnipotentUser())
      ->withEmails(array($email, ))
      ->executeOne();
      die($res);
      $user = $res->getUsername();
    }
    catch (Exception $ex) {
      return null;
    }

  }

  public function PushAccountMetadata($email) {
    $discord = id(new AITSYSDiscordFuture());
    $username = $this->getPhabricatorAccountUsername($email);

    if ($username != null) {
        try {
          $res = $discord
            ->setMethod('PUT')
            ->setAccessToken($this->getAccessToken())
            ->setRawDiscordQuery('users/@me/applications/'.$discord->getClientID().'/role-connection', $this->generateMetadata($username))
            ->resolve();
          die($res);
          return $res;
        } catch (Exception $ex) {
          die($ex);
          return null;
        }
    }
    die("Username is ".$username);
    return null;
  }

  public function generateMetadata($username) {
    return array(
      'platform_name' => 'AITSYS',
      'platform_username' => $username,
      'metadata' => array(),
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

}
