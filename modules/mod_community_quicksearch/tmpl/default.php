<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
defined('_JEXEC') or die('Restricted access');
?>
<div class="cModule cFrontPage-Search">

	<div class="app-box-content">
		<form name="search" id="cFormSearch" method="get" action="<?php echo CRoute::_('index.php?option=com_community&view=search');?>">

		  <input type="text" class="input-block-level" id="keyword" name="q" />
			<input type="submit" name="submit" value="<?php echo JText::_('COM_COMMUNITY_SEARCH')?>" class="btn btn-primary" />
			<input type="hidden" name="option" value="com_community" />
			<input type="hidden" name="view" value="search" />
		</form>
	</div>
	<div class="app-box-footer">
        <a href="<?php echo CRoute::_('index.php?option=com_community&view=search&task=advancesearch'); ?>"><?php echo JText::_('COM_COMMUNITY_TITLE_CUSTOM_SEARCH'); ?></a>
    </div>
</div>