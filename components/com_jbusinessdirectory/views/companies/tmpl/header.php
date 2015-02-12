<?php /*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

$user = JFactory::getUser();

$uri     = JURI::getInstance();
$current = $uri->toString( array('scheme', 'host', 'port', 'path'));

$company = $this->company;
$url = $current;

//set metainfo

$document = JFactory::getDocument();
$config = new JConfig();

$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();

$title = stripslashes($company->name)." | ".$config->sitename;
$description = !empty($company->description)?strip_tags(JBusinessUtil::truncate($company->description,300)):$appSettings->meta_description;

$document->setTitle($title);
$document->setDescription($description);
$document->setMetaData('keywords', $appSettings->meta_keywords.",".$company->keywords);
$document->addCustomTag('<meta property="og:title" content="'.$title.'"/>');
$document->addCustomTag('<meta property="og:description" content="'.$description.'"/>');

if(isset($this->company->logoLocation) && $this->company->logoLocation!=''){
	$document->addCustomTag('<meta property="og:image" content="'.JURI::root().PICTURES_PATH.$this->company->logoLocation .'" /> ');
}
$document->addCustomTag('<meta property="og:type" content="website"/>');
$document->addCustomTag('<meta property="og:url" content="'.$url.'"/>');
$document->addCustomTag('<meta property="og:site_name" content="'.$config->sitename.'"/>');

//set canonical url
if($appSettings->enable_seo){
 $document = JFactory::getDocument();
    foreach($document->_links as $key=> $value)
    {
        if(is_array($value))
        {
            if(array_key_exists('relation', $value))
            {
                if($value['relation'] == 'canonical')
                {                       
                    //the document link that contains the canonical url found and changed

                    $document->_links[$url] = $value;
                    unset($document->_links[$key]);
                    break;                      
                }
            }
        }
    }   
}

$showData = !($user->id==0 && $appSettings->show_details_user == 1);

?>