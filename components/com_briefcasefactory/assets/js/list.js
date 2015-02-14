jQuery(document).ready(function ($) {
  // Submit form when changing filters.
  $('.filters select, .filters input').change(function (event) {
    $(this).parents('form:first').submit();
  });

  // Batch buttons
  $('.button-batch a').click(function (event) {
    event.preventDefault();

    // Check if at least one resource is selected.
    if (!$.itemSelected()) {
      return true;
    }

    var elem     = $(this);
    var type     = elem.attr('class');
    var url      = elem.attr('href');
    var selected = $.selectedItems();

    switch (type) {
      case 'download':
        elem.parents('form:first').attr('action', url).submit();
        break;

      case 'unshare':
      case 'delete':
        $.post(url, selected, function (response) {
          $('.briefcase-update').trigger('update');
        });
        break;

      case 'move':
        var selected = $.selectedItems();
        var size = { x: 500, y: 200 };
        url += (false === url.indexOf('?') ? '?' : '&') + selected.serialize();

        SqueezeBox.open(url, { handler: 'iframe', size: size });
        break;
    }

    return true;
  });

  $.extend({
    // Check if at least one resource is selected.
    itemSelected: function () {
      if (0 == document.briefcaseForm.boxchecked.value) {
        $.factoryGrowl({ message: Joomla.JText._('COM_BRIEFCASEFACTORY_SELECT_ONE_ITEM') });
        return false;
      }

      return true;
    },

    // Get selected resources.
    selectedItems: function () {
      return $('input[name="file[]"]:checked, input[name="folder[]"]:checked', top.document);
    }
  });
});

// Override isChecked function.
Joomla.isChecked = function(isitchecked, form) {
  if (typeof(form) === 'undefined') {
    form = document.getElementById('briefcaseForm');
  }
  if (isitchecked == true) {
    form.boxchecked.value++;
  } else {
    form.boxchecked.value--;
  }
}
