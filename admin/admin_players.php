<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/24/2024
    Description: Admin Players page

****************/

include('../server.php');

// delete player 
if (isset($_POST['delete_player'])) {
    // get player id to be deleted
    $player_id = $_POST['player_id'];

    // query to delete
    $sql = "DELETE FROM players WHERE player_id = ?";

    // run query
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $stmt->close();
}

// retrieve players from the database
$sql = "SELECT * FROM players";
$result = $db->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Players</title>
</head>
<body>
    <!-- navigation -->
    <?php include('admin_nav.php'); ?>
    <div class="container mt-5">
        <h1 class="mb-4">All Players</h1>
        <!-- players found-->
        <?php if ($result->num_rows > 0) : ?>
            <ul class="list-group">
                <!-- loop each player-->
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <li class="list-group-item">
                        <p>ID: <strong><?php echo $row['player_id']; ?></strong></p> <!-- player id -->
                        <p>Name: <strong><?php echo $row['name']; ?></strong></p> <!-- name -->
                        <p>Position: <strong><?php echo $row['position']; ?></strong></p> <!-- position -->
                        <p>Nationality: <strong><?php echo $row['nationality']; ?></strong></p> <!-- nationality -->
                        <form class="float-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="player_id" value="<?php echo $row['player_id']; ?>">
                                <button type="submit" name="delete_player" class="btn btn-danger btn-sm">Delete</button> <!-- delete button -->
                        </form>
                    </li>
                    <br>
                <?php endwhile; ?>
            </ul>
        <!-- no players -->
        <?php else : ?>
            <p>No Players.</p>
        <?php endif; ?>       
    </div>
</body>
</html>