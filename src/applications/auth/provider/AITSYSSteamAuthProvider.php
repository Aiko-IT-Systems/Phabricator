<?php

final class AITSYSSteamAuthProvider
  extends PhabricatorOAuth2AuthProvider {

  public function getProviderName() {
    return pht('Steam');
  }

  protected function getProviderConfigurationHelp() {
    $uri = PhabricatorEnv::getProductionURI('/auth/login/steam:steamcommunity.com/');
    $callback_uri = PhabricatorEnv::getURI($this->getLoginURI());
    $domain_uri = PhabricatorEnv::getProductionURI('/');
    $domain = id(new PhutilURI($domain_uri))->getDomain();

    return pht(
      "To configure Discord OAuth, create a new application here:".
      "\n\n".
      "https://discord.com/developers/applications".
      "\n\n".
      "When creating your application, use these settings:".
      "\n\n".
      "  - **Redirect URI**: Set this to: `%s`\n".
      "\n\n".
      "After completing configuration, copy the **Client ID** and ".
      "**Client Secret** to the fields above.".
      "\n\n".
      "Additionally you need a steam Web API Key which you can obtain here:".
      "\n\n".
      "https://steamcommunity.com/dev/apikey".
      "\n\n".
      "You have to set the **Domainname** to %s",
      $uri,
      $callback_uri,
      $domain);
  }

  protected function newOAuthAdapter() {
    return new AITSYSSteamAdapter();
  }

  protected function getLoginIcon() {
    return null;//'Steam';
  }

}
