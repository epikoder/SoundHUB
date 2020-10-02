import $ from "jquery";
import axios from "axios";
import select2 from 'select2';
import { toast } from './../app';

const home = document.getElementById("home");
const upload = document.getElementById("upload");
const al_upload = document.getElementById("al-upload");
const manage = document.getElementById("manage");
const content = document.getElementById("content");
const CancelToken = axios.CancelToken;
let cancel;
let current = home;
home.addEventListener("click", function() {
    clicked(home, homeUrl);
});
upload.addEventListener("click", function() {
    clicked(upload, uploadUrl);
});
al_upload.addEventListener("click", function() {
    clicked(al_upload, albumUrl);
});
manage.addEventListener("click", function() {
    clicked(manage, manageUrl);
});

function rc(destination) {
    destination.classList.add("text-blue-500");
    current == destination ? null : current.classList.remove("text-blue-500");
    current = destination;
}
function clicked(destination, url) {
    NP.start();
    rc(destination);
    load(url);
}

function load(url) {
    if (cancel) {
        cancel();
    }
    axios
        .get(url, {
            cancelToken: new CancelToken(function executor(c) {
                cancel = c;
            })
        })
        .then(response => {
            content.innerHTML = response.data;
            $('.select2').select2()
            NP.done();
        })
        .catch(thrown => {
            if (!axios.isCancel(thrown)) {
                console.log(thrown);
            }
        });
}

$(function() {
    let media = document.getElementById("media");
    media.style.backgroundColor = "blue";
    media.style.color = "white";
    clicked(home, homeUrl);
});

let x;
let labelVal;
$("#content").on("change",'.inputfile', function(e) {
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

$('#content').on('submit','form', function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data, status) {
            toast(data.status, 3000);
            clicked(upload, uploadUrl);
        },
        error: function (xhr, desc, err) {
            console.log(err)
            console.log(xhr)
        }
    });
})
