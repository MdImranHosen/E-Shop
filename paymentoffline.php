<?php include 'inc/header.php'; ?>
<?php 
 $login = Session::get("cuslogin");
 if ($login == false) {
 	header("Location:login.php");
 }
?>
<?php 
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
  $cmrId = Session::get("cmrId");
  $insertorder = $ct->orderProduct($cmrId);
  $delData = $ct->delCustomerCart();
  header("Location:success.php");
}
?>
<div class="main">
    <div class="content">
    	<div class="section group">
          <div class="division">
            <table class="tblone">
              <tr>
                <th>No</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
              </tr>
              <?php 
                $getPro = $ct->getCartProduct();
                if ($getPro) {
                  $i = 0;
                  $sum = 0;
                  $qty = 0;
                  while ($result = $getPro->fetch_assoc()) {
                  $i++;
              ?>
              <tr>
                  <td><?php echo $i; ?></td>
                <td><?php echo $result['productName']; ?></td>
                <td>$<?php echo $result['price']; ?></td>
                <td><?php echo $result['quantity']; ?></td>
                <td>$<?php 
                 $total = $result['price'] * $result['quantity'];
                echo $total; ?></td>
              </tr>
              <?php
               $qty = $qty + $result['quantity'];
               $sum = $sum + $total;
              ?>
              <?php } } ?>
            </table>
            <table class="tbltwo">
              <tr>
                <td>Sub Total </td>
                <td> : </td>
                <td>$ <?php echo $sum; ?></td>
              </tr>
              <tr>
                <td>VAT </td>
                <td> : </td>
                <td>10% ($ <?php echo $vat = $sum * 0.1; ?>)</td>
              </tr>
              <tr>
                <td>Grand Total :</td>
                <td> : </td>
                <td>$ <?php 
                 $vat = $sum * 0.1;
                 $gtotal = $sum + $vat;
                 echo $gtotal;
                ?> </td>
              </tr>
              <tr>
                <td>Quantity </td>
                <td> : </td>
                <td><?php echo $qty; ?></td>
              </tr>
             </table>
          </div>
          <div class="division">
      <?php 
        $id = Session::get("cmrId");
        $getdata = $cmr->getCustomerData($id);
        if ($getdata) {
          while ($result = $getdata->fetch_assoc()) { ?>
         <table class="tbl_profile">
            <tr>
              <td colspan="3"><h2>Your Profile Details</h2></td>
            </tr>
            <tr>
              <td width="20%">Name</td>
              <td width="5%"> : </td>
              <td><?php echo $result['name']; ?></td>
            </tr>
            <tr>
              <td width="20%">Phone</td>
              <td width="5%"> : </td>
              <td><?php echo $result['phoneNumber']; ?></td>
            </tr><tr>
              <td width="20%">E-mail</td>
              <td width="5%"> : </td>
              <td><?php echo $result['email']; ?></td>
            </tr><tr>
              <td width="20%">Address</td>
              <td width="5%"> : </td>
              <td><?php echo $result['address']; ?></td>
            </tr><tr>
              <td width="20%">City</td>
              <td width="5%"> : </td>
              <td><?php echo $result['city']; ?></td>
            </tr><tr>
              <td width="20%">Zip-Code</td>
              <td width="5%"> : </td>
              <td><?php echo $result['zip_code']; ?></td>
            </tr><tr>
              <td width="20%">Country</td>
              <td width="5%"> : </td>
              <td><?php echo $result['country']; ?></td>
            </tr><tr>
              <td width="20%"></td>
              <td width="5%"></td>
              <td><a href="editprofile.php">Update Profile</a></td>
            </tr>
         </table>
         <?php } } ?>
          </div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <div class="ordernow">
   <a href="?orderid=order">Order</a>
 </div>
</div>
<?php include 'inc/footer.php'; ?>