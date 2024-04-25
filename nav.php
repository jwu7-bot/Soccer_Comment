<!--

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/20/2024
    Description: Navigation

****************/

-->

<div class="sidebar" style="width: 210px;">
    <h2 class="mt-4 mb-4"><a class="nav-link" href="index.php">Winnipeg United Soccer Club</a></h2> <!-- logo -->
    
    <!-- searchbar -->
    <ul class="nav flex-column">
        <form action="search_posts.php" method="GET" class="form-inline">
            <div class="form-group mr-2">
                <input type="text" name="player" placeholder="Search a player..." class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" style="margin-left: 60px; margin-top: 5px;">Search</button>
        </form>

        <br>

        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li> <!-- home -->
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li> <!-- about  -->
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li> <!-- contact  -->

        <!-- if user not logged in -->
        <?php if (!isset($_SESSION['username'])) : ?>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li> <!-- login -->
            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li> <!--  -->
       
        <!-- user logged in, display addtional navigations  -->
        <?php else : ?>
            <br>
            <li class="nav-item"><a class="nav-link" href="update_profile.php">Update Profile</a></li> <!-- update profile pic and username  -->
            <li class="nav-item"><a class="nav-link" href="new_comment.php">New Comment</a></li> <!-- new comment -->
            <li class="nav-item"><a class="nav-link" href="my_comments.php">My Comments</a></li> <!-- user comments -->
            <li class="nav-item"><a class="nav-link" href="add_player.php">Add Player</a></li> <!-- add player  -->
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li> <!-- logout  -->
            
            <br>
            
            <!-- display welcome message when logged in -->
            <div class="alert alert-success" role="alert" style="width: 100%;">
                <p class="mb-0">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            </div>

            <!-- display profile pic -->
            <?php
                // get username
                $username = $_SESSION['username'];

                // query user
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($db, $sql);

                if ($result) {
                    // check if any rows were returned
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        // display profile pic
                        echo '<img src="' . $row['profile_pic'] . '" alt="Profile Picture"style="max-width: 200px;"><br><br>';
                    }
                }
            ?>            
        <?php endif; ?>
    </ul>
</div>