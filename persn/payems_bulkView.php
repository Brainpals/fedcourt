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
foreach($linkr->getRecFrmQry("SELECT psn,CONCAT(surname, ' ', firstname, ' ', middlename) AS fullname,sex,gsmnumber,passport,openfileno,secretfileno,title,bgroup,dob,state,lga FROM payems_staff order by employee_id DESC LIMIt 1000") as $stmt){
$baseName = explode(' ',$stmt['fullname']);
  echo '<tr><td>'.$count.'</td><td>'.$stmt['psn'].'</td><td>'.$stmt['fullname'].'</td>
<td>'.substr($stmt['sex'],0,1).'</td><td>'.$linkr->get_salary_group($stmt['psn']).'</td>
<td>'.$linkr->conhess($stmt['psn']).'</td><td>'.$stmt['gsmnumber'].'</td><td>'.$linkr->staffDept($stmt['psn']).'</td>
<td><button class="open-modal btn btn-primary btn-sm"
        data-psn="' . $stmt['psn'] . '" 
        data-fullname="' . $stmt['fullname'] . '" 
        data-sex="' . $stmt['sex'] . '" 
        data-surname ="'.$baseName[0].'"
        data-firstname ="'.$baseName[1].'"
        data-middlename ="'.$baseName[2].'"
        data-title="' . $stmt['title'] . '"
        data-dofa="'.$linkr->emp_info($stmt['psn'])['dofa'].'"
        data-dopa="'.$linkr->emp_info($stmt['psn'])['dopa'].'"
        data-dolp="'.$linkr->emp_info($stmt['psn'])['dolp'].'"
        data-doc="'.$linkr->emp_info($stmt['psn'])['doc'].'"
        data-gsm="' . $stmt['gsmnumber'] . '" 
        data-accountnumber="' . $linkr->bank_contact($stmt['psn'])['accountnumber'].'" 
        data-rofa="' . ucwords(strtolower($linkr->emp_info($stmt['psn'])['rankfa'])) .'" 
        data-prank="' . ucwords(strtolower($linkr->emp_info($stmt['psn'])['prank'])) .'" 
        data-cadre="' . ucwords(strtolower($linkr->emp_info($stmt['psn'])['cadre'])) .'" 
        data-bank="' . ucwords(strtolower($linkr->bank_contact($stmt['psn'])['bank'])).'" 
        data-qualification="' . ucwords(strtolower($linkr->emp_info($stmt['psn'])['qualification'])).'" 
        data-salarygroup="' . ucwords(strtolower($linkr->emp_info($stmt['psn'])['salarygroup'])).'" 
        data-conhess="' . ucwords(strtolower($linkr->emp_info($stmt['psn'])['conhess'])) .'"
        data-openfileno="' . $stmt['openfileno'] . '" 
        data-secretfileno="' . $stmt['secretfileno'].'"  
        data-employmenttypes="' . ucwords(strtolower($linkr->emp_info($stmt['psn'])['employmenttypes'])) .'"
        data-passport="' . $stmt['passport'].'"
        data-sex="' . $stmt['sex'].'"  
        data-bgroup="' . $stmt['bgroup'].'" 
        data-dob="' . $stmt['dob'].'"
        data-state="' . $stmt['state'].'"   
        data-lga="' . $stmt['lga'].'"
        data-mstatus = "' . ucwords(strtolower($linkr->bank_contact($stmt['psn'])['mstatus'])).'"
        data-dutystation = "' . ucwords(strtolower($linkr->emp_info($stmt['psn'])['dutystation'])).'"
        
       
        >]<i class="fa fa-edit "></i></button>

<a target="_blank" href="payems_staffedit?rod='.rand().'&r='.$stmt['psn'].'"><i class="fa fa-edit "></i></a>

</td></tr>';
 $count++;} ob_end_flush(); ?>
  </tbody>
</table>

<?php    
$duration = microtime(true) - $start;
echo "Loaded in {$duration} seconds";

?>
</div></div></div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <form id="editForm" enctype="multipart/form-data">
      <div class="modal-content"><div class="modal-header-sm bg-primary"><h4 class="modal-title text-white">
        &nbsp;&nbsp;Edit: <span class="fullname"></span> </h4> </div>

        <div class="modal-body">
<div class="container-fluid"> <form action="" method="POST" id="uploadForm" enctype="multipart/form-data"> 
  
<div class="row">

