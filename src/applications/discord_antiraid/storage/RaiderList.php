<?php

final class RaiderList extends RaiderListDAO
  implements
    PhabricatorSubscribableInterface,
    PhabricatorMentionableInterface,
    PhabricatorPolicyInterface,
    PhabricatorDestructibleInterface,
    PhabricatorApplicationTransactionInterface,
    PhabricatorConduitResultInterface {

  protected $actors;
  protected $authorPHID;
  protected $raliPHID;
  protected $raiders;
  protected $notes;
  protected $viewPolicy;
  protected $editPolicy;
  protected $type;
  protected $timestamp;
  protected $spacePHID;

  public static function initializeNewRaiderList(PhabricatorUser $actor) {
    $app = id(new PhabricatorApplicationQuery())
      ->setViewer($actor)
      ->withClasses(array('DiscordAntiRaidApplication'))
      ->executeOne();

    $view_policy = $app->getPolicy(DiscordAntiRaidDefaultViewCapability::CAPABILITY);
    $edit_policy = $app->getPolicy(DiscordAntiRaidDefaultEditCapability::CAPABILITY);

    return id(new RaiderList())
      ->setAuthorPHID($actor->getPHID())
      ->setViewPolicy($view_policy)
      ->setEditPolicy($edit_policy)
      ->setSpacePHID($actor->getDefaultSpacePHID());
  }

  public function getURI() {
    return '/'.$this->getMonogram();
  }

  public function getMonogram() {
    return 'RL'.$this->getID();
  }

  protected function getConfiguration() {
    return array(
      self::CONFIG_AUX_PHID => true,
      self::CONFIG_COLUMN_SCHEMA => array(
        'actors' => 'text255',
        'guild' => 'text255',
        'notes' => 'text255?',
        'raiders' => 'text255',
        'type' => 'uint32',
        'timestamp' => 'uint32',
        'parentPHID' => 'phid?',
        'viewPolicy' => 'policy',
      ),
      self::CONFIG_KEY_SCHEMA => array(
        'authorPHID' => array(
          'columns' => array('authorPHID'),
        ),
        'key_dateCreated' => array(
          'columns' => array('dateCreated'),
        ),
      ),
    ) + parent::getConfiguration();
  }

  public function generatePHID() {
    return PhabricatorPHID::generateNewPHID(
      DiscordAntiRaidRaiderListPHIDType::TYPECONST);
  }

  public function getFullName() {
    return 'RL'.$this->getID();
  }

  public function getContent() {
    return $this->assertAttached($this->content);
  }

  public function attachContent($content) {
    $this->content = $content;
    return $this;
  }

  public function getRawContent() {
    return $this->assertAttached($this->rawContent);
  }

  public function attachRawContent($raw_content) {
    $this->rawContent = $raw_content;
    return $this;
  }

  public function getSnippet() {
    return $this->assertAttached($this->snippet);
  }

  public function attachSnippet(PhabricatorPasteSnippet $snippet) {
    $this->snippet = $snippet;
    return $this;
  }

/* -(  PhabricatorSubscribableInterface  )----------------------------------- */


  public function isAutomaticallySubscribed($phid) {
    return ($this->authorPHID == $phid);
  }


/* -(  PhabricatorTokenReceiverInterface  )---------------------------------- */

  public function getUsersToNotifyOfTokenGiven() {
    return array(
      $this->getAuthorPHID(),
    );
  }


/* -(  PhabricatorPolicyInterface  )----------------------------------------- */


  public function getCapabilities() {
    return array(
      PhabricatorPolicyCapability::CAN_VIEW,
      PhabricatorPolicyCapability::CAN_EDIT,
    );
  }

  public function getPolicy($capability) {
    if ($capability == PhabricatorPolicyCapability::CAN_VIEW) {
      return $this->viewPolicy;
    } else if ($capability == PhabricatorPolicyCapability::CAN_EDIT) {
      return $this->editPolicy;
    }
    return PhabricatorPolicies::POLICY_NOONE;
  }

  public function hasAutomaticCapability($capability, PhabricatorUser $user) {
    return ($user->getPHID() == $this->getAuthorPHID());
  }

  public function describeAutomaticCapability($capability) {
    return pht('The author of a paste can always view and edit it.');
  }


/* -(  PhabricatorDestructibleInterface  )----------------------------------- */


  public function destroyObjectPermanently(
    PhabricatorDestructionEngine $engine) {

    if ($this->filePHID) {
      $file = id(new PhabricatorFileQuery())
        ->setViewer($engine->getViewer())
        ->withPHIDs(array($this->filePHID))
        ->executeOne();
      if ($file) {
        $engine->destroyObject($file);
      }
    }

    $this->delete();
  }


/* -(  PhabricatorApplicationTransactionInterface  )------------------------- */


  public function getApplicationTransactionEditor() {
    return new PhabricatorPasteEditor();
  }

  public function getApplicationTransactionTemplate() {
    return new PhabricatorPasteTransaction();
  }


/* -(  PhabricatorSpacesInterface  )----------------------------------------- */


  public function getSpacePHID() {
    return $this->spacePHID;
  }


/* -(  PhabricatorConduitResultInterface  )---------------------------------- */


  public function getFieldSpecificationsForConduit() {
    return array(
      id(new PhabricatorConduitSearchFieldSpecification())
        ->setKey('title')
        ->setType('string')
        ->setDescription(pht('The title of the paste.')),
      id(new PhabricatorConduitSearchFieldSpecification())
        ->setKey('uri')
        ->setType('uri')
        ->setDescription(pht('View URI for the paste.')),
      id(new PhabricatorConduitSearchFieldSpecification())
        ->setKey('authorPHID')
        ->setType('phid')
        ->setDescription(pht('User PHID of the author.')),
      id(new PhabricatorConduitSearchFieldSpecification())
        ->setKey('language')
        ->setType('string?')
        ->setDescription(pht('Language to use for syntax highlighting.')),
      id(new PhabricatorConduitSearchFieldSpecification())
        ->setKey('status')
        ->setType('string')
        ->setDescription(pht('Active or archived status of the paste.')),
    );
  }

  public function getFieldValuesForConduit() {
    return array(
      'title' => $this->getTitle(),
      'uri' => PhabricatorEnv::getURI($this->getURI()),
      'authorPHID' => $this->getAuthorPHID(),
      'language' => nonempty($this->getLanguage(), null),
      'status' => $this->getStatus(),
    );
  }

  public function getConduitSearchAttachments() {
    return array(
      id(new PhabricatorPasteContentSearchEngineAttachment())
        ->setAttachmentKey('content'),
    );
  }


/* -(  PhabricatorFerretInterface  )----------------------------------------- */


  public function newFerretEngine() {
    return new PhabricatorPasteFerretEngine();
  }


/* -(  PhabricatorFulltextInterface  )--------------------------------------- */

  public function newFulltextEngine() {
    return new PhabricatorPasteFulltextEngine();
  }

}
