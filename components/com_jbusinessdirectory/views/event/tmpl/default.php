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

$uri = JURI::getInstance();
$url = $uri->toString( array('scheme', 'host', 'port', 'path'));

$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();

$title = stripslashes($this->event->name)." | ".$config->sitename;
$description = !empty($this->event->description)?strip_tags(JBusinessUtil::truncate($this->event->description,300)):$appSettings->meta_description;

$document->setTitle($title);
$document->setDescription($description);
$document->setMetaData('keywords', $appSettings->meta_keywords);

if(!empty($this->event->pictures)){
	$document->addCustomTag('<meta property="og:image" content="'.JURI::root().PICTURES_PATH.$this->event->pictures[0]->picture_path .'" /> ');
}
$document->addCustomTag('<meta property="og:type" content="website"/>');
$document->addCustomTag('<meta property="og:url" content="'.$url.'"/>');
$document->addCustomTag('<meta property="og:site_name" content="'.$config->sitename.'"/>');

?>

<?php require_once JPATH_COMPONENT_SITE."/include/social_share.php"?>
<div> <a href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=events'); ?>"><?php echo JText::_("BACK") ?></a></div>
<div id="event-container" class="event-container row-fluid">
	<div id="event-image-container" class="event-image-container span4">
		<div class="image-preview-cnt">
			<a href="javascript:void(0)">
				<img id="image-preview" src='<?php echo JURI::root()."/".PICTURES_PATH.$this->event->pictures[0]->picture_path?>'/>
			</a> 
		</div>
		<div>
			<?php
				foreach( $this->event->pictures as $picture ){
			?>
				<div class="image-prv-cnt left">
					<img class="image-prv"
						src='<?php echo JURI::root()."/".PICTURES_PATH.$picture->picture_path?>' />
				</div>	
				
			<?php } ?>
			<div class="clear"></div>
		</div>
	</div>
	<div id="event-content" class="event-content span8">
		<h2>
			<?php echo $this->event->name?>
		</h2>
		<div class="subject-delimiter"></div>

		  <div class="row-fluid">
			  <div class="event-details span7">
				<table>
					<tr>
						<th><?php echo JText::_('LNG_LOCATION') ?>:</th>
						<td><?php echo $this->event->location?></td>
					</tr>
					<tr>
						<th><?php echo JText::_('LNG_EVENT_PERIOD') ?>:</th>
						<td><span class="event-date"><?php echo JBusinessUtil::getDateGeneralFormat($this->event->start_date) ?> - <?php echo JBusinessUtil::getDateGeneralFormat($this->event->end_date)?></span></td>
					</tr>
					<tr>
						<th><?php echo JText::_('LNG_TYPE') ?>:</th>
						<td><?php echo $this->event->eventType?></td>
					</tr>
				</table>
			</div>
          	<div class="company-details span5">
				<table>
					<tr>
						<td><strong><?php echo JText::_('LNG_COMPANY_DETAILS') ?></strong></td>
					</tr>
					<tr>
						<td><a href="<?php echo JBusinessUtil::getCompanyLink($this->event->company)?>"> <?php echo $this->event->company->name?></a></td>
					</tr>
					<tr>
						<td><?php echo $this->event->company->address?></td>
					</tr>
					<tr>
						<td><strong>T:</strong> <?php echo $this->event->company->phone?></td>
					</tr>
					<tr>
						<td><a href="<?php echo $this->event->company->website?>"><?php echo JText::_('LNG_WEBSITE')?></a></td>
					</tr>
				</table>
	
			</div>
		</div>
		
		<div class="event-description">
			<?php echo $this->event->description?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<script>


// starting the script on page load
jQuery(document).ready(function(){
	jQuery("img.image-prv").click(function(e){
		jQuery("#image-preview").attr('src', this.src);	
	});
});		

</script>