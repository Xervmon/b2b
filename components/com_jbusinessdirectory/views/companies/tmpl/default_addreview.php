<?php /*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

$user = JFactory::getUser();

$app = JFactory::getApplication();
$data = $app->getUserState("com_jbusinessdirectory.add.review.data");
?>
<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=companies'); ?>" method="post" name="addReview" id="addReview">
	<h2>
	<span class="heading-green">
	<?php echo JText::_('LNG_WRITE_A_REVIEW') ?>
	</span>
	
	</h2>
	
	<div class="add-review">
	<fieldset>
		
		<div class="user-rating clearfix">
			<label for="user_rating"><?php echo JText::_('LNG_REVIEW_RATING_TEXT') ?></label><div id="user-rating"></div>
			<input type="hidden" name="rating" id="rating" value="<?php echo isset($this->rating->rating)?$this->rating->rating:'0' ?>">
		</div>
		<div class="form-item">
			<label for="subject"><?php echo JText::_('LNG_NAME') ?></label>
			<div class="outer_input">
				<input type="text" name="name" id="name" size="50" value="<?php echo $data["name"]?>"><br>
				<span class="error_msg" id="frmName_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
			</div>
		</div>

		<div class="form-item">
			<label for="email"><?php echo JText::_('LNG_EMAIL') ?></label>
			<div class="outer_input">
				<input type="text" name="email" id="email" size="50" value="<?php echo $data["email"]?>"><br>
				<span class="error_msg" id="frmEmail_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
			</div>
		</div>

		<div class="form-item">
			<label for="subject"><?php echo JText::_('LNG_NAME_YOUR_REVIEW') ?></label>
			<div class="outer_input">
				<input type="text" name="subject" id="subject" size="50" value="<?php echo $data["subject"]?>"><br>
				<span class="error_msg" id="frmSubject_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
			</div>
		</div>
		<div class="form-item">
			<label for="rating_body" ><?php echo JText::_('LNG_REVIEW_DESCRIPTION_TXT')?>:</label>
			<div class="outer_input">
				<textarea rows="10" name="description" id="description" escape="false" cols="40" ><?php echo $data["description"]?></textarea><br>
				<span class="error_msg" id="frmDescription_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
			</div>
		</div>
		<?php if($this->appSettings->captcha){?>
			<div class="form-item">
				<?php 
				$namespace="jbusinessdirectory.addreview";
				$class=" required";
				if (($captcha = JCaptcha::getInstance("recaptcha", array('namespace' => $namespace))) )
				{
					$captcha->display("captcha", "captcha-div", $class);
				}
				
				?>
				<div id="captcha-div"></div>
			</div>
		<?php } ?>
		<div class="clearfix clear-left">
		
			<div class="button-row ">
				<button type="button" class="ui-dir-button" onclick="saveForm()">
						<span class="ui-button-text"><?php echo JText::_("LNG_SAVE_REVIEW")?></span>
				</button>
				<button type="button" class="ui-dir-button ui-dir-button-grey" onclick="cancelSubmitReview()">
						<span class="ui-button-text"><?php echo JText::_("LNG_CANCEL_REVIEW")?></span>
				</button>
			</div>
		</div>	
	</fieldset>
	</div>
	
	 <input type="hidden" name="task"  id="task" value="companies.saveReview" /> 
	 <input type="hidden" name="tabId" id="tabId" value="<?php echo $this->tabId?>" /> 
	 <input type="hidden" name="userId" value="<?php $user = JFactory::getUser(); echo $user->id;?> " /> 
	 <input type="hidden" name="companyId" value="<?php echo $this->company->id?>" />
	 <input type="hidden" name="ratingId" value="<?php echo isset($this->rating->id)?$this->rating->id:0 ?>" />
</form>
<script>
jQuery(document).ready(function(){
	
	jQuery('#user-rating').raty({
		  half:       true,
		  precision:  false,
		  size:       24,
		  starHalf:   'star-half.png',
		  starOff:    'star-off.png',
		  starOn:     'star-on.png',
		  click:	function(score, evt) {
						jQuery("#rating").val(score);
						updateCompanyRate('<?php echo $this->company->id ?>',score);
					},
		  start:	  <?php echo isset($this->rating->rating)?$this->rating->rating:'0' ?>,	
		  path:		  '<?php echo COMPONENT_IMAGE_PATH?>'	
		});
});  

function saveForm(){
	var form = document.addReview;
	var isError = false;
	if( !validateField( form.elements['subject'], 'string', false, null) ){
		jQuery("#frmSubject_error_msg").show();
		isError = true;
	}

	if( !validateField( form.elements['email'], 'email', false, null) ){
		jQuery("#frmEmail_error_msg").show();
		isError = true;
	}
		
	if( !validateField( form.elements['name'], 'string', false, null) ){
		jQuery("#frmName_error_msg").show();
		isError = true;
	}
	if( !validateField( form.elements['description'], 'string', false, null) ){
		jQuery("#frmDescription_error_msg").show();
		isError = true
	}

	if(isError)
		return;
	 
	form.submit();
}

function cancelSubmitReview(){
	var form = document.addReview;
	jQuery("#task").val('cancelReview');
	form.submit();
}

</script>