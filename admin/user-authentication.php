<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 11/6/2018
 * Time: 9:19 PM
 */
?>


<?php
include '../lib/config.php';
include '../lib/mydatabase.php';
$db=new Database();


if(isset($_GET['del_id'])){
    $delId=$_GET['del_id'];
    $deleteUserQuery="delete from t_user_login where user_id='$delId'";
    $deleteUserResult=$db->getExecute($deleteUserQuery);
    if($deleteUserResult>0){
        $db->getDeltePost($delId);
        $db->getDelteUserFile($delId);
        $db->getExecute("delete from t_user_details where user_id='$delId'");
        $db->getExecute("delete from t_post where user_id='$delId'");
        header("Location: index.php");
    }
    session_start();
    if(isset($_SESSION['authenticateUser'])){
        session_unset('authenticateUser');
    }
}

if(isset($_GET['id']))
{
    $status=$_GET['id'];
    $userId=$_GET['user_id'];

    if($status==1){
        $disableUserQuery="update t_user_login set status=0 where user_id='$userId'";
        $disableUserResult=$db->getExecute($disableUserQuery);
        if($disableUserResult>0){
            header("Location: index.php");
        }
        session_start();
        if(isset($_SESSION['authenticateUser'])){
            session_unset('authenticateUser');
        }
    }else{
        $approveUserQuery="update t_user_login set status=1 where user_id='$userId'";
        $approveUserResult=$db->getExecute($approveUserQuery);
        if($approveUserResult>0){
            header("Location: index.php");
        }
    }
}


?>



