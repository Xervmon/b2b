<?php
/**
* @copyright	Copyright (C) 2009 - 2011 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
* website		http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();?>
<?php if(isset($name)=== false) $name = $param['name']; ?>

<?php $class = $name.$param[5]; ?>
<div class="row-fluid <?php echo XiHelperUtils::jsCompatibleId($class);?>">
	<?php if ($param[0] && $param[0] != '&nbsp;'): ?>
		<div class="control-group">
			<div class="span3 control-label"><lable><?php echo $param[0]; ?></label></div>
			<div class="span9 controls">
					<?php echo $param[1]; ?>
					<?php if(isset($subparam)) echo '<br />', $subparam;?>
			</div>
		</div>
		
	<?php else: ?>
		<div class="row-fluid pp-description">
			<?php echo $param[1]; ?>
		</div>
	<?php endif; ?>
</div>
<?php 
