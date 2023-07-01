<?php

final class PhabricatorFilesConfigOptions
  extends PhabricatorApplicationConfigOptions {

  public function getName() {
    return pht('Files');
  }

  public function getDescription() {
    return pht('Configure files and file storage.');
  }

  public function getIcon() {
    return 'fa-file';
  }

  public function getGroup() {
    return 'apps';
  }

  public function getOptions() {
    $viewable_default = array(
      'image/jpeg'  => 'image/jpeg',
      'image/jpg'   => 'image/jpg',
      'image/png'   => 'image/png',
      'image/gif'   => 'image/gif',
      'text/plain'  => 'text/plain; charset=utf-8',
      'text/x-diff' => 'text/plain; charset=utf-8',

      // ".ico" favicon files, which have mime type diversity. See:
      // http://en.wikipedia.org/wiki/ICO_(file_format)#MIME_type
      'image/x-ico'               => 'image/x-icon',
      'image/x-icon'              => 'image/x-icon',
      'image/vnd.microsoft.icon'  => 'image/x-icon',

      // This is a generic type for both OGG video and OGG audio.
      'application/ogg' => 'application/ogg',

      'audio/x-wav' => 'audio/x-wav',
      'audio/mpeg' => 'audio/mpeg',
      'audio/ogg' => 'audio/ogg',

      'video/mp4' => 'video/mp4',
      'video/ogg' => 'video/ogg',
      'video/webm' => 'video/webm',
      'video/quicktime' => 'video/quicktime',

      'application/pdf' => 'application/pdf',
    );

    $image_default = array(
      'image/jpeg'                => true,
      'image/jpg'                 => true,
      'image/png'                 => true,
      'image/gif'                 => true,
      'image/x-ico'               => true,
      'image/x-icon'              => true,
      'image/vnd.microsoft.icon'  => true,
    );


    // The "application/ogg" type is listed as both an audio and video type,
    // because it may contain either type of content.

    $audio_default = array(
      'audio/x-wav' => true,
      'audio/mpeg' => true,
      'audio/ogg' => true,

      // These are video or ambiguous types, but can be forced to render as
      // audio with `media=audio`, which seems to work properly in browsers.
      // (For example, you can embed a music video as audio if you just want
      // to set the mood for your task without distracting viewers.)
      'video/mp4' => true,
      'video/ogg' => true,
      'video/quicktime' => true,
      'application/ogg' => true,
    );

    $video_default = array(
      'video/mp4' => true,
      'video/ogg' => true,
      'video/webm' => true,
      'video/quicktime' => true,
      'application/ogg' => true,
    );

    // largely lifted from http://en.wikipedia.org/wiki/Internet_media_type
    $icon_default = array(
      // audio file icon
      'audio/basic' => 'fa-file-audio',
      'audio/L24' => 'fa-file-audio',
      'audio/mp4' => 'fa-file-audio',
      'audio/mpeg' => 'fa-file-audio',
      'audio/ogg' => 'fa-file-audio',
      'audio/vorbis' => 'fa-file-audio',
      'audio/vnd.rn-realaudio' => 'fa-file-audio',
      'audio/vnd.wave' => 'fa-file-audio',
      'audio/webm' => 'fa-file-audio',
      // movie file icon
      'video/mpeg' => 'fa-file-movie',
      'video/mp4' => 'fa-file-movie',
      'application/ogg' => 'fa-file-movie',
      'video/ogg' => 'fa-file-movie',
      'video/quicktime' => 'fa-file-movie',
      'video/webm' => 'fa-file-movie',
      'video/x-matroska' => 'fa-file-movie',
      'video/x-ms-wmv' => 'fa-file-movie',
      'video/x-flv' => 'fa-file-movie',
      // pdf file icon
      'application/pdf' => 'fa-file-pdf',
      // zip file icon
      'application/zip' => 'fa-file-zip',
      // msword icon
      'application/msword' => 'fa-file-word',
      // msexcel
      'application/vnd.ms-excel' => 'fa-file-excel',
      // mspowerpoint
      'application/vnd.ms-powerpoint' => 'fa-file-powerpoint',

    ) + array_fill_keys(array_keys($image_default), 'fa-file-image');

    // NOTE: These options are locked primarily because adding "text/plain"
    // as an image MIME type increases SSRF vulnerability by allowing users
    // to load text files from remote servers as "images" (see T6755 for
    // discussion).

    return array(
      $this->newOption('files.viewable-mime-types', 'wild', $viewable_default)
        ->setLocked(true)
        ->setSummary(
          pht('Configure which MIME types are viewable in the browser.'))
        ->setDescription(
          pht(
            "Configure which uploaded file types may be viewed directly ".
            "in the browser. Other file types will be downloaded instead ".
            "of displayed. This is mainly a usability consideration, since ".
            "browsers tend to freak out when viewing very large binary files.".
            "\n\n".
            "The keys in this map are viewable MIME types; the values are ".
            "the MIME types they are delivered as when they are viewed in ".
            "the browser.")),
      $this->newOption('files.image-mime-types', 'set', $image_default)
        ->setLocked(true)
        ->setSummary(pht('Configure which MIME types are images.'))
        ->setDescription(
          pht(
            'List of MIME types which can be used as the `%s` for an `%s` tag.',
            'src',
            '<img />')),
      $this->newOption('files.audio-mime-types', 'set', $audio_default)
        ->setLocked(true)
        ->setSummary(pht('Configure which MIME types are audio.'))
        ->setDescription(
          pht(
            'List of MIME types which can be rendered with an `%s` tag.',
            '<audio />')),
      $this->newOption('files.video-mime-types', 'set', $video_default)
        ->setLocked(true)
        ->setSummary(pht('Configure which MIME types are video.'))
        ->setDescription(
          pht(
            'List of MIME types which can be rendered with a `%s` tag.',
            '<video />')),
      $this->newOption('files.icon-mime-types', 'wild', $icon_default)
        ->setLocked(true)
        ->setSummary(pht('Configure which MIME types map to which icons.'))
        ->setDescription(
          pht(
            'Map of MIME type to icon name. MIME types which can not be '.
            'found default to icon `%s`.',
            'doc_files')),
      $this->newOption('storage.mysql-engine.max-size', 'int', 1000000)
        ->setSummary(
          pht(
            'Configure the largest file which will be put into the MySQL '.
            'storage engine.')),
      $this->newOption('storage.local-disk.path', 'string', null)
        ->setLocked(true)
        ->setSummary(pht('Local storage disk path.'))
        ->setDescription(
          pht(
            "Phabricator provides a local disk storage engine, which just ".
            "writes files to some directory on local disk. The webserver ".
            "must have read/write permissions on this directory. This is ".
            "straightforward and suitable for most installs, but will not ".
            "scale past one web frontend unless the path is actually an NFS ".
            "mount, since you'll end up with some of the files written to ".
            "each web frontend and no way for them to share. To use the ".
            "local disk storage engine, specify the path to a directory ".
            "here. To disable it, specify null.")),
     $this->newOption('storage.s3.bucket', 'string', null)
        ->setSummary(pht('Amazon S3 bucket.'))
        ->setDescription(
          pht(
            "Set this to a valid Amazon S3 bucket to store files there. You ".
            "must also configure S3 access keys in the 'Amazon Web Services' ".
            "group.")),
      $this->newOption('storage.local-disk.limit-enabled', 'bool', false)
      ->setBoolOptions(
        array(
          pht('Enable'),
          pht('Disable'),
        ))
      ->setDescription(
        pht(
          'Enable limitation of the Local Storage storage engine. Useful when '.
          'cloudflare is enabled as proxy.')),
      $this->newOption('storage.local-disk.max-size', 'int', 104857600)
      ->setSummary(
        pht(
          'Configure the largest file which will be put into the Local Storage '.
          'storage engine.')),
     $this->newOption('files.enable-imagemagick', 'bool', false)
       ->setBoolOptions(
         array(
           pht('Enable'),
           pht('Disable'),
         ))
        ->setDescription(
          pht(
            'This option will use Imagemagick to rescale images, so animated '.
            'GIFs can be thumbnailed and set as profile pictures. Imagemagick '.
            'must be installed and the "%s" binary must be available to '.
            'the webserver for this to work.',
            'convert')),

    );
  }

}
