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

// Confirm the delete action of the CMS page
// $(document).on("click", ".confirmDelete", function () {
//     var name = $(this).attr("name");
//     if (confirm("Are you sure you want to delete this " + name + "?")) {
//         return true;
//     } else {
//         return false;
//     }
// });

// Confirm the delete action with SweetAlert
$(document).on("click", ".confirmDelete", function () {
    var record = $(this).attr("record");
    var recordid = $(this).attr("recordid");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire({
            //     title: "Deleted!",
            //     text: "Your file has been deleted.",
            //     icon: "success",
            // });
            window.location.href = "/admin/delete-" + record + "/" + recordid;
        }
    });
});

// Update Subadmin Status
$(document).on("click", ".updateSubadminStatus", function () {
    var status = $(this).attr("status"); // obtain the current status
    var subadmin_id = $(this).attr("subadmin_id"); // obtain the page id

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url: "/admin/update-subadmin-status",
        data: { status: status, subadmin_id: subadmin_id },
        success: function (resp) {
            if (resp.status == 0) {
                $("#subadmin-" + resp.subadmin_id).attr("status", "Inactive");
                $("#subadmin-" + resp.subadmin_id).html(
                    "<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>"
                );
            } else if (resp.status == 1) {
                $("#subadmin-" + resp.subadmin_id).attr("status", "Active");
                $("#subadmin-" + resp.subadmin_id).html(
                    "<i class='fas fa-toggle-on' style='color:#135964' status='Active'></i>"
                );
            }
        },
        error: function () {
            alert("Error");
        },
    });
});
// Update Category Status
$(document).on("click", ".updateCategoryStatus", function () {
    var status = $(this).attr("status"); // obtain the current status
    var category_id = $(this).attr("category_id"); // obtain the page id

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url: "/admin/update-category-status",
        data: { status: status, category_id: category_id },
        success: function (resp) {
            if (resp.status == 0) {
                $("#category-" + resp.category_id).attr("status", "Inactive");
                $("#category-" + resp.category_id).html(
                    "<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>"
                );
            } else if (resp.status == 1) {
                $("#category-" + resp.category_id).attr("status", "Active");
                $("#category-" + resp.category_id).html(
                    "<i class='fas fa-toggle-on' style='color:#135964' status='Active'></i>"
                );
            }
        },
        error: function () {
            alert("Error");
        },
    });
});
