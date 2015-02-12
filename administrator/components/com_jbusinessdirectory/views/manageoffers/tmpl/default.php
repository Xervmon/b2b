<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php
/**
 * @copyright	Copyright (C) 2008-2009 CMSJunkie. All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

if( JRequest::getString( 'task') !='edit' && JRequest::getString( 'task') !='add' && JRequest::getString( 'task') !='editCompanyInfo' )
{
	$listOrder	= $this->escape($this->state->get('list.ordering'));
	$listDirn	= $this->escape($this->state->get('list.direction'));
	?>
<form action="index.php" method="post" name="adminForm">
	<div id="editcell">
		<fieldset id="filter-bar">
			<div class="filter-search fltlft">
				<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
				<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />
	
				<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
				<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
			</div>
			<div class="filter-select fltrt">
				<select name="filter_state_id" class="inputbox" onchange="this.form.submit()">
					<option value=""><?php echo JText::_('LNG_JOPTION_SELECT_STATE');?></option>
					<?php echo JHtml::_('select.options', $this->states, 'value', 'text', $this->state->get('filter.state_id'));?>
				</select>
				<select name="filter_status_id" class="inputbox" onchange="this.form.submit()">
					<option value=""><?php echo JText::_('LNG_JOPTION_SELECT_STATUS');?></option>
					<?php echo JHtml::_('select.options', $this->statuses, 'value', 'text', $this->state->get('filter.status_id'));?>
				</select>
			</div>
		</fieldset>
		<div class="clr"> </div>
	
		<TABLE class="adminlist">
			<thead>
				<th width='1%'>#</th>
				<th width='1%' >&nbsp;</th>
				<th width='23%' ><?php echo JHtml::_('grid.sort', 'LNG_NAME', 'co.subject', $listDirn, $listOrder); ?></th>
				<th width='23%' ><?php echo JHtml::_('grid.sort', 'LNG_COMPANY', 'cp.name', $listDirn, $listOrder); ?></th>
				<th width='10%' ><?php echo JHtml::_('grid.sort', 'LNG_PRICE', 'co.price', $listDirn, $listOrder); ?></th>
				<th width='10%' ><?php echo JHtml::_('grid.sort', 'LNG_SPECIAL_PRICE', 'co.special_price', $listDirn, $listOrder); ?></th>
				<th width='10%' ><?php echo JHtml::_('grid.sort', 'LNG_START_DATE', 'co.startDate', $listDirn, $listOrder); ?></th>
				<th width='10%' ><?php echo JHtml::_('grid.sort', 'LNG_END_DATE', 'co.endDate', $listDirn, $listOrder); ?></th>
				<th><?php echo JHtml::_('grid.sort', 'LNG_VIEW_NUMBER', 'co.viewCount', $listDirn, $listOrder); ?></th>
				<th width='10%' ><?php echo JHtml::_('grid.sort', 'LNG_OFFER_OF_THE_DAY', 'co.offerOfTheDay', $listDirn, $listOrder); ?></th>
				<th width='10%' ><?php echo JHtml::_('grid.sort', 'LNG_STATE', 'co.state', $listDirn, $listOrder); ?></th>
				<th width='10%' ><?php echo JHtml::_('grid.sort', 'LNG_APROVED', 'co.approved', $listDirn, $listOrder); ?></th>
				<th align=center ><?php echo JText::_('LNG_ID'); ?></th>	
			</thead>
			<tbody>

			
			<?php
			$nrcrt = 1;
			//if(0)
			foreach( $this->items as $offer)
			{
				?>
				<TR class="row<?php echo $i%2?>"
					onmouseover="this.style.cursor='hand';this.style.cursor='pointer'"
					onmouseout="this.style.cursor='default'">
					<TD align=center><?php echo $nrcrt++?></TD>
					<TD align=center>
						<input type="radio" name="boxchecked"
							id="boxchecked" value="<?php echo $offer->id?>"
							onclick="adminForm.offerId.value = '<?php echo $offer->id?>'" /> 
					</TD>
					<TD align=left><a
						href='<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&controller=manageoffers&view=manageoffers&task=edit&offerId='. $offer->id )?>'
						title="<?php echo JText::_('LNG_CLICK_TO_EDIT'); ?>"> <B><?php echo $offer->subject?>
						</B>
					</a>
					</TD>
					<td>
						<?php echo $offer->companyName ?>
					</td>
					<td>
						<?php echo $offer->price?>
					</td>
					<td>
						<?php echo $offer->specialPrice ?>
					</td>
					<td>
						<?php echo getDateGeneralFormat($offer->startDate) ?>
					</td>
					<td>
						<?php echo getDateGeneralFormat($offer->endDate) ?>
					</td>
					<td>
						<?php echo $offer->viewCount ?>
					</td>
					<td valign=top align=center>
							<img  
								src ="<?php echo JURI::base() ."components/".getComponentName()."/assets/img/".($offer->offerOfTheDay==0? "unchecked.gif" : "checked.gif")?>" 
								onclick	=	"	
												document.location.href = '<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&controller=manageoffers&view=manageoffers&task=changeStateOfferOfTheDay&offerId='. $offer->id )?> '
											"
							/>
					</td>
					<td valign=top align=center>
							<img  
								src ="<?php echo JURI::base() ."components/".getComponentName()."/assets/img/".($offer->state==0? "unchecked.gif" : "checked.gif")?>" 
								onclick	=	"	
												document.location.href = '<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&controller=manageoffers&view=manageoffers&task=chageState&offerId='. $offer->id )?> '
											"
							/>
					</td>
					<td>
						<?php echo $offer->approved ?>
					</td>
				</TR>
			<?php
			}
			?>
			</tbody>
			<tfoot>
			    <tr>
			      <td colspan="14"><?php echo $this->pagination->getListFooter(); ?></td>
			    </tr>
			 </tfoot>
		</TABLE>
	</div>
	<input type="hidden" name="option"	value="<?php echo getComponentName()?>" />
	 <input type="hidden" name="task" value="" /> 
	 <input type="hidden" name="view" value="manageoffers" /> 
	 <input type="hidden" name="offerId" value="" />
	 <input type="hidden" name="controller" id="contoller" value="<?php echo JRequest::getCmd('controller', 'J-BusinessDirectory')?>" />
	 <input type="hidden" name="boxchecked" value="0" />
	 <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	 <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	
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

			if( pressbutton =='back' )
			{
				form.elements['task'].value 		= '';
				form.elements['view'].value 		= '';
				form.elements['controller'].value 	= '';
				submitform( pressbutton )
			}
	         
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
	require_once 'editoffer.php';
}
?>

