<?php  include 'xyz.php';  ?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PAYEMS25 - Personnel Dashboard</title><?php  include('inc/top.html') ?></head>
<body ><?php $tab=3;  include('inc/nav.php');?>

<div class="container mt-2" ><div id="main-content" ><div class="row g-3 mb-2 mt-2" 
  style="box-shadow: 5px 4px 10px 10px gray;">
 


















<form action="" method="POST" id="uploadForm" enctype="multipart/form-data"> 
  <?php   include 'process.php';  ?>
<div class="row"><div class="col-md-9"></div>
<div class="col-md-3">
  <center><img id="preview" src="../vendor/img/temp_image.png" class="img-thumbnail" alt="Photo" style="height:100px;width:100px;border-radius:50px;"><input type="file" name="image" id="imageInput" accept="image/*"></center>
</div>

<div class="col-md-4" style="background: lightgrey;">
  <p class="text-success text-center"><strong>EMPLOYMENT DETAILS</strong></p>
  <div class="form-group"><label> Date of 1st Appt.</label><input type="date" name="dofa" id="dofa" class="form-control-sm"  ></div>
  <div class="form-group"><label> Date of Conf.</label><input type="date" name="doc" id="doc" class="form-control-sm" ></div>
  <div class="form-group"><label> Date of Pres. Appt.</label><input type="date" name="dopa" id="dopa"  class="form-control-sm" required></div>
  
  <div class="form-group"><label> Rank of 1st Appt.</label><select class="form-control-sm" name="rofa"  id="rofa" required>
<option value="">-Choose-</option>
    <?php  
  foreach(QueryDB("SELECT title FROM payems_rank")as $rof){?>
<option value="<?php echo strtolower($rof['title']); ?>"><?php echo $rof['title']; ?></option> <?php } ?></select></div>

<div class="form-group"><label> Present Rank.</label><select class="form-control-sm" name="prank" id="prank" required><option value="">-Choose-</option><?php  
  foreach(QueryDB("SELECT title FROM payems_rank")as $prnk){?><option value="<?php echo strtolower($prnk['title']); ?>"><?php echo $prnk['title']; ?>
</option> <?php } ?></select></div>

