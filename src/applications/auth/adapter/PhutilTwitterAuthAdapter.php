<?php

/**
 * Authentication adapter for Twitter OAuth2.
 */
final class PhutilTwitterAuthAdapter extends PhutilOAuthAuthAdapter {

  private $userInfo;
  private $extendedUserInfo;

  public function getAdapterType() {
    return 'twitter';
  }

  public function getAdapterDomain() {
    return 'twitter.com';
  }

  public function getAccountID() {
    $user = $this->getOAuthAccountData('id');
    return $user;
  }

  public function getAccountEmail() {
    /*if ($this->extendedUserInfo === null) {
      $params = array(
        'skip_status' => true,
        'include_entities' => false,
        'include_email' => true,
      );
      $uri = new PhutilURI(
        'https://api.twitter.com/1.1/account/verify_credentials.json',
        $params);

      $data = $this->newOAuth1Future($uri)
        ->setMethod('GET')
        ->resolveJSON();

      $this->extendedUserInfo = $data;
    }
    return $this->extendedUserInfo;*/
  }

  public function getAccountName() {
    $user = $this->getOAuthAccountData('username');
    return $user;
  }

  public function getAccountImageURI() {
    $user = $this->getOAuthAccountData('profile_image_url');
    return $user;
  }

  public function getAccountURI() {
    $user = $this->getOAuthAccountData('url');
    return $user;
  }

  public function getAccountRealName() {
    $user = $this->getOAuthAccountData('name');
    return $user;
  }

  protected function getTokenBaseURI() {
    return 'https://twitter.com/i/oauth2/authorize';
  }

  protected function getRequestTokenURI() {
    return 'https://api.twitter.com/2/oauth2/token';
  }

  public function getScope() {
    $scopes = array(
      'offline.access',
      'follows.read',
      'users.read',
      'tweet.read',
    );

    return implode(' ', $scopes);
  }

  public function getExtraAuthenticateParameters() {
    return array(
      'response_type' => 'code',
      'code_challenge' => 'challenge',
      'code_challenge_method' => 'plain',
    );
  }

  public function getExtraTokenParameters() {
    return array(
      'grant_type' => 'authorization_code',
      'code_verifies' => 'challenge',
    );
  }

  protected function loadOAuthAccountData() {
    return id(new AITSYSTwitterFuture())
      ->setAccessToken($this->getAccessToken())
      ->setRawTwitterQuery('users/me')
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
