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

<form action="<?php echo FactoryRoute::_('layout=edit&id=' . (int)$this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal" enctype="multipart/form-data">
  <div class="row-fluid">

    <?php if ($this->layout): ?>
      <?php echo $this->loadTemplate('layout'); ?>
    <?php else: ?>
      <?php echo $this->loadTemplate('simple'); ?>
    <?php endif; ?>

    <div class="span2">
      <h4><?php echo JText::_('JDETAILS');?></h4>
      <hr />

      <fieldset class="form-vertical">

        <div class="control-group">
          <div class="controls">
            <?php echo $this->form->getValue($this->title); ?>
          </div>
        </div>

        <?php foreach ($this->form->getFieldset('sidebar') as $field): ?>
          <div class="control-group">
            <div class="control-label"><?php echo $field->label; ?></div>
            <div class="controls"><?php echo $field->input; ?></div>
          </div>
        <?php endforeach; ?>
      </fieldset>

    </div>
  </div>

  <input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
