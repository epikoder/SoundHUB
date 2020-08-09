import { vi, sc, gc } from '/js/app.js';
var _return;
$(document).ready(function () {
    _return = false;
    $('#p').on('input', vi('#p', '#div-p'));
    $('#cp').on('input', vi('#cp', '#div-cp'));
})

$(document).on('submit', 'form', function (e) {
    e.preventDefault();
    if (!_return) {
        return _return;
    }
    var url = $('form').attr('action');
    var form = new FormData($('form').get(0));
    form.append('password', $('#p').val());
    axios.post(url, form)
        .then((response) => {
            location.replace('/pay/plans');
        })
        .catch((response) => {
            location.assign('/');
        });
})
