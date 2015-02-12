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

class BriefcaseFactoryFrontendController extends JControllerLegacy
{
  protected $default_view = 'briefcase';

  public function display($cachable = false, $urlparams = array())
  {
    $view   = $this->input->get('view');
		$layout = $this->input->get('layout');
		$id     = $this->input->getInt('id');

		// Check for edit form.
		if (($view == 'file' && $layout == 'edit' && !$this->checkEditId('com_briefcasefactory.edit.file', $id)) ||
        ($view == 'folder' && $layout == 'edit' && !$this->checkEditId('com_briefcasefactory.edit.folder', $id))
    ) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setMessage(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id), 'error');
			$this->setRedirect(FactoryRoute::view('briefcase', false));

			return false;
		}

		parent::display();

		return $this;
  }
}
