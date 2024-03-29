<?php

/**
 * Authentication adapter for Battle.net OAuth2.
 */
final class AITSYSBattleNetAdapter extends PhutilOAuthAuthAdapter {

  public function getAdapterType() {
    return 'bnet';
  }

  public function getAdapterDomain() {
    return 'blizzard.com';
  }

  public function getAccountID() {
    $user = $this->getOAuthAccountData('id');
    return $user;
  }

  public function getAccountEmail() {
    return null;
  }

  public function getAccountName() {
    $user = $this->getOAuthAccountData('battletag');
    return $user;
  }

  public function getAccountImageURI() {
    return null;
  }

  public function getAccountURI() {
    return null;
  }

  public function getAccountRealName() {
    return null;
  }

  protected function getAuthenticateBaseURI() {
    return 'https://oauth.battle.net/oauth/authorize';
  }

  protected function getTokenBaseURI() {
    return 'https://oauth.battle.net/oauth/token';
  }

  public function getScope() {
    return 'openid';
  }

  public function getExtraAuthenticateParameters() {
    return array(
      'response_type' => 'code',
    );
  }

  public function getExtraTokenParameters() {
    return array(
      'grant_type' => 'authorization_code',
    );
  }

  protected function loadOAuthAccountData() {
    return id(new AITSYSBattleNetFuture())
      ->setAccessToken($this->getAccessToken())
      ->setRawBNetQuery('userinfo')
      ->resolve();
  }

  public function supportsTokenRefresh() {
    return false;
  }

  public function getExtraRefreshParameters() {
    return array(
      'grant_type' => 'refresh_token',
    );
  }

}
