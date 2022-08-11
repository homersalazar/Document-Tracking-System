<?php
require("../client/auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>

    <link rel="stylesheet" href="../css/style.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    
    <script src="../js/live_time.js"></script>
</head>
    <body>
        <!-- <div class="sticky-top">
            <div class="row-12 bg-primary  row">
                <div class="col-8 text-light">
                    <span id="title">Document Tracking System</span>
                </div>
                <div class="col-3 text-right text-light p-0">
                    <span class="welcome p-0">Welcome,</span><span class="property_name p-0"><?php echo $_SESSION['UserLogin']; ?></span>
                </div>
                <div class="col-1">
                    <div class="dropdown p-0">
                        <button class="btn fa fa-user-circle fa-2x p-1 icon" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu  p-0" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">A</button>
                            <button class="dropdown-item" type="button">A</button>
                            <a class="dropdown-item" type="button" href="../client/logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        

        <div class="sticky-top">
            <div class="row-12 bg-primary  row">
                <div class="col-9 text-light">
                    <span id="title">Document Tracking System<span id="badges" class="badge badge-pill badge-success ">v1</span>

                </div>
                <div class="col-3 input-group text-right text-light">
                    <!-- <span class="welcome">Welcome,</span><span class="property_name"><?php echo $_SESSION['UserLogin']; ?></span> -->
                    <span class="property_name"><?php echo $_SESSION['UserLogin']; ?></span>

                    <div class="dropdown">
                        <button class="btn fa fa-user-circle fa-2x icon" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">A</button>
                            <button class="dropdown-item" type="button">A</button>
                            <a class="dropdown-item" type="button" href="../client/logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div id="main" class="row mr-1 mt-2 ">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?php echo $active ?></li>
                    </ol>
                </nav>
            </div>
        </div>
