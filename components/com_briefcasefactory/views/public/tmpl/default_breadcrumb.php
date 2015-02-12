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

<ul class="breadcrumb">
  <?php foreach ($this->breadcrumbs as $this->path): ?>
    <li>
      <?php if ($this->path->id != $this->parent->id): ?>
        <a href="<?php echo FactoryRoute::view($this->getName() . '&parent=' . $this->path->id); ?>">
          <?php echo $this->path->title ? $this->path->title : JText::_('JGLOBAL_ROOT'); ?></a>
        <span class="divider">/</span>
      <?php else: ?>
        <?php echo $this->path->title ? $this->path->title : JText::_('JGLOBAL_ROOT'); ?>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ul>
