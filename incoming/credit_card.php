<?php
$active = "Credit card";
require_once("../include/connection.php");
require_once("../include/header.php");
require("../include/navbar.php");


$sql = "SELECT * FROM credit_card ORDER BY creditcard DESC";  
$result = mysqli_query($conn, $sql);  
?>
<div id="main" class="row mt-3 mr-1">
    <div class="col-2">
        <label class="tags">Credit Card</label>
    </div>
    <div class="col-3">
        <button type="button" id="add" name="add" class="btn btn-sm btn-primary p-1" data-toggle="modal" data-target="#add_receipt_Modal" >Add Receipt</button>
        <button type="button" id="edit" name="edit" class="btn btn-sm btn-secondary p-1" disabled data-toggle="modal" data-target="#edit_receipt_Modal">Edit Receipt</button>
    </div>
    <div class="col-2 ">
      <select id="statusFilter" class="form-control form-control-sm">
        <option value="">Show All</option>
        <option value="Available">Available</option>
        <option value="Pullout">Pullout</option>
        <option value="Stale">Stale</option>
      </select>
    </div>
</div>
<!-- tableview -->
<div id="main" class="row mr-1">
    <div class="col-12 bg-light p-3">
        <table id="table_view2" class="table table-sm bg-light">
            <thead class="thead-light mr-1">
                <tr>
                <th width="5%">#</th>
                <th width="12%">Credit Card</th>
                <th width="10%">Amount</th>
                <th width="20%">Supplier</th>
                <th width="10%">Status</th>
                <th width="15%">Installment</th>
                <th width="10%">Duration</th>
                <th width="20%">Note</th>
                <th width="5%">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php  while($row = mysqli_fetch_array($result)){  
                    $d = $row['duration'];
                    $m = $row['monthly'];
                    $request = "";
                    $status = $row['stats'];
                    if($status == "Pullout"){
                        $request = "disabled";
                    }else{
                        echo "";
                    }
                    ?>  
                <tr>
                    <th><input type="radio" name="able" onclick="myRadio('<?php echo $row['id']; ?>' , '<?php echo $row['creditcard']; ?>' , '<?php echo $row['amount']; ?>' , '<?php echo $row['supplier']; ?>', '<?php echo $row['stats']; ?>' , '<?php echo $row['install']; ?>' , '<?php echo $row['duration']; ?>'  , '<?php echo $row['notes']; ?>')" /></th>
                    <td><?php echo $row['creditcard']; ?></td>
                    <td><?php echo number_format($row['amount'],2); ?></td>  
                    <td><?php echo $row['supplier']; ?></td>
                    <td><?php echo $row['stats']; ?></td>
                    <td><?php echo $row['install']; ?></td>  
                    <td><?php

                        if($m == '' && $d == '') {
                            
                        } else if($m == '' && $d != '') {
                            echo $d." month/s ";
                        } else {
                            echo $m." of ".$d;
                        }          
                        ?>
                    </td>
                    <td><?php echo $row['notes']; ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn fa fa-cog  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" onclick="myRadios('<?php echo $row['id']; ?>' , '<?php echo $row['creditcard']; ?>' , '<?php echo $row['amount']; ?>' , '<?php echo $row['supplier']; ?>', '<?php echo $row['stats']; ?>' , '<?php echo $row['install']; ?>' , '<?php echo $row['duration']; ?>', '<?php echo $row['notes']; ?>')">View</a>                              
                                <a class="dropdown-item <?php echo $request ?>" href="#" onclick="myRequest('<?php echo $row['id']; ?>' , '<?php echo $row['creditcard']; ?>' , '<?php echo $row['amount']; ?>' , '<?php echo $row['supplier']; ?>', '<?php echo $row['duration']; ?>', '<?php echo $row['monthly']; ?>')">Request</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php  }   ?>  
            </tbody>
        </table>
    </div>
