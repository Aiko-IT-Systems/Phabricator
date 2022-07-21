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
      ->addBadge($admin)
      ->addBadge($verified)
      ->setTransactionPHID("PHID-RALI-dpwkupqrhtcolyeg5whj")
      ->addEventToGroup(
        id(new PHUITimelineEventView())
          ->setUser($user)
          ->setUserHandle($handleReporter)
          ->setAuthorPHID('PHID-USER-vjy7oaqj5fp5eqiehnbn')
          ->setTitle(pht('Comment on Raid'))
          ->appendChild(pht('Users spammed in dms with crypto scam.'))
      );

    $event2 = id(new PHUITimelineEventView())
      ->setUser($user)
      ->setUserHandle($handlerActor)
      ->setAuthorPHID('PHID-USER-gp4tppid6f65mnunhb53')
      ->setIcon('fa-hammer-crash')
      ->setTitle(pht('Handled Raid.'));

    $event->setUser($user);
    $event->setDateCreated(1658154600);
    $event->setAnchor(0);

    $event2->setUser($user);
    $event2->setDateCreated(1658154600 + 60 * 60 * 24);
    $event2->setAnchor(1);

    $timeline = id(new PHUITimelineView());
    $timeline->setUser($user);
    $timeline->addEvent($event);
    $timeline->addEvent($event2);

    return $timeline;
  }
}
