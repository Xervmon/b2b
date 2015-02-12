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

class BriefcaseFactoryBackendModelStorageFolder extends JModelLegacy
{
  protected $folder = null;

  public function getFolder()
  {
    if (is_null($this->folder)) {
      $input = JFactory::getApplication()->input;

      $this->folder = realpath(base64_decode($input->get->getBase64('folder')));
    }

    return $this->folder;
  }

  public function getFolders()
  {
    jimport('joomla.filesystem.folder');

    return JFolder::folders($this->getFolder());
  }
}
