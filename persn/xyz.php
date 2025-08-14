<?php  ob_start(); session_start();
if(isset($_SESSION['pay_pers'])){
//get Records
}else{
	header('location:../index.html'); die();
}

include '../controller/pipe.php'; 
include '../controller/functions/functions.php'; 
include '../controller/funcs.php';
include '../controller/resize.php';

?>