</div>
<!--Add Modal -->
<div id="add_receipt_Modal"  class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <div class="row">
                        <div class="col-6">
                            <label>Credit card #</label>
                            <input type="text" name="cc" id="cc" class="form-control form-control-sm" />
                        </div>
                        <div class="col-6">
                            <label>Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control form-control-sm" autocomplete="off" />
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Supplier</label>
                            <input type="text" name="supplier" id="supplier" class="form-control form-control-sm"  />
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
<div class="modal fade" id="edit_receipt_Modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_form">
                    <div class="row">
                        <div class="col-6">
                            <label>Credit Card #</label>
                            <input type="text" name="edit_cc" id="edit_cc" class="form-control form-control-sm" autocomplete="off" />
                        </div>
                        <div class="col-6">
                            <label>Amount</label>
                            <input type="text" name="edit_amount" id="edit_amount" class="form-control form-control-sm" autocomplete="off" />
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Supplier</label>
                            <input type="text" name="edit_supplier" id="edit_supplier" class="form-control form-control-sm">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Status</label>
                            <select name="edit_stats" id="edit_stats" class="form-control form-control-sm" required>
                                <option value="Available">Available</option>
                                <option value="Pullout">Pullout</option>
                                <option value="Stale">Stale</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Installment</label>
                            <input type="text" name="install" id="install" class="form-control form-control-sm edit_install" readonly>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Duration</label>
                            <select name="duration" id="duration" class="form-control form-control-sm" onchange="myDuration()">
                                <option value="" Selected disabled>Select Duration</option>
                                <option value="2">2 months</option>
                                <option value="3">3 months</option>
                                <option value="6">6 months</option>
                                <option value="12">12 months</option>
                                <option value="24">24 months</option>
                                <option value="36">36 months</option>
                            </select>
                        </div>
                    </div>
                    <!-- <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Monthly</label>
                            <input type="text" name="monthly" id="monthly" class="form-control form-control-sm edit_install" disabled>
                        </div>
                    </div> -->
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <label>Note</label>
                            <input type="text" name="edit_notes" id="edit_notes" class="form-control form-control-sm">
                        </div>
                    </div>
                    <br>
                    <br>
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
<div class="modal fade" id="view_receipt_Modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Creditcard Info
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="view_form">
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 label_property">
                            <label>Creditcard #</label>
                        </div>
                        <div class="col-7 border border-secondary">
                            <input type="text" class="data_property" name="view_cc" id="view_cc" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Amount</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">
                            <input type="text" name="view_amount" id="view_amount" class="data_property" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Supplier</label>
                        </div>      
                        <div class="col-7 border border-secondary border-top-0">
                            <input name="view_supplier" id="view_supplier" class="data_property" readonly />
                            
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Status</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">   
                            <input name="view_stats" id="view_stats" class="data_property" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Installment</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">    
                            <input type="text" name="view_install" id="view_install"class="data_property" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border border-secondary ml-4 border-right-0 border-top-0 label_property">
                            <label>Duration</label>
                        </div>
                        <div class="col-7 border border-secondary border-top-0">   
                            <input type="text" name="view_duration" id="view_duration" class="data_property" readonly />

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
<!-- request modal-->
<div class="modal fade" id="request_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Request Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="request_form" method="post">
                    <div class="row">
                        <div class="col-4 text-right">
                            <label>Requestor Name:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="p_requestor" id="p_requestor" required />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label>Credit Card #:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="p_cc" id="p_cc" readonly />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label>Amount:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="p_amount" id="p_amount" readonly />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label>Supplier:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control request" name="p_supplier" id="p_supplier" readonly />
                        </div>
                    </div>
                    <input type="hidden" id="p_id" name="p_id">
                    <input type="hidden" name="cd" id="cd">
                    <input type="hidden" name="m" id="m">

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
    function myRequest(p_id , p_cc , p_amount , p_supplier, cd , m) {
        $('#request_modal').modal('show');
        document.getElementById("p_id").value = p_id;
        document.getElementById("p_cc").value = p_cc;
        document.getElementById("p_amount").value = p_amount;
        document.getElementById("p_supplier").value = p_supplier;
        document.getElementById("cd").value = cd;
        document.getElementById("m").value = m;

        $('#request_modal').on('shown.bs.modal', function () {
            $   ('#p_requestor').focus();
        })
        $('#request_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"request_cc_function.php",  
                method:"POST",  
                data:$('#request_form').serialize(),  
                success:function(data){  
                    $('#request_form')[0].reset();  
                    $('#request_modal').modal('hide');  
                    $('#table_view2').html(data);  
                    window.location.reload();
                }  
            });  
        }); 
    }
    function myRadios(view_id , view_cc , view_amount , view_supplier , view_stats, view_install,  view_duration,  view_notes) {
        $('#view_receipt_Modal').modal('show');
        document.getElementById("view_id").value = view_id;
        document.getElementById("view_cc").value = view_cc;
        document.getElementById("view_amount").value = view_amount;
        document.getElementById("view_supplier").value = view_supplier;
        document.getElementById("view_stats").value = view_stats;
        document.getElementById("view_duration").value = view_duration;
        document.getElementById("view_install").value = view_install;
        document.getElementById("view_notes").value = view_notes;
        // document.getElementById("edit_monthly").value = edit_monthly;
    }

    function myRadio(list_id , edit_cc , edit_amount , edit_supplier , edit_stats, install,  duration,  edit_notes) {
    document.getElementById("edit").disabled = false;
    document.getElementById("list_id").value = list_id;
    document.getElementById("edit_cc").value = edit_cc;
    // document.getElementById("edit_amount").value = edit_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("edit_amount").value = edit_amount.toString().replace(/ /g, ",");
    document.getElementById("edit_supplier").value = edit_supplier;
    document.getElementById("edit_stats").value = edit_stats;
    document.getElementById("duration").value = duration;
    // document.getElementById("monthly").value = monthly;
    document.getElementById("install").value = install;
    document.getElementById("edit_notes").value = edit_notes;
        
        $('#edit_receipt_Modal').on('shown.bs.modal', function () {
        $   ('#edit_cc').focus();
        })
        $('#edit_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"edit_receipt_function.php",  
                method:"POST",  
                data:$('#edit_form').serialize(),  
                beforeSend:function(){  
                    $('#update').val("Updating");  
                },  
                success:function(data){  
                    $('#edit_form')[0].reset();  
                    $('#edit_receipt_Modal').modal('hide');  
                    $('#table_view2').html(data);  
                    // window.location.reload();
                }  
            });  
        });  
    }

    $(document).ready(function(){  
        $('#add').click(function(){  
            $('#insert').val("Insert");  
            $('#insert_form')[0].reset();  
        });  
        $('#add_receipt_Modal').on('shown.bs.modal', function () {
        $   ('#cc').focus();
        })
        $('#insert_form').on("submit", function(event){  
            event.preventDefault();  
            if($('#cc').val() == ""){  
            alert("Creditcard # is required");  
            }  
            else if($('#amount').val() == ""){  
            alert("Amount is required");  
            }  
            else if($('#supplier').val() == ""){  
            alert("Supplier is required");  
            }else{  
                $.ajax({  
                    url:"add_receipt_function.php",  
                    method:"POST",  
                    data:$('#insert_form').serialize(),  
                    beforeSend:function(){  
                        $('#insert').val("Inserting");  
                    },  
                    success:function(data){  
                        $('#insert_form')[0].reset();  
                        $('#add_receipt_Modal').modal('hide');  
                        $('#table_view2').html(data);  
                        window.location.reload();
                    }  
                });  
            }  
        });    
        $('#table_view2').DataTable( {
            "order": [[ 2, "desc" ]],
            "searching": true
        } );
        var table = $('#table_view2').DataTable();
        
        var categoryIndex = 0;
        $("#table_view2 th").each(function (i) {
            if ($($(this)).html() == "Status") {
                categoryIndex = i; return false;
            }
        });

        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
            var selectedItem = $('#statusFilter').val()
            var category = data[categoryIndex];
            if (selectedItem === "" || category.includes(selectedItem)) {
                return true;
            }
                return false;
            }
        );

        $("#statusFilter").change(function (e) {
            table.draw();
        });
            table.draw();
    });  
    
    function myDuration(){
        // document.getElementById("monthly").disabled = false;
        var x = document.getElementById("duration").value;
        var y = document.getElementById("edit_amount").value;
        var result = y.replace(/,/g, "");
        var z = result / x;
        document.getElementById("install").value = z.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }
</script>  
<?php
require_once("../include/footer.php");
?>
