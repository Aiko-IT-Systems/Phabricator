<?php

final class PhabricatorCustomSiteTitleConfigType
  extends PhabricatorConfigOptionType {

  public static function getOgLogoImagePHID() {
    $title = PhabricatorEnv::getEnvConfig('ui.site-title');
    return idx($title, 'ogLogoImagePHID');
  }

  public static function getSiteTitle() {
    $title = PhabricatorEnv::getEnvConfig('ui.site-title');
    return idx($title, 'titleText');
  }

  public function validateOption(PhabricatorConfigOption $option, $value) {
    if (!is_array($value)) {
      throw new Exception(
        pht(
          'Logo configuration is not valid: value must be a dictionary.'));
    }

    PhutilTypeSpec::checkMap(
      $value,
      array(
        'ogLogoImagePHID' => 'optional string|null',
        'titleText' => 'optional string|null',
      ));
  }

  public function readRequest(
    PhabricatorConfigOption $option,
    AphrontRequest $request) {

    $viewer = $request->getViewer();
    $view_policy = PhabricatorPolicies::POLICY_PUBLIC;

    if ($request->getBool('removeLogo')) {
      $logo_image_phid = null;
    } else if ($request->getFileExists('ogLogoImage')) {
      $logo_image = PhabricatorFile::newFromPHPUpload(
        idx($_FILES, 'ogLogoImage'),
        array(
          'name' => 'logo',
          'authorPHID' => $viewer->getPHID(),
          'viewPolicy' => $view_policy,
          'canCDN' => true,
          'isExplicitUpload' => true,
        ));
      $logo_image_phid = $logo_image->getPHID();
    } else {
      $logo_image_phid = self::getOgLogoImagePHID();
    }

    $title_text = $request->getStr('titleText');

    $value = array(
      'ogLogoImagePHID' => $logo_image_phid,
      'titleText' => $title_text,
    );

    $errors = array();
    $e_value = null;

    try {
      $this->validateOption($option, $value);
    } catch (Exception $ex) {
      $e_value = pht('Invalid');
      $errors[] = $ex->getMessage();
      $value = array();
    }

    return array($e_value, $errors, $value, phutil_json_encode($value));
  }

  public function renderControls(
    PhabricatorConfigOption $option,
    $display_value,
    $e_value) {

    try {
      $value = phutil_json_decode($display_value);
    } catch (Exception $ex) {
      $value = array();
    }

    $logo_image_phid = idx($value, 'ogLogoImagePHID');
    $title_text = idx($value, 'titleText');

    $controls = array();

    // TODO: This should be a PHUIFormFileControl, but that currently only
    // works in "workflow" forms. It isn't trivial to convert this form into
    // a workflow form, nor is it trivial to make the newer control work
    // in non-workflow forms.
    $controls[] = id(new AphrontFormFileControl())
      ->setName('ogLogoImage')
      ->setLabel(pht('OG Logo Image'));

    if ($logo_image_phid) {
      $controls[] = id(new AphrontFormCheckboxControl())
        ->addCheckbox(
          'removeLogo',
          1,
          pht('Remove Custom OG Logo Image'));
    }

    $controls[] = id(new AphrontFormTextControl())
      ->setName('titleText')
      ->setLabel(pht('Title'))
      ->setPlaceholder(pht('Phabricator'))
      ->setValue($title_text);

    return $controls;
  }


}
