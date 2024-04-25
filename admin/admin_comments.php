<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/24/2024
    Description: Admin Comment page

****************/

include('../server.php');

// delete comment 
if (isset($_POST['delete_comment'])) {
    // get comment id to be deleted
    $comment_id = $_POST['comment_id'];

    // query to delete
    $sql = "DELETE FROM comments WHERE comment_id = ?";

    // run query
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $stmt->close();
}

// retrieve comments from the database
$sql = "SELECT comments.*, players.*, users.*
        FROM comments 
        INNER JOIN players ON comments.player_id = players.player_id 
        INNER JOIN users ON comments.user_id = users.user_id";
$result = $db->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Comments</title>
</head>
<body>
    <!-- navigation -->
    <?php include('admin_nav.php'); ?>
    <div class="container mt-5">
        <h1 class="mb-4">All Comments</h1>
        <!-- comments found -->
        <?php if ($result->num_rows > 0) : ?>
            <ul class="list-group">
                <!-- loop through comments -->
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <li class="list-group-item">
                       <p>Username: <strong><?php echo $row['username']; ?></strong></p> <!-- username -->
                       <p>Comment on: <strong><?php echo $row['name']; ?></strong></p> <!-- name -->
                    </li>
                    <li class="list-group-item">
                        <p>Comment: <strong><?php echo $row['comment']; ?></strong></p> <!-- comments -->
                        <form class="float-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="comment_id" value="<?php echo $row['comment_id']; ?>"> 
                            <button type="submit" name="delete_comment" class="btn btn-danger btn-sm">Delete</button> <!-- delete button -->
                        </form>
                    </li>
                    <br>
                <?php endwhile; ?>
            </ul>
        <!--no comments -->
        <?php else : ?>
            <p>No comments.</p>
        <?php endif; ?>       
    </div>
</body>
</html>