<?php include 'inc/header.php'; ?>
<?php 
 $login = Session::get("cuslogin");
 if ($login == false) {
 	header("Location:login.php");
 }
?>
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
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
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>