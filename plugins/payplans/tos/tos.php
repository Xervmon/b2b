<?php

/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	Terms and Conditions
* @contact	payplans@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Payplans Terms and Conditions Plugin
 *
 */
class plgPayplansTos extends XiPlugin
{

	public function onPayplansSystemStart()
	{
		//add tos app path to app loader
		$appPath = dirname(__FILE__).DS.'tos'.DS.'app';
		PayplansHelperApp::addAppsPath($appPath);

		return true;
	}

    public function onPayplansViewBeforeRender(XiView $view, $task)
	{
       //app will ask terms and conditions at order confirm page only
		if ($view instanceof PayplanssiteViewInvoice && $task == 'confirm'){
			return self::renderUserdetail($view);
		}
	
		return false;
	}
	
	public function renderUserdetail($view)
	{
	  $tosApps = PayplansHelperApp::getAvailableApps('tos');
	  $content = array();
	  foreach ($tosApps as $app)
	  {	
	  	if(!$app->isApplicable($view)){
            continue;
	  	}

        $filter  = $app->getAppParam('filter','custom_content');
        $subject = $app->getAppParam('subject');
        if($filter == 'joomla_article'){ 
        	$id   = $app->getAppParam('joomla_article');
	     	if($id){
                // To resolve issue with SH404 component & Use @JRoute due to com_content router issue regarding view
	     		$url = @JRoute::_('index.php?option=com_content&view=article&id='.$id);
	     		if(JString::strpos($url, '?') !==false){
	     			$url .= '&tmpl=component';
	     		}
	     		else{
	     			$url .= '?tmpl=component';
	     		}

	     		$title = XiText::_('COM_PAYPLANS_APP_TOS_TERMS_AND_CONDITIONS');
	     		ob_start();
	     		?> 
				<a onClick="payplans.apps.tos.click('<?php echo $url; ?>', '<?php echo $title; ?>'); return false;" href="<?php echo $url; ?>">
					<?php echo $subject; ?>
				</a>
				<?php 
				$content[] = ob_get_contents();
				ob_end_clean();
	        } 
         }
         
         if($filter =='custom_content') {
         	$custom_content = base64_decode($app->getAppParam('custom_content'));
            if($custom_content){
  	           ob_start(); 
	     	   ?>
	     	   <span><strong><?php echo $subject; ?></strong></span>
	     	   <div class="word-wrap pp-gap-top05"><?php echo $custom_content; ?></div>
            <?php 
            $content[] = ob_get_contents();
			ob_end_clean();
            }
         }
      }
		$this->_assign('content', $content);
		return array('default' => $this->_render('orderconfirm'));
	  
  }
	
}
