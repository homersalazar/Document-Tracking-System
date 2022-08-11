<?php 
require("../client/auth_session.php");
require_once("../include/connection.php");




if (isset($_POST['login'])) {

    $email    = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $sql = "SELECT * FROM client WHERE email = '$email' AND pass = '" . md5($password) . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $user = mysqli_num_rows($result);
    if($user > 0){
        $_SESSION['UserLogin'] = $row['email'];
        $_SESSION['Access'] = $row['access'];
        $_SESSION['Emp_id'] = $row['emp_id'];
        $_SESSION['ID'] = $row['id'];

        if($_SESSION['Access'] == "admin"){
            header("Location: ../dashboard/dashboard.php");
        }else {
            header("Location: ../dashboard/index.php");
        }
    }else{
        echo '<script> alert("User not found!")</script>';


    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            body{
                font: 14px sans-serif; 
                background-color: #435165;

            }
            .wrapper{ 
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-top: 150px;
                width: 360px; 
                padding: 20px; 
                background-color: #ffffff;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <h2><b>Login</b></h2>
            <p>Please fill in your credentials to login.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="login"  class="btn btn-primary btn-block" value="Login" >Login</button>
                </div>
                <p>Don't have an account? <a href="signin.php">Sign up now</a>.</p>
            </form>
        </div>
    </body>
</html>