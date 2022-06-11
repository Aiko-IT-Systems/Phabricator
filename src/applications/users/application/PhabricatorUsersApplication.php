<?php

final class PhabricatorUsersApplication extends PhabricatorApplication {

  public function getName() {
    return pht('Users');
  }

  public function getShortDescription() {
    return pht('User Accounts and Profiles');
  }

  public function getBaseURI() {
    return '/users/';
  }

  public function getTitleGlyph() {
    return "\xE2\x99\x9F";
  }

  public function getIcon() {
    return 'fa-users';
  }

  public function isPinnedByDefault(PhabricatorUser $viewer) {
    return $viewer->getIsAdmin();
  }

  public function getFlavorText() {
    return pht('Sort of a social utility.');
  }

  public function getApplicationGroup() {
    return self::GROUP_UTILITIES;
  }

  public function canUninstall() {
    return false;
  }

  public function getRoutes() {
    return array(
      '/users/' => array(
        $this->getQueryRoutePattern() => 'PhabricatorUsersListController',
        'logs/' => array(
          $this->getQueryRoutePattern() => 'PhabricatorUsersLogsController',
          '(?P<id>\d+)/' => 'PhabricatorUsersLogViewController',
        ),
        'invite/' => array(
          '(?:query/(?P<queryKey>[^/]+)/)?'
            => 'PhabricatorUsersInviteListController',
          'send/'
            => 'PhabricatorUsersInviteSendController',
        ),
        'approve/(?P<id>[1-9]\d*)/(?:via/(?P<via>[^/]+)/)?'
          => 'PhabricatorUsersApproveController',
        '(?P<via>disapprove)/(?P<id>[1-9]\d*)/'
          => 'PhabricatorUsersDisableController',
        '(?P<via>disable)/(?P<id>[1-9]\d*)/'
          => 'PhabricatorUsersDisableController',
        'empower/(?P<id>[1-9]\d*)/' => 'PhabricatorUsersEmpowerController',
        'delete/(?P<id>[1-9]\d*)/' => 'PhabricatorUsersDeleteController',
        'rename/(?P<id>[1-9]\d*)/' => 'PhabricatorUsersRenameController',
        'welcome/(?P<id>[1-9]\d*)/' => 'PhabricatorUsersWelcomeController',
        'create/' => 'PhabricatorUsersCreateController',
        'new/(?P<type>[^/]+)/' => 'PhabricatorUsersNewController',
        'editprofile/(?P<id>[1-9]\d*)/' =>
          'PhabricatorUsersProfileEditController',
        'badges/(?P<id>[1-9]\d*)/' =>
          'PhabricatorUsersProfileBadgesController',
        'tasks/(?P<id>[1-9]\d*)/' =>
          'PhabricatorUsersProfileTasksController',
        'commits/(?P<id>[1-9]\d*)/' =>
          'PhabricatorUsersProfileCommitsController',
        'revisions/(?P<id>[1-9]\d*)/' =>
          'PhabricatorUsersProfileRevisionsController',
        'picture/(?P<id>[1-9]\d*)/' =>
          'PhabricatorUsersProfilePictureController',
        'manage/(?P<id>[1-9]\d*)/' =>
          'PhabricatorUsersProfileManageController',
      ),
      '/p/(?P<username>[\w._-]+)/' => array(
        '' => 'PhabricatorUsersProfileViewController',
      ),
    );
  }

  public function getRemarkupRules() {
    return array(
      new PhabricatorMentionRemarkupRule(),
    );
  }

  protected function getCustomCapabilities() {
    return array(
      UsersCreateUsersCapability::CAPABILITY => array(
        'default' => PhabricatorPolicies::POLICY_ADMIN,
      ),
      UsersEditUsersCapability::CAPABILITY => array (
        'default' => PhabricatorPolicies::POLICY_ADMIN,
      ),
      UsersDisableUsersCapability::CAPABILITY => array(
        'default' => PhabricatorPolicies::POLICY_ADMIN,
      ),
      UsersBrowseUserDirectoryCapability::CAPABILITY => array(),
    );
  }

  public function getApplicationSearchDocumentTypes() {
    return array(
      PhabricatorUsersUserPHIDType::TYPECONST,
    );
  }

}
