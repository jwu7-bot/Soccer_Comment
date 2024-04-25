<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/24/2024
    Description: Dashboard page

****************/

include('../server.php');

// check if the user is logged in as admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../login.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Dashboard</title>
</head>
<body>
    <!-- navigation -->
    <?php include('admin_nav.php'); ?>
    <div class="container mt-5">
        <div class="row">

            <!-- comments dashboard  -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Comments</h5>
                        <p class="card-text">Perform CRUD operations for comments.</p>
                        <a href="admin_comments.php" class="btn btn-primary">Manage Comments</a>
                    </div>
                </div>
            </div>

            <!-- players dashboard  -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Players</h5>
                        <p class="card-text">Perform CRUD operations for players.</p>
                        <a href="admin_players.php" class="btn btn-primary">Manage Players</a>
                    </div>
                </div>
            </div>

            <!-- users dashboard -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Perform CRUD operations for users.</p>
                        <a href="admin_users.php" class="btn btn-primary">Manage Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>