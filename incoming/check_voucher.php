<?php
$active = "Check voucher";
require_once("../include/connection.php");
require_once("../include/header.php");
require("../include/navbar.php");

// $sql = "SELECT * FROM voucher ORDER BY tranno ASC";  
$sql = "SELECT * FROM voucher";  
$result = mysqli_query($conn, $sql);  

?>
<div id="main" class="row mt-3 mr-1 ">
    <div class="col-2">
        <label class="tags">Check Voucher</label>
    </div>
    <div class="col-3">
        <button type="button" id="add" name="add" class="btn btn-sm btn-primary p-1" data-toggle="modal" data-target="#add_data_Modal" >Add Voucher</button>
        <button type="button" id="edit" name="edit" class="btn btn-sm btn-secondary p-1" disabled data-toggle="modal" data-target="#editstatic">Edit Voucher</button>
        <!-- <button type="button" id="view" name="view" class="btn btn-sm btn-secondary p-1" disabled  data-toggle="modal" data-target="#viewstatic">View Voucher</button> -->
    </div>
    <!-- <div class="col-2 ">
      <select id="statusFilter" class="form-control form-control-sm">
        <option value="">Show All</option>
        <option value="Available">Available</option>
        <option value="Borrowed">Borrowed</option>
        <option value="Requested">Requested</option>
      </select>
    </div> -->
</div>
<!-- tableview -->
<div id="main" class="row mr-1">
    <div class="col-12 bg-light p-3">
        <table id="table_view1" class="table table-sm bg-light">
            <thead class="thead-light mr-1">
                <tr>
                    <th width="5%">#</th>
                    <th width="12%">Check Voucher</th>
                    <th width="14%">Voucher Payable</th>
                    <th width="15%">Classification</th>
                    <th width="10%">Status</th>
                    <th width="15%">Attachment</th>
                    <th width="5%">Year</th>
                    <th width="15%">Note</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!--Add Modal -->
<div id="add_data_Modal" name="add" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addstaticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addstaticBackdropLabel">Add Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <div class="row">
                        <div class="col-6">
                            <label>Check Voucher</label>
                            <input type="number" name="cv" id="cv" class="form-control form-control-sm" autocomplete="off" />
                        </div>
                        <div class="col-6">
                            <label>Voucher Payable</label>
                            <input type="number" name="vp" id="vp" class="form-control form-control-sm" autocomplete="off" />
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Classification</label>
                            <select name="classy" id="classy" class="form-control form-control-sm" required>
                                <option value="" Selected disabled>Select Classification</option>
                                <option value="Check Voucher">Check Voucher</option>
                                <option value="Voucher Payable">Voucher Payable</option>
                                <option value="Journal Voucher">Journal Voucher</option>
                                <option value="Attachment Only">Attachment Only</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control form-control-sm" required>
                                <option value="" Selected disabled>Select Status</option>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                                <option value="Requested">Requested</option>
                                <!-- <option value="Released">Released</option> -->
                            </select>
                        </div>
                    </div>
                    <br />  
                    <div class="row">
                        <div class="col-12">
                            <label>Attachments</label>
                            <input type="text" name="attach" id="attach" class="form-control form-control-sm">

                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Year</label>
                            <select name="years" id="years" class="form-control form-control-sm" required>
                                <option value="" Selected disabled>Select Year</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Note</label>
                            <input type="text" name="notes" id="notes" class="form-control form-control-sm">
                        </div>
                    </div>
                    <br /><br>
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary btn-sm" />  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Edit Modal -->
<div class="modal fade" id="editstatic" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editstaticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editstaticBackdropLabel">Edit Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_form">
                    <div class="row">
                        <div class="col-6">
                            <label>Check Voucher</label>
                            <input type="number" name="edit_cv" id="edit_cv" class="form-control form-control-sm" autocomplete="off" />
                        </div>
                        <div class="col-6">
                            <label>Voucher Payable</label>
                            <input type="number" name="edit_vp" id="edit_vp" class="form-control form-control-sm" autocomplete="off" />
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Classification</label>
                            <select name="edit_class" id="edit_class" class="form-control form-control-sm" required>
                                <option value="" Selected disabled>Select Classification</option>
                                <option value="Check Voucher">Check Voucher</option>
                                <option value="Voucher Payable">Voucher Payable</option>
                                <option value="Journal Voucher">Journal Voucher</option>
                                <option value="Attachment Only">Attachment Only</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Status</label>
                            <select name="edit_status" id="edit_status" class="form-control form-control-sm" required>
                                <option value="" Selected disabled>Select Status</option>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                                <option value="Requested">Requested</option>
                                <option value="Borrowed">Borrowed</option>
                                <option value="Released">Released</option>
                            </select>
                        </div>
                    </div>
                    <br />  
                    <div class="row">
                        <div class="col-12">
                            <label>Attachments</label>
                            <input type="text" name="edit_attach" id="edit_attach" class="form-control form-control-sm">

                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Year</label>
                            <select name="edit_years" id="edit_years" class="form-control form-control-sm">
                                <option value="" Selected disabled>Select Year</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Note</label>
                            <input type="text" name="edit_notes" id="edit_notes" class="form-control form-control-sm">
                        </div>
                    </div>
                    <br>
                    <br>
                    <!-- <button type="submit" name="submit" id="submit"  class="btn btn-primary btn-sm">Update</button> -->
                    <input type="hidden" id="list_id" name="list_id">
                    <input type="submit" name="update" id="update" value="Update" class="btn btn-primary btn-sm" />  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--view Modal -->
