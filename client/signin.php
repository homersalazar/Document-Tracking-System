<?php 
require_once("../include/connection.php");
session_start();
if (isset($_POST['submit'])) {
    $access    = "user";
    $fname    = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname    = mysqli_real_escape_string($conn, $_POST["lname"]);
    $email    = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

  
    $sql = "SELECT * FROM client WHERE email = '$email'  LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) { // if user exists
        if ($row['email'] === $email) {
            echo '<script> alert("Username already exists")</script>';
        }
    }else if($_POST["password"] != $_POST["confirm_password"]){
        echo '<script> alert("Password not match!")</script>';
    }else{
        $emp_id =  $_SESSION['ID'] + 1;
        $sql    = "INSERT INTO client (fname, lname, email, pass , access, emp_id) VALUES ('$fname',  '$lname' , '$email' , '" . md5($password) . "', '$access' , '$emp_id')";
        $result   = mysqli_query($conn, $sql);
        if($result) {
        echo '<script> alert("You are registered successfully")</script>';
        }else {
            echo '<script> alert("Registration failed")</script>';
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            font: 14px sans-serif; 
            background-color: #435165;

        }
        .wrapper{ 
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 80px;
            width: 360px; 
            padding: 20px; 
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2><b>Sign Up</b></h2>
        <p>Please fill this form to create an account.</p>
        <form action="" method="post">
            <div class="row form-group">
                <div class="col-6">
                    <label>First name</label>
                    <input type="text" name="fname" class="form-control" required autocomplete="off">
                </div>
                <div class="col-6">
                    <label>Last name</label>
                    <input type="text" name="lname" class="form-control" required autocomplete="off">
                </div>
            </div>   
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autocomplete="off">
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>