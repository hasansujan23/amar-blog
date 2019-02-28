<?php
include '../lib/config.php';
include '../lib/mydatabase.php';
session_start();
if(!isset($_SESSION['authenticateUser'])){
    header("Location: ../login.php");
}

$authenticateUser=$_SESSION['authenticateUser'];
$db=new Database();
$query="select id,url,title,content,p_count,post_date,section from v_post where user_id='$authenticateUser'";
$result=$db->getAllPost($query);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="index.php" class="" id="active">Dashboard</a>
                </li>
                <li>
                    <a href="post.php">Post</a>
                </li>
                <li>
                    <a href="index.php">Overview</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="edit-profile.php">Edit Profile</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1>Welcome <?php echo $authenticateUser;?></h1>
                <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
            <div class="container-fluid mt-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h3 class="text-info text-center">Your Submitted Posts Here</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Views</th>
                                            <th>Post Date</th>
                                            <th>Section</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($row=mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="../<?php echo $row['url']; ?>" height="100px" width="100px">
                                            </td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['content']; ?></td>
                                            <td><?php echo $row['p_count']; ?></td>
                                            <td><?php echo $row['post_date']; ?></td>
                                            <td><?php echo $row['section']; ?></td>
                                            <td style="width: 15%;">
                                                <a href="edit-post.php?id=<?php echo $row['id'];?>" class="btn btn-warning">Edit</a>
                                                <a href="delete-post.php?id=<?php echo $row['id'];?>&url=<?php echo $row['url']; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
