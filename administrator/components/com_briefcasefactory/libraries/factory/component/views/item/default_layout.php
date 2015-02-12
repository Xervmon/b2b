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
  <?php if (1 < count($this->layout)): ?>
    <ul class="nav nav-tabs">
      <?php foreach ($this->layout as $this->tabName => $this->tab): ?>
        <li class="<?php echo $this->activeTab == $this->tabName ? 'active' : ''; ?>" onclick="Cookie.write('<?php echo $this->option; ?>_settings_tab', '<?php echo $this->tabName; ?>'); return true;">
          <a href="#<?php echo $this->tabName; ?>" data-toggle="tab">
            <?php echo FactoryText::_($this->getName() . '_tab_' . $this->tabName); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <div class="tab-content">
      <?php foreach ($this->layout as $this->tabName => $this->tab): ?>
        <div class="tab-pane <?php echo $this->activeTab == $this->tabName ? 'active' : ''; ?>" id="<?php echo $this->tabName; ?>">
          <?php echo $this->loadTemplate('row'); ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <?php foreach ($this->layout as $this->tabName => $this->tab): ?>
      <?php echo $this->loadTemplate('row'); ?>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
