<?php
require_once("../include/connection.php");
    $id = $_POST["list_id"];
if(!empty($_POST)){
    $cc = $_POST["edit_cc"];  
    $amount = $_POST["edit_amount"]; 
    $supplier = $_POST["edit_supplier"];  
    $stats = $_POST["edit_stats"];
    $install = $_POST["install"];
    // $duration = $_POST["duration"];
    $notes = $_POST["edit_notes"];
    // $monthly = "";
    $duration = !empty($_POST["duration"]) ? "'".$_POST["duration"]."'" : "NULL";

    // if(){

    // 

    // $monthly = !empty($_POST["monthly"] = "") ? "'".$_POST["monthly"]."'" : "0";
    

    
    // $sql = "UPDATE credit_card SET creditcard = '$cc' ,  amount = '$amount' , supplier = '$supplier' , install = '$install' , stats = '$stats' , duration = '$duration' ,  notes = '$notes'  ,  monthly = '$monthly' WHERE id = '$id'";
    $sql = "UPDATE credit_card SET creditcard = '$cc' ,  amount = '$amount' , supplier = '$supplier' , install = '$install' , stats = '$stats' , duration = $duration ,  notes = '$notes'   WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
}
?>



