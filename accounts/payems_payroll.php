<?php include 'xyz.php'; ?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PAYEMS25 - Account Dashboard</title><?php include('inc/top.html'); ?>
</head>
<body><?php include('inc/nav.php');?>
<div id="main-content"><div class="row g-3 mb-3"><?php include 'process.php'; ?>

<div class="col-md-12"><h3 class="text-danger text-center text-uppercase bg-secondary text-white">
  Payroll Review for <?php  echo date('F', mktime(0, 0, 0, $_SESSION['work_month'], 1)); echo ', '.$_SESSION['work_yr'];  ?></h3></div>
<div class="col-md-12"> <div class="card p-3"><div class="d-flex justify-content-between align-items-center">



    


<table id="example" class="display nowrap table table-striped small" style="width:100%">
  <thead>
    <tr><th>#</th><th>PSN</th><th>Full Name</th><th>NET</th><th>TOTAL DED</th><th>EXTRAS</th><th>PAYABLE</th><th>ACCNUMB</th>
      <th>Action</th>
    </tr> 
  </thead>
<tbody>
  <?php $list =1;  foreach(QueryDB("SELECT psn, rank, salary_group, pay_timestamp, week_no, month, year, created_at, net_pay, paid, deductions, deduct_values, extras, extras_values, account_numb, created_by
  FROM payems_pay where month ='".$_SESSION['work_month']."' and year ='".$_SESSION['work_yr']."' order by id DESC LIMIT 5 ")as $lst){
    $deductions = toNum(array_sum(explode(',',$lst['deduct_values'])));
    $extras = toNum(array_sum(explode(',',$lst['extras_values'])));
$payable = $lst['paid'] + $extras - $deductions;
   echo  '<tr>
      <td>'.$list.'</td><td>'.$lst['psn'].'</td><td>'.$linkr->getStaffFullName($lst['psn']).'</td>
      <td>&#8358;'.$lst['net_pay'].'/<span class="text-danger">'.$lst['paid'].'</span></td><td>'.number_format($deductions,2).'</td>
      <td>'.number_format($extras,2).'</td>
      <td>&#8358;'.number_format($payable,2).'</td><td>'.$lst['account_numb'].'</td><td>
      <button class="open-modal btn btn-primary btn-sm title="View""
        data-psn="' . $lst['psn'] . '" ><i class="fa fa-eye "></i></button>

        <button class="wrench-modal btn btn-warning btn-sm title="View""
        data-psn="' . $lst['psn'] . '",data-genTime="'.$lst['pay_timestamp'].'" ><i class="fa fa-spinner" aria-hidden="true"></i></button>
        
        <a href="" title="Print Payslip" class="btn btn-secondary text-white btn-sm"><i class="fa fa-book"></i></a>
        </td>
    </tr>'; $list++; } ?>

</tbody>
</div></div>
</div>






    


   

  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-body showHere"></div></div></div></div>



  <div class="modal fade" id="wrenchModal" tabindex="-1" role="dialog" aria-labelledby="wrenchModalLabel">
  <div class="modal-dialog modal-sm" role="document"><div class="modal-content">
    <div class="modal-body">
<p class="text-center">This will reload payroll for <span id="showPSN" class="text-danger"></span> </p>
<form action="" method="POST"><input type="hidden" id="sPSN" name="where">
<input type="hidden" id="genTime" name="genTime">
<center><input type="submit" value="Proceed" name="redoPayroll" class="btn btn-secondary text-white"></center>
</form>
    </div></div></div></div>
    
    


   




<?php include('inc/bottom.html'); 
$workMonth = $_SESSION['work_month']; $workYear = $_SESSION['work_yr'];?>
<script>
  $(document).ready(function(){ 
    const params = new URLSearchParams(window.location.search); 
    const mth  = "<?php echo $workMonth; ?>";  const year = "<?php echo $workMonth; ?>";
    $('.open-modal').click(function(e){ e.preventDefault(); pData = $(this).data('psn');
$.ajax({url: 'payemsview_loan',type: 'POST',data: { pid: pData, mth: mth, year: year },
  success: function(resp) {$('#editModal').modal('show'); $('.showHere').html(resp);
  },
  error: function() { alert('Error updating staff');}
});

    })

    $('.wrench-modal').click(function(e){ e.preventDefault(); pData = $(this).data('psn');
      $('#wrenchModal').modal('show'); $('#showPSN').html(pData); $('#sPSN').val(pData); $('#genTime').val($(this).data('genTime'));

    })

  })

  
</script>
</body>
</html>
