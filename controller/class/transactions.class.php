<?php  
 include('Dbh.class.php');
class Transactions extends Dbh{
    protected $total_savings;
     private $conn; 
    public function __construct() { 
       $this->conn = $this->connect(); 
       //$this->conn = $dbcon->connect();
    }

    public function runQuery($Query){
        $this->conn = $this->connect();
        $stmt = $this->conn->prepare($Query);
        return $stmt->execute();
    }

    public function prepareQuery($Query){
        $this->conn = $this->connect();
        return  $this->conn->prepare($Query);
       
    }


    public function saveTransaction($sql) {
        return $this->conn->query($sql); // ✅ correct
    }
    
    
    /****************************NEW FUNCTIONS************************/
public function get_user($code){$stmt = $this->conn->prepare("SELECT * FROM app_users WHERE login_pin ='$code'  ");try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res;} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }

public function get_user_name($code){$stmt = $this->conn->prepare("SELECT * FROM app_users WHERE id ='$code'  ");try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res['name'];} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }

public function get_user_name_with_email($code){$stmt = $this->conn->prepare("SELECT * FROM app_users WHERE login_pin ='$code'  ");try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res['name'];} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }


public function get_salary_group($id){
$stmt = $this->conn->prepare("SELECT salarygroup FROM payems_details WHERE psn ='$id'  ");
try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res['salarygroup'];} 
catch (\PDOException $e) 
{throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
}

