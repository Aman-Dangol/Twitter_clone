function ajax() {
    $.ajax({
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
}

ajax();
