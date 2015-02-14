<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in


*/
if(defined('_JEXEC')===false) die();
if(!empty($content)):?>
<script type="text/javascript">
(function($){
// START : 	
// Scoping code for easy and non-conflicting access to $.
// Should be first line, write code below this line.
if (typeof(payplans.apps)=='undefined'){
		payplans.apps = {};
}

payplans.apps.tos = {
	click : function(url, title){
		 var call = { 'url': url, 'data': {'iframe': true }};
         xi.ui.dialog.create(call, '', 750, 450);
         xi.ui.dialog.title(title);
	}
};

$(document).ready(function(){
	$('.pp-tos-condition').closest('form').submit(function() {
	   var restrict =0;
       $('.pp-tos-condition').each(function(){
			if($(this).is(":checked") == false){
				restrict = 1;	
			}
       });	
       //if any of the condition restricted then return false
       if(restrict == 1){
    	   alert('<?php echo XiText::_('COM_PAYPLANS_JS_TERMS_CONDITIONS'); ?>');
		   return false;	
       }
	});
});

// ENDING :
// Scoping code for easy and non-conflicting access to $.
// Should be last line, write code above this line.
})(payplans.jQuery);
</script>

<div>
		<?php foreach($content as $contents):?>
		<div>
			<input type="checkbox" name="tos" value="tos" class="pp-tos-condition required"/>
			<?php echo $contents;?>
		</div>	
		<?php endforeach;?>
</div>
<?php endif;?>
<?php 

