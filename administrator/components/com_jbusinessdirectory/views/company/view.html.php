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

JHTML::_('stylesheet', 	'administrator/components/com_jbusinessdirectory/assets/css/validationEngine.jquery.css');

JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/manage.companies.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/jquery.upload.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine-en.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine.js');
JHTML::_('script', 'https://maps-api-ssl.google.com/maps/api/js?sensor=true&libraries=places');
 
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'managecategories.php');
require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php';

class JBusinessDirectoryViewCompany extends JViewLegacy
{
	protected $item;
	protected $state;
	protected $packages;
	protected $claimDetails;

	/**
	 * Display the view
	 */
	public function display($tpl = null){
		$this->item	 = $this->get('Item');
		$this->state = $this->get('State');
		
		$this->appsettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		$this->claimDetails = $this->get('ClaimDetails');
		$this->packageOptions = JBusinessDirectoryHelper::getPackageOptions();
	
		$this->location = $this->get('Location');
	
		$model=new JBusinessDirectoryModelManageCategories();
		
		$categories =$model->getCategories();
		$this->item->categories = $categories;
		$this->item->maxLevel = $categories["maxLevel"];
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		parent::display($tpl);
		$this->addToolbar($this->claimDetails);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar($claimDetails)
	{	
		$canDo = JBusinessDirectoryHelper::getActions();
		$user  = JFactory::getUser();
		
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);

		$user  = JFactory::getUser();
		$isNew = ($this->item->id == 0);

		JToolbarHelper::title(JText::_($isNew ? 'COM_JBUSINESSDIRECTORY_NEW_COMPANY' : 'COM_JBUSINESSDIRECTORY_EDIT_COMPANY'), 'menu.png');

		if ($canDo->get('core.edit')){
			JToolbarHelper::apply('company.apply');	
			JToolbarHelper::save('company.save');
		}
		
		if($this->item->id > 0 && !(isset($claimDetails) && $claimDetails->status == 0)){
			JToolBarHelper::divider();
			JToolBarHelper::custom( 'company.aprove', 'publish.png', 'publish.png', JText::_("LNG_APPROVE"), false, false );
			JToolBarHelper::custom( 'company.disaprove', 'unpublish.png', 'unpublish.png', JText::_("LNG_DISAPPROVE"), false, false );
		}
			
		if(isset($claimDetails) && $claimDetails->status == 0){
			JToolBarHelper::divider();
			JToolBarHelper::custom( 'company.aproveClaim', 'publish.png', 'publish.png', JText::_("LNG_APPROVE_CLAIM"), false, false );
			JToolBarHelper::custom( 'company.disaproveClaim', 'unpublish.png', 'unpublish.png', JText::_("LNG_DISAPPROVE_CLAIM"), false, false );
			JToolBarHelper::divider();
		}
	
		JToolbarHelper::cancel('company.cancel', 'JTOOLBAR_CLOSE');
		
		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_JBUSINESSDIRECTORY_COMPANY_EDIT');
	}
	
	function displayCompanyCategories($categories, $level){
		ob_start();
		?>
		
		<select class="category-box" id="category<?php echo $level ?>"
				onchange ="displaySubcategories('category<?php echo $level ?>',<?php echo $level ?>,4)">
			<option value=""></option>	
		<?php 
			foreach ($categories as $cat){
				if(isset($cat[0]->name) && isset($cat["subCategories"]) && count($cat["subCategories"])>0){?>
					<option value="<?php echo $cat[0]->id?>"><?php echo $cat[0]->name?></option>
						
					<?php  
					}
				}
			?>
			</select>
			<?php 
			$buff = ob_get_contents();
			ob_end_clean();
			return $buff;
	}
	
	function displayCompanyCategoriesOptions($categories){
		ob_start();
		foreach ($categories as $cat){
			if(isset($cat[0]->name)){?>
				<option value="<?php echo $cat[0]->id?>"><?php echo $cat[0]->name?></option>
				<?php  
				}
			}

		$buff = ob_get_contents();
		ob_end_clean();
		return $buff;
	}
}
