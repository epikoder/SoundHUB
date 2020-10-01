import $ from "jquery";
import ajaxForm from "jquery-form";

let regexEmail = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);

$(".name").on("keyup", function() {
    let name = $(".name").val();
    if (name.length <= 5 || name.indexOf(" ") > -1) {
        $(".name_error").removeClass("text-blue-500");
        $(".name_error").addClass("text-red-600");
        return false;
    }
    $(".name_error").removeClass("text-red-600");
    $(".name_error").addClass("text-blue-500");
});

$(".email").on("keyup", function() {
    let email = $(".email").val();
    if (!regexEmail.test(email) || email.indexOf(" ") > -1) {
        $(".email_error").removeClass("text-blue-500");
        $(".email_error").addClass("text-red-600");
        return false;
    }
    $(".email_error").removeClass("text-red-600");
    $(".email_error").addClass("text-blue-500");
});

function validate() {
    let name = $(".name").val();
    let email = $(".email").val();
    if (name.length <= 5 || name.indexOf(" ") > -1) {
        alert("Please fill in the form");
        return false;
    }
    if (!regexEmail.test(email) || email.indexOf(" ") > -1) {
        alert("Enter a valid email address");
        return false;
    }
    NP.start();
}

function callback() {
    NP.done();
    $(".form").remove();
    $(".frame").load(route);
}

function errorCall(error) {
    alert(error.responseJSON.message);
    NP.done();
}

$("form").ajaxForm({
    beforeSend: validate,
    success: callback,
    error: errorCall
});
