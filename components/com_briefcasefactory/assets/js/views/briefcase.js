 function deletefun()
          {
              var atLeastOneIsChecked = Number(jQuery('input[name="folder[]"]:checked').length);
              var atleastfile = Number(jQuery('input[name="file[]"]:checked').length);
              var total = atLeastOneIsChecked + atleastfile;
              if(total == 0)
              {
                  alert('Please select at least one item');
                  return false;
              }
              else
              {
                  var folder_ids = '';
                  jQuery('input[name="folder[]"]:checked').each(function(i,e)
                  {
                      folder_ids += e.value+',';
                  });
                  var finalfolder_ids = rtrim(folder_ids,','); 
                 
                  var file_ids = '';
                  jQuery('input[name="file[]"]:checked').each(function(i,e)
                  {
                      file_ids += e.value+',';
                      
                  });
                  var finalfile_ids = rtrim(file_ids,',');
                  window.location.href = 'index.php?option=com_briefcasefactory&task=file.deleteeverything&files='+finalfile_ids+'&folders='+finalfolder_ids;
              }
          }
          
          function downloadfun()
          {
              var atLeastOneIsChecked = Number(jQuery('input[name="folder[]"]:checked').length);
              var atleastfile = Number(jQuery('input[name="file[]"]:checked').length);
              var total = atLeastOneIsChecked + atleastfile;
              if(total == 0)
              {
                  alert('Please select at least one item');
                  return false;
              }
              else
              {
                  var folder_ids = '';
                  jQuery('input[name="folder[]"]:checked').each(function(i,e)
                  {
                      folder_ids += e.value+',';
                  });
                  var finalfolder_ids = rtrim(folder_ids,','); 
                 
                  var file_ids = '';
                  jQuery('input[name="file[]"]:checked').each(function(i,e)
                  {
                      file_ids += e.value+',';
                      
                  });
                  var finalfile_ids = rtrim(file_ids,',');
                  window.location.href = 'index.php?option=com_briefcasefactory&task=file.downloadFile&files='+finalfile_ids+'&folders='+finalfolder_ids;
              }
          }
          
           function rtrim(str, chr) {
  var rgxtrim = (!chr) ? new RegExp('\\s+$') : new RegExp(chr+'+$');
  return str.replace(rgxtrim, '');
}

jQuery(document).ready(function ($) {
  // Share buttons.
  $('.button-share a').click(function (event) {
    event.preventDefault();

    // Check if at least one resource is selected.
    if (!$.itemSelected()) {
      return false;
    }

    var elem     = $(this);
    var url      = elem.attr('href');
    var type     = elem.attr('class');
    var selected = $('input[name="file[]"]:checked, input[name="folder[]"]:checked');

    switch (type) {
      case 'public':
      default:
        var size = { x: 500, y: 283 };
        break;

      case 'users':
        var size = { x: 500, y: 670 };
        break;

      case 'groups':
        var size = { x: 500, y: 300 };
        break;
    }

    if ('users' != type) {
      url += (false === url.indexOf('?') ? '?' : '&') + selected.serialize();
    }

    SqueezeBox.open(url, { handler: 'iframe', size: size });

    return true;
  });

  // Briefcase update.
  $('.briefcase-update').bind('update', function (event) {
    var elem = $(this);
    var url  = elem.attr('data-url');

    elem.load(url, function () {
      elem.find('.hasTooltip').tooltip({});
    });

    SqueezeBox.close();
  });

  // Unshare resource link.
  $(document).on('click', '.share a', function (event) {
    event.preventDefault();

    var elem = $(this);
    var url  = elem.attr('href');

    $.post(url, function (response) {
      elem.tooltip('hide');

      if (response.status) {
        elem.parents('.share:first').remove();
      }

      $.factoryGrowl(response);
    }, 'json');
  });

  // Edit resource button.
  $('.button-edit').click(function (event) {
    event.preventDefault();

    // Check if at least one resource is selected.
    if (!$.itemSelected()) {
      return false;
    }

    var selected = $.selectedItems();

    window.location.href = $(selected[0]).parents('tr:first').attr('data-url-edit');
  });
});
