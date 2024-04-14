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
    console.log();
    a_like_tags = likeList();
    a_unlike_tags = unlikeList();
    a_like_tags.forEach((tag) => {
        console.log(tag);
        tag.onclick = () => {
            console.log(tag.id);
            like(tag.id);
        };
    });
    a_unlike_tags.forEach((tag) => {
        console.log(tag);
        tag.onclick = () => {
            console.log(tag.id);
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
            console.log("liked!!");
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
            console.log("unliked!!");
        },
    });
}
ajax();
