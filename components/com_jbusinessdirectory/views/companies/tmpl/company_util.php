<div id="company-claim" style="display:none">
	<div id="dialog-container">
		<div class="titleBar">
			<span class="dialogTitle" id="dialogTitle"></span>
			<span  title="Cancel"  class="dialogCloseButton" onClick="jQuery.unblockUI();">
				<span title="Cancel" class="closeText">x</span>
			</span>
		</div>
		<div class="dialogContent">
			<h3 class="title"><?php echo JText::_('LNG_CLAIM_COMPANY') ?></h3>
		  		<div class="dialogContentBody" id="dialogContentBody">
				
					<form id="claimCompanyFrm" name ="claimCompanyFrm" action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory') ?>" method="post" onSubmit="return validateClaimForm()">
						<p>
							<?php echo JText::_('LNG_COMPANY_CLAIM_TEXT') ?>
						</p>
						<div class="review-repsonse">
						<fieldset>
		
							<div class="form-item">
								<label for="firstName"><?php echo JText::_('LNG_FIRST_NAME') ?></label>
								<div class="outer_input">
									<input type="text" name="firstName" id="firstName" size="50"><br>
									<span class="error_msg" id="frmFirstName_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
		
							<div class="form-item">
								<label for="lastName"><?php echo JText::_('LNG_LAST_NAME') ?></label>
								<div class="outer_input">
									<input type="text" name="lastName" id="lastName" size="50"><br>
									<span class="error_msg" id="frmLastName_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
		
		
							<div class="form-item">
								<label for="email"><?php echo JText::_('LNG_FUNCTION') ?></label>
								<div class="outer_input">
									<input type="text" name="function" id="function" size="50"><br>
									<span class="error_msg" id="frmFunction_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
		
							<div class="form-item">
								<label for="email"><?php echo JText::_('LNG_PHONE') ?></label>
								<div class="outer_input">
									<input type="text" name="phone" id="phone" size="50"><br>
									<span class="error_msg" id="frmPhone_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>
		
							<div class="form-item">
								<label for="email"><?php echo JText::_('LNG_EMAIL_ADDRESS') ?></label>
								<div class="outer_input">
									<input type="text" name="email" id="email" size="50"><br>
									<span class="error_msg" id="frmEmail_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
								</div>
							</div>

							<div class="form-item">
								<input type="checkbox"  name="claim-company-agreament" id="claim-company-agreament"> <?php echo JText::_('LNG_COMPANY_CLAIM_DECLARATION')?>
							</div>

							<div class="form-item">
								<input type="checkbox"  name="claim-terms-conditions" id="claim-terms-conditions"> <?php echo JText::_('LNG_TERMS_AGREAMENT')?>
							</div>
		
							<div class="clearfix clear-left">
								<div class="button-row ">
									<button type="submit" class="ui-dir-button">
											<span class="ui-button-text"><?php echo JText::_("LNG_CLAIM_COMPANY")?></span>
									</button>
									<button type="button" class="ui-dir-button ui-dir-button-grey" onclick="jQuery.unblockUI()">
											<span class="ui-button-text"><?php echo JText::_("LNG_CANCEL")?></span>
									</button>
								</div>
							</div>
						</fieldset>
						</div>
						
						<input type='hidden' name='task' value='companies.claimCompany'/>
						<input type='hidden' name='userId' value='<?php echo $user->id?>'/>
						<input type='hidden' name='controller' value='companies' />
						<input type='hidden' name='view' value='companies' />
						<input type="hidden" name="companyId" value="<?php echo $this->company->id?>" />
					</form>
				</div>
		</div>
	</div>
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
									<button type="submit" class="ui-dir-button">
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
						<input type='hidden' name='userId' value='<?php echo $user->id?>'/>
						<input type="hidden" name="companyId" value="<?php echo $this->company->id?>" />
					</form>
				</div>
		</div>
	</div>
</div>	
	

<script>
jQuery(document).ready(function(){
	var averageRaty = jQuery('#rating-average').raty({
		  half:       true,
		  precision:  false,
		  size:       24,
		  starHalf:   'star-half.png',
		  starOff:    'star-off.png',
		  starOn:     'star-on.png',
		  readOnly:   true,
		  start:	  <?php echo $this->company->averageRating ?>, 	
		  path:		  '<?php echo COMPONENT_IMAGE_PATH?>'	
		});
	
	var userRating = jQuery('#rating-user').raty({
		  half:       true,
		  precision:  false,
		  size:       24,
		  starHalf:   'star-half.png',
		  starOff:    'star-off.png',
		  starOn:     'star-on.png',
		  start:	  <?php echo isset($this->rating->rating)?$this->rating->rating:'0' ?>,	
		  path:		  '<?php echo COMPONENT_IMAGE_PATH?>',	
		  click: function(score, evt) {
			  	  updateCompanyRate('<?php echo $this->company->id ?>',score);
		  }
		});

	jQuery('.rating-review').raty({
		  half:       true,
		  size:       24,
		  starHalf:   'star-half.png',
		  starOff:    'star-off.png',
		  starOn:     'star-on.png',
		  start:   	  function() { return jQuery(this).attr('title')},
		  path:		  '<?php echo COMPONENT_IMAGE_PATH?>',
		  readOnly:   true
		});
});  

function showTab(tabId){
	jQuery("#tabId").val(tabId);
	jQuery("#tabsForm").submit();
}

