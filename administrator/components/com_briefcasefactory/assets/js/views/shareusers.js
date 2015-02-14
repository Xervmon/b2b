jQuery(document).ready(function ($) {
  var selected = [];

  // Pagination links.
  $(document).on('click', '.pagination a', function (event) {
    event.preventDefault();

    var elem = $(this);
    var url  = elem.attr('href');

    $('.update').load(url, function () {
      $('input[type="checkbox"][name="cid[]"]').each(function (index, elem) {
        var elem = $(this);
        var id   = elem.attr('value');

        for (var i = 0, length = selected.length; i < length; i++) {
          if (selected[i] == id) {
            elem.attr('checked', true);
            break;
          }
        }
      });
    });
  });

  // Filter users button
  $(document).on('click', '.filter-users', function (event) {
    event.preventDefault();

    //$(this).parents('form:first').submit();
    var search = $('input[name="search"]').val();
    var url = 'index.php?option=com_briefcasefactory&view=shareusers&format=raw&search=' + search;

    $.get(url, function (response) {
      $('.update').html(response);
      $('input[type="checkbox"][name="cid[]"]').each(function (index, elem) {
        var elem = $(this);
        var id   = elem.attr('value');

        for (var i = 0, length = selected.length; i < length; i++) {
          if (selected[i] == id) {
            elem.attr('checked', true);
            break;
          }
        }
      });
    });
  });

  // Submit button.
  $('.button-share').click(function (event) {
    event.preventDefault();

    var form  = $(this).parents('form:first');

    selected.each(function (index) {
      form.append('<input type="hidden" name="jform[users][]" value="' + index + '" />');
    });

    form.submit();
  });

  // Cancel button.
  $('.button-cancel').click(function (event) {
    event.preventDefault();

    window.parent.SqueezeBox.close();
  });

  // Checkbox.
  $(document).on('change', 'input[name="cid[]"]', function (event) {
    var elem = $(this);
    var id   = elem.attr('value');

    var length = selected.length;

    if (elem.attr('checked')) {
      var found = false;
      for (var i = 0; i < length; i++) {
        if (selected[i] == id) {
          found = true;
          break;
        }
      }

      if (!found) {
        selected.push(id);
      }
    } else {
      for (var i = 0; i < length; i++) {
        if (selected[i] == id) {
          selected.splice(i, 1);
          break;
        }
      }
    }
  });

  Joomla.checkAll = function(checkbox, stub) {
  };

  // Check all.
  $(document).on('change', 'input[name="checkall-toggle"]', function (event) {
    var elem = $(this);
    var checked = elem.is(':checked');

    $('input[name="cid[]"]').attr('checked', checked).change();
  });
});
