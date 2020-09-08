import $ from "jquery";
import ajaxForm from 'jquery-form';
import selectize from "selectize";

/** Custom select */
var x;
var labelVal;
$('.tracks').on('change','.inputfile', function (e) {
    var label = this.nextElementSibling;
    if (!x) {
        x = 1;
        labelVal = label.innerHTML;
    }
    var name = null;
    name = e.target.value.split("\\").pop();
    if (name) {
        return (label.innerHTML = name);
    } else {
        label.innerHTML = labelVal;
    }
})

/** Counter */
var num = 2;
$(".add").on("click", function() {
    ++num;
    $(`<div class="py-2 t` +
            num +
            `">
                    <div class="py-2">
                        Title : <input type="text" name="title` +
            num +
            `" class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4 m-1" maxlength="80" required><br>
                        Artist :
                        <input class="w-2/4 p-1 rounded border-2 border-gray-400" type="text" value="`+artist+`" disabled>
                        <input type="text" name="feat` +
            num +
            `"
                                class="border-b-2 border-gray-700 input focus:border-green-400 outline-none px-2 w-2/4 m-1" maxlength="80"
                                placeholder="Feat">
                        </div>
                        <div>
                        <input type="checkbox" name="check` +
            num +
            `" id="check` +
            num +
            `" checked readonly>
            <input id="track` +
            num +
            `" type="file" name="track` +
            num +
            `" accept="audio/*"
                class="inputfile new" required>
            <label for="track` +
            num +
            `"
                class="input-bg text-black border-black border rounded-md mx-2 px-2 py-1 hover:text-white hover:bg-black">
                    Choose file...
            </label>`).appendTo('.tracks');
});

$(".remove").on("click", function() {
    for (var i = 3; i <= num; i++) {
        if (!$("#check" + i).is(":checked")) {
            $(".t" + i).remove();
        }
    }
});

function validate() {
    if ($("input[name=_token]").fieldValue() == "") {
        return false;
    }
}

function enableSubmit() {
    $(".submit").removeClass("bg-black");
    $(".submit").removeClass("text-white");
    $(".submit").prop("disabled", false);
    var bar = $(".bar");
    var percent = $(".percent");
    var percentVal = "0%";
    bar.width(percentVal);
    percent.html(percentVal);
}

function callback(response) {
    enableSubmit();
    alert(response.message);
}

function errorcall(error) {
    enableSubmit();
    if (response.message) {
        alert(response.message);
    } else alert("Error: Unknown");
}
$('form').ajaxForm({
    beforeSubmit: validate,
    data: {
        num: function () {
            return num;
        }
    },
    beforeSend: function() {
        $(".submit").addClass("bg-black");
        $(".submit").addClass("text-white");
        $(".submit").prop("disabled", true);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var bar = $(".bar");
        var percent = $(".percent");
        var percentVal = percentComplete + "%";
        bar.width(percentVal);
        percent.html(percentVal);
    },
    success: callback,
    error: errorcall
});
