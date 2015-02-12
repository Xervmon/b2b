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

$document = JFactory::getDocument();
$config = new JConfig();

$title = JText::_("LNG_OFFERS").' | '.$config->sitename;
$description = $this->appSettings->meta_description;

$document->setTitle($title);
$document->setDescription($description);
$document->setMetaData('keywords', $this->appSettings->meta_keywords);

$fullWidth = true;
$enableSearchFilter = $this->appSettings->enable_search_filter_offers;
?>

<div id="offers" class="row-fluid">
<h1 class="title"><?php echo JText::_("LNG_SPECIAL_OFFERS")?></h1>
<?php if($this->categoryId ){?>
<div id="search-path">
	<ul>
		<?php if(isset($this->category)){ ?>
		<li>
			<a class="search-filter-elem" href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=offers') ?>"><?php echo JText::_('LNG_ALL_CATEGORIES') ?></a>
		</li>
		<?php } ?>
	<?php 
		if(isset($this->searchFilter["path"])){
		foreach($this->searchFilter["path"] as $path) {?>
		<li>
			<a  class="search-filter-elem" href="<?php echo JBusinessUtil::getOfferCategoryLink($path[0], $path[2]) ?>"><?php echo $path[1]?></a>
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
<?php if($enableSearchFilter){
	$fullWidth = false;
		?>
	<div id="search-filter" class="search-filter moduletable span3">
		<h3><?php echo JText::_("LNG_SEARCH_FILTER")?></h3>
		<div class="search-category-box">
		<h4><?php echo JText::_("LNG_CATEGORIES")?></h4>
			<ul>
			<?php 
			if(isset($this->searchFilter["categories"])){
				foreach($this->searchFilter["categories"] as $filterCriteria){ 
					$fullWidth = false;
					?>
				<li>
					<?php if( isset($this->category) && $filterCriteria[0][0]->id == $this->category->id){ ?>
						<strong><?php echo $filterCriteria[0][0]->name; ?>&nbsp;</strong><?php echo '('.$filterCriteria[1].')' ?>
					<?php }else{?>
					<a href="<?php echo JBusinessUtil::getOfferCategoryLink($filterCriteria[0][0]->id, $filterCriteria[0][0]->alias) ?>"><?php echo $filterCriteria[0][0]->name; ?></a>
					<?php echo '('.$filterCriteria[1].')' ?>
					<?php } ?>
				</li>
			<?php }
				}
			?>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
<?php }?>
<?php } else {
	jimport('joomla.application.module.helper');
	// this is where you want to load your module position
	$modules = JModuleHelper::getModules('categories-offers');
	
	 if(isset($modules) && count($modules)>0){
		$fullWidth = false;
		foreach($modules as $module)
		{
			echo JModuleHelper::renderModule($module);
		}
	 }	
 }
 ?>

 <form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory') ?>" method="post" name="adminForm" id="adminForm"  >
	 <div id="search-results" class="<?php echo $fullWidth ?'search-results-full span12':'search-results-normal span9' ?> ">
		<div id="search-details">
			<?php  if(isset($this->categoryId) && $this->categoryId!=0){ ?>
				<?php echo JText::_('LNG_SHOW_CATEGORY') ?> <strong>'<?php echo $this->category->name ?>'</strong>
			<?php } ?>	
			<?php if($this->appSettings->show_search_map){?>
			<div class="search-toggles">
			
				<p class="view-mode">
					<label><?php echo JText::_('LNG_VIEW')?></label>
					<a id="grid-view-link" class="grid active" title="Grid" href="javascript:showGrid()"><?php echo JText::_("LNG_GRID")?></a>
					<a id="list-view-link" class="list " title="List" href="javascript:showList()"><?php echo JText::_("LNG_LIST")?></a>
				</p>
				
				<p class="view-mode">
					<a id="map-link" class="map" title="Grid" href="javascript:showMap(true)"><?php echo JText::_("LNG_SHOW_MAP")?></a>
				</p>
			
				<div class="clear"></div>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
		
		<div id="search-info">
			<div class="sort-by">
				<ul class="horizontal">
					<li class="title">
						<span><?php echo JText::_('LNG_SORT_BY');?>: </span>
					</li>
					<li>
						<input onclick="changeOrder(this.value)" <?php echo $this->orderBy=='subject'?"checked=checked":'' ?> name="orderBy" id="subject" value="subject" class="radio" type="radio"> &nbsp;
						<label for="comanyName"><?php echo JText::_('LNG_NAME');?></label>
					</li>
					<li>
						<input onclick="changeOrder(this.value)" <?php echo $this->orderBy=='city'?"checked=checked":'' ?> name="orderBy" id="city" value="city" class="radio" type="radio"> &nbsp;
						<label for="comanyName"><?php echo JText::_('LNG_CITY');?></label>
					</li>
				</ul>
			</div>
			<div class="result-counter"><?php echo $this->pagination->getResultsCounter()?></div>
			<div class="clear"></div>
		</div>
		<div id="companies-map-container" style="display:none">
			<?php require_once 'map.php' ?>
		</div>
		<?php 
			 if($this->appSettings->offer_search_results_grid_view==1){
			 	require_once 'grid_view_2.php';
			 }else{
			 	require_once 'grid_view_1.php';
			 }
			 require_once 'list_view.php';
		?>
		<div class="pagination" <?php echo $this->pagination->total==0 ? 'style="display:none"':''?>>
			<?php echo $this->pagination->getListFooter(); ?>
			<div class="clear"></div>
		</div>
	</div>
	<input type='hidden' name='view' value='offers' />
</form>	
<div class="clear"></div>		
</div>
 </div>
<script>
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
	jQuery("#offer-list-view").show();
	jQuery("#layout").hide();

	jQuery("#grid-view-link").removeClass("active");
	jQuery("#list-view-link").addClass("active");
}

function showGrid(){
	jQuery("#offer-list-view").hide();
	jQuery("#layout").show();
	jQuery(window).resize();
	
	jQuery("#grid-view-link").addClass("active");
	jQuery("#list-view-link").removeClass("active");
}
		
</script>
