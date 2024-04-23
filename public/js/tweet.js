import likeList from "/js/like.js";
import unlikeList from "/js/unlike.js";
import deleteP from "/js/deletePost.js";

let foryou = document.getElementById("forYou");
let following = document.getElementById("following");
let tweetType = localStorage.getItem("type") || "foryou";

foryou.onclick = () => {
    localStorage.setItem("type", "foryou");
    tweetType = "foryou";
    ajax(tweetType);
};
following.onclick = () => {
    localStorage.setItem("type", "following");
    tweetType = "following";
    ajax("following");
};
let a_like_tags;
let a_unlike_tags;
let a_posts_tags;

// refreshes tweets
async function ajax(type = tweetType) {
    await $.ajax({
        type: "post",
        url: "/ajaxReq",
        data: { type: type },
        success: function (data) {
            document.getElementsByClassName("tweet-container")[0].innerHTML =
                data;
        },
    });
    a_like_tags = likeList();
    a_unlike_tags = unlikeList();
    a_posts_tags = deleteP();
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
    a_posts_tags.forEach((tag) => {
        tag.onclick = () => {
            deletePost(tag.id);
        };
    });

    if (tweetType == "foryou") {
        foryou.style.backgroundColor = "var(--secondary-color)";
        following.style.backgroundColor = "black";
    } else {
        following.style.backgroundColor = "var(--secondary-color)";
        foryou.style.backgroundColor = "black";
    }
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

function deletePost(id) {
    $.ajax({
        type: "post",
        url: "/deletePost",
        data: {
            postID: id,
        },
        success: function () {
            ajax();
        },
    });
}
ajax();
