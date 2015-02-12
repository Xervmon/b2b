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

JFormHelper::loadFieldClass('FactoryFile');

class JFormFieldBriefcaseFileUpload extends JFormFieldFactoryFile
{
	public $type = 'BriefcaseFileUpload';

  protected function getInput()
  {
    // Initialise variables.
    $user     = JFactory::getUser();
    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $admins   = $settings->get('administrators.groups', array());

    // Get restrictions.
    $extensions = $this->getExtensionsRestriction($settings, $admins, $user);
    $size       = $this->getSizeRestriction($settings, $admins, $user);

    $html = array();

    $html[] = '<div>';
    $html[] = parent::getInput();

    if ($extensions) {
      $html[] = '<div class="muted small">' . FactoryText::sprintf('file_upload_allowed_extensions', $extensions) . '</div>';
    }

    if ($size) {
      $html[] = '<div class="muted small">' . FactoryText::sprintf('file_upload_max_file_size', $size) . '</div>';
    }

    $html[] = '</div>';

    return implode("\n", $html);
  }

  protected function getExtensionsRestriction($settings, $admins, $user)
  {
    // Get allowed extensions.
    $extensions = trim($settings->get('uploads.extensions', ''));

    // Check if allowed extensions are set.
    if ('' == $extensions) {
      return false;
    }

    // Check if user is admin and if restriction is overridden.
    $override = $settings->get('override.extensions', 0);

    if ($override && $admins && array_intersect($admins, $user->groups)) {
      return false;
    }

    // Prepare extensions.
    $extensions = explode(',', $extensions);
    foreach ($extensions as &$extension) {
      $extension = trim(strtolower($extension));
    }

    return implode(', ', $extensions);
  }

  protected function getSizeRestriction($settings, $admins, $user)
  {
    // Get max file size.
    $size = trim($settings->get('uploads.max_file_size', 1));

    // Check if max size is set.
    if (!$size) {
      return false;
    }

    // Check if user is admin and if restriction is overridden.
    $override = $settings->get('override.max_file_size', 0);

    if ($override && $admins && array_intersect($admins, $user->groups)) {
      return false;
    }

    return $size;
  }
}
