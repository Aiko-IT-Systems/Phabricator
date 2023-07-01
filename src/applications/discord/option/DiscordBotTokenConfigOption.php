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
        ->setDescription(pht('Discord bot token')),
      $this->newOption('discord.client.id', 'string', null)
        ->setLocked(true)
        ->setHidden(false)
        ->setDescription(pht('Discord client id')),
      $this->newOption('discord.client.secret', 'string', null)
        ->setLocked(true)
        ->setHidden(false)
        ->setDescription(pht('Discord client secret')),
      $this->newOption('discord.oauth2.bot.guild_auto_add', 'bool', false)
        ->setBoolOptions(
          array(
            pht('Enable'),
            pht('Disable'),
          )
          )
        ->setLocked(false)
        ->setHidden(false)
        ->setDescription(pht('Discord Auto Guild')),
      $this->newOption('discord.oauth2.bot.linked_roles', 'bool', true)
        ->setBoolOptions(
          array(
            pht('Enable'),
            pht('Disable'),
          )
        )
        ->setLocked(false)
        ->setHidden(false)
        ->setDescription(pht('Discord Linked Roles')),
      $this->newOption('discord.oauth2.bot.guild_auto_add.admin_guilds', 'list<string>', array())
      ->setLocked(false)
      ->setHidden(false)
      ->addExample(
        array(
          '858089274087309313',
          '858089281214087179',
        ),
        pht('Add user to specific guilds if they\'re an administrator.'))
      ->setDescription(pht('Discord Auto Guild [ADMIN]')),
      $this->newOption('discord.oauth2.bot.guild_auto_add.user_guilds', 'list<string>', array())
      ->setLocked(false)
      ->setHidden(false)
      ->addExample(
        array(
          '858089281214087179',
        ),
        pht('Add user to specific guilds'))
      ->setDescription(pht('Discord Auto Guild [USER]')),
    );
  }
}
