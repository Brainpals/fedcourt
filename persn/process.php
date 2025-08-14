<?php 


//process Update
if(isset($_POST['post_edit'])){

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) { 
	$targetDir = "../vendor/img/staff/";
    $fileTmp = $_FILES['image']['tmp_name'];
    $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); 
    $newFileName = str_replace('/','', $_POST['idPin']) . '.' . strtolower($fileExt); 
    $targetFile = $targetDir . $newFileName;
// include '../public/resize.php';
move_uploaded_file($fileTmp, $targetFile); $imgSet = $newFileName;
scaleImage($targetFile,$targetFile, 150, 140);
} else {  $imgSet = $_POST['prevImage'];}


$psn = $_POST['idPin'];
$dofa = v($_POST['dofa']);
$doc = v($_POST['doc']);
$dopa = v($_POST['dopa']);
$rofa = v($_POST['rofa']);
$prank = v($_POST['prank']);
$cadre = v($_POST['cadre']);
$accountNumber = v($_POST['accountNumber']);
$bank = v($_POST['bank']);
$qualification = v($_POST['qualification']);
$salarygroup = v($_POST['salarygroup']);
$conhess = v($_POST['conhess']);
$openfileno = v($_POST['openfileno']);
$secretfileno = v($_POST['secretfileno']);
$employmenttypes = v($_POST['employmenttypes']);
$title = v($_POST['title']);
$surname = v($_POST['surname']);
$firstname = v($_POST['firstname']);
$middlename = v($_POST['middlename']);
$dob = v($_POST['dob']);
$state = v($_POST['state']);
$lga = v($_POST['lga']);
$mstatus = v($_POST['mstatus']);
$blodgroup = v($_POST['blodgroup']);
$gender = v($_POST['gender']);
$dept = v($_POST['dept']);
$email = v($_POST['email']);
$gsmnumber = v($_POST['gsmnumber']);
$nok_name = v($_POST['nok_name']);
$nok_address = v($_POST['nok_address']);
$nok_contact = v($_POST['nok_contact']);
$nok_relationship = v($_POST['nok_relationship']);
$dutystation = v($_POST['dutystation']);
$inspectorate = v($_POST['inspectorate']);
$fileno = v($_POST['fileno']); $address = v($_POST['address']);
$childrenCount = v($_POST['childrenCount']);
$timestamp = date('Y-m-d H:i:s');

$salary =$linkr->getSalary($conhess,$salarygroup);



//payems Staff
QueryDB("UPDATE payems_staff SET 
    title = '$title',
    surname = '$surname',
    firstname = '$firstname',
    middlename = '$middlename',
    sex = '$gender',
    dob = '$dob',
    mstatus = '$mstatus',
    bgroup = '$blodgroup',
    lga = '$lga',
    state = '$state',
    gsmnumber = '$gsmnumber',
    email = '$email',
    address = '$address',
    passport = '$imgSet',
    openfileno = '$openfileno',
    secretfileno = '$secretfileno',
    net ='$salary',
    updated_at ='$timestamp',
    updated_by ='{$_SESSION['pay_pers']}',
	fileno = '$fileno' where psn='$psn' ");

//update Staff Details
$input = $conhess; 
list($gl, $step) = explode('/', $input);

QueryDB("UPDATE payems_details SET conhess='$conhess',gl='$gl',step='$step',cadre='$cadre',
rankfa='$rofa',prank='$prank',qualification='$qualification',department='$dept',dofa='$dofa',dopa='$dopa',
dolp=dolp, doc='$doc',employmenttypes='$employmenttypes',dutystation='$dutystation',salarygroup='$salarygroup',
inspectorate='$inspectorate',updated_at='$timestamp',updated_by ='{$_SESSION['pay_pers']}' where psn='$psn'
 ");


// //contact and Next of Kin
QueryDB("UPDATE contact_and_nok SET bank='$bank',accountnumber='$accountnumber',nok_name='$nok_name',
nok_address='$nok_address', nok_contact ='$nok_contact',nok_relationship ='$nok_relationship',mstatus='$mstatus',childrencount='$childrenCount',updated_at='$timestamp',updated_by ='{$_SESSION['pay_pers']}' where psn='$psn' ");

print "<script>swal({text:'Staff Record Updated',type:'success',title:'Success'},function(){ window.location = '';});</script>"; 


}


//Insert New Staff
if(isset($_POST['EnrollStaff'])){  $pSN = $linkr->getNextPSN();


$dofa = v($_POST['dofa']);
$doc = v($_POST['doc']);
$dopa = v($_POST['dopa']);
$rofa = v($_POST['rofa']);
$prank = v($_POST['prank']);
$cadre = v($_POST['cadre']);
$accountNumber = v($_POST['accountNumber']);
$bank = v($_POST['bank']);
$qualification = v($_POST['qualification']);
$salarygroup = v($_POST['salarygroup']);
$conhess = v($_POST['conhess']);
$openfileno = v($_POST['openfileno']);
$secretfileno = v($_POST['secretfileno']);
$employmenttypes = v($_POST['employmenttypes']);
$title = v($_POST['title']);
$surname = v($_POST['surname']);
$firstname = v($_POST['firstname']);
$middlename = v($_POST['middlename']);
$dob = v($_POST['dob']);
$state = v($_POST['state']);
$lga = v($_POST['lga']);
$mstatus = v($_POST['mstatus']);
$blodgroup = v($_POST['blodgroup']);
$gender = v($_POST['gender']);
$dept = v($_POST['dept']);
$email = v($_POST['email']);
$gsmnumber = v($_POST['gsmnumber']);
$nok_name = v($_POST['nok_name']);
$nok_address = v($_POST['nok_address']);
$nok_contact = v($_POST['nok_contact']);
$nok_relationship = v($_POST['nok_relationship']);
$dutystation = v($_POST['dutystation']);
$inspectorate = v($_POST['inspectorate']);
$fileno = v($_POST['fileno']); $address = v($_POST['address']);
$childrenCount = v($_POST['childrenCount']);
$timestamp = date('Y-m-d H:i:s');

$salary =$linkr->getSalary($conhess,$salarygroup);

$input = $conhess; 
list($gl, $step) = explode('/', $input);


if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) { 
    $targetDir = "../vendor/img/staff/";
    $fileTmp = $_FILES['image']['tmp_name'];
    $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); 
    $newFileName = str_replace('/','',$pSN). '.' . strtolower($fileExt); 
    $targetFile = $targetDir . $newFileName;
move_uploaded_file($fileTmp, $targetFile); $imgSet = $newFileName;
scaleImage($targetFile,$targetFile, 150, 140);
} else {  $imgSet = '';}


//Staff
QueryDB("INSERT INTO payems_staff (fileno, psn, title, surname, firstname, middlename, sex, dob, mstatus, bgroup, lga, state, gsmnumber, email, address, passport, openfileno, secretfileno, net, promotion, transfer, suspension, withdrawal, created_at, updated_at, created_by, updated_by, status) VALUES ('$fileno', '$pSN', '$title', '$surname', '$firstname', '$middlename', '$gender', '$dob', '$mstatus', '$blodgroup', '$lga', '$state', '$gsmnumber', '$email', '$address', '$imgSet', '$openfileno', '$secretfileno', '$salary', '', '', '', '', '$timestamp', '$timestamp', '{$_SESSION['pay_pers']}', '{$_SESSION['pay_pers']}', 'Active')");

//Step II
QueryDB("INSERT INTO payems_details (psn, conhess, gl, step, cadre, rankfa, prank, qualification, department, dofa, dopa, doc, employmenttypes, dutystation, salarygroup, inspectorate, created_at, updated_at, created_by, updated_by) VALUES ('$pSN', '$conhess', '$gl', '$step', '$cadre', '$rofa', '$prank', '$qualification', '$dept', '$dofa', '$dopa', '$doc', '$employmenttypes', '$dutystation', '$salarygroup', '$inspectorate', '$timestamp', '$timestamp', '{$_SESSION['pay_pers']}', '{$_SESSION['pay_pers']}')");

//Step III
QueryDB("INSERT INTO contact_and_nok (psn, bank, accountnumber, nok_name, nok_address, nok_contact, nok_relationship, mstatus, childrencount, created_at, updated_at, created_by, updated_by) VALUES ('$pSN', '$bank', '$accountNumber', '$nok_name', '$nok_address', '$nok_contact', '$nok_relationship', '$mstatus', '$childrenCount', '$timestamp', '$timestamp', '{$_SESSION['pay_pers']}', '{$_SESSION['pay_pers']}')");

print "<script>swal({text:'Enrollment was Successful!',type:'success',title:'Success'},function(){ window.location = '';});</script>"; 

}


