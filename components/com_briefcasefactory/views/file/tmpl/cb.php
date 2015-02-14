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

<form action="<?php echo FactoryRoute::task('file.refresh&id=' . $this->item->id); ?>" method="POST" enctype="multipart/form-data" style="margin: 0;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3><?php echo FactoryText::_('file_add_page_title'); ?></h3>
  </div>

  <div class="modal-body">
    <?php foreach ($this->form->getFieldset('details') as $field): ?>
      <div class="control-group">
        <div class="control-label"><?php echo $field->label; ?></div>
        <div class="controls"><?php echo $field->input; ?></div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="modal-footer buttons">
    <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo FactoryText::_('file_edit_button_cancel'); ?></button>
    <button type="submit" class="btn btn-primary"><?php echo FactoryText::_('file_edit_button_save'); ?></button>
  </div>

  <input type="hidden" name="redirect" value="<?php echo base64_encode(JFactory::getApplication()->input->server->getString('HTTP_REFERER')); ?>" />
  <input type="hidden" name="task" value="file.apply" />
  <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
  <?php echo JHtml::_('form.token'); ?>
</form>
