<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/22/2024
    Description: Server connection page

****************/

session_start();

//  database configuration
$servername = 'localhost';
$username = '';
$password = '';
$dbname = 'serverside';
$errors = array();

//  create connection
$db = new mysqli($servername, 'root', '', $dbname);

//  REGISTER USER
if (isset($_POST['reg_user'])) {
    //  validate and sanitize inputs
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password_1 = filter_var($_POST['password_1'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password_2 = filter_var($_POST['password_2'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //  ensure inputs not empty
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
    }
  
    //  check the database for same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    //  if user exists
    if ($user) {
      if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
      }
      if ($user['email'] === $email) {
        array_push($errors, "email already exists");
      }
    }
  
  //  register user if there are no errors in the form
  if (count($errors) == 0) { 
      // salting and hashing
      $hashed_password = password_hash($password_1, PASSWORD_DEFAULT);

      // query insert
      $query = "INSERT INTO users (username, email, password) 
                VALUES('$username', '$email', '$hashed_password')";
      mysqli_query($db, $query);

      $_SESSION['username'] = $username;
      header('location: index.php');
    }
}
  
// LOGIN USER
if (isset($_POST['login_user'])) {
  //  validate and sanitize inputs
  $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  //  ensure inputs not empty
  if (empty($username)) {
      array_push($errors, "Username is required");
  }
  if (empty($password)) {
      array_push($errors, "Password is required");
  }

  //  no erros
  if (count($errors) == 0) {
      //  get stored hashed password from db
      $query = "SELECT * FROM users WHERE username='$username'";
      $results = mysqli_query($db, $query);

      //  found record
      if (mysqli_num_rows($results) > 0) {
        $row = mysqli_fetch_assoc($results);
        $stored_hashed_password = $row['password'];
        $admin = $row['admin'];
        
        // check password
        if (password_verify($password, $stored_hashed_password)) {
            $_SESSION['username'] = $username;

            // if admin
            if($admin == 1) {
              $_SESSION['admin'] = true;
              header('location: admin/dashboard.php');
            } else {
              header('location: index.php');
            }
        }
        // error
        else {
          array_push($errors, "Wrong username/password combination");
        }
      // error
      } else {
        array_push($errors, "Wrong username/password combination");
      }
  }
}
?>