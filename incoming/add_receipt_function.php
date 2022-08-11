<?php
require_once("../include/connection.php");
if(!empty($_POST)){
    $cc = $_POST["cc"];  
    $amount = $_POST["amount"];  
    $supplier = ucwords($_POST["supplier"]);  
    $stats = "Available";
    $notes = $_POST["notes"];  


    $sql = "INSERT INTO credit_card (creditcard, amount, supplier, stats, notes) 
            VALUES('$cc', '$amount', '$supplier', '$stats' , '$notes')";
    $result = mysqli_query($conn, $sql);
}
?>