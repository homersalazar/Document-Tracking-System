<?php
require_once("../client/auth_session.php");
require_once("../include/connection.php");
?>
<div class="sidenav">
  <br>
  <br>
  <?php if($_SESSION['Access'] == "admin"){ ?>
    <a class="fa fa-tachometer fa-2x" href="../dashboard/dashboard.php">&nbsp; Dashboard</a>
  <?php }else{ ?> 
    <a class="fa fa-tachometer fa-2x" href="../dashboard/index.php">&nbsp; Dashboard</a>
  <?php } ?>

  <?php if($_SESSION['Access'] == "admin"){ ?>
    <button class="dropdown-btn"><i class="fa fa-download">&nbsp; Incoming</i> 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a class="fa fa-file link"   href="../incoming/check_voucher.php"> Check Voucher</a>
      <a class="fa fa-credit-card link"  href="../incoming/credit_card.php"> Credit Card</a>
    </div>
  <?php }else{ ?> 
  <button class="dropdown-btn"><i class="fa fa-upload">&nbsp; Forwarded</i> 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a class="fa fa-file" href="../forwarded/check_voucher.php"> Check Voucher</a>
    <a class="link" href="#">Link 2</a>
    <a class="link" href="#">Link 3</a>
  </div>
  <a class="fa fa-cogs" href="#">&nbsp; Control Panel</a>

  <?php } ?>

  <?php if($_SESSION['Access'] == "admin"){ ?>
  <a class="fa fa-cogs" href="../indicator_panel/control_panel_admin.php">&nbsp; Control Panel</a>
  <a class="fa fa-clipboard" href="../incoming/return.php">&nbsp;Return</a>
  <a class="fa fa-flag" href="#contact">&nbsp; Report</a>
  <?php } ?>

</div>

<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script> 