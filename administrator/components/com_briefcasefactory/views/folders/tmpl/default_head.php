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

    <th width="1%" class="nowrap center hidden-phone">
      <?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', $this->tableAlias . '.ordering', $this->listDirn, $this->listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
    </th>

    <th>
      <?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', $this->tableAlias . '.title', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="15%" class="nowrap hidden-phone">
      <?php echo JHtml::_('grid.sort', FactoryText::_('list_heading_username'), 'u.username', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="15%" class="nowrap hidden-phone">
      <?php echo JHtml::_('grid.sort', FactoryText::_('list_heading_category'), 'c.title', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="7%" class="nowrap hidden-phone center">
      <?php echo JHtml::_('grid.sort', FactoryText::_('folders_heading_general'), $this->tableAlias . '.user_id', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="7%" class="nowrap hidden-phone center">
      <?php echo JHtml::_('grid.sort', FactoryText::_('folders_heading_public'), $this->tableAlias . '.share_public', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="1%" class="nowrap hidden-phone">
      <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', $this->tableAlias  . '.id', $this->listDirn, $this->listOrder); ?>
    </th>
  </tr>
</thead>
