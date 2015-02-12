<?php
/**
 * @package    JBusinessDirectory
 * @subpackage  com_jbusinessdirectory
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * The HTML  View.
 */

JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/manage.companies.js');
JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/jquery.upload.js');
JHTML::_('script', 'https://maps.google.com/maps/api/js?sensor=true&libraries=places');

JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine-en.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine.js');

require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'managecategories.php');
require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php';

class JBusinessDirectoryViewOffer extends JViewLegacy
{
	protected $item;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null){
	
		$this->item	 = $this->get('Item');
		$this->state = $this->get('State');

		$this->companies = $this->get('Companies');
		
		$this->states = JBusinessDirectoryHelper::getStatuses();
		
		$model=new JBusinessDirectoryModelManageCategories();
		$categories =$model->getCategories();
		$this->categories = $categories;
		$this->maxLevel = $categories["maxLevel"];
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		$canDo = JBusinessDirectoryHelper::getActions();
		$user  = JFactory::getUser();
		
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);

		$user  = JFactory::getUser();
		$isNew = ($this->item->id == 0);

		JToolbarHelper::title(JText::_($isNew ? 'COM_JBUSINESSDIRECTORY_NEW_OFFER' : 'COM_JBUSINESSDIRECTORY_EDIT_OFFER'), 'menu.png');
		
		if ($canDo->get('core.edit')){
			JToolbarHelper::apply('offer.apply');
			JToolbarHelper::save('offer.save');
		}
		
		if($this->item->id > 0){
			JToolBarHelper::divider();
			JToolBarHelper::custom( 'offer.aprove', 'publish.png', 'publish.png', JText::_("LNG_APPROVE"), false, false );
			JToolBarHelper::custom( 'offer.disaprove', 'unpublish.png', 'unpublish.png', JText::_("LNG_DISAPPROVE"), false, false );
			JToolBarHelper::divider();
		}
			
		JToolbarHelper::cancel('offer.cancel', 'JTOOLBAR_CLOSE');
		
		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_JBUSINESSDIRECTORY_OFFER_EDIT');
	}
	
	function displayCategoriesOptions($categories, $level, $selectedCategories){
		$delimiter = "";
		for($i=1;$i<$level;$i++){
			$delimiter.="-";
		}
		
		foreach ($categories as $cat){	
			
			$selected = false;
			foreach($selectedCategories as $sc){
				if($cat[0]->id == $sc->categoryId)
					$selected= true;
			}
			
			echo isset($cat[0]->name)? "<option value='".$cat[0]->id."'". ($selected?"selected":"").">".$delimiter." ".$cat[0]->name."</option>":""; 
			if(isset($cat["subCategories"])) {
				 $this->displayCategoriesOptions($cat["subCategories"], $level+1,$selectedCategories);
			}
		}
	
		return;
	}
	
}
