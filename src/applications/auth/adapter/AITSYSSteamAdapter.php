<?php

/**
 * Authentication adapter for Steam OAuth2.
 */
final class AITSYSSteamAdapter extends PhutilOAuthAuthAdapter {

  public function getAdapterType() {
    return 'steam';
  }

  public function getAdapterDomain() {
    return 'steamcommunity.com';
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
    return 'https://steamcommunity.com/oauth/login';
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
    return id(new AITSYSSteamFuture())
      ->setAccessToken($this->getAccessToken())
      ->setRawDiscordQuery('https://api.steampowered.com/ISteamUserOAuth/GetTokenDetails/v1/?access_token='.$this->getAccessToken())
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
