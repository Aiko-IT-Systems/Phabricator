<?php

final class FileDeleteConduitAPIMethod extends FileConduitAPIMethod {

  public function getAPIMethodName() {
    return 'file.delete';
  }

  public function getMethodDescription() {
    return pht('Deletes a file.');
  }

  protected function defineParamTypes() {
    return array(
      'id'    => 'optional id',
      'phid'  => 'optional phid',
    );
  }

  protected function defineReturnType() {
    return 'bool';
  }

  protected function defineErrorTypes() {
    return array(
      'ERR_NOT_FOUND'  => pht('Bad file ID.'),
      'ERR_WRONG_USER' => pht('You are not the owner of this file.'),
      'ERR_NEED_PARAM' => pht('Must pass an id or an objectPHID.'),
    );
  }

  protected function execute(ConduitAPIRequest $request) {
    $viewer = $request->getUser();
    $id = $request->getValue('id');
    $phid = $request->getValue('phid');
    if ($id) {
      $file = id(new PhabricatorFileQuery())
      ->setViewer($viewer)
      ->withIds($id)
      ->executeOne();
      if (!$file) {
        throw new ConduitException('ERR_NOT_FOUND');
      }
      if ($file->getOwnerPHID() != $viewer->getPHID()) {
        throw new ConduitException('ERR_WRONG_USER');
      }
    } else if ($object) {
      $file = $this->loadFileByPHID($viewer, $phid);
      if (!$file) {
        return false;
      }
    } else {
      throw new ConduitException('ERR_NEED_PARAM');
    }

    $file->delete();
    return true;
  }

}
