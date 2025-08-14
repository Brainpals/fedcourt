<?php  include('xyz.php'); ?><!DOCTYPE html>
<html>
<head>
<style>
@media print {
    @page {
        size: A4;
        margin: 2mm; /* Controls printer margins */
    }
}

body {
    margin: 0;
    padding: 0;
}

.page {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2 columns */
    grid-template-rows: repeat(3, 1fr);   /* 3 rows */
    gap: 2mm; /* space between boxes */
    height: 277mm; /* A4 height minus margins */
    box-sizing: border-box;
    page-break-after: always;
    padding: 5mm;
}

.box {
    border: 1px solid black;
    display: flex;
    /* align-items: center;
    justify-content: center; */
    font-size: 18px;
    height: 100%;
}

.centerBold{
    text-align:center;
    font-weight:bold;
}

.setSize{
    font-size:11px;
}

#tab1 tr td{
            border:1px solid black !important;
            
        }
        #tab1{
            border-collapse:collapse;
            width:100% !important;
            padding:3px;
        }
</style>
</head>
<body>

<?php
$totalItems = 20; // QueryDB("SELECT COUNT(*) FROM payems_pay where month='{}' and year='{$_SESSION['work_yr']}' ")->fetchColumn();
$itemsPerPage = 6; // 2 columns × 3 rows
$pages = ceil($totalItems / $itemsPerPage);

$itemCount = 1;

foreach(QueryDB("SELECT * FROM payems_pay where month ='{$_SESSION['work_month']}' and year='{$_SESSION['work_yr']}' LIMIT 12 ")as $tp){

    echo '<div class="page">';
    for ($i = 0; $i < $itemsPerPage; $i++) {
        if ($itemCount > $totalItems) break;
        echo '<div class="box">
        
        <div>

        <table>
        <tr><td><img src="../vendor/img/justice_logo.png" alt="" style="width:70px;"></td>
        <td><div class="centerBold" style="font-size:20px">HIGH COURT OF JUSTICE</div>
        <div class="setSize centerBold">HEADQUARTERS, LOKOJA KOGI STATE</div>
        <div class="setSize centerBold" style="text-align:center;">JULY, 2025 PAYSLIP</div>
        <div>ONYEMA EMEKA FAMOUS</div></td></tr></table>


        <table id="tab1" style="line-height:20px;margin-bottom:50px;" align="center">
<tr><td>Generated: '.date('d-m-Y').'&nbsp;</td>
<td>JPSN/10225&nbsp;</td><td>&nbsp;G/L:4/20&nbsp;</td></tr>
</table>
        
        
        
        </div>
        
        
        
        </div>';
        $itemCount++;
    }
    echo '</div>';
}
?>


</body>
</html>
