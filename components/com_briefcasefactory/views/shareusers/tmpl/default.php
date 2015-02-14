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

<form action="<?php echo FactoryRoute::task('share.shareusers', false, -1); ?>" method="POST" name="adminForm" id="adminForm">
  <?php foreach ($this->form->getFieldset('details') as $field): ?>
    <div class="control-group">
      <div class="control-label"><?php echo $field->label; ?></div>
      <div class="controls"><?php echo $field->input; ?></div>
    </div>
  <?php endforeach; ?>

  <h2><?php echo FactoryText::_('shareusers_users_list'); ?></h2>
  <div class="update">
    <?php echo $this->loadTemplate('update'); ?>
  </div>

  <div class="buttons">
    <a href="#" class="btn btn-primary button-share-users"><i class="icon-share"></i>&nbsp;<?php echo FactoryText::_('shareusers_button_share'); ?></a>
    <a href="#" class="btn button-cancel"><i class="icon-cancel"></i>&nbsp;<?php echo FactoryText::_('shareusers_button_cancel'); ?></a>
  </div>

  <?php echo JHtml::_('form.token'); ?>
  <input type="hidden" name="boxchecked" />
</form>
