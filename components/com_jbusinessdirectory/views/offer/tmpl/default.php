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

$title = stripslashes($this->offer->subject)." | ".$config->sitename;
$description = !empty($this->offer->description)?strip_tags(JBusinessUtil::truncate($this->offer->description,300)):$appSettings->meta_description;

$document->setTitle($title);
$document->setDescription($description);
$document->setMetaData('keywords', $appSettings->meta_keywords);

if(!empty($this->offer->pictures)){
	$document->addCustomTag('<meta property="og:image" content="'.JURI::root().PICTURES_PATH.$this->offer->pictures[0]->picture_path .'" /> ');
}
$document->addCustomTag('<meta property="og:type" content="website"/>');
$document->addCustomTag('<meta property="og:url" content="'.$url.'"/>');
$document->addCustomTag('<meta property="og:site_name" content="'.$config->sitename.'"/>');
?>


<?php require_once JPATH_COMPONENT_SITE."/include/social_share.php"?>

<div> <a href="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=offers'); ?>"><?php echo JText::_("BACK") ?></a></div>
<div id="offer-container" class="offer-container row-fluid">
	<div id="offer-image-container" class="offer-image-container span4">
		<div class="image-preview-cnt">
			<a href="javascript:void(0)">
				<img id="image-preview" src='<?php echo JURI::root()."/".PICTURES_PATH.$this->offer->pictures[0]->picture_path?>'/>
			</a> 
		</div>
		<div>
			<?php
				foreach( $this->offer->pictures as $picture ){
			?>
				<div class="image-prv-cnt left">
					<img class="image-prv"
						src='<?php echo JURI::root()."/".PICTURES_PATH.$picture->picture_path?>' />
				</div>	
				
			<?php } ?>
			<div class="clear"></div>
		</div>
	</div>
	<div id="offer-content" class="offer-content span8">
		<div class="dir-print"><a href="javascript:printOffer(<?php echo $this->offer->id ?>)"><?php echo JText::_("LNG_PRINT")?></a></div>
		<h2>
			<?php echo $this->offer->subject?>
		</h2>
		
		<div class="subject-delimiter"></div>

        <div class="row-fluid">
          <div class="offer-details span7">
			<table>
				<?php if(!empty($this->offer->price)){?>
				<tr>
					<th><?php echo JText::_('LNG_PRICE') ?>:</th>
					<td><?php echo $this->offer->price?> <?php echo $this->appSettings->currency_name?></td>
				</tr>
				<?php } ?>
				
				<?php if(!empty($this->offer->specialPrice)||!empty($this->offer->price)){?>
				<tr>
					<th><?php echo JText::_('LNG_SPECIAL_PRICE') ?>:</th>
					<td><?php echo $this->offer->specialPrice?> <?php echo $this->appSettings->currency_name?></td>
				</tr>
				<?php } ?>
				
				<tr>
					<th><?php echo JText::_('LNG_OFFER_PERIOD') ?>:</th>
					<td ><?php echo JBusinessUtil::getDateGeneralFormat($this->offer->startDate) ?> - <?php echo JBusinessUtil::getDateGeneralFormat($this->offer->endDate)?></td>
				</tr>
			</table>
		</div>
		
		<div class="company-details span5">
			<table>
				<tr>
					<td><strong><?php echo JText::_('LNG_COMPANY_DETAILS') ?></strong></td>
				</tr>
				<tr>
					<td><a href="<?php echo JBusinessUtil::getCompanyLink($this->offer->company)?>"> <?php echo $this->offer->company->name?></a></td>
				</tr>
				<tr>
					<td><?php echo $this->offer->company->street_number.' '.$this->offer->company->address?></td>
				</tr>
				<tr>
					<td><strong>T:</strong> <?php echo $this->offer->company->phone?></td>
				</tr>
				<tr>
					<td><a href="<?php echo $this->offer->company->website?>"><?php echo JText::_('LNG_WEBSITE')?></a></td>
				</tr>
			</table>

		</div>
		
		
		</div>
		<div class="offer-description">
			<h4> <?php echo JText::_('LNG_OFFER_DESCRIPTION') ?> </h4>
			<?php echo $this->offer->description?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div id="offer-dialog" class="offer" style="display:none">
	<div id="dialog-container">
		<div class="titleBar">
			<span class="dialogTitle" id="dialogTitle"></span>
			<span  title="Cancel"  class="dialogCloseButton" onClick="jQuery.unblockUI();">
				<span title="Cancel" class="closeText">x</span>
			</span>
		</div>
		
		<div class="dialogContent">
			<iframe id="offerIfr" height="500" src="">
			
			</iframe>
		</div>
	</div>
</div>


<script>


// starting the script on page load
jQuery(document).ready(function(){
	jQuery("img.image-prv").click(function(e){
		jQuery("#image-preview").attr('src', this.src);	
	});

	
});		

function printOffer(offerId){
	//var baseUrl = "<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=offer&tmpl=component'); ?>";
	//baseUrl = baseUrl + "&offerId="+offerId;
	//jQuery("#offerIfr").attr("src",baseUrl);
	//jQuery.blockUI({ message: jQuery('#offer-dialog'), css: {width: '900px', top: '5%', position: 'absolute'} });
	//jQuery('.blockOverlay').click(jQuery.unblockUI); 

	 var winref = window.open('<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=offer&tmpl=component'); ?>&offerId='+offerId,'windowName','width=1050,height=700');
	 if (window.print) winref.print();
}
</script>