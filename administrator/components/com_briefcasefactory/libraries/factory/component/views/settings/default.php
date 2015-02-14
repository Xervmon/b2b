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

<form action="<?php echo FactoryRoute::view($this->getName()); ?>" method="post" name="adminForm" id="adminForm">

  <?php echo $this->loadTemplate('sidebar'); ?>

  <div id="j-main-container" class="<?php echo !empty($this->sidebar) ? 'span10' : ''; ?> form-horizontal">
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
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>

</form>
