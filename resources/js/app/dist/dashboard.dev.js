"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _jqueryForm = _interopRequireDefault(require("jquery-form"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var a = 0;
var b = 0;
var c = 0;
var d = 0;
var e = 0;
(0, _jquery["default"])(document).ready(function () {
  (0, _jquery["default"])(".es").hide();
  (0, _jquery["default"])("#profileI").hide();
  (0, _jquery["default"])("#mediaI").hide();
  (0, _jquery["default"])("#promoI").hide();
  (0, _jquery["default"])("#metricsI").hide();
  return (0, _jquery["default"])("#settingsI").hide();
});
(0, _jquery["default"])(".esb").on("click", function () {
  (0, _jquery["default"])(".es").show();
});
(0, _jquery["default"])('.cs').on('click', function () {
  (0, _jquery["default"])('.es').hide();
});
(0, _jquery["default"])("#profile").on("click", function () {
  pr();
});
(0, _jquery["default"])("#media").on("click", function () {
  mb();
});
(0, _jquery["default"])("#promo").on("click", function () {
  ps();
});
(0, _jquery["default"])("#metrics").on("click", function () {
  me();
});
(0, _jquery["default"])("#settings").on("click", function () {
  se();
});

function pr() {
  if (a == 1) {
    a = 0;
    (0, _jquery["default"])("#profile").removeClass("bg-gray-200");
    return (0, _jquery["default"])("#profileI").hide();
  }

  a = 1;
  (0, _jquery["default"])("#profile").addClass("bg-gray-200");
  return (0, _jquery["default"])("#profileI").show();
}

function mb() {
  if (b == 1) {
    b = 0;
    (0, _jquery["default"])("#media").removeClass("bg-gray-200");
    return (0, _jquery["default"])("#mediaI").hide();
  }

  b = 1;
  (0, _jquery["default"])("#media").addClass("bg-gray-200");
  return (0, _jquery["default"])("#mediaI").show();
}

function ps() {
  if (c == 1) {
    c = 0;
    (0, _jquery["default"])("#promo").removeClass("bg-gray-200");
    return (0, _jquery["default"])("#promoI").hide();
  }

  c = 1;
  (0, _jquery["default"])("#promo").addClass("bg-gray-200");
  return (0, _jquery["default"])("#promoI").show();
}

function me() {
  if (d == 1) {
    d = 0;
    (0, _jquery["default"])("#metrics").removeClass("bg-gray-200");
    return (0, _jquery["default"])("#metricsI").hide();
  }

  d = 1;
  (0, _jquery["default"])("#metrics").addClass("bg-gray-200");
  return (0, _jquery["default"])("#metricsI").show();
}

function se() {
  if (e == 1) {
    e = 0;
    (0, _jquery["default"])("#settings").removeClass("bg-gray-200");
    return (0, _jquery["default"])("#settingsI").hide();
  }

  e = 1;
  (0, _jquery["default"])("#settings").addClass("bg-gray-200");
  return (0, _jquery["default"])("#settingsI").show();
}

(0, _jquery["default"])('form').ajaxForm({
  beforeSubmit: function beforeSubmit() {
    window.NP.start();
  },
  success: function success() {
    window.NP.done();
    alert('');
    (0, _jquery["default"])('.es').hide();
    location.reload();
  },
  error: function error(response) {
    console.log(response);
    alert('An error occured');
    window.NP.done();
  }
});