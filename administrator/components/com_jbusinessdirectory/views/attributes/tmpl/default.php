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

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= true;
$saveOrder	= $listOrder == 'ct.ordering';

?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task != 'attributes.delete' || confirm('<?php echo JText::_('COM_JBUSINESS_DIRECTORY_ATTRIBUTES_CONFIRM_DELETE', true);?>'))
		{
			Joomla.submitform(task);
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=attributes');?>" method="post" name="adminForm" id="adminForm">
	<table class="table table-striped adminlist"  id="itemList">
		<thead>
				<tr>
					<th width="1%">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
					
					<th>
						<?php echo JHtml::_('grid.sort', 'LNG_NAME', 'a.name', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?php echo JHtml::_('grid.sort', 'LNG_TYPE', 'at.type', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?php echo JText::_( 'LNG_OPTIONS' );?>
					</th>
					<th>
						<?php echo JText::_( 'LNG_STATUS' );?>
					</th>
					<th width="10%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ORDERING', 'ct.ordering', $listDirn, $listOrder); ?>
						<?php if ($canOrder && $saveOrder) :?>
							<?php echo JHtml::_('grid.order', $this->items, 'filesave.png', 'attributes.saveorder'); ?>
						<?php endif; ?>
					</th>
					<th width="5%" class="nowrap center hidden-phone">
						<?php echo JText::_('JGRID_HEADING_ID'); ?>
					</th>
					<th width="40%">
						&#160;
					</th>
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
			<?php $count = count($this->items); ?>
			<?php foreach ($this->items as $i => $item) :
				$ordering  = ($listOrder == 'ct.ordering');
				$canCreate = true;
				$canEdit   = true;
				$canChange = true;
			?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td>
						<?php if ($canEdit) : ?>
						<a href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&task=attribute.edit&id='.$item->id);?>">
							<?php echo $this->escape($item->name); ?></a>
						<?php else : ?>
							<?php echo $this->escape($item->name); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php echo  $this->escape($item->attributeTypeName);?>
					</td>
					<td>
						<?php echo  $this->escape($item->options);?>
					</td>
					<td>
						<img src ="<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/".($item->status==0? "unchecked.gif" : "checked.gif")?>" 
								onclick	="document.location.href = '<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&task=attribute.changeState&id='. $item->id )?> '"
							/>
					</td>
					<td class="order">
						<?php if ($canChange) : ?>
							<div class="input-prepend">
							<?php if ($saveOrder) :?>
								<?php if ($listDirn == 'asc') : ?>
									<span class="add-on"><?php echo $this->pagination->orderUpIcon($i, true, 'attributes.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
									<span class="add-on"><?php echo $this->pagination->orderDownIcon($i, $count, true, 'attributes.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
								<?php elseif ($listDirn == 'desc') : ?>
									<span class="add-on"><?php echo $this->pagination->orderUpIcon($i, true, 'attributes.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
									<span class="add-on"><?php echo $this->pagination->orderDownIcon($i, $count, true, 'attributes.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
								<?php endif; ?>
							<?php endif; ?>
							<?php $disabled = $saveOrder ? '' : 'disabled="disabled"'; ?>
						 	<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="width-20 text-area-order" />
						 </div>
						<?php else : ?>
							<?php echo $item->ordering; ?>
						<?php endif; ?>
					</td>
					<td class="center">
						<?php echo (int) $item->id; ?>
					</td>
					<td>
						&#160;
					</td>
				</tr>
			<?php endforeach; ?>
			
			</tbody>
		</table>
	 
	 <input type="hidden" name="task" value="" /> 
	 <input type="hidden" name="id" value="" />
	 <input type="hidden" name="boxchecked" value="0" />
	 <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	 <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	 <?php echo JHTML::_( 'form.token' ); ?> 
</form>