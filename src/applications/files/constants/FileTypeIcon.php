<?php

final class FileTypeIcon extends Phobject {

  public static function getFileIcon($filename) {
    $path_info = pathinfo($filename);
    $extension = idx($path_info, 'extension');
    switch ($extension) {
      case 'psd':
      case 'ai':
        $icon = 'fa-file-image';
        break;
      case 'conf':
        $icon = 'fa-wrench';
        break;
      case 'wav':
      case 'mp3':
      case 'aiff':
        $icon = 'fa-file-sound';
        break;
      case 'm4v':
      case 'mov':
        $icon = 'fa-file-movie';
        break;
      case 'sql':
      case 'db':
        $icon = 'fa-database';
        break;
      case 'xls':
      case 'csv':
        $icon = 'fa-file-excel';
        break;
      case 'ics':
        $icon = 'fa-calendar';
        break;
      case 'zip':
      case 'tar':
      case 'bz':
      case 'tgz':
      case 'gz':
        $icon = 'fa-file-archive';
        break;
      case 'png':
      case 'jpg':
      case 'bmp':
      case 'gif':
        $icon = 'fa-file-picture';
        break;
      case 'txt':
        $icon = 'fa-file-text';
        break;
      case 'doc':
      case 'docx':
        $icon = 'fa-file-word';
        break;
      case 'pdf':
        $icon = 'fa-file-pdf';
        break;
      default:
        $icon = 'fa-file-text';
        break;
    }
    return $icon;
  }

}
