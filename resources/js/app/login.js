import $ from "jquery";
import ajaxForm from "jquery-form";
import { toast } from "../app";

////EYE
let eye;
$(".eye").on("click", function() {
    if (!eye) {
        eye = true;
        $(".eye").get([0]).innerHTML = "Hide";
        return $(".password").prop("type", "text");
    }
    eye = false;
    $(".eye").get([0]).innerHTML = "Show";
    return $(".password").prop("type", "password");
});

$("form").ajaxForm({
    beforeSubmit: () => {
        NP.start();
    },
    success: success,
    error: error
});

function success(response) {
    if (response.artist) {
        location.assign(response.url["dashboard"]);
    } else {
        location.assign(response.url["pay"]);
    }
}

function error(error) {
    NP.done();
    toast(error.responseJSON.message);
}