<div class="modal fade" id="viewstatic" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="view_form">
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 label_property">
                            <label>Check Voucher</label>
                        </div>
                        <div class="col-7 border border-secondary">
                            <input type="text" class="data_property" name="view_cv" id="view_cv" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Voucher Payable</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">
                            <input type="text" name="view_vp" id="view_vp" class="data_property" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Classification</label>
                        </div>      
                        <div class="col-7 border border-secondary border-top-0">
                            <input name="view_class" id="view_class" class="data_property" readonly />
                            
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Status</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">   
                            <input name="view_status" id="view_status" class="data_property" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Attachments</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">    
                            <input type="text" name="view_attach" id="view_attach"class="data_property" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Year</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">   
                            <input type="text" name="view_years" id="view_years" class="data_property" readonly />
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Note</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">  
                             <input type="text" name="view_notes" id="view_notes" class="data_property" readonly /> 
                        </div>
                    </div>
                    <input type="hidden" id="view_id" name="view_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light border border-dark btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Request Modal -->
<div class="modal fade" id="borrow_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Request Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="borrower_form" action="" method="post">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Borrower Name:</label>
                        </div>
                        <div class="col-8">
                            <select name="borrower" id="borrower" class="form-control form-control-sm" required>
                                <option value="" disabled selected>Select Borrower</option>
                                <?php $sql1 ="SELECT * FROM borrower ORDER BY fname ASC";
                                    $result1 = mysqli_query($conn, $sql1);  
                                    while($row1 = mysqli_fetch_array($result1)){ ?>
                                <option value="<?php echo $row1['id']; ?>"><?php echo $row1['fname']; ?> <?php echo $row1['lname']; ?></option>
                                <?php } ?>
                            </select>   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Check Voucher #</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="cv_num" id="cv_num" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Voucher Payable #</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="vp_nun" id="vp_nun" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Classification</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="classic" id="classic" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Borrowed Date</label>
                        </div>
                        <div class="col-8">
                            <input type="date" name="b_date" id="b_date" class="form-control form-control-sm" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="borrow_id" id="borrow_id" class="form-control form-control-sm" readonly>
                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-sm" />  
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>  
    function myBorrow(borrow_id, cv_num, vp_nun, classic) {
        $('#borrow_modal').modal('show');
        $('#borrow_modal').on('hidden.bs.modal', function () {
            $('#borrow_modal form')[0].reset();
        });
        document.getElementById("borrow_id").value = borrow_id;
        document.getElementById("cv_num").value = cv_num;
        document.getElementById("vp_nun").value = vp_nun;
        document.getElementById("classic").value = classic;
        $('#borrower_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"borrow_voucher_function.php",  
                method:"POST",  
                data:$('#borrower_form').serialize(),  
                success:function(data){  
                    $('#borrower_form')[0].reset();  
                    $('#borrow_modal').modal('hide');  
                    $('#table_view1').html(data);  
                    window.location.reload();
                }  
            });  
        }); 
    }
    function myFunction() {
            document.getElementById("borrower_form").reset();
            document.getElementById("borrower").reset();s
        }
    function myRadios(view_id , view_cv , view_vp , view_class , view_attach , view_status , view_years, view_notes) {
        $('#viewstatic').modal('show');
        document.getElementById("view_id").value = view_id;
        document.getElementById("view_cv").value = view_cv;
        document.getElementById("view_vp").value = view_vp;
        document.getElementById("view_class").value = view_class;
        document.getElementById("view_attach").value = view_attach;
        document.getElementById("view_status").value = view_status;
        document.getElementById("view_years").value = view_years;
        document.getElementById("view_notes").value = view_notes;
    }
    function myRadio(list_id , edit_cv , edit_vp , edit_class , edit_attach , edit_status , edit_years, edit_notes) {
        document.getElementById("edit").disabled = false;
        document.getElementById("list_id").value = list_id;
        document.getElementById("edit_cv").value = edit_cv;
        document.getElementById("edit_vp").value = edit_vp;
        document.getElementById("edit_class").value = edit_class;
        document.getElementById("edit_attach").value = edit_attach;
        document.getElementById("edit_status").value = edit_status;
        document.getElementById("edit_years").value = edit_years;
        document.getElementById("edit_notes").value = edit_notes;
        $('#edit_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"edit_voucher_function.php",  
                method:"POST",  
                data:$('#edit_form').serialize(),  
                beforeSend:function(){  
                    $('#update').val("Updating");  
                },  
                success:function(data){  
                    $('#edit_form')[0].reset();  
                    $('#editstatic').modal('hide');  
                    $('#table_view1').html(data);  
                    window.location.reload();
                }  
            });  
        });  
    }


    $(document).ready(function(){ 
        $('#table_view1').DataTable({
            "searching": true,
            "processing": true,
            "serverSide": true,
            "order": [[ 1, "desc" ]],
            "ajax": {
                "url": "cv_pagination.php",
                "type": "POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "tranno" },
                { "data": "vp" },
                { "data": "class" },
                { "data": "stats" },
                { "data": "attachs" },
                { "data": "years" },
                { "data": "notes" },
                { "data": "action" }
            ],
        }); 
        // var table = $('#table_view1').DataTable();

        // var statusIndex = 0;
        // $("#table_view1 th").each(function (i) {
        //     if ($($(this)).html() == "Status") {
        //         statusIndex = i; return false;
        //     }
        // });

        // $.fn.dataTable.ext.search.push(
        //     function (settings, data, dataIndex) {
        //     var selectedItem = $('#categoryFilter').val()
        //     var status = data[statusIndex];
        //     if (selectedItem === "" || status.includes(statusFilter)) {
        //         return true;
        //     }
        //     return false;
        //     }
        // );
        // $("#statusFilter").change(function (e) {
        //     table.draw();
        // });
        //     table.draw();
      
        $('#add').click(function(){  
            $('#insert').val("Insert");  
            $('#insert_form')[0].reset();  
        });  
        $('#insert_form').on("submit", function(event){  
            event.preventDefault();  
            if($('#cv').val() == ""){  
            alert("CV tran is required");  
            }    
            else if($('#classy').val() == ''){  
            alert("Classification is required");  
            }
            else if($('#status').val() == ''){  
            alert("Status is required");  
            }else{  
                $.ajax({  
                    url:"add_voucher_function.php",  
                    method:"POST",  
                    data:$('#insert_form').serialize(),  
                    beforeSend:function(){  
                        $('#insert').val("Inserting");  
                    },  
                    success:function(data){  
                        $('#insert_form')[0].reset();  
                        $('#add_data_Modal').modal('hide');  
                        $('#table_view1').html(data);  
                        window.location.reload();
                    }  
                });  
            }  
        }); 
  
    });
</script>  
<?php
require_once("../include/footer.php");
?>
