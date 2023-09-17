<?php

final class PhabricatorRobotsBlogController
  extends PhabricatorRobotsController {

  protected function newRobotsRules() {
    $out = array();

    // Allow everything on blog domains to be indexed.

    $out[] = 'User-Agent: *';
    $out[] = 'Allow: /';
    $out[] = 'Crawl-delay: 120';

    return $out;
  }

}
