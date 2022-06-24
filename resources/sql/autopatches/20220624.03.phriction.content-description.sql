ALTER TABLE {$NAMESPACE}_phriction.phriction_content
  ADD COLUMN IF NOT EXISTS description VARCHAR(128);
