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
    <th>
      <?php echo JHtml::_('grid.sort', FactoryText::_('list_heading_username'), $this->tableAlias . '.username', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="10%" class="nowrap hidden-phone center">
      <?php echo JHtml::_('grid.sort', FactoryText::_('users_heading_files'), 'files', $this->listDirn, $this->listOrder); ?>
    </th>

    <th width="1%" class="nowrap hidden-phone">
      <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', $this->tableAlias  . '.id', $this->listDirn, $this->listOrder); ?>
    </th>
  </tr>
</thead>
