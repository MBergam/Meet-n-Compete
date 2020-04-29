$(document).ready(function () {

    //button for profile post
    $('#submit_profile_post').click(function () {

        $.ajax({
           type: "POST",
           url: "ajax_submit_profile_post.php",
           data: $('form.profile_post').serialize(),
            success: function (msg) {
                $("#post_form").modal('hide');
                location.reload();
            },
            error: function () {
                alert('Failed!');
            }
        });
    });
});

function getUser(value, user) {
    $.post("ajax_friend_search.php", {query:value,userLogin:user}, function (data) {
        $(".results").html(data);
    });

}

function getDropdownData(user, type) {
    if($(".dropdown_data_window").css("height") == "0px"){

        var pageName;
        if(type == "notification"){
            pageName = "ajax_load_notifications.php";
            $("span").remove("#unread_notification");
        }

        else if (type == "message"){
            pageName = "ajax_load_messages.php";
            $("span").remove("#unread_message");

        }

        var ajaxreq = $.ajax({
           url: pageName,
            type: "POST",
            data: "page=1&userLogin=" + user,
            cache: false,

            success: function (response) {
                $(".dropdown_data_window").html(response);
                $(".dropdown_data_window").css({"padding": "0px", "height":"500px", "border":"1px solid #DADADA"});
                $("#dropdown_data_type").val(type);
            }
        });
    }

    else {
        $(".dropdown_data_window").html("");
        $(".dropdown_data_window").css({"padding": "0px", "height":"0px","border":"none"});
    }

}