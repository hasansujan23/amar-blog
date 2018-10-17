<?php
session_start();
if(isset($_SESSION['authenticateUser'])){
    session_unset('authenticateUser');
    header("Location: index.php");
}else{
    header("Location: login.php");
}

?>