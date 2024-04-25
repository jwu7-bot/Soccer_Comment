<?php


/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/24/2024
    Description: My comments page

****************/

include('server.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>My Comments</title>
</head>
<body>
<div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <!-- navigation -->
            <div class="col-md-3">
                <?php include('nav.php'); ?>
            </div>

            <div class="header col-md-9">
                <div class="content col-md-8" style="padding-top: 5%;">
                    <main class="recent">
                        <h1 class="mb-4">My comments</h1>
                        <br>
                    </main>
                    <!-- display user comments -->
                    <?php
                        // get username
                        $username = $_SESSION['username'];

                        // query comments, players and users
                        $sql = "SELECT comments.*, players.*, users.*
                        FROM comments 
                        INNER JOIN players ON comments.player_id = players.player_id 
                        INNER JOIN users ON comments.user_id = users.user_id
                        WHERE username = '$username'";

                        $result = mysqli_query($db, $sql);

                        // comments returned
                        if ($result && mysqli_num_rows($result) > 0) {
                            // loop each comment
                            while($row = $result->fetch_assoc()) {
                    ?>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <!-- display profile pic if not empty -->
                                            <?php if (!empty($row['profile_pic'])): ?>  
                                                <img src="<?php echo $row['profile_pic']; ?>" alt="Profile Picture" style="max-width: 80px;" class="mr-3">
                                            <?php endif; ?>

                                            <!-- display username and player -->
                                            <h5 class="card-title"><?php echo $row['username'] . " about " . $row['name']; ?></h5>

                                            <!-- display comment -->
                                            <p class="card-text"><?php echo $row["comment"]; ?></p>

                                            <!-- display date posted -->
                                            <p class="text-muted">Posted on: <?php echo $row["date_posted"]; ?></p>

                                            <!-- edit -->
                                            <a href="edit_comment.php?id=<?php echo $row['comment_id']; ?>">Edit</a>
                                        </div>
                                    </div>
                        <?php
                            }
                        // no comments from user
                        } else {
                            echo "<p>No comments yet.</p>";
                        }
                        ?>
                </div>
                <!-- footer -->
                <?php include('footer.php'); ?>   

            </div>
        </div>
    </div>
</body>
</html>