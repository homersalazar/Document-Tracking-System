<?php
require("../client/auth_session.php");
require_once("../include/connection.php");
if(!empty($_POST)){
    $cv_id = $_POST['cv_id'];  
    $emp_id = $_POST['emp_id'];      
    $b_class = ucwords($_POST["return_class"]);  
    $b_cv = $_POST["return_cv"]; 
    $borrower = $_POST["borrower"];
    $stats = "Available";
    $date = date("Y-m-d H:i:s");   


    $sql = "INSERT INTO return_voucher  (emp_id , cv_id , doctype , tranno , borrower, status , return_date) 
        VALUES('$emp_id', '$cv_id' , '$b_class', '$b_cv', '$borrower', '$stats' , '$date')";
    $result = mysqli_query($conn, $sql);

    $id = $_POST["return_id"];
    $stats = "Returned";
    $date = date("Y-m-d H:i:s");   
    $sql2 = "UPDATE borrow SET status = '$stats' , return_date = '$date' WHERE id = '$id'";
    $result1 = mysqli_query($conn, $sql2);    // $stats = "Requested";

    $stats = "Available";
    $cv_id = $_POST['cv_id'];  
    $sql3 = "UPDATE voucher SET stats = '$stats'  WHERE id = '$cv_id'";
    $result2 = mysqli_query($conn, $sql3);


}
?>