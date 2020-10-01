import $ from "jquery";
import ajaxForm from "jquery-form";
import selectize from "selectize";
import { toast } from '../app';

/** Custom select */
let x;
let labelVal;
$(".tracks").on("change", ".inputfile", function(e) {
    let label = this.nextElementSibling;
    if (!x) {
        x = 1;
        labelVal = label.innerHTML;
    }
    let name = null;
    name = e.target.value.split("\\").pop();
    if (name) {
        return (label.innerHTML = name);
    } else {
        label.innerHTML = labelVal;
    }
});

/** Counter */
let num = 2;
$(".add").on("click", function() {
    ++num;
    $(
        `<div class="py-2 t` +
            num +
            `">
                    <div class="py-2">
                        Title : <input type="text" name="title` +
            num +
            `" class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4 m-1" maxlength="80" required><br>
                        Artist :
                        <input class="w-2/4 p-1 rounded border-2 border-gray-400" type="text" value="` +
            artist +
            `" disabled>
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
            </label>`
    ).appendTo(".tracks");
});

$(".remove").on("click", function() {
    for (let i = 3; i <= num; i++) {
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
    let bar = $(".bar");
    let percent = $(".percent");
    let percentVal = "0%";
    bar.width(percentVal);
    percent.html(percentVal);
}

function callback(response) {
    enableSubmit();
    toast(response.message, 3000);
}

function errorcall(error) {
    enableSubmit();
    if (response.message) {
        toast(response.message, 3000);
    } else toast("Error: Unknown", 3000);
}
$("form").ajaxForm({
    beforeSubmit: validate,
    data: {
        num: function() {
            return num;
        }
    },
    beforeSend: function() {
        $(".submit").addClass("bg-black");
        $(".submit").addClass("text-white");
        $(".submit").prop("disabled", true);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        let bar = $(".bar");
        let percent = $(".percent");
        let percentVal = percentComplete + "%";
        bar.width(percentVal);
        percent.html(percentVal);
    },
    success: callback,
    error: errorcall
});
