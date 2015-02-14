jQuery(document).ready(function ($) {
  // Cancel button.
  $('.button-cancel').click(function (event) {
    event.preventDefault();

    parent.SqueezeBox.close();
  });

  // Share button.
  $('.button-share').click(function (event) {
    event.preventDefault();

    $(this).parents('form:first').submit();
  });
});
