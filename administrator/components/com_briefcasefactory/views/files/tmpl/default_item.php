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

<tr class="row<?php echo $this->i % 2; ?>">
  <td class="center hidden-phone">
    <?php echo JHtml::_('grid.id', $this->i, $this->item->id); ?>
  </td>

  <td class="nowrap has-context">
    <div class="pull-left">
      <a href="<?php echo FactoryRoute::task($this->getSingularName() . '.edit&id=' . $this->item->id); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
        <?php echo $this->escape($this->item->title); ?>
      </a>

      <div class="muted small">
        <?php if ($this->item->category_id): ?>
          <i class="icon-folder"></i>&nbsp;<?php echo $this->item->category_title; ?>&nbsp;
        <?php endif; ?>

        <?php if ($this->item->size): ?>
          <i class="icon-drawer-2"></i>&nbsp;<?php echo JHtml::_('number.bytes', $this->item->size); ?>&nbsp;
        <?php endif; ?>

        <i class="icon-download"></i>&nbsp;<a href="<?php echo FactoryRoute::task('file.download&id=' . $this->item->id); ?>" class="muted"><?php echo FactoryText::_('files_list_download'); ?></a>&nbsp;
      </div>
    </div>
  </td>

  <td>
    <a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id=' . $this->item->user_id); ?>"><?php echo $this->item->username; ?></a>
  </td>

  <td>
    <?php if (null === $this->item->folder_id): ?>
      <span class="muted"><?php echo FactoryText::_('files_folder_removed_label'); ?></span>
    <?php elseif (1 == $this->item->folder_id): ?>
      <?php echo JText::_('JGLOBAL_ROOT'); ?>
    <?php else: ?>
      <a href="<?php echo FactoryRoute::task('folder.edit&id=' . $this->item->folder_id); ?>"><?php echo $this->item->folder_title; ?></a>
    <?php endif; ?>
  </td>

  <td class="center">
    <?php echo JHtml::_('jgrid.published', ($this->item->share_public && ($this->item->share_until == JFactory::getDbo()->getNullDate() || $this->item->share_until >= JFactory::getDate()->toSql())), $this->i, '', false); ?>
  </td>

  <td class="center">
    <?php echo JHtml::_('jgrid.published', $this->item->published, $this->i, 'files.'); ?>
  </td>

  <td class="center hidden-phone">
    <?php echo $this->item->id; ?>
  </td>
</tr>
