<?php
include 'header.php';




$rowCountQuery="select * from v_post";
$numResult=$db->getAllPost($rowCountQuery);
$numRows=mysqli_num_rows($numResult);
$totalPage=ceil($numRows/5);

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

<div class="container slider">
	<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="w-100" src="images/slideshow/01.jpg" alt="Los Angeles" height="350">
      	<div class="carousel-caption">
		    <h3>Los Angeles</h3>
		    <p>We had such a great time in LA!</p>
  		</div>
    </div>
    <div class="carousel-item">
      <img class="w-100" src="images/slideshow/02.jpg" alt="Chicago" height="350">
      <div class="carousel-caption">
		    <h3>Los Angeles</h3>
		    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
  		</div>
    </div>
    <div class="carousel-item">
      <img class="w-100" src="images/slideshow/03.jpg" alt="New York" height="350">
      <div class="carousel-caption">
		    <h3>Los Angeles</h3>
		    <p>We had such a great time in LA!</p>
  		</div>
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</div>

<div class="container" style="background-color: #E2E2E2;">
	<div class="row">
		<div class="col-md-9 mb-2">
            <?php
            $getPostQuery="select * from v_post limit ".$pageContent.",5";
            $result=$db->getAllPost($getPostQuery);
            while ($row=mysqli_fetch_assoc($result)) {
                $postContent=$row['content'];
                $length=strlen($postContent);
                $post="";
                if($length>700){
                    for ($i=0;$i<1000;$i=$i+1){
                        $post=$post.$postContent[$i];
                        if($i>700 && $postContent[$i]==' '){
                            break;
                        }
                    }
                }else{
                    $post=$postContent;
                }
                ?>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5 class="text-secondary">Author Name: <?php echo $row['user_id']; ?></h5>
                        <h6 class="text-muted">Category: <?php echo $row['section']; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <img class="card-img" src="images/post-image/<?php echo $row['url']; ?>" alt="Card image cap" height="300px">
                        </div>
                        <h5 class="card-title text-dark"><?php echo $row['title']; ?></h5>
                        <p class="card-text"><?php echo $post."...."; ?></p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text">
                            <small class="text-muted">Posted on <?php echo $row['post_date']; ?></small>
                            <span class="float-right"><a href="read-post.php?p_id=<?php echo $row['id'];?>&s_id=<?php echo $row['section_id'];?>" title="" class="btn btn-primary">Read More <span
                                            class="badge badge-light"><?php echo $row['p_count']; ?></span></a></span>
                        </p>
                    </div>
                </div>
                <?php
            }
                ?>
		</div>
        <?php include 'sidebar.php';?>
	</div>
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!--                <nav aria-label="Page navigation example">-->
<!--                    <ul class="pagination pagination-lg">-->
<!--                        <li class="page-item"><a class="page-link" href="?page=--><?php //echo $prev;?><!--">Previous</a></li>-->
<!--                        --><?php
//                        for ($i=1;$i<=$totalPage;$i=$i+1) {
//                            ?>
<!--                            <li class="page-item"><a class="page-link" href="?page=--><?php //echo $i?><!--">--><?php //echo $i?><!--</a></li>-->
<!--                            --><?php
//                        }
//                            ?>
<!--                        <li class="page-item"><a class="page-link" href="?page=--><?php //echo $next;?><!--">Next</a></li>-->
<!--                    </ul>-->
<!--                </nav>-->
<!--        </div>-->
<!--    </div>-->
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