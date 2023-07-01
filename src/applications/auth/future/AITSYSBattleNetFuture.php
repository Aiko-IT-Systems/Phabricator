<?php

final class AITSYSBattleNetFuture extends FutureProxy {

  private $future;
  private $clientID;
  private $accessToken;
  private $action;
  private $params;
  private $method = 'GET';
  private $region = 'eu';

  public $version = '1.0.0';

  public function __construct() {
    parent::__construct(null);
  }

  public function setAccessToken($token) {
    $this->accessToken = $token;
    return $this;
  }

  public function setClientID($client_id) {
    $this->clientID = $client_id;
    return $this;
  }

  public function setRegion($region) {
    $this->region = $region;
    return $this;
  }

  public function setRawBNetQuery($action, array $params = array()) {
    $this->action = $action;
    $this->params = $params;
    return $this;
  }

  public function setMethod($method) {
    $this->method = $method;
    return $this;
  }

  protected function getProxiedFuture() {
    if (!$this->future) {
      $params = $this->params;

      if (!$this->action) {
        throw new Exception(pht('You must %s!', 'setRawBNetQuery()'));
      }

      if (!$this->accessToken) {
        throw new Exception(pht('You must %s!', 'setAccessToken()'));
      }

      if (!$this->region) {
        throw new Exception(pht('You must %s!', 'setRegion()'));
      }

      $uri = new PhutilURI('https://oauth.battle.net/');
      $uri->setPath('oauth/'.$this->action);

      $future = new HTTPSFuture($uri);
      $future->setData($this->params);
      $future->addHeader('Authorization', 'Bearer '.$this->accessToken);
      $future->addHeader('User-Agent', "Phabricator OAuth (https://github.com/Aiko-IT-Systems/Phabricator, {$this->version})");
      $future->setMethod($this->method);

      $this->future = $future;
    }

    return $this->future;
  }

  protected function didReceiveResult($result) {
    list($status, $body, $headers) = $result;

    if ($status->isError()) {
      if ($this->isRateLimitResponse($status, $headers)) {
        // Do nothing, this is a rate limit.
      } else if ($this->isNotModifiedResponse($status)) {
        // Do nothing, this is a "Not Modified" response.
      } else {
        // This is an error condition we do not expect.
        throw $status;
      }
    }

    $data = null;
    try {
      if (strlen($body)) {
        $data = phutil_json_decode($body);
      } else {
        // This can happen for 304 responses.
        $data = array();
      }
    } catch (PhutilJSONParserException $ex) {
      throw new PhutilProxyException(
        pht('Expected JSON response from Battle.net.'),
        $ex);
    }

    if (idx($data, 'errors')) {
      $errors = print_r($data['errors'], true);
      throw new Exception(
        pht(
          'Received errors from Battle.net: %s',
          $errors));
    }

    return $data;
  }

  private function isNotModifiedResponse($status) {
    return ($status->getStatusCode() == 304);
  }

  private function isRateLimitResponse($status, array $headers) {
    if ($status->getStatusCode() != 403) {
      return false;
    }

    foreach ($headers as $header) {
      list($key, $value) = $header;
      if (phutil_utf8_strtolower($key) === 'x-ratelimit-remaining') {
        if (!(int)$value) {
          return true;
        }
      }
    }

    return false;
  }

}
