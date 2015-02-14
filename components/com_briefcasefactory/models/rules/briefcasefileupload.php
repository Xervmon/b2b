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

JFormHelper::loadRuleClass('FactoryFile');

class JFormRuleBriefcaseFileUpload extends JFormRuleFactoryFile
{
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
    if (!parent::test($element, $value, $group, $input, $form)) {
      return false;
    }

    // Initialise variables.
    $user     = JFactory::getUser();
    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $admins   = $settings->get('administrators.groups', array());

    // Check if extension is allowed.
    if (!$this->checkExtension($settings, $admins, $user, $value)) {
      return new Exception(FactoryText::sprintf(
        'rule_briefcase_file_upload_error_extension',
        $element->attributes()->label
      ));
    }

    // Check if file size is valid.
    if (!$this->checkSize($settings, $admins, $user, $value)) {
      return new Exception(FactoryText::sprintf(
        'rule_briefcase_file_upload_error_size',
        $element->attributes()->label
      ));
    }

    return true;
	}

  protected function checkExtension($settings, $admins, $user, $value)
  {
    // Get allowed extensions.
    $extensions = trim($settings->get('uploads.extensions', ''));

    // Check if allowed extensions are set.
    if ('' == $extensions) {
      return true;
    }

    // Check if user is admin and if restriction is overridden.
    $override = $settings->get('override.extensions', 0);

    if ($override && $admins && array_intersect($admins, $user->groups)) {
      return true;
    }

    // Prepare extensions.
    $extensions = explode(',', $extensions);
    foreach ($extensions as &$extension) {
      $extension = trim(strtolower($extension));
    }

    // Check if extension is valid.
    jimport('joomla.filesystem.file');
    $fileExtension = strtolower(JFile::getExt($value->name));

    if (!in_array($fileExtension, $extensions)) {
      return false;
    }

    return true;
  }

  protected function checkSize($settings, $admins, $user, $value)
  {
    // Get max file size.
    $size = trim($settings->get('uploads.max_file_size', 1));

    // Check if max size is set.
    if (!$size) {
      return true;
    }

    // Check if user is admin and if restriction is overridden.
    $override = $settings->get('override.max_file_size', 0);

    if ($override && $admins && array_intersect($admins, $user->groups)) {
      return true;
    }

    if ($size * 1024 * 1024 < $value->size) {
      return false;
    }

    return true;
  }
}
