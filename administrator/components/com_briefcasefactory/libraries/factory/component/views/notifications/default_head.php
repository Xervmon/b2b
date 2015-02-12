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

<thead>
  <tr>
    <th width="1%" class="hidden-phone">
      <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
    </th>

    <th>
      <?php echo JHtml::_('grid.sort', FactoryText::_('notifications_heading_subject'), $this->tableAlias . '.subject', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="25%" class="nowrap hidden-phone">
      <?php echo JHtml::_('grid.sort', FactoryText::_('notifications_heading_type'), $this->tableAlias . '.type', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="15%" class="nowrap hidden-phone center">
      <?php echo JHtml::_('grid.sort', FactoryText::_('notifications_heading_lang_code'), $this->tableAlias . '.lang_code', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="15%" class="nowrap hidden-phone center">
      <?php echo JHtml::_('grid.sort', FactoryText::_('notifications_heading_published'), $this->tableAlias . '.published', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="1%" class="nowrap hidden-phone">
      <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', $this->tableAlias  . '.id', $this->listDirn, $this->listOrder); ?>
    </th>
  </tr>
</thead>
