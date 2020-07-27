import Cookies from 'https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.mjs';
function sc(a = {}, n = 'SoundHUB', l = 14) {
    Cookies.set(n, JSON.stringify(a), { expires: l, path: '/' });
    return gc(n);
}

function gc(n = 'SoundHUB') {
    var c = Cookies.get(n)
    if (!c) {
        return c
    }
    return JSON.parse(c)
}

function boot() {
    var c = (gc()) ? gc() : sc();
    return c;
}

function hide(x) {
    return $(x).hide();
}

function vi(i, d) {
    i = $(i).val()
    if (i.length < 6) { // WHITE SPACE
        $(d).addClass('border-red-300');
        $(d).removeClass('hover:border-green-300')
        _return = false
    } else {
        $(d).addClass('hover:border-green-300')
        $(d).removeClass('border-red-300')
        _return = true
    }
}
export { sc, gc, vi, hide, boot,  };
