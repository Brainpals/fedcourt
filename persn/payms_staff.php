<?php  include 'xyz.php';  ?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PAYEMS25 - Personnel Dashboard</title><?php  include('inc/top.html') ?></head>
<body><?php $tab=2; include('inc/nav.php');?>

<div class="container-fluid mt-2">
  <div id="main-content">

  <div class="row g-3 mb-3">

<h4 class="bg-secondary text-white text-center">STAFF DETAILS</h4>

<table id="example" class="display nowrap" style="width:100%">
  <thead>
    <tr>
      <th>#</th><th>PSN</th>
      <th>Full Name</th>
      <th>Sex</th>
      <th>Salary-G</th>
      <th>R/C</th>
      <th>Phone</th>
      <th>Department</th>
      <th>Action</th>
    </tr> 
  </thead>
  <tbody> 
  <?php ob_start(); $count =1;
  $start = microtime(true); 
foreach($linkr->getRecFrmQry("SELECT psn,CONCAT(surname, ' ', firstname, ' ', middlename) AS fullname,sex,gsmnumber,passport,openfileno,secretfileno,title,bgroup,dob,state,lga,promotion,suspension,transfer,withdrawal FROM payems_staff order by employee_id DESC LIMIt 100") as $stmt){
$baseName = explode(' ',$stmt['fullname']);
  echo '<tr><td>'.$count.'</td><td>'.$stmt['psn'].'</td><td>'.$stmt['fullname'].'</td>
<td>'.substr($stmt['sex'],0,1).'</td><td>'.$linkr->get_salary_group($stmt['psn']).'</td>
<td>'.$linkr->conhess($stmt['psn']).'</td><td>'.$stmt['gsmnumber'].'</td><td>'.$linkr->staffDept($stmt['psn']).'</td>
<td><button class="open-modal btn-warning btn btn-sm"
        data-psn="' . $stmt['psn'] . '" 
        data-fullname="'.$stmt['fullname'].'"
        data-conhess="' . $linkr->emp_info($stmt['psn'])['conhess'] .'"
        ><i class="fa fa-wrench "></i></button>
<a target="_blank" href="payems_staffedit?rod='.rand().'&r='.$stmt['psn'].'"><i class="fa fa-edit "></i></a>

</td></tr>';
 $count++;} ob_end_flush(); ?>
  </tbody>
</table>

<?php    
// $duration = microtime(true) - $start;
// echo "Loaded in {$duration} seconds";

?>
</div></div></div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <form id="editForm" enctype="multipart/form-data">
      <div class="modal-content"><div class="modal-header-sm bg-primary"><h4 class="modal-title text-white">
        &nbsp;&nbsp;<span class="fullname"></span> </h4> </div>

        <div class="modal-body">
<div class="container-fluid"> <form action="" method="POST" id="uploadForm" enctype="multipart/form-data"> 
  
<div class="row">
  <input type="hidden" id="activePSN" name="where">
<div class="form-group"><label>Employment Status</label><select class="form-control" name="emp_status" id="emp_status"><option value="Active">Active</option>
<option value="Promotion">Promotion</option><option value="Suspension">Suspension</option>
<option value="Transfer">Transfer</option><option value="withdrawal">withdrawal</option>
</select></div>

<div class="form-group"><label>Salary Group</label><select class="form-control" name="salarygroup" id="salarygroup"><?php  
  foreach(QueryDB("SELECT title,chart_tbl FROM payems_salgroup")as $sgroup){?>
<option value="<?php echo ucwords(strtolower($sgroup['title'])); ?>"><?php echo $sgroup['title']; ?></option> <?php } ?>
</select></div>
<div class="form-group"><label>Grade/Step (<span class="text-danger show_conhess"></span>)</label><select class="form-control" name="conhess" id="conhess">
    <option value="" class="show_conhess"></option>
</select></div>
  </form>
</div></div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </form>
  </div>
</div>

<?php include('inc/bottom.html');  ?>


<script>
$(document).ready(function(){ 
  $('.open-modal').click(function(){ 
    $('.fullname').text($(this).data('fullname') + '['+ $(this).data('psn')  +']');
    $('#activePSN').val($(this).data('psn'));
  $('.show_conhess').text($(this).data('conhess')); $('.show_conhess').val($(this).data('conhess'));
    $('#editModal').modal('show');
  });

  $('#editForm').submit(function(e){
  e.preventDefault();
  
  // Create FormData object
  var formData = new FormData(this);

  $.ajax({
    url: 'ajx/process_update',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(resp){
      alert('Update Successful!');
      $('#editModal').modal('hide');
      location.reload();
    },
    error: function(){
      alert('Error updating staff');
    }
  });
});

$('#salarygroup').change(function(){ data_sent = $(this).val();
  $.ajax({
                    url: 'data',
                    type: 'POST',
                    data: { dataPipe: data_sent },
                    success: function(response) { //alert(response);
                        $('#conhess').html(response);
                    },
                    error: function(xhr, status, error) {
                        $('#result').html('Error: ' + error);
                    }
                });
})



});
</script>





</body></html>
