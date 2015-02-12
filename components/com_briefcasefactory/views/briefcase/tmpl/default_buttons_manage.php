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

if ($this->enabledManage): ?>
  <div class="btn-group">
    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
      <i class="factory-icon-document-plus"></i><?php echo FactoryText::_('briefcase_buttons_add'); ?>
    </a>

    <ul class="dropdown-menu">
      <li><a href="<?php echo FactoryRoute::task('file.add&parent=' . $this->parent->id); ?>"><i class="factory-icon-document-plus"></i><?php echo FactoryText::_('briefcase_button_add_file'); ?></a></li>

      <?php if ($this->enabledBulkUpload): ?>
        <li><a href="<?php echo FactoryRoute::task('file.addbulk&parent=' . $this->parent->id); ?>"><i class="factory-icon-document-plus"></i><?php echo FactoryText::_('briefcase_button_add_bulk_files'); ?></a></li>
      <?php endif; ?>

      <li><a href="<?php echo FactoryRoute::task('folder.add&parent=' . $this->parent->id); ?>"><i class="factory-icon-folder-plus"></i><?php echo FactoryText::_('briefcase_button_add_folder'); ?></a></li>
    </ul>
  </div>

  <div class="btn-group">
    <a href="#" class="btn btn-small button-edit">
      <i class="factory-icon-pencil"></i><?php echo FactoryText::_('briefcase_button_edit'); ?>
    </a>
  </div>
<?php endif; ?>
