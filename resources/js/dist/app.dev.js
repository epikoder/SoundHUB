"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.sc = sc;
exports.gc = gc;
exports.hide = hide;
exports.boot = boot;

var _jsCookie = _interopRequireDefault(require("js-cookie"));

var _jquery = _interopRequireDefault(require("jquery"));

var _nprogress = _interopRequireDefault(require("nprogress"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

require('./bootstrap');

window.NP = _nprogress["default"];

_nprogress["default"].start();

function sc() {
  var a = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  var n = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "SoundHUB";
  var l = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 14;

  _jsCookie["default"].set(n, JSON.stringify(a), {
    expires: l,
    path: "/"
  });

  return gc(n);
}

function gc() {
  var n = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "SoundHUB";

  var c = _jsCookie["default"].get(n);

  if (!c) {
    return c;
  }

  return JSON.parse(c);
}

function boot() {
  var c = gc() ? gc() : sc();
  return c;
}

function hide(x) {
  return (0, _jquery["default"])(x).hide();
}

(0, _jquery["default"])(document).ready(function () {
  window.NP.done();
});
/**Home */

var c = boot();
setup();
(0, _jquery["default"])(".switch").on("click", function () {
  if (c["switch"] == 0) {
    (0, _jquery["default"])(".switch").removeClass("night");
    (0, _jquery["default"])(".switch").addClass("day");
    (0, _jquery["default"])("#home").removeClass("home_night");
    c["switch"] = 1;
    sc(c);
    return;
  }

  if (c["switch"] == 1) {
    (0, _jquery["default"])(".switch").removeClass("day");
    (0, _jquery["default"])(".switch").addClass("night");
    (0, _jquery["default"])("#home").addClass("home_night");
    c["switch"] = 0;
    sc(c);
    return;
  }
});

function setup() {
  if (c["switch"] == null) {
    c["switch"] = 1;
    sc(c);
    alert(c["switch"]);
  }

  if (c["switch"] == 0) {
    (0, _jquery["default"])(".switch").removeClass("day");
    (0, _jquery["default"])(".switch").addClass("night");
    (0, _jquery["default"])("#home").addClass("home_night");
    return;
  }

  if (c["switch"] == 1) {
    (0, _jquery["default"])(".switch").removeClass("night");
    (0, _jquery["default"])(".switch").addClass("day");
    (0, _jquery["default"])("#home").removeClass("home_night");
    return;
  }
}