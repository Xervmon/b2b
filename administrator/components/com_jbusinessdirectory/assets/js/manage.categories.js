
function showManageCategory(){
	resetFacilities();
	jQuery('#frmFacilitiesFormSubmitWait').hide();
	jQuery.blockUI({ message: jQuery('#manageCategoryFrm'), css: {top: '10%', width: '600px'} }); 
}

function resetCategoryForm(){
	jQuery("#frmCategoryId").val(0);
	jQuery("#frmParentCategoryId").val(0);
	jQuery("#frmCategoryName").val('');
	jQuery("#frmCategoryDescription").val('');
	jQuery("#frmCategoryImageLocation").val('');
	jQuery("#categoryImg").attr('src','');
}

function addNewCategory(parentId){
	resetCategoryForm();
	jQuery("#frmParentCategoryId").val(parentId);
	jQuery.blockUI({ message: jQuery('#manageCategoryFrm'), css: {top: '10%', width: '600px'} }); 
}

function stopClickPropagation(evt){
	var event=evt||window.event;

    if (event.cancelBubble)
    	event.cancelBubble = true;
    else
    	event.stopPropagation();
}


function changeCategoryState(categoryId){
	var postParameters='';
	postParameters +="&categoryId=" + categoryId;
	var postData='&task=managecategories.changeCategoryState'+postParameters;
	//alert(baseUrl + postData);
	jQuery.post(baseUrl, postData, processCategoryStateResult);
}

function processCategoryStateResult(responce){
	var xml = responce;
	//jQuery('#frmFacilitiesFormSubmitWait').hide();
	jQuery("<div>"+xml+"</div>").find('answer').each(function()
	{
		jQuery("#image-"+jQuery(this).attr('id')).attr("src",imageRepo+"/assets/img/"+(jQuery(this).attr('state')==0? "unchecked.gif" : "checked.gif"));
	});
	
}

function editCategory(categoryId){
	resetCategoryForm();
	var postParameters='';
	postParameters +="&categoryId=" + categoryId;
	var postData='&task=managecategories.getCategoryById'+postParameters;
	//alert(baseUrl + postData);
	jQuery.post(baseUrl, postData, processCategoryResult);
}



function processCategoryResult(responce){
	var xml = responce;
	//alert(xml);
	//jQuery('#frmFacilitiesFormSubmitWait').hide();
	jQuery(xml).find('answer').each(function()
	{
		jQuery("#frmCategoryId").val(jQuery(this).attr('id'));
		jQuery("#frmParentCategoryId").val(jQuery(this).attr('parentId'));
		jQuery("#frmCategoryName").val(jQuery(this).attr('name'));
		jQuery("#alias").val(jQuery(this).attr('alias'));
		jQuery("#frmCategoryDescription").val(jQuery(this).attr('description'));
		jQuery("#frmCategoryImageLocation").val(jQuery(this).attr('imagePath'));
		jQuery("#frmCategoryMarkerLocation").val(jQuery(this).attr('markerPath'));
		jQuery("#categoryImg").attr('src',imageBaseUrl+jQuery(this).attr('imagePath'));
		jQuery("#markerImg").attr('src',imageBaseUrl+jQuery(this).attr('markerPath'));
	});
	jQuery.blockUI({ message: jQuery('#manageCategoryFrm'), css: {width: '800px', cursor:"normal",top: '10%', left: (jQuery(window).width() - 800) /2 + 'px'}}); 
}