public function conhess($id){
    $stmt = $this->conn->prepare("SELECT conhess FROM payems_details WHERE psn ='$id'  ");
    try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res['conhess'];} 
    catch (\PDOException $e) 
    {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
    }

    public function staffDept($id){
        $stmt = $this->conn->prepare("SELECT department FROM payems_details WHERE psn ='$id'  ");
        try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res['department'];} 
        catch (\PDOException $e) 
        {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
        }

        public function emp_info($id){
            $stmt = $this->conn->prepare("SELECT dofa,dopa,dolp,doc,rankfa,prank,cadre,qualification,salarygroup,conhess,employmenttypes,dutystation,inspectorate,department FROM payems_details WHERE psn ='$id'  ");
            try {$stmt->execute();return $stmt->fetch(PDO::FETCH_ASSOC);} 
            catch (\PDOException $e) 
            {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
            }

            public function bank_contact($id){
                $stmt = $this->conn->prepare("SELECT bank,accountnumber,mstatus,nok_name,nok_relationship,nok_address,nok_contact,childrencount FROM contact_and_nok WHERE psn ='$id'  ");
                try {$stmt->execute();return $stmt->fetch(PDO::FETCH_ASSOC);} 
                catch (\PDOException $e) 
                {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
                }

                public function show_grade_rank($code) {
                    $stmt = $this->conn->prepare("SELECT GLS FROM salary_chart WHERE code = :code ORDER BY GLS ASC");
                    $stmt->execute(['code' => $code]);
                
                    while ($gl = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'.$gl['GLS'].'">'.$gl['GLS'].'</option>';
                    }
                }


                public function bankName($code) {
                    $stmt = $this->conn->prepare("SELECT title FROM payems_bank WHERE id ='$code' ");
                    try {$stmt->execute();
                        $res = $stmt->fetch(PDO::FETCH_ASSOC);
                        return $res['title'];} 
                    catch (\PDOException $e) 
                    {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
                    
                }

             
                

                public function userInfo($id){
                    $stmt = $this->conn->prepare("SELECT us_name FROM payems_users WHERE us_others ='$id'  ");
                    try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res['us_name'];} 
                    catch (\PDOException $e) 
                    {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage()); }
                    }


                //Show LGA 
                public function show_sel_LGA($code) {
                    $stmt = $this->conn->prepare("SELECT name FROM  local_governments WHERE state_id = :code ORDER BY name ASC");
                    $stmt->execute(['code' => $code]);
                    while ($gl = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'.$gl['name'].'">'.$gl['name'].'</option>';
                    }
                }

   public function user($code){
        $stmt = $this->conn->prepare("SELECT fileno, psn, title, surname, firstname, 
        middlename, sex, dob, mstatus, bgroup, lga, state, gsmnumber, email, address, 
        passport, openfileno, secretfileno, promotion, transfer, suspension, 
        withdrawal, created_at, updated_at, created_by,status
 FROM payems_staff WHERE psn ='$code'  ");
 try {
     $stmt->execute();return $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
}
}
             
              //Show LGA 
              public function getSalary($gl, $code) {
                $stmt = $this->conn->prepare("SELECT net FROM salary_chart WHERE GLS = :gl AND code = :code");
                $stmt->execute(['gl' => $gl, 'code' => $code]);
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                return $results['net'] ?? null; // safer: return null if no result
            }
                 
            public function getNextPSN()
            {
                $stmt = $this->conn->prepare("
                    SELECT MAX(CAST(SUBSTRING(psn, 6) AS UNSIGNED)) AS max_psn 
                    FROM payems_staff 
                    WHERE psn LIKE 'JPSN/%'
                ");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $maxNumber = $row['max_psn'] ?? 0;
                $nextNumber = $maxNumber + 1;
                $nextPSN = "JPSN/" . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
                return $nextPSN;
            }

public function queryCount($tableName, array $where){
$output = implode(' AND ', array_map(function ($v, $k) { return sprintf("%s='%s'", $k, $v); },$where,array_keys($where)
));
if(count($where)>0){$stmt = $this->conn->prepare("SELECT COUNT(*) FROM $tableName WHERE $output ");
}else{$stmt = $this->conn->prepare("SELECT COUNT(*) FROM $tableName ");}
try { $stmt->execute(); return $stmt->fetchColumn();} 
        catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function getStaffFullName($psn)
{
    $sql = "SELECT surname, firstname, middlename FROM payems_staff WHERE psn = :psn LIMIT 1";$stmt = $this->conn->prepare($sql);
    try {
        $stmt->execute([':psn' => $psn]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            return $res['surname'] . ' ' . $res['firstname'] . ' ' . $res['middlename'];
        }
        return null; // not found
    } catch (\PDOException $e) {
        throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
    }
}

public function getPayRoll($psn,$mth,$year)
{
    $sql = "SELECT * FROM payems_pay WHERE psn = :psn and month='$mth' and year='$year' LIMIT 1";$stmt = $this->conn->prepare($sql);
    try {
        $stmt->execute([':psn' => $psn]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
    }
}

public function getWorkingMonthYear()
{
    $sql = "SELECT * FROM payems_yrset WHERE status =1 LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    try {
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
    }
}

public function getDeductions($type){
    $stmt = $this->conn->prepare("SELECT item_name FROM payems_deductions WHERE item_type ='$type'  ");
    try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);
        return explode(',',$res['item_name']);} catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }



            public function bulkUpdateExcel($file, $index)
            {
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
                $sheet       = $spreadsheet->getActiveSheet();
                $rows        = array_slice($sheet->toArray(), 1);  // skip header
            
                // 1. Cache all account numbers from DB
                $selectAll = $linkr->prepareQuery("SELECT account_numb, deduct_values FROM payems_pay");
                $selectAll->execute();
                $accountCache = $selectAll->fetchAll(PDO::FETCH_KEY_PAIR);
            
                // 2. Prepared update statement
                //$update = $this->conn->prepare("UPDATE payems_pay SET deduct_values = :deduct WHERE account_numb = :acc LIMIT 1");
                $update = $linkr->prepareQuery("UPDATE payems_pay SET deduct_values = :deduct WHERE account_numb = :acc and month=:mth and year=:yr LIMIT 1");




                // 3. To collect unmatched rows
                $notFound = [];
            
                // 4. Loop excel
                foreach ($rows as $row) {
                    $excelId     = trim($row[0]);
                    $excelName   = trim($row[1]);
                    $accountNum  = trim($row[2]);
                    $deductValue = trim($row[3]);
            
                    // If match found → update
                    if (isset($accountCache[$accountNum])) {
                        $parts = explode(',', $accountCache[$accountNum]);
                        $parts[$index] = $deductValue;
                        $newValue = implode(',', $parts);
            
                        $update->execute([
                            ':deduct' => $newValues,
                            ':acc'    => $accountNum,
                            ':mth' =>$_SESSION['work_month'],
                            ':yr' =>$_SESSION['work_yr']
                        ]);
                    }
            
                    // If not found → add to array
                    else {
                        $notFound[] = [
                            'id'      => $excelId,
                            'name'    => $excelName,
                            'account' => $accountNum,
                            'deduct'  => $deductValue
                        ];
                    }
                }
            
                return $notFound;   // return those that could not be matched
            }
            





public function getSelSpecs($comes_in,$pos){$stmt=$this->conn->prepare("SELECT * FROM specs");
try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC); 
    $exp = explode(',',$res[$comes_in]);
    return $exp[$pos];
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }


public function getProduct2($pn){$stmt = $this->conn->prepare("SELECT * FROM products WHERE id ='$pn'  ");try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);echo $this->getSelSpecs('shaped_by',$res['shaped_by']).' '.$res['item_name'].' Comes In <b>'.$this->getSelSpecs('comes_in',$res['comes_in']).'</b> <br/> <b>'.$this->getSelSpecs('numbered_in',$res['numbered_in']).'</b> in Number Color: <b>'.$this->getSelSpecs('colored_type',$res['colored_type']).'</b> <br/> Size: <b>'.$this->getSelSpecs('sized_by',$res['sized_by']).'</b>  </b> <br/> COST: <b>&#8358;'.$res['item_cost'].'</b>';
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }

