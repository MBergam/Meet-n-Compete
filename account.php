<?php
include 'header.php';

// Check for login to display this page
if(isset($_SESSION['username']))
{
    $userID = $_SESSION['username'];
}
else{
    header("Location: register.php");
}

if(isset($_POST['post'])){

    $uploadOK = 1;
    $imageName = $_FILES['fileToUpload']['name'];
    $errorMessage = "";
    if($imageName!=""){
        $targetDir = "img/posts";
        $imageName = $targetDir.uniqid().basename($imageName);
        $imageFileType = pathinfo($imageName,PATHINFO_EXTENSION);

        if($_FILES['fileToUpload']['size'] > 10000000){
            $errorMessage = "File is too large!";
            $uploadOK = 0;
        }

        if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "jpg" && strtolower($imageFileType) !="png" && strtolower($imageFileType) != "gif"){
            $errorMessage = "File type is not supported!";
            $uploadOK = 0;
        }

        if($uploadOK){
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)){
                //image uploaded
            }

            else{
                //image did not upload
                $uploadOK=0;
            }
        }
    }

    if($uploadOK){
        $post = new Post($con,$userLogin);
        $post->submitPost($_POST['post_text'], 'none', $imageName);
        header("Location: account.php");
    }

    else{
        echo "<div style='text-align: center' class='alert alert-danger'>
                $errorMessage
            </div>";
    }




}

?>
        <div class="container account_wrapper">
            <div class="row">
                <div class="col-lg-4">
                    <div class="user_details column">
                        <a href="<?php echo $userLogin; ?>" class="user_profile_image"> <img src="<?php echo $user['profile_picture'] ?>"></a>

                        <div class="user_details_left_right">


                            <a href=" <?php echo $userLogin; ?>">
                                <?php
                                echo "Hello, " . $user['first_name'] . " " . $user['last_name'] . "<br>";

                                ?>
                            </a>
                            <br>

                            <?php
                            echo "Number of Post(s): ". $user['num_posts'] . "<br>";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="main_column_new_feed column">
                        <form class="post_form" action="account.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <textarea name="post_text" id="post_text" placeholder="What are you thinking...? "></textarea>
                            <input type="submit" name="post" id="post_button" value="Post">
                            <hr>
                        </form>

                        <div class="posts_area"></div>
                        <img id="loading" src="img/loading.gif">

                    </div>
                </div>
            </div>
        
        

        <script>
            $(function(){

                var userLogin = '<?php echo $userLogin; ?>';
                var inProgress = false;

                loadPosts(); //Load first posts

                $(window).scroll(function() {
                    var bottomElement = $(".status_post").last();
                    var noMorePosts = $('.posts_area').find('.noMorePosts').val();

                    // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
                    if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {

                        loadPosts();
                    }
                });

                function loadPosts() {
                    if(inProgress) { //If it is already in the process of loading some posts, just return
                        return;
                    }

                    inProgress = true;
                    $('#loading').show();

                        var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

                        $.ajax({
                            url: "Ajax_load_posts.php",
                            type: "POST",
                            data: "page=" + page + "&userLogin=" + userLogin,
                            cache:false,

                            success: function(response) {
                                $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage
                                $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage
                                $('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage

                                $('#loading').hide();
                                $(".posts_area").append(response);

                                inProgress = false;
                            }
                        });


                }

                //Check if the element is in view
                function isElementInView (el) {
                    var rect = el.getBoundingClientRect();

                    return (
                        rect.top >= 0 &&
                        rect.left >= 0 &&
                        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
                        rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
                    );
                }
            });

        </script>


    </div>
    </body>
    </html>


<?php include 'footer.php'?>