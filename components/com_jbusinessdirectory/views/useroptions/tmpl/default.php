<?php // no direct access
/**
* @copyright	Copyright (C) 2008-2009 CMSJunkie. All rights reserved.
* 
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
* See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

defined('_JEXEC') or die('Restricted access');

$uri     = JURI::getInstance();
$url = $uri->toString( array('scheme', 'host', 'port', 'path'));

$user = JFactory::getUser();
if($user->id == 0){
	$app = JFactory::getApplication();
	$return = base64_encode(JRoute::_('index.php?option=com_jbusinessdirectory&view=useroptions'));
	$app->redirect(JRoute::_('index.php?option=com_users&return='.$return));
}

$appSettings =  JBusinessUtil::getInstance()->getApplicationSettings();
$enablePackages = $appSettings->enable_packages;
$enableOffers = $appSettings->enable_offers;
$hasBusiness = isset($this->companies) && count($this->companies)>0;
?>


<div id="user-options">
	<h1 class="title">
		<?php echo JTEXT::_("LNG_CONTROL_PANEL") ?>
	</h1>
	<?php if(!$hasBusiness){ ?>
	<p>
		<?php echo JText::_("LNG_USER_OPTION_INFO")?>
	</p>
	<?php } ?>
	<div class="user-options-container">
		<ul>
		
			<?php if(!$hasBusiness){ ?>
					<li class="option-button search">
						<a href="javascript:void(0)" class="box box-inset search">
							<img alt="<?php echo JTEXT::_("LNG_ADD_MODIFY_COMPANY_DATA") ?>" src="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName().'/assets/images/search-find.png' ?>" />	
							<h3> <?php echo JTEXT::_("LNG_CLAIM_COMPANY") ?></h3>
						 	<span> <?php echo JTEXT::_("LNG_CLAIM_COMPANY_INFO") ?>&nbsp;</span>
 							<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory') ?>" method="post" name="claim-search" id="claim-search" class="search-form" >
								<input type='hidden' name='task' value='searchCompaniesByName'>
								<input type='hidden' name='controller' value='search'>
								<input type='hidden' name='view' value='search'>
								<input type='hidden' name='categorySearch' value=''>
								<div class="form-field">
									<input type="text" name="searchkeyword" id="searchkeyword"  value="" />
								</div>
								<span class="button" style="float:left">
									<button href="javascript:void(0)" onClick="jQuery('#claim-search').submit()" value="Login"><?php echo JText::_('LNG_SEARCH'); ?></button>
								</span>
							</form>
						 </a>
					</li>
			<?php } ?>
			
			<li class="option-button">
				<a href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanies') ?>" class="box box-inset">
					<img alt="<?php echo JTEXT::_("LNG_ADD_MODIFY_COMPANY_DATA") ?>" src="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName().'/assets/images/business-listings.png' ?>" />	
					<h3>
						<?php echo JTEXT::_("LNG_ADD_MODIFY_COMPANY_DATA") ?>
					</h3>
					<p> <?php echo JTEXT::_("LNG_ADD_MODIFY_COMPANY_DATA_INFO") ?></p>
				</a>
			</li>
			
			
			<?php if($enableOffers){?>
				<li class="option-button" <?php  if(!$hasBusiness) echo 'style="opacity: .4;corsor: default;"'?>>
				 	<a class="box box-inset" href="<?php echo $hasBusiness?JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanyoffers'):'javascript:void(0)'; ?>">
				 		<img alt="<?php echo JTEXT::_("LNG_ADD_MODIFY_OFFERS") ?>" src="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName().'/assets/images/special-offer.png' ?>" />	
				 		<h3>
				 			<?php echo JTEXT::_("LNG_ADD_MODIFY_OFFERS") ?>
	 					</h3>
	 					<p><?php echo JTEXT::_("LNG_ADD_MODIFY_OFFERS_INFO") ?></p>
	 				</a>
				</li>
			<?php } ?>
			
			<?php if($appSettings->enable_events){?>		
				<li class="option-button" <?php  if(!$hasBusiness) echo 'style="opacity: .4;corsor: default;"'?>>
				 	<a class="box box-inset" href="<?php  echo $hasBusiness?JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanyevents'):'javascript:void(0)' ?>">
				 		<img alt="<?php echo JTEXT::_("LNG_MANAGE_YOUR_EVENTS") ?>" src="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName().'/assets/images/events.png' ?>" />	
				 		<h3>
				 			<?php echo JTEXT::_("LNG_MANAGE_YOUR_EVENTS") ?>
	 					</h3>
	 					<p> <?php echo JTEXT::_("LNG_EVENTS_INFO") ?></p>
	 				</a>
				</li>
			<?php } ?>	
				
				<li class="option-button" <?php  if(!$hasBusiness) echo 'style="opacity: .4;corsor: default;"'?>>
				 	<a class="box box-inset" href="<?php  echo $hasBusiness?JRoute::_('index.php?option=com_jbusinessdirectory&view=orders'):'javascript:void(0)' ?>">
				 		<img alt="<?php echo JTEXT::_("LNG_MANAGE_YOUR_ORDERS") ?>" src="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName().'/assets/images/orders.png' ?>" />	
				 		<h3>
				 			<?php echo JTEXT::_("LNG_MANAGE_YOUR_ORDERS") ?>
	 					</h3>
	 					<p> <?php echo JTEXT::_("LNG_ORDERS_INFO") ?></p>
	 				</a>
				</li>
				<li class="option-button">
				 	<a class="box box-inset" href="<?php  echo JRoute::_('index.php?option=com_users&view=profile') ?>">
				 		<img alt="<?php echo JTEXT::_("LNG_ADD_MODIFY_USER_DATA") ?>" src="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName().'/assets/images/user.png' ?>" />	
				 		<h3>
				 			<?php echo JTEXT::_("LNG_ADD_MODIFY_USER_DATA") ?>
	 					</h3>
	 					<p> <?php echo JTEXT::_("LNG_ADD_MODIFY_USER_DATA_INFO") ?></p>
	 				</a>
				</li>
				
			</ul>
			<div class="clear"></div>
			
	</div>
</div>

<div class="add-container" style="display:none">
<?php 
jimport('joomla.application.module.helper');
// this is where you want to load your module position
$modules = JModuleHelper::getModules('user-banners');
?>
	<div class="company-categories">
		<?php 
		foreach($modules as $module)
		{
			echo JModuleHelper::renderModule($module);
		}
		
		?>
	</div>
</div>

<div class="clear"></div>