public function getProduct3($pn){$stmt = $this->conn->prepare("SELECT * FROM products WHERE id ='$pn'  ");try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $this->getSelSpecs('sized_by',$res['sized_by']).' '.$this->getSelSpecs('shaped_by',$res['shaped_by']).'<br/> '.$res['item_name'].'</b>';
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }

public function getProductName4($pn){$stmt = $this->conn->prepare("SELECT * FROM products WHERE id ='$pn'  ");try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $this->getSelSpecs('sized_by',$res['sized_by']).' '.$this->getSelSpecs('shaped_by',$res['shaped_by']).' '.$res['item_name'].'</b>';
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }


public function getProduct4($pn){$stmt = $this->conn->prepare("SELECT * FROM products WHERE id ='$pn'  ");try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $this->getSelSpecs('sized_by',$res['sized_by']).' '.$this->getSelSpecs('shaped_by',$res['shaped_by']).' '.$res['item_name'].'</b>';
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());} }

    /******************************END********************************/


  public function get_order_time($pin){$add_= 0;
$stmt = $this->conn->prepare("SELECT * FROM wallet where id='$pin'   ");
try { $stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC); 
return $res['time_']+86400;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

     public function member($pin){$add_= 0;
$stmt = $this->conn->prepare("SELECT * FROM member where ledger_id='$pin'   ");
try { $stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC); 
return $res;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


public function listSavingsM(){$add_=''; $sumUp= 1; $addSavings=0;
$stmt = $this->conn->prepare("SELECT * FROM isavings where mledger='{$_SESSION['etcUser']}'ORDER BY id DESC LIMIT 12  ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
$add_ .='<tr>
<td>'.(date('d/m/y',strtotime($res['m_date']))).'</td><td>'.DateTime::createFromFormat('!m',$res['m_month'])->format('M').', '.$res['m_year'].'</td>
<td>&#8358;'.number_format($res['m_amt']).'</td>
<td>'.$this->getUser(($res['m_attendee'])).'</td></tr>';
$addSavings+=$res['m_amt'];

$sumUp++;
}
$add_.='<tr><th></th><th></th><th>TOTAL SAVINGS</th><th>'.number_format($addSavings).'</th></tr>';
return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }



public function listSavingsM3(){$add_=''; $sumUp= 1; $addSavings=0;
$stmt = $this->conn->prepare("SELECT * FROM isavings where mledger='{$_SESSION['etcUser']}'ORDER BY id DESC LIMIT 3  ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
$add_ .='<tr>
<td>'.(date('d/m/y',strtotime($res['m_date']))).'</td><td>'.DateTime::createFromFormat('!m',$res['m_month'])->format('M').', '.$res['m_year'].'</td>
<td>&#8358;'.number_format($res['m_amt']).'</td>
<td>'.$this->getUser(($res['m_attendee'])).'</td></tr>';
$addSavings+=$res['m_amt'];

$sumUp++;
}
$add_.='<tr><th colspan="2" style="text-align:right;">TOTAL SAVINGS</th><th colspan="2">'.number_format($addSavings).'</th></tr>';
return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }






public function rangeSavings($start,$stop){$add_=''; $sumUp= 1; $addSavings=0;
$stmt = $this->conn->prepare("SELECT * FROM isavings where mledger='{$_SESSION['etcUser']}' and (`m_year` BETWEEN '".$start."' AND '".$stop."' )  ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
$add_ .='<tr style="line-height:20px;"><td style="text-align:center;">'.$sumUp++.'</td>
<td style="text-align:center;">'.($res['m_date']).'</td>';
if($res['m_amt']<0){  $add_.='<td style="text-align:center;">Dr</td>';}else{  $add_.='<td style="text-align:center;">Cr</td>';}
$add_.='<td style="text-align:center;">'.DateTime::createFromFormat('!m',$res['m_month'])->format('M').'</td>
<td style="text-align:center;">'.$res['m_year'].'</td>
<td style="text-align:center;">&#8358;'.number_format($res['m_amt']).'</td></tr>';
$addSavings+=$res['m_amt'];

$sumUp++;
}
$add_.='<tr><th style="border:none"></th><th style="border:none"></th><th style="border:none"></th><th style="border:none"></th><th>TOTAL SAVINGS</th><th>'.number_format($addSavings).'</th></tr>';
return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }






       public function listSavings(){$add_=''; $sumUp= 1; $addSavings=0;
$stmt = $this->conn->prepare("SELECT * FROM isavings where mledger='{$_SESSION['etcUser']}'ORDER BY id DESC LIMIT 12   ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
$add_ .='<tr><td>'.$sumUp.'</td>
<td>'.($res['m_date']).'</td>
<td>&#8358;'.number_format($res['m_amt']).'</td>
<td>'.DateTime::createFromFormat('!m',$res['m_month'])->format('M').'</td>
<td>'.$res['m_year'].'</td>
<td>'.$this->getUser(($res['m_attendee'])).'</td></tr>';
// <td class="font-weight-medium">';
// if($res['appr']==0){
//     $add_ .='<div class="badge badge-warning">Pending</div></td></tr>';}else{
// $add_ .='<div class="badge badge-success">Completed</div></td></tr>';
//     }                   
$addSavings+=$res['m_amt'];

$sumUp++;
}
$add_.='<tr><th></th><th></th><th></th><th></th><th>TOTAL SAVINGS</th><th>'.number_format($addSavings).'</th></tr>';
return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }




         public function listSavings3(){$add_=''; $sumUp= 1; $addSavings=0;
$stmt = $this->conn->prepare("SELECT * FROM isavings where mledger='{$_SESSION['etcUser']}'ORDER BY id DESC LIMIT 3   ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
$add_ .='<tr><td>'.$sumUp.'</td>
<td>'.(date('d/m/y',strtotime($res['m_date']))).'</td>
<td>&#8358;'.number_format($res['m_amt']).'</td>
<td>'.DateTime::createFromFormat('!m',$res['m_month'])->format('M').'</td>
<td>'.$res['m_year'].'</td>
<td>'.$this->getUser(($res['m_attendee'])).'</td></tr>';
// <td class="font-weight-medium">';
// if($res['appr']==0){
//     $add_ .='<div class="badge badge-warning">Pending</div></td></tr>';}else{
// $add_ .='<div class="badge badge-success">Completed</div></td></tr>';
//     }                   
$addSavings+=$res['m_amt'];

$sumUp++;
}
$add_.='<tr><th></th><th></th><th></th><th></th><th>TOTAL SAVINGS</th><th>'.number_format($addSavings).'</th></tr>';
return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function mySavings(){$add_= 0;
$stmt = $this->conn->prepare("SELECT * FROM isavings where mledger='{$_SESSION['etcUser']}'   ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ $add_ +=$res['m_amt'];}
return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function myLoans(){$add_= 0;
$stmt = $this->conn->prepare("SELECT * FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_disbursed_status=1  ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ $add_ +=$res['loan_total'];}
return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

  public function currentLoans(){$add_= 0;
$stmt = $this->conn->prepare("SELECT * FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_disbursed_status=1  ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
if(date('Y',$res['date_approved'])==date('Y')){  $add_ +=$res['loan_total']; }
   }return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

public function my_savings_amount(){$add_= 0;
$stmt = $this->conn->prepare("SELECT * FROM sv where ledger='{$_SESSION['etcUser']}'ORDER BY id DESC LIMIT 1  ");
try { $stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC); return $res['amt'];}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


public function my_loan_count(){$add_= 0;
$stmt = $this->conn->prepare("SELECT COUNT(*) FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_disbursed_status=1  ");
try { $stmt->execute();  return $count = $stmt->fetchColumn();}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


 public function currentLoanCount(){$add_= 0;
$stmt = $this->conn->prepare("SELECT * FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_disbursed_status=1  ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
if(date('Y',$res['date_approved'])==date('Y')){  $add_++; }
   }return $add_;}
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

 public function AllloanPick(){$add_='';
 $bg_type = array('bg-primary','bg-warning','bg-danger','bg-info');
$stmt = $this->conn->prepare("SELECT * FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_disbursed_status=1  ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
$add_ .='<tr>
<td class="text-muted">'.$res['loan_type'].' Loan</td><td class="w-100 px-0">
<div class="progress progress-md mx-4"><div class="progress-bar '.$bg_type[rand(0,3)].'" role="progressbar" style="width: 100%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div></div></td><td><h5 class="font-weight-bold mb-0">&#8358;'.number_format($res['loan_total']).'</h5></td></tr>';
   }return $add_;}
catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

 public function currentYearLoanPick(){$add_='';
 $bg_type = array('bg-primary','bg-warning','bg-danger','bg-info');
$stmt = $this->conn->prepare("SELECT * FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_disbursed_status=1  ");
try { $stmt->execute();
while($res=$stmt->fetch(PDO::FETCH_ASSOC)){if(date('Y',$res['date_approved'])==date('Y')){
$add_ .='<tr>
<td class="text-muted">'.$res['loan_type'].' Loan</td><td class="w-100 px-0">
<div class="progress progress-md mx-4"><div class="progress-bar '.$bg_type[rand(0,3)].'" role="progressbar" style="width: 100%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div></div></td><td><h5 class="font-weight-bold mb-0">&#8358;'.number_format($res['loan_total']).'</h5></td></tr>';
   }}return $add_;}
catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


public function get_loanBalance($lCode,$loaned){
$stmt = $this->conn->prepare("SELECT * FROM compound where loan_code='$lCode' and loaner ='$loaned' ORDER BY id DESC LIMIT 1  ");try { $stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);
 return $res['balance']-$res['diff'];
}catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
}
    }


 public function loanPayStatus(){$add_='';
 $bg_type = array('bg-primary','bg-warning','bg-danger','bg-info');
$stmt = $this->conn->prepare("SELECT * FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_disbursed_status=1  ");
try { $stmt->execute();
while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
$add_ .='<tr><td>'.$res['loan_type'].'</td>
<td>&#8358;'.number_format($res['loan_principal']).'</td>
<td>'.($res['loan_duration']).' mths</td>
<td>&#8358;'.number_format($res['loan_interest']).'</td>
<td>&#8358;'.($res['paymt_install']).'</td>
<td class="font-weight-bold">&#8358; '.number_format($res['loan_total']).'</td>
<td>'.@number_format($this->get_loanBalance($res['loan_code'],$res['ledger_id'])).'</td>
<td>'.date('M, Y',$res['date_approved']).'</td><td class="font-weight-medium">';
if($res['loan_payment_status']==0){
    $add_ .='<div class="badge badge-warning">Pending</div></td>';}else{
$add_ .='<div class="badge badge-success">Completed</div></td>';
    } 
 $add_ .='<td><a class="viewLoan"  name="'.$res['ledger_id'].'" id="'.$res['loan_code'].'"><i class="btn btn-primary btn-xs btn-sm">view</i></a></td></tr>';                 
        }return $add_;}
catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }



 public function loanListM(){$add_='';
 $bg_type = array('bg-primary','bg-warning','bg-danger','bg-info');
$stmt = $this->conn->prepare("SELECT * FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_disbursed_status=1  ");
try { $stmt->execute();
while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
$add_ .='<tr><td>'.$res['loan_type'].' <br/>&#8358;'.number_format($res['loan_principal']).'<br/>'.($res['loan_duration']).' mths</td>

<td>'.number_format($res['loan_interest']).'<br/>'.($res['paymt_install']).'<br/> &#8358;'.number_format($res['loan_total']).'</td>
<td>'.date('M, Y',$res['date_approved']).'<br/>
BALANCE '.@number_format($this->get_loanBalance($res['loan_code'],$res['ledger_id'])).'</td><td class="font-weight-medium text-center"><br/>
<span id="loanView" name="loan_v" class="text-center lParty" title='.$res['loan_code'].' href="?send='.hash('sha512',rand()).'&view='.$res['loan_code'].'"><i class="fa fa-list btn-xs btn-sm btn-primary"></i></span></td>';                  
        }return $add_;}
catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }



 public function sLoan($loan_code,$loaner){$add_=''; $empty=0;
$stmt = $this->conn->prepare("SELECT * FROM compound where loaner='{$_SESSION['etcUser']}'and loan_code='$loan_code' and rock=1 ORDER BY id ASC ");
try { $stmt->execute();while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $add_.='<tr><td>bf: '.@$res['bf'].'<br/>'.@DateTime::createFromFormat('!m',(int)($res['month_paid']))->format('M').','.$res['year_paid'].'</td>
<td>Exp:'.$res['monthly_pay'].'<br/>Pd. &#8358;'.@$res['payment'].'</td>
<td>'.@number_format($res['balance']+@$res['diff']).'<br/>'.date('d/m/Y',@$res['date_paid']).'</td></tr>';}return $add_;}
catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());}
    }

// <th>#</th><th>B/F</th><td>M/Y</td>
// <td>Exp. Pay</td><td>Paid</td><th>Balance</th><th>Date</th>

 public function BigLoanList($loan_code,$loaner){$add_=''; $empty=1; 
 $addUp =0; $out = 0; $storeD ='';
$stmt = $this->conn->prepare("SELECT * FROM compound where loaner='{$_SESSION['etcUser']}'and loan_code='$loan_code' and rock=1 ORDER BY id ASC ");
try { $stmt->execute();while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $add_.='<tr><td>'.$empty.'</td><td>'.$res['bf'].'</td>
    <td>'.@DateTime::createFromFormat('!m',(int)($res['month_paid']))->format('M').','.$res['year_paid'].'</td>
<td>'.$res['monthly_pay'].'</td> <td>'.$res['payment'].'</td>
<td>'.@number_format($res['balance']+@$res['diff']).'</td><td>'.date('d/m/Y',@$res['date_paid']).'</td></tr>';$empty++; $addUp+=$res['payment']; $out=$res['balance']+@$res['diff']; $storeD=date('d/m/Y',@$res['date_paid']); }
$add_ .='<tr><td style="border:none"></td><td style="border:none"></td><td style="border:none"></td><td style="border:none"></td><th>&#8358;'.@number_format($addUp,2).'</th><th>&#8358;'.$out.'</th><th>'.$storeD.'</th></tr>';
return $add_;}
catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());}
    }


public function showLoan($loan_code){
$stmt = $this->conn->prepare("SELECT * FROM tabular where ledger_id='{$_SESSION['etcUser']}'and loan_code='$loan_code' ");try { $stmt->execute();
return $stmt->fetch(PDO::FETCH_ASSOC);
}catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
}
    }









    public function getHMOS($id){
         $this->conn = $this->connect();
    $stmt = $this->conn->prepare("SELECT * FROM nhis WHERE id ='$id' ");
    try{
        $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC);
    }catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function execQuery($code){
        $this->conn = $this->connect();
    $stmt = $this->conn->prepare("UPDATE focus_users SET user_login =user_current_in WHERE user_pin ='$code' ");
    $stmt->execute();
    $stmt = $this->conn->prepare("UPDATE focus_users SET user_current_in ='".time()."' WHERE user_pin ='$code' ");
     $stmt->execute();
    }

      public function insert($tableName, array $data)
    {
        $stmt = $this->conn->prepare("INSERT INTO $tableName (".implode(',', array_keys($data)).")
            VALUES (".implode(',', array_fill(0, count($data), '?')).")"
        );
        try{
            $stmt->execute(array_values($data));
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function delete($tableName, array $where)
    {
        $stmt = $this->conn->prepare("DELETE FROM $tableName WHERE ".key($where) . ' = ?');
        try {
            $stmt->execute(array(current($where)));
 
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }
     
     
    public function deleteQry($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

     public function _conditionQuery($table,$col,$val)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM $table WHERE $col $val ");
        try{ $stmt->execute();
            return $count = $stmt->fetchColumn();
        }catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
        
    }

      public function _m_conditionQuery($table,$col,$val,$col2,$val2)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM $table WHERE $col $val and `$col2` ='$val2' ");
        try{ $stmt->execute();
            return $count = $stmt->fetchColumn();
        }catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
        
    }


    public function update($tableName, array $set, array $where)
    {
        $arrSet = array_map(
           function($value) {
                return $value . '=:' . $value;
           },
           array_keys($set)
         );
             
        $stmt = $this->conn->prepare(
            "UPDATE $tableName SET ". implode(',', $arrSet).' WHERE '. key($where). '=:'. key($where) . 'Field'
         );
 
        foreach ($set as $field => $value) {
            $stmt->bindValue(':'.$field, $value);
        }
        $stmt->bindValue(':'.key($where) . 'Field', current($where));
        try {
            $stmt->execute();
 
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

     
    public function lastInsertId($param = null)
    {
        return $this->conn->lastInsertId($param);
    }
 

 public function getAllRecords($tableName, $fields='*', $cond='', $orderBy='', $limit='')
    {
        //echo "SELECT  $tableName.$fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." ".$limit;
        //print "<br>SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." ".$limit;
        $stmt = $this->conn->prepare("SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." ".$limit);
        //print "SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." " ;
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }


 

     
    public function getRecFrmQry($query)
    {
        //echo $query;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }


    public function getQueryDirect($query)
    {
        //echo $query;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }


 public function getQuerySpecs($col,$query)
    {$stmt = $this->conn->prepare($query);$stmt->execute();
      $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows[$col];
    }
    


    public function getRecFrmQryStr($query)
    {
        //echo $query;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return array();
    }
    public function getQueryCount($tableName, $field, $cond='')
    {
        $stmt = $this->conn->prepare("SELECT count($field) as total FROM $tableName WHERE 1 ".$cond);
        try {
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            if (! $res || count($res) != 1) {
               return $res;
            }
            return $res;
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

      

  


    public function get_acct_type($code){$stmt = $this->conn->prepare("SELECT * FROM account_type where id ='$code'  ");
try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res;} 
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


     public function treatmentStats($code){$stmt = $this->conn->prepare("SELECT * FROM appointment where code_set ='$code'  ");
try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res['pstatus'];} 
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


      public function get_swimmer(){$stmt = $this->conn->prepare("SELECT * FROM focus_swim ");
try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res;} 
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

     public function userAppt($code){$stmt = $this->conn->prepare("SELECT * FROM user_appt where user_code ='$code'  ");
try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res;} 
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


      public function get_unit_name($code){$stmt = $this->conn->prepare("SELECT unit_name FROM units where id ='$code'  ");
try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);return $res['unit_name'];} 
catch (\PDOException $e) {
    throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function iName($code){
        if(is_numeric($code)){
        $stmt = $this->conn->prepare("SELECT pname FROM patients where pcardno ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['pname'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }

    }else {
        return $code;
    }
    }


     public function pPhone($code){
        $stmt = $this->conn->prepare("SELECT ptel FROM patients where pcardno ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['ptel'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


      public function pImage($code){
        $stmt = $this->conn->prepare("SELECT pimage FROM patients where pcardno ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['pimage'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }







      public function staffOnline($code){
        $stmt = $this->conn->prepare("SELECT online FROM focus_users where user_pin ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['online'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function my_nhisNumber($code){
        $stmt = $this->conn->prepare("SELECT nhis_num FROM patients where pcardno ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['nhis_num'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


      public function get_nhis_status($code){
        $stmt = $this->conn->prepare("SELECT nhis_status FROM patients where pcardno ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['nhis_status'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


     public function getp_hmo($code){
        $stmt = $this->conn->prepare("SELECT nhmo FROM patients where pcardno ='$code'  ");
        try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['nhmo'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }



     public function uName($code){
        $stmt = $this->conn->prepare("SELECT username FROM focus_users where user_pin ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['username'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


      public function uImage($code){
        $stmt = $this->conn->prepare("SELECT user_image FROM focus_users where user_pin ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['user_image'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }



    public function _get_hmos($code){
        $stmt = $this->conn->prepare("SELECT * FROM nhis where id ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


     public function _get_hmo_name($code){
        $stmt = $this->conn->prepare("SELECT nhmo_name FROM nhis where id ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['nhmo_name'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


 



      public function getPatient($code){
        $stmt = $this->conn->prepare("SELECT * FROM patients WHERE pcardno ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
        
    }


    public function walletCode($code){
        $stmt = $this->conn->prepare("SELECT * FROM wallet WHERE code ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
        
    }


    public function getDiagnosis($code){
        $stmt = $this->conn->prepare("SELECT * FROM ward_1 WHERE code_ ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
        
    }


    


      public function get_dept_using_code($code){
        $stmt = $this->conn->prepare("SELECT * FROM dept where id ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['dept'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }





     public function get_dept_using_code_all($code){
        $stmt = $this->conn->prepare("SELECT sch_code FROM dept where id ='$code'  ");
        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['sch_code'];
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


  

//get total member Savings
    public function wallet($id){ 
$add_=$totalPaid =$pendingPay=$usedWallet=0; $totalSpent = 0;
$stmt = $this->conn->prepare("SELECT * FROM wallet where cardno='$id'   ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    if($res['item']==1 and strpos($res['item'],',')!=1){
$add_ +=$res['amount'];
//Get All Top up together
}
if($res['pay_method']=='Wallet'){ //Where payment option is wallet
 $usedWallet+=$res['amount'];   }
// if((int)$res['amount']<1 and $res['pay_method']!='NHIS'){ 
//     $pendingPay+=$res['amount'];   }
 }
$figure = $add_-$usedWallet;
if($figure<1){
    $totalPaid =0;
}else { $totalPaid =$figure; }
return $figure;
            }
            
        catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }





public function normaliseWallet($id){ $add_=$totalPaid =$pendingPay=$usedWallet=0; $totalSpent = 0;
$stmt = $this->conn->prepare("SELECT * FROM wallet where cardno='$id'   ");
        try {
            $stmt->execute();
            while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    if($res['item']==1 and strpos($res['item'],',')!=1){
$add_ +=$res['amount'];}

if($res['pay_method']=='Wallet'){ $usedWallet+=$res['amount'];   }

if((int)$res['amount']<1 and $res['pay_method']!='NHIS'){ $pendingPay+=$res['amount'];   }


 }
$figure = $add_-$usedWallet;
if($figure<1){
    $totalPaid =0;
}else { $totalPaid =$figure; }
return $figure;
            }
            
        catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }







    
    //get Total Items Loaded
    public function totalItemsLoaded($id){ $stPoint = 0; 
$stmt = $this->conn->prepare("SELECT * FROM pharmacy where set_code='$id'  ");
try {$stmt->execute();while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ $stPoint +=$res['item_qty'];}return $stPoint;
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    //Total Patient Debit by HMO
      public function total_hmo_spent($id){ $stPoint = 0; 
$stmt = $this->conn->prepare("SELECT * FROM wallet where pay_method='NHIS' and nhis_id ='$id'  ");
try {$stmt->execute();while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $stPoint +=$res['add_price'];



}return $stPoint/2;
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


// in_array(needle, haystack)
//CountSales
     //get Total Items Loaded
    public function countSales($id){ $stPoint = 0; 
$stmt = $this->conn->prepare("SELECT * FROM wallet  ");
try {$stmt->execute();while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        $expl = explode(',',$res['item']);
        $expl2 = explode(',',$res['desc_']);
        if(in_array($id,$expl) and $res['status']==1){
            $get_key = array_search($id,$expl);
            $get_count = $expl2[$get_key];
            $stPoint +=$get_count;
        }
}return $stPoint;
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
} }


//Loop Sales
  public function loopSales($id){ $stPoint = 1; $msg =''; 
$stmt = $this->conn->prepare("SELECT * FROM wallet ORDER BY id DESC  ");
try {$stmt->execute();while($res = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        $expl = explode(',',$res['item']);
        $expl2 = explode(',',$res['desc_']);
        $addPrice = explode(',',$res['add_price']);
        if(in_array($id,$expl)){
            $get_key = array_search($id,$expl); //get key
 $msg .='           
<tr><th>'.$stPoint++.'</th><th>'.$res['cardno'].'</th><th>'.$res['date_time'].'</th><th>'.$res['time_'].'</th>
<th>'.$expl2[$get_key].'</th><th>'.number_format($addPrice[$get_key],2).'</th>
<th>'.$res['pay_method'].'</th><th>'.$this->uName($res['biller']).'</th>
<th>'.$this->uName($res['entry_staff']).'</th></tr>';   
        }
}return $msg;
} catch (\PDOException $e) {throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
} }

  

    //get Last Savings
    public function getItemName($id){
$stmt = $this->conn->prepare("SELECT item_name FROM products where id='$id'  ");
        try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($res['item_name']);
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    //get Item Description
       public function getItemDesc($id){
$stmt = $this->conn->prepare("SELECT item_name FROM products where id='$id'  ");
        try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($res['item_name']);
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

//Last Savings
     public function lastSavingsTime($ledger_id){
$stmt = $this->conn->prepare("SELECT * FROM isavings where mledger='$ledger_id' and (m_status=4 || m_status=6) ORDER BY id DESC LIMIT 1  ");
        try {$stmt->execute();$res = $stmt->fetch(PDO::FETCH_ASSOC);
            return date('F d M, Y',$res['timefactor']);
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }




/**********Tuesday, 12th July, 2022 ***************/
public function spent($id){ $totalSpent = 0;
$stmt = $this->conn->prepare("SELECT * FROM wallet where cardno='$id' and status=1 
    and (pay_method='NHIS' || pay_method='Wallet') ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  $totalSpent+=$res['amount'];   }
return $totalSpent;
}
catch (\PDOException $e) { throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function debt($id){ $debt = 0;
$stmt = $this->conn->prepare("SELECT * FROM wallet where cardno='$id' and status=0  ");
try { $stmt->execute();
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  $debt+=$res['amount'];   }
return $debt;
}
catch (\PDOException $e) { throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }









}




?>