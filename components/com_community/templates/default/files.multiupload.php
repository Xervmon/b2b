<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
defined('_JEXEC') or die();
?>
<link rel="stylesheet" href="<?php echo JURI::root(true);?>/components/com_community/assets/multiupload_js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />
<script type="text/javascript">
    joms || (joms = {});
    joms.language || (joms.language = {});
    joms.language.multiupload || (joms.language.multiupload = {});
    joms.language.multiupload.size = '<?php echo JText::_("COM_COMMUNITY_PHOTOS_MULTIUPLOAD_SIZE", true); ?>';
    joms.language.multiupload.status = '<?php echo JText::_("COM_COMMUNITY_PHOTOS_MULTIUPLOAD_STATUS", true); ?>';
    joms.language.multiupload.drag_files = '<?php echo JText::_("COM_COMMUNITY_PHOTOS_MULTIUPLOAD_DRAG_FILES", true); ?>';
    joms.language.multiupload.start_upload = '<?php echo JText::_("COM_COMMUNITY_PHOTOS_MULTIUPLOAD_START_UPLOAD", true); ?>';
    joms.language.multiupload.add_files = '<?php echo JText::_("COM_COMMUNITY_PHOTOS_MULTIUPLOAD_ADD_FILES", true); ?>';
    joms.language.multiupload.filename = '<?php echo JText::_("COM_COMMUNITY_PHOTOS_MULTIUPLOAD_FILENAME", true); ?>';
</script>
<script type="text/javascript" src="<?php echo JURI::root(true);?>/components/com_community/assets/multiupload_js/plupload.js"></script>
<script type="text/javascript" src="<?php echo JURI::root(true);?>/components/com_community/assets/multiupload_js/plupload.html4.js"></script>
<script type="text/javascript" src="<?php echo JURI::root(true);?>/components/com_community/assets/multiupload_js/plupload.html5.js"></script>
<script type="text/javascript" src="<?php echo JURI::root(true);?>/components/com_community/assets/multiupload_js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<div id="photo-uploader" style="height:310px;overflow:hidden;">
    <div id="upload-content" class="clrfix">
    	<div id="html5_uploader"></div>
    </div><!--#upload-content-->
</div>
<div id="upload-footer" style="display:none">
		<a class="add-more" href="javascript: void(0); "><?php echo JText::_('COM_COMMUNITY_PHOTOS_ADD_MORE_FILES'); ?></a>
</div>

	<div style="float: left; margin-right: 20px">

	</div>

<script type="text/javascript">
joms.jQuery(function() {

   joms.file.ajaxUploadFile('<?php echo $url;?>','<?php echo $fileType?>','<?php echo $maxFileSize?>');

});
</script>