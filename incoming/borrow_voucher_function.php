<?php
require_once("../include/connection.php");

if(!empty($_POST)){
    $borrower = $_POST["borrower"];  
    $borrow_id = $_POST["borrow_id"];
    $b_date = $_POST["b_date"];   
    $status = "Borrowed";    
    $sql = "INSERT INTO borrow_voucher (bnames, cv_ids, stats, b_date) VALUES('$borrower', '$borrow_id' , '$status', '$b_date')";
    $result = mysqli_query($conn, $sql);


    $id = $_POST["borrow_id"];
    $stats = "Released";
    $sql = "UPDATE voucher SET stats = '$stats' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

}
?>