<?php
    include 'header.php';
$profile_id = $user['user_name'];
$imgSrc = "";
$result_path = "";
$msg = "";

if(isset($_FILES['image']['name'])){
    /***********************************************************
    1 - Upload Original Image To Server
     ***********************************************************/
    //Delete users temp image
    $temppath = 'img/'.$profile_id.'_temp.jpeg';
    if (file_exists ($temppath)){ @unlink($temppath); }
    //Get Name  | Temp Location
    $ImageName = $_FILES['image']['name'];
    $ImageTempName = $_FILES['image']['tmp_name'];
    //Get File Ext
    $ImageType = @explode('/', $_FILES['image']['type']);
    $type = $ImageType[1]; //file type
    //Set Upload directory
    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/Meet-n-Compete/img/';
    //Set File name
    $file_name = $profile_id.'_original.'.md5(time()).'.'.$type; //the temp file name
    $fullpath = $uploaddir.$file_name; // the temp file path
    //Move the file to correct location
    $move = move_uploaded_file($ImageTempName ,$fullpath) ;
    chmod($fullpath, 0777);
    //Check for valid uplaod
    if (!$move) {
        echo $file_name;
        echo '<br>';
        echo $fullpath;
        die ('File didnt upload');
    } else {
        $imgSrc= "img/".$file_name; // the image to display in crop area
        $src = $file_name;	 		//the file name to post from cropping form to the resize
        $result_path ="img/".$file_name;

        //Insert image into database
        $insert_pic_query = mysqli_query($con, "UPDATE users SET profile_picture='$result_path' WHERE user_name='$userLogin'");
        header("Location: ".$userLogin);
    }




}//ADD Image





?>
<div id="Overlay" style=" width:100%; height:100%; border:0px #990000 solid; position:absolute; top:0px; left:0px; z-index:2000; display:none;"></div>
<div class="main_column column">


    <div id="formExample">

        <p><b> <?=$msg?> </b></p>

        <form action="upload.php" method="post"  enctype="multipart/form-data">
            Upload something<br /><br />
            <input type="file" id="image" name="image" style="width:200px; height:30px; " /><br /><br />
            <input type="submit" value="Submit" style="width:85px; height:25px;" />
            <?php if($result_path) {
                ?>

                <img src="<?=$result_path?>" style="position:relative; margin:10px auto; width:150px; height:150px;" />

            <?php } ?>
        </form><br /><br />

    </div> <!-- Form-->



</div>








<br /><br />

<?php
include 'footer.php';