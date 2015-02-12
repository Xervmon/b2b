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

class FactoryControllerAdmin extends JControllerAdmin
{
	public function getModel($name = null, $prefix = null, $config = array('ignore_request' => true))
	{
    if (is_null($name)) {
      $r = null;
			if (!preg_match('/.*Controller(.*)/i', get_class($this), $r)) {
				throw new Exception(JText::_('JLIB_APPLICATION_ERROR_CONTROLLER_GET_NAME'), 500);
			}
      $inflector = JStringInflector::getInstance();
      $name = $inflector->toSingular(strtolower($r[1]));
    }

    if (is_null($prefix)) {
      $prefix = $this->getName() . 'Model';
    }

		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

  public function saveOrderAjax()
  {
    $pks   = $this->input->post->get('cid',   array(), 'array');
		$order = $this->input->post->get('order', array(), 'array');

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return) {
			echo '1';
		}

		// Close the application
		JFactory::getApplication()->close();
  }
}
