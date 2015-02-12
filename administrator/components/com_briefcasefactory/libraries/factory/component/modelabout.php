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

class FactoryModelAbout extends JModelLegacy
{
  protected $externalManifestBasePath = 'http://thephpfactory.com/versions/';
  protected $externalManifestFilename = null;
  protected $externalManifest         = null;

  public function getData()
  {
    $array = array();

    $array['current'] = $this->getCurrentVersion();
    $array['latest']  = $this->getLatestVersion();
    $array['update']  = $this->isUpgradeAvailable($array['current'], $array['latest']);

    $array['version']  = (string)$this->getExternalManifest()->versionhistory;
    $array['download'] = (string)$this->getExternalManifest()->downloadlink;
    $array['other']    = (string)$this->getExternalManifest()->otherproducts;
    $array['about']    = (string)$this->getExternalManifest()->aboutfactory;

    return (object)$array;
  }

  protected function getExternalManifest()
  {
    if (is_null($this->externalManifest)) {
      $this->externalManifest = false;

      if (is_null($this->externalManifestFilename)) {
        $this->externalManifestFilename = $this->getOption();
      }

      $contents = FactoryHelper::getFileContents($this->externalManifestBasePath . $this->externalManifestFilename . '.xml');

      if ($contents) {
        $this->externalManifest = simplexml_load_string($contents);
      }
    }

    return $this->externalManifest;
  }

  protected function getCurrentVersion()
  {
    jimport('joomla.filesystem.file');

    $file = JPATH_COMPONENT_ADMINISTRATOR . '/manifest.xml';

    if (!JFile::exists($file)) {
      $filename = str_replace('com_', '', $this->getOption()) . '.xml';
      $file = JPATH_COMPONENT_ADMINISTRATOR . '/' . $filename;
    }

    $data = JInstaller::parseXMLInstallFile($file);

    return $data['version'];
  }

  protected function getLatestVersion()
  {
    return (string)$this->getExternalManifest()->latestversion;
  }

  protected function isUpgradeAvailable($current, $latest)
  {
    return (boolean)(version_compare($current, $latest) === -1);
  }

  protected function getOption()
  {
    return JFactory::getApplication()->input->getCmd('option');
  }
}
