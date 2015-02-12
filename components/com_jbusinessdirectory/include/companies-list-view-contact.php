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
require_once JPATH_COMPONENT_SITE.'/classes/attributes/attributeservice.php';

$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
$enableSEO = $appSettings->enable_seo;
$enablePackages = $appSettings->enable_packages;
$enableRatings = $appSettings->enable_ratings;
$enableNumbering = $appSettings->enable_numbering;
$user = JFactory::getUser();

$showData = !($user->id==0 && $appSettings->show_details_user == 1);
?>

<div id="results-container" class="list-contact" <?php echo $this->appSettings->search_view_mode?'style="display: none"':'' ?>>
<?php 
if(isset($this->companies)){
	foreach($this->companies as $index=>$company){
	?>
		<div id="result" class="result <?php echo isset($company->featured) && $company->featured==1?"featured":"" ?>">
			<?php if(!empty($company->featured)){?>
			
			<div class="business-container  row-fluid">
				<div class="business-info span4">
					<?php if(isset($company->packageFeatures) && in_array(SHOW_COMPANY_LOGO,$company->packageFeatures) || !$enablePackages){ ?>
					<div class="company-image">
						<a href="<?php echo JBusinessUtil::getCompanyLink($company)?>">
							<?php if(isset($company->logoLocation) && $company->logoLocation!=''){?>
								<img title="<?php echo $company->name?>" alt="<?php echo $company->name?>" src="<?php echo JURI::root().PICTURES_PATH.$company->logoLocation ?>"/>
							<?php }else{ ?>
								<img title="<?php echo $company->name?>" alt="<?php echo $company->name?>" src="<?php echo JURI::root().PICTURES_PATH.'/no_image.jpg' ?>"/>
							<?php } ?>
						</a>
					</div>
					<?php } ?>
					
					<div>
						<span class="company-address" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">
							<span itemprop="address"><?php echo JBusinessUtil::getAddressText($company) ?></span>
						</span>
						<?php if(isset($company->phone) && $company->phone!='' && $showData){ ?>
							<span class="phone" itemprop="tel">
									<a href="tel:<?php  echo $company->phone; ?>"><?php  echo $company->phone; ?></a>
							</span>
						<?php } ?>
					</div>
					<div class="company-rating" <?php echo !$enableRatings? 'style="display:none"':'' ?>>
						<div style="display:none" class="rating-awareness tooltip">
							<div class="arrow">»</div>
							<div class="inner-dialog">
							<a href="javascript:void(0)" class="close-button" onclick="jQuery(this).parent().parent().hide()"><?php echo JText::_('LNG_CLOSE') ?></a>
							<strong><?php echo JText::_('LNG_INFO') ?></strong>
								<p>
									<?php echo JText::_('LNG_YOU_HAVE_TO_BE_LOGGED_IN') ?>
								</p>
							</div>
						</div>
						<div class="rating">
							<p class="rating-average" title="<?php echo $company->averageRating?>" alt="<?php echo $company->id?>" style="display: block;"></p>
						</div>						
					</div>
				</div>
		
				<div class="business-details span8">
					<div class="result-content">
						<h3 class="business-name">
							<a href="<?php echo JBusinessUtil::getCompanyLink($company)?>" ><span itemprop="name"> <?php echo $company->name?> </span></a>
						</h3>
						
						<div class="company-short-description">
							<?php echo $company->short_description?> 
						</div>
						
						<div class="company-options">
							<ul>
								<li><a rel="nofollow" href="javascript:showContactCompany(<?php echo $company->id?>)"><?php echo JText::_('LNG_CONTACT') ?></a></li>
								<li><a rel="nofollow" href="javascript:showQuoteCompany(<?php echo $company->id?>)"><?php echo JText::_('LNG_QUOTE') ?></a></li>
								<li><a rel="nofollow" href="<?php echo JBusinessUtil::getCompanyLink($company)?>"><?php echo JText::_('LNG_MORE_INFO') ?></a></li>
							</ul>
						</div>	
						
			
					</div>	
				</div>
			</div>
			<?php }else{?>
				<div class="row-fluid">
					<div class="span12">
						<div class="company-options right">
							<ul>
								<li><a rel="nofollow" href="<?php echo JBusinessUtil::getCompanyLink($company)?>"><?php echo JText::_('LNG_MORE_INFO') ?></a></li>
							</ul>
						</div>	
						<h3 class="business-name">
							<a href="<?php echo JBusinessUtil::getCompanyLink($company)?>" ><span itemprop="name"> <?php echo $company->name?> </span></a>
						</h3>
						
						<span class="company-address" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">
							<span itemprop="street-address"><?php echo $company->street_number.' '.$company->address?></span>
							<span itemprop="locality"><?php echo $company->city?></span>, <span itemprop="county-name"><?php echo $company->county?></span> <span itemprop="zipcode"><?php echo $company->postalCode?></span>
						</span>
						
						
					</div>	
				</div>
			<?php }?>
			
				<?php if(isset($company->featured) && $company->featured==1){ ?>
						<div class="featured-text">
							<?php echo JText::_("LNG_FEATURED")?>
						</div>
					<?php } ?>
			
			<div class="result-actions">
				<ul>
					<li> </li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	<?php 
	
	}
}
?>

