<?php
/*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );


require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'managecategories.php');

class JBusinessDirectoryViewManageCompanies extends JViewLegacy
{
	function display($tpl = null)
	{
		if( 
			JRequest::getString( 'task') !='edit' 
			&& 
			JRequest::getString( 'task') !='add' 
		) 
		{
			JToolBarHelper::title(   'J-BusinessDirectory : '.JText::_('LNG_COMPANY_SETTINGS'), 'generic.png' );
			// JRequest::setVar( 'hidemainmenu', 1 );  
			JToolBarHelper::addNewX(); 
			JToolBarHelper::editList();
			JToolBarHelper::divider();
			JToolBarHelper::deleteList(JText::_('LNG_ARE_YOU_SURE_YOU_WANT_TO_DELETE'), 'Delete',  JText::_("LNG_DELETE"), 'Delete button', false, false );
			JToolBarHelper::divider();
			JToolBarHelper::custom( 'back', 'preview.png', 'preview.png', JText::_("LNG_CONTROL_PANEL"), false, false );
						
			$this->state		= $this->get('State');
			$this->statuses		= $this->get('Statuses');
			$this->states		= $this->get('States');
			$this->companyTypes	= $this->get('CompanyTypes');
				
			$items		= $this->get('Datas'); 
			$pagination = $this->get('Pagination');
			
			// push data into the template
			$this->assignRef('items', $items);
			$this->assignRef('pagination', $pagination);	

			// Check for errors.
			if (count($errors = $this->get('Errors'))) {
				JError::raiseError(500, implode("\n", $errors));
				return false;
			}
			
		}
		else
		{
			$item = $this->get('Data'); 
			
			$claimDetails = $this->get('ClaimDetails');
			$this->assignRef('claimDetails', $claimDetails);
			
			$model=new JBusinessDirectoryModelManageCategories();

			$categories =$model->getCategories();
			$item->categories = $categories;
			
			$item->maxLevel = $categories["maxLevel"];
		
			$this->assignRef('item', $item);
			
			JToolBarHelper::title(   'J-BusinessDirectory : '.( $item->currency_id > 0? JText::_("LNG_EDIT") : JText::_("LNG_ADD_NEW") ).' '.JText::_('LNG_COMPANY'), 'generic.png' );
			JRequest::setVar( 'hidemainmenu', 1 );  
			JToolBarHelper::save(); 
			if($item->id > 0 && !(isset($claimDetails) && $claimDetails->status == 0)){
				JToolBarHelper::divider();
				JToolBarHelper::custom( 'aprove', 'publish.png', 'publish.png', JText::_("LNG_APPROVE"), false, false );
				JToolBarHelper::custom( 'disaprove', 'unpublish.png', 'unpublish.png', JText::_("LNG_DISAPPROVE"), false, false );
				
			}
			
			if(isset($claimDetails) && $claimDetails->status == 0){
				JToolBarHelper::divider();
				JToolBarHelper::custom( 'aproveClaim', 'publish.png', 'publish.png', JText::_("LNG_APPROVE_CLAIM"), false, false );
				JToolBarHelper::custom( 'disaproveClaim', 'unpublish.png', 'unpublish.png', JText::_("LNG_DISAPPROVE_CLAIM"), false, false );
				
				
			}
			JToolBarHelper::divider();
			JToolBarHelper::cancel();
		}
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