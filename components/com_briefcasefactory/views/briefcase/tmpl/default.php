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
$moduleCount = count(JModuleHelper::getModules('js_side_frontpage')) + count(JModuleHelper::getModules('js_side_top'));
$class = ($moduleCount > 0) ? 'span8' : 'span12';
$jinput = JFactory::getApplication()->input;

    function renderModules($position, $attribs = array())
    {
	    jimport( 'joomla.application.module.helper' );

	    $modules 	= JModuleHelper::getModules( $position );
	    $modulehtml = '';

	    foreach($modules as $module)
	    {			
		    // If style attributes are not given or set, we enforce it to use the xhtml style
		    // so the title will display correctly.
		    if( !isset($attribs['style'] ) )
			    $attribs['style']	= 'xhtml';

		    $modulehtml .= JModuleHelper::renderModule($module, $attribs);
	    }

	    // Add placholder code for onModuleRender search/replace
	    $modulehtml .= '<!-- '.$position. ' -->';
	    echo $modulehtml;
    }
                               
?>
<?php /* ?>
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
<?php */ ?>
<div class="row-fluid"  id="community-wrap">
<div class="span8">
 <div class="cMain">
<form method="POST" action="" id="briefcaseForm" name="briefcaseForm">

  <?php echo $this->loadTemplate('buttons'); ?>
  <?php //echo $this->loadTemplate('breadcrumb'); ?>

  <div class="briefcase-update" data-url="index.php?option=com_briefcasefactory&view=briefcase&format=raw&parent=<?php echo $this->parent->id; ?>">
    <?php echo $this->loadTemplate('update'); ?>
  </div>

  <?php //echo $this->loadTemplate('buttons'); ?>

  <input type="hidden" name="boxchecked" value="0" />
</form>
 </div>
  </div>
<?php if ($moduleCount > 0) { ?>
        <div class="span4">
            <div class="cSidebar">
                <?php renderModules('js_side_top'); ?>
                <?php renderModules('js_side_frontpage'); ?>

            </div>
            <!-- end: .cSidebar -->
        </div>
    <?php } ?>
    
    </div>