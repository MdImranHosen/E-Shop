<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
 class Product{
 	
 	private $db;
	private $fm;
	public function __construct(){
	 $this->db = new Database();
	 $this->fm = new Format();
	}
	public function productInsert($data, $file){
        $productName = $this->fm->validation($data['productName']);
        $catId       = $this->fm->validation($data['catId']);
        $brandId     = $this->fm->validation($data['brandId']);
        $body        = $this->fm->validationbody($data['body']);
        $price       = $this->fm->validation($data['price']);
        $type        = $this->fm->validation($data['type']);
        $searchtag   = $this->fm->validation($data['searchtag']);

		$productName = mysqli_real_escape_string($this->db->link, $productName);
		$catId       = mysqli_real_escape_string($this->db->link, $catId);
		$brandId     = mysqli_real_escape_string($this->db->link, $brandId);
		$body        = mysqli_real_escape_string($this->db->link, $body);
		$price       = mysqli_real_escape_string($this->db->link, $price);
		$type        = mysqli_real_escape_string($this->db->link, $type);
		$searchtag   = mysqli_real_escape_string($this->db->link, $searchtag);

		$permited    = array('jpg', 'png', 'gif', 'jpeg');
	    $file_name   = $file['image']['name'];
	    $file_size   = $file['image']['size'];
	    $file_temp   = $file['image']['tmp_name'];

	    $div         = explode('.', $file_name);
	    $file_ext    = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName == '' || $catId == '' || $brandId == '' || $body == '' || $price == '' || $file_name == '' || $type == '' || $searchtag == '' ) {
	    	$productmsg = "<span class='error'> Fields must not be Empty !</span>";
			return $productmsg;
	    }elseif ($file_size > 1048576) {
            $productmsg = "<span class='error'>Image Size Should be less then 1MB !</span>";
            return $productmsg;
          }elseif (in_array($file_ext, $permited) === false) {
           $productmsg = "<span class='error'>You can uploads only:-".implode(', ', $permited)."</span>";
           return $productmsg;
          } else{
	    move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type,searchtag) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type','$searchtag')";
        $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
        	$productmsg = "<span class='success'>Product Inserted Successfully!</span>";
				return $productmsg;
        }else{
        	$productmsg = "<span class='error'>Product Not Inserted !</span>";
				return $productmsg;
        }

	    }
        

	}
	/*
	public function getAllProduct(){
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
		FROM tbl_product
		INNER JOIN tbl_category
		ON tbl_product.catId = tbl_category.catId
		INNER JOIN tbl_brand
		ON tbl_product.brandId = tbl_brand.brandId
		ORDER BY tbl_product.productId DESC";
		$result = $this->db->select($query);
		return $result;
	} */

	public function getAllProduct(){
		$query = "SELECT p.*, c.catName, b.brandName
		        FROM tbl_product as p,  tbl_category as c, tbl_brand as b
		        WHERE p.catId = c.catId AND p.brandId = b.brandId
                ORDER BY p.productId DESC ";
                $result = $this->db->select($query);
                return $result;
	}
	public function getProById($id){
		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function productUpdate($data, $file, $id){
        $productName = $this->fm->validation($data['productName']);
        $catId       = $this->fm->validation($data['catId']);
        $brandId     = $this->fm->validation($data['brandId']);
        $body        = $this->fm->validationbody($data['body']);
        $price       = $this->fm->validation($data['price']);
        $type        = $this->fm->validation($data['type']);
        $searchtag   = $this->fm->validation($data['searchtag']);

		$productName = mysqli_real_escape_string($this->db->link, $productName);
		$catId       = mysqli_real_escape_string($this->db->link, $catId);
		$brandId     = mysqli_real_escape_string($this->db->link, $brandId);
		$body        = mysqli_real_escape_string($this->db->link, $body);
		$price       = mysqli_real_escape_string($this->db->link, $price);
		$type        = mysqli_real_escape_string($this->db->link, $type);
		$searchtag   = mysqli_real_escape_string($this->db->link, $searchtag);

		$permited    = array('jpg', 'png', 'gif', 'jpeg');
	    $file_name   = $file['image']['name'];
	    $file_size   = $file['image']['size'];
	    $file_temp   = $file['image']['tmp_name'];

	    $div         = explode('.', $file_name);
	    $file_ext    = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName == '' || $catId == '' || $brandId == '' || $body == '' || $price == '' || $type == '' || $searchtag == '' ) {
	    	$productmsg = "<span class='error'> Fields must not be Empty !</span>";
			return $productmsg;
	    }else{

	     if (!empty($file_name)) {


	    if ($file_size > 1048576) {
            $productmsg = "<span class='error'>Image Size Should be less then 1MB !</span>";
            return $productmsg;
          }elseif (in_array($file_ext, $permited) === false) {
           $productmsg = "<span class='error'>You can uploads only:-".implode(', ', $permited)."</span>";
           return $productmsg;
          } else{
	    move_uploaded_file($file_temp, $uploaded_image);

        $query = "UPDATE tbl_product
                    SET
                    productName = '$productName',
                    catId       = '$catId',
                    brandId     = '$brandId',
                    body        = '$body',
                    price       = '$price',
                    image       = '$uploaded_image',
                    type        = '$type',
                    searchtag   = '$searchtag'
                    WHERE  productId = '$id'";
        $update_row = $this->db->update($query);
        if ($update_row) {
        	$productmsg = "<span class='success'>Product Updated Successfully!</span>";
				return $productmsg;
        }else{
        	$productmsg = "<span class='error'>Product Not Updated !</span>";
				return $productmsg;
        }
        }
       } else{

        $query = "UPDATE tbl_product
                    SET
                    productName = '$productName',
                    catId       = '$catId',
                    brandId     = '$brandId',
                    body        = '$body',
                    price       = '$price',
                    type        = '$type',
                    searchtag   = '$searchtag'
                    WHERE productId = '$id'";
        $update_row = $this->db->update($query);
        if ($update_row) {
        	$productmsg = "<span class='success'>Product Updated Successfully!</span>";
				return $productmsg;
        }else{
        	$productmsg = "<span class='error'>Product Not Updated !</span>";
				return $productmsg;
        }
    }

           }

   }
	   public function delProductById($id){
	   	$delquery = "SELECT * FROM tbl_product WHERE productId='$id'";
	   	$getdata = $this->db->select($delquery);
	   	if ($getdata) {
	   		while ($delimg = $getdata->fetch_assoc()) {
	   			 $dellink = $delimg['image'];
	   			unlink ($dellink);
	   		}
	   	}
	   	$query = "delete from tbl_product where productId='$id'";
	   	$data  = $this->db->delete($query);
	   	if ($data) {
	   		$delmsg = "<span class='success'>Product deleted Successfully !</span>";
	   		return $delmsg;
	   	}else{
	   		$delmsg = "<span class='error'>Product Not Deleted !</span>";
	   		return $delmsg;
	   	}
	   }
	   public function getFeaturedProduct(){
	   	$query = "SELECT * FROM tbl_product WHERE type='1' ORDER BY productId DESC LIMIT 4";
	   	$result = $this->db->select($query);
	   	return $result;
	   }
	   public function getNewdProduct(){
	   	$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
	   	$result = $this->db->select($query);
	   	return $result;
	   }
	public function getSingleProduct($id){
		$query = "SELECT p.*, c.catName, b.brandName
		        FROM tbl_product as p,  tbl_category as c, tbl_brand as b
		        WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$id'";
                $result = $this->db->select($query);
                return $result;
	}
	public function latestFromIphon(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
	   	$result = $this->db->select($query);
	   	return $result;
	}
	public function latestFromSamsung(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
	   	$result = $this->db->select($query);
	   	return $result;
	}
	public function latestFromAcer(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
	   	$result = $this->db->select($query);
	   	return $result;
	}
	public function latestFromCanon(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
	   	$result = $this->db->select($query);
	   	return $result;
	}
	public function productByCat($id){
		$catId  = mysqli_real_escape_string($this->db->link, $id);
		$query  = "SELECT * FROM tbl_product WHERE catId = '$catId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function insertCompearData($cmrpid, $cmrId){
		$cmrId      = mysqli_real_escape_string($this->db->link, $cmrId);
		$productId = mysqli_real_escape_string($this->db->link, $cmrpid);

		$cquery = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId = '$productId'";
		$check = $this->db->select($cquery);
		if ($check) {
			$msg = "<span class='error'>Already Added !</span>";
	   		return $msg;
		}

		$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		$result = $this->db->select($query)->fetch_assoc();
		if ($result) {
				$productId   = $result['productId'];
				$productName = $result['productName'];
				$price       = $result['price'];
				$image       = $result['image'];
		$query = "INSERT INTO tbl_compare(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
        $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
	   		$msg = "<span class='success'>Added ! Check Compare Page.</span>";
	   		return $msg;
	   	}else{
	   		$msg = "<span class='error'>Not Added !</span>";
	   		return $msg;
	   	}
			
		}
	}
	public function getCompareData($cmrId){
		$query = "SELECT * FROM tbl_compare WHERE cmrId='$cmrId' ORDER BY id";
		$result = $this->db->select($query);
		return $result;
	}
	public function delCompareData($cmrId){
		$delquery = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId'";
		$result = $this->db->delete($delquery);
		return $result;
	}
	public function saveWishListData($id, $cmrId){
		$id      = mysqli_real_escape_string($this->db->link, $id);
		$cmrId = mysqli_real_escape_string($this->db->link, $cmrId);

		$dquery = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$id'";
		$check = $this->db->select($dquery);
		if ($check) {
			$msg = "<span class='error'>Already Wish List !</span>";
	   		return $msg;
		}

		$pquery = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($pquery)->fetch_assoc();
		if ($result) {
				$productId   = $result['productId'];
				$productName = $result['productName'];
				$price       = $result['price'];
				$image       = $result['image'];
		$query = "INSERT INTO tbl_wlist(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
        $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
	   		$msg = "<span class='success'>Added ! Check Whish List Page.</span>";
	   		return $msg;
	   	}else{
	   		$msg = "<span class='error'>Not Added !</span>";
	   		return $msg;
	   	}
			
		}
	}
	public function chekWishList($cmrId){
		$query = "SELECT * FROM tbl_wlist WHERE cmrId='$cmrId' ORDER BY id";
		$result = $this->db->select($query);
		return $result;
	}
	public function delWishListData($productId, $cmrId){
		$query = "DELETE FROM tbl_wlist WHERE productId = '$productId' AND cmrId='$cmrId'";
		$result = $this->db->delete($query);
		if ($result) {
	   		$msg = "<span class='success'>Product Removed Successfully !</span>";
	   		return $msg;
	   	}else{
	   		$msg = "<span class='error'>Not Removed !</span>";
	   		return $msg;
	   	}
	}
 }
?>