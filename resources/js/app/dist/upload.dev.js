"use strict";

require("jquery");

var s = [];

function add() {
  var v = $("#select").val();
  var sv = s.values();
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = sv[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var x = _step.value;

      if (x == v) {
        return false;
      }
    }
  } catch (err) {
    _didIteratorError = true;
    _iteratorError = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion && _iterator["return"] != null) {
        _iterator["return"]();
      }
    } finally {
      if (_didIteratorError) {
        throw _iteratorError;
      }
    }
  }

  s.push(v);

  if (v == "year") {
    $("#addon").append('<input name="year" type="number" value="<?php echo(date("Y")); ?>" class="text-center outline-none border-b-2 input-u focus:border-green-300">');
  }

  if (v == "art") {
    $("#addon").append("<input name=\"art\" type=\"file\" class=\"text-center outline-none w-full\">\n                <div class=\"w-full text-left\"><input type=\"checkbox\" name=\"write\" class=\"text-center\"><span class=\"text-sm\">change default art?</span></div>");
  }

  return true;
}

function close() {
  location.assign("{{ route('dashboard/artists',['name' => $artist->name]) }}");
}

$(document).on("submit", "form", function () {
  window.NP.start();
});
$("#add").on("click", function (e) {
  e.preventDefault();
  add();
});
$("#close").on("click", function (e) {
  e.preventDefault();
  close();
});