<div class="col-md-6" style="outline:2px dashed lightcoral;">
  <p class="text-success text-center"><strong>EMPLOYMENT DETAILS</strong></p>
  <div class="form-group"><label> Date of 1st Appt.</label><input type="date" name="dofa" id="dofa" class="form-control-sm" required></div>
  <div class="form-group"><label> Date of Conf.</label><input type="date" name="doc" id="doc" class="form-control-sm" required></div>
  <div class="form-group"><label> Date of Pres. Appt.</label><input type="date" name="dopa" id="dopa" class="form-control-sm" required></div>
  <div class="form-group"><label> Rank of 1st Appt.</label><select class="form-control-sm" name="rofa" id="rofa"><?php  
  foreach(QueryDB("SELECT title FROM payems_rank")as $rofa){?>
<option value="<?php echo ucwords(strtolower($rofa['title'])); ?>"><?php echo $rofa['title']; ?></option> <?php } ?></select></div>

<div class="form-group"><label> Present Rank.</label><select class="form-control-sm" name="prank" id="prank"><?php  
  foreach(QueryDB("SELECT title FROM payems_rank")as $rofa){?>
<option value="<?php echo ucwords(strtolower($rofa['title'])); ?>"><?php echo $rofa['title']; ?>
</option> <?php } ?></select></div>

