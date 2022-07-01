<?php

final class PhutilRemarkupImageHyperlinkRule extends PhutilRemarkupRule {

  const KEY_IMAGE_HYPERLINKS = 'imagehyperlinks';
  const IMAGE_SINGLE_MARKDOWN_REGEX = '((?<starttag>!\[(?<description>[\w ]+)\]\()(?<url>https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*))(?<endtag>\)))';
  const IMAGE_MULTI_MARKDOWN_REGEX = '((?<imgwithurlmarkdown>(?<linkstartag>\[)(?<imgstarttag>!\[(?<imgalt>[\w ]+)\]\()(?<imgurl>https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*))(?<imgendtag>\)\]))(?<linkmiddletag>\()(?<linkurl>https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*))(?<linkendtag>\)))';
  public function getPriority() {
    return 50.0;
  }

  public function apply($text) {
    $text = preg_replace_callback(
      self::IMAGE_MULTI_MARKDOWN_REGEX,
      array($this, 'markupImageHyperlinkMultiUngreedy'),
      $text);

    $text = preg_replace_callback(
      self::IMAGE_SINGLE_MARKDOWN_REGEX,
      array($this, 'markupImageHyperlinkUngreedy'),
      $text);

    return $text;
  }

  protected function markupImageHyperlinkMulti($mode, array $matches) {
    preg_match(self::IMAGE_MULTI_MARKDOWN_REGEX, $matches[1], $matches_new);

    $raw_img_uri = $matches_new['imgurl'];
    $raw_link_uri = $matches_new['linkurl'];

    try {
      $img_uri = new PhutilURI($raw_img_uri);
    } catch (Exception $ex) {
      return $matches[0];
    }

    try {
      $link_uri = new PhutilURI($raw_link_uri);
    } catch (Exception $ex) {
      return $matches[0];
    }

    $engine = $this->getEngine();

    $token = $engine->storeText($img_uri);

    $list_key = self::KEY_IMAGE_HYPERLINKS;
    $link_list = $engine->getTextMetadata($list_key, array());
    $alt = $matches_new['imgalt'];

    $link_list[] = array(
      'token' => $token,
      'uri' => $raw_link_uri,
      'imguri' => $raw_img_uri,
      'mode' => $mode,
      'alt' => $alt,
    );

    $engine->setTextMetadata($list_key, $link_list);

    return $token;
  }

  protected function markupImageHyperlink($mode, array $matches) {
    preg_match(self::IMAGE_SINGLE_MARKDOWN_REGEX, $matches[1], $matches_new);

    $raw_uri = $matches_new['url'];

    try {
      $uri = new PhutilURI($raw_uri);
    } catch (Exception $ex) {
      return $matches[0];
    }

    $engine = $this->getEngine();

    $token = $engine->storeText($raw_uri);

    $list_key = self::KEY_IMAGE_HYPERLINKS;
    $link_list = $engine->getTextMetadata($list_key, array());
    $alt = $matches_new['description'];

    $link_list[] = array(
      'token' => $token,
      'uri' => null,
      'imguri' => $raw_uri,
      'mode' => $mode,
      'alt' => $alt,
    );

    $engine->setTextMetadata($list_key, $link_list);

    return $token;
  }

  protected function renderImageHyperlink($link, $is_embed, $alt) {
    if ($is_embed) {
      return $this->renderRawImageLink($link, $is_embed);
    }

    return phutil_tag(
      'img',
      array(
        'src' => $link,
        'width' => 'auto',
        'height' => 'auto',
        'alt' => $alt,
      ));
  }

  protected function renderImageHyperlinkWithUrl($url, $imgurl, $is_embed, $alt) {
    if ($is_embed) {
      return $this->renderRawImageLinkWithUrl($url, $imgurl, $is_embed);
    }

    return phutil_tag(
      'a',
      array(
        'href' => $url,
        'target' => '_blank',
      ),
      phutil_tag(
        'img',
        array(
          'src' => $imgurl,
          'width' => 'auto',
          'height' => 'auto',
          'alt' => $alt,
        )));
  }

