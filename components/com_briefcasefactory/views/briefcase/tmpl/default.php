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

<h1><?php echo FactoryText::_('briefcase_page_title'); ?></h1>

<?php echo JHtml::_('BriefcaseFactory.beginForm', FactoryRoute::view('briefcase&parent=' . $this->parent->id)); ?>
  <div class="filters">
    <input type="text" class="search-query" name="search" id="filter_search" value="<?php echo htmlentities($this->state->get('filter.search')); ?>" placeholder="<?php echo FactoryText::_('briefcase_filter_search_placeholder'); ?>" />

    <select name="extension" id="filter_extension">
      <option value=""><?php echo FactoryText::_('briefcase_filter_extension'); ?></option>
      <?php echo JHtml::_('select.options', $this->filterExtension, 'value', 'text', $this->state->get('filter.extension')); ?>
    </select>

    <select name="category" id="filter_category">
      <option value=""><?php echo FactoryText::_('briefcase_filter_category'); ?></option>
      <?php echo JHtml::_('select.options', $this->filterCategory, 'value', 'text', $this->state->get('filter.category')); ?>
    </select>

    <select name="public" id="filter_public">
      <option value=""><?php echo FactoryText::_('briefcase_filter_public'); ?></option>
      <?php echo JHtml::_('select.options', $this->filterPublic, 'value', 'text', $this->state->get('filter.public')); ?>
    </select>
  </div>
</form>

<form method="POST" action="" id="briefcaseForm" name="briefcaseForm">

  <?php echo $this->loadTemplate('buttons'); ?>
  <?php echo $this->loadTemplate('breadcrumb'); ?>

  <div class="briefcase-update" data-url="index.php?option=com_briefcasefactory&view=briefcase&format=raw&parent=<?php echo $this->parent->id; ?>">
    <?php echo $this->loadTemplate('update'); ?>
  </div>

  <?php echo $this->loadTemplate('buttons'); ?>

  <input type="hidden" name="boxchecked" value="0" />
</form>
