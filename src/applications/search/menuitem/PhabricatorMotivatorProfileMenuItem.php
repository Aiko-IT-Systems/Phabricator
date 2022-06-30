<?php
/**
 * Motivator provider
 *
 * @author  AITSYS
 * @license MIT
 */
final class PhabricatorMotivatorProfileMenuItem
  extends PhabricatorProfileMenuItem {

  /**
   * The menu item key.
   *
   * @var const
   */
  const MENUITEMKEY = 'motivator';

  /**
   * Gets the menu item type icon.
   *
   * @return string The menu item type icon.
   */
  public function getMenuItemTypeIcon() : string {
    return 'fa-coffee';
  }

  /**
   * Gets the menu item type name.
   *
   * @return string The menu item type name.
   */
  public function getMenuItemTypeName() : string {
    return pht('Motivator');
  }

  /**
   * Checks whether this menu item can be added to the application.
   *
   * @param mixed $object The object to check.
   *
   * @return bool True if the menu can be added to the application.
   */
  public function canAddToObject($object) : bool {
    return ($object instanceof PhabricatorHomeApplication);
  }

  /**
   * Gets the display name.
   *
   * @param  PhabricatorProfileMenuItemConfiguration $config The menu item config.
   *
   * @return string The display name.
   */
  public function getDisplayName(
    PhabricatorProfileMenuItemConfiguration $config) : string {

    $options = $this->getOptions();
    $name = idx($options, $config->getMenuItemProperty('source'));
    if ($name !== null) {
      return pht('Motivator: %s', $name);
    } else {
      return pht('Motivator');
    }
  }

  /**
   * Builds the edit engine fields.
   *
   * @param  PhabricatorProfileMenuItemConfiguration $config The menu item config.
   *
   * @return array<mixed> Created edit fields.
   */
  public function buildEditEngineFields(
    PhabricatorProfileMenuItemConfiguration $config) : array {
    return array(
      id(new PhabricatorInstructionsEditField())
        ->setValue(
          pht(
            'Motivate your team with inspirational quotes from great minds. '.
            'This menu item shows a new quote every day.')),
      id(new PhabricatorSelectEditField())
        ->setKey('source')
        ->setLabel(pht('Source'))
        ->setOptions($this->getOptions()),
    );
  }

  /**
   * Gets the available motivator options.
   *
   * @return array<string> Available motivator options.
   */
  private function getOptions() : array {
    return array(
      'catfacts' => pht('Cat Facts'),
      'dogfacts' => pht('Dog Facts'),
    );
  }

  /**
   * Creates a new menu item.
   *
   * @param  PhabricatorProfileMenuItemConfiguration $config The menu item config.
   *
   * @return array<PhabricatorProfileMenuItemView> Created menu item
   */
  protected function newMenuItemViewList(
    PhabricatorProfileMenuItemConfiguration $config) : array {

    $source = $config->getMenuItemProperty('source');

    switch ($source) {
      case 'catfacts':
        $fact_name = pht('Cat Facts');
        $fact_icon = 'fa-cat';
        $fact_text = $this->getRandomCatFact();
        break;
      case 'dogfacts':
        $fact_name = pht('Dog Facts');
        $fact_icon = 'fa-dog';
        $fact_text = $this->getRandomDogFact();
        break;
      default:
      $fact_name = pht('Unknown');
      $fact_icon = 'fa-question';
      $fact_text = pht('Something went wrong.');
        break;
    }

    $item = $this->newItemView()
      ->setName($fact_name)
      ->setIcon($fact_icon)
      ->setTooltip($fact_text)
      ->setURI('#');

    return array(
      $item,
    );
  }

  /**
   * Queries the API `catfact.ninja` for a random cat fact
   *
   * @return string Cat fact
   * @throws \PhutilProxyException
   */
  private function getRandomCatFact() : string {
    $uri = new PhutilURI('https://catfact.ninja/fact');
    $uri = (string)$uri;

    $future = new HTTPSFuture($uri);
    $future->setMethod('GET');
    list($body) = $future->resolvex();

    try {
      $data = phutil_json_decode($body);
      return $data['fact'];
    } catch (PhutilJSONParserException $ex) {
      throw new PhutilProxyException(
        pht('Expected valid JSON response from cat fact api.'),
        $ex);
    }
  }

  /**
   * Queries the API `dog-api.kinduff.com` for a random dog fact
   *
   * @return string Dog fact
   * @throws \PhutilProxyException
   */
  private function getRandomDogFact() : string {
    $uri = new PhutilURI('https://dog-api.kinduff.com/api/facts');
    $uri = (string)$uri;

    $future = new HTTPSFuture($uri);
    $future->setMethod('GET');
    list($body) = $future->resolvex();

    try {
      $data = phutil_json_decode($body);
      return $data['facts'][0];
    } catch (PhutilJSONParserException $ex) {
      throw new PhutilProxyException(
        pht('Expected valid JSON response from dog fact api.'),
        $ex);
    }
  }
}
