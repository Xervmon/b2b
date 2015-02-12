<div id="offer-list-view" class='offer-container <?php echo $fullWidth ?'full':'noClass' ?>' style="display:none">
	<ul class="offer-list">
	<?php 
		if(isset($this->offers) && count($this->offers)>0){
			foreach ($this->offers as $offer){ ?>
				<li>
					<div class="offer-box row-fluid">
						<div class="offer-img-container span3">
							<a class="offer-image"
								href="<?php echo JBusinessUtil::getofferLink($offer->id, $offer->alias) ?>">
								
								<?php if(isset($offer->picture_path) && $offer->picture_path!=''){?>
									<img  alt="<?php ?>" src="<?php echo JURI::root()."/".PICTURES_PATH.$offer->picture_path?>"> &nbsp;</a>
								<?php }else{?>
									<img title="<?php echo $offer->subject?>" alt="<?php echo $offer->subject?>" src="<?php echo JURI::root().PICTURES_PATH.'/no_image.jpg' ?>">
								<?php } ?>
						</div>
						<div class="offer-content span8">
							<div class="offer-subject">
								<a title="<?php echo $offer->subject?>"
									href="<?php echo JBusinessUtil::getofferLink($offer->id, $offer->alias) ?>"><?php echo $offer->subject?>
								</a>
							</div>
							<div class="offer-location">
								<span itemprop="address"><?php echo JBusinessUtil::getLocationTextOffer($offer)?></span>
							</div>
							<div class="offer-dates">
								<?php 
									echo  JBusinessUtil::getDateGeneralFormat($offer->startDate)." - ". JBusinessUtil::getDateGeneralFormat($offer->endDate);
								?>
							</div>
					
							<div class="offer-categories">
									<?php 
											$categoryIds = explode(',',$offer->categoryIds);
											$categoryNames = explode('#',$offer->categoryNames);
											$categoryAliases = explode('#',$offer->categoryAliases);
											for($i=0;$i<count($categoryIds);$i++){
												?>
													 <a rel="nofollow" href="<?php echo JBusinessUtil::getOfferCategoryLink($categoryIds[$i], $categoryAliases[$i]) ?>"><?php echo $categoryNames[$i]?><?php echo $i<(count($categoryIds)-1)? ',&nbsp;':'' ?> </a>
												<?php 
											}
										?>
							</div>
							
							<div class="offer-desciption">
								<?php echo JBusinessUtil::truncate($offer->short_description,300) ?>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</li>
			<?php }
		}else{
			echo JText::_("LNG_NO_OFFER_FOUND");
		} ?>
	</ul>
</div>