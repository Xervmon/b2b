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

$title = JText::_("LNG_EVENTS").' | '.$config->sitename;
$description = $this->appSettings->meta_description;

$document->setTitle($title);
$document->setDescription($description);
$document->setMetaData('keywords', $this->appSettings->meta_keywords);

$fullWidth = true;

$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
$enableSearchFilter = $appSettings->enable_search_filter_events;

?>

<div id="events" class="row-fluid">
<h1 class="title">
	<?php echo JTEXT::_("LNG_EVENTS") ?>
</h1>
<?php if($this->categoryId ){?>
 <div id="search-path">
	<ul>
	<?php foreach($this->searchFilter["path"] as $path) {?>
		<li>
			<a href="<?php echo JBusinessUtil::getEventCategoryLink($path[0], $path[2]) ?>"><?php echo $path[1]?></a>
		</li>
	<?php } ?>
		<li>
			<?php  if(isset($this->category)) echo $this->category->name ?>
		</li>
	</ul>
</div>
<div class="clear"></div>

<?php if($enableSearchFilter){
	$fullWidth = false;
		?>
	<div id="search-filter" class="search-filter moduletable">
		<h3><?php echo JText::_("LNG_SEARCH_FILTER")?></h3>
		<div class="search-category-box">
		<h4><?php echo JText::_("LNG_CATEGORIES")?></h4>
			<ul>
			<?php 
			if(isset($this->searchFilter["categories"])){
				foreach($this->searchFilter["categories"] as $filterCriteria){ 
					?>
				<li>
					<?php if( isset($this->category) && $filterCriteria[0][0]->id == $this->category->id){ ?>
						<strong><?php echo $filterCriteria[0][0]->name; ?>&nbsp;</strong><?php echo '('.$filterCriteria[1].')' ?>
					<?php }else{?>
					<a href="<?php echo JBusinessUtil::getEventCategoryLink($filterCriteria[0][0]->id, $filterCriteria[0][0]->alias)?>"><?php echo $filterCriteria[0][0]->name; ?></a>
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
	$modules = JModuleHelper::getModules('categories-events');
	
	 if(isset($modules) && count($modules)>0){
		$fullWidth = false;
		foreach($modules as $module)
		{
			echo JModuleHelper::renderModule($module);
		}
	 }	
 }
 ?>
 <div class="result-counter"><?php echo $this->pagination->getResultsCounter()?></div>
<div class='events-container <?php echo $fullWidth ?'full':'noClass' ?>'>
	<ul class="event-list">
	<?php 
		if(isset($this->events) && count($this->events)>0){
			foreach ($this->events as $event){ ?>
				<li>
					<div class="event-box row-fluid">
						<div class="event-img-container span3">
							<a class="event-image"
								href="<?php echo JBusinessUtil::getEventLink($event->id, $event->alias) ?>">
								
								<?php if(isset($event->picture_path) && $event->picture_path!=''){?>
									<img  alt="<?php ?>" src="<?php echo JURI::root()."/".PICTURES_PATH.$event->picture_path?>"> &nbsp;</a>
								<?php }else{?>
									<img title="<?php echo $company->name?>" alt="<?php echo $company->name?>" src="<?php echo JURI::root().PICTURES_PATH.'/no_image.jpg' ?>">
								<?php } ?>
						</div>
						<div class="event-content span8">
							<div class="event-subject">
								<a title="<?php echo $event->name?>"
									href="<?php echo JBusinessUtil::getEventLink($event->id, $event->alias) ?>"><?php echo $event->name?>
								</a>
							</div>
							<div class="event-location">
								<?php echo $event->location?>, <?php echo JBusinessUtil::getDateGeneralFormat($event->start_date)." ".JText::_("LNG_UNTIL")." ".JBusinessUtil::getDateGeneralFormat($event->end_date) ?>
							</div>
							<div class="event-type">
								<?php echo $event->eventType?>
							</div>
							<div class="event-desciption">
								<?php echo JBusinessUtil::truncate($event->description,300) ?>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</li>
			<?php }
		}else{
			echo JText::_("LNG_NO_EVENT_FOUND");
		} ?>
	</ul>
</div>
<div class="pagination" <?php echo $this->pagination->total==0 ? 'style="display:none"':''?>>
	<?php echo $this->pagination->getListFooter(); ?>
	<div class="clear"></div>
</div>		
<div class="clear"></div>		
</div>