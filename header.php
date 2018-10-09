<?php
include 'lib/config.php';
include 'lib/mydatabase.php';

$db=new Database();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="container mt-4" style="background-color: #0C3C60;">
    <div class="row">
        <div class="col-md-2 brand-section" >
            <img src="images/brand3.png" alt="">
        </div>
        <div class="col-md-7 header-title" >
            <h3>Company Name</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
        </div>
        <div class="col-md-3" >
            <div class="social-logo">
                <a href="" title=""><i class="fa fa-facebook"></i></a>
                <a href="" title=""><i class="fa fa-google-plus"></i></a>
                <a href="" title=""><i class="fa fa-linkedin"></i></a>
                <a href="" title=""><i class="fa fa-twitter"></i></a>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 menubar-section">
            <ul>
                <li><a href="index.php" title="">Home</a></li>
                <li><a href="" title="">Subject <i class="fa fa-caret-down"></i></a>
                    <ul>
                        <?php
                        $subjectQuery="select * from t_postsection";
                        $subjectResult=$db->getAllSubject($subjectQuery);
                        while ($row=mysqli_fetch_assoc($subjectResult)) {
                            ?>
                            <li><a href="#"><?php echo $row['section'];?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <li><a href="" title="">About</a></li>
                <li><a href="" title="">Contact</a></li>
            </ul>
        </div>
    </div>
</div>