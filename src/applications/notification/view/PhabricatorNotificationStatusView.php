<?php

final class PhabricatorNotificationStatusView extends AphrontTagView {

  protected function getTagAttributes() {
    if (!$this->getID()) {
      $this->setID(celerity_generate_unique_node_id());
    }

    Javelin::initBehavior(
      'aphlict-status',
      array(
        'nodeID' => $this->getID(),
        'pht' => array(
          'setup' => pht('Setting Up Client'),
          'open' => pht('Connected'),
          'closed' => pht('Disconnected'),
        ),
        'icon' => array(
          'open' => array(
            'icon' => 'fa-solid fa-circle',
            'color' => 'green',
          ),
          'setup' => array(
            'icon' => 'fa-solid fa-circle',
            'color' => 'yellow',
          ),
          'closed' => array(
            'icon' => 'fa-solid fa-circle',
            'color' => 'red',
          ),
        ),
      ));

    return array(
      'class' => 'aphlict-connection-status',
    );
  }

  protected function getTagContent() {
    $have = PhabricatorEnv::getEnvConfig('notification.servers');
    if ($have) {
      $icon = id(new PHUIIconView())
        ->setIcon('fa-circle yellow');
      $text = pht('Connecting...');
      return phutil_tag(
        'span',
        array(
          'class' => 'connection-status-text '.
            'aphlict-connection-status-connecting',
        ),
        array(
          $icon,
          $text,
        ));
    } else {
      $text = pht('Notification server not enabled');
      $icon = id(new PHUIIconView())
        ->setIcon('fa-circle grey');
      return phutil_tag(
        'span',
        array(
          'class' => 'connection-status-text '.
            'aphlict-connection-status-notenabled',
        ),
        array(
          $icon,
          $text,
        ));
    }
  }

}
