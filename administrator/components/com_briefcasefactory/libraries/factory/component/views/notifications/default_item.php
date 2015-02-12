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
        <?php echo $this->escape($this->item->subject); ?>
      </a>
    </div>
  </td>

  <td>
    <?php echo FactoryText::_('notification_type_' . $this->item->type . '_label'); ?>
  </td>

  <td class="center">
    <?php echo $this->filterLanguage[$this->item->lang_code]; ?>
  </td>

  <td class="center">
    <?php echo JHtml::_('jgrid.published', $this->item->published, $this->i, 'notifications.'); ?>
  </td>

  <td class="center hidden-phone">
    <?php echo $this->item->id; ?>
  </td>
</tr>
