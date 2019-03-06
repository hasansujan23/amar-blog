<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 3/5/2019
 * Time: 1:00 AM
 */
?>
<?php
include 'lib/config.php';
include 'lib/mydatabase.php';

$db=new Database();
$userId=$_POST['userId'];
$postId=$_POST['postId'];
$comment=$_POST['comment'];

$query="insert into t_comment(p_id,comment,user_id) values('$postId','$comment','$userId')";
$result=$db->getExecute($query);
if($result>0){
    echo "Comment inserted successfully";
}else{
    echo "Error";
}

?>
