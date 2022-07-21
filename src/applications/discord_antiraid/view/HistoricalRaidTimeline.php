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
      ->setTitle(pht('Raid Report'))
      ->appendChild(pht('Server: %s', 'Pycord'))
      ->addBadge($admin)
      ->addBadge($verified)
      ->setTransactionPHID("PHID-RALI-dpwkupqrhtcolyeg5whj");


    id(new PHUITimelineEventView())
      ->setIsNormalComment(true)
      ->setIsEditable(true)
      ->setCanInteract(true)
      ->setUserHandle($handleReporter)
      ->setTitle(pht('Comment on Raid'))
      ->appendChild(pht('Users spammed in dms with crypto scam.'))
      ->addEventToGroup($event);

    id(new PHUITimelineEventView())
      ->setUserHandle($handlerActor)
      ->setIcon('fa-hammer-crash')
      ->setTitle(pht('Handled Raid.'))
      ->addEventToGroup($event);


    $anchor = 0;

    $event->setUser($user);
    $event->setDateCreated(1658154600);
    $event->setAnchor(++$anchor);

    $timeline = id(new PHUITimelineView());
    $timeline->setUser($user);
    $timeline->addEvent($event);

    return $timeline;
  }
}
