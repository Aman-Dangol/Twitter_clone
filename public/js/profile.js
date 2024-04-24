import likeList from "/js/like.js";
import unlikeList from "/js/unlike.js";
import deleteP from "/js/deletePost.js";

let postsTab = document.getElementById("postsTab");
let userID = document.getElementById("userID").innerHTML;
let followerList = document.getElementById("followerList");
let followingList = document.getElementById("followingList");
let followers = document.getElementById("followers");
let following = document.getElementById("following");
console.log(following);

followers.onclick = () => {
    followerList.style.display = "flex";
};
followerList.onclick = () => {
    followerList.style.display = "none";
};
following.onclick = () => {
    followingList.style.display = "flex";
};
followingList.onclick = () => {
    followingList.style.display = "none";
};

async function loadTweets() {
    await $.ajax({
        type: "post",
        url: "/userPosts",
        data: {
            id: parseInt(userID),
        },
        success: (data) => {
            postsTab.innerHTML = data;
        },
    });

    let a_like_tags = likeList();
    let a_unlike_tags = unlikeList();
    let a_posts_tags = deleteP();
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
}

function like(id) {
    $.ajax({
        type: "get",
        url: "/like",
        data: {
            id: id,
        },
        success: function () {
            loadTweets();
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
            loadTweets();
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
            loadTweets();
        },
    });
}

loadTweets();
