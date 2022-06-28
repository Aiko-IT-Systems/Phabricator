<?php

final class PhabricatorPhrictionCardView extends AphrontTagView {

  private $wiki;
  private $viewer;
  private $tag;
  private $isExiled;

  public function setWiki(PhrictionDocument $wiki) {
    $this->wiki = $wiki;
    return $this;
  }

  public function setViewer(PhabricatorUser $viewer) {
    $this->viewer = $viewer;
    return $this;
  }

  public function setTag($tag) {
    $this->tag = $tag;
    return $this;
  }

  protected function getTagName() {
    if ($this->tag) {
      return $this->tag;
    }
    return 'div';
  }

  protected function getTagAttributes() {
    $classes = array();
    $classes[] = 'project-card-view';
    $classes[] = 'users-card-view';

    if ($this->profile->getIsDisabled()) {
      $classes[] = 'project-card-disabled';
    }

    return array(
      'class' => implode(' ', $classes),
    );
  }

  public function setIsExiled($is_exiled) {
    $this->isExiled = $is_exiled;
    return $this;
  }

  public function getIsExiled() {
    return $this->isExiled;
  }

  protected function getTagContent() {

    $wiki = $this->wiki;
    $content = $wiki->getContent();
    $link = $wiki->getURI();
    $viewer = $this->viewer;

    require_celerity_resource('project-card-view-css');

    // We don't have a ton of room on the hovercard, so we're trying to show
    // the most important tag. Users can click through to the profile to get
    // more details.

    $classes = array();

    $body = array();

    /* TODO: Replace with Conpherence Availability if we ship it */
    $body[] = $this->addItem(
      'fa-user-plus',
      phabricator_date($wiki->getDateCreated(), $viewer));

    if ($this->getIsExiled()) {
      $body[] = $this->addItem(
        'fa-eye-slash red',
        pht('This user can not see this object.'),
        array(
          'project-card-item-exiled',
        ));
    }

    $classes[] = 'project-card-image';

    $href = $link;


    $title = phutil_tag_div('project-card-name',
      $wiki->getTitle());

    $header = phutil_tag(
      'div',
      array(
        'class' => 'project-card-header',
      ),
      array(
        $title,
        $body,
      ));

    $card = phutil_tag(
      'div',
      array(
        'class' => 'project-card-inner',
      ),
      array(
        $header,
      ));

    return $card;
  }

  private function addItem($icon, $value, $classes = array()) {
    $classes[] = 'project-card-item';

    $icon = id(new PHUIIconView())
      ->addClass('project-card-item-icon')
      ->setIcon($icon);

    $text = phutil_tag(
      'span',
      array(
        'class' => 'project-card-item-text',
      ),
      $value);

    return phutil_tag(
      'div',
      array(
        'class' => implode(' ', $classes),
      ),
      array($icon, $text));
  }

}
