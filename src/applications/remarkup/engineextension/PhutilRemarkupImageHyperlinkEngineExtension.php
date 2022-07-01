<?php

abstract class PhabricatorRemarkupImageHyperlinkEngineExtension
  extends PhutilRemarkupImageHyperlinkEngineExtension {

  final protected function getSelfLinks(array $imagehyperlinks) {
    assert_instances_of($imagehyperlinks, 'PhutilRemarkupImageHyperlinkRef');

    $allowed_protocols = array(
      'http' => true,
      'https' => true,
    );

    $results = array();
    foreach ($imagehyperlinks as $link) {
      $uri = $link->getURI();

      if (!PhabricatorEnv::isSelfURI($uri)) {
        continue;
      }

      $protocol = id(new PhutilURI($uri))->getProtocol();
      if (!isset($allowed_protocols[$protocol])) {
        continue;
      }

      $results[] = $link;
    }

    return $results;
  }
}
