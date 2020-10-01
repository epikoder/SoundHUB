"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _jqueryForm = _interopRequireDefault(require("jquery-form"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var _return = false;
(0, _jquery["default"])(".password").on("keyup", function () {
  vi(".password", ".div-p");
});
(0, _jquery["default"])(".c-password").on("keyup", function () {
  var p = (0, _jquery["default"])(".password").val();
  var cp = (0, _jquery["default"])(".c-password").val();
  var d = ".div-cp";

  if (p != cp) {
    (0, _jquery["default"])(d).addClass("border-red-300");
    (0, _jquery["default"])(d).removeClass("hover:border-green-300");
    _return = false;
  } else {
    (0, _jquery["default"])(d).addClass("hover:border-green-300");
    (0, _jquery["default"])(d).removeClass("border-red-300");
    _return = true;
  }
});

function vi(i, d) {
  i = (0, _jquery["default"])(i).val();

  if (i.length <= 7 || i.indexOf(" ") > -1) {
    (0, _jquery["default"])(d).addClass("border-red-300");
    (0, _jquery["default"])(d).removeClass("hover:border-green-300");
    _return = false;
  } else {
    (0, _jquery["default"])(d).addClass("hover:border-green-300");
    (0, _jquery["default"])(d).removeClass("border-red-300");
    _return = true;
  }
}

function validate() {
  if (!_return) {
    return _return;
  }

  NP.start();
}

function callback() {
  NP.done();
  location.replace(login);
}

function errrorcall(error) {
  alert(error.responseJSON.message);
  NP.done();
}

(0, _jquery["default"])("#signup").ajaxForm({
  beforeSend: validate,
  success: callback,
  error: errrorcall
});