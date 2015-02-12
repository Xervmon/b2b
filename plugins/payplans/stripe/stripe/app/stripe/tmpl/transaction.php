<?php
/**
* @copyright	Copyright (C) 2009 - 2011 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();?>
<?php if(!empty($transaction_html)):?>
	<?php foreach($transaction_html as $key => $value) :?>
			<div class="span12">
				<div class="span3 "><strong><?php echo $key; ?></strong></div>
				<div class="offset1 span8"><?php print_r($value);?></div>
				
			</div>	
	<?php endforeach; ?>
<?php endif;