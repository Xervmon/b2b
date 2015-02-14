<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();?>

<?php 

$widget = new XiWidget();
$widget->id('pp-dashboard-menu');

$widget->setOption('title',XiText::_('COM_PAYPLANS_DASHBOARD_QUICKLINKS'));
$widget->setOption('style_class', 'hidden-phone');

ob_start();
?>
<ul class="nav nav-list ">
    <li>
    	<a href="<?php echo XiRoute::_('index.php?option=com_payplans&view=plan&task=subscribe'); ?>">
    		<?php echo XiText::_('COM_PAYPLANS_DASHBOARD_ACTION_SUBSCRIBE');?>
    	</a>
    </li>
    
    <?php if(XiFactory::getUser()->id) :?>
    <li>
    	<a href="<?php echo XiHelperJoomla::getLogoutLink(); ?>">
					<?php echo XiText::_('COM_PAYPLANS_DASHBOARD_ACTION_LOGOUT');?>
		</a>
    </li>
    <?php endif;?>
</ul>
<?php
$html = ob_get_contents();
ob_end_clean(); 

$widget->html($html);
echo $widget->draw();

?>
