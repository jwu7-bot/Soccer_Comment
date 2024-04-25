<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/23/2024
    Description: Add Player page

****************/

include('server.php');

if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $position = $_POST['position'];
    $nationality = $_POST['nationality'];

    // sanitize and validate data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // query to insert
    $sql = "INSERT INTO players (name, position, nationality) 
            VALUES ('$name', '$position', '$nationality')";    

    if (mysqli_query($db, $sql)) {
        // player inserted successfully
        header("Location: add_player.php?success=true"); 
        exit();
    } else {
        // error inserting player
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
    <title>Add Player</title>
</head>
<body>
    <div class="container-fluid">
            <div class="row">
                <!-- navigation -->
                <div class="col-md-3">
                    <?php include('nav.php'); ?>
                </div>
                <div class="col-md-9">
                    <?php
                        // player inserted successfully, display message
                        if (isset($_GET['success']) && $_GET['success'] === 'true') {
                            echo '<div class="alert alert-success" role="alert" style="width: 50%;">Player added successfully!</div>';
                        }
                    ?>
                    <!-- add player form -->
                    <div class="content" style="padding-top: 5%;">
                        <h1>Add Player</h1><br>
                        <form action="add_player.php" method="POST" style="width: 50%;">

                            <!-- name -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <!-- position -->
                            <div class="form-group">
                                <label for="position">Position:</label>
                                <input type="text" class="form-control" id="position" name="position" required>
                            </div>
                            
                            <!-- nationality -->
                            <div class="form-group">
                                <label for="nationality">Nationality:</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" required>
                            </div>
                            
                            <!-- submit button -->
                            <button type="submit" class="btn btn-primary" name="submit">Add Player</button>
                        </form> 
                    </div>
                    <!-- footer -->
                    <?php include('footer.php'); ?>
                </div>
            </div>
    </div>                
</body>
</html>