function saveCategory(){
	var error_flag=false;
	var postParameters='';
	
	if(!jQuery("#frmCategoryName").val()){
		jQuery("#frmCategoryName_error_msg").html('This is a required field.');
		jQuery("#frmCategoryName_error_msg").show();
		error_flag=true;
	}else{

		jQuery("#frmCategoryName_error_msg").html('');
		jQuery("#frmCategoryName_error_msg").hide();
	}
		
	postParameters +="&id="+jQuery("#frmCategoryId").val();
	postParameters +="&parentId="+jQuery("#frmParentCategoryId").val();
	postParameters +="&name="+urlencode(jQuery("#frmCategoryName").val()); 
	postParameters +="&alias="+urlencode(jQuery("#alias").val()); 
	postParameters +="&description="+urlencode(jQuery("#frmCategoryDescription").val()); 
	postParameters +="&imageLocation="+jQuery("#frmCategoryImageLocation").val(); 
	postParameters +="&markerLocation="+jQuery("#frmCategoryMarkerLocation").val(); 
	
	if(error_flag){
		return false;
	}
	else{
		var postData='&task=managecategories.saveCategory'+postParameters;
		//alert(baseUrl + postData);
		jQuery.post(baseUrl, postData, processSaveCategoryResult);
		jQuery('#frmFacilitiesFormSubmitWait').show();
		
	}
}		

function processSaveCategoryResult(responce){
	var xml = responce;
	jQuery('#frmFacilitiesFormSubmitWait').hide();
	jQuery(xml).find('answer').each(function()
	{
		if( jQuery(this).attr('error') == '1' )
		{
			jQuery('#frm_error_msg_facility').className='text_error';
			jQuery('#frm_error_msg_facility').html(jQuery(this).attr('errorMessage'));
			jQuery('#frm_error_msg_facility').show();

		}
		else if( jQuery(this).attr('error') == '0' )
		{
			jQuery.unblockUI();
			jQuery("#categories-level-"+jQuery(this).attr('category-level')).html(jQuery(this).attr('content_categories'));
		}
	});
}

function deleteCategory(categoryId){
	
	if(!confirm("Are you sure you want to delete the category?")){
		return;
	}
	
	var postParameters='';
	postParameters +="&categoryId=" + categoryId;
	var postData='&task=managecategories.deleteCategory'+postParameters;
	jQuery.post(baseUrl, postData, processDeleteCategoryResult);
}

function processDeleteCategoryResult(responce){
	var xml = responce;
	jQuery(xml).find('answer').each(function()
	{
		
		jQuery("#categories-level-"+jQuery(this).attr('category-level')).html(jQuery(this).attr('content_categories'));
	
	});
}


function displaySubcategories(categoryId, level, maxLevel){
	//invalidate subcategories level
	
	for(var i=level+1;i<=maxLevel;i++){
		jQuery("#categories-level-"+i).html('');
	}
	jQuery("#categories-level-"+(level+1)).html("<div style='width:20px;margin: 0 auto;'><img align='center' src='"+imageRepo+"/assets/img/loading.gif'  /></div>");
	var postParameters='';
	
	//categoryId = jQuery("#"+categoryId).val(); 
	postParameters +="&categoryId="+categoryId;
	//alert(postParameters);

	var postData='&option=com_jbusinessdirectory&task=managecategories.displaySubcategories'+postParameters;
	//alert(baseUrl + postData);
	jQuery.post(baseUrl, postData, processDisplaySubcategoriesResponse);
	//jQuery('#frmFacilitiesFormSubmitWait').show();
}

function processDisplaySubcategoriesResponse(responce){
	var xml = responce;
	//alert(xml);
	//jQuery('#frmFacilitiesFormSubmitWait').hide();
	jQuery(xml).find('answer').each(function()
	{
		if( jQuery(this).attr('error') == '1' )
		{
			jQuery('#frm_error_msg_facility').className='text_error';
			jQuery('#frm_error_msg_facility').html(jQuery(this).attr('errorMessage'));
			jQuery('#frm_error_msg_facility').show();

		}
		else if( jQuery(this).attr('error') == '0' )
		{
			jQuery("#categories-level-"+jQuery(this).attr('category-level')).html(jQuery(this).attr('content_categories'));
		}
	});
}

function urlencode (str) {
     str = (str + '').toString();

    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
    replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
}

function removeImage(){
	jQuery("#frmCategoryImageLocation").val("");
	jQuery("#categoryImg").attr("src","");
}

function removeMarker(){
	jQuery("#frmCategoryMarkerLocation").val("");
	jQuery("#markerImg").attr("src","");
	
}

