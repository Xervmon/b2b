jQuery(document).ready(function ($) {
  // Form buttons.
  $('.buttons a').click(function (event) {
    event.preventDefault();

    var elem = $(this);
    var url  = elem.attr('href');

    elem.parents('form:first').attr('action', url).submit();
  });

  $('#jform_user_id').change(function (event) {
    $(this).parents('form:first').submit();
  });

  // Select user button.
  $('.select-user').click(function (event) {
    event.preventDefault();

    var elem = $(this);
    var url  = elem.attr('href');
    var size = { x: 500, y: 600 };

    SqueezeBox.open(url, { handler: 'iframe', size: size });

    return true;
  });
});
