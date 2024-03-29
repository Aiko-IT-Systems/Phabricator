<?php

final class PhabricatorFileUploadController extends PhabricatorFileController {

  public function isGlobalDragAndDropUploadEnabled() {
    return true;
  }

  public function handleRequest(AphrontRequest $request) {
    $viewer = $request->getUser();

    $file = PhabricatorFile::initializeNewFile();

    $e_file = true;
    $errors = array();
    if ($request->isFormPost()) {
      $view_policy = $request->getStr('viewPolicy');
      $size = $request->getStr('csize');

      if (!$request->getFileExists('file')) {
        $e_file = pht('Required');
        $errors[] = pht('You must select a file to upload.');
      } else if($size != null && size == "nok") {
        $e_file = pht('File too large');
        $errors[] = pht('The file you uploaded is too large.');
      } else {
        $file = PhabricatorFile::newFromPHPUpload(
          idx($_FILES, 'file'),
          array(
            'name'        => $request->getStr('name'),
            'authorPHID'  => $viewer->getPHID(),
            'viewPolicy'  => $view_policy,
            'isExplicitUpload' => true,
          ));
      }

      if (!$errors) {
        return id(new AphrontRedirectResponse())->setURI($file->getInfoURI());
      }

      $file->setViewPolicy($view_policy);
    }

    $support_id = celerity_generate_unique_node_id();
    $max_size = pht(PhabricatorEnv::getEnvConfig('storage.local-disk.max-size'));
    $max_size_enabled = pht(PhabricatorEnv::getEnvConfig('storage.local-disk.limit-enabled'));
    $instructions = id(new AphrontFormMarkupControl())
      ->setControlID($support_id)
      ->setControlStyle('display: none')
      ->setValue(hsprintf(
        '<br /><br /><strong>%s</strong> %s<br /><br />',
        pht('Drag and Drop:'),
        pht(
          'You can also upload files by dragging and dropping them from your '.
          'desktop onto this page or the Phabricator home page.')));

    $policies = id(new PhabricatorPolicyQuery())
      ->setViewer($viewer)
      ->setObject($file)
      ->execute();

    $form = id(new AphrontFormView())
      ->setUser($viewer)
      ->setEncType('multipart/form-data')
      ->appendChild(
        id(new AphrontFormFileControl())
          ->setLabel(pht('File'))
          ->setName('file')
          ->setError($e_file))
      ->appendChild(
        id(new AphrontFormStaticControl())
          ->setLabel(pht('Size'))
          ->setName('size')
          ->addClass('file-size')
          ->setControlID('file-size')
          ->setValue('Select a file to see its size..'))
      ->appendChild(
        id(new AphrontFormStaticControl())
          ->setLabel("Size Status")
          ->setName('csize')
          ->addClass('csize')
          ->setControlID('csize')
          ->setValue('empty')
          ->setHidden(true))
      ->appendChild(
        id(new AphrontFormStaticControl())
          ->setLabel("Size Max")
          ->setName('msize')
          ->addClass('msize')
          ->setControlID('msize')
          ->setValue($max_size)
          ->setHidden(true))
      ->appendChild(
        id(new AphrontFormStaticControl())
          ->setLabel("Size Max Enabled")
          ->setName('emsize')
          ->addClass('emsize')
          ->setControlID('emsize')
          ->setValue($max_size_enabled)
          ->setHidden(true))
      ->appendChild(
        id(new AphrontFormTextControl())
          ->setLabel(pht('Name'))
          ->setName('name')
          ->setValue($request->getStr('name')))
      ->appendChild(
        id(new AphrontFormPolicyControl())
          ->setUser($viewer)
          ->setCapability(PhabricatorPolicyCapability::CAN_VIEW)
          ->setPolicyObject($file)
          ->setPolicies($policies)
          ->setName('viewPolicy'))
      ->appendChild(
        id(new AphrontFormSubmitControl())
          ->setValue(pht('Upload'))
          ->addCancelButton('/file/'))
      ->appendChild($instructions);

    $crumbs = $this->buildApplicationCrumbs();
    $crumbs->addTextCrumb(pht('Upload'), $request->getRequestURI());
    $crumbs->setBorder(true);

    $title = pht('Upload File');

    $global_upload = id(new PhabricatorGlobalUploadTargetView())
      ->setUser($viewer)
      ->setShowIfSupportedID($support_id);

    $form_box = id(new PHUIObjectBoxView())
      ->setHeaderText($title)
      ->setFormErrors($errors)
      ->setBackground(PHUIObjectBoxView::WHITE_CONFIG)
      ->setForm($form);

    $view = id(new PHUITwoColumnView())
      ->setFooter(array(
        $form_box,
        $global_upload,
      ));

    return $this->newPage()
      ->setTitle($title)
      ->setCrumbs($crumbs)
      ->appendChild($view);
  }

}
