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


//set Working Details
if(isset($_POST['setWorkingItems'])){ 
    if($linkr->queryCount(tab(8),array('year'=>$_POST['sel_year']))==0){
        $linkr->insert(tab(8),array('year'=>$_POST['sel_year'],'month'=>$_POST['sel_month'],'status'=>1));
      }else{
        $linkr->update(tab(8),array('month'=>$_POST['sel_month'],'status'=>1),array('year'=>$_POST['sel_year']));
      }
print "<script>swal({text:'New Working Month/Year Set',type:'success',title:'Success'},function(){ window.location = '';});</script>"; 
    
}


//Process payroll
if(isset($_POST['createPay'])){ $sel_month = $_POST['sel_month']; $sel_year = $_POST['sel_year'];
    if($linkr->queryCount(tab(8),array('year'=>$sel_year))==0){
      $linkr->insert(tab(8),array('year'=>$sel_year,'status'=>1));
    }
 echo  '<div class="alert alert-info alert-dismissible col-md-12 text-center" role="alert">
  <strong class="text-italic" style="color:black;"><i class="fa fa-spinner fa-spin"></i> Processing. Please wait.. </div>';

$week_no = date('W');
$created_at = date('Y-m-d');
$user = $_SESSION['userType1']; 

$totalInsertions =0;
function getItems($type) {$items = []; 
    $res = QueryDB("SELECT item_name FROM payems_deductions WHERE item_type = '$type'");
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $items[] = $row['item_name'];
    }
    return implode(',', $items);
}
function getEmptyValuesString($count) { return implode(',', array_fill(0, $count, ''));}

// Prepare values
$deductions = getItems('Deductions');
$extras = getItems('Extras');
$deduct_values = getEmptyValuesString(substr_count($deductions, ',') + 1);
$extras_values = getEmptyValuesString(substr_count($extras, ',') + 1);

// Perform INSERT or UPDATE
$sql = "
INSERT INTO payems_pay (
    psn, rank, salary_group, pay_timestamp, week_no, month, year, created_at,
    net_pay, paid, deductions, deduct_values, extras, extras_values, account_numb, created_by,status,bank_paid
)
SELECT 
    s.psn,
    d.conhess AS rank,
    g.chart_tbl AS salary_group,
    UNIX_TIMESTAMP(),
    '$week_no', '$sel_month', '$sel_year', '$created_at',
    s.net,
    s.net,
    '$deductions', '$deduct_values',
    '$extras', '$extras_values',
    c.accountnumber,
    '$user',
    1,c.bank
FROM payems_staff s
JOIN payems_details d ON s.psn = d.psn
JOIN payems_salgroup g ON d.salarygroup = g.title
LEFT JOIN contact_and_nok c ON s.psn = c.psn
WHERE s.status = 'Active'
ON DUPLICATE KEY UPDATE
    rank = VALUES(rank),
    bank_paid =VALUES(bank_paid),
    salary_group = VALUES(salary_group),
    pay_timestamp = VALUES(pay_timestamp),
    created_at = VALUES(created_at),
    net_pay = VALUES(net_pay),
    paid = VALUES(paid),
    deductions = VALUES(deductions),
    deduct_values = VALUES(deduct_values),
    extras = VALUES(extras),
    extras_values = VALUES(extras_values),
    account_numb = VALUES(account_numb),
    updated_at = '$created_at',
    updated_by = '$user';
";

if ($stmt = QueryDB($sql)) {
    $affected = $stmt->rowCount();
    print "<script>swal({text:'$affected Payroll Generated/Updated!',type:'success',title:'Success'},function(){ 
    window.location = '';});</script>"; 
} 

}

//View payroll
if(isset($_POST['viewPay'])){ $_SESSION['sel_month'] = $_POST['sel_month']; $_SESSION['sel_year'] = $_POST['sel_year'];
header('location:payems_payroll?'.hash('sha512',rand()));
}

if(isset($_POST['ProcessDeductions'])){
    $deductions = implode(',',$_POST['deduct']); $where = $_POST['where'];
    $extras = implode(',',$_POST['educt']); $cut = $_POST['payCalc'];
    $expNet = $_POST['myNet']*(1-$cut);
QueryDB("UPDATE payems_pay SET deduct_values='$deductions',extras_values='$extras',percent='$cut',paid='$expNet' where psn='$where' ");

}

