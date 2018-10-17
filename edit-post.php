<?php
include 'lib/config.php';
include 'lib/mydatabase.php';
session_start();

$authenticateUser=$_SESSION['authenticateUser'];
$db=new Database();
$id=$_GET['id'];
$userPostQuery="select * from v_post where id='$id'";
$result=$db->getAllPost($userPostQuery);
$oldURL="";

if($result){
    while ($row=$result->fetch_assoc()){
        $oldURL=$row['url'];
        $oldTitle=$row['title'];
        $oldContent=$row['content'];
        $oldSectionId=$row['section_id'];
        $oldSection=$row['section'];
    }
}

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $content=$_POST['content'];
    $postCount=0;
    $newSectionId=$_POST['post_section'];
    $fileName=$_FILES['image_file']['name'];
    if($fileName){

        $tempLoc=$_FILES['image_file']['tmp_name'];
        $directory='images/post-image/images/';
        $imgUrl=$directory.$authenticateUser.$fileName;

        $fileType=pathinfo($imgUrl,PATHINFO_EXTENSION);
        $check=getimagesize($tempLoc);

        if ($check) {
            if (file_exists($imgUrl)) {
                die('This file already exists....');
            }else{
                if ($fileType!='jpg' && $fileType!='png') {
                    die('File not supported. Please chose jpg or png file');
                }else{
                    move_uploaded_file($tempLoc, $imgUrl);
                    $sql="update t_post set url='$imgUrl',title='$title',content='$content',p_count='$postCount',p_date=current_timestamp(),section_id='$newSectionId' where id='$id'";
                    //mysqli_query($link,$sql);
                    unlink($oldURL);
                    //echo "Successfully Post";
                    $row=$db->getExecute($sql);
                    if($row>0){
                        header("Location: dashboard.php");
                    }
                }
            }
        }else{
            die('Please enter the image file!');
        }

    }else{
        $sql="update t_post set url='$oldURL',title='$title',content='$content',p_count='$postCount',p_date=current_timestamp(),section_id='$newSectionId' where id='$id'";
        // $sql="insert into t_post(url,title,content,p_count,p_date) values('$imgUrl','$title','$content','$postCount',current_timestamp())";
        //mysqli_query($link,$sql);
        $row=$db->getExecute($sql);
        if($row){
            header("Location: dashboard.php");
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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

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
                <a href="" class="" >Dashboard</a>
            </li>
            <li>
                <a href="#" id="active">Post</a>
            </li>
            <li>
                <a href="#">Overview</a>
            </li>
            <li>
                <a href="#">About</a>
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
                                        <option value="<?php echo $oldSectionId;?>"><?php echo $oldSection;?></option>
                                        <?php
                                        $sectionQuery="select * from t_postsection where id!='$oldSectionId'";
                                        $result=$db->getAllPost($sectionQuery);
                                        while ($row=mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['section'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $oldTitle ?>">
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="ckeditor form-control" name="content"><?php echo $oldContent?></textarea>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="UPDATE POST">

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
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>


</html>
