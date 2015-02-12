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

class BriefcaseFactoryBackendViewSettings extends FactoryViewSettings
{
  protected $activeTab = 'general';

  protected $layout = array(
    'general' => array(
      'left' => array('uploads'),
      'right' => array('pagination', 'cron', 'notifications'),
    ),

    'access' => array(
      'left' => array('sharing'),
      'right' => array('restrictions'),
    ),

    'overrides' => array(
      'left' => array('override'),
      'right' => array('administrators'),
    ),

    'permissions' => array(
      'full' => array('permissions'),
    ),
  );

  protected $html = array('behavior.modal');

  public function __construct($config = array())
  {
    if (!JFactory::getUser()->authorise('backend.settings', JFactory::getApplication()->input->get('option'))) {
      throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
    }

    parent::__construct($config);
  }
}
