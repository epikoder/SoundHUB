"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _axios = _interopRequireDefault(require("axios"));

var _select = _interopRequireDefault(require("select2"));

var _app = require("./../app");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var home = document.getElementById("home");
var upload = document.getElementById("upload");
var al_upload = document.getElementById("al-upload");
var manage = document.getElementById("manage");
var content = document.getElementById("content");
var CancelToken = _axios["default"].CancelToken;
var cancel;
var current = home;
home.addEventListener("click", function () {
  clicked(home, homeUrl);
});
upload.addEventListener("click", function () {
  clicked(upload, uploadUrl);
});
al_upload.addEventListener("click", function () {
  clicked(al_upload, albumUrl);
});
manage.addEventListener("click", function () {
  clicked(manage, manageUrl);
});

function rc(destination) {
  destination.classList.add("text-blue-500");
  current == destination ? null : current.classList.remove("text-blue-500");
  current = destination;
}

function clicked(destination, url) {
  NP.start();
  rc(destination);
  load(url);
}

function load(url) {
  if (cancel) {
    cancel();
  }

  _axios["default"].get(url, {
    cancelToken: new CancelToken(function executor(c) {
      cancel = c;
    })
  }).then(function (response) {
    content.innerHTML = response.data;
    (0, _jquery["default"])('.select2').select2();
    NP.done();
  })["catch"](function (thrown) {
    if (!_axios["default"].isCancel(thrown)) {
      console.log(thrown);
    }
  });
}

(0, _jquery["default"])(function () {
  var media = document.getElementById("media");
  media.style.backgroundColor = "blue";
  media.style.color = "white";
  clicked(home, homeUrl);
});
var x;
var labelVal;
(0, _jquery["default"])("#content").on("change", '.inputfile', function (e) {
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
(0, _jquery["default"])('#content').on('submit', 'form', function (e) {
  e.preventDefault();

  _jquery["default"].ajax({
    url: (0, _jquery["default"])(this).attr("action"),
    type: (0, _jquery["default"])(this).attr("method"),
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function success(data, status) {
      (0, _app.toast)(data.status, 3000);
      clicked(upload, uploadUrl);
    },
    error: function error(xhr, desc, err) {
      console.log(err);
      console.log(xhr);
    }
  });
});