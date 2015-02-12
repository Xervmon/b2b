<?php

/*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
$preserve = $params->get('preserve');
?>
<div id="companies-search" class="business-directory<?php echo $moduleclass_sfx ?>">
	<!-- strong id="current-search"><?php echo JText::_("LNG_FIND_BUSINESS")?></strong-->
	
	<div id="searchform" class="ui-tabs <?php echo $layoutType?>">
			<?php $title = $params->get('title'); ?>
			<?php if(!empty($title)){ ?>
				<h1><?php echo $title ?></h1>
			<?php } ?>
			
			<?php $description = $params->get('description'); ?>
			<?php if(!empty($description)){ ?>
				<p><?php echo $description ?></p>
			<?php } ?>
			
			<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory') ?>" method="post" name="keywordSearch" id="keywordSearch" onsubmit="return checkSearch()">
				<input type='hidden' name='task' value='searchCompaniesByName'>
				<input type='hidden' name='controller' value='search'>
				<input type='hidden' name='view' value='search'>
				<input type='hidden' name='radius' value='<?php echo $radius?>'>
				<input type='hidden' name='preserve' value='<?php echo $preserve?>'>
				
				<div class="form-container">
					<?php if($params->get('showKeyword')){ ?>
						<div class="form-field">
							<span class="label">
								<input class="search-field" type="text" placeholder="<?php echo JText::_("LNG_BUSINESS_NAME_OR_CATEGORY")?>" name="searchkeyword" id="searchkeyword" value="<?php $session = JFactory::getSession(); echo $preserve?$session->get('searchkeyword'):"";?>" />
							</span>
						</div>
					<?php } ?>
					<?php if($params->get('showKeyword') && false){ ?>
						<div class="form-field">
							<span class="label">
								<input class="search-field" placeholder="<?php echo JText::_("LNG_LOCATION")?>" type="text" name="searchkeywordLocation" id="searchkeywordLocation" value="<?php $session = JFactory::getSession(); echo $preserve?$session->get('searchkeywordLocation'):"";?>" />
							</span>
						</div>
					<?php } ?>
					<?php if($params->get('showCategories')){ ?>
					<div class="form-field">
						<span class="label">
							<select name="categorySearch" id="categories">
								<option value="0"><?php echo JText::_("LNG_ALL_CATEGORIES") ?></option>
								<?php foreach($categories as $category){?>
									<option value="<?php echo $category->id?>" <?php $session = JFactory::getSession(); echo $session->get('categorySearch')==$category->id && $preserve?" selected ":"" ?> ><?php echo $category->name?></option>
									<?php foreach($subCategories as $subCat){?>
										<?php if($subCat->parentId == $category->id){?>
											<option value="<?php echo $subCat->id?>" <?php $session = JFactory::getSession(); echo $session->get('categorySearch')==$subCat->id && $preserve?" selected ":"" ?> >-- <?php echo $subCat->name?></option>
										<?php } ?>
									<?php }?>
								<?php }?>
							</select>
						</span>
					</div>
					<?php }?>
					
					<?php if($params->get('showTypes')){ ?>
					<div class="form-field">
						<span class="label">
							<select name="typeSearch" id="typeSearch">
								<option value="0"><?php echo JText::_("LNG_ALL_TYPES") ?></option>
								<?php foreach($types as $type){?>
									<option value="<?php echo $type->id?>" <?php $session = JFactory::getSession(); echo $session->get('typeSearch')==$type->id && $preserve?" selected ":"" ?> ><?php echo $type->name?></option>
								<?php } ?>
							</select>
						</span>
					</div>
					<?php }?>
					
					<?php if($params->get('showZipcode')){ ?>
						<div class="form-field">
							<span class="label">
								<input class="search-field" placeholder="<?php echo JText::_("LNG_ZIPCODE")?>" type="text" name="zipcode" id="zipcode" value="<?php $session = JFactory::getSession(); echo $preserve?$session->get('zipcode'):"";?>" />
							</span>
						</div>
					<?php } ?>
					
					<?php if($params->get('showCities')){ ?>
					<div class="form-field">
						<span class="label">
							<select name="citySearch" id="citySearch">
								<option value="0"><?php echo JText::_("LNG_ALL_CITIES") ?></option>
								<?php foreach($cities as $city){?>
									<option value="<?php echo $city->city?>" <?php $session = JFactory::getSession(); echo $session->get('citySearch')==$city->city && $preserve?" selected ":"" ?> ><?php echo $city->city?></option>
								<?php }?>
								
							</select>
						</span>
					</div>
					<?php } ?>
					
					<?php if($params->get('showRegions')){ ?>
					<div class="form-field">
						<span class="label">
							<select name="regionSearch" id="regionSearch">
								<option value="0"><?php echo JText::_("LNG_ALL_REGIONS") ?></option>
								<?php foreach($regions as $region){?>
									<option value="<?php echo $region->county?>" <?php $session = JFactory::getSession(); echo $session->get('regionSearch')==$region->county && $preserve?" selected ":"" ?> ><?php echo $region->county?></option>
								<?php }?>
								
							</select>
						</span>
					</div>
					<?php } ?>
					
					<?php if($params->get('showCountries')){ ?>
					<div class="form-field">
						<span class="label">
							<select name="countrySearch" id="countrySearch">
								<option value="0"><?php echo JText::_("LNG_ALL_COUNTRIES") ?></option>
								<?php foreach($countries as $country){?>
									<option value="<?php echo $country->country_id?>" <?php $session = JFactory::getSession(); echo $session->get('countrySearch')==$country->country_id && $preserve?" selected ":"" ?> ><?php echo $country->country_name?></option>
								<?php }?>
								
							</select>
						</span>
					</div>
					<?php } ?>
				</div>
				
				<button type="submit" class="ui-dir-button-green search-dir-button">
					<span class="ui-button-text"><?php echo JText::_("LNG_SEARCH")?></span>
				</button>
				
				<a  style="display:none" id="categories-link" href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&controller=categories&view=categories&task=displaycategories') ?>"><?php echo JText::_("LNG_CATEGORY_LIST")?></a>
			</form>
	</div>
	<div class="clear"></div>
</div>


<script>

function checkSearch(){ 

	<?php if($params->get('mandatoryKeyword')){ ?>
		if(document.getElementById('searchkeyword') && jQuery("#searchkeyword").val().length == 0){
			jQuery("#searchkeyword").focus();
			var label = document.getElementById("keywordLabel");
			label.style.display ="none";
			return false;
		}
	<?php } ?>

	<?php if($params->get('mandatoryCategories')){ ?>
		var foo = document.getElementById('categories');
		if (foo)
		{
		   console.debug(foo.selectedIndex);
		   if (foo.selectedIndex == 0)
		   {
			   jQuery("#categories").focus();
			   return false;
		   } 
		}
	<?php } ?>


	<?php if($params->get('mandatoryCities')){ ?>
		var foo = document.getElementById('citySearch');
		if (foo)
		{
		   if (foo.selectedIndex == 0)
		   {
			   jQuery("#citySearch").focus();
			   return false;
		   } 
		}
	<?php } ?>

	<?php if($params->get('mandatoryRegions')){ ?>
		var foo = document.getElementById('regionSearch');
		if (foo)
		{
		   if (foo.selectedIndex == 0)
		   {
			   jQuery("#regionSearch").focus();
				return false;
		   } 
		}
	<?php } ?>

	<?php if($params->get('mandatoryCountries')){ ?>
		var foo = document.getElementById('countrySearch');
		if (foo)
		{
		   if (foo.selectedIndex == 0)
		   {
			   jQuery("#countrySearch").focus();
			   return false;
		   } 
		}
	<?php } ?>
	
	return true;
}

jQuery(document).ready(function(){
	<?php if($params->get('autocomplete')){?>
	    jQuery("#categories").combobox();
	    jQuery("#citySearch").combobox();
	    jQuery("#regionSearch").combobox();
	    jQuery("#countrySearch").combobox();
	 <?php } ?>

    jQuery("#searchkeyword").autocomplete({
		source: "<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&task=categories.getCategories') ?>",
		minLength: 2,
		select: function( event, ui ) {
			jQuery(this).val(ui.item.label);
			return false;
		}
	});
});

</script>



