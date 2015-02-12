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

$document = JFactory::getDocument();
$config = new JConfig();

$title = JText::_("LNG_SEARCH").' | '.$config->sitename;
$description = $this->appSettings->meta_description;

$document->setTitle($title);
$document->setDescription($description);
$document->setMetaData('keywords', $this->appSettings->meta_keywords);


$user = JFactory::getUser();

$enableSearchFilter = $this->appSettings->enable_search_filter;
?>


<div id="search-path">
	<ul>
		<?php if(isset($this->category)){ ?>
		<li>
			<a class="search-filter-elem" href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=search') ?>"><?php echo JText::_('LNG_ALL_CATEGORIES') ?></a>
		</li>
		<?php } ?>
	<?php 
		if(isset($this->searchFilter["path"])){
		foreach($this->searchFilter["path"] as $path) {?>
		<li>
			<a  class="search-filter-elem" href="<?php echo JBusinessUtil::getCategoryLink($path[0], $path[2]) ?>"><?php echo $path[1]?></a>
		</li>
	<?php }
		} 
	?>
		<li>
			<?php if(isset($this->category)) echo $this->category->name ?>
		</li>
	</ul>
</div>

<div class="clear"></div>
<div class="row-fluid">
<?php if($enableSearchFilter){?>
<div id="search-filter" class="search-filter moduletable span3">
	<h3><?php echo JText::_("LNG_SEARCH_FILTER")?></h3>
	<div class="search-category-box">
	 <?php if(!empty($this->location["latitude"])){ ?>
		<h4><?php echo JText::_("LNG_DISTANCE")?></h4>
		<ul>
			<li>
				<?php if($this->radius != 50){ ?>
					<a href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&controller=search&view=search&radius=50') ?>">50 <?php echo $this->appSettings->metric==1?JText::_("LNG_MILES"):JText::_("LNG_KM") ?></a>
				<?php }else{ ?>
					<strong>50 <?php echo $this->appSettings->metric==1?JText::_("LNG_MILES"):JText::_("LNG_KM") ?></strong>
				<?php } ?>
			</li>
			<li>
				<?php if($this->radius != 25){ ?>
					<a href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&controller=search&view=search&radius=25') ?>">25 <?php echo $this->appSettings->metric==1?JText::_("LNG_MILES"):JText::_("LNG_KM") ?></a>
				<?php }else{ ?>
					<strong>25 <?php echo $this->appSettings->metric==1?JText::_("LNG_MILES"):JText::_("LNG_KM") ?></strong>
				<?php } ?>
			</li>
			<li>
				<?php if($this->radius != 10){ ?>
					<a href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&controller=search&view=search&radius=10') ?>">10 <?php echo $this->appSettings->metric==1?JText::_("LNG_MILES"):JText::_("LNG_KM") ?></a>
				<?php }else{ ?>
					<strong>10 <?php echo $this->appSettings->metric==1?JText::_("LNG_MILES"):JText::_("LNG_KM") ?></strong>
				<?php } ?>
			</li>
			<li>
				<?php if($this->radius != 0){ ?>
					<a href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&controller=search&view=search&radius=0') ?>">ALL</a>
				<?php }else{ ?>
					<strong>All</strong>
				<?php } ?>
			</li>
		</ul>
	<?php } ?>
	
	<h4><?php echo JText::_("LNG_CATEGORIES")?></h4>
		<?php if($this->appSettings->search_type==0){ ?>
		<ul>
		<?php 
		if(isset($this->searchFilter["categories"])){
			foreach($this->searchFilter["categories"] as $filterCriteria){ 
				if($filterCriteria[1]>0){
				?>
				<li>
					<?php if(isset($this->category) && $filterCriteria[0][0]->id == $this->category->id){ ?>
						<strong><?php echo $filterCriteria[0][0]->name; ?>&nbsp;</strong><?php echo '('.$filterCriteria[1].')' ?>
					<?php }else {?>
						<a href="<?php echo JBusinessUtil::getCategoryLink($filterCriteria[0][0]->id, $filterCriteria[0][0]->alias) ?>"><?php echo $filterCriteria[0][0]->name; ?></a>
						<?php echo '('.$filterCriteria[1].')' ?>
					<?php } ?>
				</li>
			<?php }
				}
			}?>
		</ul>
		<?php }else{?>
			<ul>
			<?php 
			if(isset($this->searchFilter["categories"])){
				foreach($this->searchFilter["categories"] as $filterCriteria){ 
					if($filterCriteria[1]>0){
					?>
					<li <?php if(in_array($filterCriteria[0][0]->id,$this->selectedCategories)) echo 'class="selectedlink"';  ?>>
						<div <?php if(in_array($filterCriteria[0][0]->id,$this->selectedCategories)) echo 'class="selected"';  ?>>
							<a href="javascript:void(0)" onclick="<?php echo in_array($filterCriteria[0][0]->id,$this->selectedCategories)?"removeFilterRule(".$filterCriteria[0][0]->id.")":"addFilterRule(".$filterCriteria[0][0]->id.")";?>"> <?php echo $filterCriteria[0][0]->name ?>  <?php echo in_array($filterCriteria[0][0]->id,$this->selectedCategories) ? '<span class="cross">(remove)</span>':"";  ?></a>
							<?php echo '('.$filterCriteria[1].')' ?>
						</div>
						<?php if(isset($filterCriteria[0]["subCategories"])){?>
							<ul>
							<?php foreach($filterCriteria[0]["subCategories"] as $subcategory){?>
								<li <?php if(in_array($subcategory[0]->id,$this->selectedCategories)) echo 'class="selectedlink"';  ?>>
									<div <?php if(in_array($subcategory[0]->id,$this->selectedCategories)) echo 'class="selected"';  ?>>
										<a href="javascript:void(0)" onclick="<?php echo in_array($subcategory[0]->id,$this->selectedCategories)?"removeFilterRule(".$subcategory[0]->id.")":"addFilterRule(".$subcategory[0]->id.")";?>"> <?php echo $subcategory[0]->name ?>  <?php echo in_array($subcategory[0]->id,$this->selectedCategories) ? '<span class="cross">(remove)</span>':"";  ?></a>
									</div>	
								</li>
							<?php }?>
							</ul>
						<?php } ?>
					</li>
				<?php }
					}
				}?>
			</ul>
		<?php } ?>
	</div>
</div>
<?php }?>
<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory') ?>" method="post" name="adminForm" id="adminForm"  >
	

	<div id="search-results" class="search-results <?php echo !$enableSearchFilter ?'search-results-full span12':'search-results-normal span9' ?> ">
		<?php if(isset($this->category) && $this->appSettings->show_cat_description){?>
			<div class="category-container">
				
				<?php if(!empty($this->category->imageLocation)){ ?>
					<div class="categoy-image"><img alt="<?php echo $this->category->name?>" src="<?php echo JURI::root().PICTURES_PATH.$this->category->imageLocation ?>"></div>
				<?php } ?>
				<h3><?php echo $this->category->name?></h3>
				<div>
					<?php echo $this->category->description?>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>
		<div id="search-details">
		
			<?php if($this->appSettings->show_search_map){?>
			<div class="search-toggles">
			
				<p class="view-mode">
					<label><?php echo JText::_('LNG_VIEW')?></label>
					<a id="grid-view-link" class="grid" title="Grid" href="javascript:showGrid()"><?php echo JText::_("LNG_GRID")?></a>
					<a id="list-view-link" class="list active" title="List" href="javascript:showList()"><?php echo JText::_("LNG_LIST")?></a>
				</p>
				
				<p class="view-mode">
					<a id="map-link" class="map" title="Grid" href="javascript:showMap(true)"><?php echo JText::_("LNG_SHOW_MAP")?></a>
				</p>
			
				<div class="clear"></div>
			</div>
			<?php } ?>
			<span class="search-keyword">
				<?php  if(isset($this->categoryId) && $this->categoryId!=0){ ?>
					<?php echo JText::_('LNG_SHOW_CATEGORY') ?> <strong>'<?php echo $this->category->name ?>'</strong>
				<?php }else{ ?>	
					<?php if(!empty($this->searchkeyword) || !empty($this->citySearch) || !empty($this->regionSearch) || !empty($this->zipCode)){
							echo JText::_('LNG_YOU_SEARCHED_FOR');
							echo ' "<strong>';
							$searchText ="";
							$searchText.= !empty($this->searchkeyword)?$this->searchkeyword.", ":"";
							$searchText.= !empty($this->citySearch)?$this->citySearch.", ":"";
							$searchText.= !empty($this->regionSearch)?$this->regionSearch.", ":"";
							$searchText.= !empty($this->zipCode)?$this->zipCode.", ":"";	
							$searchText = trim(trim($searchText), ",");
							echo $searchText;
							echo '</strong>" ';
					 }else{
					 		echo JText::_("LNG_SEARCH_RESULTS");
					 } 
				}?>
			</span>	
		</div>
		<div id="companies-map-container" style="display:none">
			<?php require_once JPATH_COMPONENT_SITE.'/include/search-map.php' ?>
		</div>
		<div id="search-info">
			<div class="sort-by">
				<ul class="horizontal">
					<li class="title">
						<span><?php echo JText::_('LNG_SORT_BY');?>: </span>
					</li>
					<li>
						<input onclick="changeOrder(this.value)" <?php echo $this->orderBy=='companyName'?"checked=checked":'' ?> name="orderBy" id="companyName" value="companyName" class="radio" type="radio"> &nbsp;
						<label for="comanyName"><?php echo JText::_('LNG_NAME');?></label>
					</li>
					<li>
						<input onclick="changeOrder(this.value)" <?php echo $this->orderBy=='city asc'?"checked=checked":'' ?> value="city asc" name="orderBy" id="city" class="radio" type="radio"> &nbsp;
						<label for="city"><?php echo JText::_('LNG_CITY');?></label>
					</li>
					
					<?php if ($this->appSettings->enable_ratings == 1) {?>
						<li>
							<input onclick="changeOrder(this.value)" <?php echo $this->orderBy=='averageRating desc'?"checked=checked":'' ?> value="averageRating desc" name="orderBy" id="rating" class="radio" type="radio"> &nbsp;
							<label for="rating"><?php echo JText::_('LNG_RATING');?></label>
						</li>
					<?php } ?>
					
				</ul>
			</div>
			<div class="result-counter"><?php echo $this->pagination->getResultsCounter()?></div>
			<div class="clear"></div>
		</div>
		
		<?php 
			
			
			require_once JPATH_COMPONENT_SITE.'/include/companies-grid-view.php';
			
			
			
			if($this->appSettings->search_result_view == 1){
				require_once JPATH_COMPONENT_SITE.'/include/companies-list-view.php';
			}else if($this->appSettings->search_result_view == 2){
				require_once JPATH_COMPONENT_SITE.'/include/companies-list-view-intro.php';
			}else if($this->appSettings->search_result_view == 3){
				require_once JPATH_COMPONENT_SITE.'/include/companies-list-view-contact.php';
			}else if($this->appSettings->search_result_view == 4){
				require_once JPATH_COMPONENT_SITE.'/include/companies-list-view-compact.php';
			}else{
				require_once JPATH_COMPONENT_SITE.'/include/companies-list-view.php';
			}
			
				
		?>
		<div class="pagination" <?php echo $this->pagination->total==0 ? 'style="display:none"':''?>>
			
				<?php echo $this->pagination->getListFooter(); ?>
			
			<div class="clear"></div>
		</div>
	</div>
	
	<input type='hidden' name='task' value='searchCompaniesByName'/>
	<input type='hidden' name='controller' value='search' />
	<input type='hidden' name='categories' id="categories-filter" value='<?php echo isset($this->categories)?$this->categories:"" ?>' />
	<input type='hidden' name='view' value='search' />
	<input type='hidden' name='categoryId' value='<?php echo isset($this->categoryId)?$this->categoryId:"0" ?>' />
	<input type='hidden' name='searchkeyword' value='<?php echo isset($this->searchkeyword)?$this->searchkeyword:'' ?>' />
	<input type='hidden' name='categorySearch' value='<?php echo isset($this->categorySearch)?$this->categorySearch: '' ?>' />
	<input type='hidden' name='citySearch' value='<?php echo isset($this->citySearch)?$this->citySearch: '' ?>' />
	<input type='hidden' name='regionSearch' value='<?php echo isset($this->regionSearch)?$this->regionSearch: '' ?>' />
	<input type='hidden' name='zipCode' value='<?php echo isset($this->zipCode)?$this->zipCode: '' ?>' />
</form>
<div class="clear"></div>

</div>
<script>
window.onload = function()	{
	jQuery('.rating-average').raty({
		  half:       true,
		  precision:  false,
		  size:       24,
		  starHalf:   'star-half.png',
		  starOff:    'star-off.png',
		  starOn:     'star-on.png',
		  start:   	  function() { return jQuery(this).attr('title')},
		  path:		  '<?php echo COMPONENT_IMAGE_PATH?>',
		  click: function(score, evt) {
		  	  updateCompanyRate(jQuery(this).attr('alt'),score);
		  }	
		});

	jQuery('.button-toggle').click(function() {  
		 if(!jQuery(this).hasClass("active")) {       
             jQuery(this).addClass('active');
         }
		jQuery('.button-toggle').not(this).removeClass('active'); // remove buttonactive from the others
		
	});

	<?php if ($this->appSettings->map_auto_show == 1) {?>
		showMap(true);
	<?php } ?>

	<?php if ($this->appSettings->search_view_mode == 1) {?>
		showGrid();
	<?php }else{ ?>
		showList();
	<?php }?>
	
};

function changeOrder(orderField){
	jQuery("#orderBy").val(orderField);
	jQuery("#adminForm").submit();	
}

function showMap(display){
	jQuery("#map-link").toggleClass("active");

	if(jQuery("#map-link").hasClass("active")){
		jQuery("#companies-map-container").show();
		jQuery("#map-link").html("<?php echo JText::_("LNG_HIDE_MAP")?>");
		loadMapScript();
	}else{
		jQuery("#map-link").html("<?php echo JText::_("LNG_SHOW_MAP")?>");
		jQuery("#companies-map-container").hide();
	}
}

function showList(){
	jQuery("#results-container").show();
	jQuery("#layout").hide();

	jQuery("#grid-view-link").removeClass("active");
	jQuery("#list-view-link").addClass("active");
}

function showGrid(){
	jQuery("#results-container").hide();
	jQuery("#layout").show();
	jQuery(window).resize();
	
	jQuery("#grid-view-link").addClass("active");
	jQuery("#list-view-link").removeClass("active");
}

function addFilterRule(catId) {
	catId = catId +";";
	if (jQuery("#categories-filter").val().length > 0){
		jQuery("#categories-filter").val(jQuery("#categories-filter").val() + catId);
	}else{
		jQuery("#categories-filter").val(catId);
	}
	jQuery("#adminForm").submit();
}

function removeFilterRule(catId) {
	catId = catId +";";
	var str = jQuery("#categories-filter").val();
	jQuery("#categories-filter").val((str.replace(catId, "")));
	jQuery("#adminForm").submit();
}

</script>
	
	