<?php

final class DiscordAntiRaidRenderUIController extends PhabricatorController {

  public function shouldAllowPublic() {
    return true;
  }

  public function handleRequest(AphrontRequest $request) {
    $id = $request->getURIData('class');
    $user = $request->getUser();

    $classes = id(new PhutilClassMapQuery())
      ->setAncestorClass('DiscordAntiRaidUI')
      ->setSortMethod('getName')
      ->execute();

    $nav = id(new AphrontSideNavFilterView())
    ->setBaseUri(new PhutilURI($this->getApplicationURI('/')));
    $nav->addLabel(pht('Public'));
    $nav->addFilter('main', pht('Main'), $this->getApplicationURI('/'), 'fa-shield', false);
    $nav->addFilter('history', pht('History'), $this->getApplicationURI('/history'), 'fa-clock-rotate-left', false);
    $selected = $nav->selectFilter(pht('History'));

    $example = $classes["HistoricalRaidTimeline"];
    $example->setRequest($this->getRequest());

    $result = $example->renderExample();
    if ($result instanceof AphrontResponse) {
      // This allows examples to generate dialogs, etc., for demonstration.
      return $result;
    }

    require_celerity_resource('phabricator-ui-example-css');

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
    $crumbs->addTextCrumb($example->getName());

    $note = id(new PHUIInfoView())
      ->setTitle(pht('%s (%s)', $example->getName(), get_class($example)))
      ->appendChild($example->getDescription())
      ->setSeverity(PHUIInfoView::SEVERITY_NODATA);

    $nav->appendChild(
      array(
        $crumbs,
        $note,
        $result,
      ));

    return $this->newPage()
      ->setTitle($example->getName())
      ->appendChild($nav);
  }

}
