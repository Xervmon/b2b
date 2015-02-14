<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/

defined('_JEXEC') or die();
?>
<div id="com-events-categories" class="app-box">
	<h3 class="app-box-header"><?php echo JText::_('COM_COMMUNITY_CATEGORIES');?></h3>
	<div class="app-box-content">
		<ul class="app-box-list for-menu cResetList">
			<li>
				<i class="com-icon-folder"></i>
				<?php if( $category->parent == COMMUNITY_NO_PARENT && $category->id == COMMUNITY_NO_PARENT ){ ?>
						<a href="<?php echo CRoute::_('index.php?option=com_community&view=events');?>"><?php echo JText::_( 'COM_COMMUNITY_EVENTS_ALL' ); ?> </a>
				<?php }else{ ?>
						<a href="<?php echo CRoute::_('index.php?option=com_community&view=events&task=display&categoryid=' . $category->parent ); ?>"><?php echo JText::_('COM_COMMUNITY_BACK_TO_PARENT'); ?></a>
				<?php }  ?>
			</li>
			<?php if( $categories ): ?>
				<?php foreach( $categories as $row ): ?>
				<li>
					<i class="com-icon-folder"></i>
					<a href="<?php echo CRoute::_('index.php?option=com_community&view=events&task=display&categoryid=' . $row->id ); ?>">
						<?php echo JText::_( $this->escape($row->name) ); ?>
					</a>
					<?php if(!empty($row->total)): ?><span class="label"><?php echo $row->total; ?></span><?php endif; ?>
				</li>
				<?php endforeach; ?>
			<?php else: ?>
					<li><?php echo JText::_('COM_COMMUNITY_GROUPS_CATEGORY_NOITEM'); ?></li>
			<?php endif; ?>
		</ul>
	</div>
</div>
