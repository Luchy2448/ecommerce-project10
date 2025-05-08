$(document).ready(function () {
    //  Check admin password is correct or not
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
        // alert(current_pwd);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/check-current-password",
            data: { current_pwd: current_pwd },
            success: function (resp) {
                if (resp === "false") {
                    $("#verifyCurrentPwd").html(
                        "Current password is incorrect!"
                    );
                } else if (resp === "true") {
                    $("#verifyCurrentPwd").html("Current password is correct!");
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
});

// Update CMS Page Status
$(document).on("click", ".updateCmsPageStatus", function () {
    var status = $(this).attr("status"); // obtain the current status
    var page_id = $(this).attr("page_id"); // obtain the page id

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url: "/admin/update-cms-page-status",
        data: { status: status, page_id: page_id },
        success: function (resp) {
            if (resp.status == 0) {
                $("#page-" + resp.page_id).attr("status", "Inactive");
                $("#page-" + resp.page_id).html(
                    "<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>"
                );
            } else if (resp.status == 1) {
                $("#page-" + resp.page_id).attr("status", "Active");
                $("#page-" + resp.page_id).html(
                    "<i class='fas fa-toggle-on' style='color:#135964' status='Active'></i>"
                );
            }
        },
        error: function () {
            alert("Error");
        },
    });
});
