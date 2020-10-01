import { toast } from "./app";
const { default: Axios } = require("axios");
const { Howl } = require('howler');

// Get DOM elements
const player_min = document.getElementsByClassName("player-min")[0];
const timer = document.getElementsByClassName("timer")[0];
const duration = document.getElementsByClassName("duration")[0];
const progress = document.getElementsByClassName("progress")[0];
const art = document.getElementsByClassName("info-art")[0];
const title = document.getElementsByClassName("info-title")[0];
const artist = document.getElementsByClassName("info-artist")[0];
const playBtn = document.getElementsByClassName("playBtn")[0];
const pauseBtn = document.getElementsByClassName("pauseBtn")[ 0 ];
const loading = document.getElementsByClassName("loading")[0];
const prevBtn = document.getElementsByClassName("prevBrn")[0];
const nextBtn = document.getElementsByClassName("nextBtn")[0];
const seekBtn = document.getElementsByClassName("seekBtn")[0];
const closeBtn = document.getElementsByClassName("close-player")[0];
const play = document.getElementById("play");

const CancelToken = Axios.CancelToken;
let cancel;

/**
 * Player Class
 * @param {Number} playlists
 */
var Player = function(playlists) {
    this.playlists = playlists;
    this.index = 0;
    this.songID = 0;
};

Player.prototype = {
    /**
     * Play the loaded song
     */
    play: function(index) {
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
                onplay: function () {
                    playBtn.style.display = "none";
                    pauseBtn.style.display = "block";
                    loading.style.display = 'none';

                    duration.innerHTML = self.formatTime(
                        Math.round(sound.duration())
                    );
                    requestAnimationFrame(self.step.bind(self));
                },
                onload: function() {
                    playBtn.style.display = "none";
                    pauseBtn.style.display = "block";
                },
                onend: function() {
                    self.skip("next");
                },
                onstop: function() {
                    seekBtn.style.marginLeft = progress.style.width = "0%";
                },
                onseek: function() {
                    requestAnimationFrame(self.step.bind(self));
                }
            });
        }
        self.songID = sound.play(self.songID !== 0 ? self.songID : null);
        window[ 'sound' ] = sound;
        window[ 'id' ] = self.id;

        if (sound.state() == "loading") {
            playBtn.style.display = "none";
            pauseBtn.style.display = "none";
            loading.style.display = 'block';
        }

        title.innerHTML = data.title;
        artist.innerHTML = data.artist;
        art.src = data.art;
        player_min.style.background = data.color[ 0 ];

        self.index = index;
    },
    pause: function() {
        var self = this;
        var sound = self.playlists[self.index].howl;
        sound.pause(self.songID);

        playBtn.style.display = "block";
        pauseBtn.style.display = "none";
    },
    skip: function(direction) {
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
    skipTo: function(index) {
        var self = this;

        if (self.playlists[self.index].howl) {
            self.playlists[self.index].howl.stop();
        }
        progress.style.width = "0%";
        seekBtn.style.marginLeft = "0%";
        self.play[index];
    },
    seek: function(per) {
        var self = this;
        var sound = self.playlists[self.index].howl;

        if (sound.playing()) {
            sound.seek(sound.duration() * per);
        }
    },
    step: function() {
        var self = this;
        var sound = self.playlists[self.index].howl;

        var seek = sound.seek() || 0;
        timer.innerHTML = self.formatTime(Math.round(seek));
        progress.style.width = ((seek / sound.duration()) * 100 || 0) + "%";
        seekBtn.style.marginLeft =
            ((seek / sound.duration()) * 100 || 0) + "%";

        if (sound.playing()) {
            requestAnimationFrame(self.step.bind(self));
        }
    },
    formatTime: function(secs) {
        let minutes = Math.floor(secs / 60) || 0;
        let secounds = secs - minutes * 60 || 0;
        return minutes + ":" + (secounds < 10 ? 0 : "") + secounds;
    }
};

async function setData() {
    if (cancel) {
        cancel();
    }
    let data;
    Axios.get(playUrl, {
        cancelToken: new CancelToken(function executor(c) {
            cancel = c;
        }),
        params: {
            type: _type,
            slug: slug
        }
    })
        .then(response => {
            player.playlists = response.data;
            window["player"] = player;
        })
        .catch(thrown => {
            if (!Axios.isCancel(thrown)) {
                toast("Unexpected Error occured", 3000);
            }
        });
    return data;
}


let called = false;
if (play) {
    var player = new Player();
    setData();
    pauseBtn.style.display = "none";
    play.addEventListener("click", function() {
        if (!called) {
            let player_min = document.getElementsByClassName("player-min")[0];
            player_min.style.display = "block";
            player.play();
            called = true;
        }
        let player_min = document.getElementsByClassName("player-min")[0];
        player_min.style.display = "block";
    });
    playBtn.addEventListener("click", function() {
        player.play();
    });
    pauseBtn.addEventListener("click", function() {
        player.pause();
    });

    closeBtn.addEventListener("click", function() {
        let player_min = document.getElementsByClassName("player-min")[0];
        setTimeout(function() {
            player_min.style.display = "none";
        }, 250);
    });
}
