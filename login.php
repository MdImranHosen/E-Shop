<?php include 'inc/header.php'; ?>
<?php 
 $login = Session::get("cuslogin");
 if ($login == true) {
 	header("Location:order.php");
 }
?>
<?php 
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
   	$custLogin = $cmr->customersLogin($_POST);
   }
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php 
        	 if (isset($custLogin)) {
        	 	echo $custLogin;
        	 }
        	?>
        	<form action="" method="post">
                	<input name="email" type="text" placeholder="Enter Your E-Mail" class="field">
                    <input name="password" type="password" placeholder="Enter Your Password" class="field">
            <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
            </form>
         </div>
     		<?php 
              if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
              	$insertCustomer = $cmr->getCustomerRegister($_POST);
              }
    		?>                   
    	<div class="register_account">
    		<h3>Register New Account</h3>
            <?php if (isset($insertCustomer)) {
            	echo $insertCustomer;
            } ?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zip_code" placeholder="Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="E-Mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<input type="text" name="country" placeholder="Country">
					</div>
		           <div>
		             <input type="text" name="phoneNumber" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>

