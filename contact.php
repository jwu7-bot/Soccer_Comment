<?php 

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/20/2024
    Description: Contact page

****************/

include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> 
    <title>Contact</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <!-- navigation -->
            <div class="col-md-3">
                <?php include('nav.php'); ?>
            </div>

            <div class="col-md-9">
                <div class="content" style="padding-top: 5%;">
                    <h1>Contact Us</h1><br>
                    <?php
                        // check if form is submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            // validate and sanitize form inputs
                            $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                            $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                            // empty name
                            if (empty($name)) {
                                echo '<div class="alert alert-danger" role="alert" style="width: 50%;">Please enter your name.</div>';
                            }

                            // empty email
                            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                echo '<div class="alert alert-danger" role="alert" style="width: 50%;">Please enter a valid email address.</div>';
                            }

                            // empty message
                            if (empty($message)) {
                                echo '<div class="alert alert-danger" role="alert" style="width: 50%;">Please enter your message.</div>';
                            }

                            // if all inputs are valid, process the form
                            if (!empty($name) && !empty($email) && !empty($message)) {

                                // insert data into the database
                                $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
                                
                                if (mysqli_query($db, $sql)) {
                                    // message successfully sent message
                                    echo '<div class="alert alert-success" role="alert">Your message has been sent!</div>';

                                    // empty fields
                                    $name = $email = $message = '';
                                } else {
                                    // error
                                    echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($db) . '</div>';
                                }
                            }
                        }
                    ?>
                    <form method="post" style="width: 50%;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <!-- name field -->
                        <div class="form-group">
                            <label for="name">Your Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php if (isset($name)) echo $name; ?>">
                        </div>

                        <!-- email field  -->
                        <div class="form-group">
                            <label for="email">Your Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php if (isset($email)) echo $email; ?>">
                        </div>

                        <!-- message field  -->
                        <div class="form-group">
                            <label for="message">Your Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message"><?php if (isset($message)) echo $message; ?></textarea>
                        </div>

                        <!-- submit button -->
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
                <!-- footer -->
                <?php include('footer.php'); ?>
            </div>
            
        </div> 
    </div>
</body>
</html>