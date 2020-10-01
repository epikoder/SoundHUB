"use strict";

var _app = require("./app");

var _require = require("axios"),
    Axios = _require["default"];

var _require2 = require('howler'),
    Howl = _require2.Howl; // Get DOM elements


var player_min = document.getElementsByClassName("player-min")[0];
var timer = document.getElementsByClassName("timer")[0];
var duration = document.getElementsByClassName("duration")[0];
var progress = document.getElementsByClassName("progress")[0];
var art = document.getElementsByClassName("info-art")[0];
var title = document.getElementsByClassName("info-title")[0];
var artist = document.getElementsByClassName("info-artist")[0];
var playBtn = document.getElementsByClassName("playBtn")[0];
var pauseBtn = document.getElementsByClassName("pauseBtn")[0];
var loading = document.getElementsByClassName("loading")[0];
var prevBtn = document.getElementsByClassName("prevBrn")[0];
var nextBtn = document.getElementsByClassName("nextBtn")[0];
var seekBtn = document.getElementsByClassName("seekBtn")[0];
var closeBtn = document.getElementsByClassName("close-player")[0];
var play = document.getElementById("play");
var CancelToken = Axios.CancelToken;
var cancel;
/**
 * Player Class
 * @param {Number} playlists
 */

var Player = function Player(playlists) {
  this.playlists = playlists;
  this.index = 0;
  this.songID = 0;
};

Player.prototype = {
  /**
   * Play the loaded song
   */
  play: function play(index) {
    var self = this;
    var sound;
    index = typeof index === "number" ? index : self.index;
    var data = self.playlists[index];

    if (data.howl) {
      sound = data.howl;
    } else {
      sound = data.howl = new Howl({
        src: [self.playlists[index].url],
        //html5: true,
        onplay: function onplay() {
          playBtn.style.display = "none";
          pauseBtn.style.display = "block";
          loading.style.display = 'none';
          duration.innerHTML = self.formatTime(Math.round(sound.duration()));
          requestAnimationFrame(self.step.bind(self));
        },
        onload: function onload() {
          playBtn.style.display = "none";
          pauseBtn.style.display = "block";
        },
        onend: function onend() {
          self.skip("next");
        },
        onstop: function onstop() {
          seekBtn.style.marginLeft = progress.style.width = "0%";
        },
        onseek: function onseek() {
          requestAnimationFrame(self.step.bind(self));
        }
      });
    }

    self.songID = sound.play(self.songID !== 0 ? self.songID : null);
    window['sound'] = sound;
    window['id'] = self.id;

    if (sound.state() == "loading") {
      playBtn.style.display = "none";
      pauseBtn.style.display = "none";
      loading.style.display = 'block';
    }

    title.innerHTML = data.title;
    artist.innerHTML = data.artist;
    art.src = data.art;
    player_min.style.background = data.color[0];
    self.index = index;
  },
  pause: function pause() {
    var self = this;
    var sound = self.playlists[self.index].howl;
    sound.pause(self.songID);
    playBtn.style.display = "block";
    pauseBtn.style.display = "none";
  },
  skip: function skip(direction) {
    var self = this;
    var index = 0;

    if (direction == "prev") {
      index = self.index - 1;

      if (index < 0) {
        index = self.playlists.length - 1;
      }
    } else {
      index = self.index - 1;

      if (index >= self.playlists.length) {
        index = 0;
      }
    }

    self.skipTo(index);
  },
  skipTo: function skipTo(index) {
    var self = this;

    if (self.playlists[self.index].howl) {
      self.playlists[self.index].howl.stop();
    }

    progress.style.width = "0%";
    seekBtn.style.marginLeft = "0%";
    self.play[index];
  },
  seek: function seek(per) {
    var self = this;
    var sound = self.playlists[self.index].howl;

    if (sound.playing()) {
      sound.seek(sound.duration() * per);
    }
  },
  step: function step() {
    var self = this;
    var sound = self.playlists[self.index].howl;
    var seek = sound.seek() || 0;
    timer.innerHTML = self.formatTime(Math.round(seek));
    progress.style.width = (seek / sound.duration() * 100 || 0) + "%";
    seekBtn.style.marginLeft = (seek / sound.duration() * 100 || 0) + "%";

    if (sound.playing()) {
      requestAnimationFrame(self.step.bind(self));
    }
  },
  formatTime: function formatTime(secs) {
    var minutes = Math.floor(secs / 60) || 0;
    var secounds = secs - minutes * 60 || 0;
    return minutes + ":" + (secounds < 10 ? 0 : "") + secounds;
  }
};

function setData() {
  var data;
  return regeneratorRuntime.async(function setData$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          if (cancel) {
            cancel();
          }

          Axios.get(playUrl, {
            cancelToken: new CancelToken(function executor(c) {
              cancel = c;
            }),
            params: {
              type: _type,
              slug: slug
            }
          }).then(function (response) {
            player.playlists = response.data;
            window["player"] = player;
          })["catch"](function (thrown) {
            if (!Axios.isCancel(thrown)) {
              (0, _app.toast)("Unexpected Error occured", 3000);
            }
          });
          return _context.abrupt("return", data);

        case 3:
        case "end":
          return _context.stop();
      }
    }
  });
}

var called = false;

if (play) {
  var player = new Player();
  setData();
  pauseBtn.style.display = "none";
  play.addEventListener("click", function () {
    if (!called) {
      var _player_min = document.getElementsByClassName("player-min")[0];
      _player_min.style.display = "block";
      player.play();
      called = true;
    }

    var player_min = document.getElementsByClassName("player-min")[0];
    player_min.style.display = "block";
  });
  playBtn.addEventListener("click", function () {
    player.play();
  });
  pauseBtn.addEventListener("click", function () {
    player.pause();
  });
  closeBtn.addEventListener("click", function () {
    var player_min = document.getElementsByClassName("player-min")[0];
    setTimeout(function () {
      player_min.style.display = "none";
    }, 250);
  });
}