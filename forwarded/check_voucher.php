<?php
$active = "Check Voucher";
require_once("../include/connection.php");
require_once("../include/header.php");
require("../include/navbar.php");

$sql = "SELECT * FROM voucher ORDER BY tranno DESC";  
$result = mysqli_query($conn, $sql);  

?>
<div id="main" class="row mt-3 mr-1 ">
    <div class="col-2">
        <label class="tags">Check Voucher</label>
    </div>
</div>
<!-- tableview -->
<div id="main" class="row mr-1">
    <div class="col-12 bg-light p-3">
        <table id="table_view1" class="table table-sm bg-light">
            <thead class="thead-light mr-1">
                <tr>
                    <th width="5%">Action</th>
                    <th width="12%">Check Voucher</th>
                    <th width="14%">Voucher Payable</th>
                    <th width="15%">Classification</th>
                    <th width="10%">Status</th>
                    <th width="15%">Attachment</th>
                    <th width="5%">Year</th>
                    <th width="15%">Remarks</th>
                </tr>
            </thead>
        </table>
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
<!-- modal request -->
<div class="modal fade" id="request_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Request Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="request_form" method="post">
                    <div class="row">
                        <div class="col-4 text-right">
                            <label>Document type:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="request_class" id="request_class" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <label>CV tran:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="request_cv" id="request_cv" readonly />
                        </div>
                    </div>
                    <input type="hidden" id="request_id" name="request_id">
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
    function myRequest(request_id , request_class , request_cv) {
        $('#request_modal').modal('show');
        document.getElementById("request_id").value = request_id;
        document.getElementById("request_class").value = request_class;
        document.getElementById("request_cv").value = request_cv;
        $('#request_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"request_voucher_function.php",  
                method:"POST",  
                data:$('#request_form').serialize(),  
                // beforeSend:function(){  
                //     $('#insert').val("Inserting");  
                // },  
                success:function(data){  
                    $('#request_form')[0].reset();  
                    $('#request_modal').modal('hide');  
                    $('#table_view1').html(data);  
                    window.location.reload();
                }  
            });  
        }); 
    }


    $(document).ready(function(){ 
        $('#table_view1').DataTable({
            "processing": true,
            "serverSide": true,
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
                { "data": "notes" }
            ],
        }); 

        $('#table_view1').DataTable();
    });  
</script>  
<?php
require_once("../include/footer.php");
?>
