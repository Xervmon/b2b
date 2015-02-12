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

<h2><?php echo FactoryText::_('settings_page_title'); ?></h2>

<form action="" method="POST">
  <?php foreach ($this->form->getFieldset('notifications') as $field): ?>
    <div class="control-group">
      <div class="control-label"><?php echo $field->label; ?></div>
      <div class="controls"><?php echo $field->input; ?></div>
    </div>
  <?php endforeach; ?>

  <div class="buttons">
    <a href="<?php echo FactoryRoute::task('settings.apply'); ?>" class="btn btn-success btn-small"><i class="factory-icon-disk"></i><?php echo FactoryText::_('settings_button_save'); ?></a>
    <a href="<?php echo FactoryRoute::task('settings.cancel'); ?>" class="btn btn-small"><i class="factory-icon-cross"></i><?php echo FactoryText::_('settings_button_cancel'); ?></a>
  </div>

  <?php echo JHtml::_('form.token'); ?>
</form>
