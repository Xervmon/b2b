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

<script type="text/javascript">
	Joomla.orderTable = function() {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $this->listOrder; ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

<form action="<?php echo FactoryRoute::view($this->getName()); ?>" method="post" name="adminForm" id="adminForm">

  <?php echo $this->loadTemplate('sidebar'); ?>

  <div id="j-main-container" class="<?php echo !empty($this->sidebar) ? 'span10' : ''; ?>">

    <?php echo $this->loadTemplate('filter'); ?>

		<table class="table table-striped" id="<?php echo $this->getName(); ?>List">
      <?php echo $this->loadTemplate('head'); ?>

      <tbody>
        <?php foreach ($this->items as $this->i => $this->item): ?>
          <?php echo $this->loadTemplate('item'); ?>
        <?php endforeach; ?>
      </tbody>
		</table>

    <?php echo $this->loadTemplate('pagination'); ?>
    <?php echo $this->loadTemplate('hidden'); ?>
	</div>

</form>
