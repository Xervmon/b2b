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
		if (task == 'event.cancel' || task == 'event.aprove' || task == 'event.disaprove' || !validateCmpForm()){
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
	<div class="button-row">
		<button type="button" class="ui-dir-button" onclick="saveEventCompanyInformation();">
				<span class="ui-button-text"><?php echo JText::_("LNG_SAVE")?></span>
		</button>
		<button type="button" class="ui-dir-button ui-dir-button-grey" onclick="cancel()">
				<span class="ui-button-text"><?php echo JText::_("LNG_CANCEL")?></span>
		</button>
	</div>
</div>
<?php  } ?>

<div class="category-form-container">	
	<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-horizontal">
		<div class="clr mandatory oh">
			<p><?php echo JText::_("LNG_REQUIRED_INFO")?></p>
		</div>
		<fieldset class="boxed">

			<h2> <?php echo JText::_('LNG_EVENT_DETAILS');?></h2>
			<p><?php echo JText::_('LNG_DISPLAY_INFO_TXT');?></p>
			<div class="form-box">
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="subject"><?php echo JText::_('LNG_NAME')?> </label> 
					<input type="text" name="name" id="name" class="input_txt validate[required]" value="<?php echo $this->item->name ?>"  maxLength="100">
					<div class="clear"></div>
				</div>
				<div class="detail_box">
					<label for="name"><?php echo JText::_('LNG_ALIAS')?> </label> 
					<input type="text"	name="alias" id="alias"  placeholder="Auto-generate from business name" class="input_txt text-input" value="<?php echo $this->item->alias ?>"  maxLength="100">
					<div class="clear"></div>
				</div>
				<div class="detail_box">
					<div class="form-detail req"></div>
					<label for="description_id"><?php echo JText::_("LNG_EVENT")." ".JText::_('LNG_DESCRIPTION')?>  &nbsp;&nbsp;&nbsp;</label>
					<textarea name="description" id="description" class="input_txt validate[required]"  cols="75" rows="10"  maxLength="<?php echo EVENT_DESCRIPTION_MAX_LENGHT?>"
						 onkeyup="calculateLenght();"><?php echo $this->item->description ?></textarea>
					<div class="clear"></div>
					<div class="description-counter">	
						<input type="hidden" name="descriptionMaxLenght" id="descriptionMaxLenght" value="<?php echo EVENT_DESCRIPTION_MAX_LENGHT?>" />	
						<label for="decriptionCounter">(Max. <?php echo EVENT_DESCRIPTION_MAX_LENGHT?> characters).</label>
						<?php echo JText::_('LNG_REMAINING')?><input type="text" value="0" id="descriptionCounter" name="descriptionCounter">			
					</div>
				</div>
				
				<div class="detail_box">
					<label for="price"><?php echo JText::_('LNG_LOCATION')?> </label> 
					<input type="text" name="location" id="location" class="input_txt"
						value="<?php echo $this->item->location ?>">
					<div class="clear"></div>
				</div>

				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="companyTypes"><?php echo JText::_('LNG_TYPE')?> </label> 
					<select class="input_sel validate[required] select" name="type" id="companyTypes">
							<option  value=""> </option>
							<?php
							foreach( $this->item->types as $type )
							{
							?>
							<option <?php echo $this->item->type==$type->id? "selected" : ""?> 
								value='<?php echo $type->id?>'
							>
								<?php echo $type->name ?>
							</option>
							<?php
							}
							?>
					</select>
					<div class="clear"></div>
				</div>
				
				<div class="detail_box">
					<label for="startDate"><?php echo JText::_('LNG_START_DATE')?> </label> 
					<?php echo JHTML::_('calendar', $this->item->start_date, 'start_date', 'start_date', $appSetings->calendarFormat, array('class'=>'inputbox', 'size'=>'10',  'maxlength'=>'10')); ?>
					<div class="clear"></div>
				</div>
				
				
				<div class="detail_box">
					<label for="endDate"><?php echo JText::_('LNG_END_DATE')?> </label>
					<?php echo JHTML::_('calendar', $this->item->end_date, 'end_date', 'end_date', $appSetings->calendarFormat, array('class'=>'inputbox', 'size'=>'10',  'maxlength'=>'10')); ?>
					<div class="clear"></div>
				</div>
				
				
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="companyId"><?php echo JText::_('LNG_COMPANY')?></label> 
					<select name="company_id" class="inputbox input-medium validate[required]">
						<?php echo JHtml::_('select.options', $this->companies, 'id', 'name', $this->item->company_id);?>
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
				<h2> <?php echo JText::_('LNG_EVENT_PICTURES');?></h2>
				<p> <?php echo JText::_('LNG_EVENT_PICTURES_INFORMATION_TEXT');?>.</p>
				<input type='button' name='btn_removefile' id='btn_removefile' value='x' style='display:none'>
				<input type='hidden' name='crt_pos' id='crt_pos' value=''>
				<input type='hidden' name='crt_path' id='crt_path' value=''>
					<TABLE class='picture-table' align=left border=0>
						<TR>
							<TD align=left class="key"><?php echo JText::_('LNG_PICTURES');  ?>:</TD>
							<TD>
								<TABLE class="admintable" align=center  id='table_event_pictures' name='table_event_pictures' >
									<?php
									$pos = 0;
									
									foreach( $this->item->pictures as $picture )
									{
									?>
									<TR>
										<TD align=left>
											<textarea cols=50 rows=2 name='event_picture_info[]' id='event_picture_info'><?php echo $picture['event_picture_info']?></textarea>
										</TD>
										<td align=center>
											<img class='img_picture_event' src='<?php echo JURI::root()."/".PICTURES_PATH.$picture['event_picture_path']?>'/>
											<BR>
											<?php echo basename($picture['event_picture_path'])?>
											<input type='hidden' 
												value='<?php echo $picture['event_picture_enable']?>' 
												name='event_picture_enable[]' 
												id='event_picture_enable'
											>
											<input type='hidden' 
												value='<?php echo $picture['event_picture_path']?>' 
												name='event_picture_path[]' 
												id='event_picture_path'
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
															jQuery('#crt_path').val('<?php echo $picture['event_picture_path']?>');
															jQuery('#btn_removefile').click();
														"
					
											/>
										</td>
										<td align=center>
											<img class='btn_picture_status' 
												src='<?php echo JURI::root() ."administrator/components/".JBusinessUtil::getComponentName()."/assets/img/".($picture['event_picture_enable'] ? 'checked' : 'unchecked').".gif"?>'
												onclick =  " 
															var form 		= document.adminForm;
															var v_status  	= null;
															if( form.elements['event_picture_enable[]'].length == null )
															{
																v_status  = form.elements['event_picture_enable[]'];
															}
															else
															{
																v_status  = form.elements['event_picture_enable[]'][<?php echo $pos ?>];
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
					<button type="submit" class="ui-dir-button" onclick="saveEventCompanyInformation();">
							<span class="ui-button-text"><?php echo JText::_("LNG_SAVE")?></span>
					</button>
					<button type="submit" class="ui-dir-button ui-dir-button-grey" onclick="cancel()">
							<span class="ui-button-text"><?php echo JText::_("LNG_CANCEL")?></span>
					</button>
				</div>
			<?php  } ?>
	<script  type="text/javascript">
		
		function saveEventCompanyInformation(){
			if(validateCmpForm())
				return false;
				
			jQuery("#task").val('managecompanyevent.save');
			var form = document.adminForm;
			form.submit();
		}
		
		function cancel(){
			jQuery("#task").val('managecompanyevent.cancel');
			var form = document.adminForm;
			form.submit();
		}
		
		function validateCmpForm(){
			var isError = jQuery("#item-form").validationEngine('validate');
			
			return !isError;
		}
		
	</script>
	<input type="hidden" name="option" value="<?php echo JBusinessUtil::getComponentName()?>" /> 
	<input type="hidden"name="task" id="task" value="" /> 
	<input type="hidden" name="id" value="<?php echo $this->item->id ?>" /> 
	

	<?php echo JHTML::_( 'form.token' ); ?>
	 
</form>
</div>

<script>
	jQuery(document).ready(function(){
		jQuery("#item-form").validationEngine('attach');
		
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
			
			jQuery(this).upload('<?php echo $baseUrl?>components/<?php echo JBusinessUtil::getComponentName()?>/assets/upload.php?t=<?php echo strtotime('now')?>&picture_type=<?php echo PICTURE_TYPE_EVENT?>&_root_app=<?php echo urlencode(JPATH_ROOT."/".PICTURES_PATH)?>&_target=<?php echo urlencode(EVENT_PICTURES_PATH.((int)$this->item->id).'/')?>', function(responce) 
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
																															"<?php echo EVENT_PICTURES_PATH.((int)$this->item->id).'/'?>" + jQuery(this).attr("path"),
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
	var tb = document.getElementById('table_event_pictures');
	if( tb==null )
	{
		alert('Undefined table, contact administrator !');
	}
	
	var td1_new			= document.createElement('td');  
	td1_new.style.textAlign='left';
	var textarea_new 	= document.createElement('textarea');
	textarea_new.setAttribute("name","event_picture_info[]");
	textarea_new.setAttribute("id","event_picture_info");
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
	input_new_1.setAttribute('name',		'event_picture_enable[]');
	input_new_1.setAttribute('id',			'event_picture_enable[]');
	input_new_1.setAttribute('value',		'1');
	td2_new.appendChild(input_new_1);
	
	var input_new_2		= document.createElement('input');
	input_new_2.setAttribute('type',		'hidden');
	input_new_2.setAttribute('name',		'event_picture_path[]');
	input_new_2.setAttribute('id',			'event_picture_path[]');
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
												if( form.elements['event_picture_enable[]'].length == null )
												{
													v_status  = form.elements['event_picture_enable[]'];
												}
												else
												{
													pos = this.id;
													var tb = document.getElementById('table_event_pictures');
													if( pos >= tb.rows.length )
														pos = tb.rows.length-1;
													v_status  = form.elements['event_picture_enable[]'][ pos ];
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
	var tb = document.getElementById('table_event_pictures');
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
