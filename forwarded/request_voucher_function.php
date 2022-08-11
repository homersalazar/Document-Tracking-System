<?php
require("../client/auth_session.php");
require_once("../include/connection.php");
if(!empty($_POST)){
    $emp_id = $_SESSION['ID'];  
    $request_cv = $_POST["request_cv"]; 
    $cv_id = $_POST["request_id"];;   
    $request_class = ucwords($_POST["request_class"]);  
    $email = $_SESSION['UserLogin'];
    $stats = "Requested";

    $sql = "INSERT INTO request (emp_id , cv_id , doctype , tranno , borrower, status) 
        VALUES('$emp_id', '$cv_id' , '$request_class', '$request_cv', '$email', '$stats')";
    $result = mysqli_query($conn, $sql);

    $id = $_POST["request_id"];
    $stats = "Requested";
    $sql2 = "UPDATE voucher SET stats = '$stats'  WHERE id = '$id'";
    $result1 = mysqli_query($conn, $sql2);    // $stats = "Requested";

}
?>