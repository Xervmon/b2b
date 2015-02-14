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

class BriefcaseFactoryBackendControllerShare extends FactoryController
{
  public function shareGroups()
  {
    $input = JFactory::getApplication()->input;
    $data  = $input->get('jform', array(), 'array');
    $id    = $input->getInt('id');
    $model = $this->getModel('Share');

    $model->shareGroups($id, $data);

    $document = JFactory::getDocument();
    $document->addScriptDeclaration('window.parent.Joomla.submitbutton(\'file.refresh\'); window.parent.SqueezeBox.close();');
  }

  public function shareUsers()
  {
    $input = JFactory::getApplication()->input;
    $data  = $input->get('jform', array(), 'array');
    $id    = $input->getInt('id');
    $model = $this->getModel('Share');

    $model->shareUsers($id, $data);

    $document = JFactory::getDocument();
    $document->addScriptDeclaration('window.parent.Joomla.submitbutton(\'file.refresh\'); window.parent.SqueezeBox.close();');
  }
}
