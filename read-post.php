<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 10/9/2018
 * Time: 9:00 PM
 */

include 'header.php';
$postId=$_GET['p_id'];
$sectionId=$_GET['s_id'];

$updateQuery="update t_post set p_count=p_count+1 where id='$postId'";
$updateResult=$db->updatePostCount($updateQuery);

$rPostQuery="select * from v_post where id='$postId'";
$rpostResult=$db->getRequestedPost($rPostQuery);

$relatedPostQuery="select id,url,title,section_id from v_post where section_id='$sectionId' limit 5";
$relatedPostResult=$db->getRequestedPost($relatedPostQuery);
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
                        <h5 class="text-secondary">Category: <?php echo $row['section'];?></h5>

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
                    <div class="card-footer">
                        <h6 class="text-muted">Posted on <?php echo $row['post_date'];?> <span class="text-success" style="float: right;"><?php echo $row['p_count'];?> Views</span></h6>
                    </div>
                    <?php
                }
                    ?>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <h4 class="alert alert-secondary mt-2">Related Post here...</h4>
                </div>

                <?php
                while ($row=mysqli_fetch_assoc($relatedPostResult)) {
                    ?>
                    <div class="col-sm-4 mt-2">
                        <a href="read-post.php?p_id=<?php echo $row['id'];?>&s_id=<?php echo $row['section_id'];?>" style="text-decoration: none;">
                            <div class="" style="border: 1px solid #0C3C60;border-radius: 5px;">
                                <div>
                                    <img class="img-thumbnail" src="images/post-image/<?php echo $row['url'];?>">
                                </div>
                                <div>
                                    <p class="text-muted" style="padding: 5px;"><?php echo $row['title'];?></p>
                                </div>
                            </div>
                        </a>
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