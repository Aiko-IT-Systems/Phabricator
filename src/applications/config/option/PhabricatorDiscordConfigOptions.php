<?php

final class PhabricatorDiscordConfigOptions
  extends PhabricatorApplicationConfigOptions {

  public function getName() {
    return pht('Discord');
  }

  public function getDescription() {
    return pht('Options for Discord.');
  }

  public function getIcon() {
    return 'fa-discord';
  }

  public function getIsBrand() {
    return true;
  }

  public function getGroup() {
    return 'apps';
  }

  public function getOptions() {
    return array(
      $this->newOption('discord.bot', 'string', null)
        ->setLocked(true)
        ->setHidden(true)
        ->setSummary(pht('Discord configuration'))
        ->setDescription(pht('Discord bot token')),
    );
  }
}
