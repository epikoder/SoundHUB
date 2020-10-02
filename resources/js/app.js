require("./bootstrap");
import Cookies from "js-cookie";
import $ from "jquery";
import NP from "nprogress";

window['NP'] = NP;
NP.start();
function sc(a = {}, n = "SoundHUB", l = 14) {
    Cookies.set(n, JSON.stringify(a), { expires: l, path: "/" });
    return gc(n);
}

function gc(n = "SoundHUB") {
    let c = Cookies.get(n);
    if (!c) {
        return c;
    }
    return JSON.parse(c);
}

function boot() {
    let c = gc() ? gc() : sc();
    return c;
}

function hide(x) {
    return $(x).hide();
}

$(function() {
    NP.done();
});
/**Home */
let c = boot();
setup();

$(".switch-btn").on("click", function() {
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

function toast(text = null, duration = 3000, close = true) {
    let body = $("body").get([0]);
    if (close) {
        var closeToast = `<div>
            <span class="pl-4 pr-2 text-sm closeToast">X</span>
        </div>`;
    }
    if (duration) {
        var bar = `<div class="toastBar h-1 bg-blue-500">
        </div>`;
    }
    let toast =
        `<div class="toast">
        <div class="p-2 flex justify-between">
            <div class"px-2">
            ` +
        text +
        `
            </div>
            ` +
        closeToast +
        `
        </div>
        ` +
        bar +
        `
    </div>`;

    body.innerHTML += toast;
    if ($(".toast").get([0]) && $(".toastClose").get([0])) {
        $(".closeToast").on("click", function() {
            $(".toast").remove();
        });
    } else if (duration) {
        durationHandler(duration);
    } else {
        $(document).on("click", function() {
            $(".toast").remove();
        });
    }
}

async function durationHandler(duration) {
    let bar = $(".toastBar");
    let barPercent = 100;
    let durationLeft;
    let x = 1;
    let timeout = 50;
    bar.width(barPercent + "%");
    const interval = setInterval(() => {
        durationLeft = duration - timeout * x++;
        barPercent = (durationLeft / duration) * 100;
        if (durationLeft <= 0) {
            $(".toast").remove();
            clearInterval(interval);
        }
        bar.width(barPercent + "%");
    }, timeout);
}

export { sc, gc, hide, boot, toast };
