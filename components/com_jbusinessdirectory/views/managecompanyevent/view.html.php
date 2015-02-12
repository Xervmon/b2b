<?php /*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );


JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/manage.companies.js');
JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/jquery.upload.js');

JHTML::_('stylesheet', 	'administrator/components/com_jbusinessdirectory/assets/css/validationEngine.jquery.css');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine-en.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine.js');

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php';

class JBusinessDirectoryViewManageCompanyEvent extends JViewLegacy
{
	function __construct()
	{
		parent::__construct();
	}
	
	function display($tpl = null)
	{
		$this->companies = $this->get('UserCompanies');
		$this->item	 = $this->get('Item');
		$this->state = $this->get('State');
		$this->states = JBusinessDirectoryHelper::getStatuses();

		//check if user has access to offer
		$user = JFactory::getUser();
		$found = false;
		foreach($this->companies as $company){
			if($company->userId == $user->id && $this->item->company_id == $company->id){
		
				$found = true;
			}
		}
		
		//redirect if the user has no access and the event is not new
		if(!$found &&  $this->item->id !=0){
			$msg = JText::_("LNG_ACCESS_RESTRICTED");
			$app =& JFactory::getApplication();
			$app->redirect(JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanyevents', $msg));
		}
		
		parent::display($tpl);
	}
}
?>
