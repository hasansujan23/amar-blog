<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 11/6/2018
 * Time: 9:00 PM
 */
?>

<?php
include '../lib/config.php';
include '../lib/mydatabase.php';
//session_start();
//if(!isset($_SESSION['authenticateUser'])){
//    header("Location: login.php");
//}
//$authenticateUser=$_SESSION['authenticateUser'];

$db=new Database();
$authenticUserQuery="select user_id,email,status from t_user_login where status=1";
$authenticUserResult=$db->getAllPost($authenticUserQuery);

$pendingUserQuery="select user_id,email,status from t_user_login where status=0";
$pendingUserResult=$db->getAllPost($pendingUserQuery);
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
                <a href="" class="" id="active">Admin</a>
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
            <h1>Welcome Admin</h1>
            <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
            <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
            <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
        </div>
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="text-light text-center">Approved users</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Email</th>
                                    <th>Activity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row=mysqli_fetch_assoc($authenticUserResult)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['user_id']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
<!--                                            <a href="edit-post.php?id=--><?php //echo $row['id'];?><!--" class="btn btn-warning">Edit</a>-->
                                            <a href="user-authentication.php?id=<?php echo $row['status'];?>&user_id=<?php echo $row['user_id']; ?>" class="btn btn-warning">Disable</a>
                                            <a href="user-authentication.php?del_id=<?php echo $row['user_id']; ?>" class="btn btn-danger">Delete</a>
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
                <div class="col-md-12 mt-2">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="text-light text-center">Pending users</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Email</th>
                                    <th>Activity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row=mysqli_fetch_assoc($pendingUserResult)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['user_id']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <a href="user-authentication.php?id=<?php echo $row['status'];?>&user_id=<?php echo $row['user_id']; ?>" class="btn btn-primary">Enable</a>
                                            <a href="user-authentication.php?del_id=<?php echo $row['user_id']; ?>" class="btn btn-danger">Delete</a>
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

