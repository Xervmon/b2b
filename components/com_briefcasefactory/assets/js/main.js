var BriefcaseFactory = {
  options: {},

  set: function (option, value) {
    if (typeof option == 'object') {
      for (var variable in option) {
        BriefcaseFactory.set(variable, option[variable]);
      }
    } else {
      this.options[option] = value;
    }
  },

  get: function (option, defaults) {
    defaults = typeof defaults !== 'undefined' ? defaults : null;

    if (typeof this.options[option] === 'undefined') {
      return defaults;
    }

    return this.options[option];
  },

  route: function (option, defaults) {
    option = 'route' + option;

    return BriefcaseFactory.get(option, defaults);
  }
}
