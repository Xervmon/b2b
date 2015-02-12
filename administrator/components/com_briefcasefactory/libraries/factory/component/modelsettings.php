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

class FactoryModelSettings extends FactoryModelAdmin
{
  public function save($data)
	{
    // Save the rules.
	  if (isset($data['rules'])) {
	    jimport('joomla.access.rules');
	    $rules = new JAccessRules($data['rules']);
	    $asset = JTable::getInstance('asset');

	    if (!$asset->loadByName($this->option)) {
	      $root	= JTable::getInstance('asset');
	      $root->loadByName('root.1');
	      $asset->name  = $this->option;
	      $asset->title = $this->option;
	      $asset->setLocation($root->id, 'last-child');
	    }

	    $asset->rules = (string)$rules;

	    if (!$asset->check() || !$asset->store()) {
	      $this->setError($asset->getError());
	      return false;
	    }

	    unset($data['rules']);
	  }

	  // Save component settings.
	  $extension = JTable::getInstance('Extension');
	  $id        = $extension->find(array('element' => $this->option, 'type' => 'component'));
	  $settings  = JComponentHelper::getParams($this->option);

	  $extension->load($id);
	  //$extension->bind(array('params' => array_merge($settings->toArray(), $data)));
	  $extension->bind(array('params' => $data));

    if (!$extension->store()) {
      $this->setError($extension->getError());
      return false;
    }

    return true;
	}

  protected function loadFormData()
	{
	  $result = JComponentHelper::getComponent($this->option);

	  return $result->params;
	}
}
