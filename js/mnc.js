$(document).ready(function () {

    $('#search_text_input').focus(function () {
        if(window.matchMedia("(min-width: 500px)").matches){
            $(this).animate({width: '250px'},500);
        }
    });

    $('.button_holder').on('click',function () {
        document.search_form.submit();
    })

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

$(document).click(function (e) {
    if(e.target.class != "search_result" && e.target.id != "search_text_input"){
        $(".search_result").html("");
        $('.search_result_footer').html("");
        $('.search_result_footer').toggleClass("search_result_footer_empty");
        $('.search_result_footer').toggleClass("search_result_footer");
    }
    if(e.target.class != "dropdown_data_window"){
        $(".dropdown_data_window").html("");
        $(".dropdown_data_window").css({"padding":"0px", "height":"0px"})
    }

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

function getLiveSearchUsers(value,user){
    $.post("ajax_search.php", {query:value, userLogin: user}, function (data) {
        if($(".search_result_footer_empty")[0]){
            $(".search_result_footer_empty").toggleClass("search_result_footer");
            $(".search_result_footer_empty").toggleClass("search_result_footer_empty");
        }

        $('.search_result').html(data);
        $('.search_result_footer').html("<a href='search.php?q="+value+"'> See all results</a>");

        if(data == ""){
            $('.search_result_footer').html("");
            $('.search_result_footer').toggleClass("search_result_footer_empty");
            $('.search_result_footer').toggleClass("search_result_footer");

        }
    });
}