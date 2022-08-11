<?php
require_once("../include/connection.php");
$id = $_POST["b_id"];  
if(!empty($_POST)){
    $r_date = $_POST["r_date"];
    $return = "Returned";
    $sql = "UPDATE borrow_voucher SET r_date = '$r_date' , stats = '$return' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);


    $id = $_POST["cv_id"];
    $stats = "Available";
    $sql = "UPDATE voucher SET stats = '$stats' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

}
?>