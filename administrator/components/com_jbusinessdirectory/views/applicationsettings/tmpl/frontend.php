<div class="width-100">
		<fieldset class='adminform'>
			<legend><?php echo JText::_('LNG_FRONT_END_STYLE'); ?></legend>
			<TABLE class='admintable'  width=100%>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_COMPANY_VIEW")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "company_view"
							id			= "company_view"
							value		= '1'
							<?php echo $this->item->company_view==1? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_TABS_STYLE_1'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "company_view"
							id			= "company_view"
							value		= '2'
							<?php echo $this->item->company_view==2? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_TABS_STYLE_2'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "company_view"
							id			= "company_view"
							value		= '3'
							<?php echo $this->item->company_view==3? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_ONE_PAGE'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "company_view"
							id			= "company_view"
							value		= '4'
							<?php echo $this->item->company_view==4? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_STYLE_4'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_CATEGORIES_VIEW")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "category_view"
							id			= "category_view"
							value		= '1'
							<?php echo $this->item->category_view==1? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_ACCORDION'); ?>
						
						&nbsp;
						<input 
							type		= "radio"
							name		= "category_view"
							id			= "category_view"
							value		= '2'
							<?php echo $this->item->category_view==2? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_BOXES'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "category_view"
							id			= "category_view"
							value		= '3'
							<?php echo $this->item->category_view==3? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_SIMPLE'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_SEARCH_RESULT_VIEW")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "search_result_view"
							id			= "search_result_view"
							value		= '1'
							<?php echo $this->item->search_result_view==1? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_STYLE_1'); ?>
						
						&nbsp;
						<input 
							type		= "radio"
							name		= "search_result_view"
							id			= "search_result_view"
							value		= '2'
							<?php echo $this->item->search_result_view==2? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_STYLE_2'); ?>
						
						&nbsp;
						<input 
							type		= "radio"
							name		= "search_result_view"
							id			= "search_result_view"
							value		= '3'
							<?php echo $this->item->search_result_view==3? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_STYLE_3'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "search_result_view"
							id			= "search_result_view"
							value		= '4'
							<?php echo $this->item->search_result_view==4? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_STYLE_4'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_OFFER_SEARCH_RESULT_GRID_VIEW")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "offer_search_results_grid_view"
							id			= "offer_search_results_grid_view"
							value		= '0'
							<?php echo $this->item->offer_search_results_grid_view==0? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_STYLE_1'); ?>
						
						&nbsp;
						<input 
							type		= "radio"
							name		= "offer_search_results_grid_view"
							id			= "offer_search_results_grid_view"
							value		= '1'
							<?php echo $this->item->offer_search_results_grid_view==1? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_STYLE_2'); ?>
					
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" >
						
							<?php echo JText::_('LNG_NR_IMAGES_SLIDE'); ?>:
					
					</td>
					<td align="left" nowrap>
						<input type='text' size=50 maxlength=255  id='nr_images_slide' name = 'nr_images_slide' value='<?php echo $this->item->nr_images_slide?>'>
					</td> 
				</TR>
				<TR>
					<td width="10%" align="left" class="key" >	
							<?php echo JText::_('LNG_MENU_ITEM_ID'); ?>:
					</td>
					<td align="left" nowrap>
						<input type='text' size=50 maxlength=255  id='menu_item_id' name = 'menu_item_id' value='<?php echo $this->item->menu_item_id?>'>
					</td> 
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_RATINGS")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_ratings"
							id			= "enable_ratings"
							value		= '0'
							<?php echo $this->item->enable_ratings==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_ratings"
							id			= "enable_ratings"
							value		= '1'
							<?php echo $this->item->enable_ratings==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

							
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_REVIEWS")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_reviews"
							id			= "enable_reviews"
							value		= '0'
							<?php echo $this->item->enable_reviews==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_reviews"
							id			= "enable_reviews"
							value		= '1'
							<?php echo $this->item->enable_reviews==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_REVIEWS_USERS_ONLY")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_reviews_users"
							id			= "enable_reviews_users"
							value		= '0'
							<?php echo $this->item->enable_reviews_users==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_reviews_users"
							id			= "enable_reviews_users"
							value		= '1'
							<?php echo $this->item->enable_reviews_users==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_NUMBERING")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_numbering"
							id			= "enable_numbering"
							value		= '0'
							<?php echo $this->item->enable_numbering==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_numbering"
							id			= "enable_numbering"
							value		= '1'
							<?php echo $this->item->enable_numbering==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

							
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_SHOW_SEARCH_MAP")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "show_search_map"
							id			= "show_search_map"
							value		= '0'
							<?php echo $this->item->show_search_map==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "show_search_map"
							id			= "show_search_map"
							value		= '1'
							<?php echo $this->item->show_search_map==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

							
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_SHOW_DETAILS_ONLY_FOR_USERS")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "show_details_user"
							id			= "show_details_user"
							value		= '0'
							<?php echo $this->item->show_details_user==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "show_details_user"
							id			= "show_details_user"
							value		= '1'
							<?php echo $this->item->show_details_user==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

							
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR style="display: none">
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_SEARCH_RESULT_DESCRIPTION")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "show_search_description"
							id			= "show_search_description"
							value		= '0'
							<?php echo $this->item->show_search_description==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "show_search_description"
							id			= "show_search_description"
							value		= '1'
							<?php echo $this->item->show_search_description==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_SEARCH_FILTER")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_search_filter"
							id			= "enable_search_filter"
							value		= '0'
							<?php echo $this->item->enable_search_filter==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_search_filter"
							id			= "enable_search_filter"
							value		= '1'
							<?php echo $this->item->enable_search_filter==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_SEARCH_FILTER_OFFERS")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_search_filter_offers"
							id			= "enable_search_filter_offers"
							value		= '0'
							<?php echo $this->item->enable_search_filter_offers==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_search_filter_offers"
							id			= "enable_search_filter_offers"
							value		= '1'
							<?php echo $this->item->enable_search_filter_offers==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_SEARCH_FILTER_EVENTS")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "enable_search_filter_events"
							id			= "enable_search_filter_events"
							value		= '0'
							<?php echo $this->item->enable_search_filter_events==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "enable_search_filter_events"
							id			= "enable_search_filter_events"
							value		= '1'
							<?php echo $this->item->enable_search_filter_events==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>

				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_CAPTCHA")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "captcha"
							id			= "captcha"
							value		= '0'
							<?php echo $this->item->captcha==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "captcha"
							id			= "captcha"
							value		= '1'
							<?php echo $this->item->captcha==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_MAP_AUTO_SHOW")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "map_auto_show"
							id			= "map_auto_show"
							value		= '0'
							<?php echo $this->item->map_auto_show==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "map_auto_show"
							id			= "map_auto_show"
							value		= '1'
							<?php echo $this->item->map_auto_show==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ENABLE_CLAIM_BUSINESS")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "claim_business"
							id			= "claim_business"
							value		= '0'
							<?php echo $this->item->claim_business==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "claim_business"
							id			= "claim_business"
							value		= '1'
							<?php echo $this->item->claim_business==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_SHOW_CAT_DESCRIPTION")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "show_cat_description"
							id			= "show_cat_description"
							value		= '0'
							<?php echo $this->item->show_cat_description==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_NO'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "show_cat_description"
							id			= "show_cat_description"
							value		= '1'
							<?php echo $this->item->show_cat_description==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_YES'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_DEFAULT_SEARCH_VIEW")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "search_view_mode"
							id			= "search_view_mode"
							value		= '0'
							<?php echo $this->item->search_view_mode==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_LIST_MODE'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "search_view_mode"
							id			= "search_view_mode"
							value		= '1'
							<?php echo $this->item->search_view_mode==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_GRID_MODE'); ?>
					</td>
				</TR>
				<TR>
					<td width="10%" align="left" class="key" nowrap ><?php echo JText::_("LNG_ADDRESS_FORMAT")?> :</td>
					<td nowrap colspan=2 class="app-option">
						<input 
							type		= "radio"
							name		= "address_format"
							id			= "address_format"
							value		= '0'
							<?php echo $this->item->address_format==false? " checked " :""?>
							accesskey	= "N"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"

						/>
						<?php echo JText::_('LNG_AMERICAN'); ?>
						&nbsp;
						<input 
							type		= "radio"
							name		= "address_format"
							id			= "address_format"
							value		= '1'
							<?php echo $this->item->address_format==true? " checked " :""?>
							accesskey	= "Y"
							onmouseover	="this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	="this.style.cursor='default'"
						/>
						<?php echo JText::_('LNG_EUROPEAN'); ?>
					</td>
				</TR>
			</TABLE>
			<br/><br/><br/><br/>
		</fieldset>
</div>