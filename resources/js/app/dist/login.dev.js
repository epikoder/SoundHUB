"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _jqueryForm = _interopRequireDefault(require("jquery-form"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

(0, _jquery["default"])('form').ajaxForm({
  success: success,
  error: error
});

function success(response) {
  if (response.artist) {
    location.assign(response.url['dashboard']);
  } else {
    location.assign(response.url['pay']);
  }
}

function error(error) {
  alert(response.responseJSON.message);
}