"use strict";

var _jquery = _interopRequireDefault(require("jquery"));

var _axios = _interopRequireDefault(require("axios"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var livesearch;
var CT = _axios["default"].CancelToken;
var cancel;
(0, _jquery["default"])(".search").on("focus", function () {
  (0, _jquery["default"])(".search-bar").show();
  (0, _jquery["default"])(".main-search").trigger('focus');
});
(0, _jquery["default"])(".btn-search").on("click", function () {
  (0, _jquery["default"])(".search-bar").show();
  (0, _jquery["default"])(".main-search").trigger('focus');
});
(0, _jquery["default"])(".main-search").on("focusout", function () {
  (0, _jquery["default"])('.livesearch').hide();
});
(0, _jquery["default"])(".main-search").on("focus", function () {
  (0, _jquery["default"])(".livesearch").show();
});
(0, _jquery["default"])(".close-search").on("click", function () {
  (0, _jquery["default"])(".livesearch").remove();
  setTimeout(function () {
    (0, _jquery["default"])('.search-bar').hide();
  }, 250);
});
(0, _jquery["default"])(".main-search").on("keyup", function (e) {
  if (this.value == null || this.value == "") {
    (0, _jquery["default"])(".livesearch").remove();
    return false;
  }

  if (cancel !== undefined) {
    cancel();
  }

  _axios["default"].get(search, {
    cancelToken: new CT(function executor(c) {
      cancel = c;
    }),
    params: {
      str: this.value
    }
  }).then(function (response) {
    searchResult(response.data);
  })["catch"](function (thrown) {
    if (!_axios["default"].isCancel(thrown)) {//handle error
    }
  });
});

function searchResult(data) {
  if (!Array.isArray(data.result.artist) && !Array.isArray(data.result.media)) {
    return false;
  }

  (0, _jquery["default"])(".livesearch").remove();
  livesearch = document.createElement("div");
  livesearch.className = "livesearch fixed z-50 bg-gray-300 flex w-full px-2";
  livesearch.innerHTML = '<div class="node w-5/6 m-auto block"></div>';
  (0, _jquery["default"])("nav").append(livesearch);
  var search = (0, _jquery["default"])(".node").get([0]); // artist

  var artistSize = data.result.artist.length < 4 ? data.result.artist.length : 4;
  var mediaSize = data.result.media.length < 8 ? data.result.media.length : 8;

  if (artistSize == 0 && mediaSize == 0) {
    return search.innerHTML = '<p class="p-2 m-auto">No result found!</p>';
  }

  if (artistSize > 0) {
    for (var index = 0; index <= artistSize; index++) {
      if (index == 0) {
        search.innerHTML += '<div class="w-full px-1 font-bold font-mono border-b border-black">Artists</div>';
      }

      search.innerHTML += '<div class="w-full flex p-1 search-result font-semibold font-mono"><a class="" href="' + data.result.artist[index].url + '">' + data.result.artist[index].name + "</a></div>";
    }
  } //media


  if (mediaSize > 0) {
    var callable = true;

    for (var _index = 0; _index <= mediaSize; _index++) {
      if (data.result.media[_index].type == "album") {
        if (_index == 0) {
          search.innerHTML += '<div class="w-full px-1 font-bold font-mono border-b border-black">Albums</div>';
        }

        if (_index < 4) {
          search.innerHTML += '<div class="w-full flex p-1 search-result"><a class="w-full" href="' + data.result.media[_index].url + '">' + '<div class="w-full block">' + '<p class="p-0 m-0 font-semibold">' + data.result.media[_index].title + "</p > " + '<p class="p-0 m-0 text-sm">' + data.result.media[_index].artist + "</p > " + "</div > " + "</a></div>";
        }
      } else {
        if (callable) {
          callable = false;
          search.innerHTML += '<div class="w-full px-1 font-bold font-mono border-b border-black">Tracks</div>';
        }

        search.innerHTML += '<div class="w-full flex p-1 search-result"><a class="w-full" href="' + data.result.media[_index].url + '">' + '<div class="w-full block">' + '<p class="p-0 m-0 font-semibold">' + data.result.media[_index].title + "</p > " + '<p class="p-0 m-0 text-sm">' + data.result.media[_index].artist + "</p > " + "</div > " + "</a></div>";
      }
    }
  }
}