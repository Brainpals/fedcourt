<?php $tab = 1; ?>

<!-- Top Navbar -->
 <style>
  .black{
    background-color:black;
    color:white;
  }
 </style>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../vendor/img/payems25_header_icon.png" style="width:30px;"> PAYEMS25</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
     
      <ul class="navbar-nav ms-auto">
      <li class="nav-item"><button type="button" class="btn btn-warning btn-lg"
        data-bs-toggle="modal" data-bs-target="#chooseSet">
  <?php  echo date('F', mktime(0, 0, 0, $_SESSION['work_month'], 1)).','.$_SESSION['work_yr'];  ?>
</button></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-circle text-white"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="../logout"><i class="fas fa-sign-out-alt text-white"></i></a></li>
        
      </ul>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<nav id="sidebarMenu" class="d-none d-md-block bg-dark mt-2">
  <div class="list-group list-group-flush">
    <a href="index" class="list-group-item list-group-item-action <?php if ($tab == 1) echo 'black'; ?>"><i class="fas fa-home me-2"></i>Dashboard</a>
    <a href="payms_staff" class="list-group-item list-group-item-action <?php if ($tab == 2) echo 'black'; ?>"><i class="fas fa-users me-2"></i>Staff</a>
    <a href="payems_enroll" class="list-group-item list-group-item-action <?php if ($tab == 3) echo 'black'; ?>"><i class="fas fa-user-plus me-2"></i>Enrollment</a>
    <a href="payems_bulkView" class="list-group-item list-group-item-action <?php if ($tab == 5) echo 'black'; ?>"><i class="fas fa-list me-2"></i>Bulk View</a>

    <div class="accordion" id="sidebarAccordion">
      <div class="accordion-item border-0">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
            <i class="fas fa-cogs me-2"></i> Payroll &amp; Salary
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
          <div class="accordion-body p-0">
            <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#genPay">Generate Payroll</a>
            <!-- <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#viewPayRoll">View Payroll</a> -->
            <a href="payems_payroll" class="list-group-item list-group-item-action">View Payroll</a>

            <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#bulkPay">Bulk Pay-Deduct</a>
            <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#bulkextras">Bulk P-Extras</a>
            <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#bulkPaySlips">Bulk PaySlips</a>
            <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#addQua">Qualifications</a>
          </div>
        </div>
      </div>
    </div>

    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#viewIns">
      <i class="fas fa-table me-2"></i>View & Manage
    </a>
  </div>
</nav>


<div class="modal fade" id="chooseSet" tabindex="-1" role="dialog" aria-labelledby="wrenchModalLabel">
  <div class="modal-dialog modal-sm" role="document"><div class="modal-content">
    <div class="modal-body">
<h4 class="text-center">SET WORKING MONTH AND YEAR </h4>
<form action="" method="POST">
<div class="form-group mb-2 col-md-12" style="width:100%">
            <select name="sel_month" class="form-control" required maxlength="12" minlength="2">
           <?php  for ($i = 1; $i <= 12; $i++) {
    echo '<option value="'.$i.'">'.date('F', mktime(0, 0, 0, $i, 1)).'</option>';
}?></select></div>  
<div class="form-group mb-2 col-md-12">
            <select name="sel_year" class="form-control select2-tags" required maxlength="12" minlength="2">
              <?php  foreach(QueryDB("SELECT year from payems_yrset ")as $yr){
					echo '<option value='.$yr['year'].'>'.$yr['year'].'</option>';
              }  ?></select></div> 
<div class="form-group"><input type="submit"  name="setWorkingItems" class="mt-2 form-control btn btn-secondary" value="Set"></div>
</form>
    </div></div></div></div>