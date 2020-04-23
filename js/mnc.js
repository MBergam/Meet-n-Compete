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