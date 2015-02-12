<?php

/**
-------------------------------------------------------------------------
briefcasefactory - Briefcase Factory 4.0.8
-------------------------------------------------------------------------
 * @author thePHPfactory
 * @copyright Copyright (C) 2011 SKEPSIS Consult SRL. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.thePHPfactory.com
 * Technical Support: Forum - http://www.thePHPfactory.com/forum/
-------------------------------------------------------------------------
*/

defined('_JEXEC') or die;

if ($this->folderLimit): ?>
  <div class="folder-size-limit">
    <div class="folder-size-percent"><?php echo FactoryText::sprintf('briefcase_folder_limit_status_percent_full', $this->folderSize > $this->folderLimit ? 100 : $this->folderSize * 100 / $this->folderLimit); ?></div>
    <?php echo FactoryText::sprintf('briefcase_folder_limit_status', JHtml::_('number.bytes', $this->folderSize), JHtml::_('number.bytes', $this->folderLimit)); ?>
  </div>
<?php endif; ?>
