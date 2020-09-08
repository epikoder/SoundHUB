import $ from 'jquery';
import ajaxForm from 'jquery-form';
import axios from 'axios';

var _return;
$('.name').on("keyup", function () {
    var name = $('.name').val();
    var message = $(".message").get([0]);
    if (name.length < 4) {
        message.innerHTML = 'too short!';
        return false;
    }
    axios.post(query, {
            name: name
    }).then((response) => {
        if (response.status == 200) {
            _return = true;
            message.style.color = "teal";
            message.innerHTML = response.data.message;
        } else {
            _return = false;
            message.style.color = "red";
            message.innerHTML = response.data.message;
        }
    }).catch((response) => {
        alert('Error: unknown error');
    })
})

$('form').ajaxForm({
    beforeSend: () => {
        return _return;
    },
    beforeSubmit: () => {
        $(".submit").prop("disabled", true);
        window.NP.start();
    },
    success: (response) => {
        location.replace(response.url);
    },
    error: (response) => {
        $(".submit").prop("disabled", false);
        alert(response.message);
    }
})
