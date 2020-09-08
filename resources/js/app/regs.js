import $ from 'jquery';
import ajaxForm from 'jquery-form';

var regexEmail = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);

$(".name").on("keyup", function() {
    var name = $(".name").val();
    if (name.length <= 5 || name.indexOf(" ") > -1) {
        $(".name_error").removeClass("text-blue-500");
        $(".name_error").addClass("text-red-600");
        return false;
    }
    $(".name_error").removeClass("text-red-600");
    $(".name_error").addClass("text-blue-500");
});

$(".email").on("keyup", function() {
    var email = $(".email").val();
    if (!regexEmail.test(email) || email.indexOf(" ") > -1) {
        $(".email_error").removeClass("text-blue-500");
        $(".email_error").addClass("text-red-600");
        return false;
    }
    $(".email_error").removeClass("text-red-600");
    $(".email_error").addClass("text-blue-500");
});

function validate() {
    var name = $(".name").val();
    var email = $(".email").val();
    if (name.length <= 5 || name.indexOf(" ") > -1) {
        alert("Please fill in the form");
        return false;
    }
    if (!regexEmail.test(email) || email.indexOf(" ") > -1) {
        alert("Enter a valid email address");
        return false;
    }
    window.NP.start();
}

function callback() {
    window.NP.done();
    $(".form").remove();
    $(".frame").load(route);
}

function errorCall(error) {
    alert(error.responseJSON.message);
    window.NP.done();
}

$("form").ajaxForm({
    beforeSend: validate,
    success: callback,
    error: errorCall
});
