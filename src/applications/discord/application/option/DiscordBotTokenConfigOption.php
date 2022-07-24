<?php

final class DiscordBotTokenConfigOption
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
      $this->newOption('discord.bot.token', 'string', null)
        ->setLocked(true)
        ->setHidden(false)
        ->setSummary(pht('Discord configuration'))
        ->setDescription(pht('Discord bot token')),
      $this->newOption('discord.client.id', 'string', null)
        ->setLocked(true)
        ->setHidden(false)
        ->setSummary(pht('Discord configuration'))
        ->setDescription(pht('Discord client id')),
      $this->newOption('discord.client.secret', 'string', null)
        ->setLocked(true)
        ->setHidden(false)
        ->setSummary(pht('Discord configuration'))
        ->setDescription(pht('Discord client secret')),
    );
  }
}
