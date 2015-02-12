jQuery(document).ready(function ($) {
  // Cancel button.
  $('.button-cancel').click(function (event) {
    event.preventDefault();

    parent.SqueezeBox.close();
  });

  // Move button.
  $('.button-move').click(function (event) {
    event.preventDefault();

    $(this).parents('form:first').submit();
  });
});
