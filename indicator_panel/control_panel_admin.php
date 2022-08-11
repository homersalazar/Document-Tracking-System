<?php
$active = "Control panel";

require_once("../client/auth_session.php");
require_once("../include/connection.php");
require_once("../include/header.php");
require("../include/navbar.php");
?>
<div class="row mt-3">
    <div id="main1" class="col-11 mr-5">
        <ul class="nav nav-pills p-2" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-approved" role="tab" aria-controls="pills-home" aria-selected="true">Request</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Borrow</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Return</a>
            </li>
        </ul>
    </div>
</div>

<div class="tab-content mt-3 main1" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-approved" role="tabpanel" aria-labelledby="pills-home-tab">
        <?php
            // $sql = "SELECT * FROM request WHERE status = 'Requested'";
            $sql = "SELECT * FROM request ORDER BY request_date DESC ";
            $result = mysqli_query($conn, $sql);  
        ?>
        <div class="row">
            <div class="col-12">
                <div class="tab-pane fade show active bg-light p-3" id="Approved" role="tabpanel" aria-labelledby="Approved-tab">
                    <table id="approved_table" class="table table-sm bg-light">
                        <thead class="thead-light mr-1">
                            <tr>
                            <th width="5%">#</th>
                            <th width="15%">Request Date</th>
                            <th width="16%">Document Type</th>
                            <th width="8%">Cv Tran</th>
                            <th width="15%">Borrower</th>
                            <th width="10%">Status</th>
                            <th width="15%">Approval Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  while($row = mysqli_fetch_array($result)){ 
                                $dis_approved = "";
                                $status = $row['status'];
                                if($status == "Approved"){
                                    $dis_approved = "disabled";
                                }
                            ?>  
                            <tr>
                                <th><div class="dropdown">
                                    <button class="btn fa fa-cog  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item  <?php echo $dis_approved ?>" href="#"  onclick="myApproved('<?php echo $row['id']; ?>' , '<?php echo $row['doctype']; ?>' , '<?php echo $row['tranno']; ?>' , '<?php echo $row['cv_id']; ?>' , '<?php echo $row['emp_id']; ?>', '<?php echo $row['borrower']; ?>')">Approved</a>
                                    </div>
                                </div>
                                </th>
                                <td><?php echo $row['request_date'] ?></td>
                                <td><?php echo $row['doctype'] ?></td>
                                <td><?php echo $row['tranno'] ?></td>
                                <td><?php echo $row['borrower'] ?></td>
                                <td><?php echo $row['status'] ?></td>
                                <td><?php echo $row['approved_date'] ?></td>
                            </tr>
                            <?php  }   ?>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <?php
            // $sql = "SELECT * FROM borrow WHERE status = 'Borrowed'";
            $sql = "SELECT * FROM borrow ORDER BY borrow_date DESC";

            $result = mysqli_query($conn, $sql);  
        ?>
        <div class="row">
            <div class="col-12">
                <div class="tab-pane fade show active bg-light p-3" id="Approved" role="tabpanel" aria-labelledby="Approved-tab">
                    <table id="borrow_table" class="table table-sm bg-light">
                        <thead class="thead-light mr-1">
                            <tr>
                            <th class="width_table5">#</th>
                            <th class="width_table15">Borrowed Date</th>
                            <th class="width_table15">Document Type</th>
                            <th class="width_table10">Cv Tran</th>
                            <th class="width_table10">Borrower</th>
                            <th class="width_table5">Status</th>
                            <th width="15%">Return Date</th>
                            <th class="width_table13">Date Interval</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  while($row = mysqli_fetch_array($result)){ 
                                $b = $row['borrow_date'];
                                $r = $row['return_date'];
                                $datetime1 = new DateTime($row['return_date']);
                                $datetime2 = new DateTime($row['borrow_date']);
                                $interval = $datetime1->diff($datetime2);
                                $elapsed = $interval->format('%a');
                                echo $elapsed;
                                $dis_returned = "";
                                $status = $row['status'];
                                if($status == "Returned"){
                                    $dis_returned = "disabled";
                                }
                                ?>  
                            <tr>
                                <th>
                                <div class="dropdown">
                                    <button class="btn fa fa-cog  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item <?php echo $dis_returned ?>" href="#"  onclick="myBorrowed('<?php echo $row['id']; ?>' , '<?php echo $row['doctype']; ?>' , '<?php echo $row['tranno']; ?>' , '<?php echo $row['cv_id']; ?>' , '<?php echo $row['emp_id']; ?>', '<?php echo $row['borrower']; ?>')">Return</a>
                                    </div>
                                </div>
                                </th>
                                <td><?php echo $row['borrow_date'] ?></td>
                                <td><?php echo $row['doctype'] ?></td>
                                <td><?php echo $row['tranno'] ?></td>
                                <td><?php echo $row['borrower'] ?></td>
                                <td><?php echo $row['status'] ?></td>
                                <td><?php echo $row['return_date'] ?></td>
                                <!-- <td><?php  echo $days;   ?></td> -->
                                <td><?php  echo $elapsed;   ?></td>

                            </tr>
                            <?php  }   ?>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
    <?php
            $sql = "SELECT * FROM return_voucher";
            $result = mysqli_query($conn, $sql);  
        ?>
        <div class="row">
            <div class="col-12">
                <div class="tab-pane fade show active bg-light p-3" id="Approved" role="tabpanel" aria-labelledby="Approved-tab">
                    <table id="return_table" class="table table-sm bg-light">
                        <thead class="thead-light mr-1">
                            <tr>
                            <th width="15%">Document Type</th>
                            <th width="15%">Cv Tran</th>
                            <th width="15%">Borrower</th>
                            <th width="15%">Status</th>
                            <th width="15%">Return Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  while($row = mysqli_fetch_array($result)){ ?>  
                            <tr>
                                <td><?php echo $row['doctype'] ?></td>
                                <td><?php echo $row['tranno'] ?></td>
                                <td><?php echo $row['borrower'] ?></td>
                                <td><?php echo $row['status'] ?></td>
                                <td><?php echo $row['return_date'] ?></td>
                            </tr>
                            <?php  }   ?>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!-- modal approve -->
