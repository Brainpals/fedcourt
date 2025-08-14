<?php  include 'xyz.php';  ?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PAYEMS25 - Personnel Dashboard</title><?php  include('inc/top.html') ?></head>
<body><?php $tab=2;  include('inc/nav.php');
if($linkr->queryCount(tab(1),array('psn'=>$_GET['r']))==0){header('location:payems-staff');die();}
if(isset($_GET['r'])){ $vid = $_GET['r'];}else{ header('location:payems-staff');die();}
$selUser= $linkr->user($vid);

$dofa=$linkr->emp_info($vid)['dofa'];
$dopa=$linkr->emp_info($vid)['dopa'];
$dolp=$linkr->emp_info($vid)['dolp'];
$doc=$linkr->emp_info($vid)['doc'];

$rofa=strtolower($linkr->emp_info($vid)['rankfa']); 
$prank=strtolower($linkr->emp_info($vid)['prank']); 
$cadre=strtolower($linkr->emp_info($vid)['cadre']);
$bank=strtolower($linkr->bank_contact($vid)['bank']); 
$qualification=strtolower($linkr->emp_info($vid)['qualification']); 
$salarygroup=strtolower($linkr->emp_info($vid)['salarygroup']); 
$conhess=strtolower($linkr->emp_info($vid)['conhess']);
$employmenttypes=strtolower($linkr->emp_info($vid)['employmenttypes']);
$mstatus = strtolower($linkr->bank_contact($vid)['mstatus']);
$dutystation = strtolower($linkr->emp_info($vid)['dutystation']);
$inspectorate = strtolower($linkr->emp_info($vid)['inspectorate']);
$department = strtolower($linkr->emp_info($vid)['department']);
$accountnumber=$linkr->bank_contact($vid)['accountnumber'];

$nok_name=$linkr->bank_contact($vid)['nok_name'];
$nok_address=$linkr->bank_contact($vid)['nok_address'];
$nok_contact=$linkr->bank_contact($vid)['nok_contact'];
$nok_relationship=$linkr->bank_contact($vid)['nok_relationship'];
$childrencount=$linkr->bank_contact($vid)['childrencount'];

 $imgSet =!empty($selUser['passport']) ? '../vendor/img/staff/'.$selUser['passport'] : '../vendor/img/temp_image.png';
     


?>

<div class="container mt-2"><div id="main-content"><div class="row g-3 mb-2 mt-2" 
  style="box-shadow: 5px 4px 10px 10px gray;">





<form action="" method="POST" id="uploadForm" enctype="multipart/form-data"> 
  <?php   include 'process.php';  ?>
<div class="row"><div class="col-md-9"></div>
<input type="hidden" name="idPin" value="<?php echo $vid; ?>">
<input type="hidden" name="prevImage" value="<?php echo $selUser['passport']; ?>">
<div class="col-md-3">
  <center><span class="text-danger"><strong><?php  echo $selUser['surname'].' '.$selUser['firstname'].' '.$selUser['middlename']; ?></strong></span><img id="preview" src="<?php echo $imgSet; ?>" class="img-thumbnail" alt="Photo" style="height:100px;width:100px;border-radius:50px;"><input type="file" name="image" id="imageInput" accept="image/*"></center>
</div>

<div class="col-md-4" style="background: lightgrey;">
  <p class="text-success text-center"><strong>EMPLOYMENT DETAILS</strong></p>
  <div class="form-group"><label> Date of 1st Appt.</label><input type="date" name="dofa" id="dofa" class="form-control-sm" value="<?php echo $dofa; ?>" ></div>
  <div class="form-group"><label> Date of Conf.</label><input type="date" name="doc" id="doc" class="form-control-sm" value="<?php echo $doc; ?>" ></div>
  <div class="form-group"><label> Date of Pres. Appt.</label><input type="date" name="dopa" id="dopa" value="<?php echo $dopa; ?>" class="form-control-sm" required></div>
  
  <div class="form-group"><label> Rank of 1st Appt.</label><select class="form-control-sm" name="rofa"  id="rofa" required><?php  
  foreach(QueryDB("SELECT title FROM payems_rank")as $rof){?>
<option value="<?php echo strtolower($rof['title']); ?>" <?php if(strtolower($rofa)==strtolower($rof['title'])){ echo 'selected';} ?>  ><?php echo $rof['title']; ?></option> <?php } ?></select></div>

