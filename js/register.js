$(document).ready(function () {
   //On click signup, hide login and show reg form
   $("#signup").click(function () {
        $(".login_form").slideUp("Slow",function () {
            $(".signup_form").slideDown("slow");
        })
   });

   //opposite way
    $("#signin").click(function () {
        $(".signup_form").slideUp("Slow",function () {
            $(".login_form").slideDown("slow");
        })
    });
});