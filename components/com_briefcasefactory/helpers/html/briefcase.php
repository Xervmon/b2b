<?php

/**
-------------------------------------------------------------------------
briefcasefactory - Briefcase Factory 4.0.8
-------------------------------------------------------------------------
 * @author thePHPfactory
 * @copyright Copyright (C) 2011 SKEPSIS Consult SRL. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.thePHPfactory.com
 * Technical Support: Forum - http://www.thePHPfactory.com/forum/
-------------------------------------------------------------------------
*/

defined('_JEXEC') or die;

class JHtmlBriefcaseFactoryBriefcase
{
  public static function resourceIcon($resource)
  {
    $class = 'folder' == $resource->type ? self::getFolderIcon($resource) : self::getFileIcon($resource);

    return '<i class="factory-icon-' . $class . '"></i>';
  }

  protected static function getFolderIcon($folder)
  {
    if (1 == $folder->general) {
      return 'blue-folder';
    }

    return 'folder';
  }

  protected static function getFileIcon($file)
  {
    jimport('joomla.filesystem.file');

    $extension = strtolower(JFile::getExt($file->filename));
    $extensions = array(
      'txt'  => 'document-text',
      'ini'  => 'document-text',
      'zip'  => 'document-zipper',
      'rar'  => 'document-zipper',
      '7z'   => 'document-zipper',
      'flv'  => 'film',
      'gif'  => 'image',
      'jpg'  => 'image',
      'jpeg' => 'image',
      'png'  => 'image',
      'pdf'  => 'document-pdf',
      'doc'  => 'document-word',
      'xls'  => 'document-excel',
    );

    if (isset($extensions[$extension])) {
      return $extensions[$extension];
    }

    return 'document';
  }
}