//Single Reprocess
if(isset($_POST['redoPayroll'])){ $selUser = $_POST['where'];
    $sel_month = $_SESSION['work_month']; 
    $sel_year = $_SESSION['work_yr'];

    //If more than 30 days
    $timestamp = $_POST['genTime'];
$isMoreThan30Days = (time() < $timestamp && ($timestamp - time()) > 2592000);
if ($isMoreThan30Days) {
    print "<script>
    swal({
      text: 'Previous Exceeds 30 Days',
      type: 'warning',
      title: 'warning'
    }, function() { 
      window.location = '';
    });
  </script>"; 
} else {
    $week_no = date('W');
    $created_at = date('Y-m-d');
    $user = $_SESSION['userType1']; 
    $target_psn = $selUser;
    
    function getItems($type) {
      $items = []; 
      $res = QueryDB("SELECT item_name FROM payems_deductions WHERE item_type = '$type'");
      while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $items[] = $row['item_name'];
      }
      return implode(',', $items);
    }
    
    function getEmptyValuesString($count) {
      return implode(',', array_fill(0, $count, ''));
    }
    
    $deductions = getItems('Deductions');
    $extras = getItems('Extras');
    $deduct_values = getEmptyValuesString(substr_count($deductions, ',') + 1);
    $extras_values = getEmptyValuesString(substr_count($extras, ',') + 1);
    
    $sql = "
    INSERT INTO payems_pay (
      psn, rank, salary_group, pay_timestamp, week_no, month, year, created_at,
      net_pay, paid, deductions, deduct_values, extras, extras_values, account_numb, created_by, status,bank_paid
    )
    SELECT 
      s.psn,
      d.conhess AS rank,
      g.chart_tbl AS salary_group,
      UNIX_TIMESTAMP(),
      '$week_no', '$sel_month', '$sel_year', '$created_at',
      s.net,
      s.net,
      '$deductions', '$deduct_values',
      '$extras', '$extras_values',
      c.accountnumber,
      '$user',
      1,c.bank
    FROM payems_staff s
    JOIN payems_details d ON s.psn = d.psn
    JOIN payems_salgroup g ON d.salarygroup = g.title
    LEFT JOIN contact_and_nok c ON s.psn = c.psn
    WHERE s.status = 'Active' AND s.psn = '$target_psn'
    ON DUPLICATE KEY UPDATE
      rank = VALUES(rank),
      bank_paid =VALUES(bank_paid),
      salary_group = VALUES(salary_group),
      pay_timestamp = VALUES(pay_timestamp),
      created_at = VALUES(created_at),
      net_pay = VALUES(net_pay),
      paid = VALUES(paid),
      deductions = VALUES(deductions),
      deduct_values = VALUES(deduct_values),
      extras = VALUES(extras),
      extras_values = VALUES(extras_values),
      account_numb = VALUES(account_numb),
      updated_at = '$created_at',
      updated_by = '$user';
    ";
    
    if ($stmt = QueryDB($sql)) {
      $affected = $stmt->rowCount();
      print "<script>
        swal({
          text: 'Generated Payroll Modifeid!',
          type: 'success',
          title: 'Success'
        }, function() { 
          window.location = '';
        });
      </script>"; 
    }

} //end of if else
    

}




require '../vendor/autoload.php'; // Make sure path is correct





