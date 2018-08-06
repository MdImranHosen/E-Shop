<?php 
 include '../lib/Session.php'; 
 
 Session::checkSession();
 ?>
<?php include '../lib/Database.php'; ?>
<?php 
  $db = new Database();
?>
<?php
  if (!isset($_GET['delslider']) || $_GET['delslider'] == NULL ) {

    echo "<script>window.location = 'sliderlist.php';</script>";
  } else{
    $sliderid = $_GET['delslider'];
    $query = "select * from tbl_slider where id ='$sliderid'";
    $getdata = $db->select($query);
    if ($getdata) {
    	while ($delimg = $getdata->fetch_assoc()) {
    		$dellink = $delimg['image'];
    		unlink ($dellink);
    	}
    }
    $delquery = "delete from tbl_slider where id = '$sliderid'";
    $delData = $db->delete($delquery);
    if ($delData) {
    	echo "<script>window.location = 'sliderlist.php';</script>";
    } else{
    	echo "<script>alert('Data Not Deleted !');</script>";
    	echo "<script>window.location = 'sliderlist.php';</script>";
    }
  }
  ?>