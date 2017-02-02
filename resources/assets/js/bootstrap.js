window.$ = window.jQuery = require('jquery');
window.CSRFTOKEN = $('meta[name="csrf-token"]').attr('content') || null;
window._ = require('lodash');
