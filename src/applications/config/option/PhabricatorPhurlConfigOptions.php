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
    $phurlDomainsHelp = $this->deformat(pht(<<<EOREMARKUP
Set the domains that Phurl will use to share shortened URLs.

You may have to configure the domains in your DNS server to point to **%s**.
EOREMARKUP
    , $domain
    ));

    $phurlDomainsExample = array('https://s.'.$domain);
    $phurlDomainsExample = id(new PhutilJSON())->encodeAsList($phurlDomainsExample);

    $phurlMultiDomainsExample = array('https://s1.'.$domain, 'https://s2.'.$domain);
    $phurlMultiDomainsExample = id(new PhutilJSON())->encodeAsList($phurlMultiDomainsExample);

    return array(
      $this->newOption('phurl.short-uris', 'wild', array())
        ->setLocked(false)
        ->setSummary(pht('Domains that Phurl will use to shorten URLs.'))
        ->setDescription($phurlDomainsHelp)
        ->addExample($phurlDomainsExample, pht('Single Domain Example'))
        ->addExample($phurlMultiDomainsExample, pht('Multi Domain Example'))
    );
  }
}
