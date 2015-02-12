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


	$user = JFactory::getUser();

	?>
	<?php  if($isProfile) { ?>
		<div class="buttons">
		
			<span class="button">
				<button type="button" value="logout" onclick="saveCompanyInformation()" href="javascript:void(0)"><?php echo JText::_('LNG_SAVE')?></button>
			</span>
		
			<span class="button gray">
				<button type="button" value="logout" onclick="cancel()" href="javascript:void(0)"><?php echo JText::_('LNG_CANCEL')?></button>
			</span>
				
		</div>
		<div class="clear"></div>		
		<?php  
			}else if(isset($this->claimDetails) &&  $this->claimDetails->status == 0){ 
		?>

			<div id="claim-details" class="claim-details">
				<p>
					<?php echo JText::_("LNG_CLAIM_DETAILS_TEXT")?>
				</p>
				<table>
					<tr>
						<th><?php echo JText::_('LNG_FIRST_NAME')?></th>
						<td><?php echo $this->claimDetails->firstName ?></td>
					</tr>
					<tr>
						<th><?php echo JText::_('LNG_LAST_NAME')?></th>
						<td><?php echo $this->claimDetails->lastName ?></td>
					</tr>
					<tr>
						<th><?php echo JText::_('LNG_FUNCTION')?></th>
						<td><?php echo $this->claimDetails->function ?></td>
					</tr>
					<tr>
						<th><?php echo JText::_('LNG_PHONE')?></th>
						<td><?php echo $this->claimDetails->phone ?></td>
					</tr>
					<tr>
						<th><?php echo JText::_('LNG_EMAIL_ADDRESS')?></th>
						<td><?php echo $this->claimDetails->email ?></td>
					</tr>
				</table>
				  
				<p>
					<?php echo JText::_("LNG_USER_DETAILS_TXT")?>
				</p>
		
		<?php 
			$claimUser = JFactory::getUser($this->item->userId);
		?>
		<table>
			<tr>
				<th><?php echo JText::_('LNG_FIRST_NAME')?></th>
				<td><?php echo $claimUser->name ?></td>
			</tr>
			<tr>
				<th><?php echo JText::_('LNG_USERNAME')?></th>
				<td><?php echo $claimUser->username ?></td>
			</tr>
			<tr>
				<th><?php echo JText::_('LNG_EMAIL')?></th>
				<td><?php echo $claimUser->email ?></td>
			</tr>
		</table>
		</div>
	<?php } ?>
	
