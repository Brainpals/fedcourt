<?php 
include ('../../controller/funcs.php'); include '../../controller/pipe.php'; 
$conhess = $_POST['conhess'];
$salarygroup = $_POST['salarygroup'];
$emp_status = $_POST['emp_status']; $where = $_POST['where'];
$salary =$linkr->getSalary($conhess,$salarygroup);
$input = $conhess; 
list($gl, $step) = explode('/', $input);
QueryDB("UPDATE payems_details SET salarygroup='$salarygroup',gl='$gl',step='$step',conhess='$conhess' where psn='$where'  ");
QueryDB("UPDATE payems_staff SET status='$emp_status' where psn='$where' LIMIT 1 ");


?>


