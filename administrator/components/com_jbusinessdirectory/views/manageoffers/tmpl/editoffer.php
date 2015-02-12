<?php
$appSetings = getApplicationSettings();
$user = JFactory::getUser();
?>

<?php  if($isProfile) { ?>
	<div class="buttons">
	
		<span class="button">
			<button href="javascript:void(0)" onClick="saveCompanyInformation()" value="<?php echo JText::_('LNG_SAVE'); ?>"><?php echo JText::_('LNG_SAVE'); ?></button>
		</span>

		<span class="button gray">
			<button href="javascript:void(0)" onClick="cancel()" value="<?php echo JText::_('LNG_CANCEL'); ?>"><?php echo JText::_('LNG_CANCEL'); ?></button>
		</span>
	</div>
	<div class="clear"></div>		
<?php  } ?>

<div class="category-form-container">	
	<form action="index.php" method="post" name="adminForm">
		<div class="clr mandatory oh">
			<p>This information is required</p>
		</div>
		<fieldset class="boxed">

			<h2> <?php echo JText::_('LNG_OFFER_DETAILS');?></h2>
			<p><?php echo JText::_('LNG_DISPLAY_INFO_TXT');?></p>
			<div class="form-box">
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="subject"><?php echo JText::_('LNG_SUBJECT')?> </label> 
					<input type="text"
						name="subject" id="subject" class="input_txt" value="<?php echo $this->item->subject ?>">
					<div class="clear"></div>
					<span class="error_msg" id="frmCompanySubject_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>

				<div class="detail_box">
					<div class="form-detail req"></div>
					<label for="description_id"><?php echo JText::_("LNG_OFFER")." ".JText::_('LNG_DESCRIPTION')?>  &nbsp;&nbsp;&nbsp;</label>
					<textarea name="description" id="description" class="input_txt"  cols="75" rows="10"  maxLength="<?php echo OFFER_DESCRIPTIION_MAX_LENGHT?>"
						 onkeyup="calculateLenght();"><?php echo $this->item->description ?></textarea>
					<div class="clear"></div>
					<span class="error_msg" id="frmDescription_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					<div class="description-counter">	
						<input type="hidden" name="descriptionMaxLenght" id="descriptionMaxLenght" value="<?php echo OFFER_DESCRIPTIION_MAX_LENGHT?>" />	
						<label for="decriptionCounter">(Max. <?php echo OFFER_DESCRIPTIION_MAX_LENGHT?> characters).</label>
						<?php JText::_('LNG_REMAINING')?><input type="text" value="0" id="decriptionCounter" name="decriptionCounter">			
					</div>
				</div>
				
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="price"><?php echo JText::_('LNG_PRICE')?> </label> 
					<input type="text"
						name="price" id="price" class="input_txt"
						value="<?php echo $this->item->price ?>">
					<div class="clear"></div>
					<span class="error_msg" id="frmPrice_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>

				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="specialPrice"><?php echo JText::_('LNG_SPECIAL_PRICE')?> </label> 
					<input type="text"
						name=specialPrice id="specialPrice" class="input_txt"
						value="<?php echo $this->item->specialPrice ?>">
					<div class="clear"></div>
					<span class="error_msg" id="frmspecialPrice_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>
				
				<div class="detail_box">
					<label for="startDate"><?php echo JText::_('LNG_START_DATE')?> </label> 
					<?php echo JHTML::_('calendar', $this->item->startDate==$appSetings->defaultDateValue?'': $this->item->startDate, 'startDate', 'startDate', $appSetings->calendarFormat, array('class'=>'inputbox', 'size'=>'10',  'maxlength'=>'10')); ?>
					<div class="clear"></div>
					<span class="error_msg" id="frmStartDate_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>
				
				
				<div class="detail_box">
					<label for="endDate"><?php echo JText::_('LNG_END_DATE')?> </label>
					</label><?php echo JHTML::_('calendar', $this->item->endDate==$appSetings->defaultDateValue?'': $this->item->endDate, 'endDate', 'endDate', $appSetings->calendarFormat, array('class'=>'inputbox', 'size'=>'10',  'maxlength'=>'10')); ?>
					<div class="clear"></div>
					<span class="error_msg" id="frmEndDate_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>
				
				<?php  if(!$isProfile) { ?>
				<div class="detail_box">
					<label for="companyId"><?php echo JText::_('LNG_COMPANY')?></label> 
					<input type="text"
						name="companyId" id="companyId" class="input_txt"
						value="<?php echo $this->item->companyId ?>">
					<div class="clear"></div>
					<span class="error_msg" id="frmCompany_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>
			<?php  } ?>
			</div>
			</fieldset>
			
			
			<fieldset class="boxed">
				<h2> <?php echo JText::_('LNG_COMPANY_PICTURES');?></h2>
				<p> <?php echo JText::_('LNG_OFFER_PICTURES_INFORMATION_TEXT');?>.</p>
				<input type='button' name='btn_removefile' id='btn_removefile' value='x' style='display:none'>
				<input type='hidden' name='crt_pos' id='crt_pos' value=''>
				<input type='hidden' name='crt_path' id='crt_path' value=''>
					<TABLE class='picture-table' align=left border=0>
						<TR>
							<TD align=left class="key"><?php echo JText::_('LNG_PICTURES');  ?>:</TD>
							<TD>
								<TABLE class="admintable" align=center  id='table_offer_pictures' name='table_offer_pictures' >
									<?php
									$pos = 0;
									
									foreach( $this->item->pictures as $picture )
									{
									?>
									<TR>
										<TD align=left>
											<textarea cols=50 rows=2 name='offer_picture_info[]' id='offer_picture_info'><?php echo $picture['offer_picture_info']?></textarea>
										</TD>
										<td align=center>
											<img class='img_picture_offer' src='<?php echo JURI::root() ."administrator/components/".getComponentName().$picture['offer_picture_path']?>'/>
											<BR>
											<?php echo basename($picture['offer_picture_path'])?>
											<input type='hidden' 
												value='<?php echo $picture['offer_picture_enable']?>' 
												name='offer_picture_enable[]' 
												id='offer_picture_enable'
											>
											<input type='hidden' 
												value='<?php echo $picture['offer_picture_path']?>' 
												name='offer_picture_path[]' 
												id='offer_picture_path'
											>
										</td>
										<td align=center>
											<img class='btn_picture_delete' 
												src='<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/del_options.gif"?>'
												onclick =  " 
															if(!confirm('<?php echo JText::_('LNG_CONFIRM_DELETE_PICTURE')?>')) 
																return; 
															
															var row 		= jQuery(this).parents('tr:first');
															var row_idx 	= row.prevAll().length;
														
															jQuery('#crt_pos').val(row_idx);
															jQuery('#crt_path').val('<?php echo $picture['offer_picture_path']?>');
															jQuery('#btn_removefile').click();
														"
					
											/>
										</td>
										<td align=center>
											<img class='btn_picture_status' 
												src='<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/".($picture['offer_picture_enable'] ? 'checked' : 'unchecked').".gif"?>'
												onclick =  " 
															var form 		= document.adminForm;
															var v_status  	= null;
															if( form.elements['offer_picture_enable[]'].length == null )
															{
																v_status  = form.elements['offer_picture_enable[]'];
															}
															else
															{
																v_status  = form.elements['offer_picture_enable[]'][<?php echo $pos ?>];
															}
														
															if( v_status.value == '1') 
															{
																jQuery(this).attr('src', '<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/unchecked.gif"?>');
																v_status.value ='0';
															}
															else
															{
																jQuery(this).attr('src', '<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/checked.gif"?>');
																v_status.value ='1';
															}
														"
					
											/>
										</td>
										<td>
											<span 
												class="span_up"
												onclick='var row = jQuery(this).parents("tr:first");  row.insertBefore(row.prev());'
											>
												<?php echo JText::_('LNG_STR_UP')?>
											</span>
											<span 
												class="span_down"
												onclick='var row = jQuery(this).parents("tr:first"); row.insertAfter(row.next());'
											>
												<?php echo JText::_('LNG_STR_DOWN')?>
											</span>
										</td>
										
										
									</TR>
									<?php
									$pos ++;
									}
									?>
								</TABLE>
							</TD>
						</TR>
						<TR>
							
							<TD colspan ="2">
								<?php echo JText::_('LNG_PLEASE_CHOOSE_A_FILE'); ?> <input name="uploadfile" id="uploadfile" size="50" type="file" />
								
							</TD>
						</TR>
					</TABLE>
			</fieldset>
			

		<?php  if($isProfile) { ?>
		<div class="buttons">
		
			<span class="button">
				<button href="javascript:void(0)" onClick="saveCompanyInformation()" value="<?php echo JText::_('LNG_SAVE'); ?>"><?php echo JText::_('LNG_SAVE'); ?></button>
			</span>

			<span class="button gray">
				<button href="javascript:void(0)" onClick="cancel()" value="<?php echo JText::_('LNG_CANCEL'); ?>"><?php echo JText::_('LNG_CANCEL'); ?></button>
			</span>

		
		</div>		
			<?php  } ?>
	<script  type="text/javascript">
		<?php
		if( getCurrentJoomlaVersion() < 1.6 )
		{
		?>
		function submitbutton(pressbutton) 
		<?php
		}
		else
		{
		?>
		Joomla.submitbutton = function(pressbutton) 
		<?php
		}
		?>
		{
			if(pressbutton == 'aprove'){
				jQuery("task").val("aprove");
				submitform(pressbutton);
			} else if(pressbutton == 'disaprove'){	
				jQuery("task").val("disaprove");
				submitform(pressbutton);
			}else if (pressbutton == 'save') 
			{
				if(validateCmpForm())
					return false;	
							
				submitform( pressbutton );
				return;
			} else {
				submitform(pressbutton);
			}
		}

		function saveCompanyInformation(){
			if(validateCmpForm())
				return false;
				
			jQuery("#task").val('save');
			var form = document.adminForm;
			form.submit();
		}
		
		function cancel(){
			jQuery("#task").val('cancel');
			var form = document.adminForm;
			form.submit();
		}
		
		function validateCmpForm(){
			
			var form = document.adminForm;
			var isError = false;

			jQuery(".error_msg").each(function(){
				jQuery(this).hide();
			});
			
			if( !validateField( form.elements['subject'], 'string', false, null ) ){
				jQuery("#frmCompanySubject_error_msg").show();
				if(!isError)
					jQuery("#subject").focus();
				isError = true;
			}
				
			if( !validateField( form.elements['description'], 'string', false, null ) ){
				jQuery("#frmDescription_error_msg").show();
				if(!isError)
					jQuery("#description").focus();
				isError = true;
			}

			if( !validateField( form.elements['price'], 'numeric', false, null ) ){
				jQuery("#frmPrice_error_msg").show();
				if(!isError)
					jQuery("#price").focus();
				isError = true;
			}
			if( !validateField( form.elements['specialPrice'], 'numeric', false, null ) ){
				jQuery("#frmspecialPrice_error_msg").show();
				if(!isError)
					jQuery("#specialPrice").focus();
				isError = true;
			}
			if( !validateField( form.elements['startDate'], 'date', false, null ) ){
				jQuery("#frmStartDate_error_msg").show();
				if(!isError)
					jQuery("#startDate").focus();
				isError = true;
			}
			if( !validateField( form.elements['endDate'], 'date', false, null ) ){
				jQuery("#frmEndDate_error_msg").show();
				if(!isError)
					jQuery("#endDate").focus();
				isError = true;
			}

			if(typeof isProfile === 'undefined')
				if( !validateField( form.elements['companyId'], 'numeric', false, null ) ){
					jQuery("#frmCompany_error_msg").show();
					if(!isError)
						jQuery("#companyId").focus();
					isError = true;
				}
			return isError;
			
		}
	</script>
	<input type="hidden" name="option" value="<?php echo getComponentName()?>" /> 
	<input type="hidden"name="task" id="task" value="" /> 
	<input type="hidden" name="offerId" value="<?php echo $this->item->id ?>" /> 
	<input type="hidden" id="controller" name="controller" value="<?php echo JRequest::getCmd('controller', 'J-BusinessDirectory')?>" />
	<input type="hidden" name="view" value="<?php echo JRequest::getCmd('controller', 'J-BusinessDirectory')?>" />
	
	<?php if($isProfile){ ?>
		<input type="hidden" name="companyId" id="companyId" value="<?php echo $this->item->companyId ?>"/>
	<?php }else{ ?>
		
	<?php }?>
	<?php echo JHTML::_( 'form.token' ); ?>
	 
