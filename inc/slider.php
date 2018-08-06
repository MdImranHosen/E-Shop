	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
			<?php 
			  $getIphone = $pd->latestFromIphon();
			  if ($getIphone) {
			  	while ($result = $getIphone->fetch_assoc()) {
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['image']; ?>" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } } ?>	
			    <?php 
				  $getSamsung = $pd->latestFromSamsung();
				  if ($getSamsung) {
				  	while ($result = $getSamsung->fetch_assoc()) {
			     ?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['image']; ?>" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p><?php echo $result['productName']; ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php } } ?>
			</div>
			<div class="section group">
			    <?php 
				  $getAcer = $pd->latestFromAcer();
				  if ($getAcer) {
				  	while ($result = $getAcer->fetch_assoc()) {
			     ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['productId']; ?>" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } } ?>	
			    <?php 
				  $getCanon = $pd->latestFromCanon();
				  if ($getCanon) {
				  	while ($result = $getCanon->fetch_assoc()) {
			     ?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['image']; ?>" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p><?php echo $result['productName']; ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php } } ?>	
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php 
				         $query = "select * from tbl_slider order by id limit 5";
				            $slider = $db->select($query);
				            if ($slider) {
				            	while ($result = $slider->fetch_assoc()) {
				          ?>
						<li><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" title="<?php echo $result['title']; ?>" /></li>
						 <?php } } ?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	