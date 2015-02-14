jQuery(document).ready(function ($) {
  // Remove shares.
  $(document).on('click', 'ul.shares a', function (event) {
    event.preventDefault();

    var elem = $(this);
    var url  = elem.attr('href');

    $.get(url, function (response) {
      if (response.status) {
        elem.parents('li:first').remove();
      }
    }, 'json');
  });
});
