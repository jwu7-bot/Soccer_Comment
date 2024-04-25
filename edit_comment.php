<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/24/2024
    Description: Edit comment page

****************/

include('server.php');

if (isset($_GET['id'])) {
    // get the post id from the page
    $comment_id = $_GET['id'];
    
    // query to retrieve comments
    $sql = "SELECT * FROM comments WHERE comment_id = '$comment_id'";

    $result = mysqli_query($db, $sql);
    
    // fetch comment information
    if ($row = mysqli_fetch_assoc($result)) {
        // store post information in variables
        $comment = $row['comment'];
    } else {
        // error
        header('Location: my_comments.php');
        exit();
    }
} else {
    // error
    header('Location: my_comments.php');
    exit(); 
}

// check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // update comment
    if (isset($_POST['update_comment'])) {
        // get the updated content from the form
        $updated_comment = $_POST['comment'];

        // sanitize and validate
        $updated_comment = filter_var($_POST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // query to update the comment from the database
        $sql = "UPDATE comments SET comment = '$updated_comment' WHERE comment_id = '$comment_id'";
        mysqli_query($db, $sql);
        
        header('Location: my_comments.php');
        exit(); 
    }

    // delete post
    if (isset($_POST['delete_comment'])) {
        // query to delete comment from the databse
        $sql = "DELETE FROM comments WHERE comment_id = '$comment_id'";
        mysqli_query($db, $sql);

        header('Location: my_comments.php');
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Edit Comment</title>
</head>
<body>
    <div class="header">
		<h2>Edit Comment</h2>
	</div>

    <form method="post">
        <!-- comment field  -->
        <div class="input-group">
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="10" cols="65"><?php echo htmlspecialchars($comment); ?></textarea>
        </div>
        
        <!-- delete and submit button  -->
        <div class="input-group">
			<button type="submit" class="btn" name="update_comment" style="margin-right: 50px;">Submit</button>
            <button type="submit" class="btn" name="delete_comment">Delete</button>
		</div>
    </form>
</body>
</html>