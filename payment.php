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
          <div class="payment">
            <h2>Choose Pament Option</h2>
            <a href="paymentoffline.php">Offline Payment</a>
            <a href="online.php">Online Payment</a>
          </div>
          <div class="back"><a href="cart.php">Previous</a></div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>