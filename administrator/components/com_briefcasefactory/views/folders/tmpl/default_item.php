<?php

/**
-------------------------------------------------------------------------
briefcasefactory - Briefcase Factory 4.0.8
-------------------------------------------------------------------------
 * @author thePHPfactory
 * @copyright Copyright (C) 2011 SKEPSIS Consult SRL. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.thePHPfactory.com
 * Technical Support: Forum - http://www.thePHPfactory.com/forum/
-------------------------------------------------------------------------
*/

defined('_JEXEC') or die;

?>

<tr
  class="row<?php echo $this->i % 2; ?>"
  sortable-group-id="<?php echo $this->item->parent_id; ?>"
  item-id="<?php echo $this->item->id; ?>"
  parents="<?php echo $this->getOrderingParentString($this->item, $this->ordering); ?>"
  level="<?php echo $this->item->level; ?>"
>
  <td class="center hidden-phone">
    <?php echo JHtml::_('grid.id', $this->i, $this->item->id); ?>
  </td>

  <td class="order nowrap center hidden-phone">
    <span class="sortable-handler hasTooltip <?php echo $this->saveOrder ? '' : 'inactive tip-top'; ?>" title="<?php echo $this->saveOrder ? '' : JText::_('JORDERINGDISABLED'); ?>">
		  <i class="icon-menu"></i>
		</span>

    <input type="text" style="display:none" name="order[]" size="5" value="<?php echo array_search($this->item->id, $this->ordering[$this->item->parent_id]) + 1;?>" />
  </td>

  <td class="nowrap has-context">
    <div class="pull-left">
      <?php echo str_repeat('<span class="gi">&mdash;</span>', $this->item->level-1) ?>
      <a href="<?php echo FactoryRoute::task($this->getSingularName() . '.edit&id=' . $this->item->id); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
        <?php echo $this->escape($this->item->title); ?>
      </a>
    </div>
  </td>

  <td>
    <a href="<?php echo FactoryRoute::view('folders&filter_search=' . urlencode($this->item->username)); ?>"><?php echo $this->item->username; ?></a>
  </td>

  <td>
    <a href="<?php echo JRoute::_('index.php?option=com_categories&task=category.edit&extension=' . $this->option . '&id=' . $this->item->category_id); ?>"><?php echo $this->item->category_title; ?></a>
  </td>

  <td class="center">
    <?php echo JHtml::_('jgrid.published', $this->item->general, $this->i, '', false); ?>
  </td>

  <td class="center">
    <?php echo JHtml::_('jgrid.published', ($this->item->share_public && ($this->item->share_until == JFactory::getDbo()->getNullDate() || $this->item->share_until >= JFactory::getDate()->toSql())), $this->i, '', false); ?>
  </td>

  <td class="center hidden-phone">
    <?php echo $this->item->id; ?>
  </td>
</tr>
