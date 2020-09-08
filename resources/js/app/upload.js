import $ from 'jquery';
import ajaxForm from 'jquery-form';

var x;
var labelVal;
$('.inputfile').on('change', function (e) {
    var label = this.nextElementSibling;
    if (!x) {
        x = 1;
        labelVal = label.innerHTML;
    }
    var name = null;
    name = e.target.value.split('\\').pop();
    if (name) {
        return label.innerHTML = name;
    } else {
        label.innerHTML = labelVal;
    }
});

$('form').ajaxForm({
    beforeSubmit: validate,
    success: callback,
    error: error
})

function validate() {
    var track = $('.track').val();
    var title = $('.title').val();
    if (track && title) {
        $(".submit").prop("disabled", true);
        return true;
    }
    $(".submit").prop("disabled", false);
    return false;
}

function callback(response) {
    if (response.responseJSON) {
        alert(response.responseJSON.message);
    } else {
        alert(response.message);
    }
    $(".submit").prop("disabled", false);
}

function error(error) {
    if (error.status == 401) {
        location.assign(login);
    }
    else {
        alert(error.responseJSON.message);
    }
    $(".submit").prop("disabled", false);
}
