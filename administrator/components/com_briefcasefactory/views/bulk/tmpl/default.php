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
  <div class="span4">
    <div>
      <h3><?php echo FactoryText::_('bulk_label_file_browser'); ?></h3>
      <div id="file-browser"></div>
    </div>
  </div>

  <div class="span8">
    <div>
      <h3><?php echo FactoryText::_('bulk_label_selected_files'); ?></h3>

      <form action="<?php echo FactoryRoute::view('bulk'); ?>" method="post" name="adminForm" id="adminForm">
        <table class="table table-striped table-hover table-bordered" id="selected-files"></table>
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
      </form>
    </div>

    <div>
      <h3><?php echo FactoryText::_('bulk_label_next_file'); ?></h3>

      <div class="input-append default_user_select">
        <input class="input-medium" type="text" id="user_name_default" disabled="disabled" />
        <input type="hidden" id="user_id_default" name="jform[default][user_id]" />

        <a
        id="default"
        onclick="currentUsername = this.id;"
        class="btn btn-primary modal_default"
        href="index.php?option=com_users&amp;view=users&amp;layout=modal&amp;tmpl=component&amp;field=username"
        rel="{ handler: 'iframe', size: {x: 800, y: 500}}">
          <i class="icon-user"></i>
        </a>
      </div>

      <span class="default_category_select">
      <?php echo JHtml::_(
        'select.genericlist',
        JHtml::_('category.options', 'com_briefcasefactory'),
        'jform[default][category_id]',
        '',
        'value',
        'text',
        null,
        'category_id_default'
      ); ?>
      </span>

    </div>
  </div>
</div>
