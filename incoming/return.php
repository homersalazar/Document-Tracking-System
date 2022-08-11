<?php
$active = "Return Voucher";
require_once("../include/connection.php");
require_once("../include/header.php");
require("../include/navbar.php");

$sql = "SELECT borrower.fname, borrower.lname, borrow_voucher.id as b_id, borrow_voucher.stats, voucher.id as cv_id, voucher.tranno, voucher.vp, voucher.class, b_date , r_date FROM `borrow_voucher` 
LEFT JOIN borrower ON (borrow_voucher.bnames = borrower.id) 
LEFT JOIN voucher ON (borrow_voucher.cv_ids = voucher.id)";
$result = mysqli_query($conn, $sql);  

?>
<div id="main" class="row mt-3 mr-1">
    <div class="col-2">
        <label class="tags">Return Voucher</label>
    </div>
</div>
<!-- tableview -->
<div id="main" class="row mr-1">
    <div class="col-12 bg-light p-3">
        <table id="table_view2" class="table table-sm bg-light">
            <thead class="thead-light mr-1">
                <tr>
                    <th width="12%">Employee name</th>
                    <th width="11%">Check Voucher</th>
                    <th width="12%">Voucher Payable</th>
                    <th width="5%">Classification</th>
                    <th width="11%">Borrowed Date</th>
                    <th width="5%">Status</th>
                    <th width="11%">Returned Date</th>
                    <th width="10%">Date Interval</th>
                    <th width="2%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  while($row = mysqli_fetch_array($result)){  
                    $b = $row['b_date'];
                    $r = $row['r_date'];
                    $datetime1 = new DateTime($row['r_date']);
                    $datetime2 = new DateTime($row['b_date']);
                    $interval = $datetime1->diff($datetime2);
                    $elapsed = $interval->format('%a');
                    $s = $row['stats'];
                    $dis_return = "";
                    if($s == 'Returned'){
                        $dis_return = "Disabled";
                    }
                ?>  
                <tr>
                    <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
                    <td><?php echo $row['tranno']; ?></td>  
                    <td><?php echo $row['vp']; ?></td>
                    <td><?php echo $row['class']; ?></td>
                    <td class="text-center"><?php echo $row['b_date']; ?></td>
                    <td><?php echo $row['stats']; ?></td>
                    <td class="text-center"><?php echo $row['r_date']; ?></td>
                    <td class="text-center"><?php echo $elapsed ?> days</td>
                    <td>  
                        <div class="dropdown">
                            <button class="btn fa fa-cog  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item <?php echo $dis_return ?>" href="#" onclick="myReturn('<?php echo $row['cv_id']; ?>' , '<?php echo $row['b_id']; ?>' , '<?php echo $row['fname']; ?>' , '<?php echo $row['tranno']; ?>' , '<?php echo $row['vp']; ?>' , '<?php echo $row['class']; ?>')">Return<a>                              
                            </div>
                        </div>
                    </td>
                </tr>
                <?php  }   ?>  
            </tbody>
        </table>
    </div>
</div>
<!--Return Modal -->
<div class="modal fade" id="return_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Return form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="return_form">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Employee Name:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="emp" id="emp" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Check Voucher:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="cv" id="cv" class="form-control form-control-sm" readonly>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-4">
                            <label for="">Voucher Payable:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="vp" id="vp" class="form-control form-control-sm" readonly>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-4">
                            <label for="">Classification:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="classes" id="classes" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Return Date:</label>
                        </div>
                        <div class="col-8">
                            <input type="date" id="r_date" name="r_date" class="form-control form-control-sm" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="cv_id" id="cv_id" class="form-control form-control-sm" readonly>
                    <input type="hidden" name="b_id" id="b_id" class="form-control form-control-sm" readonly>
                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-sm" />  
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Close</button>
                </div>
            </form>
        </div>  
    </div>
</div>
<script> 
    function myReturn(cv_id, b_id, emp, cv, vp, classes){
        $('#return_modal').modal('show');
        document.getElementById("cv_id").value = cv_id;
        document.getElementById("b_id").value = b_id;
        document.getElementById("emp").value = emp;
        document.getElementById("cv").value = cv;
        document.getElementById("vp").value = vp;
        document.getElementById("classes").value = classes;
        $('#return_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"return_function.php",  
                method:"POST",  
                data:$('#return_form').serialize(),  
                success:function(data){  
                    $('#return_form')[0].reset();  
                    $('#return_modal').modal('hide');  
                    $('#table_view2').html(data);  
                    // window.location.reload();
                }  
            });  
        });
    }
    $(document).ready(function(){  
        $('#table_view2').DataTable();
    });  
</script>  
<?php
require_once("../include/footer.php");
?>
