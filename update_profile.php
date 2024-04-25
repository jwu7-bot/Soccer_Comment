<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/23/2024
    Description: Profile page

****************/

include('server.php');

$profile_picture = "";

// function to uploaded image
function image_upload($file) {
    // Allowed image types
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

    // Check if file is an image and within size limit
    if (in_array($file['type'], $allowed_types)) {
        // Generate a unique file name 
        $file_name = $file['name'];
        
        // Move the uploaded file to the designated directory
        $upload_directory = 'uploads/';
        $destination = $upload_directory . $file_name;
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // File upload successful, return the sanitized file name
            return $destination;
        } else {
            // Error moving uploaded file
            return null;
        }
    } else {
        // Invalid file type or size exceeds limit
        return null;
    }
}


if (isset($_POST['submit'])) {

    // update username
    if (!empty($_POST['username'])) {
        // retrieve form data
        $username = $_POST['username'];

        // sanitize
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // get user id
        $user_id = $_SESSION['user_id']; 

        // update username in database
        $sql = "UPDATE users SET username = '$username' WHERE user_id = '$user_id'";

        if (mysqli_query($db, $sql)) {
            // username updated successfully
            $_SESSION['username'] = $username; 
            header("Location: update_profile.php?success=true"); 
        } else {
            // error updating username
            echo "Error: " . mysqli_error($db);
        }
    }

    // update user profile
    if (isset($_FILES['profile_picture'])) {
        // upload pic
        $profile_picture = image_upload($_FILES['profile_picture']);

        if ($profile_picture) {
            // profile pic uploaded
            
            // get user logged in
            $username = $_SESSION['username'];

            // query retrieve user
            $sql = "UPDATE users SET profile_pic = '$profile_picture' WHERE username = '$username'";

            if (mysqli_query($db, $sql)) {
                // update successfully
                header("Location: update_profile.php?success=true"); 
            } else {
                // error updating pic
                echo "Error: " . mysqli_error($db);
            }
        } else {
            // error updating pic
            echo "Error: " . mysqli_error($db);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Update Profile</title>
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
                // successfully update, display message
                if (isset($_GET['success']) && $_GET['success'] === 'true') {
                    echo '<div class="alert alert-success" role="alert" style="width: 50%;">Update successfully!</div>';
                }
            ?>
            <div class="content" style="padding-top: 5%;">
                <h1>Update User Profile</h1><br>
                
                <!-- username field -->
                <form action="update_profile.php" method="POST" style="width: 50%;" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Update Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="">
                    </div>
                    
                    <div class="form-group">
                        <label for="profile_picture">Update Profile Picture:</label><br>

                        <?php
                            // display profile pic
                            // get username
                            $username = $_SESSION['username'];

                            // retrieve user
                            $sql = "SELECT * FROM users WHERE username = '$username'";
                            $result = mysqli_query($db, $sql);

                            if ($result) {
                                // Check if any rows were returned
                                if (mysqli_num_rows($result) > 0) {
                                    // display pic
                                    $row = mysqli_fetch_assoc($result);
                                    echo '<img src="' . $row['profile_pic'] . '" alt="Profile Picture"style="max-width: 200px;"><br><br>';
                                }
                            }
                        ?>

                        <!-- pic upload field -->
                        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                    </div>

                    <!-- upload button -->
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>

                </form>
            </div>
            <!-- footer -->
            <?php include('footer.php'); ?>  
        </div>
    </div>
</div>
</body>
</html>