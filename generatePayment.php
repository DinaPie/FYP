<?php
//payment-ebook-generate-gateway-call.php

$fullName=$_POST['fullName'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$totPrice=$_POST['totPrice'];
//insert POST data ke tblorder
//$qinsorder=sqlquery("insert into tblorder (fullName, email, phone, totPrice, status, date) values (?,?,?,?,?,now())");
//$qinsorder->bindValue(1,$fullName);
//$qinsorder->bindValue(2,$email);
//$qinsorder->bindValue(3,$phone);
//$qinsorder->bindValue(4,$totPrice);
//$qinsorder->bindValue(5,0);
//$qinsorder->execute();
//get orderid
//$qgetoid=sqlquery("select id from tblorder order by id desc limit 1");
//$qgetoid->execute();
//$getoid = $qgetoid->fetch(PDO::FETCH_ASSOC);
//$oid=$getoid['id']; 
//convert RM1=100
$rmx100=($totPrice*100);
$some_data = array(
    'userSecretKey'=> 'azylqm6u-hszf-r54a-5z4f-qm7rutjlauto',
    'categoryCode'=> 'lxi61dri',
    'billName'=> 'Booking Payment',
    'billDescription'=> 'Total Payment: RM'.$totPrice,
    'billPriceSetting'=>1,
    'billPayorInfo'=>1,
    'billAmount'=>$rmx100,
    'billReturnUrl'=>'http://localhost/fyp/my_booking.php',
    'billCallbackUrl'=>'',
    'billExternalReferenceNo'=>'',
    'billTo'=>$fullName,
    'billEmail'=>$email,
    'billPhone'=>$phone,
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>0,
  );  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/createBill');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);
  $obj = json_decode($result,true);
  $billcode=$obj[0]['BillCode'];
?>
<!--SEND USER TO TOYYIBPAY PAYMENT-->
<script type="text/javascript">
    //redirect to payment gateway
   window.location.href="https://toyyibpay.com/<?php echo $billcode;?>"; 
 </script>
