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

<div>
  <input type="text" class="search-query" value="<?php echo $this->search; ?>" />
  <a href="<?php echo FactoryRoute::view('shareusers&tmpl=component'); ?>" class="btn filter-users"><?php echo FactoryText::_('shareusers_shearch_label'); ?></a>
</div>

<table style="width: 100%;" class="table table-striped table-hover">
  <thead>
  <tr>
    <th style="width: 20px;">
      <input type="checkbox" name="checkall-toggle" value="" title="<?php echo FactoryText::_('list_heading_check_all'); ?>" onclick="Joomla.checkAll(this)" />
    </th>
    <th style="text-align: left;"><?php echo FactoryText::_('shareusers_heading_username'); ?></th>
  </tr>
  </thead>

  <tfoot>
  <tr>
    <td colspan="10">
      <div class="pagination">
        <?php echo $this->pagination->getPagesLinks(); ?>
      </div>
    </td>
  </tr>
  </tfoot>

  <tbody>
  <?php foreach ($this->users as $i => $user): ?>
    <tr>
      <td><?php echo JHtml::_('grid.id', $i, $user->id); ?></td>
      <td><?php echo $user->username; ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