</form>
</div>

<script>
	jQuery(document).ready(function(){
		jQuery('#uploadfile').change(function() {
			var fisRe 	= /^.+\.(jpg|bmp|gif|png)$/i;
			var path = jQuery('#uploadfile').val();
			if (path.search(fisRe) == -1)
			{   
				alert(' JPG, BMP, GIF, PNG only!');
				return false;
			}  
			<?php 
				$baseUrl = JURI::base();
				if(strpos ($baseUrl,'administrator') ===  false)
					$baseUrl = $baseUrl.'administrator/';
			?>
			
			jQuery(this).upload('<?php echo $baseUrl?>components/<?php echo getComponentName()?>/assets/upload.php?t=<?php echo strtotime('now')?>&picture_type=<?php echo PICTURE_TYPE_OFFER?>&_root_app=<?php echo urlencode(JPATH_COMPONENT_ADMINISTRATOR)?>&_target=<?php echo urlencode(OFFER_PICTURES_PATH.($this->item->id).'/')?>', function(responce) 
																								{
																									//alert(responce);
																									if( responce =='' )
																									{
																										alert("<?php echo JText::_('LNG_ERROR_ADDING_FILE')?>");
																										jQuery(this).val('');
																									}
																									else
																									{
																										var xml = responce;
																										// alert(responce);
																										jQuery(xml).find("picture").each(function()
																										{
																											if(jQuery(this).attr("error") == 0 )
																											{
																												addPicture(
																															"<?php echo OFFER_PICTURES_PATH.($this->item->id).'/'?>" + jQuery(this).attr("path"),
																															jQuery(this).attr("name")
																												);
																											}
																											else if( jQuery(this).attr("error") == 1 )
																												alert("<?php echo JText::_('LNG_FILE_ALLREADY_ADDED')?>");
																											else if( jQuery(this).attr("error") == 2 )
																												alert("<?php echo JText::_('LNG_ERROR_ADDING_FILE')?>");
																											else if( jQuery(this).attr("error") == 3 )
																												alert("<?php echo JText::_('LNG_ERROR_GD_LIBRARY')?>");
																											else if( jQuery(this).attr("error") == 4 )
																												alert("<?php echo JText::_('LNG_ERROR_RESIZING_FILE')?>");
																										});
																										
																										jQuery(this).val('');
																									}
																								}, 'html'
			);
        });
			jQuery('#btn_removefile').click(function() {
				//function delPicture( obj, path, pos )
				//{
					pos 	= jQuery('#crt_pos').val();
					path 	= jQuery('#crt_path').val();
					jQuery( this ).upload('<?php echo JURI::root()?>administrator/components/<?php echo getComponentName()?>/assets/remove.php?_root_app=<?php echo urlencode(JPATH_COMPONENT_ADMINISTRATOR)?>&_filename='+ path + '&_pos='+pos, function(responce) 
																										{
																											// alert(responce);
																											if( responce =='' )
																											{
																												alert("<?php echo JText::_('LNG_ERROR_REMOVING_FILE')?>");
																												jQuery(this).val('');
																											}
																											else
																											{
																												var xml = responce;
																												//alert(responce);
																												jQuery(xml).find("picture").each(function()
																												{
																													if(jQuery(this).attr("error") == 0 )
																													{
																														removePicture( jQuery(this).attr("pos") );
																													}
																													else if( jQuery(this).attr("error") == 2 )
																														alert("<?php echo JText::_('LNG_ERROR_REMOVING_FILE')?>");
																													else if( jQuery(this).attr("error") == 3 )
																														alert("<?php echo JText::_('LNG_FILE_DOESNT_EXIST')?>");
																												});
																												
																												jQuery('#crt_pos').val('');
																												jQuery('#crt_path').val('');
																											}
																										}, 'html'
					);
				
				});
			
		});



