let mainPost = "";
function getPost() {
    mainPost = document.querySelector(".like");
    if (mainPost) {
        console.log(mainPost);
        mainPost.onclick = () => {
            like(mainPost.id);
        };
    } else {
        mainPost = document.querySelector(".unlike");
        mainPost.onclick = () => {
            unlike(mainPost.id);
        };
    }
}
getPost();

function like(id) {
    $.ajax({
        type: "get",
        url: "/like",
        data: {
            id: id,
        },
        success: function () {
            console.log("success");
            location.reload();
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
            console.log("success");
            location.reload()
        },
    });
}
