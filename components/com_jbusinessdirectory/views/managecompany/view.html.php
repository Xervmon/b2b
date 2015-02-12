<?php /*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );


require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'managecategories.php');
require_once(JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php');


JHTML::_('stylesheet', 	'administrator/components/com_jbusinessdirectory/assets/css/validationEngine.jquery.css');

JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/manage.companies.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/jquery.upload.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine-en.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine.js');
JHTML::_('script', 'https://maps.google.com/maps/api/js?sensor=true&libraries=places');

JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/jquery.selectlist.js');


class JBusinessDirectoryViewManageCompany extends JViewLegacy
{

	function __construct()
	{
		parent::__construct();
	}
	
	
	function display($tpl = null)
	{
		$this->item = $this->get('Item'); 
		$this->state = $this->get('State');
		$this->packageOptions = JBusinessDirectoryHelper::getPackageOptions();
		
		$this->appsettings = JBusinessUtil::getInstance()->getApplicationSettings();
		$model=new JBusinessDirectoryModelManageCategories();
	
		$categories =$model->getCategories();
		$this->item->categories = $categories;
		
		$this->item->maxLevel = $categories["maxLevel"];
	
		$this->location = $this->get('Location');
	
		$user = JFactory::getUser();
		if($this->item->userId != $user->id && $this->item->id !=0){
			$msg = JText::_("LNG_ACCESS_RESTRICTED");
			$app =& JFactory::getApplication();
			$app->redirect(JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanies', $msg));
		}
		
		$layout = JRequest::getVar("layout");

		if(!empty($layout))
			$this->setLayout($layout);
		
		parent::display($tpl);
	}
	
	function displayCompanyCategories($categories, $level){
		ob_start();
		?>
			
		<select class="category-box" id="category<?php echo $level ?>"
				onchange ="displaySubcategories('category<?php echo $level ?>',<?php echo $level ?>,4)">
			<option value=""></option>	
		<?php 
			foreach ($categories as $cat){
				if(isset($cat[0]->name)){?>
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
?>
