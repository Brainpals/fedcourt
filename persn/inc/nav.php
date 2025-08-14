<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../vendor/img/payems25_header_icon.png" style="width:30px;"> PAYEMS25</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
<li class="nav-item"><a class="nav-link <?php if($tab==1){ echo 'active';} ?>" href="index"><i class="fas fa-home"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link <?php if($tab==2){ echo 'active';} ?>" href="payms_staff"><i class="fas fa-users"></i> Staff</a></li>\
        <li class="nav-item"><a class="nav-link <?php if($tab==3){ echo 'active';} ?>" href="payems_enroll"><i class="fas fa-users"></i> Enrollment</a></li>
        <li class="nav-item"><a class="nav-link <?php if($tab==5){ echo 'active';} ?>" href="payems_bulkView"><i class="fas fa-list"></i> Bulk View</a></li>
      
      
        <li class="nav-item"><a class="nav-link <?php if($tab==4){ echo 'active';} ?>" href="#" data-bs-toggle="modal" data-bs-target="#addTitle"><i class="fas fa-plus"></i> Add Title</a></li>
        <li class="nav-item"><a class="nav-link  <?php if($tab==4){ echo 'active';} ?>" href="#" data-bs-toggle="modal" data-bs-target="#addRank"><i class="fas fa-plus"></i> Add Rank</a></li>
        <li class="nav-item"><a class="nav-link <?php if($tab==4){ echo 'active';} ?>" href="#" data-bs-toggle="modal" data-bs-target="#addDuty"><i class="fas fa-plus"></i> Duty Station</a></li>
        <li class="nav-item"><a class="nav-link <?php if($tab==4){ echo 'active';} ?>" href="#" data-bs-toggle="modal" data-bs-target="#addDept"><i class="fas fa-plus"></i> Departments</a></li>
        <li class="nav-item"><a class="nav-link <?php if($tab==4){ echo 'active';} ?>" href="#" data-bs-toggle="modal" data-bs-target="#addCadre"><i class="fas fa-plus"></i> Add Cadre</a></li>
        <li class="nav-item"><a class="nav-link <?php if($tab==4){ echo 'active';} ?>" href="#" data-bs-toggle="modal" data-bs-target="#addQua"><i class="fas fa-plus"></i> Qualifications</a></li>
         <li class="nav-item"><a class="nav-link <?php if($tab==10){ echo 'active';} ?>" title="View & Manage List" href="#" data-bs-toggle="modal" data-bs-target="#viewIns"><i class="fas fa-table"></i></a></li>


   

        

      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-circle text-white"></i></a></li>
         <li class="nav-item"><a class="nav-link" href="../logout"><i class="fas fa-sign-out-alt text-white"></i></a></li>
      </ul>
    </div>
  </div>
</nav>

