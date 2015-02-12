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

if (!empty($list)) :?>
	<ul class="mod_briefcasefactory_files<?php echo $moduleclass_sfx; ?>">
	  <?php foreach ($list as $item) : ?>
	    <li><a href="<?php echo $item->link; ?>" class="hasTip" title="<?php echo $item->filename; ?>::<?php echo $item->description; ?>"><?php echo $item->title; ?></a></li>
	  <?php endforeach; ?>
  </ul>
<?php endif; ?>
