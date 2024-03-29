<?php

final class PhabricatorUsersProfileViewController
  extends PhabricatorUsersProfileController {

  public function shouldAllowPublic() {
    return true;
  }

  public function handleRequest(AphrontRequest $request) {
    $viewer = $this->getViewer();
    $username = $request->getURIData('username');

    $user = id(new PhabricatorUsersQuery())
      ->setViewer($viewer)
      ->withUsernames(array($username))
      ->needProfileImage(true)
      ->needAvailability(true)
      ->executeOne();
    if (!$user) {
      return new Aphront404Response();
    }

    $this->setUser($user);
    $header = $this->buildProfileHeader();

    $properties = $this->buildPropertyView($user);
    $name = $user->getUsername();

    $feed = $this->buildUsersFeed($user, $viewer);

    $view_all = id(new PHUIButtonView())
      ->setTag('a')
      ->setIcon(
        id(new PHUIIconView())
          ->setIcon('fa-list-ul'))
      ->setText(pht('View All'))
      ->setHref('/feed/?userPHIDs='.$user->getPHID());

    $feed_header = id(new PHUIHeaderView())
      ->setHeader(pht('Recent Activity'))
      ->addActionLink($view_all);

    $feed = id(new PHUIObjectBoxView())
      ->setHeader($feed_header)
      ->addClass('project-view-feed')
      ->appendChild($feed);

    $projects = $this->buildProjectsView($user);
    $calendar = $this->buildCalendarDayView($user);

    $home = id(new PHUITwoColumnView())
      ->setHeader($header)
      ->addClass('project-view-home')
      ->addClass('project-view-users-home')
      ->setMainColumn(
        array(
          $properties,
          $feed,
        ))
      ->setSideColumn(
        array(
          $projects,
          $calendar,
        ));

    $navigation = $this->newNavigation(
      $user,
      PhabricatorUsersProfileMenuEngine::ITEM_PROFILE);

    $crumbs = $this->buildApplicationCrumbs();
    $crumbs->setBorder(true);

    $description = 'User profile of '.$user->getUsername().'.';
    $blurb = $user->getUserProfile()->getBlurb();
    if ($blurb != null && $blurb != '') {
      $description = $description."

Description:
".$blurb;
    }

    return $this->newPage()
      ->setTitle($user->getUsername())
      ->setNavigation($navigation)
      ->setCrumbs($crumbs)
      ->setPageType('profile')
      ->setPageProfile($user->getUsername())
      ->setPageImage($user->getProfileImageURI(), 'User Avatar')
      ->setPageDescription($description)
      ->setPageObjectPHIDs(
        array(
          $user->getPHID(),
        ))
      ->appendChild(
        array(
          $home,
        ));
  }

  private function loadExternalAccounts(PhabricatorUser $viewer, PhabricatorUser $user) {
    $anonymousViewer = PhabricatorUser::getOmnipotentUser();
    $accs = id(new PhabricatorExternalAccountQuery())
    ->setViewer($anonymousViewer)
    ->withUserPHIDs(array($user->getPHID()))
    ->withoutAccountTypes(array('password'))
    ->needAccountIdentifiers(true)
    ->execute();

    usort($accs, function($a, $b) {
      return strcmp($a->getProviderConfig()->getDisplayName(), $b->getProviderConfig()->getDisplayName());
    });

    return $accs;
  }

  private function buildPropertyView(
    PhabricatorUser $user) {

    $viewer = $this->getRequest()->getUser();
    $view = id(new PHUIPropertyListView())
      ->setUser($viewer)
      ->setObject($user);

    $field_list = PhabricatorCustomField::getObjectFields(
      $user,
      PhabricatorCustomField::ROLE_VIEW);
    $field_list->appendFieldsToPropertyList($user, $viewer, $view);

    $view->addSectionHeader("Linked Accounts");

    $externalAccounts = $this->loadExternalAccounts($viewer, $user);

    if ($externalAccounts) {
      foreach($externalAccounts as $externalAccount) {
        $uri = $externalAccount->getAccountUri();
        $name = $externalAccount->getUsername();
        $providerConfig = $externalAccount->getProviderConfig();
        $providerName = $providerConfig->getDisplayName();
        $providerIcon = str_replace('.', '-', strtolower($providerName));

        $icon = id(new PHUIIconView())
          ->setIcon('fa-'.$providerIcon, null, true);

        $link_view = id(new PHUILinkView())
          ->setURI($uri)
          ->setTarget('_blank')
          ->setText($name);
        $view->addProperty($icon, $link_view);
      }
    } else {
      $view->addProperty(
        null,
        phutil_tag(
          'em',
          array(),
          pht('No linked accounts.')));
    }

    if (!$view->hasAnyProperties()) {
      return null;
    }

    $header = id(new PHUIHeaderView())
      ->setHeader(pht('User Details'));

    $view = id(new PHUIObjectBoxView())
      ->appendChild($view)
      ->setHeader($header)
      ->setBackground(PHUIObjectBoxView::BLUE_PROPERTY)
      ->addClass('project-view-properties');

    return $view;
  }

  private function buildProjectsView(
    PhabricatorUser $user) {

    $viewer = $this->getViewer();
    $projects = id(new PhabricatorProjectQuery())
      ->setViewer($viewer)
      ->withMemberPHIDs(array($user->getPHID()))
      ->needImages(true)
      ->withStatuses(
        array(
          PhabricatorProjectStatus::STATUS_ACTIVE,
        ))
      ->execute();

    $header = id(new PHUIHeaderView())
      ->setHeader(pht('Projects'));

    if (!empty($projects)) {
      $limit = 5;
      $render_phids = array_slice($projects, 0, $limit);
      $list = id(new PhabricatorProjectListView())
        ->setUser($viewer)
        ->setProjects($render_phids);

      if (count($projects) > $limit) {
        $header_text = pht(
          'Projects (%s)',
          phutil_count($projects));

        $header = id(new PHUIHeaderView())
          ->setHeader($header_text)
          ->addActionLink(
            id(new PHUIButtonView())
              ->setTag('a')
              ->setIcon('fa-list-ul')
              ->setText(pht('View All'))
              ->setHref('/project/?member='.$user->getPHID()));

      }

    } else {
      $list = id(new PHUIInfoView())
        ->setSeverity(PHUIInfoView::SEVERITY_NODATA)
        ->appendChild(pht('User does not belong to any projects.'));
    }

    $box = id(new PHUIObjectBoxView())
      ->setHeader($header)
      ->appendChild($list)
      ->setBackground(PHUIObjectBoxView::BLUE_PROPERTY);

    return $box;
  }

  private function buildCalendarDayView(PhabricatorUser $user) {
    $viewer = $this->getViewer();
    $class = 'PhabricatorCalendarApplication';

    if (!PhabricatorApplication::isClassInstalledForViewer($class, $viewer)) {
      return null;
    }

    // Don't show calendar information for disabled users, since it's probably
    // not useful or accurate and may be misleading.
    if ($user->getIsDisabled()) {
      return null;
    }

    $midnight = PhabricatorTime::getTodayMidnightDateTime($viewer);
    $week_end = clone $midnight;
    $week_end = $week_end->modify('+3 days');

    $range_start = $midnight->format('U');
    $range_end = $week_end->format('U');

    $events = id(new PhabricatorCalendarEventQuery())
      ->setViewer($viewer)
      ->withDateRange($range_start, $range_end)
      ->withInvitedPHIDs(array($user->getPHID()))
      ->withIsCancelled(false)
      ->needRSVPs(array($viewer->getPHID()))
      ->execute();

    $event_views = array();
    foreach ($events as $event) {
      $viewer_is_invited = $event->isRSVPInvited($viewer->getPHID());

      $can_edit = PhabricatorPolicyFilter::hasCapability(
        $viewer,
        $event,
        PhabricatorPolicyCapability::CAN_EDIT);

      $epoch_min = $event->getStartDateTimeEpoch();
      $epoch_max = $event->getEndDateTimeEpoch();

      $event_view = id(new AphrontCalendarEventView())
        ->setCanEdit($can_edit)
        ->setEventID($event->getID())
        ->setEpochRange($epoch_min, $epoch_max)
        ->setIsAllDay($event->getIsAllDay())
        ->setIcon($event->getIcon())
        ->setViewerIsInvited($viewer_is_invited)
        ->setName($event->getName())
        ->setDatetimeSummary($event->renderEventDate($viewer, true))
        ->setURI($event->getURI());

      $event_views[] = $event_view;
    }

    $event_views = msort($event_views, 'getEpochStart');

    $day_view = id(new PHUICalendarWeekView())
      ->setViewer($viewer)
      ->setView('week')
      ->setEvents($event_views)
      ->setWeekLength(3)
      ->render();

    $header = id(new PHUIHeaderView())
      ->setHeader(pht('Calendar'))
      ->setHref(
        urisprintf(
          '/calendar/?invited=%s#R',
          $user->getUsername()));

    $box = id(new PHUIObjectBoxView())
      ->setHeader($header)
      ->appendChild($day_view)
      ->addClass('calendar-profile-box')
      ->setBackground(PHUIObjectBoxView::BLUE_PROPERTY);

    return $box;
  }

  private function buildUsersFeed(
    PhabricatorUser $user,
    $viewer) {

    $query = id(new PhabricatorFeedQuery())
      ->setViewer($viewer)
      ->withFilterPHIDs(array($user->getPHID()))
      ->setLimit(100)
      ->setReturnPartialResultsOnOverheat(true);

    $stories = $query->execute();

    $overheated_view = null;
    $is_overheated = $query->getIsOverheated();
    if ($is_overheated) {
      $overheated_message =
        PhabricatorApplicationSearchController::newOverheatedError(
          (bool)$stories);

      $overheated_view = id(new PHUIInfoView())
        ->setSeverity(PHUIInfoView::SEVERITY_WARNING)
        ->setTitle(pht('Query Overheated'))
        ->setErrors(
          array(
            $overheated_message,
          ));
    }

    $builder = new PhabricatorFeedBuilder($stories);
    $builder->setUser($viewer);
    $builder->setShowHovercards(true);
    $builder->setNoDataString(pht('To begin on such a grand journey, '.
      'requires but just a single step.'));
    $view = $builder->buildView();

    return array(
      $overheated_view,
      $view->render(),
    );
  }

}