<div class="form-group"><label> Cadre.</label><select class="form-control-sm" name="cadre" id="cadre" required><option value="">-Choose Cadre-</option><?php  
  foreach(QueryDB("SELECT cadre_name FROM payems_cadre")as $rofa){?>
<option value="<?php echo strtolower($rofa['cadre_name']); ?>">
  <?php echo $rofa['cadre_name']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label> Account Number</label><input type="text" name="accountNumber" id="accountNumber" class="form-control-sm only-numbers">
</div>


<div class="form-group"><label> Pay Point (Bank)</label><select class="form-control-sm" name="bank" id="bank">
  <option value="">-Choosen Bank-</option>
<?php  
  foreach(QueryDB("SELECT title FROM payems_bank")as $bankName){?>
<option value="<?php echo strtolower($bankName['title']); ?>"><?php echo $bankName['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label> Qualification</label><select class="form-control-sm" name="qualification" id="qualification"><option value="">-Choose-</option><?php  
  foreach(QueryDB("SELECT name FROM payems_quali")as $quali){?>
<option value="<?php echo strtolower($quali['name']); ?>"><?php echo $quali['name']; ?></option> <?php } ?>
</select></div>



<div class="form-group"><label>Salary Group</label><select class="form-control-sm" name="salarygroup" id="salarygroup"><option value="">-Choose-</option><?php  
  foreach(QueryDB("SELECT title,chart_tbl FROM payems_salgroup")as $sgroup){?>
<option value="<?php echo strtolower($sgroup['title']); ?>"><?php echo $sgroup['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label>Grade/Step</label><select class="form-control-sm" name="conhess" id="conhess">
<option value="" class="show_conhess"></option>
</select></div>

<div class="form-group"><label> Open File No.</label><input type="text" name="openfileno"  id="openfileno" class="form-control-sm only-numbers">
</div>

<div class="form-group"><label> Secret File No.</label><input type="text"  name="secretfileno" id="secretfileno" class="form-control-sm only-numbers">
</div>

<div class="form-group"><label>Employment Type</label><select class="form-control-sm" name="employmenttypes" id="employmenttypes"><option value="">-Choose-</option><option value="Temporary">Temporary</option><option value="Pensionable">Pensionable</option>
<option value="Contract">Contract</option></select></div>


</div>

<!--Personal Records-->
<div class="col-md-4 bg-info">


<h5 class="text-center text-dark">Personal Record</h5>
<div class="form-group "><label >Title</label><select class="form-control-sm" name="title" id="title" > <option value="">-Choose-</option><?php  foreach(QueryDB("SELECT title FROM payems_title")as $sgroup){?>
<option value="<?php echo strtolower($sgroup['title']); ?>"><?php echo $sgroup['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label >Surname</label><input type="text" name="surname" id="surname" class="form-control-sm" required>
</div>
<div class="form-group"><label >firstname</label><input type="text" name="firstname" id="firstname" class="form-control-sm" required>
</div>
<div class="form-group"><label >Middlename</label><input type="text" name="middlename" id="middlename" class="form-control-sm" required>
</div>

<div class="form-group">
<label >Date of Birth</label><input type="date" name="dob" id="dob" class="form-control-sm" required>
</div>

<div class="form-group "><label >State</label><select class="form-control-sm" name="state" id="state"><option value="">-Choose-</option><?php  foreach(QueryDB("SELECT name FROM state")as $st){?>
<option value="<?php echo strtolower($st['name']); ?>"><?php echo $st['name']; ?></option> <?php } ?></select></div>


<div class="form-group "> <label >LGA</label><select  class="form-control-sm "  name="lga" id="lga">
  <option value="" id="showLga"></option>
</select></div>

<div class="form-group"><label >M-Status</label><select class="form-control-sm" name="mstatus" id="mstatus">
<option value="Single">Single</option>
<option value="Married">Married</option>
<option value="Divorced">Divorced</option>
<option value="Widow">Widow</option>
<option value="Separated">Separated</option>
</select></div>




<div class="form-group "><label >Blood Group</label><select  class="form-control-sm" name="blodgroup" id="blodgroup"><option value="">-Choose-</option>
<option value="A+">A+</option>
<option value="A-">A-</option>
<option value="B+">B+</option>
<option value="B-">B-</option>
<option value="AB+">AB+</option>
<option value="AB-">AB-</option>
<option value="O+">O+</option>
<option value="O-">O-</option>
</select></div>

<div class="form-group "><label >Gender</label><select  class="form-control-sm" name="gender" id="gender">
  <option value="">-Choose-</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select></div>

<div class="form-group "><label >Department</label><select class="form-control-sm" name="dept" id="dept" > <option value="">-Choose-</option><?php  foreach(QueryDB("SELECT d_name FROM payems_dept")as $dpt){?>
<option value="<?php echo strtolower($dpt['d_name']); ?>"><?php echo $dpt['d_name']; ?></option> <?php } ?>
</select></div>

<div class="form-group">
<label >Email</label><input type="email" name="email" id="email" class="form-control-sm">
</div>

<div class="form-group">
<label >Phone</label><input type="text" name="gsmnumber" id="gsmnumber" class="form-control-sm" required>
</div>

<div class="form-group">
<label >File Number</label><input type="text" maxlength="10"  name="fileno" id="fileno" class="form-control-sm" required>
</div>



  </div>

  <div class="col-md-4" style="background:lightblue"> <h4 class="text-center">Next of Kin & Others</h4> <br><br><br>
<div class="form-group mt-2"><label >NOK Name</label><input type="text"  name="nok_name" id="nok_name" class="form-control-sm" required>
</div>

<div class="form-group mt-2"><label >NOK Address</label><input type="text"  name="nok_address" id="nok_address" class="form-control-sm" required>
</div>

<div class="form-group mt-2"><label >NOK Contact</label><input type="text"  name="nok_contact" id="nok_contact" class="form-control-sm" >
</div>

<div class="form-group mt-2"><label >NOK Relationship</label><select  class="form-control-sm" name="nok_relationship" id="nok_relationship"><option value="">-Choose-</option>
<option value="Wife" >Wife</option>
<option value="Husband" >Husband</option>
<option value="Son" >Son</option>
<option value="Daughter" >Daughter</option>
<option value="Brother" >Brother</option>
<option value="Sister" >Sister</option>
<option value="Uncle" >O+</option>
<option value="AUntie" >AUntie</option>
</select></div>

<div class="form-group "><label>Duty Station</label><select class="form-control-sm" name="dutystation" id="dutystation"><option value="">-Choose-</option>
  <?php  foreach(QueryDB("SELECT station_name FROM payems_duty_station")as $st){?>
<option value="<?php echo $st['station_name']; ?>"><?php echo $st['station_name']; ?></option> <?php } ?>
</select></div>

<div class="form-group "><label>Inspectorate</label><select class="form-control-sm" name="inspectorate" id="inspectorate">
<option value="Dekina">Dekina</option>
<option value="HQTRS">HQTRS</option>
<option value="Anyigba">Anyigba</option>
</select></div>

<div class="form-group">
<label >Staff Address</label><input type="text" maxlength="10"  name="address" id="address" class="form-control-sm" required>
</div>

<div class="form-group">
<label >No of Children</label><input type="number" name="childrenCount" id="childrenCount" class="form-control-sm" >
</div>



<center><div class="form-group col-md-5 "><input type="submit" name="EnrollStaff" class="btn btn-warning mt-2" value="Enroll Staff"></div></center>

  </div>

  </form>



</div><!--end of Row-->
</div><!--end of main-content-->
</div><!--end of container fluid-->
<script>
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