var currentUsername, files = 0;

jQuery(document).ready(function ($) {
  // File browser.
  $('#file-browser').bind('update', function (event, folder) {
    var url = 'index.php?option=com_briefcasefactory&task=bulk.folder&format=raw&folder=' + folder;
    var data = [];
    var elem = $(this);
    var i;

    $.get(url, function (response) {
      for (i = 0, count = response.folders.length; i < count; i++) {
        var folder = response.folders[i];

        data.push('<tr><td><i class="factory-icon-folder"></i>&nbsp;<a href="#' + folder.hash + '" class="file-browser-folder">' + folder.name + '</a></td></tr>');
      }

      for (i = 0, count = response.files.length; i < count; i++) {
        var file = response.files[i];

        data.push('<tr><td><i class="factory-icon-document"></i>&nbsp;<a href="#' + file.hash + '" class="file-browser-file">' + file.name + '</a></td></tr>');
      }

      elem.html('<table class="table table-condensed table-bordered table-striped table-hover">' + data.join("\n") + '</table>');

    }, 'json');

  }).trigger('update', '');

  // Folder click.
  $(document).on('click', 'a.file-browser-folder', function (event) {
    event.preventDefault();

    var hash = $(this).attr('href').replace('#', '');

    $('#file-browser').trigger('update', hash);
  });

  // File click.
  $(document).on('click', 'a.file-browser-file', function (event) {
    event.preventDefault();

    var elem = $(this);
    var hash = elem.attr('href').replace('#', '');
    var name = elem.html();
    var table = $('#selected-files');
    var html = [];
    var user_id = $('#user_id_default').val();
    var user_name = $('#user_name_default').val();
    var category_id = $('#category_id_default').val();

    files++;

    var user = $('.default_user_select').html().replace(/default/g, files);
    var category = $('.default_category_select').html().replace(/default/g, files);

    html.push('<a href="#" class="selected-file-remove"><i class="factory-icon-minus-circle" /></a>&nbsp;');
    html.push('<input type="text" name="jform[' + files + '][name]" value="' + name + '" />');
    html.push('<input type="hidden" name="jform[' + files + '][hash]" value="' + hash + '" />');
    html.push('<div class="input-append">' + user + '</div>');
    html.push(category);

    table.append('<tr><td>' + html.join("\n") + '</td></tr>');

    table.find('#user_id_' + files).val(user_id);
    table.find('#user_name_' + files).val(user_name);
    table.find('#category_id_' + files).val(category_id);

    SqueezeBox.assign($$('a.modal_' + files), {
	    parse: 'rel'
		});
  });

  // File remove.
  $(document).on('click', 'a.selected-file-remove', function (event) {
    event.preventDefault();

    $(this).parents('tr:first').remove();
  });

  SqueezeBox.assign($$('a.modal_default'), {
    parse: 'rel'
  });
});

function jSelectUser_username(id, title) {
  jQuery('#user_name_' + currentUsername).val(title);
  jQuery('#user_id_' + currentUsername).val(id);

	SqueezeBox.close();
}
