<?php
include 'header.php';
$sectionId=$_GET['s_id'];



$rowCountQuery="select * from v_post where section_id='$sectionId'";
$numResult=$db->getAllPost($rowCountQuery);
$numRows=mysqli_num_rows($numResult);
$totalPage=ceil($numRows/5);
if($totalPage==0){
    $totalPage=1;
}

if(isset($_GET['page'])){
    $page=$_GET['page'];

}else{
    $page=1;
}
$prev=$page-1;
if($prev<1){
    $page=1;
    $prev=1;
}
$next=$page+1;
if($next>$totalPage){
    $page=$totalPage;
    $next=$totalPage;
}


$pageContent=($page*5)-5;


?>

    <div class="container" style="background-color: #E2E2E2;">
        <div class="row">
            <div class="col-md-9 mb-2">
                <?php
                $getPostQuery="select * from v_post where section_id='$sectionId' limit ".$pageContent.",5";
                $result=$db->getAllPost($getPostQuery);
                $numPosts=mysqli_num_rows($result);
                if($numPosts>0) {
                    while ($row = mysqli_fetch_assoc($result)) {
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
                                    <img class="card-img" src="images/post-image/<?php echo $row['url']; ?>"
                                         alt="Card image cap" height="300px">
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
                }else {
                    ?>
                    <div class="alert alert-info">
                        <h3 class="text-center">No one submitted any post in this section.</h3>
                    </div>
                    <?php
                }
                    ?>
            </div>
            <?php include 'sidebar.php';?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg">
                        <?php
                        if($page==1) {
                            ?>
                            <li class="page-item disabled"><a class="page-link"
                                                              href="?page=<?php echo $prev; ?>">Previous</a></li>
                            <?php
                        }else {
                            ?>
                            <li class="page-item"><a class="page-link"
                                                     href="?page=<?php echo $prev; ?>">Previous</a></li>
                            <?php
                        }
                        for ($i=1;$i<=$totalPage;$i=$i+1) {
                            if ($page == $i) {
                                ?>
                                <li class="page-item active"><a class="page-link"
                                                                href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php
                            } else {
                                ?>
                                <li class="page-item"><a class="page-link"
                                                         href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php
                            }
                        }
                        if($page==$totalPage) {
                            ?>
                            <li class="page-item disabled"><a class="page-link" href="?page=<?php echo $next; ?>">Next</a>
                            </li>
                            <?php
                        }else {
                            ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $next; ?>">Next</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

<?php
include 'footer.php';
?>