//Process the Deduction
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submit'])) {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {

        $file  = $_FILES['excel_file']['tmp_name'];
        $index = (int) $_POST['view'];

        // Load spreadsheet and skip header
        $spreadsheet = IOFactory::load($file);
        $sheet       = $spreadsheet->getActiveSheet();
        $rows        = array_slice($sheet->toArray(), 1);

        $_SESSION['get_type'] = $linkr->getDeductions('Deductions')[$index];
        $month = $_SESSION['work_month'];
        $year  = $_SESSION['work_yr'];

        // Step 1: Fetch matching accounts from DB
        $stmt = $linkr->prepareQuery("SELECT account_numb, deduct_values FROM payems_pay WHERE month = ? AND year = ?");
        $stmt->execute([$month, $year]);

        $accountCache = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $accountCache[$row['account_numb']] = $row['deduct_values'];
        }

        $updates   = [];
        $unmatched = [];

        // Step 2: Loop Excel and prepare updates
        foreach ($rows as $row) {
            $excelId     = trim($row[0]);
            $excelName   = trim($row[1]);
            $accountNum  = trim($row[2]);
            $deductValue = trim($row[3]);

            if (isset($accountCache[$accountNum])) {
                $existing = explode(',', $accountCache[$accountNum]);
                $existing[$index] = $deductValue;
                $newValue = implode(',', $existing);

                $updates[] = [
                    'account' => $accountNum,
                    'deduct'  => $newValue
                ];
            } else {
                $unmatched[] = [
                    'id'      => $excelId,
                    'name'    => $excelName,
                    'account' => $accountNum,
                    'deduct'  => $deductValue
                ];
            }
        }

        // Step 3: Bulk update
        if (!empty($updates)) {
            $sql = "UPDATE payems_pay SET deduct_values = CASE account_numb ";
            $accounts = [];
            foreach ($updates as $row) {
                $sql .= "WHEN '{$row['account']}' THEN '{$row['deduct']}' ";
                $accounts[] = "'{$row['account']}'";
            }
            $sql .= "END WHERE account_numb IN (" . implode(',', $accounts) . ") AND month = '$month' AND year = '$year'";
            $linkr->runQuery($sql);  // Direct query
        }

        // Step 4: Show unmatched
        if (!empty($unmatched)) {
            echo '<h4>Account Number Not Found in Database</h4>
                  <table border="1" cellpadding="5">
                    <tr><th>ID</th><th>Name</th><th>Account Number</th><th>Deduction</th></tr>';
            foreach ($unmatched as $r) {
                echo "<tr>
                        <td>{$r['id']}</td>
                        <td>{$r['name']}</td>
                        <td>{$r['account']}</td>
                        <td>{$r['deduct']}</td>
                      </tr>";
            }
            echo '</table>';

            $_SESSION['unmatched'] = $unmatched;

            echo '<form method="POST" action="">
                    <button type="submit" name="downloadUnmatched" class="btn btn-success mt-3">Download Excel</button>
                  </form>';
        } else {
            echo '<p class="alert alert-success"></p>All records matched and updated successfully!</p>';
        }
    }
}


//Bulk Extras  
if (isset($_POST['processExtras'])) {
  if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {

      $file  = $_FILES['excel_file']['tmp_name'];
      $index = (int) $_POST['view'];

      // Load spreadsheet and skip header
      $spreadsheet = IOFactory::load($file);
      $sheet       = $spreadsheet->getActiveSheet();
      $rows        = array_slice($sheet->toArray(), 1);

      $_SESSION['get_type'] = $linkr->getDeductions('extras')[$index];
      $month = $_SESSION['work_month'];
      $year  = $_SESSION['work_yr'];

      // Step 1: Fetch matching accounts from DB
      $stmt = $linkr->prepareQuery("SELECT account_numb, extras_values FROM payems_pay WHERE month = ? AND year = ?");
      $stmt->execute([$month, $year]);

      $accountCache = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $accountCache[$row['account_numb']] = $row['extras_values'];
      }

      $updates   = [];
      $unmatched = [];

      // Step 2: Loop Excel and prepare updates
      foreach ($rows as $row) {
          $excelId     = trim($row[0]);
          $excelName   = trim($row[1]);
          $accountNum  = trim($row[2]);
          $deductValue = trim($row[3]);

          if (isset($accountCache[$accountNum])) {
              $existing = explode(',', $accountCache[$accountNum]);
              $existing[$index] = $deductValue;
              $newValue = implode(',', $existing);

              $updates[] = [
                  'account' => $accountNum,
                  'deduct'  => $newValue
              ];
          } else {
              $unmatched[] = [
                  'id'      => $excelId,
                  'name'    => $excelName,
                  'account' => $accountNum,
                  'deduct'  => $deductValue
              ];
          }
      }

      // Step 3: Bulk update
      if (!empty($updates)) {
          $sql = "UPDATE payems_pay SET extras_values = CASE account_numb ";
          $accounts = [];
          foreach ($updates as $row) {
              $sql .= "WHEN '{$row['account']}' THEN '{$row['deduct']}' ";
              $accounts[] = "'{$row['account']}'";
          }
          $sql .= "END WHERE account_numb IN (" . implode(',', $accounts) . ") AND month = '$month' AND year = '$year'";
          $linkr->runQuery($sql);  // Direct query
      }

      // Step 4: Show unmatched
      if (!empty($unmatched)) {
          echo '<h4>Account Number Not Found in Database</h4>
                <table border="1" cellpadding="5">
                  <tr><th>ID</th><th>Name</th><th>Account Number</th><th>Extras</th></tr>';
          foreach ($unmatched as $r) {
              echo "<tr>
                      <td>{$r['id']}</td>
                      <td>{$r['name']}</td>
                      <td>{$r['account']}</td>
                      <td>{$r['deduct']}</td>
                    </tr>";
          }
          echo '</table>';

          $_SESSION['unmatched'] = $unmatched;

          echo '<form method="POST" action="">
                  <button type="submit" name="downloadUnmatchedExtras" class="btn btn-success mt-3">Download Excel</button>
                </form>';
      } else {
          echo '<p class="alert alert-success"></p>All records matched and updated successfully!</p>';
      }
  }
}









