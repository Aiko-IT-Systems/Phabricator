<?php

/**
 * This is a standard Phabricator page with menus, Javelin, DarkConsole, and
 * basic styles.
 */
final class PhabricatorStandardPageView extends PhabricatorBarePageView
  implements AphrontResponseProducerInterface {

  private $baseURI;
  private $applicationName;
  private $glyph;
  private $menuContent;
  private $showChrome = true;
  private $classes = array();
  private $disableConsole;
  private $pageObjects = array();
  private $applicationMenu;
  private $showFooter = true;
  private $showDurableColumn = true;
  private $quicksandConfig = array();
  private $tabs;
  private $crumbs;
  private $navigation;
  private $footer;
  private $pageDescription;
  private $pageImage;
  private $pageImageAlt;
  private $pageImageType;
  private $pageType = "website";
  private $profileSurname;
  private $profileLastname;
  private $profileUsername;

  public function setPageDescription($pageDescription) {
    $this->pageDescription = $pageDescription;
    return $this;
  }

  public function getPageDescription() {
    return $this->pageDescription;
  }

  public function setPageType($pageType) {
    $this->pageType = $pageType;
    return $this;
  }

  public function getPageType() {
    return $this->pageType;
  }

  public function setPageProfile($username, $surname = null, $lastname = null) {
    $this->profileUsername = $username;
    $this->profileSurname = $surname;
    $this->profileLastname = $lastname;
    return $this;
  }

  public function setPageImage($imgUrl, $imgAlt, $imgType = 'image/png') {
    $this->pageImage = $imgUrl;
    $this->pageImageAlt = $imgAlt;
    $this->pageImageType = $imgType;
    return $this;
  }

  public function setShowFooter($show_footer) {
    $this->showFooter = $show_footer;
    return $this;
  }

  public function getShowFooter() {
    return $this->showFooter;
  }

  public function setApplicationName($application_name) {
    $this->applicationName = $application_name;
    return $this;
  }

  public function setDisableConsole($disable) {
    $this->disableConsole = $disable;
    return $this;
  }

  public function getApplicationName() {
    return $this->applicationName;
  }

  public function setBaseURI($base_uri) {
    $this->baseURI = $base_uri;
    return $this;
  }

  public function getBaseURI() {
    return $this->baseURI;
  }

  public function setShowChrome($show_chrome) {
    $this->showChrome = $show_chrome;
    return $this;
  }

  public function getShowChrome() {
    return $this->showChrome;
  }

  public function addClass($class) {
    $this->classes[] = $class;
    return $this;
  }

  public function setPageObjectPHIDs(array $phids) {
    $this->pageObjects = $phids;
    return $this;
  }

  public function setShowDurableColumn($show) {
    $this->showDurableColumn = $show;
    return $this;
  }

  public function getShowDurableColumn() {
    $request = $this->getRequest();
    if (!$request) {
      return false;
    }

    $viewer = $request->getUser();
    if (!$viewer->isLoggedIn()) {
      return false;
    }

    $conpherence_installed = PhabricatorApplication::isClassInstalledForViewer(
      'PhabricatorConpherenceApplication',
      $viewer);
    if (!$conpherence_installed) {
      return false;
    }

    if ($this->isQuicksandBlacklistURI()) {
      return false;
    }

    return true;
  }

  private function isQuicksandBlacklistURI() {
    $request = $this->getRequest();
    if (!$request) {
      return false;
    }

    $patterns = $this->getQuicksandURIPatternBlacklist();
    $path = $request->getRequestURI()->getPath();
    foreach ($patterns as $pattern) {
      if (preg_match('(^'.$pattern.'$)', $path)) {
        return true;
      }
    }
    return false;
  }

  public function getDurableColumnVisible() {
    $column_key = PhabricatorConpherenceColumnVisibleSetting::SETTINGKEY;
    return (bool)$this->getUserPreference($column_key, false);
  }

  public function getDurableColumnMinimize() {
    $column_key = PhabricatorConpherenceColumnMinimizeSetting::SETTINGKEY;
    return (bool)$this->getUserPreference($column_key, false);
  }

  public function addQuicksandConfig(array $config) {
    $this->quicksandConfig = $config + $this->quicksandConfig;
    return $this;
  }

  public function getQuicksandConfig() {
    return $this->quicksandConfig;
  }

  public function setCrumbs(PHUICrumbsView $crumbs) {
    $this->crumbs = $crumbs;
    return $this;
  }

  public function getCrumbs() {
    return $this->crumbs;
  }

  public function setTabs(PHUIListView $tabs) {
    $tabs->setType(PHUIListView::TABBAR_LIST);
    $tabs->addClass('phabricator-standard-page-tabs');
    $this->tabs = $tabs;
    return $this;
  }

  public function getTabs() {
    return $this->tabs;
  }

  public function setNavigation(AphrontSideNavFilterView $navigation) {
    $this->navigation = $navigation;
    return $this;
  }

  public function getNavigation() {
    return $this->navigation;
  }

  public function getTitle() {
    $glyph_key = PhabricatorTitleGlyphsSetting::SETTINGKEY;
    $glyph_on = PhabricatorTitleGlyphsSetting::VALUE_TITLE_GLYPHS;
    $glyph_setting = $this->getUserPreference($glyph_key, $glyph_on);

    $use_glyph = ($glyph_setting == $glyph_on);

    $title = parent::getTitle().' | '.$this->getCustomTitle();

    $prefix = null;
    if ($use_glyph) {
      $prefix = $this->getGlyph();
    } else {
      $application_name = $this->getApplicationName();
      if (strlen($application_name)) {
        $prefix = '['.$application_name.']';
      }
    }

    if (strlen($prefix)) {
      $title = $prefix.' '.$title;
    }

    return $title;
  }


  protected function willRenderPage() {
    $footer = $this->renderFooter();

    // NOTE: A cleaner solution would be to let body layout elements implement
    // some kind of "LayoutInterface" so content can be embedded inside frames,
    // but there's only really one use case for this for now.
    $children = $this->renderChildren();
    if ($children) {
      $layout = head($children);
      if ($layout instanceof PHUIFormationView) {
        $layout->setFooter($footer);
        $footer = null;
      }
    }

    $this->footer = $footer;

    parent::willRenderPage();

    if (!$this->getRequest()) {
      throw new Exception(
        pht(
          'You must set the %s to render a %s.',
          'Request',
          __CLASS__));
    }

    $console = $this->getConsole();

    require_celerity_resource('phabricator-core-css');
    require_celerity_resource('phabricator-zindex-css');
    require_celerity_resource('phui-button-css');
    require_celerity_resource('phui-spacing-css');
    require_celerity_resource('phui-form-css');
    require_celerity_resource('phabricator-standard-page-view');
    require_celerity_resource('conpherence-durable-column-view');
    require_celerity_resource('font-lato');

    Javelin::initBehavior('workflow', array());

    $request = $this->getRequest();
    $user = null;
    if ($request) {
      $user = $request->getUser();
    }

    if ($user) {
      if ($user->isUserActivated()) {
        $offset = $user->getTimeZoneOffset();

        $ignore_key = PhabricatorTimezoneIgnoreOffsetSetting::SETTINGKEY;
        $ignore = $user->getUserSetting($ignore_key);

        Javelin::initBehavior(
          'detect-timezone',
          array(
            'offset' => $offset,
            'uri' => '/settings/timezone/',
            'message' => pht(
              'Your browser timezone setting differs from the timezone '.
              'setting in your profile, click to reconcile.'),
            'ignoreKey' => $ignore_key,
            'ignore' => $ignore,
          ));

        if ($user->getIsAdmin()) {
          $server_https = $request->isHTTPS();
          $server_protocol = $server_https ? 'HTTPS' : 'HTTP';
          $client_protocol = $server_https ? 'HTTP' : 'HTTPS';

          $doc_name = 'Configuring a Preamble Script';
          $doc_href = PhabricatorEnv::getDoclink($doc_name);

          Javelin::initBehavior(
            'setup-check-https',
            array(
              'server_https' => $server_https,
              'doc_name' => pht('See Documentation'),
              'doc_href' => $doc_href,
              'message' => pht(
                'Phabricator thinks you are using %s, but your '.
                'client is convinced that it is using %s. This is a serious '.
                'misconfiguration with subtle, but significant, consequences.',
                $server_protocol, $client_protocol),
            ));
        }
      }

      Javelin::initBehavior('lightbox-attachments');
    }

    Javelin::initBehavior('aphront-form-disable-on-submit');
    Javelin::initBehavior('toggle-class', array());
    Javelin::initBehavior('history-install');
    Javelin::initBehavior('phabricator-gesture');

    $current_token = null;
    if ($user) {
      $current_token = $user->getCSRFToken();
    }

    Javelin::initBehavior(
      'refresh-csrf',
      array(
        'tokenName' => AphrontRequest::getCSRFTokenName(),
        'header' => AphrontRequest::getCSRFHeaderName(),
        'viaHeader' => AphrontRequest::getViaHeaderName(),
        'current'   => $current_token,
      ));

    Javelin::initBehavior('device');

    Javelin::initBehavior(
      'high-security-warning',
      $this->getHighSecurityWarningConfig());

    if (PhabricatorEnv::isReadOnly()) {
      Javelin::initBehavior(
        'read-only-warning',
        array(
          'message' => PhabricatorEnv::getReadOnlyMessage(),
          'uri' => PhabricatorEnv::getReadOnlyURI(),
        ));
    }

    // If we aren't showing the page chrome, skip rendering DarkConsole and the
    // main menu, since they won't be visible on the page.
    if (!$this->getShowChrome()) {
      return;
    }

    if ($console) {
      require_celerity_resource('aphront-dark-console-css');

      $headers = array();
      if (DarkConsoleXHProfPluginAPI::isProfilerStarted()) {
        $headers[DarkConsoleXHProfPluginAPI::getProfilerHeader()] = 'page';
      }
      if (DarkConsoleServicesPlugin::isQueryAnalyzerRequested()) {
        $headers[DarkConsoleServicesPlugin::getQueryAnalyzerHeader()] = true;
      }

      Javelin::initBehavior(
        'dark-console',
        $this->getConsoleConfig());
    }

    if ($user) {
      $viewer = $user;
    } else {
      $viewer = new PhabricatorUser();
    }

    $menu = id(new PhabricatorMainMenuView())
      ->setUser($viewer);

    if ($this->getController()) {
      $menu->setController($this->getController());
    }

    $application_menu = $this->applicationMenu;
    if ($application_menu) {
      if ($application_menu instanceof PHUIApplicationMenuView) {
        $crumbs = $this->getCrumbs();
        if ($crumbs) {
          $application_menu->setCrumbs($crumbs);
        }

        $application_menu = $application_menu->buildListView();
      }

      $menu->setApplicationMenu($application_menu);
    }


    $this->menuContent = $menu->render();
  }


  protected function getHead() {
    $monospaced = null;

    $request = $this->getRequest();
    if ($request) {
      $user = $request->getUser();
      if ($user) {
        $monospaced = $user->getUserSetting(
          PhabricatorMonospacedFontSetting::SETTINGKEY);
      }
    }

    $response = CelerityAPI::getStaticResourceResponse();

    $font_css = null;
    if (!empty($monospaced)) {
      // We can't print this normally because escaping quotation marks will
      // break the CSS. Instead, filter it strictly and then mark it as safe.
      $monospaced = new PhutilSafeHTML(
        PhabricatorMonospacedFontSetting::filterMonospacedCSSRule(
          $monospaced));

      $font_css = hsprintf(
        '<style type="text/css">'.
        '.PhabricatorMonospaced, '.
        '.phabricator-remarkup .remarkup-code-block '.
          '.remarkup-code { font: %s !important; } '.
        '</style>',
        $monospaced);
    }

    $desc = $this->getPageDescription();
    if ($desc == null) {
      $desc = $this->getDescription();
    }

    $description = phutil_tag(
      'meta',
      array(
        'name' => 'description',
        'content' => $desc,
      ));

    $ogDescription = phutil_tag(
      'meta',
      array(
        'property' => 'og:description',
        'content' => $desc,
      ));

    $ogTitle = phutil_tag(
      'meta',
      array(
        'property' => 'og:title',
        'content' => $this->getTitle(),
      ));

    $ogType = phutil_tag(
      'meta',
      array(
        'property' => 'og:type',
        'content' => $this->getPageType(),
      ));

    $ogLocale = phutil_tag(
      'meta',
      array(
        'property' => 'og:locale',
        'content' => 'en_US',
      ));

    $twDomain = phutil_tag(
      'meta',
      array(
        'property' => 'twitter:domain',
        'content' => parent::getRequest()->getHost(),
      ));

    $image = null;
    $imageAlt = null;
    $twImage = null;
    $imageType = null;
    if ($this->pageImage != null) {
      $image = phutil_tag(
        'meta',
        array(
          'property' => 'og:image',
          'content' => $this->pageImage,
        ));

      $imageAlt = phutil_tag(
        'meta',
        array(
          'property' => 'og:image:alt',
          'content' => $this->pageImageAlt,
        ));

      $imageType = phutil_tag(
        'meta',
        array(
          'property' => 'og:image:type',
          'content' => $this->pageImageType,
        ));

      $twImage = phutil_tag(
        'meta',
        array(
          'property' => 'twitter:image',
          'content' => $this->pageImage,
        ));
    } else {
      $image = phutil_tag(
        'meta',
        array(
          'property' => 'og:image',
          'content' => $this->getOgLogo(),
        ));

      $imageAlt = phutil_tag(
        'meta',
        array(
          'property' => 'og:image:alt',
          'content' => 'Logo',
        ));

      $imageType = phutil_tag(
        'meta',
        array(
          'property' => 'og:image:type',
          'content' => 'image/png',
        ));

      $twImage = phutil_tag(
        'meta',
        array(
          'property' => 'twitter:image',
          'content' => $this->getOgLogo(),
        ));
    }

    $profileU = null;
    if ($this->pageType == 'profile') {
      $profileU = phutil_tag(
        'meta',
        array(
          'property' => 'profile:username',
          'content' => $this->profileUsername,
        ));
    }

    $siteName = phutil_tag(
      'meta',
      array(
        'property' => 'og:site_name',
        'content' => 'AITSYS Phabricator',
      ));

    $ogUrl = phutil_tag(
      'meta',
      array(
        'property' => 'og:url',
        'content' => parent::getRequest()->getUrl(),
      ));

    $twUrl = phutil_tag(
      'meta',
      array(
        'property' => 'twitter:url',
        'content' => parent::getRequest()->getUrl(),
      ));

    $twDescription = phutil_tag(
      'meta',
      array(
        'property' => 'twitter:description',
        'content' => $desc,
      ));

    $twCard = phutil_tag(
      'meta',
      array(
        'property' => 'twitter:card',
        'content' => 'summary_large_image',
      ));

    $twTitle = phutil_tag(
      'meta',
      array(
        'property' => 'twitter:title',
        'content' => $this->getTitle(),
      ));
/*
og:type article

    article:published_time - datetime - When the article was first published.
    article:modified_time - datetime - When the article was last changed.
    article:expiration_time - datetime - When the article is out of date after.
    article:author - profile array - Writers of the article.
    article:section - string - A high-level section name. E.g. Technology
    article:tag - string array - Tag words associated with this article.


TODO:
<meta property="og:image:type" content="image/png">
*/

    return hsprintf(
      '%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s',
      parent::getHead(),
      $font_css,
      $siteName,
      $description,
      $ogTitle,
      $ogUrl,
      $ogDescription,
      $ogType,
      $ogLocale,
      $image,
      $imageAlt,
      $imageType,
      $profileU,
      $twCard,
      $twUrl,
      $twDomain,
      $twTitle,
      $twDescription,
      $twImage,
      $response->renderSingleResource('javelin-magical-init', 'phabricator'));
  }

  private function getPhabricatorLogo() {
    $custom_header = PhabricatorCustomLogoConfigType::getLogoImagePHID();

    if ($custom_header) {
      $cache = PhabricatorCaches::getImmutableCache();
      $cache_key_logo = 'ui.custom-header.logo-phid.v3.'.$custom_header;

      $logo_uri = $cache->getKey($cache_key_logo);
      if (!$logo_uri) {
        // NOTE: If the file policy has been changed to be restrictive, we'll
        // miss here and just show the default logo. The cache will fill later
        // when someone who can see the file loads the page. This might be a
        // little spooky, see T11982.
        $files = id(new PhabricatorFileQuery())
          ->setViewer($this->getViewer())
          ->withPHIDs(array($custom_header))
          ->execute();
        $file = head($files);
        if ($file) {
          $logo_uri = $file->getViewURI();
          $cache->setKey($cache_key_logo, $logo_uri);
        }
      }
      return $logo_uri;
    } else {
      return null;
    }
  }

  private function getDescription() {
    if (parent::getController() == null)
      return "404";
    $appName = parent::getController()->getCurrentApplication()->getName();
    $shortDescription = parent::getController()->getCurrentApplication()->getShortDescription();
    return $appName.' - '.$shortDescription;
  }

  private function getCustomTitle() {
    $title = PhabricatorCustomSiteTitleConfigType::getSiteTitle();
    if ($title != null && $title != '') {
      return $title;
    } else{
      return "Phabricator";
    }
  }

  private function getOgLogo() {
    $custom_header = PhabricatorCustomSiteTitleConfigType::getOgLogoImagePHID();

    if ($custom_header) {
      $cache = PhabricatorCaches::getImmutableCache();
      $cache_key_logo = 'ui.custom-site-title.og-logo-phid.v3.'.$custom_header;

      $logo_uri = $cache->getKey($cache_key_logo);
      if (!$logo_uri) {
        // NOTE: If the file policy has been changed to be restrictive, we'll
        // miss here and just show the default logo. The cache will fill later
        // when someone who can see the file loads the page. This might be a
        // little spooky, see T11982.
        $files = id(new PhabricatorFileQuery())
          ->setViewer($this->getViewer())
          ->withPHIDs(array($custom_header))
          ->execute();
        $file = head($files);
        if ($file) {
          $logo_uri = $file->getViewURI();
          $cache->setKey($cache_key_logo, $logo_uri);
        }
      }
      return $logo_uri;
    } else {
      return $this->getPhabricatorLogo();
    }
  }

  public function setGlyph($glyph) {
    $this->glyph = $glyph;
    return $this;
  }

  public function getGlyph() {
    return $this->glyph;
  }

  protected function willSendResponse($response) {
    $request = $this->getRequest();
    $response = parent::willSendResponse($response);

    $console = $request->getApplicationConfiguration()->getConsole();

    if ($console) {
      $response = PhutilSafeHTML::applyFunction(
        'str_replace',
        hsprintf('<darkconsole />'),
        $console->render($request),
        $response);
    }

    return $response;
  }

  protected function getBody() {
    $user = null;
    $request = $this->getRequest();
    if ($request) {
      $user = $request->getUser();
    }

    $header_chrome = null;
    if ($this->getShowChrome()) {
      $header_chrome = $this->menuContent;
    }

    $classes = array();
    $classes[] = 'main-page-frame';
    $developer_warning = null;
    if (PhabricatorEnv::getEnvConfig('phabricator.developer-mode') &&
        DarkConsoleErrorLogPluginAPI::getErrors()) {
      $developer_warning = phutil_tag_div(
        'aphront-developer-error-callout',
        pht(
          'This page raised PHP errors. Find them in DarkConsole '.
          'or the error log.'));
    }

    $main_page = phutil_tag(
      'div',
      array(
        'id' => 'phabricator-standard-page',
        'class' => 'phabricator-standard-page',
      ),
      array(
        $developer_warning,
        $header_chrome,
        phutil_tag(
          'div',
          array(
            'id' => 'phabricator-standard-page-body',
            'class' => 'phabricator-standard-page-body',
          ),
          $this->renderPageBodyContent()),
      ));

    $durable_column = null;
    if ($this->getShowDurableColumn()) {
      $is_visible = $this->getDurableColumnVisible();
      $is_minimize = $this->getDurableColumnMinimize();
      $durable_column = id(new ConpherenceDurableColumnView())
        ->setSelectedConpherence(null)
        ->setUser($user)
        ->setQuicksandConfig($this->buildQuicksandConfig())
        ->setVisible($is_visible)
        ->setMinimize($is_minimize)
        ->setInitialLoad(true);
      if ($is_minimize) {
        $this->classes[] = 'minimize-column';
      }
    }

    Javelin::initBehavior('quicksand-blacklist', array(
      'patterns' => $this->getQuicksandURIPatternBlacklist(),
    ));

    return phutil_tag(
      'div',
      array(
        'class' => implode(' ', $classes),
        'id' => 'main-page-frame',
      ),
      array(
        $main_page,
        $durable_column,
      ));
  }

  private function renderPageBodyContent() {
    $console = $this->getConsole();

    $body = parent::getBody();

    $nav = $this->getNavigation();
    $tabs = $this->getTabs();
    if ($nav) {
      $crumbs = $this->getCrumbs();
      if ($crumbs) {
        $nav->setCrumbs($crumbs);
      }
      $nav->appendChild($body);
      $nav->appendFooter($this->footer);
      $content = phutil_implode_html('', array($nav->render()));
    } else {
      $content = array();

      $crumbs = $this->getCrumbs();
      if ($crumbs) {
        if ($this->getTabs()) {
          $crumbs->setBorder(true);
        }
        $content[] = $crumbs;
      }

      $tabs = $this->getTabs();
      if ($tabs) {
        $content[] = $tabs;
      }

      $content[] = $body;
      $content[] = $this->footer;

      $content = phutil_implode_html('', $content);
    }

    return array(
      ($console ? hsprintf('<darkconsole />') : null),
      $content,
    );
  }

  protected function getTail() {
    $request = $this->getRequest();
    $user = $request->getUser();

    $tail = array(
      parent::getTail(),
    );

    $response = CelerityAPI::getStaticResourceResponse();

    if ($request->isHTTPS()) {
      $with_protocol = 'https';
    } else {
      $with_protocol = 'http';
    }

    $servers = PhabricatorNotificationServerRef::getEnabledClientServers(
      $with_protocol);

    if ($servers) {
      if ($user && $user->isLoggedIn()) {
        // TODO: We could tell the browser about all the servers and let it
        // do random reconnects to improve reliability.
        shuffle($servers);
        $server = head($servers);

        $client_uri = $server->getWebsocketURI();

        Javelin::initBehavior(
          'aphlict-listen',
          array(
            'websocketURI' => (string)$client_uri,
          ) + $this->buildAphlictListenConfigData());

        CelerityAPI::getStaticResourceResponse()
          ->addContentSecurityPolicyURI('connect-src', $client_uri);
      }
    }

    $tail[] = $response->renderHTMLFooter($this->getFrameable());

    return $tail;
  }

  protected function getBodyClasses() {
    $classes = array();

    if (!$this->getShowChrome()) {
      $classes[] = 'phabricator-chromeless-page';
    }

    $agent = AphrontRequest::getHTTPHeader('User-Agent');

    // Try to guess the device resolution based on UA strings to avoid a flash
    // of incorrectly-styled content.
    $device_guess = 'device-desktop';
    if (preg_match('@iPhone|iPod|(Android.*Chrome/[.0-9]* Mobile)@', $agent)) {
      $device_guess = 'device-phone device';
    } else if (preg_match('@iPad|(Android.*Chrome/)@', $agent)) {
      $device_guess = 'device-tablet device';
    }

    $classes[] = $device_guess;

    if (preg_match('@Windows@', $agent)) {
      $classes[] = 'platform-windows';
    } else if (preg_match('@Macintosh@', $agent)) {
      $classes[] = 'platform-mac';
    } else if (preg_match('@X11@', $agent)) {
      $classes[] = 'platform-linux';
    }

    if ($this->getRequest()->getStr('__print__')) {
      $classes[] = 'printable';
    }

    if ($this->getRequest()->getStr('__aural__')) {
      $classes[] = 'audible';
    }

    $classes[] = 'phui-theme-'.PhabricatorEnv::getEnvConfig('ui.header-color');
    foreach ($this->classes as $class) {
      $classes[] = $class;
    }

    return implode(' ', $classes);
  }

  private function getConsole() {
    if ($this->disableConsole) {
      return null;
    }
    return $this->getRequest()->getApplicationConfiguration()->getConsole();
  }

  private function getConsoleConfig() {
    $user = $this->getRequest()->getUser();

    $headers = array();
    if (DarkConsoleXHProfPluginAPI::isProfilerStarted()) {
      $headers[DarkConsoleXHProfPluginAPI::getProfilerHeader()] = 'page';
    }
    if (DarkConsoleServicesPlugin::isQueryAnalyzerRequested()) {
      $headers[DarkConsoleServicesPlugin::getQueryAnalyzerHeader()] = true;
    }

    if ($user) {
      $setting_tab = PhabricatorDarkConsoleTabSetting::SETTINGKEY;
      $setting_visible = PhabricatorDarkConsoleVisibleSetting::SETTINGKEY;
      $tab = $user->getUserSetting($setting_tab);
      $visible = $user->getUserSetting($setting_visible);
    } else {
      $tab = null;
      $visible = true;
    }

    return array(
      // NOTE: We use a generic label here to prevent input reflection
      // and mitigate compression attacks like BREACH. See discussion in
      // T3684.
      'uri' => pht('Main Request'),
      'selected' => $tab,
      'visible'  => $visible,
      'headers' => $headers,
    );
  }

  private function getHighSecurityWarningConfig() {
    $user = $this->getRequest()->getUser();

    $show = false;
    if ($user->hasSession()) {
      $hisec = ($user->getSession()->getHighSecurityUntil() - time());
      if ($hisec > 0) {
        $show = true;
      }
    }

    return array(
      'show' => $show,
      'uri' => '/auth/session/downgrade/',
      'message' => pht(
        'Your session is in high security mode. When you '.
        'finish using it, click here to leave.'),
        );
  }

  private function renderFooter() {
    if (!$this->getShowChrome()) {
      return null;
    }

    if (!$this->getShowFooter()) {
      return null;
    }

    $items = PhabricatorEnv::getEnvConfig('ui.footer-items');
    if (!$items) {
      return null;
    }

    $foot = array();
    foreach ($items as $item) {
      $name = idx($item, 'name', pht('Unnamed Footer Item'));

      $href = idx($item, 'href');
      if (!PhabricatorEnv::isValidURIForLink($href)) {
        $href = null;
      }

      if ($href !== null) {
        $tag = 'a';
      } else {
        $tag = 'span';
      }

      $foot[] = phutil_tag(
        $tag,
        array(
          'href' => $href,
        ),
        $name);
    }
    $foot = phutil_implode_html(" \xC2\xB7 ", $foot);

    return phutil_tag(
      'div',
      array(
        'class' => 'phabricator-standard-page-footer grouped',
      ),
      $foot);
  }

  public function renderForQuicksand() {
    parent::willRenderPage();
    $response = $this->renderPageBodyContent();
    $response = $this->willSendResponse($response);

    $extra_config = $this->getQuicksandConfig();

    return array(
      'content' => hsprintf('%s', $response),
    ) + $this->buildQuicksandConfig()
      + $extra_config;
  }

  private function buildQuicksandConfig() {
    $viewer = $this->getRequest()->getUser();
    $controller = $this->getController();

    $dropdown_query = id(new AphlictDropdownDataQuery())
      ->setViewer($viewer);
    $dropdown_query->execute();

    $hisec_warning_config = $this->getHighSecurityWarningConfig();

    $console_config = null;
    $console = $this->getConsole();
    if ($console) {
      $console_config = $this->getConsoleConfig();
    }

    $upload_enabled = false;
    if ($controller) {
      $upload_enabled = $controller->isGlobalDragAndDropUploadEnabled();
    }

    $application_class = null;
    $application_search_icon = null;
    $application_help = null;
    $controller = $this->getController();
    if ($controller) {
      $application = $controller->getCurrentApplication();
      if ($application) {
        $application_class = get_class($application);
        if ($application->getApplicationSearchDocumentTypes()) {
          $application_search_icon = $application->getIcon();
        }

        $help_items = $application->getHelpMenuItems($viewer);
        if ($help_items) {
          $help_list = id(new PhabricatorActionListView())
            ->setViewer($viewer);
          foreach ($help_items as $help_item) {
            $help_list->addAction($help_item);
          }
          $application_help = $help_list->getDropdownMenuMetadata();
        }
      }
    }

    return array(
      'title' => $this->getTitle(),
      'bodyClasses' => $this->getBodyClasses(),
      'aphlictDropdownData' => array(
        $dropdown_query->getNotificationData(),
        $dropdown_query->getConpherenceData(),
      ),
      'globalDragAndDrop' => $upload_enabled,
      'hisecWarningConfig' => $hisec_warning_config,
      'consoleConfig' => $console_config,
      'applicationClass' => $application_class,
      'applicationSearchIcon' => $application_search_icon,
      'helpItems' => $application_help,
    ) + $this->buildAphlictListenConfigData();
  }

  private function buildAphlictListenConfigData() {
    $user = $this->getRequest()->getUser();
    $subscriptions = $this->pageObjects;
    $subscriptions[] = $user->getPHID();

    return array(
      'pageObjects'   => array_fill_keys($this->pageObjects, true),
      'subscriptions' => $subscriptions,
    );
  }

  private function getQuicksandURIPatternBlacklist() {
    $applications = PhabricatorApplication::getAllApplications();

    $blacklist = array();
    foreach ($applications as $application) {
      $blacklist[] = $application->getQuicksandURIPatternBlacklist();
    }

    // See T4340. Currently, Phortune and Auth both require pulling in external
    // Javascript (for Stripe card management and Recaptcha, respectively).
    // This can put us in a position where the user loads a page with a
    // restrictive Content-Security-Policy, then uses Quicksand to navigate to
    // a page which needs to load external scripts. For now, just blacklist
    // these entire applications since we aren't giving up anything
    // significant by doing so.

    $blacklist[] = array(
      '/phortune/.*',
      '/auth/.*',
    );

    return array_mergev($blacklist);
  }

  private function getUserPreference($key, $default = null) {
    $request = $this->getRequest();
    if (!$request) {
      return $default;
    }

    $user = $request->getUser();
    if (!$user) {
      return $default;
    }

    return $user->getUserSetting($key);
  }

  public function produceAphrontResponse() {
    $controller = $this->getController();

    $viewer = $this->getUser();
    if ($viewer && $viewer->getPHID()) {
      $object_phids = $this->pageObjects;
      foreach ($object_phids as $object_phid) {
        PhabricatorFeedStoryNotification::updateObjectNotificationViews(
          $viewer,
          $object_phid);
      }
    }

    if ($this->getRequest()->isQuicksand()) {
      $content = $this->renderForQuicksand();
      $response = id(new AphrontAjaxResponse())
        ->setContent($content);
    } else {
      // See T13247. Try to find some navigational menu items to create a
      // mobile navigation menu from.
      $application_menu = $controller->buildApplicationMenu();
      if (!$application_menu) {
        $navigation = $this->getNavigation();
        if ($navigation) {
          $application_menu = $navigation->getMenu();
        }
      }
      $this->applicationMenu = $application_menu;

      $content = $this->render();

      $response = id(new AphrontWebpageResponse())
        ->setContent($content)
        ->setFrameable($this->getFrameable());
    }

    return $response;
  }

}
