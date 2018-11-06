<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 11/6/2018
 * Time: 9:19 PM
 */
?>


<?php
include 'lib/config.php';
include 'lib/mydatabase.php';
$db=new Database();
$status=$_GET['id'];
$userId=$_GET['user_id'];

if($status==0){
    $deleteUserQuery="update t_user_login set status=1 where user_id='$userId'";
    $deleteUserResult=$db->getExecute($deleteUserQuery);
    if($deleteUserResult>0){
        header("Location: admin-panel.php");
    }
}else{
    $approveUserQuery="update t_user_login set status=0 where user_id='$userId'";
    $approveUserResult=$db->getExecute($approveUserQuery);
    if($approveUserResult>0){
        header("Location: admin-panel.php");
    }
}






?>



