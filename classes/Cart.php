<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php  
 class Cart{
 	
 	private $db;
	private $fm;
	public function __construct()
	{
	 $this->db = new Database();
	 $this->fm = new Format();
	}
	public function addToCart($quantity, $id){
		$quantity  = $this->fm->validation($quantity);
		$quantity  = mysqli_real_escape_string($this->db->link, $quantity);
		$productId = mysqli_real_escape_string($this->db->link, $id);
		$sId       = session_id();
		$squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		$result = $this->db->select($squery);
		if ($result) {
			while ($value  = $result->fetch_assoc()) {
              $productName = $value['productName'];
              $price       = $value['price'];
              $image       = $value['image'];
			}
		}
		$cquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
		$getPro = $this->db->select($cquery);
		if ($getPro) {
			$msg = "Product Already added !";
			return $msg;
		}else{

		$query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
        $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
        	header("Location:cart.php");
        }else{
        	header("Location:404.php");
        }
    }
	}
	public function getCartProduct(){
		$sId       = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function updateToCartQuantity($cartId, $quantity){
		$cartId   = mysqli_real_escape_string($this->db->link, $cartId);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$query = "UPDATE tbl_cart
		         SET 
		         quantity     = '$quantity'
		         WHERE cartId = '$cartId'";
		         $update_row  = $this->db->update($query);
		        if ($update_row) {
		        	header("Location:cart.php");
		        }else{
		        	$cartmsg = "<span class='error'>Quantity not Updated!</span>";
			        return $cartmsg;
		        }
	}
	public function delPorByCart($delId){
		$delId   = mysqli_real_escape_string($this->db->link, $delId);
		$query = "delete from tbl_cart where cartId='$delId'";
		$delpro = $this->db->delete($query);
		if ($delpro) {
			echo "<script>window.location = 'cart.php';</script>";
		}else{
			$msg = "<span class='error'>Product Not Deleted </span>";
			return $msg;
		}
	}
	public function checkCartTable(){
		$sId       = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function delCustomerCart(){
		$sId       = session_id();
		$query     = "DELETE FROM tbl_cart WHERE sId = '$sId'";
		$this->db->delete($query);
	}
	public function orderProduct($cmrId){
		$sId       = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$getpro = $this->db->select($query);
		if ($getpro) {
			while ($result = $getpro->fetch_assoc()) {
				$productId   = $result['productId'];
				$productName = $result['productName'];
				$quantity    = $result['quantity'];
				$price       = $result['price'] * $quantity;
				$image       = $result['image'];
		$query = "INSERT INTO tbl_order(cmrId,productId,productName,quantity,price,image) VALUES('$cmrId','$productId','$productName','$quantity','$price','$image')";
        $inserted_row = $this->db->insert($query);
			}
		}
	}
	public function payableAmount($cmrId){
	    $query = "SELECT price FROM tbl_order WHERE cmrId = '$cmrId' AND date = now()";
		$result = $this->db->select($query);
		return $result;
	}
	public function getOrderProduct($cmrId){
		$query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC";
		$result = $this->db->select($query);
		return $result;
	}
	public function checkOrderTable($cmrId){
		$query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function getAllOrderProduct(){
		$query = "SELECT * FROM tbl_order ORDER BY date";
		$result = $this->db->select($query);
		return $result;
	}
	public function getProductShift($id, $time, $price){
		$id     = mysqli_real_escape_string($this->db->link, $id);
		$time   = mysqli_real_escape_string($this->db->link, $time);
		$price  = mysqli_real_escape_string($this->db->link, $price);

		$query = "UPDATE tbl_order
		         SET 
		         status     = '1'
		         WHERE cmrId = '$id' AND date='$time' AND price='$price'";
		         $update_row = $this->db->update($query);
		        if ($update_row) {
		        	$catmsg = "<span class='success'>Updated Successfully!</span>";
				    return $catmsg;
		        }else{
		        	$catmsg = "<span class='error'>Not Updated!</span>";
			        return $catmsg;
		        }
	}
	public function getProductOrderDel($id, $time, $price){
		$id     = mysqli_real_escape_string($this->db->link, $id);
		$time   = mysqli_real_escape_string($this->db->link, $time);
		$price  = mysqli_real_escape_string($this->db->link, $price);

		$query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND date='$time' AND price='$price'";
		         $update_row = $this->db->delete($query);
		        if ($update_row) {
		        	$catmsg = "<span class='success'>Data Deleted Successfully!</span>";
				    return $catmsg;
		        }else{
		        	$catmsg = "<span class='error'>Data not Deleted!</span>";
			        return $catmsg;
		        }
	}
	public function getProductConfirm($id, $time, $price){
		$id     = mysqli_real_escape_string($this->db->link, $id);
		$time   = mysqli_real_escape_string($this->db->link, $time);
		$price  = mysqli_real_escape_string($this->db->link, $price);

		$query = "UPDATE tbl_order
		         SET 
		         status     = '2'
		         WHERE cmrId = '$id' AND date='$time' AND price='$price'";
		         $update_row = $this->db->update($query);
		        if ($update_row) {
		        	$catmsg = "<span class='success'>Updated Successfully!</span>";
				    return $catmsg;
		        }else{
		        	$catmsg = "<span class='error'>Not Updated!</span>";
			        return $catmsg;
		        }
	}
 }
?>