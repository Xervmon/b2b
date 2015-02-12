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

<tr>
  <td class="nowrap has-context">
    <div class="pull-left">
      <a href="<?php echo FactoryRoute::view('files&filter_search=' . urlencode($this->item->username)); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
        <?php echo $this->escape($this->item->username); ?>
      </a>
    </div>
  </td>

  <td class="center hidden-phone">
    <?php echo $this->item->files; ?>
  </td>

  <td class="center hidden-phone">
    <?php echo $this->item->id; ?>
  </td>
</tr>
