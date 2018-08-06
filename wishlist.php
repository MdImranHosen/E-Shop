<?php include 'inc/header.php'; ?>
<?php 
 $login = Session::get("cuslogin");
 if ($login == false) {
 	header("Location:login.php");
 }
?>
<?php
if (isset($_GET['delWishList'])) {
       $productId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delWishList']);
       $delProduct = $pd->delWishListData($productId, $cmrId);
  }
?>
<style type="text/css">
table.tblone img {
  height: 90px;
  width: 100px;
}
</style>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wish List</h2>
			    	 <?php
			    	   if (isset($delProduct)) {
			    	   	    echo $delProduct;
			    	   }
			    	 ?>
						<table class="tblone">
							<tr>
							    <th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							<?php 
							  $chekwlist = $pd->chekWishList($cmrId);
							  if ($chekwlist) {
							  	$i = 0;
							  	while ($result = $chekwlist->fetch_assoc()) {
							  	$i++;
							?>
							<tr>
							    <td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>$ <?php echo $result['price']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['image']; ?>"/></td>
								<td>
								  <a href="details.php?proid=<?php echo $result['productId']; ?>">Buy Now</a> ||
								  <a href="?delWishList=<?php echo $result['productId']; ?>">Remove</a>
								</td>
							</tr>
							<?php } } else{ ?>
                               <tr>
                                <td><?php echo 1; ?></td>
                               <td colspan="4"><span style='font-size:25px;font-width:bold;color:green;text-align:center;'>Wish List Product Empty !</span></td>
                               </tr>
							<?php } ?>
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft" style="width:100%;text-align:center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>

