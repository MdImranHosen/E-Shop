<?php include 'inc/header.php'; ?>
<?php 
 $login = Session::get("cuslogin");
 if ($login == false) {
 	header("Location:login.php");
 }
?>
<div class="main">
    <div class="content">
    	<div class="section group">
          <div class="success_msg">
            <h2>Success</h2>
            <?php
            $cmrId = Session::get("cmrId");
            $amount = $ct->payableAmount($cmrId);
            if ($amount) {
              $sum = 0;
              while ($result = $amount->fetch_assoc()) {
                $price = $result['price'];
                $sum   = $sum+$price;
              }
            }
             ?>
            <p style="color:red;">Total payable Amount (Including Vat) : $<?php 
                $vat   = $sum * 0.1;
                $total = $sum+$vat;
                echo $total;
            ?></p>
            <p>Thanks for Purchase. Recevie Your Order Successfully. We will contact you ASAP with delivery details. Here is your order details.....<a href="orderdetails.php">Visit here</a> !</p>
          </div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>