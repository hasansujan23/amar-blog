<?php
include 'header.php';

$userId=$_GET['user_id'];

$userDetailsQuery="select * from t_user_details where user_id='$userId'";
$result=$db->getAllPost($userDetailsQuery);

?>
<div class="container" style="background-color: #E2E2E2;">
    <div class="row mb-2">
        <div class="col-md-9 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php
                        while ($row=mysqli_fetch_assoc($result)){
                        ?>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <img class="img-fluid rounded-circle"
                                         src="<?php echo $row['profile_pic'];?>">
                                </div>
                                <div class="card-footer">
                                    <h4 class="text-center text-dark"><?php echo $row['user_name']; ?></h4>
                                    <h5 class="text-center text-muted"><?php echo $row['profession']; ?></h5>
                                    <h5 class="text-center text-muted"><?php echo $row['country']; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-dark">Institute:</h5>
                                    <h5 class="text-secondary"><?php echo $row['institute'];?></h5>
                                    <h5 class="text-dark">Posted area:</h5>
                                    <ul class="">
                                        <?php
                                        $query1="SELECT section,count(section) as cnt from v_post where user_id='$userId' GROUP BY section_id";
                                        $res=$db->getAllPost($query1);
                                        while ($row1=mysqli_fetch_assoc($res)) {
                                            ?>
                                            <li><p class="text-muted"><?php echo $row1['section'];?> <span><?php echo $row1['cnt'];?></span></p></li>
                                            <?php
                                        }
                                            ?>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <h5 class="text-dark">Connect with me:</h5>
                                    <div>
                                        <a href="<?php echo $row['facebook']; ?>"><img src="images/p3.png" height="40px"
                                                                          width="40px"></a>
                                        <a href="<?php echo $row['linkedin']; ?>"><img src="images/p4.png" height="40px"
                                                                               width="40px"></a>
                                        <a href="<?php echo $row['twitter']; ?>"><img src="images/p5.png" height="40px"
                                                                           width="40px"></a>
                                        <a href="<?php echo $row['google_plus']; ?>"><img src="images/p6.png" height="40px"
                                                                             width="40px"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $row['about']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                            ?>
                </div>
            </div>
        <?php
            $getPostQuery="select * from v_post where user_id='$userId' order by section_id";
            $result=$db->getAllPost($getPostQuery);
            while ($row=mysqli_fetch_assoc($result)) {
                $postContent = $row['content'];
                $length = strlen($postContent);
                $post = "";
                if ($length > 700) {
                    for ($i = 0; $i < 1000; $i = $i + 1) {
                        $post = $post . $postContent[$i];
                        if ($i > 700 && $postContent[$i] == ' ') {
                            break;
                        }
                    }
                } else {
                    $post = $postContent;
                }
        ?>
            <div class="card mt-2">
                <div class="card-header">
                    <h5 class="text-secondary">Author Name: <?php echo $row['user_id']; ?></h5>
                    <h6 class="text-muted">Category: <?php echo $row['section']; ?></h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <img class="card-img" src="<?php echo $row['url']; ?>" alt="Card image cap" height="300px">
                    </div>
                    <h5 class="card-title text-dark"><?php echo $row['title']; ?></h5>
                    <p class="card-text"><?php echo $post . "...."; ?></p>
                </div>
                <div class="card-footer">
                    <p class="card-text">
                        <small class="text-muted">Posted on <?php echo $row['post_date']; ?></small>
                        <span class="float-right"><a
                                href="read-post.php?p_id=<?php echo $row['id']; ?>&s_id=<?php echo $row['section_id']; ?>"
                                title="" class="btn btn-primary">Read More <span
                                    class="badge badge-light"><?php echo $row['p_count']; ?></span></a></span>
                    </p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <?php
        include 'sidebar.php';
        ?>
    </div>
</div>
<?php
include 'footer.php';
?>