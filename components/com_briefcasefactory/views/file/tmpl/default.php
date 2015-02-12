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

JHtml::_('formbehavior.chosen', 'select');

?>

<?php echo $this->loadTemplate('title'); ?>

<form action="<?php echo FactoryRoute::task('file.refresh&id=' . $this->item->id); ?>" method="POST" enctype="multipart/form-data">
  <?php foreach ($this->form->getFieldset('details') as $field): ?>
    <div class="control-group">
      <div class="control-label"><?php echo $field->label; ?></div>
      <div class="controls"><?php echo $field->input; ?></div>
    </div>
  <?php endforeach; ?>

  <div class="buttons">
    <a href="<?php echo FactoryRoute::task('file.apply&id=' . $this->item->id); ?>" class="btn btn-success btn-small"><i class="factory-icon-disk"></i>&nbsp;<?php echo FactoryText::_('file_edit_button_save'); ?></a>
    <a href="<?php echo FactoryRoute::task('file.save&id=' . $this->item->id); ?>" class="btn btn-small"><i class="factory-icon-disk"></i>&nbsp;<?php echo FactoryText::_('file_edit_button_save_close'); ?></a>
    <a href="<?php echo FactoryRoute::task('file.save2new&id=' . $this->item->id); ?>" class="btn btn-small"><i class="factory-icon-disk-plus"></i>&nbsp;<?php echo FactoryText::_('file_edit_button_save_new'); ?></a>
    <a href="<?php echo FactoryRoute::task('file.cancel&id=' . $this->item->id); ?>" class="btn btn-small"><i class="factory-icon-cross"></i>&nbsp;<?php echo FactoryText::_('file_edit_button_cancel'); ?></a>
  </div>

  <?php echo JHtml::_('form.token'); ?>
</form>
