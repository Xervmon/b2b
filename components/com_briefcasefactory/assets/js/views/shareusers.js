jQuery(document).ready(function ($) {
  var selected = [];

  // Pagination.
  $(document).on('click', '.pagination a', function (event) {
    event.preventDefault();

    $('.update').load($(this).attr('href'), { format: 'raw' }, function () {
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

  // Users filter.
  $(document).on('click', '.filter-users', function (event) {
    event.preventDefault();

    var elem   = $(this);
    var url    = elem.attr('href');
    var search = $('.search-query').val();

    $.get(url, { search: search, format: 'raw'}, function (response) {
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

  // Share button.
  $('.button-share-users').click(function (event) {
    event.preventDefault();

    var files = window.parent.jQuery.selectedItems();
    var form  = $('#adminForm');

    selected.each(function (index) {
      form.append('<input type="hidden" name="jform[users][]" value="' + index + '" />');
    });

    files.each(function (index, element) {
      var elem = $(element);
      form.append('<input type="hidden" name="jform[' + elem.attr('name').replace('[]', '') + '][]" value="' + elem.attr('value') + '" />');
    });

    form.submit();
  });
});