  private function renderRawImageLinkWithUrl($url, $imgurl, $is_embed) {
    if ($is_embed) {
      return '{'.$link.'} ({ '.$imgurl.' })';
    } else {
      return $url;
    }
  }

  private function renderRawImageLink($link, $is_embed) {
    if ($is_embed) {
      return '{'.$link.'}';
    } else {
      return $link;
    }
  }

  protected function markupImageHyperlinkUngreedy($matches) {
    $match = $matches[0];
    $tail = null;
    $trailing = null;
    if (preg_match('/[;,.:!?]+$/', $match, $trailing)) {
      $tail = $trailing[0];
      $match = substr($match, 0, -strlen($tail));
    }

    try {
      $uri = new PhutilURI($match);
    } catch (Exception $ex) {
      return $matches[0];
    }

    $link = $this->markupImageHyperlink(null, array(null, $match));

    return hsprintf('%s%s', $link, $tail);
  }

  protected function markupImageHyperlinkMultiUngreedy($matches) {
    $match = $matches[0];
    $tail = null;
    $trailing = null;
    if (preg_match('/[;,.:!?]+$/', $match, $trailing)) {
      $tail = $trailing[0];
      $match = substr($match, 0, -strlen($tail));
    }

    try {
      $uri = new PhutilURI($match);
    } catch (Exception $ex) {
      return $matches[0];
    }

    $link = $this->markupImageHyperlinkMulti(null, array(null, $match));

    return hsprintf('%s%s', $link, $tail);
  }

  public function didMarkupText() {
    $engine = $this->getEngine();

    $protocols = $engine->getConfig('uri.allowed-protocols', array());
    $is_toc = $engine->getState('toc');
    $is_text = $engine->isTextMode();

    $list_key = self::KEY_IMAGE_HYPERLINKS;
    $raw_list = $engine->getTextMetadata($list_key, array());

    $links = array();
    foreach ($raw_list as $key => $link) {
      $token = null;
      $raw_img_uri = $link['imguri'];
      $raw_link_uri = $link['uri'];
      $mode = $link['mode'];

      $is_embed = ($mode === '{');

      $img_uri = new PhutilURI($raw_img_uri);
      $img_protocol = $img_uri->getProtocol();
      $valid_img_protocol = idx($protocols, $img_protocol);

      if ($raw_link_uri == null) {
        $valid_url_protocol = true;
      } else {
        $link_uri = new PhutilURI($raw_img_uri);
        $link_protocol = $link_uri->getProtocol();
        $valid_url_protocol = idx($protocols, $link_protocol);
      }

      if (!$valid_img_protocol || !$valid_url_protocol) {
        $result = null;
        if ($raw_link_uri == null) {
          $result = $this->renderRawImageLink($raw_img_uri, $is_embed);
        } else {
          $result = $this->renderRawImageLinkWithUrl($raw_link_uri, $raw_img_uri, $is_embed);
        }
        $engine->overwriteStoredText($token, $result);
        continue;
      }

      $links[$key] = $link;
    }

    if (!$links) {
      return;
    }

    foreach ($links as $key => $link) {
      $links[$key] = new PhutilRemarkupImageHyperlinkRef($link);
    }

    $extensions = PhutilRemarkupImageHyperlinkEngineExtension::getAllLinkEngines();
    foreach ($extensions as $extension) {
      $extension = id(clone $extension)
        ->setEngine($engine)
        ->processImageHyperlinks($links);

      foreach ($links as $key => $link) {
        $result = $link->getResult();
          if ($result !== null) {
            $engine->overwriteStoredText($link->getToken(), $result);
            unset($links[$key]);
          }
      }

      if (!$links) {
        break;
      }
    }

    foreach ($links as $link) {
      if ($link->getURI() == null) {
        $result = $this->renderImageHyperlink($link->getImgURI(), $link->isEmbed(), $link->getAlt());
      } else {
        $result = $this->renderImageHyperlinkWithUrl($link->getURI(), $link->getImgUri(), $link->isEmbed(), $link->getAlt());
      }
      $engine->overwriteStoredText($link->getToken(), $result);
    }
  }

}
