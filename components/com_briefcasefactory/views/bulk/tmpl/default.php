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

<!--h2><?php echo FactoryText::_('file_bulk_page_title'); ?></h2-->
 <div class="row-fluid"  id="community-wrap">
<div class="span8">
 <div class="cMain">
<form action="" method="POST" enctype="multipart/form-data" novalidate="novalidate">

  <div class="progress progress-striped active" style="display: none;">
    <div class="bar" style="width: 0;"></div>
  </div>

  <div class="alert briefcase-message-success" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div></div>
  </div>

  <div class="alert alert-error briefcase-message-error" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div></div>
  </div>

  <?php ///echo $this->loadTemplate('buttons'); ?>

  <div class="files">
    <fieldset id="bulk_0">
      <legend><?php echo FactoryText::_('bulk_file_legend'); ?></legend>

      <a href="#" class="btn btn-small btn-danger button-remove-file" style="display: none;"><i class="icon-delete"></i>&nbsp;<?php echo FactoryText::_('bulk_file_remove'); ?></a>

      <?php foreach ($this->form->getFieldset('details') as $field): 
       
       if (strpos($field->label, 'Folder') !== false)
       {
          echo $field->input;
       }
       else
       {
       
       ?>
        <div class="control-group">
          <div class="control-label"><?php echo $field->label; ?></div>
          <div class="controls"><?php echo $field->input; ?></div>
        </div>
      <?php 
      }
      endforeach; ?>
    </fieldset>
  </div>

  <?php echo $this->loadTemplate('buttons'); ?>

  <input type="hidden" name="HTTP_X_REQUESTED_WITH" value="" />
  <?php echo JHtml::_('form.token'); ?>
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
