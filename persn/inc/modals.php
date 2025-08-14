
<!-- Modal structure -->
<div class="modal fade" id="addTitle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm"><div class="modal-content">
    <div class="modal-header bg-secondary"><h5 class="modal-title text-white" id="exampleModalLabel">
        Add Title</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div><div class="modal-body"><form action="" method="POST">
         <div class="form-group mb-2 col-md-12" style="width:100%">
            <select name="title" class="form-control select2-tags" required maxlength="12" minlength="2">
              <?php  foreach(QueryDB("SELECT id,title from payems_title ")as $tilt){
					echo '<option value='.$tilt['title'].'>'.$tilt['title'].'</option>';
              }  ?></select></div>  
<div class="form-group"><input type="submit"  name="addTitle" class="mt-2 form-control btn btn-secondary" value="Add Title"></div> </form></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>

<!-- Add Rank -->
<div class="modal fade" id="addRank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm"><div class="modal-content">
    <div class="modal-header bg-secondary"><h5 class="modal-title text-white" id="exampleModalLabel">
        Add Rank</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div><div class="modal-body"><form action="" method="POST">
         <div class="form-group mb-2 col-md-12" style="width:100%">
            <select name="rank" class="form-control select2-tags" required maxlength="12" minlength="2">
              <?php  foreach(QueryDB("SELECT id,title from payems_rank ")as $ptilt){
					echo '<option value='.$ptilt['title'].'>'.$ptilt['title'].'</option>';
              }  ?></select></div>  
<div class="form-group"><input type="submit"  name="addRank" class="mt-2 form-control btn btn-secondary" value="Add Rank"></div> </form></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>

<!-- Add Rank -->
<div class="modal fade" id="addDuty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm"><div class="modal-content">
    <div class="modal-header bg-secondary"><h5 class="modal-title text-white" id="exampleModalLabel">
        Add Posting</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div><div class="modal-body"><form action="" method="POST">
         <div class="form-group mb-2 col-md-12" style="width:100%">
            <select name="duty" class="form-control select2-tags" required maxlength="12" minlength="2">
              <?php  foreach(QueryDB("SELECT station_name from payems_duty_station ")as $stilt){
					echo '<option value='.$stilt['station_name'].'>'.$stilt['station_name'].'</option>';
              }  ?></select></div>  
<div class="form-group"><input type="submit"  name="addPost" class="mt-2 form-control btn btn-secondary" value="Add Rank"></div> </form></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>

<!-- Add Department -->
<div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm"><div class="modal-content">
    <div class="modal-header bg-secondary"><h5 class="modal-title text-white" id="exampleModalLabel">
        Add Department</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><form action="" method="POST">
         <div class="form-group mb-2 col-md-12" style="width:100%">
            <select name="dept" class="form-control select2-tags" required maxlength="12" minlength="2">
              <?php  foreach(QueryDB("SELECT d_name from payems_dept ")as $dept){
					echo '<option value='.$dept['d_name'].'>'.$dept['d_name'].'</option>';
              }  ?></select></div>  
<div class="form-group"><input type="submit"  name="addDept" class="mt-2 form-control btn btn-secondary" value="Add Department"></div> </form></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>

<!-- Add Cadre -->
<div class="modal fade" id="addCadre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm"><div class="modal-content">
    <div class="modal-header bg-secondary"><h5 class="modal-title text-white" id="exampleModalLabel">
        Add Cadre</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><form action="" method="POST">
         <div class="form-group mb-2 col-md-12" style="width:100%">
            <select name="cadre" class="form-control select2-tags" required maxlength="12" minlength="2">
              <?php  foreach(QueryDB("SELECT cadre_name from payems_cadre ")as $cader){
					echo '<option value='.$cader['cadre_name'].'>'.$cader['cadre_name'].'</option>';
              }  ?></select></div>  
<div class="form-group"><input type="submit"  name="addCadre" class="mt-2 form-control btn btn-secondary" value="Add Cadre"></div> </form></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>


<!-- Add Qualifications -->
<div class="modal fade" id="addQua" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm"><div class="modal-content">
    <div class="modal-header bg-secondary"><h5 class="modal-title text-white" id="exampleModalLabel">
        Add Qualifications</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><form action="" method="POST">
         <div class="form-group mb-2 col-md-12" style="width:100%">
            <select name="qua" class="form-control select2-tags" required maxlength="12" minlength="2">
              <?php  foreach(QueryDB("SELECT name from payems_quali ")as $quali){
					echo '<option value='.$quali['name'].'>'.$quali['name'].'</option>';
              }  ?></select></div>  
<div class="form-group"><input type="submit"  name="addQua" class="mt-2 form-control btn btn-secondary" value="Add Qualification"></div> </form></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>

<!--View Insertions-->
<div class="modal fade" id="viewIns" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm"><div class="modal-content">
    <div class="modal-header bg-secondary"><h5 class="modal-title text-white" id="exampleModalLabel">
        View &amp; Manage Records</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><form action="" method="POST">
         <div class="form-group mb-2 col-md-12" style="width:100%">
            <select name="view" class="form-control" required maxlength="12" minlength="2">
              <option value="Title">Title</option><option value="Rank">Rank</option>
              <option value="Duty_Station">Duty Station</option><option value="Departments">Departments</option><option value="Cadre">Cadre</option><option value="Qualifications">Qualifications</option>
              </select></div>  
<div class="form-group"><input type="submit"  name="setView" class="mt-2 form-control btn btn-secondary" value="Manage"></div> </form></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>

