<?php ob_start(); session_start(); include('../controller/funcs.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
$password = hash('sha256',$_POST['password']) ?? '';

if(countAll('payems_users',array('us_email'=>$email,'us_encr'=>$password))>0){
 $stmt = $db->prepare("SELECT * FROM payems_users WHERE us_email = :email AND us_encr = :password");
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);
  $stmt->execute();
   $result = $stmt->fetch();

  //3 - Personnel
  //1- Admin
  //2 - Accounts

  
  if (count($result) > 0) {
    QueryDB("UPDATE payems_users SET us_log  ='".time()."' where us_others='{$result['us_others']}' LIMIT 1   ");
    if($result['us_type']==3){ //Personell
    	$_SESSION['userType'] =$result['us_others'];
      $_SESSION['pay_pers'] = $result['us_name'];
    	print'<script> window.location="persn/"   </script>';
    }else if($result['us_type']==1){ //Admin
      $_SESSION['userType1'] =$result['us_others'];
      print'<script> window.location="accounts/"   </script>';
    }else if($result['us_type']==2){ //Accounts
      $_SESSION['userType2'] =$result['us_others']; 
      print'<script> window.location="accts/"   </script>';
    }
  } else {
    echo 'Invalid Access Credentials';;
  }
}else{ echo 'Invalid Access Credentials'; }

  exit;
}

?>