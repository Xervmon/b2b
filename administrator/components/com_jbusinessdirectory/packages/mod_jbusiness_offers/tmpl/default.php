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
?>
<div class="latest-offers<?php echo $moduleclass_sfx; ?>">
<?php if(!empty($items)){ ?>
<ul >
<?php foreach ($items as $offer){  ?>
	<li>
		<div class="offer-container">
			<div class="offer-image">
				<a href="<?php echo $offer->link ?>">
					<img  alt="<?php ?>"
					src="<?php echo JURI::root()."/".PICTURES_PATH.$offer->picture_path?>"> </a>
			</div>
			<div class="offer-title">
				<a
					title="<?php echo $offer->subject?>"
					href="<?php echo $offer->link ?>"><?php echo $offer->subject?>
					</a>
			</div>
		</div>
	</li>
<?php } ?>
</ul>
<?php } ?>
<div class="clear"></div>
</div>