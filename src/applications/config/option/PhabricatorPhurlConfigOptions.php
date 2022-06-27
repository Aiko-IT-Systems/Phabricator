<?php

final class PhabricatorPhurlConfigOptions
  extends PhabricatorApplicationConfigOptions {

  public function getName() {
    return pht('Phurl');
  }

  public function getDescription() {
    return pht('Options for Phurl.');
  }

  public function getIcon() {
    return 'fa-link';
  }

  public function getGroup() {
    return 'apps';
  }

  public function getOptions() {
    $uri = PhabricatorEnv::getEnvConfigIfExists('phabricator.base-uri', PhabricatorEnv::getRequestBaseURI());
    $domain = new PhutilURI($uri);
    $domain = phutil_utf8_strtolower($domain->getDomain());
    $phurlDomainsHelp = $this->deformat(pht(<<<EOTEXT
Set the domains that Phurl will use to share shortened URLs.

You may have to configure the domains in your DNS server to point to **%s**.
EOTEXT, $domain));
    $phurlDomainsExample = array('https://s.phurl.io', 'https://s.phurl.dev');
    $phurlDomainsExample = id(new PhutilJSON())->encodeAsList($phurlDomainsExample);

    return array(
      $this->newOption('phurl.short-uri', 'wild', array())
        ->setLocked(false)
        ->setSummary(pht('Domains that Phurl will use to shorten URLs.'))
        ->setDescription($phurlDomainsHelp)
        ->addExample($phurlDomainsExample, pht('Multi Domain Example')),
    );
  }
}
