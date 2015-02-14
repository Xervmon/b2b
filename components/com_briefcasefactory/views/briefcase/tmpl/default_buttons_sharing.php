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

 <div class="btn-group">
    <a class="btn btn-small" href="#" onclick="return deletefun();">
      <i class="factory-icon-cross"></i><?php echo JText::_('Delete'); ?>
    </a>
    </div>
    <div class="btn-group">
    <a href="#" class="btn btn-small" onclick="return downloadfun();">
    <i class="factory-icon-download"></i>
    <?php echo JText::_('Download'); ?></a></div>
     <div class="btn-group">
    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
      <i class="factory-icon-document-share"></i><?php echo FactoryText::_('briefcase_buttons_share'); ?>
    </a>
    <ul class="dropdown-menu button-share">
        <li><a href="<?php echo FactoryRoute::view('shareusers&tmpl=component&parent=' . $this->parent->id); ?>" class="users"><i class="factory-icon-document-share"></i><?php echo JText::_('With Friends'); ?></a></li>
    </ul>
    </div>
    <?php /* ?>
    
 <?php
if ($this->enabledPublicSharing || $this->enabledUserSharing || $this->enabledGroupSharing): ?>
  <div class="btn-group">
    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
      <i class="factory-icon-document-share"></i><?php echo FactoryText::_('briefcase_buttons_share'); ?>
    </a>

    <ul class="dropdown-menu button-share">
      <?php if ($this->enabledPublicSharing): ?>
        <!--li><a href="<?php echo FactoryRoute::view('sharepublic&tmpl=component&parent=' . $this->parent->id); ?>" class="public"><i class="factory-icon-document-share"></i><?php echo FactoryText::_('briefcase_button_share_public'); ?></a></li-->
      <?php endif; ?>

      <?php if ($this->enabledUserSharing): ?>
        <li><a href="<?php echo FactoryRoute::view('shareusers&tmpl=component&parent=' . $this->parent->id); ?>" class="users"><i class="factory-icon-document-share"></i><?php echo JText::_('With Friends'); ?></a></li>
      <?php endif; ?>

      <?php if ($this->enabledGroupSharing): ?>
        <!--li><a href="<?php echo FactoryRoute::view('sharegroups&tmpl=component&parent=' . $this->parent->id); ?>" class="groups"><i class="factory-icon-document-share"></i><?php echo FactoryText::_('briefcase_button_share_groups'); ?></a></li-->
      <?php endif; ?>
    </ul>
  </div>
<?php endif; ?>

<?php */ ?>