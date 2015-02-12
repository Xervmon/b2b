//---start banner ----------
function showManageBanners(){
	resetBanners();
	jQuery(".banner-types-select").children().each(function(index) {
		if(jQuery(this).val())
			addNewBanner(jQuery(this).val(), jQuery(this).text());
	});
	jQuery('#frmBannersFormSubmitWait').hide();
	jQuery.blockUI({ message: jQuery('#showBannersNewFrm'), css: {width: '400px'} }); 
}

function resetBanners(){
	jQuery("#banner-container").empty();
}

function addNewBanner(id, value){
	
	var count = jQuery("#banner-container").children().length+1;
	var newRow 	= document.createElement('div');
	newRow.setAttribute('class',		'form_row');
	newRow.setAttribute('id',		'bannerRow'+count);
	
	var outerDiv = document.createElement('div');
	outerDiv.setAttribute('class',		'outer_input');
	
	
	var newInput = document.createElement('input');
	newInput.setAttribute('type',		'text');
	newInput.setAttribute('name',		'bannerNames[]');
	newInput.setAttribute('id',			id);
	newInput.setAttribute('size',		'32');
	newInput.setAttribute('maxlength',	'128');
	newInput.setAttribute('value', value);
	
	var newSpan 		= document.createElement('span');
	newSpan.setAttribute('id',		'banner_error_msg'+count);
	newSpan.setAttribute('class',		'error_msg errormsg');
	newSpan.setAttribute('style',		'display:none');
	
	var img_del		 	= document.createElement('img');
	img_del.setAttribute('src', deleteImagePath);
	img_del.setAttribute('alt', 'Delete option');
	img_del.setAttribute('height', '12px');
	img_del.setAttribute('width', '12px');
	img_del.setAttribute('align', 'left');
	img_del.setAttribute('onclick', 'removeRow("bannerRow'+count+'")');
	img_del.setAttribute('style', "cursor: pointer; margin:3px;");
	
	outerDiv.appendChild(newInput);
	outerDiv.appendChild(newSpan);
	newRow.appendChild(outerDiv);
	newRow.appendChild(img_del);
	
	var bannerContainer =jQuery("#banner-container");
	bannerContainer.append(newRow);
}


function saveBanners(formname){
	var error_flag=false;
	var postParameters='';
	jQuery("#banner-container :input").each(function(index) {
		$id = '#banner_error_msg'+(index+1);
		if(!jQuery(this).attr('value')){
			jQuery($id).html('This is a required field.');
			jQuery($id).show();
			error_flag=true;
		}else{

			jQuery($id).html('');
			jQuery($id).hide();
		}
		postParameters +="&"+jQuery(this).attr('name')+'='+jQuery(this).attr('value')+"&bannerIds[]="+jQuery(this).attr('id'); 
	});
	//alert(postParameters);
	
	if(error_flag){
		return false;
	}
	else{
		var postData='&controller=managebanners&task=updateBannerTypes'+postParameters;
		//alert(baseUrl + postData);
		jQuery.post(baseUrl, postData, processSaveBannersResult);
		jQuery('#frmBannersFormSubmitWait').show();
		
	}
}		

function processSaveBannersResult(responce){
	
	var xml = responce;
	jQuery('#frmBannersFormSubmitWait').hide();
	jQuery(xml).find('answer').each(function()
	{
		if( jQuery(this).attr('error') == '1' )
		{
			jQuery('#frm_error_msg_banner').className='text_error';
			jQuery('#frm_error_msg_banner').html(jQuery(this).attr('errorMessage'));
			jQuery('#frm_error_msg_banner').show();

		}
		else if( jQuery(this).attr('error') == '0' )
		{
			jQuery.unblockUI();
			var success_msg= jQuery(this).attr('message');
			popUpMessage(jQuery(this).attr('mesage'));
			jQuery("#banner-type-holder").html(jQuery(this).attr('content_records'));
			//setTimeout('addClientReloadWithID(\''+item+'\')',2000);
		}
	});
}


//-------end banner----------------------------