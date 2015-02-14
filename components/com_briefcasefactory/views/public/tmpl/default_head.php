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
  <?php if ('com_briefcasefactory' == $this->option): ?>
    <th style="width: 1px;"><input type="checkbox" name="checkall-toggle" value="" title="<?php echo FactoryText::_('list_heading_check_all'); ?>" onclick="Joomla.checkAll(this)" /></th>
  <?php endif; ?>

  <th style="width: 1px;" class="resource-icon"></th>
  <th><?php echo FactoryText::_('public_heading_title'); ?></th>
  <th style="width: 20%"><?php echo FactoryText::_('public_heading_shared_by'); ?></th>
</tr>
