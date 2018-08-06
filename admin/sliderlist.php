<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../lib/Database.php'; ?>
<?php 
  $db = new Database();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                <?php 
                  $sql = "SELECT * FROM tbl_slider";
                  $slider = $db->select($sql);
                  if ($slider) {
                  	$i = 0;
                  	while ($result = $slider->fetch_assoc()) {
                  	 $i++
                ?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"/></td>				
				<td>
					<a onclick="return confirm('Are you sure to Delete!');" href="deleteslider.php?delslider=<?php echo 
		 $result['id']; ?>" >Delete</a> 
				</td>
					</tr>
					<?php } } ?>
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
