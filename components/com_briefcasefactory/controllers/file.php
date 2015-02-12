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
require JPATH_COMPONENT .'/helpers/S3Helper.php'; 
class BriefcaseFactoryFrontendControllerFile extends FactoryControllerForm
{
  protected $view_list = 'briefcase';
  protected $option = 'com_briefcasefactory';
  
  
  public function download()
  {
    $app      = JFactory::getApplication();
    $input    = $app->input;
    $id       = $input->getInt('id', 0);
    $model    = $this->getModel();

    if (!$model->canDownload($id)) {
      $app->enqueueMessage(FactoryText::_('file_task_download_error'), 'message');
      $app->enqueueMessage($model->getError(), 'error');

      $referrer = $input->server->getString('HTTP_REFERER', FactoryRoute::view('briefcase'));
      $this->setRedirect($referrer);

      return false;
    }

    // Get file.
    $file = $model->getFile($id);
    $src  = $file->getFilePath();
   //echo $file->filename; die;
  
    if ($file->user_id != JFactory::getUser()->id) {
      $file->hit();
    }

    // Set headers.
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file->filename.'"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($src));

    // Start the download.
    ob_clean();
    flush();
    readfile($src);

    jexit();
  }
  
 

  public function save($key = null, $urlVar = null)
  {
    $input = JFactory::getApplication()->input;
    $post  = $input->post->get('jform', array(), 'array');
    $files = $input->files->get('jform', array(), 'array');
    $redirect = $input->post->getBase64('redirect');
    // echo $post['folder_id'];die;   
    foreach ($files as $i => $file) {
      if (!isset($file['error']) || 4 == $file['error']) {
        $files[$i] = null;
      }
      else
      {
         $tmp_name = $file["tmp_name"];
         //$name = $file["name"];
         //move_uploaded_file($tmp_name, "./media/com_briefcasefactory/".$name);
		   $folder_id = $post['folder_id'];            
     
		 S3Helper::uploadFile( JFactory::getUser()->username, $file,$folder_id);  
  
      }
    }

    $post = array_merge($post, $files);
    $input->post->set('jform', $post);

    $result = parent::save($key, $urlVar);
    //echo '<pre>';print_r($files);die;
    if ($redirect) {
      $this->setRedirect(base64_decode($redirect));
    }

    return $result;
  }

  public function addBulk()
  {
    if (!parent::add()) {
      return false;
    }

    $folder = $this->input->getInt('parent', 1);
    $this->setRedirect(FactoryRoute::view('bulk&layout=edit&folder=' . $folder));

    return true;
  }

  public function saveBulk()
  {
    $response = array();

    $post = $this->input->post->get('jform', array(), 'array');
    $files = $this->input->files->get('jform', array(), 'array');   
     
    foreach ($files as $id => $file) {
      if (!isset($file['file']['error']) || 4 == $file['file']['error']) {
        continue;
      }
      $folder_id = $post[$id]['folder_id'];            
         // echo '<pre>';print_r($file);die;
		 S3Helper::uploadFile( JFactory::getUser()->username, $file['file'],$folder_id);     
      if (isset($post[$id])) {
        $post[$id]['file'] = $file['file'];
      }

      $this->input->post->set('jform', $post[$id]);

      if (parent::save()) {
        
		   
        $response[] = array(
          'status'  => 1,
          'id'      => $id,
          'name'    => $file['file']['name'],
          'message' => FactoryText::sprintf('file_save_bulk_task_success', $file['file']['name']),
        );
      }
      else {
        /** @noinspection PhpDeprecationInspection */
        $response[] = array(
          'status'  => 0,
          'id'      => $id,
          'name'    => $file['file']['name'],
          'message' => FactoryText::sprintf('file_save_bulk_task_error', $file['file']['name'], $this->getError()),
        );
      }
    } 

    // Check if ajaxa request.
    if ($this->isXmlHttpRequest()) {
      $this->renderJson($response);
    }

    $app = JFactory::getApplication();
    $this->setMessage(null, 'message');
    $this->setMessage(null, 'error');

    foreach ($response as $file) {
      if ($file['status']) {
        $app->enqueueMessage($file['message'], 'message');
      }
      else {
        $app->enqueueMessage($file['message'], 'error');
      }
    }

    $this->setRedirect(FactoryRoute::view('briefcase'));

    return true;
  }
  
  function getFolderName($id = null)
  {
      $db = JFactory::getDBO();
      $query = "select title from #__briefcasefactory_folders where id = '".$id."'";
      $db->setQuery($query);
      return $db->loadResult();
  }
  
