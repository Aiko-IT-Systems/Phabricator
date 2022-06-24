ALTER TABLE {$NAMESPACE}_phriction.phriction_content
  ADD COLUMN IF NOT EXISTS discordEmoji VARCHAR(128) NOT NULL;