function addPicture(path, name)
{
	var tb = document.getElementById('table_offer_pictures');
	if( tb==null )
	{
		alert('Undefined table, contact administrator !');
	}
	
	var td1_new			= document.createElement('td');  
	td1_new.style.textAlign='left';
	var textarea_new 	= document.createElement('textarea');
	textarea_new.setAttribute("name","offer_picture_info[]");
	textarea_new.setAttribute("id","offer_picture_info");
	textarea_new.setAttribute("cols","50");
	textarea_new.setAttribute("rows","2");
	td1_new.appendChild(textarea_new);
	
	var td2_new			= document.createElement('td');  
	td2_new.style.textAlign='center';
	var img_new		 	= document.createElement('img');
	img_new.setAttribute('src', "<?php echo JURI::root() ."administrator/components/".getComponentName()?>" + path );
	img_new.setAttribute('class', 'img_picture_offer');
	td2_new.appendChild(img_new);
	var span_new		= document.createElement('span');
	span_new.innerHTML 	= "<BR>"+name;
	td2_new.appendChild(span_new);
	
	var input_new_1 		= document.createElement('input');
	input_new_1.setAttribute('type',		'hidden');
	input_new_1.setAttribute('name',		'offer_picture_enable[]');
	input_new_1.setAttribute('id',			'offer_picture_enable[]');
	input_new_1.setAttribute('value',		'1');
	td2_new.appendChild(input_new_1);
	
	var input_new_2		= document.createElement('input');
	input_new_2.setAttribute('type',		'hidden');
	input_new_2.setAttribute('name',		'offer_picture_path[]');
	input_new_2.setAttribute('id',			'offer_picture_path[]');
	input_new_2.setAttribute('value',		path);
	td2_new.appendChild(input_new_2);
	
	var td3_new			= document.createElement('td');  
	td3_new.style.textAlign='center';
	
	var img_del		 	= document.createElement('img');
	img_del.setAttribute('src', "<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/del_options.gif"?>");
	img_del.setAttribute('class', 'btn_picture_delete');
	img_del.setAttribute('id', 	tb.rows.length);
	img_del.setAttribute('name', 'del_img_' + tb.rows.length);
	img_del.onmouseover  	= function(){ this.style.cursor='hand';this.style.cursor='pointer' };
	img_del.onmouseout 		= function(){ this.style.cursor='default' };
	img_del.onclick  		= function(){ 
										if( !confirm('<?php echo JText::_('LNG_CONFIRM_DELETE_PICTURE')?>' )) 
											return; 
										
										var row 		= jQuery(this).parents('tr:first');
										var row_idx 	= row.prevAll().length;
										
										jQuery('#crt_pos').val(row_idx);
										jQuery('#crt_path').val( path );
										jQuery('#btn_removefile').click();
								};
		
	td3_new.appendChild(img_del);
	
	var td4_new			= document.createElement('td');  
	td4_new.style.textAlign='center';
	var img_enable	 	= document.createElement('img');
	img_enable.setAttribute('src', "<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/checked.gif"?>");
	img_enable.setAttribute('class', 'btn_picture_status');
	img_enable.setAttribute('id', 	tb.rows.length);
	img_enable.setAttribute('name', 'enable_img_' + tb.rows.length);
	
	img_enable.onclick  		= function(){ 
												var form 		= document.adminForm;
												var v_status  	= null; 
												if( form.elements['offer_picture_enable[]'].length == null )
												{
													v_status  = form.elements['offer_picture_enable[]'];
												}
												else
												{
													pos = this.id;
													var tb = document.getElementById('table_offer_pictures');
													if( pos >= tb.rows.length )
														pos = tb.rows.length-1;
													v_status  = form.elements['offer_picture_enable[]'][ pos ];
												}
												
												if(v_status.value=='1')
												{
													jQuery(this).attr('src', '<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/unchecked.gif"?>');
													v_status.value ='0';
												}
												else
												{
													jQuery(this).attr('src', '<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/checked.gif"?>');
													v_status.value ='1';
												}
								};
	td4_new.appendChild(img_enable);
	
	
	var td5_new			= document.createElement('td');  
	td5_new.style.textAlign='center';
			
	td5_new.innerHTML	= 	'<span class=\'span_up\' onclick=\'var row = jQuery(this).parents("tr:first");  row.insertBefore(row.prev());\'><?php echo JText::_('LNG_STR_UP')?></span>'+
							'&nbsp;' +
							'<span class=\'span_down\' onclick=\'var row = jQuery(this).parents("tr:first"); row.insertAfter(row.next());\'><?php echo JText::_('LNG_STR_DOWN')?></span>';
	
	var tr_new = tb.insertRow(tb.rows.length);
	
	tr_new.appendChild(td1_new);
	tr_new.appendChild(td2_new);
	tr_new.appendChild(td3_new);
	tr_new.appendChild(td4_new);
	tr_new.appendChild(td5_new);
}


function removePicture(pos)
{
	var tb = document.getElementById('table_offer_pictures');
	//alert(tb);
	if( tb==null )
	{
		alert('Undefined table, contact administrator !');
	}
	
	if( pos >= tb.rows.length )
		pos = tb.rows.length-1;
	tb.deleteRow( pos );

}

function removeRow(id){
	jQuery('#'+id).remove();
}
</script>
