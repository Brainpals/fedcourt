<?php

function draw_in($val){ return v($_POST[$val]);}

//Encode table Value
function swing_tab($val){
	switch ($val) {
		case 1:return 'app_users';break;
		case 2:return 'products';break;
    case 3:return 'storekeeper';break;
    case 4:return 'specs';break;
		
		default:
			return 'Error::';
			break;
	}
}

function destination($val){
  switch ($val) {
    case 1:return 'LOUNGE';break;
    case 2:return 'GAZEBO';break;
    case 3:return 'KITCHEN';break;
    default:
      return 'Error::';
      break;
  }
}

function tabRes($val){
  switch ($val) {
    case 1:return 'item_cost_in';break;
    case 2:return 'item_cost';break;
    default:
      return 'Error::';
      break;
  }
}


function tabRest($val){
  switch ($val) {
    case 1:return 'item_cost_in';break;
    case 0:return 'item_cost';break;
    default:
      return 'Error::';
      break;
  }
}


function showCount(){
  for($i=0;$i<21;$i++){
    echo '<option value='.$i.'>'.$i.'</option>';
  }
}




function addShoch($val){
    return ''.$val.'';
}



function AcctType($val){ $msg = '';
if($val==1){ $msg ='Manager';}
else if($val==2){ $msg ='Supervisor';}else if($val==3){ $msg ='Barman';}else if($val==4){ $msg ='Waitress';}
return $msg;
}




function pay_status($val){ $msg = '';
if($val==1){ $msg ='Paid';}
if($val==0){ $msg ='Pending';}
return $msg;
}

function getlocation($val){ $msg = '';
if($val==1){ $msg ='adm';}
else if($val==2){ $msg ='spr';}
else if($val==3){ $msg ='bar';}
else if($val==4){ $msg ='usr';}
return $msg;
}


function payMTH($val){ $msg = '';
if($val==1){ $msg ='Pos-W';}
else if($val==2){ $msg ='Cash';}
else if($val==3){ $msg ='Pos-T';}
else if($val==4){ $msg ='COMPL';}
return $msg;
}




function order_status($val){ $msg = '';
if($val=='E'){ $msg ='Modified';}
else if($val=='C'){ $msg ='Cancelled';}
else if($val=='S'){ $msg ='Untouched';}
else if($val==''){ $msg ='Untouched';}
return $msg;
}

function order_type($val){ $msg = '';
if($val==1){ $msg ='Bar Order';}
else if($val==2){ $msg ='Kitchen Order';}
else if($val==3){ $msg ='Shisha Order';}
else if($val==3){ $msg ='Cocktail Order';}
else if($val==3){ $msg ='Tequila Order';}
else if($val==3){ $msg ='Special Order';}
return $msg;
}

function expenseType($val){ $msg = '';
if($val==1){ $msg ='Expenses';}
else if($val==2){ $msg ='Damages';}
return $msg;
}




function diff_time($a){
$diff = time()-$a;
$days    = floor($diff / 86400);
$hours = floor(($diff - ($days * 86400)) / 3600);
return $hours;
}

function state($val){
switch ($val) {case 1:return 'Active';break;case 0:return 'Inactive';break;
default:return 'Active';break;}}


function nhis_status($val){ $msg = null;
	if($val==1){ $msg='Not Available';}else if($val==2){ $msg ='Available';} return $msg;
}

function app_status($val){ $msg = null;
	if($val==1){ $msg='Pending';}else if($val==2){ $msg ='Treated';}else if($val==2){ $msg ='Rescheduled';}else if($val==2){ $msg ='Missed';} return $msg;
}

function GetAge($dob)
{
        $dob=explode("-",$dob);
        $curMonth = date("m");
        $curDay = date("j");
        $curYear = date("Y");
        $age = $curYear - $dob[0];
        if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2]))
                $age--;
        return $age;
}






 function createSalt(){return '2123293dsj2hu2nikhiljdsd';}

  function code_pics($count){
    $alphabets ='ABCDEFGHIJKLMNOPQRSTUVWXYZ'; $rCode = rand(10,99);
    $class_unique = rand(10,99).substr(str_shuffle($alphabets),0,$count).$rCode;
    return $class_unique;
  }

  function monthName($val){ 
  	if(!empty($val)){
    $dateObj = DateTime::createFromFormat('!m', $val);
    $monthName = $dateObj->format('F');
    return  $monthName;
	}
}


//Store the url name
     function subscribe(){
    $sb = strpos($_SERVER['REQUEST_URI'],substr(basename($_SERVER['PHP_SELF']),0,-4));
    return substr($_SERVER['REQUEST_URI'],$sb);
    }
 function randomised(){  return code_pics(10).rand();}
 function swap($val){ $msg; if($val==1){ $msg = 0; }else if($val==0){ $msg=1;} return $msg;  }


function v($value){$value = trim($value);$value = stripslashes($value);
$value = htmlspecialchars($value);$value = str_replace("'","&apos;", $value);
$value = str_replace('"',"&quot;", $value);return $value;}



function kill_it($val){
  $prep1 = str_replace("&amp;","&",htmlentities(v($val))); 
  $start =  strpos($prep1,"&lt;p&gt;");
$prep2 =  substr($prep1,$start);$prep2 = str_replace("&lt;/body&gt;", "", $prep2);
$prep3 =  str_replace("&lt;/html&gt;", "", $prep2);
return $prep3;
}


?>