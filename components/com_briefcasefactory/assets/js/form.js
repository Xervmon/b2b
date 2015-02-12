jQuery(document).ready(function ($) {
  // Remove empty fields when submitting a form.
  $('div.com_briefcasefactory form').submit(function (event) {
    $(this).find(':input').each(function (index, element) {
      var $element = $(element),
          value = $element.val();

      if ('' == value) {
        $element.attr('name', '');
      }
    });

    return true;
  });
});
