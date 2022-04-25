<?php

final class AitsysBotControl extends AitsysManagement {

  public function getName() {
    return pht('Action Panel');
  }

  public function getDescription() {
    return pht('Test management page');
  }

  public function renderExample() {
    $viewer = $this->getRequest()->getUser();

    $view = id(new AphrontMultiColumnView())
      ->setFluidLayout(true);

    $panel1 = id(new PHUIActionPanelView())
      ->setIcon('fa-server')
      ->setHeader(pht('Control Servers'))
      ->setHref('#')
      ->setSubHeader(pht("VPS/Root Control."));
    $view->addColumn($panel1);

    $panel2 = id(new PHUIActionPanelView())
    ->setIcon('fa-bot')
      ->setHeader(pht('Manage Bots'))
      ->setHref('#')
      ->setSubHeader(pht('Discord Bot Control'));
    $view->addColumn($panel2);

    $view = phutil_tag_div('mlb', $view);

    return phutil_tag_div('ml', array($view));
  }
}
