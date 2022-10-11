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

    $event = id(new PHUITimelineEventView())
      ->setUserHandle($handleReporter)
      ->setTitle(pht('Raid Report on %s', 'Pycord'))
      ->addBadge($admin)
      ->addBadge($verified)
      ->setReallyMajorEvent(true)
      ->setTransactionPHID("PHID-RALI-dpwkupqrhtcolyeg5whj");

    $event2 = id(new PHUITimelineEventView())
      ->setUserHandle($handlerActor)
      ->setAuthorPHID('PHID-USER-gp4tppid6f65mnunhb53')
      ->setIcon('fa-hammer-crash')
      ->setTitle(pht('Handled Raid.'))
      ->setTransactionPHID("PHID-RALI-dpwkupqrhtcolyeg5whj");


    $event3 = id(new PHUITimelineEventView())
      ->setUserHandle($handleReporter)
      ->setTitle(pht('Raid Report on %s', 'DisCatSharp'))
      ->addBadge($admin)
      ->addBadge($verified)
      ->setReallyMajorEvent(true)
      ->setTransactionPHID("PHID-RALI-dsadspaod9usa9odqwq");

    $event->setUser($user);
    $event->setDateCreated(1658154600);
    $event->setAnchor("PycordRaid-".$event->getDateCreated().'-'.$event->getTransactionPHID());

    $event2->setUser($user);
    $event2->setDateCreated(1658154600 + 60);
    $event2->setAnchor("PycordRaid-".$event->getDateCreated().'-'.$event->getTransactionPHID()."-handled");

    $event3->setUser($user);
    $event3->setDateCreated(1658154600 + 60 * 60 * 48);
    $event3->setAnchor("DcsRaid-".$event3->getDateCreated().'-'.$event3->getTransactionPHID());

    $timeline = id(new PHUITimelineView());
    $timeline->setUser($user);
    $timeline->addEvent($event);
    $timeline->addEvent($event2);
    $timeline->addEvent($event3);
    $timeline->setShouldTerminate(true);

    return $timeline;
  }
}