  function downloadFile()
	{
		 $folders = $_REQUEST['folders'];
     $files = $_REQUEST['files'];
     $userid = JFactory::getUser()->id;
     $db = JFactory::getDBO();
     if($files)
     {
       $explode_files = explode(",",$files);       
       $downloadurl = 'http://b2b-dev.s3.amazonaws.com/';
       $zip = new ZipArchive();
       # create a temp file & open it
       $tmp_file = tempnam('.','');
       $zip->open($tmp_file, ZipArchive::CREATE);
       foreach ($explode_files as $file) {       
           $query = "select folder_id,filename,user_id from #__briefcasefactory_files where id = '".$file."'";
           $db->setQuery($query);
           $object = $db->loadObject();           
           $user_name = JFactory::getUser($object->user_id)->username;
           if($object->folder_id != 1)
          {
             $fname = $this->getFolderName( $object->folder_id );
             $durl = $downloadurl.$user_name.'/'.$fname.'/'.$object->filename;
          }
          else
          {
             $durl = $downloadurl.$user_name.'/'.$object->filename;
          }           
           $download_file = file_get_contents($durl);          
           $zip->addFromString(basename($durl),$download_file);
        }
      if($folders)
      {
          $query = "select user_id,filename,folder_id from #__briefcasefactory_files where folder_id IN($folders)";
          $db->setQuery($query);
          $ids = $db->loadObjectlist();          
          foreach($ids as $object)
          {
            $user_name = JFactory::getUser($object->user_id)->username;
            if($object->folder_id != 1)
            {
               $fname = $this->getFolderName( $object->folder_id );
               $durl = $downloadurl.$user_name.'/'.$fname.'/'.$object->filename;
            }
            else
            {
               $durl = $downloadurl.$user_name.'/'.$object->filename;
            }           
            $download_file = file_get_contents($durl);          
            $zip->addFromString(basename($durl),$download_file);          
          }
      }  
        $zip->close();
        header('Content-disposition: attachment; filename=files.zip');
        header('Content-type: application/zip');
        readfile($tmp_file);
     }
     exit;     
	}
  
  function deleteeverything()
  {
      //echo '<pre>';print_r($_REQUEST); echo '</pre>'; die;
      $folders = $_REQUEST['folders'];
      $files = $_REQUEST['files'];
      $userid = JFactory::getUser()->id;
      $db = JFactory::getDBO();
      if($files)
      {
        $query = "select count(*) from #__briefcasefactory_files where id IN($files) and user_id = '".$userid."'";
        $db->setQuery($query);
        $file_count = $db->loadResult();
        if($file_count > 0)
        {
            $explode_files = explode(",",$files);
            foreach($explode_files as $ex)
            {
                $query = "select folder_id,filename from #__briefcasefactory_files where id = '".$ex."' and user_id = '".$userid."'";
                $db->setQuery($query);
                $object = $db->loadObject();
                $folder_id = $object->folder_id;
                $filename =  $object->filename;
                S3Helper::deleteFile( JFactory::getUser()->username, $filename,$folder_id);                
            }
            $query = "delete from #__briefcasefactory_files where id IN($files) and user_id = '".$userid."'";
            $db->setQuery($query);
            $db->query();
            
            $query = "delete from #__briefcasefactory_shares_files where file_id IN($files)";
            $db->setQuery($query);
            $db->query(); 
        }
               
      }
      if($folders)
      {
        $query = "select id,filename,folder_id from #__briefcasefactory_files where folder_id IN($folders) and user_id = '".$userid."'";
        $db->setQuery($query);
        $ids = $db->loadObjectlist();
        
        foreach($ids as $row)
        {
          $filename =  $row->filename;
          S3Helper::deleteFile( JFactory::getUser()->username,$filename, $row->folder_id);  
          $query = "delete from #__briefcasefactory_files where id = '".$row->id."' and user_id = '".$userid."'";
          $db->setQuery($query);
          $db->query();
          
          $query = "delete from #__briefcasefactory_shares_files where file_id  = '".$row->id."'";
          $db->setQuery($query);
          $db->query(); 
        }
        
        $query = "delete from #__briefcasefactory_folders where id IN($folders) and user_id = '".$userid."'";
        $db->setQuery($query);
        $db->query();
        
        $query = "delete from #__briefcasefactory_shares_folders where folder_id IN($folders)";
        $db->setQuery($query);
        $db->query();
      }      
      
      $app = JFactory::getApplication();
      $message = JText::_('Files/Folders Deleted Successfully');
      $app->redirect(JRoute::_('index.php?option=com_briefcasefactory&view=briefcase&Itemid=790', false), $message, 'message');
  }

  protected function getRedirectToListAppend()
	{
    $append = parent::getRedirectToListAppend();
    $id = $this->input->getInt('id', 0);

    if ($id) {
      $table = JTable::getInstance('File', 'BriefcaseFactoryTable');
      $table->load($id);
      $append .= '&parent=' . $table->folder_id;
    }
    elseif ($parent = $this->input->getInt('parent')) {
      $append .= '&parent=' . $parent;
    }

		return $append;
	}

  protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
	{
    $append = parent::getRedirectToItemAppend($recordId, $urlVar);
		$parent = $this->input->getInt('parent', 0);
    $id     = $this->input->getInt('id', 0);

		if ($parent) {
			$append .= '&parent=' . $parent;
		}
    elseif ($id) {
      $table = JTable::getInstance('File', 'BriefcaseFactoryTable');
      $table->load($id);

      $append .= '&parent=' . $table->folder_id;
    }

		return $append;
	}

  protected function allowAdd($data = array())
	{
		$user = JFactory::getUser();

    if ($user->authorise('core.admin')) {
      return true;
    }

    return $user->authorise('frontend.manage', $this->option);
	}

  protected function allowEdit($data = array(), $key = 'id')
  {
    $user = JFactory::getUser();

    if ($user->authorise('core.admin') || $user->authorise('frontend.upload.global', 'com_briefcasefactory')) {
      return true;
    }

    if (!$user->authorise('frontend.manage', $this->option)) {
      return false;
    }

    $model = $this->getModel();
    $table = $model->getTable();

    $table->load($data[$key]);

    return $table->user_id == $user->id;
  }
}
