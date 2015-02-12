<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();
?>
<div id="payplans" class="payplans-wrap">
  <div class="payplans">
       <div class="row-fluid msg-box">
           <div class="pp-recharge-msg pp-center">
                 <?php echo $message;?>    
            </div>
        </div>
   
   <div class="row-fluid">    
      <div class="span4">
           <div class="row-fluid well pp-gap-top20">
               <div class="text-center muted">   
                 	<h4><?php echo XiText::_('COM_PAYPLANS_SUBSCRIBE_PLAN');?></h4>
               </div>
		            
	            <div class="row-fluid text-center pp-gap-top10">
	                  <span><a class="pp-button ui-button-primary ui-button ui-widget  ui-corner-all ui-button-text-only" href="<?php echo XiRoute::_('index.php?option=com_payplans&view=plan'); ?>"><?php echo XiText::_('COM_PAYPLANS_SUBSCRIBE_PLAN_HERE')?></a></span>
	            </div>
		             
		         <div class="row-fluid text-center pp-gap-top10"> 
		            <span><a href="<?php echo XiRoute::_('index.php?option=com_users&view=registration')?>"><?php echo XiText::_('COM_PAYPLANS_CREATE_ACCOUNT');?> <i class="icon-arrow-right"></i></a></span>	
			     </div>   
	         </div>	
        </div>
       
       <div class="span8">
	        <div class="row-fluid">
		         <div class="offset2 span10 invalid pp-error"><span class="err-payplansLoginError"></span>&nbsp;</div>
	             </div>
	             
	             <div>&nbsp;</div>
	             
	            <div class="control-group">
				<div class="span4 offset2 control-label"><lable><?php echo XiText::_('COM_PAYPLANS_LOGIN_USERNAME');?></label></div>
				<div class="span6 controls"><input type="text" size="20" class="payplansLoginUsername required"/></div>
			</div>
	
			<div>&nbsp;</div>
	
			<div class="control-group">
				<div class="span4 offset2 control-label"><lable><?php echo XiText::_('COM_PAYPLANS_LOGIN_PASSWORD');?></label></div>
				<div class="span6 controls"><input type="password" size="20" class="payplansLoginPassword required"/></div>
			</div>		
	  </div>  
   </div> 

  </div>
</div>   
<?php 
