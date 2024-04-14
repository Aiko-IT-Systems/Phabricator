<?php

final class PhabricatorRiotPlatformController
  extends PhabricatorRobotsController {

  protected function newRobotsRules() {
    $out = array();
    $out[] = '520441f1-25a3-4ede-ace2-21d6dab77391';
    return $out;
  }

}
