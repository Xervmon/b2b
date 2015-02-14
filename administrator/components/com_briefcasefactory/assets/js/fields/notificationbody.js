jQuery(document).ready(function ($) {
  var tokens = null;

  // Change notification type.
  $('.notification-type').change(function (event) {
    var value = $(this).val();
    var body = $('.notification-body');
    var table = body.find('.tokens');

    if (null === tokens) {
      tokens = JSON.decode(body.attr('data-tokens'));
    }

    table.html('');

    $.each(tokens[value], function (key, value) {
      table.append('<tr><td><a href="#" class="notification-legend">{{ ' + key + ' }}</a></td><td style="width: 30px; text-align: center;">&dash;</td><td>' + value + '</td></tr>');
    });

  }).change();

  // Click on token.
  $(document).on('click', '.notification-legend', function (event) {
    event.preventDefault();

    var elem = $(this);
    var token = elem.text();

    jInsertEditorText(token, 'jform_body')
  });
});
