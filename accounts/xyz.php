<?php  ob_start(); session_start();
if(isset($_SESSION['userType1'])){
//get Records
}else{
	header('location:../index.html'); die();
}

include '../controller/pipe.php'; 
include '../controller/functions/functions.php'; 
include '../controller/funcs.php';
include '../controller/resize.php';

$res = $linkr->getWorkingMonthYear();
$_SESSION['work_yr']= $res['year']; $_SESSION['work_month'] = $res['month'];

?>