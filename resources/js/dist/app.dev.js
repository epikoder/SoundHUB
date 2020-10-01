"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.sc = sc;
exports.gc = gc;
exports.hide = hide;
exports.boot = boot;
exports.toast = toast;

var _jsCookie = _interopRequireDefault(require("js-cookie"));

var _jquery = _interopRequireDefault(require("jquery"));

var _nprogress = _interopRequireDefault(require("nprogress"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

require("./bootstrap");

window[_nprogress["default"]] = _nprogress["default"];

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

(0, _jquery["default"])(function () {
  _nprogress["default"].done();
});
/**Home */

var c = boot();
setup();
(0, _jquery["default"])(".switch-btn").on("click", function () {
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

function toast() {
  var text = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 3000;
  var close = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  var body = (0, _jquery["default"])("body").get([0]);

  if (close) {
    var closeToast = "<div>\n            <span class=\"pl-4 pr-2 text-sm closeToast\">X</span>\n        </div>";
  }

  if (duration) {
    var bar = "<div class=\"toastBar h-1 bg-blue-500\">\n        </div>";
  }

  var toast = "<div class=\"toast\">\n        <div class=\"p-2 flex justify-between\">\n            <div class\"px-2\">\n            " + text + "\n            </div>\n            " + closeToast + "\n        </div>\n        " + bar + "\n    </div>";
  body.innerHTML += toast;

  if ((0, _jquery["default"])(".toast").get([0]) && (0, _jquery["default"])(".toastClose").get([0])) {
    (0, _jquery["default"])(".closeToast").on("click", function () {
      (0, _jquery["default"])(".toast").remove();
    });
  } else if (duration) {
    durationHandler(duration);
  } else {
    (0, _jquery["default"])(document).on("click", function () {
      (0, _jquery["default"])(".toast").remove();
    });
  }
}

function durationHandler(duration) {
  var bar, barPercent, durationLeft, x, timeout, interval;
  return regeneratorRuntime.async(function durationHandler$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          bar = (0, _jquery["default"])(".toastBar");
          barPercent = 100;
          x = 1;
          timeout = 50;
          bar.width(barPercent + "%");
          interval = setInterval(function () {
            durationLeft = duration - timeout * x++;
            barPercent = durationLeft / duration * 100;

            if (durationLeft <= 0) {
              (0, _jquery["default"])(".toast").remove();
              clearInterval(interval);
            }

            bar.width(barPercent + "%");
          }, timeout);

        case 6:
        case "end":
          return _context.stop();
      }
    }
  });
}