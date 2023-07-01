<?php

final class PhabricatorTwitterAuthProvider
  extends PhabricatorOAuth2AuthProvider {

  public function getProviderName() {
    return pht('Twitter');
  }

  protected function getProviderConfigurationHelp() {
    $uri = PhabricatorEnv::getProductionURI('/auth/login/twitter:twitter.com/');
    $callback_uri = PhabricatorEnv::getURI($this->getLoginURI());

    return pht(
      "To configure Twitter OAuth, create a new application here:".
      "\n\n".
      "https://developer.twitter.com/en/portal/apps/new".
      "\n\n".
      "When creating your application, set up **User authentication settings**, use these settings:".
      "\n\n".
      "  - **Callback URL:** Set this to: `%s`".
      "\n\n".
      "After completing configuration, copy the **Client ID** and ".
      "**Client Secret** to the fields above.",
      $uri,
      $callback_uri);
  }

  protected function newOAuthAdapter() {
    return new PhutilTwitterAuthAdapter();
  }

  protected function getLoginIcon() {
    return 'Twitter';
  }

}
