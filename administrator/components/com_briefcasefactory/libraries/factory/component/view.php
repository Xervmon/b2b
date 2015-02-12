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

class FactoryView extends JViewLegacy
{
  protected
    $defaultButtons      = array(),
    $buttons             = array(),
    $defaultVariables    = array(),
    $defaultHtml         = array(),
    $html                = array(),
    $permissions         = array(),
    $variables           = array(),
    $css                 = array(),
    $js                  = array(),
    $jtexts              = array(),
    $templatePath        = array(),
    $defaultTemplatePath = array(),
    $javascriptVariables = array(),
    $sidebar             = null,
    $option              = null,
    $tpl                 = null
  ;

  public function __construct($config = array())
	{
    // Set option.
    $this->option = $this->getOption();

		parent::__construct($config);

    // Check permissions.
    if ($this->permissions) {
      $user = JFactory::getUser();

      foreach ($this->permissions as $permission) {
        if (!$user->authorise($permission, $this->option)) {
          throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
        }
      }
    }

    // Add extra view paths.
    foreach (array_merge($this->templatePath, $this->defaultTemplatePath) as $path) {
      $this->_addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR . '/libraries/factory/component/views/' . $path);
    }
  }

  public function display($tpl = null)
  {
    JHtml::_('bootstrap.framework');
    JHtml::_('bootstrap.loadCss');

    if (is_null($tpl) && !is_null($this->tpl)) {
      $tpl = $this->tpl;
    }

    // Get variables.
    $this->getVariables(array_merge($this->defaultVariables, $this->variables));

    // Check for errors.
    if ($this->hasErrors()) {
      return false;
    }

    // Load assets.
    $this->loadAssets();

    if (!$this->isAjaxRequest()) {
      $html = array();
      $html[] = '<div class="' . $this->option . ' view-' . $this->getName() . '">';
      ob_start();
    }

    // Display view.
    parent::display($tpl);

    if (!$this->isAjaxRequest()) {
      $html[] = ob_get_contents();
      ob_end_clean();

      $html[] = '</div>';

      echo implode("\n", $html);
    }

    return true;
  }

  protected function getVariables($variables)
  {
    foreach ($variables as $variable) {
      $this->$variable = $this->get($variable);
    }

    return true;
  }

  protected function hasErrors()
  {
    if (count($errors = $this->get('Errors'))) {
      throw new Exception(implode("\n", $errors), 500);
      return true;
    }

    return false;
  }

  protected function loadAssets()
  {
    $this->loadMedia();
    $this->loadJTexts();
    $this->loadJavascriptVariables();

    if (JFactory::getApplication()->isAdmin()) {
      $this->loadAdminAssets();
    }

    return true;
  }

  protected function loadJavascriptVariables()
  {
    if (!$this->javascriptVariables) {
      return true;
    }

    FactoryHtml::script('main');
    $document = JFactory::getDocument();

    foreach ($this->javascriptVariables as $variable) {
      $value = $this->get($variable);

      if (is_null($value)) {
        continue;
      }

      $document->addScriptDeclaration('BriefcaseFactory.set("' . $variable . '", ' . $value . ');');
    }
  }

  protected function loadJTexts()
  {
    foreach ($this->jtexts as $jtext) {
      FactoryText::script($jtext);
    }
  }

  protected function loadMedia()
  {
    // Initialise variables.
    $prefix = JFactory::getApplication()->isAdmin() ? 'admin/' : '';

    // Register html.
    $html = array_merge($this->defaultHtml, $this->html);
    foreach ($html as $html) {
      if (false === strpos('/', $html)) {
        $html = explode('/', $html);
      }
      else {
        $html = array($html);
      }

      call_user_func_array(array('JHtml', '_'), $html);
    }

    // Register css files.
    array_unshift($this->css, $prefix . 'views/' . strtolower($this->getName()));
    array_unshift($this->css, $prefix . 'main');
    foreach ($this->css as $css) {
      FactoryHtml::stylesheet($css);
    }

    // Register js files.
    array_unshift($this->js, $prefix . 'views/' . strtolower($this->getName()));
    foreach ($this->js as $js) {
      FactoryHtml::script($js);
    }

    $prefix = ucfirst(str_replace(array('com_', 'factory'), '', $this->getOption()));

    // Discover JHtml helpers.
    JLoader::discover('JHtml' . $prefix . 'Factory', JPATH_COMPONENT . '/helpers/html');

    // Register default JHtml helper.
    JLoader::register('JHtml' . $prefix . 'Factory', JPATH_COMPONENT . '/helpers/html/html.php');
  }

  protected function loadAdminAssets()
  {
    $this->addSubmenu();
    $this->setTitle();
    $this->addSidebar();
    $this->addToolbar();

    return true;
  }

  protected function addSubmenu()
  {
    $prefix = ucfirst(str_replace(array('com_', 'factory'), '', $this->getOption()));

    call_user_func_array(array($prefix . 'FactoryHelper', 'addSubmenu'), array($this->getName()));

    return true;
  }

  protected function setTitle()
  {
    $title = FactoryText::_($this->getName() . '_page_title');

    JToolbarHelper::title($title);

    return true;
  }

  protected function addSidebar()
  {
    $this->sidebar = JHtmlSidebar::render();
  }

  protected function addToolbar()
  {
    // Initialise variables.
    $singular = $this->getSingularName();
    $plural   = $this->getPluralName();

    $buttons = $this->buttons ? $this->buttons : $this->defaultButtons;

    // Add buttons
    foreach ($buttons as $type => $button) {

      if (is_int($type)) {
        $type = $button;
      }

      switch ($type) {
        case 'add':
          JToolBarHelper::addNew($singular . '.' . $type);
          break;

        case 'edit':
          JToolBarHelper::editList($singular . '.' . $type);
          break;

        case 'apply':
          JToolBarHelper::apply($singular . '.' . $type);
          break;

        case 'save':
          JToolBarHelper::save($singular . '.' . $type);
          break;

        case 'save2new':
          JToolBarHelper::save2new($singular . '.' . $type);
          break;

        case 'save2copy':
          JToolBarHelper::save2copy($singular . '.' . $type);
          break;

        case 'publish':
          JToolBarHelper::publishList($plural . '.' . $type);
          break;

        case 'unpublish':
          JToolBarHelper::unpublishList($plural . '.' . $type);
          break;

        case 'delete':
          JToolBarHelper::deleteList(FactoryText::_('list_delete'), $plural . '.delete');
          break;

        case 'close':
        case 'cancel':
          JToolBarHelper::cancel($singular . '.cancel', (isset($this->item) && $this->item->id ? 'JTOOLBAR_CLOSE' : 'JTOOLBAR_CANCEL'));
          break;

        case 'back':
          JToolBarHelper::back();
          break;

        default:
          $text = FactoryText::_($this->getName() . '_' . $button[1]);
          $task = $this->getName() . '.' . $button[0];
          JToolBarHelper::custom($task, $button[2], $button[2], $text, $button[3]);
          break;
      }
    }

    return true;
  }

  protected function getOption()
  {
    return 'com_briefcasefactory';
  }

  protected function getSingularName()
  {
    $inflector = JStringInflector::getInstance();

    return $inflector->toSingular($this->getName()) ? $inflector->toSingular($this->getName()) : $this->getName();
  }

  protected function getPluralName()
  {
    $inflector = JStringInflector::getInstance();

    return $inflector->toPlural($this->getName()) ? $inflector->toPlural($this->getName()) : $this->getName();
  }

  protected function isAjaxRequest()
  {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
  }

  protected function _addTemplatePath($path)
	{
		// Just force to array
		settype($path, 'array');

		// Loop through the path directories
		foreach ($path as $dir) {
			// No surrounding spaces allowed!
			$dir = trim($dir);

			// Add trailing separators as needed
			if (substr($dir, -1) != DIRECTORY_SEPARATOR) {
				// Directory
				$dir .= DIRECTORY_SEPARATOR;
			}

			// Add to the top of the search dirs
			$this->_path['template'][] = $dir;
		}
	}
}
