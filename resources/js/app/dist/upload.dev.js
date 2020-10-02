"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _jqueryForm = _interopRequireDefault(require("jquery-form"));

var _select = _interopRequireDefault(require("select2"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var x;
var labelVal;
(0, _jquery["default"])(".inputfile").on("change", function (e) {
  var label = this.nextElementSibling;

  if (!x) {
    x = 1;
    labelVal = label.innerHTML;
  }

  var name = null;
  name = e.target.value.split("\\").pop();

  if (name) {
    return label.innerHTML = name;
  } else {
    label.innerHTML = labelVal;
  }
});
(0, _jquery["default"])("form").ajaxForm({
  beforeSubmit: validate,
  success: callback,
  error: error
});

function validate() {
  var track = (0, _jquery["default"])(".track").val();
  var title = (0, _jquery["default"])(".title").val();

  if (track && title) {
    (0, _jquery["default"])(".submit").prop("disabled", true);
    return true;
  }

  (0, _jquery["default"])(".submit").prop("disabled", false);
  return false;
}

function callback(response) {
  if (response.responseJSON) {
    alert(response.responseJSON.message);
  } else {
    alert(response.message);
  }

  (0, _jquery["default"])(".submit").prop("disabled", false);
}

function error(error) {
  if (error.status == 401) {
    location.assign(login);
  } else {
    alert(error.responseJSON.message);
  }

  (0, _jquery["default"])(".submit").prop("disabled", false);
}

(0, _jquery["default"])(function () {
  (0, _jquery["default"])('.select2').select2();
});