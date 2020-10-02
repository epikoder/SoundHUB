"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _jqueryForm = _interopRequireDefault(require("jquery-form"));

var _select = _interopRequireDefault(require("select2"));

var _app = require("../app");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

/** Custom select */
var x;
var labelVal;
(0, _jquery["default"])(".tracks").on("change", ".inputfile", function (e) {
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
/** Counter */

var _num = 2;
(0, _jquery["default"])(".add").on("click", function () {
  ++_num;
  (0, _jquery["default"])("<div class=\"py-2 t" + _num + "\">\n                    <div class=\"py-2\">\n                        Title : <input type=\"text\" name=\"title" + _num + "\" class=\"border-b-2 input focus:border-green-400 outline-none px-2 w-2/4 m-1\" maxlength=\"80\" required><br>\n                        Artist :\n                        <input class=\"w-2/4 p-1 rounded border-2 border-gray-400\" type=\"text\" value=\"" + artist + "\" disabled>\n                        <input type=\"text\" name=\"feat" + _num + "\"\n                                class=\"border-b-2 border-gray-700 input focus:border-green-400 outline-none px-2 w-2/4 m-1\" maxlength=\"80\"\n                                placeholder=\"Feat\">\n                        </div>\n                        <div>\n                        <input type=\"checkbox\" name=\"check" + _num + "\" id=\"check" + _num + "\" checked readonly>\n            <input id=\"track" + _num + "\" type=\"file\" name=\"track" + _num + "\" accept=\"audio/*\"\n                class=\"inputfile new\" required>\n            <label for=\"track" + _num + "\"\n                class=\"input-bg text-black border-black border rounded-md mx-2 px-2 py-1 hover:text-white hover:bg-black\">\n                    Choose file...\n            </label>").appendTo(".tracks");
});
(0, _jquery["default"])(".remove").on("click", function () {
  for (var i = 3; i <= _num; i++) {
    if (!(0, _jquery["default"])("#check" + i).is(":checked")) {
      (0, _jquery["default"])(".t" + i).remove();
    }
  }
});

function validate() {
  if ((0, _jquery["default"])("input[name=_token]").fieldValue() == "") {
    return false;
  }
}

function enableSubmit() {
  (0, _jquery["default"])(".submit").removeClass("bg-black");
  (0, _jquery["default"])(".submit").removeClass("text-white");
  (0, _jquery["default"])(".submit").prop("disabled", false);
  var bar = (0, _jquery["default"])(".bar");
  var percent = (0, _jquery["default"])(".percent");
  var percentVal = "0%";
  bar.width(percentVal);
  percent.html(percentVal);
}

function callback(response) {
  enableSubmit();
  (0, _app.toast)(response.message, 3000);
}

function errorcall(error) {
  enableSubmit();

  if (response.message) {
    (0, _app.toast)(response.message, 3000);
  } else (0, _app.toast)("Error: Unknown", 3000);
}

(0, _jquery["default"])("form").ajaxForm({
  beforeSubmit: validate,
  data: {
    num: function num() {
      return _num;
    }
  },
  beforeSend: function beforeSend() {
    (0, _jquery["default"])(".submit").addClass("bg-black");
    (0, _jquery["default"])(".submit").addClass("text-white");
    (0, _jquery["default"])(".submit").prop("disabled", true);
  },
  uploadProgress: function uploadProgress(event, position, total, percentComplete) {
    var bar = (0, _jquery["default"])(".bar");
    var percent = (0, _jquery["default"])(".percent");
    var percentVal = percentComplete + "%";
    bar.width(percentVal);
    percent.html(percentVal);
  },
  success: callback,
  error: errorcall
});
(0, _jquery["default"])(function () {
  (0, _jquery["default"])(".select2").select2();
});