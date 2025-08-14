<?php  include 'xyz.php';  ?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PAYEMS25 - Personnel Dashboard</title><?php  include('inc/top.html') ?></head>
<body><?php $tab=1; include('inc/nav.php')  ?>

<div class="container mt-4">
  <div id="main-content">
<?php  include 'process.php';  ?>
  
    <div class="row g-3 mb-3">
<?php  if(isset($_GET['view']) and $_GET['view']=='Title'){?>
<div class="col-md-6 offset-md-3"><div class="card">
<div class="card-header bg-secondary text-white"><h4>Staff Title Record</h4></div><div class="card-body">
<table class="table table-striped table-responsive">
  <thead><tr><th>#</th><th>Title</th><th>Added</th></tr></thead> <tbody>
    <?php $titleCount =1;  foreach(QueryDB("SELECT title,created_at FROM payems_title ")as $title){
      echo '<tr><th>'.$titleCount.'</th><th>'.$title['title'].'</th><th>'.$title['created_at'].'</th></tr>';
    $titleCount++;}?></tbody></table></div>
  <div class="card-footer bg-primary text-white"><?php echo QueryDB("SELECT COUNT(*) FROM payems_title ")->fetchColumn();  ?> Records</div></div></div>
   <?php  }else if(isset($_GET['view']) and $_GET['view']=='Rank'){ ?>
<div class="col-md-6 offset-md-3"><div class="card">
<div class="card-header bg-secondary text-white"><h4>Staff Rank Record</h4></div><div class="card-body">
<table class="table table-striped table-responsive">
  <thead><tr><th>#</th><th>Title</th><th>Added</th></tr></thead> <tbody>
    <?php $rankCount =1;  foreach(QueryDB("SELECT title,created_at FROM payems_rank ")as $title){
      echo '<tr><th>'.$rankCount.'</th><th>'.$title['title'].'</th><th>'.$title['created_at'].'</th></tr>';
    $rankCount++;}?></tbody></table></div>
  <div class="card-footer bg-primary text-white"><?php echo QueryDB("SELECT COUNT(*) FROM payems_rank ")->fetchColumn();  ?> Records</div></div></div>
<?php  }else if(isset($_GET['view']) and $_GET['view']=='Duty_Station'){ ?>
<div class="col-md-6 offset-md-3"><div class="card">
<div class="card-header bg-secondary text-white"><h4>Staff Duty Post/Posting</h4></div><div class="card-body">
<table class="table table-striped table-responsive">
  <thead><tr><th>#</th><th>Title</th><th>Added</th></tr></thead> <tbody>
    <?php $rankCount =1;  foreach(QueryDB("SELECT station_name,created_at FROM payems_duty_station ")as $dutyPost){
      echo '<tr><th>'.$rankCount.'</th><th>'.$dutyPost['station_name'].'</th><th>'.$dutyPost['created_at'].'</th></tr>';
    $rankCount++;}?></tbody></table></div>
  <div class="card-footer bg-primary text-white"><?php echo QueryDB("SELECT COUNT(*) FROM payems_duty_station ")->fetchColumn();  ?> Records</div></div></div>

<?php  }else if(isset($_GET['view']) and $_GET['view']=='Departments'){ ?>
<div class="col-md-6 offset-md-3"><div class="card">
<div class="card-header bg-secondary text-white"><h4>Department Listing</h4></div><div class="card-body">
<table class="table table-striped table-responsive">
  <thead><tr><th>#</th><th>Department</th><th>Added</th></tr></thead> <tbody>
    <?php $rankCount =1;  foreach(QueryDB("SELECT d_name,created_at FROM payems_dept ")as $dutyPost){
      echo '<tr><th>'.$rankCount.'</th><th>'.$dutyPost['d_name'].'</th><th>'.$dutyPost['created_at'].'</th></tr>';
    $rankCount++;}?></tbody></table></div>
  <div class="card-footer bg-primary text-white"><?php echo QueryDB("SELECT COUNT(*) FROM payems_dept ")->fetchColumn();  ?> Records</div></div></div>




<?php   }else if(isset($_GET['view']) and $_GET['view']=='Cadre'){ ?>
<div class="col-md-6 offset-md-3"><div class="card">
<div class="card-header bg-secondary text-white"><h4>Cadre Listing</h4></div><div class="card-body">
<table class="table table-striped table-responsive">
  <thead><tr><th>#</th><th>Cadre</th><th>Added</th></tr></thead> <tbody>
    <?php $cadreCount =1;  foreach(QueryDB("SELECT cadre_name,created_at FROM payems_cadre ")as $dutyPost){
      echo '<tr><th>'.$cadreCount.'</th><th>'.$dutyPost['cadre_name'].'</th><th>'.$dutyPost['created_at'].'</th></tr>';
    $cadreCount++;}?></tbody></table></div>
  <div class="card-footer bg-primary text-white"><?php echo QueryDB("SELECT COUNT(*) FROM payems_cadre ")->fetchColumn();  ?> Records</div></div></div>
<?php  }else if(isset($_GET['view']) and $_GET['view']=='Qualifications'){ ?>
<div class="col-md-6 offset-md-3"><div class="card">
<div class="card-header bg-secondary text-white"><h4>Qualifications Listing</h4></div><div class="card-body">
<table class="table table-striped table-responsive">
  <thead><tr><th>#</th><th>Qualifications</th><th>Added</th></tr></thead> <tbody>
    <?php $cadreCount =1;  foreach(QueryDB("SELECT name,created_at FROM payems_quali ")as $dutyPost){
      echo '<tr><th>'.$cadreCount.'</th><th>'.$dutyPost['name'].'</th><th>'.$dutyPost['created_at'].'</th></tr>';
    $cadreCount++;}?></tbody></table></div>
  <div class="card-footer bg-primary text-white"><?php echo QueryDB("SELECT COUNT(*) FROM payems_quali ")->fetchColumn();  ?> Records</div></div></div>


<?php  } ?>


</div>





  </div>



</div>


<!-- Anchor tag to launch the modal -->






<?php include('inc/bottom.html');  ?>
</body>
</html>