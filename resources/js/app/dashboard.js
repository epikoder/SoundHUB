import $ from "jquery";
import ajaxForm from "jquery-form";
window.$ = $
var a = 0;
var b = 0;
var c = 0;
var d = 0;
var e = 0;
$(document).ready(function() {
    $("#profileI").hide();
    $("#mediaI").hide();
    $("#promoI").hide();
    $("#metricsI").hide();
    $("#settingsI").hide();
    $('.menu').show();
    /*
    if (no_handle) {
        alert("You don't have a social handle configured! :\\");
    }*/
});

$(".esb").on("click", function() {
    $(".es").show();
});

$(".cs").on("click", function() {
    $(".es").hide();
});

$("#profile").on("click", function() {
    pr();
});
$("#media").on("click", function() {
    mb();
});
$("#promo").on("click", function() {
    ps();
});
$("#metrics").on("click", function() {
    me();
});
$("#settings").on("click", function() {
    se();
});

$('.logout').on('click', function () {
    $(
        `<div class="pop fixed absolute flex background w-full h-full top-0">
            <div class="m-auto mt-2/5 p-4 bg-gray-300 text-black font-mono">
                <h1 class=" mb-8">Wants to logout ?</h1>
                <div class="flex justify-between">
                    <button class="close my-2 input-bg text-black border-black border rounded-full p hover:text-white hover:bg-black">
                        No
                    </button>
                    <a href="`+logout+`" class="my-2 input-bg text-black border-black border rounded-full p hover:text-white hover:bg-black">
                        Yes
                    </a>
                </div>
            </div>
        </div>`
    ).appendTo(document.body);
})
$(document.body).on('click', '.close', function () {
    $('.pop').remove();
});

function pr() {
    if (a == 1) {
        a = 0;
        $("#profile").removeClass("bg-gray-200");
        return $("#profileI").hide();
    }
    a = 1;
    $("#profile").addClass("bg-gray-200");
    return $("#profileI").show();
}

function mb() {
    if (b == 1) {
        b = 0;
        $("#media").removeClass("bg-gray-200");
        return $("#mediaI").hide();
    }
    b = 1;
    $("#media").addClass("bg-gray-200");
    return $("#mediaI").show();
}

function ps() {
    if (c == 1) {
        c = 0;
        $("#promo").removeClass("bg-gray-200");
        return $("#promoI").hide();
    }
    c = 1;
    $("#promo").addClass("bg-gray-200");
    return $("#promoI").show();
}

function me() {
    if (d == 1) {
        d = 0;
        $("#metrics").removeClass("bg-gray-200");
        return $("#metricsI").hide();
    }
    d = 1;
    $("#metrics").addClass("bg-gray-200");
    return $("#metricsI").show();
}

function se() {
    if (e == 1) {
        e = 0;
        $("#settings").removeClass("bg-gray-200");
        return $("#settingsI").hide();
    }
    e = 1;
    $("#settings").addClass("bg-gray-200");
    return $("#settingsI").show();
}

$("form").ajaxForm({
    beforeSubmit: function() {
        window.NP.start();
    },
    success: function() {
        window.NP.done();
        alert("");
        $(".es").hide();
        location.reload();
    },
    error: function(response) {
        console.log(response);
        alert("An error occured");
        window.NP.done();
    }
});
