<?php

require JPATH_LIBRARIES .'/thirdparty/aws/aws-autoloader.php';
require JPATH_LIBRARIES .'/thirdparty/aws/vendor/autoload.php';
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use League\Flysystem\Filesystem;
  
class S3Helper
{
	private static $client;
	private static $adapter;
	private static $config;
	private static function init($uid)
	{
		 $settings = JComponentHelper::getParams('com_briefcasefactory');
         self::$config = $settings->toArray();
		 self::$client = S3Client::factory(array(
              'key'    => self::$config ['s3_creds']['access_key'],
              'secret' => self::$config ['s3_creds']['secret_key'],
              'region' => self::$config ['s3_creds']['region']
          ));
		  self::$adapter = new AwsS3Adapter(self::$client, self::$config ['s3_creds']['bucket'].'/'.$uid);
		
	}	
	
	public static function uploadFile($uid, $file,$folder = null)
	{
		  self::init($uid);
      $filesystem = new Filesystem(self::$adapter);
      
      $tmp = $file['tmp_name'];
      $stream = fopen($tmp, 'r+');
      if(!empty($folder) && $folder != 1)
      {
        $foldername = self::getFolderName($folder).'/';
      }
      else
      {
        $foldername = '';  
      }
      
      if($filesystem->has($foldername.$file['name']))
		  {
		  	$filesystem->delete($foldername.$file['name']);
		  } 
      $filesystem->writeStream($foldername.$file['name'], $stream);
      $filesystem->setVisibility($foldername.$file['name'], 'public');
	}
	
	public static function downloadFile()
	{
		 
     $files = array('readme.txt', 'test.html', 'image.gif');
     $zipname = 'file.zip';
     $zip = new ZipArchive;
     $zip->open($zipname, ZipArchive::CREATE);
     foreach ($files as $file) {
      $zip->addFile($file);
     }
     $zip->close();
     header('Content-Type: application/zip');
     header('Content-disposition: attachment; filename='.$zipname);
     header('Content-Length: ' . filesize($zipname));
     readfile($zipname);
	}
	

	/*public static function deleteFile($uid, $file)
	{
		self::init($uid);
        $filesystem = new Filesystem(self::$adapter);
		$filesystem->delete(self::$config ['s3_creds']['bucket'].'/'.$uid.'/' .$file['name']);
	}
	*/

  public static function getFolderName($id = null)
  {
      $db = JFactory::getDBO();
      $query = "select title from #__briefcasefactory_folders where id = '".$id."'";
      $db->setQuery($query);
      return $db->loadResult();
  }

	
	

  public static function deleteFile($uid = null,$file=null,$folder = null)
	{
	  self::init($uid);
    $filesystem = new Filesystem(self::$adapter);
    if(!empty($folder) && $folder != 1)
    {
      $foldername = self::getFolderName($folder).'/';
    }
    else
    {
      $foldername = '';  
    }
    if($filesystem->has($foldername.$file))
	  {
	  	$filesystem->delete($foldername.$file);
	  }
	}

}