<?php  include('xyz.php'); ?>
<style>
    #tab tr td{
        border:1px solid black !important;
        text-align:right;
        text-transform:uppercase;
    }
    #tab{
        border-collapse:collapse;
    }
    .small{
        font-size:10px;
    }
</style>
<?php
$total_boxes = 30;
$boxes_per_page = 4; // 2x2
$lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

// for ($i = 1; $i <= $total_boxes; $i++) {
$i =1;
    foreach(QueryDB("SELECT * FROM payems_pay where month ='{$_SESSION['work_month']}' and year='{$_SESSION['work_yr']}' order by id DESC LIMIT 30 ")as $tp){
    // Start a new page
    if (($i - 1) % $boxes_per_page == 0) {
        if ($i > 1) echo '</div>'; // close previous page
        echo '<div class="page">';
    }
    $in = $linkr->emp_info($tp['psn']);
    $bnk = $linkr->bank_contact($tp['psn']);
    $totalDed =array_sum(explode(',',$tp['deduct_values']));
    $extraValues =array_sum(explode(',',$tp['extras_values']));
    $grossPay = $tp['paid']+intval($extraValues);
    $actualNetPay =$grossPay-intval($totalDed);


    echo '<div class="box">
    
    <table style="line-height:16px;width:100%;" align="center">
<tr><td><img src="../vendor/img/justice_logo.png" alt="" style="width:60px;margin-bottom:10px;"></td>
<td><h3 text-align:center;text-transform:uppercase;>HIGH COURT OF JUSTICE <br><div style="font-size:12px;text-align:center;">HEADQUARTERS, LOKOJA KOGI STATE </div>
<div style="text-align:center;font-size:12px;">'.strtoupper(date('F', mktime(0, 0, 0, $_SESSION['work_month'], 1))).' '. $_SESSION['work_yr'].' PAYSLIP</div>
<div style="text-align:center;text-transform:uppercase;">'.$linkr->getStaffFullName($tp['psn']).'</div>
<hr></h3></td></tr></table> 
<div style="text-align:right;">COMPUTER No: <b>'.$tp['psn'].'</div>
<table id="tab" style="width:100%">
<tr><td  >G/L: <b>'.$tp['rank'].'</b>&nbsp;&nbsp;&nbsp;</td><td  >Salary Group: <b>'.$tp['salary_group'].'</b>&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td colspan="2" ><b>'.$linkr->bankName($tp['bank_paid']).'</b>&nbsp;&nbsp;('.$tp['account_numb'].')</td></tr>
<tr><td  >Basic-Salary: <b>&#8358;'.number_format($tp['net_pay'],2).'/&#8358;'.number_format($tp['paid'],2).'</b>&nbsp;&nbsp;&nbsp;</td><td  >Gross-Salary: <b>'.$grossPay.'</b>&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td  >T-Deduction: <b>&#8358;'.$totalDed.'</b>&nbsp;&nbsp;&nbsp;</td><td  >T-Allowance: <b>&#8358;'.$extraValues.'</b>&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td  colspan="2"> <p>NET PAY: <b>&#8358;'.number_format($actualNetPay,2).'</b></p></td></tr>

<tr><td colspan="2"><b>Allowances</b></td></tr>
<tr>
<td colspan="2" class="small">';  for($i=0;$i<count(explode(',',$tp['extras_values']));$i++){
    echo explode(',',$tp['extras'])[$i].'['.explode(',',$tp['extras_values'])[$i].']';
    if($i%4==0){ echo '<br/>'; }
    } echo '</td>
</tr>

<tr><td colspan="2"><b>DEDUCTIONS</b></td></tr>
<td colspan="2" class="small">';
for($d=0;$d<count(explode(',',$tp['deductions']));$d++){
    
        echo '&nbsp;'.explode(',',$tp['deductions'])[$d].'['.explode(',',$tp['deduct_values'])[$d].']&nbsp;';
        if($d%4==0){ echo '<br/>'; }
   
    
    }
echo '</td>
</tr>
<tr><td colspan="2" class="small">Generated:'.date('jS F, Y @ H:i:s A').'</td></tr>
<tr><td colspan="2" class="small">By:'.$linkr->userInfo($tp['created_by']).'</td></tr>
</table>



    
    
    </div>';
    $i++;
}

echo '</div>'; // close last page
?>
<style>
.page {
    width: 210mm;
    height: 275mm;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 5mm;
    page-break-after: always;
}
.page:last-child { page-break-after: auto; }
.box {
    border: 1px solid #000;
    padding: 10px;
}
</style>
