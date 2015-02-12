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

<h1><?php echo FactoryText::_($this->getName() . '_page_title'); ?></h1>

<?php echo JHtml::_('BriefcaseFactory.beginForm', FactoryRoute::view($this->getName() . '&parent=' . $this->parent->id)); ?>
  <div class="filters">
    <input type="text" class="search-query" name="search" id="filter_search" value="<?php echo htmlentities($this->state->get('filter.search')); ?>" placeholder="<?php echo FactoryText::_('briefcase_filter_search_placeholder'); ?>" />

    <select name="category" id="filter_category">
      <option value=""><?php echo FactoryText::_('briefcase_filter_category'); ?></option>
      <?php echo JHtml::_('select.options', $this->filterCategory, 'value', 'text', $this->state->get('filter.category')); ?>
    </select>
  </div>
</form>

<form method="POST" action="" id="briefcaseForm" name="briefcaseForm">

  <?php echo $this->loadTemplate('buttons'); ?>
  <?php echo $this->loadTemplate('breadcrumb'); ?>

  <table class="table table-striped table-hover" id="briefcaseTable">
    <?php echo $this->loadTemplate('table'); ?>
  </table>

  <?php if (!$this->items): ?>
    <div style="padding-top: 15px;">
      <i class="icon-warning"></i>&nbsp;<?php echo FactoryText::_('briefcase_no_files_found'); ?>
    </div>
  <?php endif; ?>

  <?php echo $this->loadTemplate('buttons'); ?>

  <input type="hidden" name="boxchecked" value="0" />
</form>
