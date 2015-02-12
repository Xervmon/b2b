jQuery(document).ready(function ($) {
  $('a', 'table tbody').click(function (event) {
    event.preventDefault();

    var $element = $(this),
        id = $element.data('id'),
        username = $element.data('username');

    window.parent.jQuery('#jform_user_id_username').val(username);
    window.parent.jQuery('#jform_user_id').val(id).trigger('change');
    window.parent.SqueezeBox.close();
  });
});
