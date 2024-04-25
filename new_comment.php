<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/21/2024
    Description: Comment page

****************/

include('server.php');

//  function get user id by username
function getUserIdByUsername($username, $conn) {
    // query statement
    $sql = "SELECT user_id FROM users WHERE username = '$username'";

    // execute 
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            // fetch the user_id
            $row = mysqli_fetch_assoc($result);
            return $row['user_id'];
        } else {
            // username not found
            return null;
        }
    } else {
        // error executing query
        return null;
    }
}

// username
$username = $_SESSION['username'];

// user id
$user_id = getUserIdByUsername($username, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve form data
    $player_id = $_POST['player'];
    $comment_content = $_POST['content'];

    // sanitize and filter input 
    $player_id = mysqli_real_escape_string($db, $player_id);
    $comment_content = mysqli_real_escape_string($db, $comment_content);

    // insert comment into database
    $sql = "INSERT INTO comments (player_id, user_id, comment) VALUES ('$player_id', '$user_id', '$comment_content')";

    if (mysqli_query($db, $sql)) {
        // comment inserted successfully
        header("Location: comment.php?success=true"); 
    } else {
        // error inserting comment
        echo "Error: " . mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> 
    <title>Comment</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- navigation -->
            <div class="col-md-3">
                <?php include('nav.php'); ?>
            </div>

            <div class="header col-md-9" style="padding-top: 5%;">
                <?php
                    // display message when successfully inserted
                    if (isset($_GET['success']) && $_GET['success'] === 'true') {
                        echo '<div class="alert alert-success" role="alert" style="width: 50%;">Comment posted successfully!</div>';
                    }
                ?>
                <div class="content" style="width: 50%;">
                    <form action="comment.php" method="POST">
                        <h1>New Comment</h1><br>

                        <!-- select player make new comment  -->
                        <div class="form-group">
                            <label for="player">Select Player:</label>
                            <select class="form-control" id="player" name="player" required>
                            <option value="">Select Player</option>
                            <?php
                                // query to retrieve all players from the database
                                $query = "SELECT * FROM players";
                                $result = mysqli_query($db, $query);

                                // loop through the results and create an option for each player
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['player_id'] . "'>" . $row['name'] . "</option>";
                                }
                            ?>
                            </select>
                        </div>

                        <!-- comment form -->
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" name="content" id="content" rows="5" 
                            minlength="1" required></textarea>
                        </div>

                        <!-- submit button -->
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                        
                    </form>
                </div>
                <!-- footer -->
                <?php include('footer.php'); ?>   
            </div>
        </div>
    </div>
</body>
</html>