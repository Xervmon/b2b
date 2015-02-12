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

if ($this->parent->parent_id): ?>
  <tr>
    <td></td>

    <td colspan="10">
      <a href="<?php echo FactoryRoute::view('briefcase&parent=' . $this->parent->parent_id . '&' . $this->filters); ?>">
        <i class="icon-arrow-up"></i>...
      </a>
    </td>
  </tr>
<?php endif; ?>

<?php foreach ($this->items as $this->i => $this->item): ?>
  <tr data-url-edit="<?php echo FactoryRoute::task($this->item->type . '.edit&id=' . $this->item->id); ?>">
    <?php if ('com_briefcasefactory' == $this->option): ?>
      <td>
        <?php echo JHtml::_('grid.id', $this->i, $this->item->id, false, $this->item->type); ?>
      </td>
    <?php endif; ?>

    <td class="resource-icon">
      <?php echo JHtml::_('BriefcaseFactoryBriefcase.ResourceIcon', $this->item); ?>
    </td>

    <td>
      <?php if ('folder' == $this->item->type): ?>
        <a href="<?php echo FactoryRoute::view('briefcase&parent=' . $this->item->id . '&' . $this->filters); ?>"
      <?php else: ?>
        <a href="<?php echo FactoryRoute::task('file.download&id=' . $this->item->id); ?>"
      <?php endif; ?>
        class="hasTooltip" title="<?php echo $this->item->description; ?>">
          <?php echo $this->item->title; ?>
      </a>

      <div>
        <?php if ($this->item->category_title): ?>
          <span class="small muted"><i class="factory-icon-folder-small"></i>&nbsp;<?php echo $this->item->category_title; ?></span>
        <?php endif; ?>

        <?php if ($this->item->size): ?>
          <span class="small muted"><i class="factory-icon-information-small"></i>&nbsp;<?php echo JHtml::_('number.bytes', $this->item->size); ?></span>
        <?php endif; ?>
      </div>

      <?php if ($this->item->valid_until != JFactory::getDbo()->getNullDate()): ?>
        <span class="small muted hasTooltip" title="<?php echo FactoryText::sprintf('briefcase_valid_until', JHtml::_('date', $this->item->valid_until)); ?>">
          <i class="icon-clock"></i>&nbsp;<?php echo JHtml::_('date', $this->item->valid_until); ?>
        </span>
      <?php endif; ?>

    </td>

    <td class="center">
      <?php echo JHtml::_('BriefcaseFactoryShares.Shares', $this->item->shares, $this->item->type); ?>
    </td>

    <td class="center resource-public">
      <?php if ($this->item->share_public && ($this->item->share_until == JFactory::getDbo()->getNullDate() || $this->item->share_until > JFactory::getDate()->toSql())): ?>

        <?php if (-1 == $this->item->share_public): ?>
          <span class="hasTooltip" title="<?php echo FactoryText::_('share_inherited_parents'); ?>">
            <i class="factory-icon-tick-button"></i>
          </span>
        <?php else: ?>
          <i class="factory-icon-tick"></i>
        <?php endif; ?>

        <?php if ($this->item->share_until != JFactory::getDbo()->getNullDate()): ?>
          <div class="small muted hasTooltip" title="<?php echo FactoryText::sprintf('briefcase_resource_public_shared_until', JHtml::_('date', $this->item->share_until)); ?>">
            <i class="icon-clock"></i>&nbsp;<?php echo JHtml::_('date', $this->item->share_until); ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </td>
  </tr>
<?php endforeach; ?>
