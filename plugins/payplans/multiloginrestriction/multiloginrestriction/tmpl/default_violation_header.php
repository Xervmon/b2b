<?php
/**
* @copyright		Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package			PayPlans
* @subpackage		multiloginrestrcition
* @contact 			payplans@readybytes.in
* website			http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();
?>
<?php $style = array(); ?>
<script src="<?php echo PayplansHelperUtils::pathFS2URL(dirname(__FILE__).DS.'loginviolation.js');?>" type="text/javascript"></script>
<div id="pp-dashboard-violation-statisctics" class="pull-left pp-statistics-violation-users-charts pp-gap-top20">
	<div class="pp-statistics-violation-title well-large">
	  	<h4><?php  echo XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_LOGIN_VIOLATIONS');?></h4><hr>
	 
		<div class="row-fluid pp-gap-top10">	
			<div class="span4 pp-violation-dates"> 
				<div title="<?php echo XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_DATE_FROM_DESC');?>" style="clear:both"><?php echo XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_DATE_FROM'); ?></div>
					<?php 
							if(XI_JVERSION >= '30'){
							  $style['style'] = "margin-bottom:1px; padding:5px; width:89px; color:#555; border-radius:3px;"; 
					       }
					       else { 	
					       	  $style['style'] = "margin-bottom:1px; padding:5px; width: 100%; color:#555; border-radius:3px;"; 
					       }
					       ?>
				<div>
					<?php echo PayplansHtml::_('datetime.edit', 'violation_from', 'violation_from', '', '%Y-%m-%d', $style); ?>
				</div>
			</div>
			
			<div class="span4 pp-violation-dates">
			    <div title="<?php echo XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_DATE_TO_DESC');?>" style="clear:both"><?php echo XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_DATE_TO'); ?></div>
			    <div><?php echo PayplansHtml::_('datetime.edit', 'violation_to', 'violation_to', '', '%Y-%m-%d', $style);?></div> 
			</div>	
			<div class="span2">
		 		<div title="<?php echo XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_USERID_DECS'); ?>" style="clear:both"><?php echo XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_USERID'); ?></div>
				<input type="text" name="violation_user_id" id="violation_user_id" class="input-mini">
			</div> 
			
			<div class="span2">
				<div>&nbsp;</div>
				<input type="button" value="Go" id="violationbtn" name="violationbtn" class="btn btn-primary pull-right" style="width:80% !important;">
			</div>
		</div>
			
		<?php $userid = JRequest::getVar('violation_user_id');?>
		<input type="hidden" name="isfilter" value="<?php echo isset($userid)?'1':'0';?>">
	</div>

	</div>
