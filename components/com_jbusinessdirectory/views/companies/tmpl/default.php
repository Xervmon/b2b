<?php /*------------------------s------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'header.php';
require_once JPATH_COMPONENT_SITE.'/classes/attributes/attributeservice.php'; 
?>

<?php 
require_once 'breadcrumbs.php';
?>
<?php require_once JPATH_COMPONENT_SITE."/include/social_share.php"?>

<div class="company-details-tabs">
<div class="company-name">
	<h1>
		<?php  echo isset($this->company->name)?$this->company->name:"" ; ?>	
	</h1>
</div>
<div class="clear"></div>
<div class="row-fluid">
	<div id="company-info" class="dir-company-info span4">
		<?php if(isset($this->package->features) && in_array(SHOW_COMPANY_LOGO,$this->package->features) || !$appSettings->enable_packages){ ?>
			<div class="company-image">
				<?php if(isset($this->company->logoLocation) && $this->company->logoLocation!=''){?>
					<img title="<?php echo $this->company->name?>" alt="<?php echo $this->company->name?>" src="<?php echo JURI::root().PICTURES_PATH.$this->company->logoLocation ?>">
				<?php }else{ ?>
					<img title="<?php echo $this->company->name?>" alt="<?php echo $this->company->name?>" src="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName().'/assets/no_image.jpg' ?>">
				<?php } ?>
			</div>
		<?php } ?>
		<div class="company-info-container" >
			<div class="company-info-rating" itemscope itemtype="http://data-vocabulary.org/Review-aggregate" <?php echo !$appSettings->enable_ratings? 'style="display:none"':'' ?>>
			 	<span style="display:none" itemprop="itemreviewed"><?php echo $this->company->name?></span>
			 	 <span style="display:none" itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">
			      	<span itemprop="average"><?php echo $this->company->averageRating?></span>  <span itemprop="best">5</span>
			    </span>
	    		<span  style="display:none" itemprop="count"><?php echo count($this->reviews)?></span>
	    
				<div class="company-info-average-rating">
					<div class="rating">
						<div id="rating-average" title="<?php echo $this->company->averageRating?>"></div>
					</div>
					<p class="rating-text">
					 <?php echo JText::_('LNG_AVG_OF') ?> <span id="average-rating-count"> <span id="rateNumber<?php echo $this->company->id?>" itemprop="votes"> <?php echo $this->ratingCount ?> </span> <?php echo JText::_('LNG_RATINGS') ?></span></p>
				</div>
				<div class="company-info-user-rating">
					<div class="rating">
						<div id="rating-user"></div>
					</div>
					<p class="rating-text">  <span id="average-rating-count" > <?php echo JText::_('LNG_YOUR_RATING') ?></span></p>
				</div>
			</div>
			
			<div class="company-info-review" <?php echo !$appSettings->enable_reviews? 'style="display:none"':'' ?>>
				<div style="display:none" class="login-awareness tooltip">
								<div class="arrow">�</div>
								<div class="inner-dialog">
								<a href="javascript:void(0)" class="close-button" onclick="jQuery(this).parent().parent().hide()"><?php echo JText::_('LNG_CLOSE') ?></a>
								<p>
								<strong><?php echo JText::_('LNG_INFO') ?></strong>
								</p>
								<p>
									<?php echo JText::_('LNG_YOU_HAVE_TO_BE_LOGGED_IN') ?>
								</p>
								</div>
				</div>
				<p class="review-count">
					<?php if(count($this->reviews)){ ?> 
					 <a  href="javascript:void(0)" onclick="showTab(3)"><?php echo count($this->reviews)?> <?php echo JText::_('LNG_REVIEWS') ?></a>
						 <?php if(!$appSettings->enable_reviews_users || $user->id !=0) {?>
						&nbsp;|&nbsp;
						<a href="javascript:void(0)" onclick="addReview()"> <?php echo JText::_('LNG_WRITE_REVIEW') ?></a>
						<?php }?>
					<?php } else{ ?>
					<a href="javascript:void(0)" onclick="addReview()" <?php echo ($appSettings->enable_reviews_users && $user->id ==0) ? 'style="display:none"':'' ?>><?php echo JText::_('LNG_BE_THE_FIRST_TO_REVIEW') ?></a>
					<?php }?>
				</p>
			</div>
			
			<?php if(isset($this->company->slogan) && strlen($this->company->slogan)>2){?>
				<p class="business-slogan"><?php echo  $this->company->slogan ?> </p>
			<?php }?>
			
			<div>		
				<div class="company-info-details">
					<p>
						<span class="company-address">
							<?php echo JBusinessUtil::getAddressText($this->company) ?>
						</span>
					</p>
		
					<?php if(isset( $this->company->phone) &&  $this->company->phone!='' && $showData){ ?>
							<span class="phone" itemprop="tel">
									<a href="tel:<?php  echo $this->company->phone; ?>"><?php  echo $this->company->phone; ?></a>
							</span>
							
					<?php } ?>
						
					<?php if(isset( $this->company->mobile) &&  $this->company->mobile!='' && $showData){ ?>
						<span class="mobile" itemprop="tel">
								M <a href="tel:<?php  echo $this->company->mobile; ?>"><?php  echo $this->company->mobile; ?></a>
						</span>
						
					<?php } ?>
						
					<?php if(isset( $this->company->fax) && strlen($this->company->fax)>3 && $showData){?>
						<span class="fax">
							<?php echo $this->company->fax?>
						</span>
					<?php } ?>
					
					<ul class="features-links">
							<li>
							<?php if(($showData && isset($this->package->features) && in_array(WEBSITE_ADDRESS,$this->package->features) || !$appSettings->enable_packages) && !empty($company->website)){ ?>
									<a title="<?php echo $this->company->name?> Website" target="_blank" rel="nofollow"  href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=companies&task=companies.showCompanyWebsite&companyId='.$company->id) ?>">» <?php echo JText::_('LNG_WEBSITE') ?></a>
								<?php }?>
							</li>
					</ul>
				
					<div class="classification">
						<div class="categories">
							<?php if(isset($this->company->typeName)){ ?>
							<?php echo JText::_('LNG_TYPE')?>: <span><?php echo $this->company->typeName?></span>
							<?php } ?>	
						</div>
					</div>
					<div class="classification">
						<div>
							
							<ul class="business-categories">
								<li><?php echo JText::_('LNG_CATEGORIES')?>:&nbsp;</li>
							<?php 
								$categoryIds = explode(',',$this->company->categoryIds);
								$categoryNames =  explode('#',$this->company->categoryNames);
								for($i=0;$i<count($categoryIds);$i++){
									?>
										<li><a rel="nofollow" href="<?php echo JBusinessUtil::getCategoryLink($categoryIds[$i],  $categoryNames[$i]) ?>"><?php echo $categoryNames[$i]?><?php echo $i<(count($categoryIds)-1)? ',&nbsp;':'' ?></a> </li>
									<?php 
								}
							?>
							</ul>
						</div>
					</div>
					<div class="clear"></div>
					<div class="custom-fields">
						<?php 
							// to do fix warning
							$renderedContent = AttributeService::renderAttributesFront($this->companyAttributes,$appSettings->enable_packages, $this->package->features);
							echo $renderedContent;
						?>
					</div>
					<?php if($showData && isset($this->package->features) && in_array(SOCIAL_NETWORKS, $this->package->features) || !$appSettings->enable_packages
							&& ((isset($this->company->facebook) && strlen($this->company->facebook)>3 || isset($this->company->twitter) && strlen($this->company->twitter)>3 || isset($this->company->googlep) && strlen($this->company->googlep)>3))){ ?> 
					<div id="social-networks-container">
						
						<ul class="social-networks">
							<li>
								<span class="social-networks-follow"><?php echo JText::_("LNG_FOLLOW_US")?>: &nbsp;</span>
							</li>
							<?php if(isset($this->company->facebook) && strlen($this->company->facebook)>3){ ?>
							<li >
								<a title="Follow us on Facebook" target="_blank" rel="nofollow" class="share-social facebook" href="<?php echo $this->company->facebook ?>">Facebook</a>			
							</li>
							<?php } ?>
							<?php if(isset($this->company->twitter) && strlen($this->company->twitter)>3){ ?>
							<li >
								<a title="Follow us on Twitter" target="_blank" rel="nofollow" class="share-social twitter" href="<?php echo $this->company->twitter ?>">Twitter</a>			
							</li>
							<?php } ?>
							<?php if(isset($this->company->googlep) && strlen($this->company->googlep)>3){ ?>
							<li >
								<a title="Follow us on Google" target="_blank" rel="nofollow" class="share-social google" href="<?php echo $this->company->googlep ?>">Google</a>			
							</li>
							<?php } ?>
						</ul>
						<div class="clear"></div>
					</div>
					<?php } ?>
					
					<?php if(($showData && isset($this->package->features) && in_array(CONTACT_FORM,$this->package->features) || !$appSettings->enable_packages) && !empty($company->email)){ ?>
							<button type="button" class="ui-dir-button" onclick="showContactCompany()">
								<span class="ui-button-text"><?php echo JText::_("LNG_CONTACT_COMPANY")?></span>
							</button>
					<?php } ?>
				</div>
			</div>
		</div>
			<div style="display:none" class="login-awareness tooltip" id="claim-login-awarness">
				<div class="arrow">�</div>
				<div class="inner-dialog">
					<a href="javascript:void(0)" class="close-button" onclick="jQuery(this).parent().parent().hide()"><?php echo JText::_('LNG_CLOSE') ?></a>
					<p>
						<strong><?php echo JText::_('LNG_INFO') ?></strong>
					</p>
					<p>
						<?php echo JText::_('LNG_YOU_HAVE_TO_BE_LOGGED_IN') ?>
					</p>
					<p>
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=login&return='.base64_encode($url)); ?>"><?php echo JText::_('LNG_CLICK_LOGIN') ?></a>
					</p>
				</div>
			</div>
		<div class="clear"></div>
		
		
		
		<div class="clear"></div>
		
		<?php if((!isset($this->company->userId) || $this->company->userId == 0) && $appSettings->claim_business){ ?>
		<div class="claim-container" id="claim-container">
			<div class="claim-btn">
				<a href="javascript:claimCompany()"><?php echo JText::_('LNG_CLAIM_COMPANY')?></a>
			</div>
		</div>
		<?php  } ?>
	</div>
	<div id="tab-panel" class="dir-tab-panel span8">
		<div id="tabs" class="clearfix">
			<ul class="tab-list">
				<?php
					$tabs = array();
					$tabs[1]=JText::_('LNG_BUSINESS_DETAILS');
					if((isset($this->package->features) && in_array(GOOGLE_MAP,$this->package->features) || !$appSettings->enable_packages ) 
							&& !empty($this->company->latitude) && !empty($this->company->longitude)){ 
						$tabs[2]=JText::_('LNG_MAP');
					}
					if($appSettings->enable_reviews && isset($this->reviews) &&  count($this->reviews)>0){
						$tabs[3]=JText::_('LNG_REVIEWS');
					}
					if((isset($this->package->features) && in_array(IMAGE_UPLOAD,$this->package->features) || !$appSettings->enable_packages)
							&& isset($this->pictures) && count($this->pictures)>0){
						$tabs[4]=JText::_('LNG_GALLERY');
					}
					if((isset($this->package->features) && in_array(VIDEOS,$this->package->features) || !$appSettings->enable_packages)
							&& isset($this->videos) && count($this->videos)>0){
						$tabs[5]=JText::_('LNG_VIDEOS');
					}
					if((isset($this->package->features) && in_array(COMPANY_OFFERS,$this->package->features) || !$appSettings->enable_packages)
							&& isset($this->offers) && count($this->offers) && $appSettings->enable_offers){
						$tabs[6]=JText::_('LNG_OFFERS');
					}
					
					if((isset($this->package->features) && in_array(COMPANY_EVENTS,$this->package->features) || !$appSettings->enable_packages)
							&& isset($this->events) && count($this->events) && $appSettings->enable_events){
						$tabs[7]=JText::_('LNG_EVENTS');
					}
					
					if(!empty($this->company->locations)){
						$tabs[8]=JText::_('LNG_COMPANY_LOCATIONS');
					}
						
					
					foreach($tabs as $key=>$tab){
					?>
						<li class="dir-tabs-options"><span id="dir-tab-<?php echo $key?>"  onclick="showDirTab('#tabs-<?php echo $key?>')" class="track-business-details"><?php echo $tab?></span></li>
					<?php } ?>
			</ul>
		
		
			<div id="tabs-1" class="dir-tab ui-tabs-panel">
				<?php require_once 'details.php'; ?>
			</div>
			
			<?php if((isset($this->package->features) && in_array(GOOGLE_MAP,$this->package->features) || !$appSettings->enable_packages ) 
							&& isset($this->company->latitude) && isset($this->company->longitude)){ 
			?>
			<div id="tabs-2" class="dir-tab ui-tabs-panel">
				<?php 
					if(isset($this->company->latitude) && isset($this->company->longitude) && $this->company->latitude!='' && $this->company->longitude!='')
						require_once 'map.php';
					else
						echo JText::_("LNG_NO_MAP_COORDINATES_DEFINED");
				?>
			</div>
			<?php } ?>
			
			<?php if($appSettings->enable_reviews && isset($this->reviews) &&  count($this->reviews)>0){ ?>
			<div id="tabs-3" class="dir-tab ui-tabs-panel">
				<?php require_once 'reviews.php'; ?>
			</div>
			<?php }?>
			<?php 
				if((isset($this->package->features) && in_array(IMAGE_UPLOAD,$this->package->features) || !$appSettings->enable_packages)
					&& isset($this->pictures) && count($this->pictures)>0){ 
			?>
			<div id="tabs-4" class="dir-tab ui-tabs-panel">
				<?php require_once 'companygallery.php'; ?>
			</div>
			<?php } ?>
			
			<?php 
				if((isset($this->package->features) && in_array(VIDEOS,$this->package->features) || !$appSettings->enable_packages)
					&& isset($this->videos) && count( $this->videos)>0){	
			?>
			<div id="tabs-5" class="dir-tab ui-tabs-panel">
				<?php require_once 'companyvideos.php'; ?>
			</div>	
			<?php } ?>
			
			<?php 
				if((isset($this->package->features) && in_array(COMPANY_OFFERS,$this->package->features) || !$appSettings->enable_packages)
					&& isset($this->offers) && count($this->offers) && $appSettings->enable_offers){
			?>
			<div id="tabs-6" class="dir-tab ui-tabs-panel">
				<?php require_once 'companyoffers.php'; ?>
			</div>
			<?php } ?>
			
			<?php 
				if((isset($this->package->features) && in_array(COMPANY_EVENTS,$this->package->features) || !$appSettings->enable_packages)
					&& isset($this->events) && count($this->events) && $appSettings->enable_events){
			?>
			<div id="tabs-7" class="dir-tab ui-tabs-panel">
				<?php require_once 'events.php'; ?>
			</div>
			<?php } ?>
			
			<?php if(!empty($this->company->locations)){ ?>
				<div id="tabs-8" class="dir-tab ui-tabs-panel">
					<?php require_once 'locations.php'; ?>	
				</div>
			<?php } ?>
	</div>
	</div>
</div >
<div class="clear"></div>

<form name="tabsForm" action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory') ?>" id="tabsForm" method="post">
 	 <input type="hidden" name="option"	value="<?php echo JBusinessUtil::getComponentName()?>" />
	 <input type="hidden" name="task" value="companies.displayCompany" /> 
	 <input type="hidden" name="tabId" id="tabId" value="<?php echo $this->tabId?>" /> 
	 <input type="hidden" name="view" value="companies" /> 
	 <input type="hidden" name="layout2" id="layout2" value="" /> 
	 <input type="hidden" name="companyId" value="<?php echo $this->company->id?>" />
	 <input type="hidden" name="controller"	value="<?php echo JRequest::getCmd('controller', 'J-BusinessDirectory')?>" />
</form>
</div>
<script>
jQuery(document).ready(function(){
	jQuery( "#tabs" ).tabs();

	jQuery("#dir-tab-2").click(function(){
		loadScript();
	});

	jQuery(".dir-tabs-options").click(function(){
		jQuery(".dir-tabs-options").each(function(){
			jQuery(this).removeClass("ui-state-active");
		});
		jQuery(this).addClass("ui-state-active");
	});

	jQuery("#dir-tab-<?php echo $this->tabId ?>").click(); 
});   

function showDirTab(tab){
	jQuery(".dir-tab").each(function(){
		jQuery(this).hide();
	});

	jQuery(tab).show();
}

</script>

<?php require_once 'company_util.php'; ?>