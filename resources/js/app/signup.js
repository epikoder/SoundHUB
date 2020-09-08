import $ from 'jquery';
import ajaxForm from 'jquery-form';

var _return = false;

$('.password').on('keyup', function () {
    vi('.password', '.div-p');
});

$('.c-password').on('keyup', function () {
    var p = $('.password').val();
    var cp = $('.c-password').val();
    var d = '.div-cp';
    if (p != cp) {
        $(d).addClass("border-red-300");
        $(d).removeClass("hover:border-green-300");
        _return = false;
    } else {
        $(d).addClass("hover:border-green-300");
        $(d).removeClass("border-red-300");
        _return = true;
    }
});
function vi(i, d) {
    i = $(i).val();
    if (i.length <= 5 || i.indexOf(" ") > -1) {
        $(d).addClass("border-red-300");
        $(d).removeClass("hover:border-green-300");
        _return = false;
    } else {
        $(d).addClass("hover:border-green-300");
        $(d).removeClass("border-red-300");
        _return = true;
    }
}
function validate() {
    if (!_return) {
        return _return;
    }
    window.NP.start();
}
function callback() {
    window.NP.done();
    location.replace(route);
}
function errrorcall(error) {
    alert(error.responseJSON.message);
    window.NP.done();
}

$('#signup').ajaxForm({
    beforeSend: validate,
    success: callback,
    error: errrorcall
});
