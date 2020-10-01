"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _jqueryForm = _interopRequireDefault(require("jquery-form"));

var _axios = _interopRequireDefault(require("axios"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var _return;

(0, _jquery["default"])(".name").on("keyup", function () {
  var name = (0, _jquery["default"])(".name").val();
  var message = (0, _jquery["default"])(".message").get([0]);

  if (name.length < 4) {
    message.innerHTML = "too short!";
    return false;
  }

  _axios["default"].post(query, {
    name: name
  }).then(function (response) {
    if (response.status == 200) {
      _return = true;
      message.style.color = "teal";
      message.innerHTML = response.data.message;
    } else {
      _return = false;
      message.style.color = "red";
      message.innerHTML = response.data.message;
    }
  })["catch"](function (response) {
    alert("Error: unknown error");
  });
});
(0, _jquery["default"])("form").ajaxForm({
  beforeSend: function beforeSend() {
    return _return;
  },
  beforeSubmit: function beforeSubmit() {
    (0, _jquery["default"])(".submit").prop("disabled", true);
    NP.start();
  },
  success: function success(response) {
    location.replace(response.url);
  },
  error: function error(response) {
    (0, _jquery["default"])(".submit").prop("disabled", false);
    alert(response.message);
  }
});