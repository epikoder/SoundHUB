"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _jqueryForm = _interopRequireDefault(require("jquery-form"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var regexEmail = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
(0, _jquery["default"])(".name").on("keyup", function () {
  var name = (0, _jquery["default"])(".name").val();

  if (name.length <= 5 || name.indexOf(" ") > -1) {
    (0, _jquery["default"])(".name_error").removeClass("text-blue-500");
    (0, _jquery["default"])(".name_error").addClass("text-red-600");
    return false;
  }

  (0, _jquery["default"])(".name_error").removeClass("text-red-600");
  (0, _jquery["default"])(".name_error").addClass("text-blue-500");
});
(0, _jquery["default"])(".email").on("keyup", function () {
  var email = (0, _jquery["default"])(".email").val();

  if (!regexEmail.test(email) || email.indexOf(" ") > -1) {
    (0, _jquery["default"])(".email_error").removeClass("text-blue-500");
    (0, _jquery["default"])(".email_error").addClass("text-red-600");
    return false;
  }

  (0, _jquery["default"])(".email_error").removeClass("text-red-600");
  (0, _jquery["default"])(".email_error").addClass("text-blue-500");
});

function validate() {
  var name = (0, _jquery["default"])(".name").val();
  var email = (0, _jquery["default"])(".email").val();

  if (name.length <= 5 || name.indexOf(" ") > -1) {
    alert("Please fill in the form");
    return false;
  }

  if (!regexEmail.test(email) || email.indexOf(" ") > -1) {
    alert("Enter a valid email address");
    return false;
  }

  window.NP.start();
}

function callback() {
  window.NP.done();
  (0, _jquery["default"])(".form").remove();
  (0, _jquery["default"])(".frame").load(route);
}

function errorCall(error) {
  alert(error.responseJSON.message);
  window.NP.done();
}

(0, _jquery["default"])("form").ajaxForm({
  beforeSend: validate,
  success: callback,
  error: errorCall
});