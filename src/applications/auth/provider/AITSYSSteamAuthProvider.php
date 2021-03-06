<?php

final class AITSYSSteamAuthProvider
  extends PhabricatorOAuth2AuthProvider {

  const PROPERTY_APP_WEBAPI_KEY = 'oauth:app:webapi';

  public function getProviderName() {
    return pht('Steam');
  }

  protected function getProviderConfigurationHelp() {
    $uri = PhabricatorEnv::getProductionURI('/auth/login/steam:steamcommunity.com/');
    $callback_uri = PhabricatorEnv::getURI($this->getLoginURI());
    $domain_uri = PhabricatorEnv::getProductionURI('/');
    $domain = id(new PhutilURI($domain_uri))->getDomain();

    return pht(
      "To configure Steam OAuth, create a new application here:".
      "\n\n".
      "https://partner.steamgames.com/apps/".
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
    return 'Steam';
  }

  protected function getWebapiKey() {
    return self::PROPERTY_APP_WEBAPI_KEY;
  }

  public function readFormValuesFromProvider() {
    $config = $this->getProviderConfig();
    $note = $config->getProperty(self::PROPERTY_NOTE);
    $webapi_key = $config->getProperty($this->getWebapiKey());

    return array(
      $this->getIDKey()     => "Unused",
      $this->getSecretKey() => "Unused",
      self::PROPERTY_NOTE   => $note,
      $this->getWebapiKey() => $webapi_key,
    );
  }

  public function readFormValuesFromRequest(AphrontRequest $request) {
    return array(
      $this->getIDKey()     => "Unused",
      $this->getSecretKey() => "Unused",
      self::PROPERTY_NOTE   => $request->getStr(self::PROPERTY_NOTE),
      $this->getWebapiKey() => $request->getStr($this->getWebapiKey()),
    );
  }

  public function processEditForm(
    AphrontRequest $request,
    array $values) {

    return $this->processOAuthEditForm(
      $request,
      $values,
      pht('Application ID is not required.'),
      pht('Application secret is not required.'),
      pht('Application web api key is required.'));
  }

  public function extendEditForm(
    AphrontRequest $request,
    AphrontFormView $form,
    array $values,
    array $issues) {

    $webapi_key = $this->getWebapiKey();

    $v_webapi_key = $values[$webapi_key];

    $e_webapi_key = idx($issues, $webapi_key, $request->isFormPost() ? null : true);

    $form
    ->appendChild(
      id(new AphrontFormPasswordControl())
        ->setLabel(pht('Steam Web API Key'))
        ->setDisableAutocomplete(true)
        ->setName($webapi_key)
        ->setValue($v_webapi_key)
        ->setError($e_webapi_key));


    $key_id = $this->getIDKey();
    $key_secret = $this->getSecretKey();
    $key_note = self::PROPERTY_NOTE;

    $values[$key_id] = "Unused";
    $values[$key_secret] = "Unused";

    return $this->extendOAuthEditForm(
      $request,
      $form,
      $values,
      $issues,
      pht('OAuth App ID (Unused)'),
      pht('OAuth App Secret (Unused)'));
  }

  public function renderConfigPropertyTransactionTitle(
    PhabricatorAuthProviderConfigTransaction $xaction) {

    $author_phid = $xaction->getAuthorPHID();
    $old = $xaction->getOldValue();
    $new = $xaction->getNewValue();
    $key = $xaction->getMetadataValue(
      PhabricatorAuthProviderConfigTransaction::PROPERTY_KEY);

    switch ($key) {
      case self::PROPERTY_APP_WEBAPI_KEY:
        if (strlen($old)) {
          return pht(
            '%s updated the Steam Web API Key for this provider.',
            $xaction->renderHandleLink($author_phid));
        } else {
          return pht(
            '%s set the OAuth Steam Web API Key for this provider.',
            $xaction->renderHandleLink($author_phid));
        }
      case self::PROPERTY_NOTE:
        if (strlen($old)) {
          return pht(
            '%s updated the OAuth application notes for this provider.',
            $xaction->renderHandleLink($author_phid));
        } else {
          return pht(
            '%s set the OAuth application notes for this provider.',
            $xaction->renderHandleLink($author_phid));
        }

    }

    return parent::renderConfigPropertyTransactionTitle($xaction);
  }
}
