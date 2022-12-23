<?php

final class DiscordLinkedRolesRenderController extends PhabricatorController {

  public function shouldAllowPublic() {
    return true;
  }

  public function handleRequest(AphrontRequest $request) {
    $user = $request->getUser();

    $app = id(new PhabricatorApplicationQuery())
      ->setViewer($user)
      ->withClasses(array('DiscordApplication'))
      ->executeOne();

    $crumbs = new PHUICrumbsView();
    $crumbs->addCrumb(id(new PHUICrumbView())
      ->setName($app->getName())
      ->setIcon($app->getIcon(), $app->isBrandIcon())
      ->setHref($app->getApplicationURI('/')));
    $crumbs->addCrumb(id(new PHUICrumbView())
      ->setName($this->getCurrentApplication()->getName())
      ->setIcon($this->getCurrentApplication()->getIcon(), $this->getCurrentApplication()->isBrandIcon())
      ->setHref($this->getApplicationURI('/')));
    $crumbs->addTextCrumb('Overview');

    $header = id(new PHUIHeaderView())
      ->setHeader(pht('Discord Linked Roles'))
      ->setSubheader(pht('Linked Roles module for Discord.'))
      ->setNoBackground(true)
      ->setHeaderIcon('fa-discord green', true);

    $info = id(new PHUIInfoView())
      ->setSeverity(PHUIInfoView::SEVERITY_WARNING)
      ->setTitle(pht('This module is WIP.'));

    $nav = id(new AphrontSideNavFilterView())
      ->setBaseUri(new PhutilURI($this->getApplicationURI('/')))
      ->setCrumbs($crumbs);

    $nav->addLabel(pht('Public'));
    $nav->addFilter('overview', pht('Overview'), $this->getApplicationURI('/'), 'fa-home', false);
    $nav->selectFilter('overview', 'overview');

    $curtain = id(new PHUICurtainView());

    $view = id(new AphrontMultiColumnView())
      ->setFluidLayout(true);

    $actionPanel1 = id(new PHUIBigInfoView())
    ->setDescription(pht('This is a module to control the linked roles metadata for users.'))
    ->setTitle(pht('About'));

    $view->addColumn($actionPanel1);

    $panel = $curtain->newPanel();
    $panel->appendChild($header);
    $panel->appendChild($info);

    $overview = id(new AphrontMultiColumnView())
    ->setFluidLayout(false);

    $headerPanel = id(new PHUICurtainPanelView())
    ->setHeaderText(pht('Current Data'));
    $overview->addColumn($headerPanel);

    $data = $this->getData($user);
    $test = id(new PHUIBigInfoView())
    ->setDescription(pht('Data: %s', $data));
    $overview->addColumn($test);

    $panel2 = $curtain->newPanel();
    $panel2->appendChild($view);
    $panel3 = $curtain->newPanel();
    $panel3->appendChild($overview);

    return $this->newPage()
      ->setTitle("Discord - Linked Roles")
      ->setCrumbs($crumbs)
      ->setNavigation($nav)
      ->setShowFooter(true)
      ->setShowChrome(true)
      ->appendChild($curtain)
      ->setDisableConsole(false);
  }

  private function getData(PhabricatorUser $user) {
    $fakeViewer = PhabricatorUser::getOmnipotentUser();
    $acc = id(new PhabricatorExternalAccountQuery())
      ->setViewer($fakeViewer)
      ->withUserPHIDs(array($user->getPHID()))
      //->withAccountTypes(array('discord'))
      ->needAccountIdentifiers(true)
      ->execute();
    return json_encode($acc);
  }
}
