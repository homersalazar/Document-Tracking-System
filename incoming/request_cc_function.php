<?php
require_once("../include/connection.php");
if(!empty($_POST)){
    $p_id = $_POST["p_id"];
    $requestor = ucfirst($_POST["p_requestor"]);  
    $cc = $_POST["p_cc"];  
    $amount = $_POST["p_amount"];  
    $supplier = $_POST["p_supplier"];  
    $sql = "INSERT INTO request_cc  (cc_id , requestor , cardnum , amount, supplier ) 
        VALUES('$p_id' , '$requestor', '$cc', '$amount', '$supplier')";
    $result = mysqli_query($conn, $sql);

    $d = $_POST['cd'];
    $total = (int)$_POST['m'] + 1;
    $p_id = $_POST['p_id'];
    $stats = "Pullout";
    $m = $_POST['m'];
    // if($d == $total){
    //     $sql2 = "UPDATE credit_card SET stats = '$stats' WHERE id = '$p_id' ";
    //     $result2 = mysqli_query($conn, $sql2);
    // }elseif($d != ""){
    //     $sql1 = "UPDATE credit_card SET monthly = '$total' WHERE id = '$p_id' ";
    //     $result1 = mysqli_query($conn, $sql1);
    // }else{
    //     echo "";
    // }
    if($d == ""){
        $sql2 = "UPDATE credit_card SET stats = '$stats' WHERE id = '$p_id' ";
        $result2 = mysqli_query($conn, $sql2);
    }
    if($d == $total){
        $sql2 = "UPDATE credit_card SET stats = '$stats' WHERE id = '$p_id' ";
        $result2 = mysqli_query($conn, $sql2);
    }
    if($d != ""){
        $sql1 = "UPDATE credit_card SET monthly = '$total' WHERE id = '$p_id' ";
        $result1 = mysqli_query($conn, $sql1);
    }


}
?>