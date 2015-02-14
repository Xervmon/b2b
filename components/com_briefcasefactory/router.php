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

function getBriefcaseFactoryRoutes()
{
  $routes = array(
    'briefcase'      => array('view' => 'briefcase', 'params' => array('optional' => 'parent')),
    'file'           => array('view' => 'file', 'params' => array('optional' => 'parent')),
    'share-public'   => array('view' => 'sharepublic', 'params' => array('optional' => 'parent')),
    'share-users'    => array('view' => 'shareusers', 'params' => array('optional' => 'parent')),
    'share-groups'   => array('view' => 'sharegroups', 'params' => array('optional' => 'parent')),

    'add-file'       => array('task' => 'file.add', 'params' => array('optional' => 'parent')),
    'add-bulk-files' => array('task' => 'file.addbulk', 'params' => array('optional' => 'parent')),
    'add-folder'     => array('task' => 'folder.add', 'params' => array('optional' => 'parent')),
    'batch-download' => array('task' => 'batch.download'),
    'batch-unshare'  => array('task' => 'batch.unshare'),
    'batch-delete'   => array('task' => 'batch.delete'),
  );

  return $routes;
}

function BriefcaseFactoryBuildRoute(&$query)
{
  if (!isset($query['view']) && !isset($query['task'])) {
    return array();
  }

  $routes   = getBriefcaseFactoryRoutes();
  $segments = array();

  foreach ($routes as $alias => $route) {
    if (isset($query['view'])) {
      if (!isset($route['view']) || $route['view'] != $query['view']) {
        continue;
      }
    }
    elseif (isset($query['task'])) {
      if (!isset($route['task']) || $route['task'] != $query['task']) {
        continue;
      }
    }

    $valid = true;

    if (isset($route['params'])) {
      foreach ($route['params'] as $type => $param) {
        if (!isset($query[$param])) {
          if ('optional' !== $type) {
            $valid = false;
            break;
          }
        }
      }
    }

    if (!$valid) {
      continue;
    }

    $segments[] = $alias;
    if (isset($query['view'])) {
      unset($query['view']);
    }
    else {
      unset($query['task']);
    }

    if (isset($route['params'])) {
      foreach ($route['params'] as $param) {
        if (isset($query[$param])) {
          $segments[] = $query[$param];
          unset($query[$param]);
        }
      }
    }

    break;
  }

  // Set default values if no route found.
  if (!$segments) {
    // Only do this for views.
    if (isset($query['view'])) {
      $segments[] = $query['view'];
      unset($query['view']);
    }
  }

  return $segments;
}

function BriefcaseFactoryParseRoute($segments)
{
  $routes = getBriefcaseFactoryRoutes();
  $vars   = array();

  $segments[0] = str_replace(':', '-', $segments[0]);

  if (array_key_exists($segments[0], $routes)) {
    $route = $routes[$segments[0]];

    if (isset($route['view'])) {
      $vars['view'] = $route['view'];
    }
    else {
      $vars['task'] = $route['task'];
    }

    if (isset($route['params'])) {
      $i = 1;
      foreach ($route['params'] as $type => $param) {
        if (isset($segments[$i])) {
          $vars[$param] = $segments[$i];
        }

        $i++;
      }
    }
  }

  // Set default values if no route found.
  if (!$vars) {
    // We're assuming the route is a view.
    $vars['view'] = $segments[0];
  }

  return $vars;
}
