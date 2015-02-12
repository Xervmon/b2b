<?php
/**
 * @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * @package		PayPlans
 * @subpackage	Loggers
 * @contact 		payplans@readybytes.in
 */
if (defined('_JEXEC') === false)
    die();

class PayplansEventDashboard_info {

    public static function onPayplansViewBeforeRender(XiView $view, $task)
    {

        if ($view instanceof PayplansadminViewDashboard == false) {
        	return '';
        }
        
        $return='';
        ob_start();?>
     
        <div class="pp-gap-top20 ">
        	<a href="<?php echo XiRoute::_('index.php?option=com_ppinstaller'); ?>" class="btn btn-info" title="<?php echo XiText::_('COM_PAYPLANS_CHECK_FOR_UPDATE_DESC'); ?>"><?php echo XiText::_('COM_PAYPLANS_CHECK_FOR_UPDATE'); ?> </a>
        </div>
        <?php
      	$return .= ob_get_contents();
        ob_end_clean();            

		// load broadcast message
        $version = new JVersion();
	        $suffix = 'jom=J'.$version->RELEASE.'&utm_campaign=broadcast&pay=PP'.PAYPLANS_VERSION.'&dom='.JURI::getInstance()->toString(array('scheme', 'host', 'port'));
        ob_start();?>
        
        <div class ="clearfix pp-dashboard-alert pp-dashboard-alert-info pp-gap-top20">    
             <iframe src="http://www.readybytes.net/broadcast/payplans.html?<?php echo urlencode($suffix); ?>" frameborder="0" scrolling="auto" width="100%" height="350px"></iframe>
         </div>
        <?php
   		$return .= ob_get_contents();
        ob_end_clean();            
        
        return array('payplans-admin-dashboard-userinfo' => $return);
    }

	static function onPayplansCron()
	{
		PayplansHelperStatistics::calculateStatistics();
	}
}
