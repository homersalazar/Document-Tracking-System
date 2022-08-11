<?php
require_once("../include/connection.php");
if(!empty($_POST)){
    $cv = $_POST["cv"];  
    $vp = $_POST["vp"];  
    $classy = $_POST["classy"];  
    $status = $_POST["status"];  
    $attach = $_POST["attach"];
    $years = $_POST["years"];
    $notes = $_POST["notes"];


    $sql = "INSERT INTO voucher(tranno, vp, class, attachs, stats, years, notes) VALUES('$cv', '$vp', '$classy', '$attach', '$status' ,'$years' , '$notes')";
    $result = mysqli_query($conn, $sql);
}
?>