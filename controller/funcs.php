<?php 
try { $db = new PDO('mysql:host=localhost;dbname=payems25;charset=utf8','root','');}
catch(Expression $e){ echo $e->getMessage(); }
/******************************ADMIN FUNCTIONS****************************/
function QueryDB($query){
  global $db;
  return $db->query($query);
}

function exportNotFoundToExcel($unmatchedRows,$month,$year,$type,$extrasOrDeduction)
{
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->fromArray(['ID','Name','Account Number','Deduction'], null, 'A1');
    $sheet->fromArray($unmatchedRows, null, 'A2');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

    // VERY IMPORTANT: clear previous output
    if (ob_get_length()) {
        ob_end_clean();
    }
    $filename =date('F', mktime(0, 0, 0, $month, 1)).' '.$year.' unmatched '.$type.' '.$extrasOrDeduction.'.xlsx';
    // Send proper headers **before** any output
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    // Output file
    $writer->save('php://output');
    exit;
}

//




function show(...$args) {
return implode(' ', $args);
}

function view_rofa(){
  foreach(QueryDB("SELECT title FROM payems_rank")as $rofa){
      echo '<option value="'.$rofa['title'].'">"'.$rofa['title'].'"</option>';
  }
  }

  function tab($tab){
    switch ($tab) {
      case '1': return 'payems_staff';break;
       case '2': return 'payems_title';break;
       case '3': return 'payems_rank';break;
       case '4': return 'payems_duty_station';break;
       case '5': return 'payems_dept';break;
       case '6': return 'payems_cadre';break; 
       case '7': return 'payems_quali';break; 
       case '8': return 'payems_yrset';break; 
      default:
        # code...
        break;
    }
   
  }

  function toNum($value) {
    if($value=='' || $value==0 || !is_numeric($value)){
      return 0;
    }else{ return $value;}
}













function bChart(){
$sub=array();
for($i=469;$i<490;$i++){
  $num =  QueryDB("SELECT COUNT(*) FROM kg_stds WHERE std_lga='$i' and std_yr='2024' ")->fetchColumn();
    $sub[]=$num;
  }
  $set =  implode(',',$sub);
  return $set;
}

function pChart(){ $cls = array('PRY6','JSS1','JSS3','SS1');
$sub=array();
for($i=0;$i<count($cls);$i++){
  $num =  QueryDB("SELECT COUNT(*) FROM kg_stds WHERE std_prs_class='".$cls[$i]."' and std_yr='2024' ")->fetchColumn();
    $sub[]=$num;
  }
  
  return $sub;
}


function QueryDP($query, $params = []) {
    global $db;
    $stmt = $db->prepare($query);  // Prepare the query
    $stmt->execute($params);  // Execute with parameters
    return $stmt;
}
/********Update***************/
function _greetin(){
date_default_timezone_set('Africa/lagos');
$Hour = date('G');
if ( $Hour >= 1 && $Hour <= 11 ) {$salute = 'Good Morning   ';
} else if ( $Hour >= 12 && $Hour <= 16 ) {$salute = 'Good Afterrnoon  ';
} else if ( $Hour >= 17 || $Hour <= 22 ) {$salute = 'Good Evening   ';
}else if ( $Hour >= 23 || $Hour <= 24 ) {$salute = 'Keeping Late Night?   ';
}return $salute;}

function getSchName($sc){
  $init = QueryDB("SELECT * FROM kg_schs where sc_code ='$sc' ");
  $row = $init->fetch(PDO::FETCH_ASSOC); 
  return $row['sc_name'];
}

function getCountry($sc){
  $init = QueryDB("SELECT * FROM countries where id ='$sc' ");
  $row = $init->fetch(PDO::FETCH_ASSOC); 
  return $row['name'];
}

function getLGA($sc){
  $init = QueryDB("SELECT * FROM local_governments where id ='$sc' ");
  $row = $init->fetch(PDO::FETCH_ASSOC); 
  return $row['name'];
}

function getBank($sc){
  $init = QueryDB("SELECT * FROM banks where id ='$sc' ");
  $row = $init->fetch(PDO::FETCH_ASSOC); 
  return $row['bankName'];
}

