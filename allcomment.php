<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 3/5/2019
 * Time: 10:02 AM
 */
?>

<?php
include 'lib/config.php';
include 'lib/mydatabase.php';

$db=new Database();
$postId=$_POST['postId'];
$output="";

$query="select * from v_comment where p_id='$postId'";
$result=$db->getAllPost($query);
$row=mysqli_num_rows($result);
if($row>0){
    while ($res=mysqli_fetch_assoc($result)){
        $output.="<div class='card mb-2'>
                                <div class='card-header'>
                                    <h4><span><img src='".$res['url']."' style='height: 50px;width: 50px;border-radius: 25px;'></span> ".$res['user_id']."</h4>
                                </div>
                                <div class='card-body'>
                                    <p class='text-muted'>".$res['comment']."</p>
                                </div>
                            </div>";
    }

    echo $output;
}else{
    echo "No comment here";
}

?>