</div>


<div id="company-contact" style="display:none">
	<div id="dialog-container">
		<div class="titleBar">
			<span class="dialogTitle" id="dialogTitle"></span>
			<span  title="Cancel"  class="dialogCloseButton" onClick="jQuery.unblockUI();">
				<span title="Cancel" class="closeText">x</span>
			</span>
		</div>
		
		<div class="dialogContent">
			<h3 class="title"><?php echo JText::_('LNG_CONTACT_COMPANY') ?></h3>
		  		<div class="dialogContentBody" id="dialogContentBody">
				
					<form id="contactCompanyFrm" name="contactCompanyFrm" action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory') ?>" method="post" onSubmit="return validateContactForm()">
						<p>
							<?php echo JText::_('LNG_COMPANY_CONTACT_TEXT') ?>
						</p>
						<div class="review-repsonse">
						<fieldset>
		
							<div class="form-item">
								<label for="firstName"><?php echo JText::_('LNG_FIRST_NAME') ?></label>
								<div class="outer_input">
									<input type="text" name="firstName" id="firstName" size="50"><br>
									<span class="error_msg" id="frmFirstNameC_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
		
							<div class="form-item">
								<label for="lastName"><?php echo JText::_('LNG_LAST_NAME') ?></label>
								<div class="outer_input">
									<input type="text" name="lastName" id="lastName" size="50"><br>
									<span class="error_msg" id="frmLastNameC_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
		
							<div class="form-item">
								<label for="email"><?php echo JText::_('LNG_EMAIL_ADDRESS') ?></label>
								<div class="outer_input">
									<input type="text" name="email" id="email" size="50"><br>
									<span class="error_msg" id="frmEmailC_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>

							<div class="form-item">
								<label for="description" ><?php echo JText::_('LNG_CONTACT_TEXT')?>:</label>
								<div class="outer_input">
									<textarea rows="5" name="description" id="description" cols="50" ></textarea><br>
									<span class="error_msg" id="frmDescriptionC_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
					
							<div class="clearfix clear-left">
								<div class="button-row ">
									<button type="button" class="ui-dir-button" onclick="contactCompany()">
											<span class="ui-button-text"><?php echo JText::_("LNG_CONTACT_COMPANY")?></span>
									</button>
									<button type="button" class="ui-dir-button ui-dir-button-grey" onclick="jQuery.unblockUI()">
											<span class="ui-button-text"><?php echo JText::_("LNG_CANCEL")?></span>
									</button>
								</div>
							</div>
							
							<?php if($this->appSettings->captcha){?>
								<div class="form-item">
									<?php 
									$namespace="jbusinessdirectory.contact";
									$class=" required";
									if (($captcha = JCaptcha::getInstance("recaptcha", array('namespace' => $namespace))) )
									{
										$captcha->display("captcha", "captcha-div", $class);
									}
									
									?>
									<div id="captcha-div"></div>
								</div>
							<?php } ?>
						</fieldset>
						</div>
						
						<?php echo JHTML::_( 'form.token' ); ?>
						<input type='hidden' name='task' value='companies.contactCompany'/>
						<input type='hidden' name='userId' value=''/>
						<input type="hidden" id="companyId" name="companyId" value="" />
					</form>
				</div>
		</div>
	</div>
</div>	

