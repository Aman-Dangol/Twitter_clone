import x from "/js/like.js";
let a_tags;
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
    a_tags = x();
    a_tags.forEach((tag) => {
        console.log(tag);
        tag.onclick = () => {
            console.log(tag.id);
            like(tag.id);
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
ajax();
