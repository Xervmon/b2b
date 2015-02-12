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

<table class="table table-striped table-hover" id="briefcaseTable">
  <?php echo $this->loadTemplate('table'); ?>
</table>

<?php if (!$this->items): ?>
  <div style="padding-top: 15px;">
    <i class="icon-warning"></i>&nbsp;<?php echo FactoryText::_('briefcase_no_files_found'); ?>
  </div>
<?php endif; ?>

<?php echo $this->loadTemplate('limit'); ?>
