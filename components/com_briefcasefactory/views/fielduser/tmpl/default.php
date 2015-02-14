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

<form action="<?php echo FactoryRoute::view('fielduser&tmpl=component'); ?>" method="post">
  <input type="search" name="search" class="form-control" placeholder="<?php echo FactoryText::_($this->getName() . '_search_users_placeholder'); ?>" value="<?php echo htmlentities($this->search, ENT_COMPAT, 'UTF-8'); ?>" />
</form>

<table class="table table-hover table-striped">
  <thead>
    <tr>
      <th style="width: 20px;"><?php echo FactoryText::_($this->getName() . '_heading_id'); ?></th>
      <th><?php echo FactoryText::_($this->getName() . '_heading_username'); ?></th>
      <th style="width: 150px;"><?php echo FactoryText::_($this->getName() . '_heading_name'); ?></th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($this->items as $this->item): ?>
      <tr>
        <td>
          <?php echo $this->item->id; ?>
        </td>

        <td>
          <a href="#" data-id="<?php echo $this->item->id; ?>" data-username="<?php echo $this->item->username; ?>">
            <?php echo $this->item->username; ?>
          </a>
        </td>

        <td>
          <?php echo $this->item->name; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="pagination">
  <?php echo $this->pagination->getPagesLinks(); ?>
</div>
