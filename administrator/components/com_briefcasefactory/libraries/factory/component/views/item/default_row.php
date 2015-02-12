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

<div class="row-fluid">
  <?php foreach (array('left', 'right', 'full') as $side): ?>
    <?php if (isset($this->tab[$side])): ?>
      <div class="span<?php echo 'full' == $side ? 12 : 6; ?>">
        <?php foreach ($this->tab[$side] as $fieldset): ?>
          <?php echo $this->loadFieldset($fieldset); ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
