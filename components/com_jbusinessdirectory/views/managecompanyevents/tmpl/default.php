
<?php /*------------------------------------------------------------------------
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

$isProfile = true;
//include(JPATH_COMPONENT_ADMINISTRATOR.DS.'views'.DS.'manageevents'.DS.'tmpl'.DS.'default.php');
?>
<script>
	var isProfile = true;
</script>
<style>
#header-box, #control-panel-link{
	display: none;
}
</style>

<h1 class="title">
	<?php echo JTEXT::_("LNG_EVENTS") ?>
</h1>

<div class="button-row right">
	<button type="button" class="ui-dir-button ui-dir-button-orange" onclick="addDirEvent()">
			<span class="ui-button-text"><?php echo JText::_("LNG_ADD_NEW_EVENT")?></span>
	</button>

	<a class="ui-dir-button" href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=useroptions' )?>">
		<span class="ui-button-text"><?php echo JText::_("LNG_CONTROL_PANEL")?></span>
	</a>
</div>

<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanyevent');?>" method="post" name="eventForm" id="eventForm">
	<div id="editcell">
		<TABLE class="dir-table">
			<thead>
				<tr>
					<th width='1%'>#</th>
					<th width='13%' ><?php echo JText::_( 'LNG_NAME'); ?></th>
					<th width='13%' ><?php echo JText::_( 'LNG_COMPANY'); ?></th>
					<th width='10%' ><?php echo JText::_( 'LNG_TYPE'); ?></th>
					<th width='10%' ><?php echo JText::_( 'LNG_LOCATION'); ?></th>
					<th width='10%' ><?php echo JText::_( 'LNG_START_DATE'); ?></th>
					<th width='10%' ><?php echo JText::_( 'LNG_END_DATE'); ?></th>
					<th><?php echo JText::_( 'LNG_VIEW_NUMBER'); ?></th>
					<th width='10%' ><?php echo JText::_( 'LNG_STATE'); ?></th>
					<th nowrap width='1%' ><?php echo JText::_('LNG_ID'); ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>

			
			<?php
			$nrcrt = 1;
			$i=0;
			//if(0)
			foreach( $this->items as $event)
			{
				?>
				<TR class="row<?php echo $i % 2; ?>"
					onmouseover="this.style.cursor='hand';this.style.cursor='pointer'"
					onmouseout="this.style.cursor='default'">
					<TD class="center hidden-phone"><?php echo $nrcrt++?></TD>
					<TD align=left><a
						href='<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&task=managecompanyevent.edit&'.JSession::getFormToken().'=1&id='. $event->id )?>'
						title="<?php echo JText::_('LNG_CLICK_TO_EDIT'); ?>"> <B><?php echo $event->name?>
						</B>
					</a>
					</TD>
					<td>
						<?php echo $event->companyName ?>
					</td>
					<td>
						<?php echo $event->type?>
					</td>
					<td>
						<?php echo $event->location ?>
					</td>
					<td>
						<?php echo JBusinessUtil::getDateGeneralFormat($event->start_date) ?>
					</td>
					<td>
						<?php echo JBusinessUtil::getDateGeneralFormat($event->end_date) ?>
					</td>
					<td>
						<?php echo $event->view_count ?>
					</td>
					<td valign=top align=center>
							<img  
								src ="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName()."/assets/images/".($event->state==0? "unchecked.gif" : "checked.gif")?>" 
								onclick	=	"	
												document.location.href = '<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&task=managecompanyevent.chageState&id='. $event->id )?> '
											"
							/>
					</td>
					
					<td>
						<?php echo $event->id?>
					</td>
					<td nowrap="nowrap">
						<a
						href='<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&task=managecompanyevent.edit&'.JSession::getFormToken().'=1&id='. $event->id )?>'
						title="<?php echo JText::_('LNG_CLICK_TO_EDIT'); ?>"><?php echo JText::_('LNG_EDIT'); ?>
						</a>
						&nbsp;|&nbsp;
						<a href="javascript:deleteDirEvent(<?php echo $event->id ?>)"><?php echo JText::_('LNG_DELETE'); ?></a>
					</td>
				</TR>
			<?php
				$i++;
			}
			?>
			</tbody>
			<tfoot>
			    <tr>
			      <td colspan="11"><?php echo $this->pagination->getListFooter(); ?></td>
			    </tr>
			 </tfoot>
		</TABLE>
	</div>
	<input type="hidden" name="option"	value="<?php echo JBusinessUtil::getComponentName()?>" />
	 <input type="hidden" name="task" id="task" value="" /> 
	 <input type="hidden" name="id" id="id" value="" />
	 <input type="hidden" name="Itemid" id="Itemid" value="163" />
	 <input type="hidden" name="companyId" id="companyId" value="<?php echo $this->companyId ?>" />
	 	
	<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<div class="clear"></div>
<script>
	function editEvent(eventId){
		jQuery("#id").val(eventId);
		jQuery("#task").val("managecompanyevent.edit");
		jQuery("#eventForm").submit();
	}

	function addDirEvent(){
		jQuery("#id").val(0);
		jQuery("#task").val("managecompanyevent.add");
		jQuery("#eventForm").submit();
	}

	function deleteDirEvent(eventId){
		if(confirm('<?php echo JText::_('COM_JBUSINESS_DIRECTORY_EVENTS_CONFIRM_DELETE', true);?>')){
			jQuery("#id").val(eventId);
			jQuery("#task").val("managecompanyevents.delete");
			jQuery("#eventForm").submit();
		}
	}
</script>

