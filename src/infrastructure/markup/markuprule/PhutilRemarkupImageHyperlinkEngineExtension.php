<?php

abstract class PhutilRemarkupImageHyperlinkEngineExtension
  extends Phobject {

  private $engine;

  final public function getImageHyperlinkEngineKey() {
    return $this->getPhobjectClassConstant('IMAGELINKENGINEKEY', 32);
  }

  final public static function getAllLinkEngines() {
    return id(new PhutilClassMapQuery())
      ->setAncestorClass(__CLASS__)
      ->setUniqueMethod('getImageHyperlinkEngineKey')
      ->execute();
  }

  final public function setEngine(PhutilRemarkupEngine $engine) {
    $this->engine = $engine;
    return $this;
  }

  final public function getEngine() {
    return $this->engine;
  }

  abstract public function processImageHyperlinks(array $imagehyperlinks);

}
