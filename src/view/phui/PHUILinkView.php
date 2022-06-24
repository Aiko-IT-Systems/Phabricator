<?php

final class PHUILinkView
  extends AphrontTagView {

  private $uri;
  private $text;
  private $workflow;
  private $target;

  public function setURI($uri) {
    $this->uri = $uri;
    return $this;
  }

  public function getURI() {
    return $this->uri;
  }

  public function setTarget($target) {
    $this->target = $target;
    return $this;
  }

  public function getTarget() {
    return $this->target;
  }

  public function setText($text) {
    $this->text = $text;
    return $this;
  }

  public function setWorkflow($workflow) {
    $this->workflow = $workflow;
    return $this;
  }

  protected function getTagName() {
    return 'a';
  }

  protected function getTagAttributes() {
    $sigil = array();

    if ($this->workflow) {
      $sigil[] = 'workflow';
    }

    return array(
      'href' => $this->getURI(),
      'sigil' => $sigil,
      'target' => $this->getTarget(),
    );
  }

  protected function getTagContent() {
    return $this->text;
  }

}
