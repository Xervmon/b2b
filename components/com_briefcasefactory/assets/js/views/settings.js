jQuery(document).ready(function ($) {
  // Form buttons.
  $('.buttons a').click(function (event) {
    event.preventDefault();

    var elem = $(this);
    var url  = elem.attr('href');

    elem.parents('form:first').attr('action', url).submit();
  });
});