function showClaimDialog(){
	jQuery.blockUI({ message: jQuery('#company-claim'), css: {top: '5%', position: 'absolute'} });
	jQuery('.blockUI.blockMsg').center();
	jQuery('.blockOverlay').attr('title','Click to unblock').click(jQuery.unblockUI); 
}

function claimCompany(){
	<?php if($user->id==0){	?>
  		jQuery("#claim-login-awarness").show();
  	 <?php //}else if($this->appSettings->direct_processing){  ?>
  	//	window.location = "<?php //echo JRoute::_("index.php?option=com_jbusinessdirectory&view=packages&claimCompanyId=".$this->company->id)?>";
   <?php }else{  ?>
	  	jQuery(".error_msg").each(function(){
			jQuery(this).hide();
		});
  		showClaimDialog();
  // updateCompanyOwner(<?php echo $this->company->id ?>, <?php echo $user->id ?>);
 	<?php } ?>
}

function showContactCompany(){
	jQuery.blockUI({ message: jQuery('#company-contact'), css: {width: 'auto',top: '10%', position: 'absolute'} });
	jQuery('.blockUI.blockMsg').center();
	jQuery('.blockOverlay').attr('title','Click to unblock').click(jQuery.unblockUI); 
}


function validateClaimForm(){

	var form = document.claimCompanyFrm;
	var isError = false;
	
	jQuery(".error_msg").each(function(){
		jQuery(this).hide();
	});
	
	if( !validateField( form.elements['firstName'], 'string', false, null ) ){
		jQuery("#frmFirstName_error_msg").show();
		if(!isError)
			jQuery("#firstName").focus();
		isError = true;
	}

	if( !validateField( form.elements['lastName'], 'string', false, null ) ){
		jQuery("#frmLastName_error_msg").show();
		if(!isError)
			jQuery("#lastName").focus();
		isError = true;
	}

	if( !validateField( form.elements['function'], 'string', false, null ) ){
		jQuery("#frmFunction_error_msg").show();
		if(!isError)
			jQuery("#function").focus();
		isError = true;
	}
	
	if( !validateField( form.elements['phone'], 'string', false, null ) ){
		jQuery("#frmPhone_error_msg").show();
		if(!isError)
			jQuery("#phone").focus();
		isError = true;
	}
	if( !validateField( form.elements['email'], 'email', false, null ) ){
		jQuery("#frmEmail_error_msg").show();
		if(!isError)
			jQuery("#email").focus();
		isError = true;
	}
	
	if(!isError && jQuery("#claim-company-agreament").is(':checked')==false){
		alert("<?php echo JText::_("LNG_CLAIM_DECLARATION_ERROR")?>");
		isError = true;
	} else if(!isError && jQuery("#claim-terms-conditions").is(':checked')==false){
		alert("<?php echo JText::_("LNG_TERMS_CONDITIONS_ERROR")?>");
		isError = true;
	}
	
	return !isError;
}

function validateContactForm(){
	//console.debug("validate");
	var form = document.contactCompanyFrm;
	var isError = false;
	
	jQuery(".error_msg").each(function(){
		jQuery(this).hide();
	});
	
	if( !validateField( form.elements['firstName'], 'string', false, null ) ){
		//console.debug("firstName");
		jQuery("#frmFirstNameC_error_msg").show();
		if(!isError)
			jQuery("#firstName").focus();
		isError = true;
	}

	if( !validateField( form.elements['lastName'], 'string', false, null ) ){
		jQuery("#frmLastNameC_error_msg").show();
		if(!isError)
			jQuery("#lastName").focus();
		isError = true;
	}

	if( !validateField( form.elements['email'], 'email', false, null ) ){
		jQuery("#frmEmailC_error_msg").show();
		if(!isError)
			jQuery("#email").focus();
		isError = true;
	}
	
	if( !validateField( form.elements['description'], 'string', false, null ) ){
		jQuery("#frmDescriptionC_error_msg").show();
		if(!isError)
			jQuery("#description").focus();
		isError = true;
	}
	
	//console.debug(isError);
	return !isError;
}

function updateCompanyOwner(companyId, userId){

        jQuery.blockUI({ 
        	message: '<span class="loading-message"> Please wait...</span>',
            css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .6, 
            color: '#fff' 
        } }); 
 
	var form = document.reportAbuse;
	var postParameters='';
	postParameters +="&companyId=" + companyId;
	postParameters +="&userId=" + userId;
	var postData='&controller=companies&task=companies.updateCompanyOwner'+postParameters;
	jQuery.post(baseUrl, postData, processUpdateCompanyOwner);
}

function processUpdateCompanyOwner(responce){
	var xml = responce;
	jQuery(xml).find('answer').each(function()
	{
		var message ='';
		if(jQuery(this).attr('result')==true){
			message = "<?php echo JText::_('LNG_CLAIM_SUCCESSFULLY')?>"
			jQuery("#claim-container").hide();	
		}else{
			message = "<?php echo JText::_('LNG_ERROR_CLAIMING_COMPANY')?>"
			//alert('notsaved');
		}
		jQuery.blockUI({ 
        	message: '<span class="loading-message">'+message+'</span>',
			css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .6, 
            color: '#fff' 
        } }); 
		setTimeout(jQuery.unblockUI, 1500);
	});
}

</script>