<div class="category-form-container">	
	<form action="index.php" method="post" name="adminForm">
		<div class="clr mandatory oh">
			<p>This information is required</p>
		</div>
		<fieldset class="boxed">

			<h2> <?php echo JText::_('LNG_COMPANY_DETAILS');?></h2>
			<p><?php echo JText::_('LNG_DISPLAY_INFO_TXT');?></p>
			<div class="form-box">
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="name"><?php echo JText::_('LNG_COMPANY_NAME')?> </label> 
					<input type="text"
						name="name" id="name" class="input_txt" value="<?php echo $this->item->name ?>" onchange2="checkCompanyName('<?php echo $this->item->name ?>',this.value)">
					<div class="clear"></div>
					<span class="error_msg" id="company_exists_msg" style="display: none;"><?php echo JText::_('LNG_COMPANY_NAME_ALREADY_EXISTS')?></span>
					<span class="" id="claim_company_exists_msg" style="display: none;"><?php echo JText::_('LNG_CLAIM_COMPANY_EXISTS')?> <a id="claim-link" href=""><?php echo JText::_("LNG_HERE")?></a></span>
					
					<span class="error_msg" id="frmCompanyName_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>

				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="comercialName"><?php echo JText::_('LNG_COMPANY_COMERCIAL_NAME')?> </label> 
					
					<input type="text"
						name="comercialName" id="comercialName" class="input_txt" value="<?php echo $this->item->comercialName ?>">
					<div class="clear"></div>
					<span class="error_msg" id="frmCompanyComercialName_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>

				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="taxCode"><?php echo JText::_('LNG_TAX_CODE')?> </label>
					
					<input type="text"
						name="taxCode" id="taxCode" class="input_txt"
						value="<?php echo $this->item->taxCode ?>">
					<div class="clear"></div>
					<span class="error_msg" id="frmTaxCode_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>

				
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="registrationCode"><?php echo JText::_('LNG_REGISTRATION_CODE')?> </label>
					
					<input type="text"
						name="registrationCode" id="registrationCode" class="input_txt"
						value="<?php echo $this->item->registrationCode ?>">
					<div class="clear"></div>
					<span class="error_msg" id="frmRegistrationCode_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>

				<div class="detail_box">
					<label for="website"><?php echo JText::_('LNG_WEBSITE')?> </label> <input type="text"
						name="website" id="website" value="<?php echo $this->item->website ?>"
						class="input_txt">
						<div class="clear"></div>
				</div>
				
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="companyTypes"><?php echo JText::_('LNG_COMPANY_TYPE')?> </label> 
					<select class="input_sel" name="typeId"
						id="companyTypes">
							<option  value=""> </option>
							<?php
							foreach( $this->item->types as $type )
							{
							?>
							<option <?php echo $this->item->typeId==$type->id? "selected" : ""?> 
								value='<?php echo $type->id?>'
							>
								<?php echo $type->name ?>
							</option>
							<?php
							}
							?>
						?>
					</select>
					<div class="clear"></div>
					<span class="error_msg" id="frmCompanyType_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>
				
				<div class="detail_box">
					<div class="form-detail req"></div>
					<label for="description_id"><?php echo JText::_("LNG_COMPANY")." ".JText::_('LNG_DESCRIPTION')?>  &nbsp;&nbsp;&nbsp;</label>
					<p class="small"><?php echo JText::_("LNG_COMPANY_DESCR_INFO")?></p>
					<textarea name="description" id="description" class="input_txt"  cols="75" rows="10"  maxLength="<?php echo COMPANY_DESCRIPTIION_MAX_LENGHT?>"
						 onkeyup="calculateLenght();"><?php echo $this->item->description ?></textarea>
					<div class="clear"></div>
					<span class="error_msg" id="frmDescription_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					<div class="description-counter">	
						<input type="hidden" name="descriptionMaxLenght" id="descriptionMaxLenght" value="<?php echo COMPANY_DESCRIPTIION_MAX_LENGHT?>" />	
						<label for="decriptionCounter">(Max. <?php echo COMPANY_DESCRIPTIION_MAX_LENGHT?> characters).</label>
						<?php JText::_('LNG_REMAINING')?><input type="text" value="0" id="decriptionCounter" name="decriptionCounter">			
					</div>
				</div>
				
				<div class="detail_box">
					<label for="keywords"><?php echo JText::_('LNG_KEYWORDS')?> </label> 
					<p class="small"><?php echo JText::_('LNG_COMPANY_KEYWORD_INFO')?></p>
					<input	type="text" name="keywords" class="input_txt" id="keywords" value="<?php echo $this->item->keywords ?>">
					<div class="clear"></div>
			</div>
				
			</div>
			</fieldset>
			
	
			<fieldset class="boxed">

				<h2> <?php echo JText::_('LNG_COMPANY_DETAILS');?></h2>
				<p><?php echo JText::_('LNG_SELECT_CATEGORY');?></p>
				<div class="form-box">
					
					<div class="detail_box">
						<label for=""category"">Categoria</label>
						<?php 
							for ($i=1;$i<=$this->item->maxLevel;$i++){
								?>
								<div id="company_categories-level-<?php echo $i?>">
									<?php if($i==1) echo $this->displayCompanyCategories( $this->item->categories,$i); ?>
								</div>
						<?php }	?>
						<div class="clear"></div>
					</div>

					<div class="detail_box" id="cat">
						<select name="subcategories" size="6" id="subcategories"
							onchange="addSelectedSubcategory()"
							multiple="multiple" class="input_sel"
							style="width: 254px; height: 180px;">
						</select>
						
						<select name="selectedSubcategories[]" id="selectedSubcategories" size="6" multiple="multiple"
							class="input_sel" style="width: 254px; height: 180px;"
							onchange="removeSelectedCategory()">
							<?php foreach( $this->item->selectedCategories as $selectedCategory){?>
									<option value="<?php echo $selectedCategory->id ?>"><?php echo $selectedCategory->name ?></option>
							<?php 
							} 
							?>
						</select>
						<div class="clear"></div>
					</div>
					
					<div class="detail_box">
						<div  class="form-detail req"></div>
						<label for="subcat_main_id"><?php echo JText::_('LNG_MAIN_SUBCATEGORY');?></label>
						<div class="clear"></div>
						<select class="input_sel" name="mainSubcategory" id="mainSubcategory">
						<?php foreach( $this->item->selectedCategories as $selectedCategory){?>
									<option value="<?php echo $selectedCategory->id ?>" <?php echo $selectedCategory->id == $this->item->mainSubcategory ? "selected":"" ; ?>><?php echo $selectedCategory->name ?></option>
							<?php } ?> 
						</select>
						<div class="clear"></div>
						<span class="error_msg" id="frmMainSubcategory_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					</div>
				</div>
			</fieldset>
			
			<fieldset  class="boxed">
				<div class="form-box">
					<h2> <?php echo JText::_('LNG_ADD_LOGO');?> (<?php echo JText::_('LNG_OPTIONAL');?>)</h2>
					<div>
						<?php echo JText::_('LNG_ADD_LOGO_TEXT');?>									
					</div>			
					<div class="form-upload-elem">
						<div class="form-upload">
							<label class="optional" for="logo"><?php echo JText::_("LNG_SELECT_IMAGE_TYPE") ?>.</label>
								<p class="hint">(<?php echo JText::_('LNG_LOGO_MAX_SIZE');?>).</p>
								<input type="hidden" name="logoLocation" id="logoLocation" value="<?php echo $this->item->logoLocation?>">
								<input type="hidden" id="MAX_FILE_SIZE" value="2097152" name="MAX_FILE_SIZE">
								<input type="file" id="uploadLogo" name="uploadLogo" size="50">		
								<!-- div class="upload-buttons" id="uploadButtons">
									<div class="floatleft">
										<input type="text" name="logoUpload" class="" id="logoUpload">
										<ul class="errors dn" id="uploadErrors">
										</ul>
									</div>
									<div class="button-container">
										<p id="uploadBrowse" class="">
											<button class="button small gray"><span><span>Browse</span></span></button>
										</p>							
										<p id="uploadChange" class="">
											<button class="button small gray"><span><span>Change logo</span></span></button>
										</p>
										<p id="uploadSuppress">
											<button class="button small gray"><span><span>Remove</span></span></button>
										</p>
									</div>
									<div class="clear"></div>
								</div-->
								<div class="clear"></div>
						</div>					
						<div class="info">
							<div class="info-box">
									<?php echo JText::_('LNG_ADD_LOGO_CONTINUE');?> 
							</div>
						</div>
					</div>
					<div class="picture-preview" id="picture-preview">
						
						<?php
							if(isset($this->item->logoLocation)){
								echo "<img src='".IMAGE_BASE_PATH.$this->item->logoLocation."'/>";
							}
						?>
					</div>			
					<div class="clear"></div>
					<span class="error_msg" id="frmCompanyName_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
				</div>
				
			</fieldset>
		
			
			<fieldset class="boxed">

				<h2> <?php echo JText::_('LNG_COMPANY_DETAILS');?></h2>
				<p><?php echo JText::_('LNG_DISPLAY_INFO_TXT');?></p>
				<div class="form-box">
					<div class="detail_box">
						<div  class="form-detail req"></div>
						<label for="address_id"><?php echo JText::_('LNG_ADDRESS')?></label> 
						<input type="text"
							name="address" id="address_id" class="input_txt"
							value="<?php echo $this->item->address ?>">
						<div class="clear"></div>
						<span class="error_msg" id="frmAddress_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					</div>
					
					<div class="detail_box">
						<div  class="form-detail req"></div>
						<label for="countryId"><?php echo JText::_('LNG_COUNTRY')?> </label>
						<div class="clear"></div>
						<select class="input_sel" name="countryId" id="countryId" readonly="readonly">
								<option value=''></option>
								<?php
								//$country->country_id = 184; //default romania
								foreach( $this->item->countries as $country )
								{
								?>
								<option <?php echo $this->item->countryId==$country->country_id? "selected" : ""?> 
									value='<?php echo $country->country_id?>'
								>
									<?php echo $country->country_name ?>
								</option>
								<?php
								}
								?>
							?>
						</select>
						<div class="clear"></div>
						<span class="error_msg" id="frmCountry_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					</div>

					<div class="detail_box">
						<div  class="form-detail req"></div>
						<label for="city_id"><?php echo JText::_('LNG_CITY')?> </label> <input class="input_txt"
							type="text" name="city"  id="city_id" value="<?php echo $this->item->city ?>">
						<div class="clear"></div>
						<span class="error_msg" id="frmCity_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					</div>
			
					<div class="detail_box" id="districtContainer">
						<div  class="form-detail req"></div>
						
						<label for="district_id"><?php echo JText::_('LNG_COUNTY')?> </label> <input class="input_sel"
							name="county" id="county" value="<?php echo $this->item->county ?>" />
						<div class="clear"></div>
						<span class="error_msg" id="frmDistrict_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					</div>
					
					<div class="detail_box">
						<label for="city_id"><?php echo JText::_('LNG_LATITUDE')?> </label> 
						<p class="small"><?php echo JText::_('LNG_MAP_INFO')?></p>
						<input class="input_txt"
							type="text" name="latitude" id="latitude" value="<?php echo $this->item->latitude ?>">
						<div class="clear"></div>
					</div>
	
					<div class="detail_box">
						<label for="city_id"><?php echo JText::_('LNG_LONGITUDE')?> </label>
						<p class="small"><?php echo JText::_('LNG_MAP_INFO')?></p>
						<input class="input_txt"
							type="text" name="longitude" id="longitude" value="<?php echo $this->item->longitude ?>">
						<div class="clear"></div>
					</div>
					
					<div id="map-container">
						<div id="company_map">
						</div>
					</div>
				</div>
			</fieldset>
			
			<fieldset class="boxed">

				<h2> <?php echo JText::_('LNG_COMPANY_CONTACT_INFORMATION');?></h2>
				<p> <?php echo JText::_('LNG_COMPANY_CONTACT_INFORMATION_TEXT');?>.</p>
				<div class="form-box">
					<div class="detail_box">
						<div  class="form-detail req"></div>
						<label for="phone"><?php echo JText::_('LNG_TELEPHONE')?></label> 
						<input type="text"	name="phone" id="phone" class="input_txt"
							value="<?php echo $this->item->phone ?>">
						<div class="clear"></div>
						<span class="error_msg" id="frmPhone_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					</div>
					<div class="detail_box">
						<div  class="form-detail req"></div>
						<label for="email"><?php echo JText::_('LNG_EMAIL')?></label> 
						<input type="text"
							name="email" id="email" class="input_txt"
							value="<?php echo $this->item->email ?>">
							<div class="description">e.g. office@site.com</div>
						<div class="clear"></div>
						<span class="error_msg" id="frmEmail_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					</div>
					<div class="detail_box">
						<label for="fax"><?php echo JText::_('LNG_FAX')?></label> 
						<input type="text"
							name="fax" id="fax" class="input_txt"
							value="<?php echo $this->item->fax ?>">				
						<div class="clear"></div>
						<span class="error_msg" id="frmFax_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
					</div>
				</div>
			</fieldset>
			
			
			<fieldset class="boxed">
				<h2> <?php echo JText::_('LNG_COMPANY_PICTURES');?></h2>
				<p> <?php echo JText::_('LNG_COMPANY_PICTURE_INFORMATION_TEXT');?>.</p>
				<input type='button' name='btn_removefile' id='btn_removefile' value='x' style='display:none'>
				<input type='hidden' name='crt_pos' id='crt_pos' value=''>
				<input type='hidden' name='crt_path' id='crt_path' value=''>
					<TABLE class='picture-table' align=left border=0>
						<TR>
							<TD align=left class="key"><?php echo JText::_('LNG_PICTURES'); ?>:</TD>
							<TD>
								<TABLE class="admintable" align=center  id='table_company_pictures' name='table_company_pictures' >
									<?php
									$pos = 0;
									foreach( $this->item->pictures as $picture )
									{
									?>
									<TR>
										<TD align=left>
											<textarea cols=50 rows=2 name='company_picture_info[]' id='company_picture_info'><?php echo $picture['company_picture_info']?></textarea>
										</TD>
										<td align=center>
											<img class='img_picture_company' src='<?php echo JURI::root() ."administrator/components/".getComponentName().$picture['company_picture_path']?>'/>
											<BR>
											<?php echo basename($picture['company_picture_path'])?>
											<input type='hidden' 
												value='<?php echo $picture['company_picture_enable']?>' 
												name='company_picture_enable[]' 
												id='company_picture_enable'
											>
											<input type='hidden' 
												value='<?php echo $picture['company_picture_path']?>' 
												name='company_picture_path[]' 
												id='company_picture_path'
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
															jQuery('#crt_path').val('<?php echo $picture['company_picture_path']?>');
															jQuery('#btn_removefile').click();
														"
					
											/>
										</td>
										<td align=center>
											<img class='btn_picture_status' 
												src='<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/".($picture['company_picture_enable'] ? 'checked' : 'unchecked').".gif"?>'
												onclick =  " 
															var form 		= document.adminForm;
															var v_status  	= null;
															if( form.elements['company_picture_enable[]'].length == null )
															{
																v_status  = form.elements['company_picture_enable[]'];
															}
															else
															{
																v_status  = form.elements['company_picture_enable[]'][<?php echo $pos ?>];
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
							<TD colspan="2">
								<?php echo JText::_('LNG_PLEASE_CHOOSE_A_FILE'); ?> <input name="uploadfile" id="uploadfile" size="50" type="file" />
								
							</TD>
						</TR>
					</TABLE>
			</fieldset>
			
			<fieldset class="boxed">
				<h2> <?php echo JText::_('LNG_COMPANY_VIDEOS');?></h2>
				<p> <?php echo JText::_('LNG_COMPANY_VIDEO_INFORMATION_TEXT');?>.</p>
				<div class="form-box">
					<div id="video-container">  
						<?php
						if(count($this->item->videos) == 0){?>
							<div class="detail_box" id="detailBox0">
								<label for="video1"><?php echo JText::_('LNG_VIDEO')?></label> 
								<input type="text"
									name="videos[]" id="video1" class="input_txt"	value="">
								<img height="12px" align="left" width="12px" 
									src="<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/del_icon.png"?>" alt="Delete video" onclick="removeRow('detailBox0')" style="cursor: pointer; margin: 3px;">
								<div class="clear"></div>
							</div>
						<?php } ?> 
						
						<?php 
							$index = 0;
							if(count($this->item->videos)>0)
							foreach($this->item->videos as $video){?>
							<div class="detail_box" id="detailBox<?php echo $index ?>">
								<label for="<?php echo $video->id?>"><?php echo JText::_('LNG_VIDEO')?></label> 
								<input type="text"
									name="videos[]" id="<?php echo $video->id?>" class="input_txt"
									value="<?php echo $video->url ?>">
								<img height="12px" align="left" width="12px" 
									src="<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/del_icon.png"?>" alt="Delete video" onclick="removeRow('detailBox<?php echo $index++; ?>')" style="cursor: pointer; margin: 3px;">
								<div class="clear"></div>
							</div>
						<?php } ?>
					</div>
					<a href="javascript:void(0);" onclick="addVideo()"><?php echo JText::_('LNG_ADD_VIDEO')?></a>
				</div>
			</fieldset>
			
			<?php  if(!$isProfile) { ?>
				<fieldset class="boxed">
	
					<h2> <?php echo JText::_('LNG_COMPANY_USER');?></h2>
					<p>User information</p>
					<div class="form-box">
						<div class="detail_box">
							<label for="userId"><?php echo JText::_('LNG_USERID')?></label> 
							<input type="text"
								name="userId" id="userId" class="input_txt"
								value="<?php echo $this->item->userId ?>">
							<div class="clear"></div>
						<span class="error_msg" id="frmCompanyUser_error_msg" style="display: none;"><?php echo JText::_('LNG_REQUIRED_FIELD')?></span>
						</div>
					</div>
				</fieldset>
			<?php  } ?>
		<?php  if($isProfile) { ?>
		<div class="buttons">
		
			<span class="button">
				<button type="button" value="logout" onclick="saveCompanyInformation()" href="javascript:void(0)"><?php echo JText::_('LNG_SAVE')?></button>
			</span>
		
			<span class="button gray">
				<button type="button" value="logout" onclick="cancel()" href="javascript:void(0)"><?php echo JText::_('LNG_CANCEL')?></button>
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
				
			jQuery("#selectedSubcategories").each(function(){ 
				jQuery("#selectedSubcategories option").attr("selected","selected"); 
			});


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
			jQuery("#selectedSubcategories").each(function(){ 
				jQuery("#selectedSubcategories option").attr("selected","selected"); 
			});
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
			
			if( !validateField( form.elements['name'], 'string', false, null ) ){
				jQuery("#frmCompanyName_error_msg").show();
				if(!isError)
					jQuery("#name").focus();
				isError = true;
			}

			if( !validateField( form.elements['comercialName'], 'string', false, null ) ){
				jQuery("#frmCompanyComercialName_error_msg").show();
				if(!isError)
					jQuery("#comercialName").focus();
				isError = true;
			}

			if( !validateField( form.elements['taxCode'], 'string', false, null ) ){
				jQuery("#frmTaxCode_error_msg").show();
				if(!isError)
					jQuery("#taxCode").focus();
				isError = true;
			}
			
			if( !validateField( form.elements['registrationCode'], 'string', false, null ) ){
				jQuery("#frmRegistrationCode_error_msg").show();
				if(!isError)
					jQuery("#registrationCode").focus();
				isError = true;
			}

			if(!jQuery("#companyTypes").val()){
				jQuery("#frmCompanyType_error_msg").show();
				if(!isError)
					jQuery("#companyTypes").focus();
				isError = true;
			}
			
			if( !validateField( form.elements['description'], 'string', false, null ) ){
				jQuery("#frmDescription_error_msg").show();
				if(!isError)
					jQuery("#description").focus();
				isError = true;
			}

			if( !validateField( form.elements['typeId'], 'string', false, null ) ){
				jQuery("#frmTypeId_error_msg").show();
				if(!isError)
					jQuery("#typeId").focus();
				isError = true;
			}
			if( !validateField( form.elements['address'], 'string', false, null ) ){
				jQuery("#frmAddress_error_msg").show();
				if(!isError)
					jQuery("#address_id").focus();
				isError = true;
			}
			/*
			if( !validateField( form.elements['county'], 'string', false,null ) ){
				jQuery("#frmDistrict_error_msg").show();
				if(!isError)
					jQuery("#county").focus();
				isError = true;
			}*/
			if( !validateField( form.elements['city'], 'string', false, null ) ){
				jQuery("#frmCity_error_msg").show();
				if(!isError)
					jQuery("#city_id").focus();
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

			if(typeof isProfile === 'undefined')
				if( !validateField( form.elements['userId'], 'numeric', false, null ) ){
					jQuery("#frmCompanyUser_error_msg").show();
					if(!isError)
						jQuery("#userId").focus();
					isError = true;
				}

			
			if(!jQuery("#mainSubcategory").val()){
					jQuery("#frmMainSubcategory_error_msg").show();
					if(!isError)
						jQuery("#mainSubcategory").focus();
					isError = true;
			}
			
			return isError;
			
		}
	</script>
	<input type="hidden" name="option" value="<?php echo getComponentName()?>" /> 
	<input type="hidden"name="task" id="task" value="" /> 
	<input type="hidden" name="companyId" value="<?php echo $this->item->id ?>" /> 
	<input type="hidden" name="view" value="<?php echo JRequest::getCmd('view', 'managecompanies')?>" />
	
	<?php if($isProfile){ ?>
		<input type="hidden" id="userId" name="userId" value="<?php echo $this->item->userId? $this->item->userId : $user->id ?>" />
	<?php }else{ ?>
		
	<?php }?>
	<?php echo JHTML::_( 'form.token' ); ?>
	 
</form>
</div>

<script>
	jQuery(document).ready(function(){
		jQuery('#uploadLogo').change(function() {
				var fisRe 	= /^.+\.(jpg|bmp|gif|png)$/i;
				var path = jQuery('#uploadLogo').val();
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
				
				jQuery(this).upload('<?php echo $baseUrl?>components/<?php echo getComponentName()?>/assets/upload.php?t=<?php echo strtotime('now')?>&picture_type=<?php echo PICTURE_TYPE_LOGO?>&_root_app=<?php echo urlencode(JPATH_COMPONENT_ADMINISTRATOR)?>&_target=<?php echo urlencode(COMPANY_PICTURES_PATH.'logos/')?>', function(responce) 
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
																													setUpLogo(
																																"<?php echo COMPANY_PICTURES_PATH.'logos/'?>" + jQuery(this).attr("path"),
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
			
			jQuery(this).upload('<?php echo $baseUrl?>components/<?php echo getComponentName()?>/assets/upload.php?t=<?php echo strtotime('now')?>&picture_type=<?php echo PICTURE_TYPE_COMPANY?>&_root_app=<?php echo urlencode(JPATH_COMPONENT_ADMINISTRATOR)?>&_target=<?php echo urlencode(COMPANY_PICTURES_PATH.($this->item->id+0).'/')?>', function(responce) 
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
																															"<?php echo COMPANY_PICTURES_PATH.($this->item->id +0).'/'?>" + jQuery(this).attr("path"),
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
					jQuery( this ).upload('<?php echo JURI::base()?>components/<?php echo getComponentName()?>/assets/remove.php?_root_app=<?php echo urlencode(JPATH_COMPONENT_ADMINISTRATOR)?>&_filename='+ path + '&_pos='+pos, function(responce) 
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

function setUpLogo(path, name){
	<?php 
			$baseUrl = JURI::base();
			if(strpos ($baseUrl,'administrator') ===  false)
				$baseUrl = $baseUrl.'administrator/';
		?>
	jQuery("#logoLocation").val(path);
	var img_new		 	= document.createElement('img');
	img_new.setAttribute('src', "<?php echo $baseUrl ."components/".getComponentName()?>" + path );
	img_new.setAttribute('class', 'company-logo');
	img_new.setAttribute('alt', '<?php echo JText::_('LNG_COMPANY_LOGO') ?>');
	img_new.setAttribute('title', '<?php echo JText::_('LNG_COMPANY_LOGO') ?>');
	jQuery("#picture-preview").empty();
	jQuery("#picture-preview").append(img_new);
}


function addPicture(path, name)
{
	var tb = document.getElementById('table_company_pictures');
	if( tb==null )
	{
		alert('Undefined table, contact administrator !');
	}
	
	var td1_new			= document.createElement('td');  
	td1_new.style.textAlign='left';
	var textarea_new 	= document.createElement('textarea');
	textarea_new.setAttribute("name","company_picture_info[]");
	textarea_new.setAttribute("id","company_picture_info");
	textarea_new.setAttribute("cols","50");
	textarea_new.setAttribute("rows","2");
	td1_new.appendChild(textarea_new);
	
	var td2_new			= document.createElement('td');  
	td2_new.style.textAlign='center';
	var img_new		 	= document.createElement('img');
	img_new.setAttribute('src', "<?php echo JURI::root() ."administrator/components/".getComponentName()?>" + path );
	img_new.setAttribute('class', 'img_picture_company');
	td2_new.appendChild(img_new);
	var span_new		= document.createElement('span');
	span_new.innerHTML 	= "<BR>"+name;
	td2_new.appendChild(span_new);
	
	var input_new_1 		= document.createElement('input');
	input_new_1.setAttribute('type',		'hidden');
	input_new_1.setAttribute('name',		'company_picture_enable[]');
	input_new_1.setAttribute('id',			'company_picture_enable[]');
	input_new_1.setAttribute('value',		'1');
	td2_new.appendChild(input_new_1);
	
	var input_new_2		= document.createElement('input');
	input_new_2.setAttribute('type',		'hidden');
	input_new_2.setAttribute('name',		'company_picture_path[]');
	input_new_2.setAttribute('id',			'company_picture_path[]');
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
												if( form.elements['company_picture_enable[]'].length == null )
												{
													v_status  = form.elements['company_picture_enable[]'];
												}
												else
												{
													pos = this.id;
													var tb = document.getElementById('table_company_pictures');
													if( pos >= tb.rows.length )
														pos = tb.rows.length-1;
													v_status  = form.elements['company_picture_enable[]'][ pos ];
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
	var tb = document.getElementById('table_company_pictures');
	//alert(tb);
	if( tb==null )
	{
		alert('Undefined table, contact administrator !');
	}
	
	if( pos >= tb.rows.length )
		pos = tb.rows.length-1;
	tb.deleteRow( pos );

}


function addVideo(){
	
	var count = jQuery("#video-container").children().length+1;
	id=0;
	var outerDiv = document.createElement('div');
	outerDiv.setAttribute('class',		'detail_box');
	outerDiv.setAttribute('id',		'detailBox'+count);

	var newLabel = document.createElement('label');
	newLabel.setAttribute("for",		id);
	newLabel.innerHTML="<?php echo JText::_('LNG_VIDEO')?>";
	
	
	var newInput = document.createElement('input');
	newInput.setAttribute('type',		'text');
	newInput.setAttribute('name',		'videos[]');
	newInput.setAttribute('id',			id);
	newInput.setAttribute('class',		'input_txt');
	
	
	var img_del		 	= document.createElement('img');
	img_del.setAttribute('src', "<?php echo JURI::root() ."administrator/components/".getComponentName()."/assets/img/del_icon.png"?>");
	img_del.setAttribute('alt', 'Delete option');
	img_del.setAttribute('height', '12px');
	img_del.setAttribute('width', '12px');
	img_del.setAttribute('align', 'left');
	img_del.setAttribute('onclick', 'removeRow("detailBox'+count+'")');
	img_del.setAttribute('style', "cursor: pointer; margin:3px;");

	var clearDiv = document.createElement('div');
	clearDiv.setAttribute('class',		'clear');
	
	outerDiv.appendChild(newLabel);
	outerDiv.appendChild(newInput);
	outerDiv.appendChild(img_del);
	outerDiv.appendChild(clearDiv);
	
	var facilityContainer =jQuery("#video-container");
	facilityContainer.append(outerDiv);
}

function removeRow(id){
	jQuery('#'+id).remove();
}


var map;
var markers = [];

function initialize() {
	<? if(!isset($this->item->latitude)) $this->item->latitude = -27.463423460948178;
    if(!isset($this->item->longitude)) $this->item->longitude = 153.04444313049316; ?>
  var haightAshbury = new google.maps.LatLng(<?php echo  $this->item->latitude ?>, <?php echo  $this->item->longitude ?>);
  var mapOptions = {
    zoom: 15,
    center: haightAshbury,
    mapTypeId: google.maps.MapTypeId.TERRAIN
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

// Add a marker to the map and push to the array.
function addMarker(location) {
 document.getElementById("latitude").value = location.lat();
 document.getElementById("longitude").value = location.lng();

  marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the overlays from the map, but keeps them in the array.
function clearOverlays() {
  setAllMap(null);
}

// Shows any overlays currently in the array.
function showOverlays() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteOverlays() {
  clearOverlays();
  markers = [];
}

	function loadScript() {
	  var script = document.createElement("script");
	  script.type = "text/javascript";
	  script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
	  document.body.appendChild(script);
	}
	  
	window.onload = loadScript;

</script>


