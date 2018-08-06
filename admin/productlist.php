<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php'; 
 include '../classes/Product.php';
 include_once '../helpers/Format.php';
 ?>
 <?php 
 $pd = new Product();
 $fm = new Format();
 ?>
 <?php 
   if (isset($_GET['productDel'])) {
   	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productDel']);
   	  $delProduct = $pd->delProductById($id);
   }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
        <?php if (isset($delProduct)) {
                	echo $delProduct;
                } ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			  $getpb = $pd->getAllProduct();
			  if ($getpb) {
			  	 $i = 0;
			  	while ($result = $getpb->fetch_assoc()) { 
			  	 $i++;
			  	?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['brandName']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 50 ); ?></td>
					<td>$<?php echo $result['price']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" width='60px' height='50px;'></td>
					<td>
					  <?php 
                         if ($result['type'] == 1) {
                         	echo 'Featured';
                         } elseif ($result['type'] == 2) {
                         	echo 'General';
                         }
					   ?>
					  </td>
					<td><a href="productedit.php?productid=<?php echo $result['productId']; ?>">Edit</a> || <a onclick="return confirm('Are you Sure to Delete!')" href="?productDel=<?php echo $result['productId']; ?>">Delete</a></td>
				</tr>
            	<?php }  } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
