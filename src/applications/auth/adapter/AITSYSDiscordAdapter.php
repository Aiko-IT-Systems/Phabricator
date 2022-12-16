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
    $user = $this->getOAuthAccountData('email');
    $verified = $this->getOAuthAccountData('verified');
    if ($verified) {
      return $user;
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

  public function supportsTokenRefresh() {
    return true;
  }

  public function getExtraRefreshParameters() {
    return array(
      'grant_type' => 'refresh_token',
    );
  }

}
