<?php

include('xyz.php');
$get = $linkr->getPayRoll($_POST['pid'],$_SESSION['work_month'],$_SESSION['work_yr']);
$sDetails = $linkr->user($_POST['pid']);
$empInfo = $linkr->emp_info($_POST['pid']);

$deductions = explode(',',$get['deductions']); $dValue = explode(',',$get['deduct_values']);
$extras = explode(',',$get['extras']); $eValue = explode(',',$get['extras_values']);
?>
<center><img src="../vendor/img/staff/<?php  echo $sDetails['passport'];  ?>" alt="" style="width:100px;height:100px;border-radius:50px;"></center>
<form action="" method="POST">
    <input type="hidden" value="<?php echo $_POST['pid']; ?>" name="where">
    <input type="hidden" value="<?php echo $get['net_pay']; ?>" name="myNet">
<div class="row">
<div class="col-md-4">
    <h5 class="text-center text-uppercase">Deductions</h5>
<table class="table table-striped table-responsive" style="width:100%;">

<?php $get_total_deductions =0;
for($i=0;$i<count($deductions);$i++){
    echo '<tr><td>'.$deductions[$i].'</td><td><input type="text" value="'.$dValue[$i].'" name="deduct[]" class="form-control"></td></tr>';
$get_total_deductions+=toNum($dValue[$i]);}?></table></div>




<div class="col-md-4">
<h5 class="text-center text-uppercase">EXTRAS</h5>
<table class="table table-striped table-responsive" style="width:100%;">
<?php $total_extras = 0;
for($i=0;$i<count($extras);$i++){
    echo '<tr><td>'.$extras[$i].'</td><td><input type="text" value="'.$eValue[$i].'" name="educt[]" class="form-control"></td></tr>';
$total_extras +=toNum($eValue[$i]);}?></table>
<input type="text" name="payCalc" value="<?php echo $get['percent']; ?>" class="form-control mb-2" placeholder="Salary Cut" id="cutSalary">

<input type="submit" value="Process" name="ProcessDeductions" class="form-control btn btn-primary btn-sm">
</div>
<?php  $exp =$get['paid']+$total_extras-$get_total_deductions; ?>
<div class="col-md-4">
<h5 class="text-center text-uppercase">CALCULATED </h5>
<table class="table table-striped table-responsive" style="width:100%;">
<tr><td>NET</td><td id="prev_calc"><?php  echo number_format($get['net_pay'],2); ?></td></tr>
<tr><td>expNET</td><td id="show_calc"><?php  echo number_format($get['paid'],2); ?></td></tr>
<tr><td>T-Deductions</td><td>&#8358;<span id="t_deductions"><?php echo number_format($get_total_deductions,2); ?></span></td></tr>
<tr><td>t-Extras</td><td>&#8358;<span id="t_extras"><?php echo number_format($total_extras,2); ?></span></td></tr>
<tr><td>Balance</td><td>&#8358;<span id="balance_calc"><?php echo number_format($exp,2); ?></span></td></tr>

</table>
</div>

</div>

<h5 class="text-center bg-secondary text-white">PERSONNEL DETAILS</h5>
<table class="table table-striped table-responsive" style="width:100%;">
<tr><td><strong>Name:</strong> <?php  echo $sDetails['title'].' '.$sDetails['surname'].' '.$sDetails['firstname'].' '.$sDetails['middlename']; ?></td> 
<td><b>Gender:</b> <?php  echo $sDetails['sex'];  ?></td> <td><b>DOB:</b> <?php  echo $sDetails['dob'];  ?></td>
<td><strong>Status:</strong> <?php  echo $sDetails['status'];  ?></td></tr>
<tr><td><b>mStatus:</b> <?php  echo $sDetails['mstatus'];  ?></td>
<td><b>Origin:</b> <?php  echo $sDetails['lga'].','.$sDetails['state'];  ?></td>
<td colspan="2"><b>Phone:</b> <?php  echo $sDetails['gsmnumber'];  ?></td>
</tr><tr>
<td><b>ID:</b> <?php  echo $sDetails['psn'];  ?></td>
<td><b>FILE NO:</b> <?php  echo $sDetails['openfileno']?></td>
<td colspan="2"><b>Email:</b> <?php  echo $sDetails['email'];  ?></td>
</tr></table>