<div class="modal fade" id="Approved_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Approval Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="approve_form" method="post">
                    <div class="row">
                        <div class="col-4 text-right">
                            <label>Document type:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="approve_class" id="approve_class" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <label>CV tran:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="approve_cv" id="approve_cv" readonly />
                        </div>
                    </div>
                    <input type="hidden" id="approve_id" name="approve_id">
                    <input type="hidden" class="form-control request" name="cv_id" id="cv_id" readonly />
                    <input type="hidden" class="form-control request" name="emp_id" id="emp_id" readonly />
                    <input type="hidden" class="form-control request" name="borrower" id="borrower" readonly />
                    <div class="col-12 text-right mt-5">
                    <input type="submit" name="insert" id="insert" value="Approve" class="btn btn-primary btn-sm" />  
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal Return -->
<div class="modal fade" id="Borrow_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Return Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="borrow_form" method="post">
                    <div class="row">
                        <div class="col-4 text-right">
                            <label>Document type:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="return_class" id="return_class" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <label>CV tran:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="return_cv" id="return_cv" readonly />
                        </div>
                    </div>
                    <input type="hidden" id="return_id" name="return_id">
                    <input type="hidden" class="form-control request" name="cv_id" id="returncv_id" readonly />
                    <input type="hidden" class="form-control request" name="emp_id" id="returnemp_id" readonly />
                    <input type="hidden" class="form-control request" name="borrower" id="returnborrower" readonly />
                    <div class="col-12 text-right mt-5">
                    <input type="submit" name="insert" id="insert" value="Submit" class="btn btn-primary btn-sm" />  
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function myApproved(approve_id , approve_class , approve_cv , cv_id , emp_id , borrower) {
        $('#Approved_modal').modal('show');
        document.getElementById("approve_id").value = approve_id;
        document.getElementById("approve_class").value = approve_class;
        document.getElementById("approve_cv").value = approve_cv;
        document.getElementById("cv_id").value = cv_id;
        document.getElementById("emp_id").value = emp_id;
        document.getElementById("borrower").value = borrower;
        $('#approve_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"approval_function.php",  
                method:"POST",  
                data:$('#approve_form').serialize(),    
                success:function(data){  
                    $('#approve_form')[0].reset();  
                    $('#Approved_modal').modal('hide');  
                    $('#approved_table').html(data);  
                    window.location.reload();
                }  
            });  
        }); 
    }
    function myBorrowed(return_id , return_class , return_cv , returncv_id , returnemp_id , returnborrower) {
        $('#Borrow_modal').modal('show');
        document.getElementById("return_id").value = return_id;
        document.getElementById("return_class").value = return_class;
        document.getElementById("return_cv").value = return_cv;
        document.getElementById("returncv_id").value = returncv_id;
        document.getElementById("returnemp_id").value = returnemp_id;
        document.getElementById("returnborrower").value = returnborrower;
        $('#borrow_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"return_function.php",  
                method:"POST",  
                data:$('#borrow_form').serialize(),    
                success:function(data){  
                    $('#borrow_form')[0].reset();  
                    $('#Borrow_modal').modal('hide');  
                    $('#borrow_table').html(data);  
                    window.location.reload();
                }  
            });  
        }); 
    }
    
    $(document).ready(function(){  
        $('#approved_table').DataTable();
        $('#borrow_table').DataTable();
        $('#return_table').DataTable();


    });  
</script>
<?php
require_once("../include/footer.php");
?>
