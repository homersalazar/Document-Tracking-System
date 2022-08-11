<?php
$active = "Dashboard";
require_once("../include/connection.php");
require_once("../include/header.php");
require("../include/navbar.php");

$sql = "SELECT count(*) as cv FROM voucher";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$sql1 = "SELECT count(*) as cc FROM credit_card WHERE stats = 'Available'";
$result1 = mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);

$sql2 = "SELECT count(*) as stats FROM request WHERE status = 'Requested'";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_assoc($result2);

$sql3 = "SELECT count(*) as stat FROM borrow_voucher WHERE stats = 'Borrowed'";
$result3 = mysqli_query($conn, $sql3);
$row3=mysqli_fetch_assoc($result3);

$sql4 = "SELECT count(*) as ppl FROM client";
$result4 = mysqli_query($conn, $sql4);
$row4=mysqli_fetch_assoc($result4);

?>

<div id="main" class="row mt-4">
    <div class="col-2 bg-primary ml-5">
        <div id="divs" class="row">
            <div class="col-4 text-light">
                <i class="fa fa-file fa-3x mt-4"></i>
            </div>
            <div class="col-8 text-light text-right mt-2">
                <span><h1><?php echo number_format($row['cv']); ?></h1></span><span><label ><a class="text-light"  href="../incoming/check_voucher.php"><i><b>Check Voucher</b></i></a></label></span>
            </div>
        </div>
    </div>
    <div class="col-2 bg-success ml-1">
        <div  class="row">
            <div class="col-4 text-light">
                <i class="fa fa-credit-card fa-3x mt-4"></i>
            </div>
            <div class="col-8 text-light text-right mt-2">
                <span><h1><?php echo number_format($row1['cc']); ?></h1></span><span><label ><a class="text-light" href="../incoming/credit_card.php"><i><b>Creditcard</b></i></a></label></span>
            </div>
        </div>
    </div>    
    <div class="col-2 bg-info ml-1">
        <div  class="row">
            <div class="col-4 text-light">
                <i class="fa fa-download fa-3x mt-4"></i>
            </div>
            <div class="col-8 text-light text-right mt-2">
                <span><h1><?php echo number_format($row2['stats']); ?></h1></span><span><label ><a class="text-light" href="../indicator_panel/control_panel_admin.php"><i><b>Requested</b></i></a></label></span>
            </div>
        </div>
    </div>
    <div class="col-2 bg-danger ml-1">
        <div  class="row">
            <div class="col-4 text-light">
                <i class="fa fa-upload fa-3x mt-4"></i>
            </div>
            <div class="col-8 text-light text-right mt-2">
                <span><h1><?php echo number_format($row3['stat']); ?></h1></span><span><label ><label class="text-light" ><i><b>Borrowed</b></i></label></label></span>
            </div>
        </div>
    </div>
    <div class="col-2 bg-warning ml-1">
        <div  class="row">
            <div class="col-4 text-light">
                <i class="fa fa-users fa-3x mt-4"></i>
            </div>
            <div class="col-8 text-light text-right mt-2">
                <span><h1><?php echo number_format($row4['ppl']); ?></h1></span><span><label ><label class="text-light" ><i><b>Users</b></i></label></label></span>
            </div>
        </div>
    </div>
</div>
<?php
require_once("../include/footer.php");

?>