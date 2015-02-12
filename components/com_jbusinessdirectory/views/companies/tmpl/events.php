<div class='events-container full'>
	<ul class="event-list">
	<?php 
		if(isset($this->events) && count($this->events)>0){
			foreach ($this->events as $event){ ?>
				<li>
					<div class="event-box">
						<div class="event-img-container">
							<a class="event-image"
								href="<?php echo JBusinessUtil::getEventLink($event->id, $event->alias) ?>">
								<img width="96" alt="<?php ?>"
								src="<?php echo JURI::root()."/".PICTURES_PATH.$event->picture_path?>"> &nbsp;</a>
						</div>
						<div class="event-content">
							<div class="event-subject">
								<a
									title="<?php echo $event->name?>"
									href="<?php echo JBusinessUtil::getEventLink($event->id, $event->alias) ?>"><?php echo $event->name?>
									</a>
							</div>
							<div class="event-location">
								<?php echo $event->location?>&nbsp;-&nbsp;<?php echo JBusinessUtil::getDateGeneralFormat($event->start_date)." ".JText::_("LNG_UNTIL")." ".JBusinessUtil::getDateGeneralFormat($event->end_date) ?>
							</div>
							<div class="event-type">
								<?php echo $event->eventType?>
							</div>
							<div class="event-desciption">
								<?php echo JBusinessUtil::truncate($event->description,250)?>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</li>
			<?php }
		}else{
			echo JText::_("LNG_NO_EVENT_FOUND");
		} ?>
	</ul>
</div>
		
<div class="clear"></div>	