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

class BriefcaseFactoryBackendControllerBulk extends JControllerLegacy
{
  public function folder()
  {
    $folder = $this->input->getBase64('folder', '');
    $model = $this->getModel('Bulk');
    $items = $model->getFolderContents($folder);

    echo json_encode($items);

    jexit();
  }
}