<div class="form-group"><label> Cadre.</label><select class="form-control-sm" name="cadre" id="cadre"><?php  
  foreach(QueryDB("SELECT cadre_name FROM payems_cadre")as $rofa){?>
<option value="<?php echo ucwords(strtolower($rofa['cadre_name'])); ?>">
  <?php echo $rofa['cadre_name']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label> Account Number</label><input type="text" name="accountNumber" id="accountNumber" class="form-control-sm only-numbers">
</div>


<div class="form-group"><label> Pay Point (Bank)</label><select class="form-control-sm" name="bank" id="bank">
  <option>Choose Bank</option><?php  
  foreach(QueryDB("SELECT title FROM payems_bank")as $bankName){?>
<option value="<?php echo ucwords(strtolower($bankName['title'])); ?>"><?php echo $bankName['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label> Qualification</label><select class="form-control-sm" name="qualification" id="qualification"><?php  
  foreach(QueryDB("SELECT name FROM payems_quali")as $quali){?>
<option value="<?php echo ucwords(strtolower($quali['name'])); ?>"><?php echo $quali['name']; ?></option> <?php } ?>
</select></div>



<div class="form-group"><label>Salary Group</label><select class="form-control-sm" name="salarygroup" id="salarygroup"><?php  
  foreach(QueryDB("SELECT title,chart_tbl FROM payems_salgroup")as $sgroup){?>
<option value="<?php echo ucwords(strtolower($sgroup['title'])); ?>"><?php echo $sgroup['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label>Grade/Step (<span class="text-danger show_conhess"></span>)</label><select class="form-control-sm" name="conhess" id="conhess">
    <option value="" class="show_conhess"></option>
</select></div>

<div class="form-group"><label> Open File No.</label><input type="text" name="openfileno" id="openfileno" class="form-control-sm only-numbers">
</div>

<div class="form-group"><label> Secret File No.</label><input type="text" name="secretfileno" id="secretfileno" class="form-control-sm only-numbers">
</div>

<div class="form-group"><label>Employment Type</label><select class="form-control-sm" name="employmenttypes" id="employmenttypes">
  <option value="Temporary">Temporary</option>
  <option value="Pensionable">Pensionable</option>
  <option value="Contract">Contract</option>
</select></div>

</div>

<div class="col-md-6 bg-info">
<h5 class="text-center text-dark">PERSONAL RECORD</h5>

<div class="row">
<div class="col-md-8">
<div class="form-group "><label class="perLabel">Title</label><select class="form-control-sm mini" name="title" id="title">
  <option value="" id="curTitle"></option>
  <?php  
  foreach(QueryDB("SELECT title FROM payems_title")as $sgroup){?>
<option value="<?php echo ucwords(strtolower($sgroup['title'])); ?>"><?php echo $sgroup['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label class="perLabel"> Surname</label><input type="text" name="surname" id="surname" class="form-control-sm mini" required>
</div>
<div class="form-group"><label class="perLabel"> firstname</label><input type="text" name="firstname" id="firstname" class="form-control-sm mini" required>
</div>
<div class="form-group"><label class="perLabel"> Middlename</label><input type="text" name="middlename" id="middlename" class="form-control-sm mini" required>
</div>

<div class="form-group">
<label class="perLabel">Date of Birth</label><input type="date" name="dob" id="dob" class="form-control-sm mini" required>
</div>

<div class="form-group "><label class="perLabel">State</label><select class="form-control-sm mini" name="state" id="state">
  <?php  foreach(QueryDB("SELECT name FROM state")as $st){?>
<option value="<?php echo ucwords(strtolower($st['name'])); ?>">
  <?php echo $st['name']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label class="perLabel">M-Status</label><select class="form-control-sm mini" name="mstatus" id="mstatus">
<option value="Single">Single</option><option value="Married">Married</option><option value="Divorce">Divorce</option>
<option value="Widow">Widow</option><option value="Separated">Separated</option>
</select></div>

<div class="form-group "><label class="perLabel">Duty Station</label>
<select class="form-control-sm mini" name="dutystation" id="dutystation">
  <?php  foreach(QueryDB("SELECT station_name FROM payems_duty_station")as $st){?>
<option value="<?php echo ucwords(strtolower($st['station_name'])); ?>">
  <?php echo $st['station_name']; ?></option> <?php } ?>
</select></div>


</div>

<div class="col-md-4 " style="height:140px;">
<img id="preview" src="../vendor/img/temp_image.png" class="img-thumbnail" alt="Photo" style="height:108px;width:120px;padding:left:10px;">
<input type="file" name="image" id="imageInput" accept="image/*">
<div class="form-group "><select style="width:110px;" class="form-control-sm mini mt-1" name="gender" id="gender">
  <option value="Male">Male</option>  <option value="Female">Female</option> 
</select></div>

<div class="form-group "><select style="width:110px;" class="form-control-sm mini mt-1" name="blodgroup" id="blodgroup">
<option value="A+">A+</option><option value="A-">A-</option><option value="B+">B+</option>
<option value="B-">B-</option><option value="AB+">AB+</option><option value="AB-">AB-</option>
<option value="O+">O+</option><option value="O-">O-</option>
</select></div>


<div class="form-group "><select style="width:110px;" class="form-control-sm mini "  name="lga" id="lga">
  <option value="" id="showLga"></option>
</select></div>

<div class="form-group">
  <input type="text" name="gsmNumber" style="width:110px;" id="gsmNumber" class="form-control-sm mini mt-1" required>
</div>

</div><!--end of col-md-3-->

<div class="col-md-12">




</div><!--end of col-12-->


</div>



  </div>

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
  $('.open-modal').click(function(){ $('.fullname').text($(this).data('fullname') + '['+ $(this).data('psn')  +']');
  document.getElementById('rofa').value = $(this).data('rofa'); 
  document.getElementById('prank').value = $(this).data('prank'); 
  document.getElementById('cadre').value = $(this).data('cadre'); 
  $('#accountNumber').val($(this).data('accountnumber'));
  document.getElementById('bank').value = $(this).data('bank');
  document.getElementById('qualification').value = $(this).data('qualification');
  document.getElementById('salarygroup').value = $(this).data('salarygroup');
  $('#openfileno').val($(this).data('openfileno'));
  $('#secretfileno').val($(this).data('secretfileno')); 
  $('#employmenttypes').val($(this).data('employmenttypes'));
  $('.show_conhess').text($(this).data('conhess')); $('.show_conhess').val($(this).data('conhess'));
  
  $('#title,#curTitle').val($(this).data('title'));$('#curTitle').text($(this).data('title'));
  $('#surname').val($(this).data('surname'));$('#firstname').val($(this).data('firstname'));$('#middlename').val($(this).data('middlename'));

  $('#sex').val($(this).data('sex'));
  $('#state').val($(this).data('state'));
  $('#showLga').val($(this).data('lga'));  
  $('#showLga').text($(this).data('lga'));
  $('#mstatus').val($(this).data('mstatus'));

  $('#gsmNumber').val($(this).data('gsm')); 
  $('#dutystation').val($(this).data('dutystation')); 
  
  alert($(this).data('dutystation'));
  

  $('#bgroup').val($(this).data('bgroup'));
  $('#dob').val($(this).data('dob'));

    $('#dofa').val($(this).data('dofa'));
    $('#dopa').val($(this).data('dopa'));
    $('#doc').val($(this).data('doc'));

    $('#psn').val($(this).data('psn'));
    $('#fullname').val($(this).data('fullname'));
    $('#sex').val($(this).data('sex'));
   
    $('#editModal').modal('show');
  });

  $('#editForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: 'update_user.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(resp){
        alert(resp);
        $('#editModal').modal('hide');
        location.reload(); // Optionally reload to see changes
      },
      error: function(){
        alert('Error updating staff');
      }
    });
  });
});

$('#state').change(function(){ sel_state = $(this).val();
  $.ajax({
                    url: 'data',
                    type: 'POST',
                    data: { selState: sel_state },
                    success: function(response) {  alert(response);
                        $('#lga').html(response);
                    },
                    error: function(xhr, status, error) {
                      console.log(error);
                    }
                });
})


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




$('#preview').on('click', function () {
    $('#imageInput').click();
  });

  // Replace preview when image selected
  $('#imageInput').on('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
      };
      reader.readAsDataURL(file);
    }
  });
</script>





</body></html>
