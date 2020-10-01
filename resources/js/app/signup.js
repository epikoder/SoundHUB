import $ from "jquery";
import ajaxForm from "jquery-form";

let _return = false;

$(".password").on("keyup", function() {
    vi(".password", ".div-p");
});

$(".c-password").on("keyup", function() {
    let p = $(".password").val();
    let cp = $(".c-password").val();
    let d = ".div-cp";
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
    if (i.length <= 7 || i.indexOf(" ") > -1) {
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
    NP.start();
}
function callback() {
    NP.done();
    location.replace(login);
}
function errrorcall(error) {
    alert(error.responseJSON.message);
    NP.done();
}

$("#signup").ajaxForm({
    beforeSend: validate,
    success: callback,
    error: errrorcall
});
