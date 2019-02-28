<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 2/28/2019
 * Time: 9:58 AM
 */
?>
<?php
include '../lib/config.php';
include '../lib/mydatabase.php';

$db=new Database();
$errMsg="";
if(isset($_POST['submit'])){
    $userId=$_POST['user_id'];
    $pwd=$_POST['user_pwd'];

//    $query="select * from t_user_login where user_id='$userId' and password='$pwd'";
//    $result=$db->getUsers($query);
//    $row=mysqli_num_rows($result);
//    if($row>0){
//        session_start();
//        $_SESSION['authenticateUser']=$userId;
//        header("Location: user/index.php");
//    }else{
//        $errMsg="Wrong user id or password";
//    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>amar-blog.com</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto" style="margin-top: 100px;">
            <?php
            if($errMsg!=""){
                ?>
                <div class="alert alert-danger">
                    <h3 class="text-center"><?php echo $errMsg;?></h3>
                </div>
                <?php
            }
            ?>
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center text-dark">Login Form</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>User Id</label>
                            <input type="text" class="form-control" name="user_id" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="user_pwd" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>


