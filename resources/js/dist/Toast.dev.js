"use strict";

var _this = void 0;

var Toast = function Toast() {
  this.text;
  this.closeType;
};

Toast.prototype = {
  /**
   * Show text
   * @param {string} _text
   * @param {boolean|Number} _close
   */
  show: function show(_text, _close) {
    _this.text = _text;

    if (typeof _close === 'boolean') {
      self.closeType = _close;
    } else {
      self.duration = _close;
    }
  },

  /**
   * Make the view
   */
  make: function make() {
    if (_this.closeType) {
      var closeToast = document.createElement("div");
      var span = document.createElement("span");
      span.className = "pl-4 pr-2 text-sm closeToast";
      span.innerHTML = "x";
      closeToast.appendChild(span);
    } else {
      var bar = document.createElement("div");
      bar.className = "toastBar h-1 bg-blue-500";
    }

    var toast = document.createElement('div');
    var toastInner = document.createElement('div');
    toast.className = 'toast';
    toastInner.className = 'p-2 flex justify-between';
    toastInner.innerHTML = l;
  },
  setText: function setText() {
    var text = document.createElement('div');
    return text.appendChild(_this.text);
  }
};
var toast = "<div class=\"toast\">\n            <div class=\"p-2 flex justify-between\">\n                <div class\"px-2\">\n                " + text + "\n                </div>\n                " + closeToast + "\n            </div>\n            " + bar + "\n        </div>";
body.innerHTML += toast;

if ($(".toast").get([0]) && $(".toastClose").get([0])) {
  $(".closeToast").on("click", function () {
    $(".toast").remove();
  });
} else if (duration) {
  durationHandler(duration);
} else {
  $(document).on("click", function () {
    $(".toast").remove();
  });
}

function durationHandler(duration) {
  var bar, barPercent, durationLeft, x, timeout, interval;
  return regeneratorRuntime.async(function durationHandler$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          bar = $(".toastBar");
          barPercent = 100;
          x = 1;
          timeout = 50;
          bar.width(barPercent + "%");
          interval = setInterval(function () {
            durationLeft = duration - timeout * x++;
            barPercent = durationLeft / duration * 100;

            if (durationLeft <= 0) {
              $(".toast").remove();
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