<?php
final class HistoricalRaidTimeline extends DiscordAntiRaidUI {

  public function getName() {
    return pht('History');
  }

  public function getDescription() {
    return pht('Historical Raid Timeline');
  }

  public function renderExample() {
    $request = $this->getRequest();
    $user = $request->getUser();

    $handleReporter = id(new PhabricatorHandleQuery())
      ->setViewer($user)
      ->withPHIDs(array('PHID-USER-vjy7oaqj5fp5eqiehnbn'))
      ->executeOne();
    $handlerActor = id(new PhabricatorHandleQuery())
      ->setViewer($user)
      ->withPHIDs(array('PHID-USER-gp4tppid6f65mnunhb53'))
      ->executeOne();

    $admin = id(new PHUIBadgeMiniView())
      ->setIcon('fa-user')
      ->setHeader(pht('Administrator'))
      ->setQuality(PhabricatorBadgesQuality::HEIRLOOM);

    $verified = id(new PHUIBadgeMiniView())
      ->setIcon('fa-star')
      ->setHeader(pht('Verified'))
      ->setQuality(PhabricatorBadgesQuality::EPIC);

    $events = array();

    $events[] = id(new PHUITimelineEventView())
      ->setUserHandle($handleReporter)
      ->setTitle(pht('Raid Report'))
      ->appendChild(pht('Raid happened suddenly, users spammed in dms with crypto scam.'))
      ->addBadge($admin)
      ->addBadge($verified)
      ->addPinboardItem(
        id(new PHUIPinboardItemView())
          ->setUser($user)
          ->setImageSize(128, 128)
          ->setHeader("Guild: Pycord")
          ->setURI("https://discord.gg/pycord")
          ->setImageURI("https://cdn.discordapp.com/icons/881207955029110855/a_4fe704fc022c0ebaa8077c0c89f59840.jpg")
      )
      ->setTransactionPHID("PHID-RALI-dpwkupqrhtcolyeg5whj");

    $events[] = id(new PHUITimelineEventView())
      ->setUserHandle($handlerActor)
      ->setIcon('fa-hammer-crash')
      ->setTitle(pht('Handled Raid.'));


    $anchor = 0;
    foreach ($events as $group) {
      foreach ($group->getEventGroup() as $event) {
        $event->setUser($user);
        $event->setDateCreated(1658154600 + ($anchor * 60 * 8));
        $event->setAnchor(++$anchor);
      }
    }

    $timeline = id(new PHUITimelineView());
    $timeline->setUser($user);
    foreach ($events as $event) {
      $timeline->addEvent($event);
    }

    return $timeline;
  }
}
