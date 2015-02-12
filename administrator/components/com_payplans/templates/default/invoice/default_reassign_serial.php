<?php
/**
 * reassingment of serial number of all invoices modal popup
 * @copyright Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 * @package payplans
 * @version 3.1.2
 * @author Mohit Agrawal <mohit@readybytes.in>
 */

if(defined('_JEXEC')===false) die(); ?>

<div class="row-fluid">
	<div class="span12">
		<h4><?php echo XiText::_('COM_PAYPLANS_INVOICE_REASSINING_TOTAL_INVOICES'); ?><span id="payplans-reassign-total"><?php echo $totalRecords ; ?></span></h4>
		<h4><?php echo XiText::_('COM_PAYPLANS_INVOICE_REASSINING_TOTAL_PROCESSED_INVOICES'); ?><span id="payplans-reassign-total-processed">0</span></h4>
	</div>
	<br/>
	<div class="progress progress-striped active span11">
		<div id="payplans-reassign-progress" class="bar" style="width: 0%"></div>
    </div>
</div>
 