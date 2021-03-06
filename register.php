
<?php
include 'lib/config.php';
include 'lib/mydatabase.php';


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ(){}[]@#$&*';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



$db=new Database();
$errMsg="";
$successMsg="";
$status=0;
if(isset($_POST['submit'])){
    $userId=$_POST['user_id'];
    $email=$_POST['user_email'];
    $password=$_POST['password'];
    $userIdQuery="select * from t_user_login where user_id='$userId'";
    $result1=$db->getAllPost($userIdQuery);
    $row=mysqli_num_rows($result1);
    if($row>0){
        $errMsg="User id already exist";
        echo $errMsg;
    }else{
        $emailQuery="select * from t_user_login where email='$email'";
        $result2=$db->getAllPost($emailQuery);
        $row1=mysqli_num_rows($result2);
        if($row1>0){
            $errMsg="email already exist. Please enter another one.";
        }else{

            $pwd=password_hash($password,PASSWORD_DEFAULT);
            $sql="insert into t_user_login values('$userId','$email','$pwd','$status')";
            $result3=$db->getExecute($sql);
            if($result3>0){
                $query="insert into t_user_details values('$userId','','','','','','','','','','')";
                $result4=$db->getExecute($query);
                if($result4>0){
                    $successMsg="Successfully registered. Soon admin accept your request.";
                }

            }else{
                $errMsg="Please try again later";
            }
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

    <title>amar-blog.com</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
            if($successMsg!=""){
                ?>
                <div class="alert alert-success">
                    <h3 class="text-center"><?php echo $successMsg;?></h3>
                </div>
                <?php
            }
            ?>
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center text-dark">Registration</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>User Id</label>
                            <input type="text" class="form-control" name="user_id" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="user_email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <h5 class="text-muted">Don't have any account <span class="float-right"><a href="login.php" class="card-link">Login</a></span></h5>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
