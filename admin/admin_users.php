<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/24/2024
    Description: Admin Users page

****************/

include('../server.php');

// delete user 
if (isset($_POST['delete_user'])) {
    // user ide to delete
    $user_id = $_POST['user_id'];

    // query to delete
    $sql = "DELETE FROM users WHERE user_id = ?";

    // run query
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

// retrieve users from the database
$sql = "SELECT * FROM users";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Users</title>
</head>
<body>
    <!-- navigation -->
    <?php include('admin_nav.php'); ?>
    <div class="container mt-5">
        <h1 class="mb-4">All Users</h1>
        <!-- users found -->
        <?php if ($result->num_rows > 0) : ?>
            <ul class="list-group">
                <!-- loop each user -->
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <li class="list-group-item">
                        <p>ID: <strong><?php echo $row['user_id']; ?></strong></p> <!-- user id -->
                        <p>Username: <strong><?php echo $row['username']; ?></strong></p> <!-- user name -->
                        <p>email: <strong><?php echo $row['email']; ?></strong></p> <!-- email -->
                        <p>admin: <strong><?php echo $row['admin']; ?></strong></p> <!-- admin -->
                        <form class="float-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button> <!-- delete button -->
                        </form>
                    </li>
                    <br>
                <?php endwhile; ?>
            </ul>
        <!-- no users -->
        <?php else : ?>
            <p>No Users.</p>
        <?php endif; ?>       
    </div>
</body>
</html>