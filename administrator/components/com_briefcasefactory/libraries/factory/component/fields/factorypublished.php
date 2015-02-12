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

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('List');

class JFormFieldFactoryPublished extends JFormFieldList
{
	public $type = 'FactoryPublished';

	protected function getOptions()
	{
		return array(
      1 => JText::_('JPUBLISHED'),
      0 => JText::_('JUNPUBLISHED'),
    );
	}
}