function getWards($sc){
if($sc==0){
  $def = 'Unspecified';
}else{
  $init = QueryDB("SELECT * FROM wards where id ='$sc' ");
  $row = $init->fetch(PDO::FETCH_ASSOC); 
  $def = $row['ward'];
}
  return $def;
}

function getState($country, $sc){
  if($country==160){
$init = QueryDB("SELECT * FROM state where id ='$sc' ");
$row = $init->fetch(PDO::FETCH_ASSOC); 
  }else{
    $init = QueryDB("SELECT * FROM states where id ='$sc' ");
$row = $init->fetch(PDO::FETCH_ASSOC); 
  }
  
  return $row['name'];
}



function getQtyClass($user,$cls){
 return QueryDB("SELECT COUNT(*) FROM kg_stds where std_reg ='$user' and std_prs_class='$cls' ")->fetchColumn();
}

function getAggrByClass($cls){
 return QueryDB("SELECT COUNT(*) FROM kg_stds where std_prs_class='$cls' ")->fetchColumn();
}

function getAggr(){
 return QueryDB("SELECT COUNT(*) FROM kg_stds ")->fetchColumn();
}

function schTotal(){
 return QueryDB("SELECT COUNT(DISTINCT sch_code) FROM kg_stds")->fetchColumn();
}

function wardTotal(){
 return QueryDB("SELECT COUNT(DISTINCT std_wds) FROM kg_stds")->fetchColumn();
}

function enumTotal(){
 return QueryDB("SELECT COUNT(DISTINCT std_reg) FROM kg_stds")->fetchColumn();
}

function enumReg(){
 return QueryDB("SELECT COUNT(*) FROM kg_users WHERE us_type=3 ")->fetchColumn();
}


function getUser($usr){
  $init = QueryDB("SELECT * FROM kg_users where us_others ='$usr' ");
  return $init->fetch(PDO::FETCH_ASSOC); 
}

function getUserName($usr){
  $init = QueryDB("SELECT us_name FROM kg_users where us_others ='$usr' ");
  return   $init->fetch(PDO::FETCH_ASSOC)['us_name']; 
}

function getStd($usr){
  $init = QueryDB("SELECT * FROM kg_stds where std_code ='$usr' ");
  return $init->fetch(PDO::FETCH_ASSOC); 
}

function countSingle($table,$col,$val){
return QueryDB("SELECT COUNT(*) FROM `$table` where `$col` ='$val' ")->fetchColumn();
}

function countAll($table, $conditions) {
    $sql = "SELECT COUNT(*) FROM `$table` WHERE ";$conditionsArray = [];$params = [];
    foreach ($conditions as $column => $value) {
        $conditionsArray[] = "`$column` = :$column";$params[":$column"] = $value;
    }
    $sql .= implode(" AND ", $conditionsArray);$stmt = QueryDP($sql, $params);
    return $stmt->fetchColumn();
}


function accountType($type){ $msg ='';
  if($type==1){ $msg ='Super Admin'; }
  else if($type==2){ $msg ='Admin'; }
  else if($type==3){ $msg ='Enumerator'; }
  else if($type==4){ $msg ='Payroll Specialist'; }
  return $msg;
}

function userStatus($type){ $msg ='';
  if($type==1){ $msg ='Active'; }
  else if($type==0){ $msg ='Inactive'; }
  return $msg;
}




function multipleReplace($orig_string){
  $new_string = str_replace(str_split( '\\/:*?"<>|+.'), '', $orig_string);
return $new_string;
}

function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}


function deleteFilesInFolder($folderPath) {
    if (!is_dir($folderPath)) {
      //  echo "Folder does not exist.";
        return;
    }

    $files = array_diff(scandir($folderPath), array('.', '..'));

    foreach ($files as $file) {
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;

       
        if (is_dir($filePath)) {
            deleteFilesInFolder($filePath);   
            rmdir($filePath);  
        } else {
            unlink($filePath);  
        }
    }

    // echo "All files in the folder have been deleted.";
}
?>