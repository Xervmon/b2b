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

<div class="span10 form-horizontal">
  <fieldset>
    <div class="row-fluid">
      <div class="span6">
        <?php foreach ($this->form->getFieldsets() as $fieldset): ?>
          <?php echo $this->loadFieldset($fieldset->name); ?>
        <?php endforeach; ?>
      </div>
    </div>
  </fieldset>
</div>
