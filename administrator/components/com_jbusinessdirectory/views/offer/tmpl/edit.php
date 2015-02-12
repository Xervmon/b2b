<?php
/**
 * @package    JBusinessDirectory
 * @subpackage  com_jbusinessdirectory
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{	
		if (task == 'offer.cancel' || task == 'offer.aprove' || task == 'offer.disaprove' || !validateCmpForm()){
			Joomla.submitform(task, document.getElementById('item-form'));
		}
	}
</script>

<?php 
$appSetings = JBusinessUtil::getInstance()->getApplicationSettings();
$user = JFactory::getUser();
?>

<?php  if(isset($isProfile)) { ?>
	<div class="button-row">
		<button type="button" class="ui-dir-button" onclick="saveCompanyInformation();">
				<span class="ui-button-text"><?php echo JText::_("LNG_SAVE")?></span>
		</button>
		<button type="button" class="ui-dir-button ui-dir-button-grey" onclick="cancel()">
				<span class="ui-button-text"><?php echo JText::_("LNG_CANCEL")?></span>
		</button>
	</div>
	<div class="clear"></div>		
<?php  } ?>

<div class="category-form-container">	
	<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-horizontal">
		<div class="clr mandatory oh">
			<p><?php echo JText::_("LNG_REQUIRED_INFO")?></p>
		</div>
		<fieldset class="boxed">

			<h2> <?php echo JText::_('LNG_OFFER_DETAILS');?></h2>
			<p><?php echo JText::_('LNG_DISPLAY_INFO_TXT');?></p>
			<div class="form-box">
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="subject"><?php echo JText::_('LNG_SUBJECT')?> </label> 
					<input type="text" name="subject" id="subject" class="input_txt validate[required]"  value="<?php echo $this->item->subject ?>" maxLength="100">
					<div class="clear"></div>
					<span class="error_msg" id="frmCompanySubject_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>
				<div class="detail_box">
					<label for="name"><?php echo JText::_('LNG_ALIAS')?> </label> 
					<input type="text"	name="alias" id="alias"  placeholder="Auto-generate from business name" class="input_txt text-input" value="<?php echo $this->item->alias ?>"  maxLength="100">
					<div class="clear"></div>
				</div>
				
				<div class="detail_box">
					<label for="subject"><?php echo JText::_('LNG_CATEGORY')?> </label> 
					<select name="categories[]" id="categories-offers" multiple="multiple">
						<option val=""><?php echo JText::_("LNG_SELECT_CAT") ?></option>
						<?php echo $this->displayCategoriesOptions($this->categories,1,$this->item->selectedCategories); ?>
					</select>
					<div class="clear"></div>					
				</div>
				
				<div class="detail_box">
					<div class="form-detail req"></div>
					<label for="short_description"><?php echo JText::_('LNG_SHORT_DESCRIPTION')?>  &nbsp;&nbsp;&nbsp;</label>
					<textarea name="short_description" id="short_description" class="input_txt validate[required]"  cols="75" rows="4"  maxLength="250"
						><?php echo $this->item->short_description ?></textarea>
				</div>
				
				<div class="detail_box">
					<div class="form-detail req"></div>
					<label for="description_id"><?php echo JText::_('LNG_DESCRIPTION')?>  &nbsp;&nbsp;&nbsp;</label>
					<textarea name="description" id="description" class="input_txt validate[required]"  cols="75" rows="10"  maxLength="<?php echo OFFER_DESCRIPTIION_MAX_LENGHT?>"
						 onkeyup="calculateLenght();"><?php echo $this->item->description ?></textarea>
					<div class="clear"></div>
					<span class="error_msg" id="frmDescription_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					<div class="description-counter">	
						<input type="hidden" name="descriptionMaxLenght" id="descriptionMaxLenght" value="<?php echo OFFER_DESCRIPTIION_MAX_LENGHT?>" />	
						<label for="decriptionCounter">(Max. <?php echo OFFER_DESCRIPTIION_MAX_LENGHT?> characters).</label>
						<?php echo JText::_('LNG_REMAINING')?><input type="text" value="0" id="descriptionCounter" name="descriptionCounter">			
					</div>
				</div>
				
				<div class="detail_box">
					<label for="startDate"><?php echo JText::_('LNG_OFFER_START_DATE')?> </label> 
					<?php echo JHTML::_('calendar', $this->item->startDate, 'startDate', 'startDate', $appSetings->calendarFormat, array('class'=>'inputbox', 'size'=>'10',  'maxlength'=>'10')); ?>
					<div class="clear"></div>
				</div>
				
				<div class="detail_box">
					<label for="endDate"><?php echo JText::_('LNG_OFFER_END_DATE')?> </label>
					<?php echo JHTML::_('calendar', $this->item->endDate, 'endDate', 'endDate', $appSetings->calendarFormat, array('class'=>'inputbox', 'size'=>'10',  'maxlength'=>'10')); ?>
					<div class="clear"></div>
				</div>
				
				<div class="detail_box">
					<label for="startDate"><?php echo JText::_('LNG_PUBLISH_START_DATE')?> </label> 
					<?php echo JHTML::_('calendar', $this->item->publish_start_date, 'publish_start_date', 'publish_start_date', $appSetings->calendarFormat, array('class'=>'inputbox', 'size'=>'10',  'maxlength'=>'10')); ?>
					<div class="clear"></div>
				</div>
				
				<div class="detail_box">
					<label for="endDate"><?php echo JText::_('LNG_PUBLISH_END_DATE')?> </label>
					<?php echo JHTML::_('calendar', $this->item->publish_end_date, 'publish_end_date', 'publish_end_date', $appSetings->calendarFormat, array('class'=>'inputbox', 'size'=>'10',  'maxlength'=>'10')); ?>
					<div class="clear"></div>
				</div>
				
				<div class="detail_box">
					<label for="price"><?php echo JText::_('LNG_PRICE')?> </label> 
					<input type="text"
						name="price" id="price" class="input_txt"
						value="<?php echo $this->item->price ?>">
					<div class="clear"></div>
					
				</div>

				<div class="detail_box">
					<label for="specialPrice"><?php echo JText::_('LNG_SPECIAL_PRICE')?> </label> 
					<input type="text"
						name=specialPrice id="specialPrice" class="input_txt"
						value="<?php echo $this->item->specialPrice ?>">
					<div class="clear"></div>
					
				</div>
				
				<div class="detail_box">
					<div class="form-detail req"></div>
					<label for="companyId"><?php echo JText::_('LNG_ASSOCIATED_COMPANY')?></label> 
					<select name="companyId" id="companyId" class="inputbox input-medium validate[required]">
						<?php echo JHtml::_('select.options', $this->companies, 'id', 'name', $this->item->companyId);?>
					</select>
					<div class="clear"></div>
				</div>
			
				<div class="detail_box">
					<label for="state"><?php echo JText::_('LNG_STATE')?></label> 
					<select name="state" id="state" class="inputbox input-medium">
						<?php echo JHtml::_('select.options', $this->states, 'value', 'text', $this->item->state);?>
					</select>
					<div class="clear"></div>
				</div>
			
			</div>
			</fieldset>
			
			<fieldset class="boxed">
				<h2> <?php echo JText::_('LNG_CONFIGURATION');?></h2>
				<div class="form-box">
					<div class="detail_box">
						<div class="form-detail req"></div>
						<label for="latitude"><?php echo JText::_('LNG_VIEW_TYPE')?> </label> 
						<div>
							<input  type="radio" class="validate[required]" name="view_type" id="offer" value="1" <?php echo $this->item->view_type==1? " checked " :""?>>
							<label for="offer"><?php echo JText::_('LNG_OFFER')?> </label> 
							<input  type="radio" class="validate[required]" name="view_type" id="article" value="2" <?php echo $this->item->view_type==2? " checked " :""?>>
							<label for="article"><?php echo JText::_('LNG_ARTICLE')?> </label> 
							<input  type="radio" class="validate[required]" name="view_type" id="url" value="3" <?php echo $this->item->view_type==3? " checked " :""?>>
							<label for="url"><?php echo JText::_('LNG_URL')?> </label> 
						</div>
						<div class="clear"></div>
						
					</div>
					<div class="detail_box">
						<label for="article_id"><?php echo JText::_('LNG_ARTICLE_ID')?> </label> 
						<input class="input_txt" type="text" name="article_id" id="article_id" value="<?php echo $this->item->article_id ?>">
						<div class="clear"></div>
					</div>
	
					<div class="detail_box">
						<label for="url"><?php echo JText::_('LNG_URL')?> </label>
						<input class="input_txt" type="text" name="url" id="url" value="<?php echo $this->item->url ?>">
						<div class="clear"></div>
					</div>
				</div>
				
			</fieldset>
			
			
			<fieldset class="boxed">
				<h2> <?php echo JText::_('LNG_LOCATION');?></h2>
				<div class="form-box">
					<div class="detail_box">
						<label for="address_id"><?php echo JText::_('LNG_ADDRESS')?></label> 
						<input type="text" id="autocomplete" class="input_txt" placeholder="Enter your address" onFocus="" ></input>
						<div class="clear"></div>
					</div>

					<div class="detail_box">
						<label for="subject"><?php echo JText::_('LNG_ADDRESS')?> </label> 
						<input type="text"
							name="address" id="route" class="input_txt" value="<?php echo $this->item->address ?>">
						<div class="clear"></div>					
					</div>
					
					<div class="detail_box">
						<label for="subject"><?php echo JText::_('LNG_CITY')?> </label> 
						<input type="text"
							name="city" id="locality" class="input_txt" value="<?php echo $this->item->city ?>">
						<div class="clear"></div>					
					</div>
					
					<div class="detail_box">
						<label for="subject"><?php echo JText::_('LNG_REGION')?> </label> 
						<input type="text"
							name="county" id="administrative_area_level_1" class="input_txt" value="<?php echo $this->item->county ?>">
						<div class="clear"></div>					
					</div>
				
					<div class="detail_box">
						<label for="latitude"><?php echo JText::_('LNG_LATITUDE')?> </label> 
						<p class="small"><?php echo JText::_('LNG_MAP_INFO')?></p>
						<input class="input_txt" type="text" name="latitude" id="latitude" value="<?php echo $this->item->latitude ?>">
						<div class="clear"></div>
					</div>
	
					<div class="detail_box">
						<label for="longitude"><?php echo JText::_('LNG_LONGITUDE')?> </label>
						<p class="small"><?php echo JText::_('LNG_MAP_INFO')?></p>
						<input class="input_txt" type="text" name="longitude" id="longitude" value="<?php echo $this->item->longitude ?>">
						<div class="clear"></div>
					</div>
					
					<div id="map-container">
						<div id="company_map">
						</div>
					</div>
					
				</div>
				
			</fieldset>
			
			<fieldset class="boxed">
				<h2> <?php echo JText::_('LNG_OFFER_PICTURES');?></h2>
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
											<img class='img_picture_offer' src='<?php echo JURI::root()."/".PICTURES_PATH.$picture['offer_picture_path']?>'/>
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
												src='<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/del_options.gif"?>'
												onclick =  " 
															if(!confirm('<?php echo JText::_('LNG_CONFIRM_DELETE_PICTURE',true)?>')) 
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
												src='<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/".($picture['offer_picture_enable'] ? 'checked' : 'unchecked').".gif"?>'
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
																jQuery(this).attr('src', '<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/unchecked.gif"?>');
																v_status.value ='0';
															}
															else
															{
																jQuery(this).attr('src', '<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/checked.gif"?>');
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
			

		<?php  if(isset($isProfile)) { ?>
			<div class="button-row">
				<button type="button" class="ui-dir-button" onclick="saveCompanyInformation();">
						<span class="ui-button-text"><?php echo JText::_("LNG_SAVE")?></span>
				</button>
				<button type="button" class="ui-dir-button ui-dir-button-grey" onclick="cancel()">
						<span class="ui-button-text"><?php echo JText::_("LNG_CANCEL")?></span>
				</button>
			</div>
		<?php  } ?>
	<script  type="text/javascript">
		
		function saveCompanyInformation(){
			if(validateCmpForm())
				return false;
				
			jQuery("#task").val('managecompanyoffer.save');
			var form = document.adminForm;
			form.submit();
		}
		
		function cancel(){
			jQuery("#task").val('managecompanyoffer.cancel');
			var form = document.adminForm;
			form.submit();
		}
		
		function validateCmpForm(){
			var isError = jQuery("#item-form").validationEngine('validate');
			
			return !isError;
			
		}
	</script>
	<input type="hidden" name="option" value="<?php echo JBusinessUtil::getComponentName()?>" /> 
	<input type="hidden" name="task" id="task" value="" /> 
	<input type="hidden" name="id" value="<?php echo $this->item->id ?>" /> 
	
	<?php echo JHTML::_( 'form.token' ); ?>
	 
</form>
</div>

<script>
	jQuery(document).ready(function(){
		jQuery("#item-form").validationEngine('attach');
		
		var categoriesSelectList = null;
	
		categoriesSelectList = jQuery("select#categories-offers").selectList({ 
			sort: true,
			classPrefix: 'cities_ids',
			instance: true
		});

		initializeAutocomplete();
		
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

			
			
			jQuery(this).upload('<?php echo $baseUrl?>components/<?php echo JBusinessUtil::getComponentName()?>/assets/upload.php?t=<?php echo strtotime('now')?>&picture_type=<?php echo PICTURE_TYPE_OFFER?>&_root_app=<?php echo urlencode(JPATH_ROOT."/".PICTURES_PATH)?>&_target=<?php echo urlencode(OFFER_PICTURES_PATH.((int)$this->item->id).'/')?>', function(responce) 
																								{
																									//alert(responce);
																									if( responce =='' )
																									{
																										alert("<?php echo JText::_('LNG_ERROR_ADDING_FILE',true)?>");
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
																															"<?php echo OFFER_PICTURES_PATH.((int)$this->item->id).'/'?>" + jQuery(this).attr("path"),
																															jQuery(this).attr("name")
																												);
																											}
																											else if( jQuery(this).attr("error") == 1 )
																												alert("<?php echo JText::_('LNG_FILE_ALLREADY_ADDED',true)?>");
																											else if( jQuery(this).attr("error") == 2 )
																												alert("<?php echo JText::_('LNG_ERROR_ADDING_FILE',true)?>");
																											else if( jQuery(this).attr("error") == 3 )
																												alert("<?php echo JText::_('LNG_ERROR_GD_LIBRARY',true)?>");
																											else if( jQuery(this).attr("error") == 4 )
																												alert("<?php echo JText::_('LNG_ERROR_RESIZING_FILE',true)?>");
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
					jQuery( this ).upload('<?php echo JURI::root()?>administrator/components/<?php echo JBusinessUtil::getComponentName()?>/assets/remove.php?_root_app=<?php echo urlencode(JPATH_COMPONENT_ADMINISTRATOR)?>&_filename='+ path + '&_pos='+pos, function(responce) 
																										{
																											// alert(responce);
																											if( responce =='' )
																											{
																												alert("<?php echo JText::_('LNG_ERROR_REMOVING_FILE',true)?>");
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
																														alert("<?php echo JText::_('LNG_ERROR_REMOVING_FILE',true)?>");
																													else if( jQuery(this).attr("error") == 3 )
																														alert("<?php echo JText::_('LNG_FILE_DOESNT_EXIST',true)?>");
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
	img_new.setAttribute('src', "<?php echo JURI::root()."/".PICTURES_PATH ?>" + path );
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
	img_del.setAttribute('src', "<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/del_options.gif"?>");
	img_del.setAttribute('class', 'btn_picture_delete');
	img_del.setAttribute('id', 	tb.rows.length);
	img_del.setAttribute('name', 'del_img_' + tb.rows.length);
	img_del.onmouseover  	= function(){ this.style.cursor='hand';this.style.cursor='pointer' };
	img_del.onmouseout 		= function(){ this.style.cursor='default' };
	img_del.onclick  		= function(){ 
										if( !confirm('<?php echo JText::_('LNG_CONFIRM_DELETE_PICTURE',true)?>' )) 
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
	img_enable.setAttribute('src', "<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/checked.gif"?>");
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
													jQuery(this).attr('src', '<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/unchecked.gif"?>');
													v_status.value ='0';
												}
												else
												{
													jQuery(this).attr('src', '<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/checked.gif"?>');
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


var map;
var markers = [];


function initialize() {
	<?php 
		$latitude = isset($this->item->latitude) && strlen($this->item->latitude)>0?$this->item->latitude:"0";
		$longitude = isset($this->item->longitude) && strlen($this->item->longitude)>0?$this->item->longitude:"0";
 ?>
	var companyLocation = new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>);
	var mapOptions = {
	  zoom: <?php echo !(isset($this->item->latitude) && strlen($this->item->latitude))?1:15?>,
	  center: companyLocation,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	var mapdiv = document.getElementById("company_map");
	mapdiv.style.width = '530px';
	mapdiv.style.height = '400px';
	map = new google.maps.Map(mapdiv,  mapOptions);
	
	
	var latitude = '<?php echo  $this->item->latitude ?>';
	var longitude = '<?php echo  $this->item->longitude ?>';
	
	if(latitude && longitude)
	    addMarker(new google.maps.LatLng(latitude, longitude ));
			  
	google.maps.event.addListener(map, 'click', function(event) {
		 deleteOverlays();
	   addMarker(event.latLng);
	});

}

//Add a marker to the map and push to the array.
function addMarker(location) {
	document.getElementById("latitude").value = location.lat();
	document.getElementById("longitude").value = location.lng();
	
	marker = new google.maps.Marker({
	  position: location,
	  map: map
	});
	markers.push(marker);
}

//Sets the map on all markers in the array.
function setAllMap(map) {
	for (var i = 0; i < markers.length; i++) {
	  markers[i].setMap(map);
	}
}

//Removes the overlays from the map, but keeps them in the array.
function clearOverlays() {
	setAllMap(null);
}

//Shows any overlays currently in the array.
function showOverlays() {
	setAllMap(map);
}

//Deletes all markers in the array by removing references to them.
function deleteOverlays() {
	clearOverlays();
	markers = [];
}
var initialized = false;  


var placeSearch, autocomplete;
var component_form = {
  'route': 'long_name',
  'locality': 'long_name',
  'administrative_area_level_1': 'long_name'
};

function initializeAutocomplete() {
  autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'), { types: [ 'geocode' ] });
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

function fillInAddress() {
  var place = autocomplete.getPlace();

  for (var component in component_form) {
      //console.debug(component);
      var obj = document.getElementById(component);
      if(typeof maybeObject != "undefined"){
	      document.getElementById(component).value = "";
	      document.getElementById(component).disabled = false;
      }
  }
  
  for (var j = 0; j < place.address_components.length; j++) {
    var att = place.address_components[j].types[0];
  
    if (component_form[att]) {
      var val = place.address_components[j][component_form[att]];
      //console.debug("#"+att);
      //console.debug(val);
      //console.debug(jQuery(att).val());
      jQuery("#"+att).val(val);
      if(att=='country'){
      	jQuery('#country option').filter(function () {
      		   return jQuery(this).text() === val;
      		}).attr('selected', true);
      }
    }
  }

  if(typeof map != "undefined"){
	    if (place.geometry.viewport) {
	        map.fitBounds(place.geometry.viewport);
	      } else {
	        map.setCenter(place.geometry.location);
	        map.setZoom(17); 
	        addMarker(place.geometry.location);
	      }
	 }
}
  
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
    });
  }
}

 	

window.onload = initialize;
</script>
