require('./bootstrap');
import Cookies from "js-cookie";
import $ from 'jquery';
import NP from 'nprogress';

window.NP = NP;
NP.start();
function sc(a = {}, n = "SoundHUB", l = 14) {
    Cookies.set(n, JSON.stringify(a), { expires: l, path: "/" });
    return gc(n);
}

function gc(n = "SoundHUB") {
    var c = Cookies.get(n);
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
    return $(x).hide();
}

$(document).ready(function () {
    NP.done();
})
/**Home */
var c = boot();
setup();

$(".switch").on("click", function() {
    if (c.switch == 0) {
        $(".switch").removeClass("night");
        $(".switch").addClass("day");
        $("#home").removeClass("home_night");
        c.switch = 1;
        sc(c);
        return;
    }
    if (c.switch == 1) {
        $(".switch").removeClass("day");
        $(".switch").addClass("night");
        $("#home").addClass("home_night");
        c.switch = 0;
        sc(c);
        return;
    }
});
function setup() {
    if (c.switch == null) {
        c.switch = 1;
        sc(c);
    }
    if (c.switch == 0) {
        $(".switch").removeClass("day");
        $(".switch").addClass("night");
        $("#home").addClass("home_night");
        return;
    }
    if (c.switch == 1) {
        $(".switch").removeClass("night");
        $(".switch").addClass("day");
        $("#home").removeClass("home_night");
        return;
    }
}
export { sc, gc, hide, boot};
