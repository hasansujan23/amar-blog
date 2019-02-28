<?php
include '../lib/config.php';
include '../lib/mydatabase.php';
session_start();
if(!isset($_SESSION['authenticateUser'])){
    header("Location: ../login.php");
}

$authenticateUser=$_SESSION['authenticateUser'];
$errMessage="";
$db=new Database();
$query="select * from t_user_details where user_id='$authenticateUser'";
$result=$db->getAllPost($query);
while ($row=mysqli_fetch_assoc($result)){
    $oldProPic=$row['profile_pic'];
    $userName=$row['user_name'];
    $userProf=$row['profession'];
    $userInst=$row['institute'];
    $userCountry=$row['country'];
    $userAbout=$row['about'];
    $userFb=$row['facebook'];
    $userLink=$row['linkedin'];
    $userTwt=$row['twitter'];
    $user_google=$row['google_plus'];
}

if(isset($_POST['submit'])){
$name=$_POST['user_name'];
$prof=$_POST['user_pro'];
$country=$_POST['user_country'];
$inst=$_POST['user_institute'];
$about=$_POST['user_about'];
$fb=$_POST['user_fb'];
$linkdin=$_POST['user_linkedin'];
$twitter=$_POST['user_twitter'];
$google=$_POST['user_google'];
$newProPic=$_FILES['user_profilePic']['name'];

    if($newProPic){

        $tempLoc=$_FILES['user_profilePic']['tmp_name'];
        $directory='images/post-image/profile-picture/';
        $imgUrl=$directory.$authenticateUser.$newProPic;
        echo $imgUrl;

        $fileType=pathinfo($imgUrl,PATHINFO_EXTENSION);
        $check=getimagesize($tempLoc);

        if ($check) {
            if (file_exists($imgUrl)) {
                die('This file already exists....');
            }else{
                if ($fileType!='jpg' && $fileType!='png') {
                    //die('File not supported. Please chose jpg or png file');
                    $errMessage="File not supported. Please chose jpg or png file";
                }else{
                    if($oldProPic!=""){
                        unlink("../".$oldProPic);
                    }
                    move_uploaded_file($tempLoc, "../".$imgUrl);
                    $sql="update t_user_details set user_name='$name',profession='$prof',country='$country',institute='$inst',about='$about',profile_pic='$imgUrl',facebook='$fb',linkedin='$linkdin',twitter='$twitter',google_plus='$google' where user_id='$authenticateUser'";
                    //echo "Successfully Post";
                    $row=$db->getExecute($sql);
                    if($row>0){
                        header("Location: index.php");
                    }
                }
            }
        }else{
            $errMessage="File not supported. Please chose jpg or png file";
        }

    }else{
        $sql="update t_user_details set user_name='$name',profession='$prof',country='$country',institute='$inst',about='$about',profile_pic='$oldProPic',facebook='$fb',linkedin='$linkdin',twitter='$twitter',google_plus='$google' where user_id='$authenticateUser'";
        $row=$db->getExecute($sql);
        if($row){
            header("Location: index.php");
        }
    }

}



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Start Bootstrap
                </a>
            </li>
            <li>
                <a href="" class="">Dashboard</a>
            </li>
            <li>
                <a href="post.php">Post</a>
            </li>
            <li>
                <a href="index.php">Overview</a>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="edit-profile.php" id="active">Edit Profile</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h1>Welcome <?php echo $authenticateUser;?></h1>
            <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
            <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
            <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
        </div>
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <?php
                    if($errMessage!="") {
                        ?>
                        <div class="alert alert-danger">
                            <h5 class="text-center"><?php echo $errMessage; ?></h5>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="text-light text-center">Your Profile</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <img class="img-thumbnail" src="../<?php echo $oldProPic;?>" alt="" height="200px"
                                             width="200px"><br>
                                        <label>Profile Picture</label>
                                        <input type="file" name="user_profilePic" class="form-control-file">
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="user_name" class="form-control" value="<?php echo $userName;?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Profession</label>
                                        <input type="text" name="user_pro" class="form-control" value="<?php echo $userProf; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="user_country" class="form-control" value="<?php echo $userCountry;?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Institute</label>
                                        <input type="text" name="user_institute" class="form-control" value="<?php echo $userInst;?>">
                                    </div>
                                    <div class="form-group">
                                        <label>About</label>
                                        <textarea class="ckeditor form-control" name="user_about"><?php echo $userAbout;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" name="user_fb" class="form-control" value="<?php echo $userFb?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Linkedin</label>
                                        <input type="text" name="user_linkedin" class="form-control" value="<?php echo $userLink?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="text" name="user_twitter" class="form-control" value="<?php echo $userTwt;?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Google+</label>
                                        <input type="text" name="user_google" class="form-control" value="<?php echo $user_google;?>">
                                    </div>
                                <div class="form-group">

                                    <input type="submit" name="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>