<div id="company-quote" style="display:none">
	<div id="dialog-container">
		<div class="titleBar">
			<span class="dialogTitle" id="dialogTitle"></span>
			<span  title="Cancel"  class="dialogCloseButton" onClick="jQuery.unblockUI();">
				<span title="Cancel" class="closeText">x</span>
			</span>
		</div>
		
		<div class="dialogContent">
			<h3 class="title"><?php echo JText::_('LNG_QUOTE_COMPANY') ?></h3>
		  		<div class="dialogContentBody" id="dialogContentBody">
				
					<form id="contactCompanyFrm" name="contactCompanyFrm" action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory') ?>" method="post" onSubmit="return validateContactForm()">
						<p>
							<?php echo JText::_('LNG_COMPANY_QUTE_TEXT') ?>
						</p>
						<div class="review-repsonse">
						<fieldset>
		
							<div class="form-item">
								<label for="firstName"><?php echo JText::_('LNG_FIRST_NAME') ?></label>
								<div class="outer_input">
									<input type="text" name="firstName" id="firstName" size="50"><br>
									<span class="error_msg" id="frmFirstNameC_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
		
							<div class="form-item">
								<label for="lastName"><?php echo JText::_('LNG_LAST_NAME') ?></label>
								<div class="outer_input">
									<input type="text" name="lastName" id="lastName" size="50"><br>
									<span class="error_msg" id="frmLastNameC_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
		
							<div class="form-item">
								<label for="email"><?php echo JText::_('LNG_EMAIL_ADDRESS') ?></label>
								<div class="outer_input">
									<input type="text" name="email" id="email" size="50"><br>
									<span class="error_msg" id="frmEmailC_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>

							<div class="form-item">
								<label for="email"><?php echo JText::_('LNG_CATEGORY') ?></label>
								<div class="outer_input">
									<select name="category" id="category">
										<option value="0"><?php echo JText::_("LNG_ALL_CATEGORIES") ?></option>
										<?php foreach($this->maincategories as $category){?>
											<option value="<?php echo $category->name?>"><?php echo $category->name ?></option>
											<?php foreach($this->subcategories as $subCat){?>
												<?php if($subCat->parentId == $category->id){?>
													<option value="<?php echo $subCat->name?>">-- <?php echo $subCat->name?></option>
												<?php } ?>
											<?php }?>
										<?php }?>
									</select>
								</div>
							</div>
							
							<div class="form-item">
								<label for="description" ><?php echo JText::_('LNG_CONTACT_TEXT')?>:</label>
								<div class="outer_input">
									<textarea rows="5" name="description" id="description" cols="50" ></textarea><br>
									<span class="error_msg" id="frmDescriptionC_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
					
							<div class="clearfix clear-left">
								<div class="button-row ">
									<button type="button" class="ui-dir-button" onclick="requestQuoteCompany()">
											<span class="ui-button-text"><?php echo JText::_("LNG_REQUEST_QUOTE")?></span>
									</button>
									<button type="button" class="ui-dir-button ui-dir-button-grey" onclick="jQuery.unblockUI()">
											<span class="ui-button-text"><?php echo JText::_("LNG_CANCEL")?></span>
									</button>
								</div>
							</div>
							
							<?php if($this->appSettings->captcha){?>
								<div class="form-item">
									<?php 
									$namespace="jbusinessdirectory.contact";
									$class=" required";
									if (($captcha = JCaptcha::getInstance("recaptcha", array('namespace' => $namespace))) )
									{
										$captcha->display("captcha", "captcha-div", $class);
									}
									
									?>
									<div id="captcha-div"></div>
								</div>
							<?php } ?>
						</fieldset>
						</div>
						
						<?php echo JHTML::_( 'form.token' ); ?>
						<input type='hidden' name='task' value='companies.contactCompany'/>
						<input type='hidden' name='userId' value=''/>
						<input type="hidden" id="companyId" name="companyId" value="" />
					</form>
				</div>
		</div>
	</div>
</div>	
<script>
function showQuoteCompany(companyId){
	jQuery("#company-quote #companyId").val(companyId);
	jQuery.blockUI({ message: jQuery('#company-quote'), css: {width: '500px',top: '5%', position: 'absolute'} });

}	

function showContactCompany(companyId){
	jQuery("#company-contact #companyId").val(companyId);
	jQuery.blockUI({ message: jQuery('#company-contact'), css: {width: '500px',top: '5%', position: 'absolute'} });

}	

function requestQuoteCompany(){
	var baseUrl = "<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&task=companies.requestQuoteCompanyAjax', false, -1); ?>";

	var postData="";
	postData +="&firstName="+jQuery("#company-quote #firstName").val();
	postData +="&lastName="+jQuery("#company-quote #lastName").val();
	postData +="&email="+jQuery("#company-quote #email").val();
	postData +="&description="+jQuery("#company-quote #description").val();
	postData +="&companyId="+jQuery("#company-quote #companyId").val();
	postData +="&category="+jQuery("#company-quote #category").val();
	postData +="&recaptcha_response_field="+jQuery("#company-quote #recaptcha_response_field").val();
	
	jQuery.post(baseUrl, postData, processContactCompanyResult);
}

function contactCompany(){
	var baseUrl = "<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&task=companies.contactCompanyAjax', false, -1); ?>";

	var postData="";
	postData +="&firstName="+jQuery("#company-contact #firstName").val();
	postData +="&lastName="+jQuery("#company-contact #lastName").val();
	postData +="&email="+jQuery("#company-contact #email").val();
	postData +="&description="+jQuery("#company-contact #description").val();
	postData +="&companyId="+jQuery("#company-contact #companyId").val();
	postData +="&recaptcha_response_field="+jQuery("#recaptcha_response_field").val();
	
	jQuery.post(baseUrl, postData, processContactCompanyResult);
}


function processContactCompanyResult(responce){
	var xml = responce;
	jQuery(xml).find('answer').each(function()
	{
		if( jQuery(this).attr('error') == '1' ){
			 jQuery.blockUI({ 
				 	message: '<h3><?php echo JText::_("COM_JBUSINESS_ERROR")?></h3>'
		        }); 
		     setTimeout(jQuery.unblockUI, 2000); 
		}else{
			 jQuery.blockUI({ 
				 	message: '<h3><?php echo JText::_("COM_JBUSINESS_DIRECTORY_COMPANY_CONTACTED")?></h3>'
		        }); 
		     setTimeout(jQuery.unblockUI, 2000); 
		}
	});
}

</script>