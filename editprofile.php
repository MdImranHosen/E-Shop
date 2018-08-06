<?php include 'inc/header.php'; ?>
<?php 
 $login = Session::get("cuslogin");
 if ($login == false) {
 	header("Location:login.php");
 }
?>
<style type="text/css">
.tblone{width:550px;margin:0 auto;border:2px solid #ddd;}
.tblone tr td{text-align: justify;}
table.tblone input[type="text"]{width:400px;padding:5px;font-size:15px;}
</style>
<?php 
   $cmrId = Session::get("cmrId");
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
       $updateCustomer = $cmr->customerUpdate($_POST, $cmrId);
   }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    	<?php 
    	  $id = Session::get("cmrId");
    	  $getdata = $cmr->getCustomerData($id);
    	  if ($getdata) {
    	  	while ($result = $getdata->fetch_assoc()) { ?>
            <form action="" method="post">
    	   <table class="tblone">
             <?php if (isset($updateCustomer)) {
                echo "<tr><td colspan='3'><h2>".$updateCustomer."</h2></td></tr>";
             } ?>
    	      <tr><td colspan="3"><h2>Update Profile Details</h2></td></tr>
    	   	  <tr>
    	   	  	<td width="20%">Name</td>
    	   	  	<td width="5%"> : </td>
    	   	  	<td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
    	   	  </tr>
    	   	  <tr>
    	   	  	<td width="20%">Phone</td>
    	   	  	<td width="5%"> : </td>
    	   	  	<td><input type="text" name="phoneNumber" value="<?php echo $result['phoneNumber']; ?>"></td>
    	   	  </tr><tr>
    	   	  	<td width="20%">E-mail</td>
    	   	  	<td width="5%"> : </td>
    	   	  	<td><?php echo $result['email']; ?></td>
    	   	  </tr><tr>
    	   	  	<td width="20%">Address</td>
    	   	  	<td width="5%"> : </td>
    	   	  	<td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
    	   	  </tr><tr>
    	   	  	<td width="20%">City</td>
    	   	  	<td width="5%"> : </td>
    	   	  	<td><input type="text" name="city" value="<?php echo $result['city']; ?>"></td>
    	   	  </tr><tr>
    	   	  	<td width="20%">Zip-Code</td>
    	   	  	<td width="5%"> : </td>
    	   	  	<td><input type="text" name="zip_code" value="<?php echo $result['zip_code']; ?>"></td>
    	   	  </tr><tr>
    	   	  	<td width="20%">Country</td>
    	   	  	<td width="5%"> : </td>
    	   	  	<td><input type="text" name="country" value="<?php echo $result['country']; ?>"></td>
    	   	  </tr><tr>
    	   	  	<td width="20%"></td>
    	   	  	<td width="5%"></td>
    	   	  	<td><input type="submit" name="submit" value="Update"></td>
    	   	  </tr>
    	   </table>
           </form>
    	   <?php } } ?>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>