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

<style>
<!--
.payplans .pp-statistics-violation-users-charts{
	border: 1px solid #E4E4E4;
	border-radius: 6px 6px 0px 0px;
	width:100%;
	overflow: scroll;
}

.payplans .pp-statistics-violation-title {
    background-color: #F4F4F4;
    border-bottom: 1px solid #E4E4E4;
    border-radius: 6px 6px 0 0;
    min-height: 150px;
}

.payplans .pp-violation-dates .input-append {
    float: left;
    width: 32%;
}
-->
</style>
<!--  Recent violation details-->
    <div id="payplans-login-violation-records">
	 <?php 
	 		if(!$usersRecords){
	 			?>
	 			<div class="span12 pp-statistics-recent-empty pp-gap-top60 text-center">
	 					<?php echo XiText::_('No Records available'); ?>
	 			</div>
	 			
	 			<?php 
	 		}
	 		else{?>
						<table class="table table-striped">	<?php 	
					 		$count = 1;
					 		foreach($usersRecords as $record){
					 			$user = JFactory::getUser($record->user_id);?>
								<tr>
									<td>
									 	<?php echo $count;?>.   &nbsp;&nbsp;&nbsp; Username: <?php echo PayplansHtml::link(XiRoute::_("index.php?option=com_payplans&view=user&task=edit&id=".$record->user_id, false), $user->username); ?>
									 	<br>
									 	<span style="font-size:1em; color:gray; margin-left:10%;">From Ip: <?php echo $record->ip_address; ?></span>
									 	<span style="font-size:1em; color:gray;">on <?php echo $record->violation_date;?></span>
									 	<span class="pull-right">violations: <?php echo $record->violation_counter; ?></span>
									 </td>
								</tr>
								
					 		<?php
					 			$count++; 
					 		}
					 		?>
			 			</table>
		 			<?php 
	 		}
		?>
	</div>
</div>
<?php 