<?php
/**
* @copyright	Copyright (C) 2009 - 2011 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
* Website		http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();

if(count($results) <=0) : ?> 
		<div class="text-warning">
			<?php echo XiText::_('COM_PAYPLANS_SEARCH_NO_RESULTS_FOUND'); ?>
		</div>
<?php else: ?>

<ul class="thumbnails">
			<?php foreach($results as $record) :?>
					
			<li class="thumbnail btn" title="<?php echo strip_tags($record['description']);?>">
				<span><?php echo (isset($record['title']))?($record['link']." :  ".$record['title']):$record['link']; ?></span>
			</li>

			<?php endforeach;?>
</ul>

<?php endif; 