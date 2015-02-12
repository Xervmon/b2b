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

$user = JFactory::getUser();
?>

<div id="process-container" class="process-container">
	<div class="process-steps-wrapper">
		<div id="process-steps-container" class="process-steps-container">
			<div class="main-process-step" >
				<div class="process-step-number">1</div>
				<?php echo JText::_("LNG_CHOOSE_PACKAGE")?>
			</div>
			<div class="main-process-step" >
				<div class="process-step-number">2</div>
				<?php echo JText::_("LNG_BASIC_INFO")?>
			</div>
			<div class="main-process-step">
				<div class="process-step-number">3</div>
				<?php echo JText::_("LNG_LISTING_INFO")?>
			</div>
		</div>
	
		<div class="meter">
			<span style="width: 13%"></span>
		</div>
	</div>
	<div class="clear"></div>
</div>


<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&task=businessuser.checkUser'); ?>" method="post" name="package-form" id="package-form" >
<div class="featured-product-container">
	<?php foreach($this->packages as $package){?>		
		<div class="featured-product-col higlight-enable" >
			<div class="featured-product-col-border" id="hss">
				<div class="featured-product-head">
					<div class="head-text" >
						<div class="name">
							<?php echo $package->name ?> 
						</div>
						<div class="price" >
							<span class="item1"><font><font><?php echo $package->price == 0 ? JText::_("LNG_FREE"):$package->price." ".$this->appSettings->currency_name?></font></font></span>
							<span class="item2">
								<?php echo $package->description ?>
							</span>
						</div>
					</div>
				</div>
					<div class="featured-product-cell" >
						 <div class="feature-days"></div>
					<?php if($package->days == 0 ) {?>
						<font><font><?php echo JText::_('LNG_NO_TIME_LIMIT')?></font></font>  
					 <?php }else{?>
					 	<font><font>
					 		<?php 
					 			echo $package->time_amount;
					 			echo ' ';
					 			$time_unit = JText::_('LNG_DAYS');
					 			switch($package->time_unit){
					 				case "D":
					 					$time_unit = JText::_('LNG_DAYS');
					 					break;
					 				case "W":
					 					$time_unit = JText::_('LNG_WEEKS');
					 					break;
					 				case "M":
					 					$time_unit = JText::_('LNG_MONTHS');
					 					break;
					 				case "Y":
					 					$time_unit = JText::_('LNG_YEARS');
					 					break;
					 			}
					 			
					 			echo $time_unit;
					 		?>
					 		</font></font>
					 <?php }?>	
				</div>
				
				<div class="featured-product-cell" >
					<?php if(isset($package->features) && in_array(FEATURED_COMPANIES,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_FEATURED_COMPANY')?></font></font>
				</div>
				<div class="featured-product-cell" >
					<?php if(isset($package->features) && in_array(HTML_DESCRIPTION,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_HTML_DESCRIPTION')?></font></font>
				</div>
			
				<div class="featured-product-cell" >
					<?php if(isset($package->features) && in_array(SHOW_COMPANY_LOGO,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_SHOW_COMPANY_LOGO')?></font></font>
				</div>
				
				<div class="featured-product-cell" >
					<?php if(isset($package->features) && in_array(WEBSITE_ADDRESS,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_WEBSITE_ADDRESS')?></font></font>
				</div>
				
				<div class="featured-product-cell" >
					<?php if(isset($package->features) && in_array(IMAGE_UPLOAD,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_IMAGE_UPLOAD')?></font></font>
				</div>
				<div class="featured-product-cell odd" >
					<?php if(isset($package->features) && in_array(VIDEOS,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_VIDEOS')?></font></font>
				</div>
				<div class="featured-product-cell" >
					<?php if(isset($package->features) && in_array(GOOGLE_MAP,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_GOOGLE_MAP')?></font></font>
				</div>
				<div class="featured-product-cell odd" >
					<?php if(isset($package->features) && in_array(CONTACT_FORM,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_CONTACT_FORM')?></font></font>
				</div>
				<div class="featured-product-cell" >
					<?php if(isset($package->features) && in_array(COMPANY_OFFERS,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_COMPANY_OFFERS')?></font></font>
				</div>
				<div class="featured-product-cell" >
					<?php if(isset($package->features) && in_array(COMPANY_EVENTS,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_COMPANY_EVENTS')?></font></font>
				</div>
				<div class="featured-product-cell odd" >
					<?php if(isset($package->features) && in_array(SOCIAL_NETWORKS,$package->features)){?>
						 <div class="contained-feature"></div>
					 <?php }else{?>
					 	 <div class="not-contained-feature"></div>
					 <?php }?>
					<font><font><?php echo JText::_('LNG_SOCIAL_NETWORK')?></font></font>
				</div>
				
				
				<div class="featured-product-cell" >
					<button type="button" class="ui-dir-button ui-dir-button-green" onclick="selectPackage(<?php echo $package->id?>)">
						<span class="ui-button-text"><?php echo JText::_("LNG_SELECT_PACKAGE")?></span>
					</button>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
	<div class="clear"></div>
	<input type="hidden" name="option" value="<?php echo JBusinessUtil::getComponentName()?>" /> 
	<input type="hidden" name="filter_package" id="filter_package" value="" />
	<input type="hidden" name="companyId" value="<?php echo $this->companyId ?>" />
	<input type="hidden" name="task" value="businessuser.checkUser" /> 
</form>
<script>

jQuery(document).ready(function(){
	//jQuery('div.featured-product-col').removeClass("highlight");
	jQuery('div.higlight-enable').mouseenter(function() {
		jQuery(this).addClass("highlight");
	}).mouseleave(function() {
		jQuery(this).removeClass("highlight");
});

calibrateElements();
jQuery(window).resize(function(){
		calibrateElements();
	});
});

function calibrateElements(){
	jQuery("#features > .featured-product-cell").each(function(index){
		jQuery("#hss > .featured-product-cell:nth-child("+(index+2)+")").height(jQuery(this).height()-1);
		jQuery("#hsp > .featured-product-cell:nth-child("+(index+2)+")").height(jQuery(this).height()-1);
		jQuery("#hms > .featured-product-cell:nth-child("+(index+2)+")").height(jQuery(this).height()-1);
		jQuery("#hmp > .featured-product-cell:nth-child("+(index+2)+")").height(jQuery(this).height()-1);
		jQuery("#hpp > .featured-product-cell:nth-child("+(index+2)+")").height(jQuery(this).height()-1);
	});
};	

function selectPackage(packageId){
		jQuery("#filter_package").val(packageId);
		jQuery("#package-form").submit();
}

</script>