
<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/24/2024
    Description: Search Post page

****************/

include('server.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Search Posts</title>
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
                        <h1 class="mb-4">Search Results</h1>
                        <br>
                    </main>

                    <?php
                        // search for player
                        if (isset($_GET['player'])) {
                            // validate and sanitize input
                            $search_query = filter_var($_GET['player'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                            // lower case
                            $search_query_lower = strtolower($search_query);

                            // query comments, players and users
                            $sql = "SELECT comments.*, players.*, users.*
                            FROM comments 
                            INNER JOIN players ON comments.player_id = players.player_id 
                            INNER JOIN users ON comments.user_id = users.user_id
                            WHERE LOWER(players.name) LIKE '%$search_query_lower%'";

                            $result = mysqli_query($db, $sql);

                            // comments returned
                            if ($result && mysqli_num_rows($result) > 0) {
                                // loop each comment
                                while($row = $result->fetch_assoc()) {
                                    ?>
                                        <!-- display each comment -->
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <!-- display profile pic if exist -->
                                                <?php if (!empty($row['profile_pic'])): ?>
                                                    <img src="<?php echo $row['profile_pic']; ?>" alt="Profile Picture" style="max-width: 80px;" class="mr-3">
                                                <?php endif; ?>

                                                <!-- display username and player -->
                                                <h5 class="card-title"><?php echo $row['username'] . " about " . $row['name']; ?></h5>

                                                <!-- display comment -->
                                                <p class="card-text"><?php echo $row["comment"]; ?></p>

                                                <!-- display date posted -->
                                                <p class="text-muted">Posted on: <?php echo $row["date_posted"]; ?></p>
                                            </div>
                                        </div>
                                    <?php
                                }
                            // no comments
                            } else {
                                echo "<p>No comments found.</p>";
                            }
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