<h5 class="text-center bg-secondary text-white">EMPLOYMENT DETAILS</h5>
<table class="table table-striped table-responsive small" style="width:100%;">
<tr><td><strong>DOFA:</strong> <?php  echo $empInfo['dofa']; ?></td> 
<td><b>DOPA:</b> <?php  echo $empInfo['dopa'];  ?></td> 
<td><b>DOLP:</b> <?php  echo $empInfo['dolp'];  ?></td>
<td><strong>DOC:</strong> <?php  echo $empInfo['doc'];  ?></td></tr>
<tr><td><b>RANKFA:</b> <?php  echo $empInfo['rankfa'];  ?></td>
<td><b>PRANK:</b> <?php  echo $empInfo['prank'];  ?></td>
<td colspan="2"><b>CONHESS:</b> <?php  echo $empInfo['conhess'];  ?></td>
</tr><tr>
<td><b>CADRE:</b> <?php  echo $empInfo['cadre'];  ?></td>
<td><b>S/GROUP:</b> <?php  echo $empInfo['salarygroup']?></td>
<td colspan="2"><b>employmenttypes:</b> <?php  echo $empInfo['employmenttypes'];  ?></td>
</tr>
<tr>
<td><b>DUTY POST:</b> <?php  echo $empInfo['dutystation'];  ?></td>
<td><b>INSPECTORATE:</b> <?php  echo $empInfo['inspectorate']?></td>
<td colspan="2"><b>DEPARTMENT:</b> <?php  echo $empInfo['department'];  ?></td>
</tr></table>

</form>

<script>
function removeCommas(num) {
    return num.toString().replace(/,/g, '');
}

// full live recalculation
function recalcFigures(){
    // Sum deductions
    let dTotal = 0;
    $("input[name='deduct[]']").each(function(){
        dTotal += Number($(this).val() || 0);
    });

    // Sum extras
    let eTotal = 0;
    $("input[name='educt[]']").each(function(){
        eTotal += Number($(this).val() || 0);
    });

    // displayed totals
    $("#t_deductions").html(dTotal.toLocaleString());
    $("#t_extras").html(eTotal.toLocaleString());

    // Original net (before anything)
    let originalNet = Number(removeCommas($('#prev_calc').html()) || 0);

    // Cut salary input
    let cutSalary = Number($('#cutSalary').val() || 0);

    // expNET = originalNet - cutSalary
    let expNet = originalNet * (1-cutSalary);
    $("#show_calc").html(expNet.toLocaleString());

    // Final balance
    let balance = expNet + eTotal - dTotal;
    console.log(balance);
    $("#balance_calc").html(balance.toLocaleString());
}

// Run whenever user types in deductions/extras/cut-salary
$(document).on('keyup', 'input[name="deduct[]"], input[name="educt[]"], #cutSalary', function(){
    recalcFigures();
});


//Sanitize
function allowNumericDot(evt) {
  let charCode = evt.which ? evt.which : evt.keyCode;

  // Allow backspace, delete, arrows, tab
  if ([8, 9, 37, 39, 46].includes(charCode)) {
    return true;
  }

  // Allow digits 0-9 and only one dot
  if ((charCode >= 48 && charCode <= 57) || charCode === 46) {
    // If dot and already exists in input, block it
    if (charCode === 46 && evt.target.value.includes(".")) {
      evt.preventDefault();
      return false;
    }
    return true;
  }

  evt.preventDefault();
  return false;
}

// Attach to all input elements
document.querySelectorAll('input[type="text"]').forEach(input => {
  input.addEventListener('keypress', allowNumericDot);
});
</script>