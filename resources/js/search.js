import $ from "jquery";
import axios from "axios";

var livesearch;
const CT = axios.CancelToken;
let cancel;
$(".search").on("focus", function () {
    $(".search-bar").show();
    $(".main-search").trigger('focus');
});
$(".btn-search").on("click", function() {
    $(".search-bar").show();
    $(".main-search").trigger('focus');
});

$(".main-search").on("focusout", function() {
    $('.livesearch').hide();
});
$(".main-search").on("focus", function() {
    $(".livesearch").show();
});

$(".close-search").on("click", function() {
    $(".livesearch").remove();
    setTimeout(function () {
        $('.search-bar').hide();
    }, 250);
});

$(".main-search").on("keyup", function(e) {
    if (this.value == null || this.value == "") {
        $(".livesearch").remove();
        return false;
    }
    if (cancel !== undefined) {
        cancel();
    }
    axios
        .get(search, {
            cancelToken: new CT(function executor(c) {
                cancel = c;
            }),
            params: {
                str: this.value
            }
        })
        .then(response => {
            searchResult(response.data);
        })
        .catch(thrown => {
            if (!axios.isCancel(thrown)) {
                //handle error
            }
        });
});

function searchResult(data) {
    if (
        !Array.isArray(data.result.artist) &&
        !Array.isArray(data.result.media)
    ) {
        return false;
    }
    $(".livesearch").remove();
    livesearch = document.createElement("div");
    livesearch.className =
        "livesearch fixed z-50 bg-gray-300 flex w-full px-2";
    livesearch.innerHTML = '<div class="node w-5/6 m-auto block"></div>';
    $("nav").append(livesearch);

    let search = $(".node").get([0]);
    // artist
    let artistSize =
        data.result.artist.length < 4 ? data.result.artist.length : 4;
    let mediaSize = data.result.media.length < 8 ? data.result.media.length : 8;
    if (artistSize == 0 && mediaSize == 0) {
        return (search.innerHTML =
            '<p class="p-2 m-auto">No result found!</p>');
    }
    if (artistSize > 0) {
        for (let index = 0; index <= artistSize; index++) {
            if (index == 0) {
                search.innerHTML +=
                    '<div class="w-full px-1 font-bold font-mono border-b border-black">Artists</div>';
            }
            search.innerHTML +=
                '<div class="w-full flex p-1 search-result font-semibold font-mono"><a class="" href="' +
                data.result.artist[index].url +
                '">' +
                data.result.artist[index].name +
                "</a></div>";
        }
    }

    //media
    if (mediaSize > 0) {
        let callable = true;
        for (let index = 0; index <= mediaSize; index++) {
            if (data.result.media[index].type == "album") {
                if (index == 0) {
                    search.innerHTML +=
                        '<div class="w-full px-1 font-bold font-mono border-b border-black">Albums</div>';
                }
                if (index < 4) {
                    search.innerHTML +=
                        '<div class="w-full flex p-1 search-result"><a class="w-full" href="' +
                        data.result.media[index].url +
                        '">' +
                        '<div class="w-full block">' +
                        '<p class="p-0 m-0 font-semibold">' +
                        data.result.media[index].title +
                        "</p > " +
                        '<p class="p-0 m-0 text-sm">' +
                        data.result.media[index].artist +
                        "</p > " +
                        "</div > " +
                        "</a></div>";
                }
            } else {
                if (callable) {
                    callable = false;
                    search.innerHTML +=
                        '<div class="w-full px-1 font-bold font-mono border-b border-black">Tracks</div>';
                }
                search.innerHTML +=
                    '<div class="w-full flex p-1 search-result"><a class="w-full" href="' +
                    data.result.media[index].url +
                    '">' +
                    '<div class="w-full block">' +
                    '<p class="p-0 m-0 font-semibold">' +
                    data.result.media[index].title +
                    "</p > " +
                    '<p class="p-0 m-0 text-sm">' +
                    data.result.media[index].artist +
                    "</p > " +
                    "</div > " +
                    "</a></div>";
            }
        }
    }
}
