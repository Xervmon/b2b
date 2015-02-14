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

<h2>
  <?php if ($this->item->id): ?>
    <?php echo FactoryText::sprintf('folder_edit_page_title', $this->item->title); ?>
  <?php else: ?>
    <?php echo FactoryText::_('folder_add_page_title'); ?>
  <?php endif; ?>
</h2>
