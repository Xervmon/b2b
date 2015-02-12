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

if( JRequest::getString( 'task') !='edit' && JRequest::getString( 'task') !='add' )
{
?>
<form action="index.php" method="post" name="adminForm">
	<div id="editcell">
		<TABLE class="adminlist" >
			<thead>
				<th width='1%'>#</th>
				<th width='1%'  align=center>&nbsp;</th>
				<th align=center><B><?php echo JText::_('LNG_NAME'); ?></B></th>
				<th align=center><B><?php echo JText::_('LNG_SUBJECT'); ?></B></th>
				<th align=center ><B><?php echo JText::_('LNG_DESCRIPTION'); ?></B></th>
				<th align=center ><B><?php echo JText::_('LNG_USER'); ?></B></th>
				<th width='5%' align=center ><B><?php echo JText::_('LNG_LIKE_COUNT'); ?></B></th>
				<th width='5%' align=center ><B><?php echo JText::_('LNG_DISLIKE_COUNT'); ?></B></th>
				<th align=center ><B><?php echo JText::_('LNG_COMPANY'); ?></B></th>
				<th  width='10%' align=center ><B><?php echo JText::_('LNG_CREATION_DATE'); ?></B></th>			
				<th align=center ><B><?php echo JText::_('LNG_STATE'); ?></B></th>			
				<th align=center ><B><?php echo JText::_('LNG_APROVED'); ?></B></th>	
				<th align=center ><B><?php echo JText::_('LNG_ID'); ?></B></th>		
			</thead>
			<tbody>
			<?php
			$nrcrt = 1;
			//if(0)
			//dump($this->items);
			foreach($this->items as $review)
			{

			?>
			<TR class="row<?php echo $i%2?>"
				onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
				onmouseout	=	"this.style.cursor='default'"
			>
				<TD align=center><?php echo $nrcrt++?></TD>
				<TD align=center>
					 <input type="radio" name="boxchecked"  id="boxchecked" 
						value="<?php echo $review->id ?>" 
						onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
						onmouseout	=	"this.style.cursor='default'"
						<?php echo $currency->is_default_app ? (" disabled TITLE='".JText::_("LNG_CURRENCY_APPLICATION_DEFAULT")."'") : ""?>
						onclick="
									adminForm.reviewId.value = '<?php echo $review->id?>'
								" 
					/>
					
				</TD>
				<td>
					<?php echo $review->name?>
				</td>
				<TD align=left>
					
					<a href='<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&controller=manageratings&view=manageratings&task=edit&reviewId='. $review->id )?>'
						title		= 	"<?php echo JText::_('LNG_CLICK_TO_EDIT'); ?>"
					>
						<B><?php echo $review->subject?></B>
					</a>	
					
				</TD>
				<td>
					<?php echo $review->description?>
				</td>
				<td>
					<?php echo $review->userName?>
				</td>
				<td align=center>
					<?php echo $review->likeCount?>
				</td>
				<td align=center>
					<?php echo $review->dislikeCount?>
				</td>
				<td>
					<?php echo $review->companyName?>
				</td>
				<td align=center>
					<?php echo getDateGeneralFormatWithTime($review->creationDate)?>
				</td>
				<td valign=top align=center>
							<img  
								src ="<?php echo JURI::base() ."components/".getComponentName()."/assets/img/".($review->state==0? "unchecked.gif" : "checked.gif")?>" 
								onclick	=	"	
												document.location.href = '<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&controller=manageratings&view=manageratings&task=chageState&reviewId='. $review->id )?> '
											"
							/>
				</td>
				<td>
					<?php  
							switch($review->approved){
								case 0:
									echo JTEXT::_("LNG_NEEDS_APPROVAL");
									break;
								case -1:
									echo JTEXT::_("LNG_DISAPPROVED");
									break;
								case 1:
									echo JTEXT::_("LNG_APPROVED");
									break;
							}
					?>
				</td>
				<td>
					<?php echo $review->id?>
				</td>
			</TR>
			<?php
			}
			?>
			</tbody>
		</TABLE>
	</div>
	<input type="hidden" name="option" value="<?php echo getComponentName()?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="reviewId" value="" />
	<input type="hidden" name="controller" value="<?php echo JRequest::getCmd('controller', 'J-BusinessDirectory')?>" />
	<?php echo JHTML::_( 'form.token' ); ?> 
	<script  type="text/javascript">
		<?php
		if( getCurrentJoomlaVersion() < 1.6 )
		{
		?>
		function submitbutton(pressbutton) 
		<?php
		}
		else
		{
		?>
		Joomla.submitbutton = function(pressbutton) 
		<?php
		}
		?>
		{
			var form = document.adminForm;
			if (pressbutton == 'edit' || pressbutton == 'Delete') 
			{
				var isSel = false;
				if( form.elements['boxchecked'].length == null )
				{
					if(form.elements['boxchecked'].checked)
					{
						isSel = true;
					}
				}
				else
				{
					for( i = 0; i < form.boxchecked.length; i ++ )
					{
						if(form.elements['boxchecked'][i].checked)
						{
							isSel = true;
							break;
						}
					}
				}
				
				if( isSel == false )
				{
					alert('<?php echo JText::_('LNG_YOU_MUST_SELECT_ONE_RECORD')?>');
					return false;
				}
				submitform( pressbutton );
				return;
			} else {
				submitform( pressbutton );
			}
		}
	</script>
</form>
<?php
}
else
{

?>
<form action="index.php" method="post" name="adminForm">
	<fieldset class="adminform">
		<legend><?php echo JText::_('LNG_EDIT_REVIEW'); ?></legend>

		<TABLE class="admintable" align="left" border="0">
			<tr>
				<td class="key"><?php echo JText::_('LNG_NAME'); ?></td>
				<td><input type="text" name="name" id="name" size="50" value="<?php echo $this->item->name ?>"></td>
				<TD>&nbsp;</TD>
			</tr>
			<tr>
				<td class="key"><?php echo JText::_('LNG_SUBJECT'); ?></td>
				<td><input type="text" name="subject" id="subject" size="50" value="<?php echo $this->item->subject ?>"></td>
				<TD>&nbsp;</TD>
			</tr>
			<tr>
				<TD class="key"><?php echo JText::_('LNG_DESCRIPTION'); ?></TD>
				<td><textarea  name="description" id="description" style="width:600px;height:120px" cols="80" rows="10"><?php echo $this->item->description ?></textarea>
				<TD>&nbsp;</TD>
			</tr>			
		</TABLE>
	</fieldset>
	<script  type="text/javascript">
	<?php
	if( getCurrentJoomlaVersion() < 1.6 )
	{
	?>
	function submitbutton(pressbutton) 
	<?php
	}
	else
	{
	?>
	Joomla.submitbutton = function(pressbutton) 
	<?php
	}
	?>
	{
		var form = document.adminForm;
		if(pressbutton == 'aprove'){
			jQuery("task").val("aprove");
			submitform(pressbutton);
		} else if(pressbutton == 'disaprove'){	
			jQuery("task").val("disaprove");
			submitform(pressbutton);
		}else if (pressbutton == 'save') 
		{
			submitform( pressbutton );
			return;
		} else {
			submitform( pressbutton );
		}
	}
	</script>
	<input type="hidden" name="option" value="<?php echo getComponentName()?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="reviewId" value="<?php echo $this->item->id ?>" />
	<input type="hidden" name="controller" value="manageratings" />
	<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<?php
}
?>

