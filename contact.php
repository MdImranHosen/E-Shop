<?php include 'inc/header.php'; ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	 $insertData = $con->contactInsert($_POST);
}
?>
 <div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<h3>Live Support</h3>
  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
  				<p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
  			</div>
  				<img src="images/contact.png" alt="" />
  			<div class="clear"></div>
  		</div>
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">

				  	<h2>Contact Us</h2>
				  	<?php 
                       if (isset($insertData)) {
                       	echo $insertData;
                       }
				  	?>
					    <form action="contact.php" method="post">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" name="name" placeholder="Enter Your Name.." required="1"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" name="email" placeholder="Enter E-mail.." required="1"></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" name="phone" placeholder="Phone Number.." required="1"></span>
						    </div>
						    <div>
						    	<span><label>Message</label></span>
						    	<span><textarea name="message"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT"></span>
						  </div>
					    </form>
				  </div>
  				</div>
				<div class="col span_1_of_3">
      			<div class="company_address">
				     	<h2>Company Information :</h2>
						    	<p>Sonline Shop Bd,</p>
						   		<p>Mirpur1, Dhaka</p>
						   		<p>Bangladesh</p>
				   		<p>Phone:(+880) 198 391 2645</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>imranhossen5912@gmail.com</span></p>
				   		<p>Follow on: <span>

                 <iframe src="https://www.facebook.com/plugins/follow?href=https%3A%2F%2Fwww.facebook.com%2Fimranhosen.up&amp;layout=standard&amp;show_faces=true&amp;colorscheme=light&amp;width=450&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowTransparency="true"></iframe></p>
				   </div>
				 </div>
			  </div>    	
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>

