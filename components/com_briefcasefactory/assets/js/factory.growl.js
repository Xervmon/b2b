(function($) {
  $.factoryGrowl = function (response) {
    var message, type;

    type = response.status ? 'success' : 'error';

    if (undefined != response.error) {
      message = '<b>' + response.message + '</b><br />' + response.error;
    }
    else {
      message = response.message;
    }

    $.bootstrapGrowl(message, { type: type });
  }
})(jQuery);
