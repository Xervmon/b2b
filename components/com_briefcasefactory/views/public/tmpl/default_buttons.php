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

<div class="resources-buttons">
  <div class="btn-group">
    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
      <i class="factory-icon-checkbox"></i><?php echo FactoryText::_('briefcase_buttons_batch'); ?>
    </a>
    <ul class="dropdown-menu button-batch">
      <li><a href="<?php echo FactoryRoute::task('batch.download'); ?>" class="download"><i class="factory-icon-download"></i><?php echo FactoryText::_('briefcase_button_batch_download'); ?></a></li>
    </ul>
  </div>
</div>
