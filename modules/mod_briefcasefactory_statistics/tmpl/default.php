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

?>

<ul class="mod_briefcasefactory_statistics<?php echo $moduleclass_sfx; ?>">
  <?php if (false !== $total): ?>
    <li><?php echo JText::sprintf('MOD_BRIEFACASEFACTORY_STATISTICS_TOTAL_FILES', $total); ?></li>
  <?php endif; ?>

  <?php if (false !== $public): ?>
    <li><?php echo JText::sprintf('MOD_BRIEFACASEFACTORY_STATISTICS_PUBLIC_FILES', $public); ?></li>
  <?php endif; ?>
</ul>
