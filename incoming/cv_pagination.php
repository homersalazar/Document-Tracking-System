<?php
## Database configuration
require_once("../include/connection.php");

## Read value
$draw = $_POST['draw'];
$start = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (tranno like '%".$searchValue."%' or vp like '%".$searchValue."%' or attachs like '%".$searchValue."%' or notes like '%".$searchValue."%' or stats like '%".$searchValue."%') ";
}

## Total number of records without filtering
$sql = mysqli_query($conn,"SELECT count(*) AS allcount FROM voucher");
$result = mysqli_fetch_assoc($sql);
$totalRecords = $result['allcount'];

## Total number of record with filtering
$sql = mysqli_query($conn,"SELECT count(*) AS allcount FROM voucher WHERE 1 ".$searchQuery);
$result = mysqli_fetch_assoc($sql);
$totalRecordwithFilter = $result['allcount'];

## Fetch records
$sql = "SELECT * FROM voucher WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$start.",".$rowperpage;
$result = mysqli_query($conn, $sql);
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
   $id = "'".$row['id']."'";
   $tranno = "'".$row['tranno']."'";
   $vp = "'".$row['vp']."'";
   $class = "'".$row['class']."'";
   $attachs = "'".$row['attachs']."'";
   $stats = "'".$row['stats']."'";
   $years = "'".$row['years']."'";
   $notes = "'".$row['notes']."'";
   
   $dis_result = $dis_return = $dis_approved =  $dis_released = "";
   $status = $row['stats'];
   if($status == "Available"){
      $dis_approved = "disabled";
      $dis_return = "disabled";
   }
   if($status == "Requested"){
      $dis_return = "disabled";
   }
   if($status == "Borrowed"){
      $dis_approved = "disabled";
   }
   if($status == "Released"){
      $dis_released = "disabled";
      $dis_approved = "disabled";
      $dis_return = "disabled";
   }
   $data[] = array( 
   "id"=>'<input type="radio" name="able"  onclick="myRadio('.$id.' , '.$tranno.' , '.$vp.' , '.$class.', '.$attachs.', '.$stats.', '.$years.', ' .$notes.')"/>',
    "tranno"=>$row['tranno'],
    "vp"=>$row['vp'],
    "class"=>$row['class'],
    "stats"=>$row['stats'],
    "attachs"=>$row['attachs'],
    "years"=>$row['years'],
    "notes"=>$row['notes'],
    "action"=>'<div class="dropdown">
                    <button class="btn fa fa-cog  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" onclick="myRadios('.$id.' , '.$tranno.' , '.$vp.' , '.$class.', '.$attachs.', '.$stats.', '.$years.', '.$notes.')">View</a>
                        <a class="dropdown-item '.$dis_approved.'" href="../indicator_panel/control_panel_admin.php">Approved</a>
                        <a class="dropdown-item '.$dis_return.'" href="#">Return</a>
                        <a class="dropdown-item '.$dis_released.'"  href="#" onclick="myBorrow('.$id.' , '.$tranno.' , '.$vp.', '.$class.')">Request</a>
                    </div>
                </div>'
   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);
?>