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
      ->setSeverity(PHUIInfoView::SERVITY_WARNING)
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

    $actionPanel1 = id(new PHUIActionPanelView())
    //->setIcon('fa-users')
    ->setBigText(true)
    ->setHeader(pht('Current Participants'))
    ->setSubHeader(pht('1'));

    $actionPanel2 = id(new PHUIActionPanelView())
    //->setIcon('fa-server')
    ->setBigText(true)
    ->setHeader(pht('Servers'))
    ->setSubHeader(pht('2'));

    $actionPanel3 = id(new PHUIActionPanelView())
    //->setIcon('fa-user-robot')
    ->setBigText(true)
    ->setHeader(pht('Bots'))
    ->setSubHeader(pht('1'));

    $actionPanel4 = id(new PHUIActionPanelView())
    ->setIcon('fa-cloud-download')
    ->setHeader(pht('Download Raider List'))
    ->setHref($this->getApplicationURI('download/raiderlist/'))
    ->setSubHeader(pht('Need an offline version of the raider ids?'));


    $view->addColumn($actionPanel1);
    $view->addColumn($actionPanel2);
    $view->addColumn($actionPanel3);
    $view->addColumn($actionPanel4);

    $panel = $curtain->newPanel();
    $panel->appendChild($header);
    $panel->appendChild($info);


    $panel2 = $curtain->newPanel();
    $panel2->appendChild($view);

    return $this->newPage()
      ->setTitle("Discord - Anti-Raid")
      ->setCrumbs($crumbs)
      ->setNavigation($nav)
      ->setShowFooter(true)
      ->setShowChrome(true)
      ->appendChild($curtain)
      ->setDisableConsole(false);
  }

}
