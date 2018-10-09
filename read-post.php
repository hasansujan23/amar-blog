<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 10/9/2018
 * Time: 9:00 PM
 */

include 'header.php';
$postId=$_GET['p_id'];
$updateQuery="update t_post set p_count=p_count+1 where id='$postId'";
$updateResult=$db->updatePostCount($updateQuery);

$rPostQuery="select * from v_post where id='$postId'";
$rpostResult=$db->getRequestedPost($rPostQuery);
?>


<div class="container" style="background-color: #E2E2E2;">
    <div class="row">

        <div class="col-md-9 mb-2">
            <div class="card mt-2">
                <?php
                while ($row=mysqli_fetch_assoc($rpostResult)) {
                    ?>
                    <div class="card-header">
                        <h4 class="text-muted">Posted by: <span class="text-primary"><?php echo $row['user_id'];?></span></h4>
                        <h5 class="text-secondary">Category: <?php echo $row['section'];?> <span class="text-success" style="float: right;"><?php echo $row['p_count'];?> Views</span>
                        </h5>
                        <h6 class="text-muted">Posted on <?php echo $row['post_date'];?></h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <img class="card-img img-thumbnail" style="max-width: 100%;" src="images/post-image/<?php echo $row['url'];?>">
                        </div>
                        <div>
                            <h4 class="card-title text-danger"><?php echo $row['title'];?></h4>
                            <p class="card-text"><?php echo $row['content'];?></p>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                    <?php
                }
                    ?>
            </div>
        </div>
        <?php
        include 'sidebar.php';
        ?>
    </div>
</div>
<?php
include 'footer.php';
?>