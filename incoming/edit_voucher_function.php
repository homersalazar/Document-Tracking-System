<?php
require_once("../include/connection.php");
$id = $_POST["list_id"];

if(!empty($_POST)){
    $cv = $_POST["edit_cv"];  
    $vp = $_POST["edit_vp"];  
    $classy = $_POST["edit_class"];  
    $status = $_POST["edit_status"];  
    $attach = $_POST["edit_attach"];
    $years = $_POST["edit_years"];
    $notes = $_POST["edit_notes"];

    $sql = "UPDATE voucher SET tranno = '$cv' ,  vp = '$vp' , class = '$classy' , stats = '$status' , attachs = '$attach' , years = '$years', notes = '$notes' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
}
?>