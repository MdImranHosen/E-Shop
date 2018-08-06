<?php include 'inc/header.php'; ?>
<?php 
$searchid = mysqli_real_escape_string($db->link, $_GET['search']);
   if(!isset($searchid) || $searchid == NULL){
  	header('Location: 404.php');
  } else{
  	$search = $searchid;
  }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	          <?php
	           	            		
	             $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$search%' OR body LIKE '%$search%' OR searchtag LIKE '%$search%' ";

                 $post = $db->select($query);

		           if($post){

		           	while($result = $post->fetch_assoc()){		
               ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['image']; ?>" /></a>
					 <h2><?php echo $result['productName']; ?> </h2>
					 <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } }else{
					echo "<span style='color:green;font-size:18px;'>Products of this Category are not Available !</span>";
					} ?>
			</div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>

