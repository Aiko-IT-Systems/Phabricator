<?php

final class AITSYSBattleNetAuthProvider
  extends PhabricatorOAuth2AuthProvider {

  public function getProviderName() {
    return pht('Battle.net');
  }

  protected function getProviderConfigurationHelp() {
    $uri = PhabricatorEnv::getProductionURI('/auth/login/bnet:blizzard.com/');
    $callback_uri = PhabricatorEnv::getURI($this->getLoginURI());

    return pht(
      "To configure Battle.net OAuth, create a new application here:".
      "\n\n".
      "https://develop.battle.net/access/clients/create".
      "\n\n".
      "When creating your application, use these settings:".
      "\n\n".
      "  - **Redirect URI**: Set this to: `%s`\n".
      "\n\n".
      "After completing configuration, copy the **Client ID** and ".
      "**Client Secret** to the fields above. (You may need to generate the ".
      "client secret by clicking 'Generate New Secret' first.)",
      $uri,
      $callback_uri);
  }

  protected function newOAuthAdapter() {
    return new AITSYSBattleNetAdapter();
  }

  protected function getLoginIcon() {
    return 'Discord';
  }

}
