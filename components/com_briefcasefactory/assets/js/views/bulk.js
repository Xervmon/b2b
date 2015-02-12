jQuery(document).ready(function ($) {
  var template = $('fieldset:first', '.view-bulk').html();

  // Add new form.
  $(document).on('change', '.view-bulk input[type="file"]:first', function (event) {
    var elem    = $(this);
    var id      = elem.attr('id').match(/bulk_(\d+)_/);
    var parent  = elem.parents('fieldset:first');
    var pattern = new RegExp('bulk_' + parseInt(0), 'g');
    var content = template.replace(pattern, 'bulk_' + (parseInt(id[1]) + 1));

    id = parseInt(id[1]) + 1;

    $('.files')
      .prepend('<fieldset id="bulk_' + id + '">' + content + '</fieldset>')
      .find('.button-remove-file:eq(1)').show().end();

    // Initialise calendars.
    if ($('#jform_bulk_' + id + '__valid_until').length) {
      Calendar.setup({
        // Id of the input field
        inputField: "jform_bulk_" + id + "__valid_until",
        // Format of the input field
        ifFormat: "%Y-%m-%d",
        // Trigger for the calendar (button ID)
        button: "jform_bulk_" + id + "__valid_until_img",
        // Alignment (defaults to "Bl")
        align: "Tl",
        singleClick: true,
        firstDay: 0
      });
    }

    // Check if we are allowed to upload more files
    var files = $('.files fieldset');

    if (BriefcaseFactory.get('bulkLimit') == files.length - 1) {
      $('.files fieldset:first').hide();
    }
  });

  // Button remove file
  $(document).on('click', '.button-remove-file', function (event) {
    event.preventDefault();

    // Remove selected file
    $(this).parents('fieldset:first').remove();

    // Re-enable the first file
    $('.files fieldset:first').show();
  });

  // Form buttons.
  $('.buttons a.button-cancel').click(function (event) {
    event.preventDefault();

    var elem = $(this);
    var url  = elem.attr('href');

    elem.parents('form:first').attr('action', url).submit();
  });

  // Upload button.
  $('.button-upload').click(function (event) {
    event.preventDefault();

    // Clear previous upload statuses.
    $('.briefcase-message-success, .briefcase-message-error').hide().find('div').html('');

    // Initialise variables.
    var elem = $(this),
        url  = elem.attr('href'),
        form = elem.parents('form:first'),
        files = false;

    // Get the selected files.
    $('.files input[type="file"]').each(function (index, element) {
      if ('' != $(element).val()) {
        files = true;
      }
    });

    // Check if at least one file was selected.
    if (!files) {
      $.factoryGrowl({
        status: 0,
        message: Joomla.JText._('COM_BRIEFCASEFACTORY_BULK_SELECT_ONE_ITEM')
      });

      return false;
    }

    form.attr('action', url);

    // Non Html 5 browser.
    if (typeof FormData === 'undefined') {
      form.submit();

      return true;
    }

    // Html 5 browser.
    var xmlHttpRequest = new XMLHttpRequest();
    var progress       = $('.progress');
    var progressBar    = progress.find('.bar');

    xmlHttpRequest.open('POST', form.attr('action'), true);
    form.find('input[name="HTTP_X_REQUESTED_WITH"]').val('xmlhttprequest');

    var formData = new FormData(form[0]);

    // On progress event.
    xmlHttpRequest.upload.onprogress = function(e) {
      if (e.lengthComputable) {
        var percentComplete = Math.ceil((e.loaded / e.total) * 100);
        progressBar.css('width', percentComplete + '%');
      }
    };

    // On start event.
    xmlHttpRequest.upload.onloadstart = function (e) {
      progress.show();
      progressBar.css('width', 0);
    }

    // On success event
    xmlHttpRequest.onreadystatechange = function(e) {
      if (xmlHttpRequest.readyState == 4) {
        progressBar.css('width', '100%');

        if (xmlHttpRequest.status !== 200) {
          $.factoryGrowl({
            status: 0,
            message: Joomla.JText._('COM_BRIEFCASEFACTORY_BULK_UPLOAD_ERROR'),
            error: Joomla.JText._('COM_BRIEFCASEFACTORY_BULK_UPLOAD_ERROR_CODE') + xmlHttpRequest.status
          })

          return true;
        }

        var response = $.parseJSON(xmlHttpRequest.responseText);
        progress.hide();

        for (var i = 0, length = response.length; i < length; i++) {
          var file = response[i];

          if (file.status) {
            $('.briefcase-message-success')
              .show()
              .find('div').append(file.message + '<br />');

            $('#' + file.id + ' a.button-remove-file').click();
          }
          else {
            $('.briefcase-message-error')
              .show()
              .find('div').append(file.message + '<br />');
          }
        }
      }
    };

    // Send Ajax form
    xmlHttpRequest.setRequestHeader('X_REQUESTED_WITH', 'XMLHttpRequest');
    xmlHttpRequest.send(formData);

    return true;
  });
});
