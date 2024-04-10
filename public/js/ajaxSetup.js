import * as ajax from "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js";
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
