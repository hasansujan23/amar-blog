<?php
include '../lib/config.php';
include '../lib/mydatabase.php';
session_start();
if(!isset($_SESSION['authenticateUser'])){
    header("Location: ../login.php");
}

$authenticateUser=$_SESSION['authenticateUser'];
$db=new Database();

if(isset($_POST['submit'])){

    $fileName=$_FILES['image_file']['name'];
    $tempLoc=$_FILES['image_file']['tmp_name'];
    $directory='images/post-image/images/';
    $imgUrl=$directory.$authenticateUser.$fileName;

    $fileType=pathinfo($imgUrl,PATHINFO_EXTENSION);
    $check=getimagesize($tempLoc);

    if ($check>0) {
        if (file_exists($imgUrl)) {
            die('This file already exists....');
        }else{
            if ($fileType!='jpg' && $fileType!='png') {
                die('File not supported. Please chose jpg or png file');
            }else{
                move_uploaded_file($tempLoc, "../".$imgUrl);
                $title=$_POST['title'];
                $content=$_POST['content'];
                $postCount=0;
                $postSection=$_POST['post_section'];
                $sql="insert into t_post(url,title,content,p_count,p_date,user_id,section_id) values('$imgUrl','$title','$content','$postCount',current_timestamp(),'$authenticateUser','$postSection')";
                //mysqli_query($link,$sql);
                $row=$db->getExecute($sql);
                if($row>0){
                    header("Location: index.php");
                }
            }
        }
    }else{
        $error="Please enter the image file!";
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
                <a href="#" id="active" id="active">Post</a>
            </li>
            <li>
                <a href="#">Overview</a>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="edit-profile.php">Edit Profile</a>
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
                    <div class="card mt-5">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Input image file</label>
                                    <input type="file" class="form-control-file" name="image_file">
                                </div>
                                <div class="form-group">
                                    <label>Section</label>
                                    <select class="form-control" name="post_section">
                                        <?php
                                        $sectionQuery="select * from t_postsection";
                                        $result=$db->getAllPost($sectionQuery);
                                        while ($row=mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['section'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="ckeditor form-control" name="content" required> </textarea>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="POST">
                            </form>
                        </div>
                        <div class="card-footer">

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
