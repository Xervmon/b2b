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

<h1><?php echo FactoryText::_('shareusers_page_title'); ?></h1>

<form action="<?php echo FactoryRoute::task('share.shareusers&id=' . $this->fileId); ?>" method="POST" id="adminForm" name="adminForm">
  <?php foreach ($this->form->getFieldset('details') as $field): ?>
    <div class="control-group">
      <div class="control-label"><?php echo $field->label; ?></div>
      <div class="controls"><?php echo $field->input; ?></div>
    </div>
  <?php endforeach; ?>

  <h3><?php echo FactoryText::_('shareusers_users_list'); ?></h3>
  <div class="update">
    <?php echo $this->loadTemplate('update'); ?>
  </div>

  <div class="buttons" style="margin-top: 20px; ">
    <a href="#" class="btn btn-primary button-share"><i class="icon-share"></i>&nbsp;<?php echo FactoryText::_('sharegroups_button_share'); ?></a>
    <a href="#" class="btn button-cancel"><i class="icon-cancel"></i>&nbsp;<?php echo FactoryText::_('sharegroups_button_cancel'); ?></a>
  </div>

  <input type="hidden" name="boxchecked" value="0" />
  <?php echo JHtml::_('form.token'); ?>
</form>
