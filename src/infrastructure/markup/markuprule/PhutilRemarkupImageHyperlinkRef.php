<?php

final class PhutilRemarkupImageHyperlinkRef
  extends Phobject {

  private $token;
  private $uri;
  private $imguri;
  private $embed;
  private $result;
  private $alt;

  public function __construct(array $map) {
    $this->token = $map['token'];
    $this->uri = $map['uri'];
    $this->imguri = $map['imguri'];
    $this->embed = ($map['mode'] === '{');
    $this->alt = $map['alt'];
  }

  public function getToken() {
    return $this->token;
  }

  public function getURI() {
    return $this->uri;
  }

  public function getImgURI() {
    return $this->imguri;
  }

  public function getAlt() {
    return $this->uri;
  }

  public function isEmbed() {
    return $this->embed;
  }

  public function setResult($result) {
    $this->result = $result;
    return $this;
  }

  public function getResult() {
    return $this->result;
  }

}
