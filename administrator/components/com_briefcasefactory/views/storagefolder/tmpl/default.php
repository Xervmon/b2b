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

?>

<div style="background-color: #eeeeee; padding: 10px; margin: 10px 0;">
  <a
    href="index.php?option=com_briefcasefactory&view=storagefolder&tmpl=component&folder=<?php echo base64_encode($this->folder); ?>"
    class="btn btn-primary button-submit"
    data-folder="<?php echo $this->folder; ?>"
    data-folder-encoded="<?php echo base64_encode($this->folder); ?>">
    <i class="icon-apply"></i> Use folder
  </a>
  <div style="vertical-align: middle; margin-top: 10px;"><?php echo realpath($this->folder); ?></div>
</div>

<style>
  table { border-collapse: collapse; }
  td, th { padding: 5px; }
  th { font-weight: bold; }
  tr.alternate td { background-color: #f6f6f6; }
  th { background-color: #cccccc; text-align: left; }
</style>

<script>
  jQuery(document).ready(function ($) {
    $('.button-submit').click(function (event) {
      event.preventDefault();

      var elem   = $(this);
      var folder = elem.attr('data-folder');
      var href   = elem.attr('href');

      window.parent.jQuery('a.storageFolder').html(folder).attr('href', href);
      window.parent.jQuery('input.storageFolder').val(folder);
      window.parent.SqueezeBox.close();
    });
  });
</script>

<table style="width: 100%;">
  <thead>
    <tr>
      <th style="width: 20px;"></th>
      <th>Folder</th>
      <th style="width: 40px;">Permissions</th>
    </tr>
  </thead>

  <tbody>
    <tr>
      <td style="text-align: center;"><i class="icon-arrow-up" style="color: #999999;"></i></td>
      <td>
        <a href="index.php?option=com_briefcasefactory&view=storagefolder&tmpl=component&folder=<?php echo base64_encode($this->folder . '/..'); ?>">
          ..
        </a>
      </td>
      <td></td>
    </tr>
    <?php foreach ($this->folders as $i => $folder): ?>
      <tr class="<?php echo $i % 2 ? '' : 'alternate'; ?>">
        <td style="text-align: center;"><i class="icon-folder" style="color: #999999;"></i></td>
        <td>
          <a href="index.php?option=com_briefcasefactory&view=storagefolder&tmpl=component&folder=<?php echo base64_encode($this->folder . '/' . $folder); ?>">
            <?php echo $folder; ?>
          </a>
        </td>
        <td>
          <?php echo substr(sprintf('%o', fileperms(realpath($this->folder . '/' . $folder))), -4);; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
