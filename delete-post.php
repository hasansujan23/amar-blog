<?php
include 'lib/config.php' ;
include 'lib/mydatabase.php';
?>


<?php

$id=$_GET['id'];
$url=$_GET['url'];
$db=new Database();
$deleteQuery="delete from t_post where id='$id'";
$row=$db->getExecute($deleteQuery);
if($row){
    unlink($url);
    header("Location: dashboard.php");
}else{
    echo "Can't delete!!!";
}

?>