//Add Title
if(isset($_POST['addTitle'])){ echo $content = $_POST['title'];
if($linkr->queryCount(tab(2),array('title'=>$content))>0){
    print "<script>swal({text:'Duplicate Attempt',type:'warning',title:'Success'},function(){ window.location = 'index';});</script>"; 
}else{QueryDB("INSERT INTO payems_title SET title='$content' "); }
print "<script>swal({text:'Insertion Successful',type:'success',title:'Success'},function(){ window.location = '';});</script>"; 
}

//Add Rank
if(isset($_POST['addRank'])){ echo $content = $_POST['rank'];
if($linkr->queryCount(tab(3),array('title'=>$content))>0){
    print "<script>swal({text:'Duplicate Attempt',type:'warning',title:'Success'},function(){ window.location = 'index';});</script>"; 
}else{QueryDB("INSERT INTO payems_rank SET title='$content' "); }
print "<script>swal({text:'Insertion Successful',type:'success',title:'Success'},function(){ window.location = '';});</script>"; 
}


//Add Duty
if(isset($_POST['addDept'])){ echo $content = $_POST['dept'];
if($linkr->queryCount(tab(5),array('d_name'=>$content))>0){
    print "<script>swal({text:'Duplicate Attempt',type:'warning',title:'Success'},function(){ window.location = 'index';});</script>"; 
}else{QueryDB("INSERT INTO payems_dept SET d_name='$content' "); }
print "<script>swal({text:'Insertion Successful',type:'success',title:'Success'},function(){ window.location = '';});</script>"; 
}


//Add Cadre
if(isset($_POST['addCadre'])){  $content = $_POST['cadre'];
if($linkr->queryCount(tab(6),array('cadre_name'=>$content))>0){
    print "<script>swal({text:'Duplicate Attempt',type:'warning',title:'Success'},function(){ window.location = 'index';});</script>"; 
}else{QueryDB("INSERT INTO payems_cadre SET cadre_name='$content' "); }
print "<script>swal({text:'Insertion Successful',type:'success',title:'Success'},function(){ window.location = '';});</script>"; 
}

//Add Cadre
if(isset($_POST['addQua'])){  $content = $_POST['qua'];
if($linkr->queryCount(tab(7),array('name'=>$content))>0){
    print "<script>swal({text:'Duplicate Attempt',type:'warning',title:'Success'},function(){ window.location = 'index';});</script>"; 
}else{QueryDB("INSERT INTO payems_quali SET name='$content' "); }
print "<script>swal({text:'Insertion Successful',type:'success',title:'Success'},function(){ window.location = '';});</script>"; 
}


if(isset($_POST['setView'])){ $link ='payems_view?label='.hash('sha256', rand()).'&view='.$_POST['view'];
header('location:'.$link);
}


?>


