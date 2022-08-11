<?php
require("../client/auth_session.php");
require_once("../include/connection.php");
if(!empty($_POST)){
    $cv_id = $_POST['cv_id'];  
    $emp_id = $_POST['emp_id'];      
    $approve_class = ucwords($_POST["approve_class"]);  
    $approve_cv = $_POST["approve_cv"]; 
    $borrower = $_POST["borrower"];
    $stats = "Borrowed";

    $sql = "INSERT INTO borrow (emp_id , cv_id , doctype , tranno , borrower, status) 
        VALUES('$emp_id', '$cv_id' , '$approve_class', '$approve_cv', '$borrower', '$stats')";
    $result = mysqli_query($conn, $sql);

    $id = $_POST["approve_id"];
    $stats = "Approved";
    $date = date("Y-m-d H:i:s");   
    $sql2 = "UPDATE request SET status = '$stats' , approved_date = '$date' WHERE id = '$id'";
    $result1 = mysqli_query($conn, $sql2);    // $stats = "Requested";

    $stats = "Borrowed";
    $cv_id = $_POST['cv_id'];  
    $sql2 = "UPDATE voucher SET stats = '$stats'  WHERE id = '$cv_id'";
    $result1 = mysqli_query($conn, $sql2);


}
?>