"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _jqueryForm = _interopRequireDefault(require("jquery-form"));

var _app = require("../app");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

////EYE
var eye;
(0, _jquery["default"])(".eye").on("click", function () {
  if (!eye) {
    eye = true;
    (0, _jquery["default"])(".eye").get([0]).innerHTML = "Hide";
    return (0, _jquery["default"])(".password").prop("type", "text");
  }

  eye = false;
  (0, _jquery["default"])(".eye").get([0]).innerHTML = "Show";
  return (0, _jquery["default"])(".password").prop("type", "password");
});
(0, _jquery["default"])("form").ajaxForm({
  beforeSubmit: function beforeSubmit() {
    NP.start();
  },
  success: success,
  error: error
});

function success(response) {
  if (response.artist) {
    location.assign(response.url["dashboard"]);
  } else {
    location.assign(response.url["pay"]);
  }
}

function error(error) {
  NP.done();
  (0, _app.toast)(error.responseJSON.message);
}