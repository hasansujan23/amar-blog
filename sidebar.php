



<div class="col-md-3 mt-2">
    <div class="card">
        <div class="card-header" style="background-color: #0C2635;">
            <h4 class="card-title text-light">Popular posts</h4>
        </div>
        <div class="card-body">
            <?php
            $popularPostQuery="select id,url,title,section_id from v_post order by p_count desc limit 5";
            $popularPostResult=$db->getPopularPost($popularPostQuery);
            while ($prow=mysqli_fetch_assoc($popularPostResult)) {

                ?>
                <a href="read-post.php?p_id=<?php echo $prow['id'];?>&s_id=<?php echo $prow['section_id'];?>" title="" style="text-decoration:none;display: block;">
                    <div class="popular-post">
                        <img class="img-thumbnail" src="<?php echo $prow['url']; ?>" alt="">
                        <p class="card-text"><?php echo $prow['title']; ?></p>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="card mt-2 mb-2">
        <div class="card-header" style="background-color: #0C2635;">
            <h4 class="card-title text-light">Latest posts</h4>
        </div>
        <div class="card-body">
            <?php
            $latestPostQuery="select id,url,title,section_id from v_post order by id desc limit 5";
            $lPostResult=$db->getLatestPost($latestPostQuery);
            while ($lrow=mysqli_fetch_assoc($lPostResult)) {
                ?>
                <a href="read-post.php?p_id=<?php echo $lrow['id'];?>&s_id=<?php echo $lrow['section_id'];?>" title="" style="text-decoration:none;display: block;">
                    <div class="popular-post">
                        <img class="img-thumbnail" src="<?php echo $lrow['url']; ?>" alt="">
                        <p class="card-text"><?php echo $lrow['title']; ?></p>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</div>