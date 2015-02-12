<div class="width-600">
<fieldset class="adminform">
	<legend><?php echo JText::_('LNG_COMPANY'); ?></legend>

	<table class="admintable"  width=100%>
		<TR>
			<td width="10%" align="left" class="key" nowrap >
				<label for="enable_reservation">
					<?php echo JText::_('LNG_NAME'); ?>:
				</label>
			</td>
			<td align="left" nowrap>
				<input type='text' size=50 maxlength=255  id='company_name' name = 'company_name' value='<?php echo $this->item->company_name?>'>
			</TD> 
		</TR>
		<TR>
			<td width="10%" align="left" class="key" nowrap >
				<label for="enable_reservation">
					<?php echo JText::_('LNG_EMAIL'); ?>:
				</label>
			</td>
			<td align="left" nowrap>
				<input type='text' size=50 maxlength=255  id='company_email' name = 'company_email' value='<?php echo $this->item->company_email?>'>
			</TD> 
		</TR>
		
	</table>
</fieldset>

<fieldset class="adminform">
			<legend><?php echo JText::_('LNG_GENERAL_SETTINGS'); ?></legend>

			<table class="admintable" width=100%>
				
				<TR >
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_CURRENCY")?> :</TD>
					<TD nowrap width="15%">
						<select
							id		= 'currency_id'
							name	= 'currency_id'
							
						>
							<?php
							for($i = 0; $i <  count( $this->item->currencies ); $i++)
							{
								$currency = $this->item->currencies[$i]; 
							?>
							<option value = '<?php echo $currency->currency_id?>' <?php echo $currency->currency_id==$this->item->currency_id? "selected" : ""?>> <?php echo $currency->currency_name?></option>
							<?php
							}
							?>
						</select>
					</TD>
					<TD nowrap>	
						<?php echo JText::_("LNG_SELECT_A_CURRENCY_FOR_THE_PRICES_DISPLAYED_IN_THE_RESERVATION_PROCESS")?>
					</TD>
				</TR>
				
				<tr>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_DATE_FORMAT")?> :</Td>
					<td width="15%">
						<select
							id		= 'date_format_id'
							name	= 'date_format_id'
							
						>
							<?php
							foreach ($this->item->dateFormats as $dateFormat)
							{
							?>
							<option value = '<?php echo $dateFormat->id?>' <?php echo $dateFormat->id==$this->item->date_format_id? "selected" : ""?>> <?php echo $dateFormat->name?></option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
				
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_PACKAGES")?> :</TD>
					<TD nowrap class="app-option">
					
						<input 
							type		= "radio"
							name		= "enable_packages"
							id			= "disable_packages"
							value		= '0'
							<?php echo $this->item->enable_packages==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_packages"
							id			= "enable_packages"
							value		= '1'
							<?php echo $this->item->enable_packages==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

							
						/>
						<?php echo JText::_('LNG_YES'); ?>
						
					</TD>
					<td>
						<div id="assign-packages" style="display:none">
							<span> <?php echo JText::_("LNG_UPDATE_COMPANIES_TO_PACKAGE") ?></span>
							<select name="package" class="inputbox input-medium">
								<option value="0"><?php echo JText::_("LNG_SELECT_PACKAGE") ?></option>
								<?php echo JHtml::_('select.options', $this->packageOptions, 'value', 'text',0);?>
							</select>
						</div>
					</td>
				</TR>
				
			
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_OFFERS")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_offers"
							id			= "enable_offers"
							value		= '0'
							<?php echo $this->item->enable_offers==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_offers"
							id			= "enable_offers"
							value		= '1'
							<?php echo $this->item->enable_offers==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
					<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_EVENTS")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_events"
							id			= "enable_events"
							value		= '0'
							<?php echo $this->item->enable_events==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_events"
							id			= "enable_events"
							value		= '1'
							<?php echo $this->item->enable_events==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
				
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_SEO")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_seo"
							id			= "enable_seo"
							value		= '0'
							<?php echo $this->item->enable_seo==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_seo"
							id			= "enable_seo"
							value		= '1'
							<?php echo $this->item->enable_seo==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_SHOW_PENDING_APPROVAL")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "show_pending_approval"
							id			= "show_pending_approval"
							value		= '0'
							<?php echo $this->item->show_pending_approval==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "show_pending_approval"
							id			= "show_pending_approval"
							value		= '1'
							<?php echo $this->item->show_pending_approval==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
				<TR style="display:none">
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ALLOW_MULTIPLE_COMPANIES_PER_USER")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "allow_multiple_companies"
							id			= "allow_multiple_companies"
							value		= '0'
							<?php echo $this->item->allow_multiple_companies==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "allow_multiple_companies"
							id			= "allow_multiple_companies"
							value		= '1'
							<?php echo $this->item->allow_multiple_companies==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
				<TR> 
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_LIMIT_CITIES")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "limit_cities"
							id			= "limit_cities"
							value		= '0'
							<?php echo $this->item->limit_cities==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "limit_cities"
							id			= "limit_cities"
							value		= '1'
							<?php echo $this->item->limit_cities==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
				
				<TR> 
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_METRIC")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "metric"
							id			= "metric"
							value		= '0'
							<?php echo $this->item->metric==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_KM'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "metric"
							id			= "metric"
							value		= '1'
							<?php echo $this->item->metric==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_MILES'); ?>
					</TD>
				</TR>
				
				<TR style="display:none"> 
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_USER_LOCATION")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "user_location"
							id			= "user_location"
							value		= '0'
							<?php echo $this->item->user_location==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "user_location"
							id			= "user_location"
							value		= '1'
							<?php echo $this->item->user_location==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
				<TR> 
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_SEARCH_FILTER")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "search_type"
							id			= "search_type"
							value		= '0'
							<?php echo $this->item->search_type==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_REGULAR'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "search_type"
							id			= "search_type"
							value		= '1'
							<?php echo $this->item->search_type==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_FACETED'); ?>
					</TD>
				</TR>
				<TR> 
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ZIPCODE_SEARCH_TYPE")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "zipcode_search_type"
							id			= "zipcode_search_type"
							value		= '0'
							<?php echo $this->item->zipcode_search_type==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_BY_DISTANCE'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "zipcode_search_type"
							id			= "zipcode_search_type"
							value		= '1'
							<?php echo $this->item->zipcode_search_type==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_BY_BUSINESS_ACTIVITY_RADIUS'); ?>
					</TD>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" >	
							<?php echo JText::_('LNG_MAX_PICTURES'); ?>:
					</td>
					<td align="left" nowrap>
						<input type='text' size=20 maxlength=20  id='max_pictures' name = 'max_pictures' value='<?php echo $this->item->max_pictures?>'>
					</td> 
				</TR>
				<TR>
					<td width="10%" align="left" class="key" >	
							<?php echo JText::_('LNG_MAX_VIDEOS'); ?>:
					</td>
					<td align="left" nowrap>
						<input type='text' size=20 maxlength=20  id='max_video' name = 'max_video' value='<?php echo $this->item->max_video?>'>
					</td> 
				</TR>
				
				<TR>
					<td width="10%" align="left" class="key" >	
							<?php echo JText::_('LNG_VAT'); ?>:
					</td>
					<td align="left" nowrap>
						<input type='text' size=20 maxlength=20  id='vat' name = 'vat' value='<?php echo $this->item->vat?>'> (%)
					</td> 
				</TR>
				<TR>
					<td width="10%" align="left" class="key" >	
							<?php echo JText::_('LNG_EXPIRATION_DAYS_NOTICE'); ?>:
					</td>
					<td align="left" nowrap>
						<input type='text' size=20 maxlength=20  id='expiration_day_notice' name = 'expiration_day_notice' value='<?php echo $this->item->expiration_day_notice?>'>
					</td> 
				</TR>
				
				<TR style="display:none"> 
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_DIRECT_PROCESSING")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "direct_processing"
							id			= "direct_processing"
							value		= '0'
							<?php echo $this->item->direct_processing==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "direct_processing"
							id			= "direct_processing"
							value		= '1'
							<?php echo $this->item->direct_processing==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_SHOW_SECONDARY_LOCATIONS")?> :</TD>
					<TD nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "show_secondary_locations"
							id			= "show_secondary_locations"
							value		= '0'
							<?php echo $this->item->show_secondary_locations==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "show_secondary_locations"
							id			= "show_secondary_locations"
							value		= '1'
							<?php echo $this->item->show_secondary_locations==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</TD>
				</TR>
			</table>
			<br/><br/><br/><br/>
		</fieldset>
		
<fieldset class="adminform">
	<legend><?php echo JText::_('LNG_TERMS_AND_CONDITIONS'); ?></legend>
	<table class="admintable"  width=100%>
		<TR>
			<td width="10%" align="left" class="key" nowrap >
				<label for="enable_reservation">
					<?php echo JText::_('LNG_TERMS_AND_CONDITIONS'); ?>:
				</label>
			</td>
			<td align="left">
				<?php 
					$editor = JFactory::getEditor();
					echo $editor->display('terms_conditions', $this->item->terms_conditions, '550', '200', '80', '10', false);
				?>
			</TD> 
		</TR>
	</table>
</fieldset>		
	</div>