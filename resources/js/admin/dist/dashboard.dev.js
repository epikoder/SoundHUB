"use strict";

var _chart = _interopRequireDefault(require("chart.js"));

var _jquery = _interopRequireDefault(require("jquery"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var _char = (0, _jquery["default"])(".users")[0].getContext("2d");

_char = new _chart["default"](_char, {
  type: "doughnut",
  data: {
    labels: ["Users", "Paid"],
    datasets: [{
      label: "Users to Artist",
      data: [users, artists],
      backgroundColor: ["rgba(255, 99, 132)", "rgba(54, 162, 235)"],
      borderColor: ["rgba(255, 99, 132)", "rgba(54, 162, 235)"],
      borderWidth: 1
    }]
  }
}); //////////////

var dashboard = document.getElementById('dashboard');
dashboard.style.backgroundColor = 'blue';
dashboard.style.color = 'white';