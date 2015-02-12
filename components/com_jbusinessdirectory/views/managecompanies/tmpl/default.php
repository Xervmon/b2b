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


$user = JFactory::getUser();
if($user->id == 0){
	$app = JFactory::getApplication();
	$app->redirect(JRoute::_('index.php?option=com_users&view=login'));
}


JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');


$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<h1 class="title">
	<?php echo JTEXT::_("LNG_BUSINESS_LISTINGS") ?>
</h1>
<div class="button-row right">
	
	<button type="submit" class="ui-dir-button ui-dir-button-orange" onclick="Joomla.submitbutton('managecompany.add')">
			<span class="ui-button-text"><?php echo JText::_("LNG_ADD_NEW_LISTING")?></span>
	</button>

	
	<a class="ui-dir-button" href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=useroptions' )?>">
		<span class="ui-button-text"><?php echo JText::_("LNG_CONTROL_PANEL")?></span>
	</a>
</div>

<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanies');?>" method="post" name="adminForm" id="adminForm">
	
	<table class="dir-table"  id="itemList">
		<thead>
			<tr>
				<th width="1%" class="hidden-phone">#</th>
				<th width="1%" class="hidden-phone">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th>
					<?php echo JText::_("LNG_NAME")?>
				</th>
				<th><?php echo JText::_("LNG_EMAIL")?></th>
				<th><?php echo JText::_("LNG_ADDRESS")?></th>
				<th><?php echo JText::_("LNG_TYPE")?></th>
				<th width="5%" class="nowrap"><?php echo JText::_("LNG_VIEW_NUMBER")?></th>
				<th width="5%" class="nowrap"><?php echo JText::_("LNG_CONTACT_NUMBER")?></th>
				<th><?php echo JText::_("LNG_STATE")?></th>
				<th nowrap width="1%"><?php echo JText::_("LNG_ID")?></th>
				<th></th>
			</tr>
		</thead>
		<tfoot>
				<tr>
					<td colspan="15">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
		<tbody>

			
			<?php
			$nrcrt = 1;
			$i=0;
			//if(0)
			foreach( $this->items as $company)
			{
				?>
				<TR class="row<?php echo $i % 2; ?>"
					onmouseover="this.style.cursor='hand';this.style.cursor='pointer'"
					onmouseout="this.style.cursor='default'">
					<TD class="center hidden-phone"><?php echo $nrcrt++?></TD>
					<TD align=center>
						<?php echo JHtml::_('grid.id', $i, $company->id); ?>
					</TD>
					<TD align=left>
						<?php if($company->approved != COMPANY_STATUS_CLAIMED){ ?>
						<a
							href='<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&task=managecompany.edit&'.JSession::getFormToken().'=1&id='. $company->id )?>'
							title="<?php echo JText::_('LNG_CLICK_TO_EDIT'); ?>"> 
								<strong><?php echo $company->name?></strong>
						</a>
						<?php }else{ ?>
							<strong><?php echo $company->name?></strong>
						 <?php } ?>
					</TD>
					<td>
						<?php echo $company->email ?>
					</td>
					<td>
						<?php echo $company->address.', '.$company->city.', '.$company->country ?>
					</td>
					<td>
						<?php echo $company->typeName ?>
					</td>
					<td class="center">
						<?php echo $company->viewCount ?>
					</td>
					<td class="center">
						<?php echo $company->contactCount ?>
					</td>
					<td valign=top align=center>
							<img  
								src ="<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/".($company->state==0? "unchecked.gif" : "checked.gif")?>" 
								onclick	=	"	
												document.location.href = '<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&task=managecompany.changeState&id='. $company->id )?> '
											"
							/>
					</td>
					<td class="center hidden-phone">
						<span><?php echo (int) $company->id; ?></span>
					</td>
					<td>
						<?php if($company->approved != COMPANY_STATUS_CLAIMED){ ?>
							<a href="<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&task=managecompany.edit&'.JSession::getFormToken().'=1&id='. $company->id )?>"
							title="<?php echo JText::_('LNG_CLICK_TO_EDIT'); ?>"><?php echo JText::_('LNG_EDIT'); ?>
							</a>
													
							&nbsp;|&nbsp;
							<a href="javascript:deleteDirListing(<?php echo $company->id ?>)" title="<?php echo JText::_('LNG_CLICK_TO_DELETE'); ?>"><?php echo JText::_('LNG_DELETE'); ?></a>
						<?php } ?>
					</td>
				</TR>
			<?php
				$i++;
			}
			?>
			</tbody>
		</table>
	 
	 <input type="hidden" name="option"	value="<?php echo JBusinessUtil::getComponentName()?>" />
	 <input type="hidden" name="task" id="task" value="" /> 
	 <input type="hidden" name="companyId" value="" />
	 <input type="hidden" id="cid" name="cid" value="" />
	 <input type="hidden" name="boxchecked" value="0" />
	 <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	 <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	 <?php echo JHTML::_( 'form.token' ); ?> 
</form>

<script>
function deleteDirListing(id){
	if(confirm('<?php echo JText::_('COM_JBUSINESS_DIRECTORY_COMPANIES_CONFIRM_DELETE', true);?>')){
		jQuery("#cid").val(id);
		jQuery("#task").val("managecompanies.delete");
		jQuery("#adminForm").submit();
	}
}
</script>