//Download unmatched Records
if (isset($_POST['downloadUnmatched']) && !empty($_SESSION['unmatched'])) {
    exportNotFoundToExcel($_SESSION['unmatched'],$_SESSION['work_month'],$_SESSION['work_yr'],$_SESSION['get_type'],'Deductions');
}


//Process Unmatched Extras 
if (isset($_POST['downloadUnmatchedExtras']) && !empty($_SESSION['unmatched'])) {
  exportNotFoundToExcel($_SESSION['unmatched'],$_SESSION['work_month'],$_SESSION['work_yr'],$_SESSION['get_type'],'Extras');
}


//process Bank Payslips
if(isset($_POST['showBanks'])){
    $_SESSION['bankSelected'] = $_POST['qua'];
    header('location:payems_print1?paySlips=Bulk'); die();
}





//use PhpOffice\PhpSpreadsheet\IOFactory;

// if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
//     $file = $_FILES['excel_file']['tmp_name'];
//     $index = $_POST['view'];

//     $spreadsheet = IOFactory::load($file);
//     $sheet = $spreadsheet->getActiveSheet();
//     $data = $sheet->toArray();

//     //skip the first Rpw
//     foreach (array_slice($data, 1) as $row) {
//         $accountNumber = htmlspecialchars($row[1]); $deduct = htmlspecialchars($row[2]);
//         $start = QueryDB("SELECT deduct_values FROM payems_pay where account_numb='$accountNumber'  ");
//         $makeArray = $start->fetch(PDO::FETCH_ASSOC);
//         $deductArray = explode(',', $makeArray['deduct_values']);
//         $deductArray[$index] = htmlspecialchars($row[2]);
//         $new_deduct_values = implode(',', $deductArray);
//     QueryDB("UPDATE payems_pay SET deduct_values ='$new_deduct_values' where account_numb ='$accountNumber' LIMIT 1  ");
//         }
// }


// if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
//     $file = $_FILES['excel_file']['tmp_name'];
//     $index = $_POST['view'];

//     $spreadsheet = IOFactory::load($file);
//     $sheet = $spreadsheet->getActiveSheet();
//     $data = array_slice($sheet->toArray(), 1); 
//     $accRows = QueryDB("SELECT account_numb, deduct_values FROM payems_pay")->fetchAll(PDO::FETCH_KEY_PAIR);
//     $pdo = $GLOBALS['pdo']; // or however you get your PDO object
//     $update =$this->conn->prepare("UPDATE payems_pay SET deduct_values = :deduct WHERE account_numb = :acc LIMIT 1");

//     // 3) Loop Excel once
//     foreach ($data as $row) {
//         $accountNumber = trim($row[1]);
//         $deduct        = trim($row[2]);

//         if (isset($accRows[$accountNumber])) {
//             $parts = explode(',', $accRows[$accountNumber]);
//             $parts[$index] = $deduct;
//             $newValue = implode(',', $parts);

//             // Update cached array
//             $accRows[$accountNumber] = $newValue;

//             // Execute prepared update
//             $update->execute([
//                 ':deduct' => $newValue,
//                 ':acc' => $accountNumber
//             ]);
//         }
//     }

//     echo "Done bulk update!";
// }


?>