<div class="form-group"><label> Present Rank.</label><select class="form-control-sm" name="prank" id="prank" required><?php  
  foreach(QueryDB("SELECT title FROM payems_rank")as $prnk){?>
<option value="<?php echo strtolower($prnk['title']); ?>"
<?php if(strtolower($prank)==strtolower($prnk['title'])){ echo 'selected';} ?>
><?php echo $prnk['title']; ?>
</option> <?php } ?></select></div>

<div class="form-group"><label> Cadre.</label><select class="form-control-sm" name="cadre" id="cadre" required><?php  
  foreach(QueryDB("SELECT cadre_name FROM payems_cadre")as $rofa){?>
<option value="<?php echo strtolower($rofa['cadre_name']); ?>"
<?php if(strtolower($cadre)==strtolower($rofa['cadre_name'])){ echo 'selected';} ?>>
  <?php echo $rofa['cadre_name']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label> Account Number</label><input type="text" name="accountNumber" id="accountNumber" 
value="<?php echo $accountnumber;  ?>"class="form-control-sm only-numbers">
</div>


<div class="form-group"><label> Pay Point (Bank)</label><select class="form-control-sm" name="bank" id="bank">
<?php  
  foreach(QueryDB("SELECT title FROM payems_bank")as $bankName){?>
<option value="<?php echo strtolower($bankName['title']); ?>"
<?php if($bank==strtolower($bankName['title'])){ echo 'selected';} ?>><?php echo $bankName['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label> Qualification</label><select class="form-control-sm" name="qualification" id="qualification"><?php  
  foreach(QueryDB("SELECT name FROM payems_quali")as $quali){?>
<option value="<?php echo strtolower($quali['name']); ?>"
<?php if($qualification==strtolower($quali['name'])){ echo 'selected';} ?>
><?php echo $quali['name']; ?></option> <?php } ?>
</select></div>



<div class="form-group"><label>Salary Group</label><select class="form-control-sm" name="salarygroup" id="salarygroup"><?php  
  foreach(QueryDB("SELECT title,chart_tbl FROM payems_salgroup")as $sgroup){?>
<option value="<?php echo strtolower($sgroup['title']); ?>"
<?php if($salarygroup==strtolower($sgroup['title'])){ echo 'selected';} ?>
><?php echo $sgroup['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label>Grade/Step (<span class="text-danger"><?php echo $conhess;  ?></span>)</label><select class="form-control-sm" name="conhess" id="conhess">
    <option value="<?php echo $conhess;  ?>"><?php echo $conhess;  ?></option>
<option value="" class="show_conhess"></option>
</select></div>

<div class="form-group"><label> Open File No.</label><input type="text" name="openfileno" value="<?php echo $selUser['openfileno']  ?>" id="openfileno" class="form-control-sm only-numbers">
</div>

<div class="form-group"><label> Secret File No.</label><input type="text" value="<?php echo $selUser['secretfileno']  ?>" name="secretfileno" id="secretfileno" class="form-control-sm only-numbers">
</div>

<div class="form-group"><label>Employment Type</label><select class="form-control-sm" name="employmenttypes" id="employmenttypes">
  <option value="Temporary" <?php if($employmenttypes=='Temporary'){ echo 'selected';} ?> >Temporary</option>
  <option value="Pensionable" <?php if($employmenttypes=='Pensionable'){ echo 'selected';} ?> >Pensionable</option>
  <option value="Contract" <?php if($employmenttypes=='Contract'){ echo 'selected';} ?> >Contract</option>
</select></div>




</div>

<!--Personal Records-->
<div class="col-md-4 bg-info">


<h5 class="text-center text-dark">Personal Record</h5>
<div class="form-group "><label >Title</label><select class="form-control-sm" name="title" id="title" > <?php  foreach(QueryDB("SELECT title FROM payems_title")as $sgroup){?>
<option value="<?php echo strtolower($sgroup['title']); ?>" <?php if($selUser['title']==strtolower($sgroup['title'])){ echo 'selected';} ?>    ><?php echo $sgroup['title']; ?></option> <?php } ?>
</select></div>

<div class="form-group"><label >Surname</label><input type="text" name="surname" value="<?php echo $selUser['surname']; ?>" id="surname" class="form-control-sm" required>
</div>
<div class="form-group"><label >firstname</label><input type="text" name="firstname" value="<?php echo $selUser['firstname']; ?>" id="firstname" class="form-control-sm" required>
</div>
<div class="form-group"><label >Middlename</label><input type="text" name="middlename" id="middlename" class="form-control-sm" value="<?php echo $selUser['middlename']; ?>" required>
</div>

<div class="form-group">
<label >Date of Birth</label><input type="date" value="<?php echo $selUser['dob']; ?>" name="dob" id="dob" class="form-control-sm" required>
</div>

<div class="form-group "><label >State</label><select class="form-control-sm" name="state" id="state"><?php  foreach(QueryDB("SELECT name FROM state")as $st){?>
<option value="<?php echo strtolower($st['name']); ?>" <?php if(strtolower($selUser['state'])==strtolower($st['name'])){ echo 'selected';} ?> ><?php echo $st['name']; ?></option> <?php } ?></select></div>


<div class="form-group "> <label >LGA</label><select  class="form-control-sm "  name="lga" id="lga">
  <option value="<?php  echo $selUser['lga'] ?>"><?php  echo $selUser['lga'] ?></option>
  <option value="" id="showLga"></option>
</select></div>

<div class="form-group"><label >M-Status</label><select class="form-control-sm" name="mstatus" id="mstatus">
<option value="Single" <?php  if($selUser['mstatus']=='Single'){ echo 'selected';}  ?>>Single</option>
<option value="Married" <?php  if($selUser['mstatus']=='Married'){ echo 'selected';}  ?>>Married</option>
<option value="Divorced" <?php  if($selUser['mstatus']=='Divorced'){ echo 'selected';}  ?>>Divorced</option>
<option value="Widow" <?php  if($selUser['mstatus']=='Widow'){ echo 'selected';}  ?>>Widow</option>
<option value="Separated" <?php  if($selUser['mstatus']=='Separated'){ echo 'selected';}  ?>>Separated</option>
</select></div>




<div class="form-group "><label >Blood Group</label><select  class="form-control-sm" name="blodgroup" id="blodgroup">
<option value="A+" <?php if($selUser['bgroup']=='A+'){ echo 'selected';} ?>>A+</option>
<option value="A-" <?php if($selUser['bgroup']=='A-'){ echo 'selected';} ?>>A-</option>
<option value="B+" <?php if($selUser['bgroup']=='B+'){ echo 'selected';} ?>>B+</option>
<option value="B-" <?php if($selUser['bgroup']=='B-'){ echo 'selected';} ?>>B-</option>
<option value="AB+" <?php if($selUser['bgroup']=='AB+'){ echo 'selected';} ?>>AB+</option>
<option value="AB-" <?php if($selUser['bgroup']=='AB-'){ echo 'selected';} ?>>AB-</option>
<option value="O+" <?php if($selUser['bgroup']=='O+'){ echo 'selected';} ?>>O+</option>
<option value="O-" <?php if($selUser['bgroup']=='O-'){ echo 'selected';} ?>>O-</option>
</select></div>

<div class="form-group "><label >Gender</label><select  class="form-control-sm" name="gender" id="gender">
<option value="Male" <?php if($selUser['sex']=='Male'){ echo 'selected';} ?>>Male</option>
<option value="Female" <?php if($selUser['sex']=='Female'){ echo 'selected';} ?>>Female</option>
</select></div>

<div class="form-group "><label >Department</label><select class="form-control-sm" name="dept" id="dept" > <?php  foreach(QueryDB("SELECT d_name FROM payems_dept")as $dpt){?>
<option value="<?php echo strtolower($dpt['d_name']); ?>" <?php if($department==strtolower($dpt['d_name'])){ echo 'selected';} ?>    ><?php echo $dpt['d_name']; ?></option> <?php } ?>
</select></div>

<div class="form-group">
<label >Email</label><input type="email" value="<?php echo $selUser['email']; ?>" name="email" id="email" class="form-control-sm">
</div>

<div class="form-group">
<label >Phone</label><input type="text" value="<?php echo $selUser['gsmnumber']; ?>" name="gsmnumber" id="gsmnumber" class="form-control-sm" required>
</div>

<div class="form-group">
<label >File Number</label><input type="text" maxlength="10" value="<?php echo $selUser['fileno']; ?>" name="fileno" id="fileno" class="form-control-sm" required>
</div>



  </div>

  <div class="col-md-4" style="background:lightblue"> <h4 class="text-center">Next of Kin & Others</h4> <br><br><br>
<div class="form-group mt-2"><label >NOK Name</label><input type="text" value="<?php echo $nok_name; ?>" name="nok_name" id="nok_name" class="form-control-sm" required>
</div>

<div class="form-group mt-2"><label >NOK Address</label><input type="text" value="<?php echo $nok_address; ?>" name="nok_address" id="nok_address" class="form-control-sm" required>
</div>

<div class="form-group mt-2"><label >NOK Contact</label><input type="text" value="<?php echo $nok_contact; ?>" name="nok_contact" id="nok_contact" class="form-control-sm" >
</div>

<div class="form-group mt-2"><label >NOK Relationship</label><select  class="form-control-sm" name="nok_relationship" id="nok_relationship">
<option value="Wife" <?php if($selUser['bgroup']=='Wife'){ echo 'selected';} ?>>Wife</option>
<option value="Husband" <?php if($selUser['bgroup']=='Husband'){ echo 'selected';} ?>>Husband</option>
<option value="Son" <?php if($selUser['bgroup']=='Son'){ echo 'selected';} ?>>Son</option>
<option value="Daughter" <?php if($selUser['bgroup']=='Daughter'){ echo 'selected';} ?>>Daughter</option>
<option value="Brother" <?php if($selUser['bgroup']=='Brother'){ echo 'selected';} ?>>Brother</option>
<option value="Sister" <?php if($selUser['bgroup']=='Sister'){ echo 'selected';} ?>>Sister</option>
<option value="Uncle" <?php if($selUser['bgroup']=='Uncle'){ echo 'selected';} ?>>O+</option>
<option value="AUntie" <?php if($selUser['bgroup']=='AUntie'){ echo 'selected';} ?>>AUntie</option>
</select></div>

<div class="form-group "><label>Duty Station</label><select class="form-control-sm" name="dutystation" id="dutystation">
  <?php  foreach(QueryDB("SELECT station_name FROM payems_duty_station")as $st){?>
<option value="<?php echo $st['station_name']; ?>"  <?php if($dutystation==$st['station_name']){ echo 'selected';}  ?>><?php echo $st['station_name']; ?></option> <?php } ?>
</select></div>

<div class="form-group "><label>Inspectorate</label><select class="form-control-sm" name="inspectorate" id="inspectorate">
<option value="Dekina" <?php if($inspectorate=='Dekina'){ echo 'selected';}  ?>>Dekina</option>
<option value="HQTRS" <?php if($inspectorate=='HQTRS'){ echo 'selected';}  ?>>HQTRS</option>
<option value="Anyigba" <?php if($inspectorate=='Anyigba'){ echo 'selected';}  ?>>Anyigba</option>
</select></div>

<div class="form-group">
<label >Staff Address</label><input type="text" maxlength="10" value="<?php echo $selUser['address']; ?>" name="address" id="address" class="form-control-sm" required>
</div>

<div class="form-group">
<label >No of Children</label><input type="number"  value="<?php echo $childrencount; ?>" name="childrenCount" id="childrenCount" class="form-control-sm" >
</div>



<center><div class="form-group col-md-5 "><input type="submit" name="post_edit" class="btn btn-secondary mt-2" value="Edit"></div></center>

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