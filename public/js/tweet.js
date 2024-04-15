import likeList from "/js/like.js";
import unlikeList from "/js/unlike.js";
let a_like_tags;
let a_unlike_tags;
async function ajax() {
    await $.ajax({
        type: "post",
        url: "/ajaxReq",
        data: {
            1: "asd",
        },
        success: function (data) {
            document.getElementsByClassName("tweet-container")[0].innerHTML =
                data;
        },
    });
    a_like_tags = likeList();
    a_unlike_tags = unlikeList();
    a_like_tags.forEach((tag) => {
        tag.onclick = () => {
            like(tag.id);
        };
    });
    a_unlike_tags.forEach((tag) => {
        tag.onclick = () => {
            unlike(tag.id);
        };
    });
}

function like(id) {
    $.ajax({
        type: "get",
        url: "/like",
        data: {
            id: id,
        },
        success: function () {
            ajax();
        },
    });
}
function unlike(id) {
    $.ajax({
        type: "get",
        url: "/unlike",
        data: {
            id: id,
        },
        success: function () {
            ajax();
        },
    });
}
ajax();
