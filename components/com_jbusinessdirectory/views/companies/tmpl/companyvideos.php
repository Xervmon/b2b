<?php /*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div class='video-container'>
		<ul class="">
			<?php 
				if( isset($this->videos) && count( $this->videos)>0){
					foreach( $this->videos as $video ){
					 	if(isset($video->url) && strlen($video->url)>3)	{
						?>
							<li>
								<?php echo $video->url?>
							</li>
						<?php
						 }
					}
				}else{
					echo JText::_("LNG_NO_COMPANY_VIDEO");
				}
			?>
		</ul>
	<div class="clear"></div>
</div>
			
			
		
	