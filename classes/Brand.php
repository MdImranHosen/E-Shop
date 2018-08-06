<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
 class Brand{
 	
 	private $db;
	private $fm;
	public function __construct()
	{
	 $this->db = new Database();
	 $this->fm = new Format();
	}
	public function brandInsert($brandName){
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
		if (empty($brandName)) {
			$brandmsg = "<span class='error'>Brand Field must not be Empty !</span>";
			return $brandmsg;
		}else{
			$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
			$brandinsert = $this->db->insert($query);
			if ($brandinsert) {
				$brandmsg = "<span class='success'>Brand Inserted Successfully!</span>";
				return $brandmsg;
			} else{
				$brandmsg = "<span class='error'>Brand Not Inserted !</span>";
				return $brandmsg;
			}
		}
	}
		public function getAllBrand(){
		$query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$result = $this->db->select($query);
		return  $result;
	}
	    public function getBrandById($id){
		$query = "SELECT * FROM tbl_brand WHERE brandId='$id'";
		$result = $this->db->select($query);
		return $result;
	}
		public function brandUpdate($brandName, $id){
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
		$id = mysqli_real_escape_string($this->db->link, $id);
		if (empty($brandName)) {
			$brandmsg = "<span class='error'>Brand Field must not be Empty !</span>";
			return $brandmsg;
	}else{
		$query = "UPDATE tbl_brand
		         SET 
		         brandName     = '$brandName'
		         WHERE brandId = '$id'";
		         $update_row = $this->db->update($query);
		        if ($update_row) {
		        	$brandmsg = "<span class='success'>Brand Updated Successfully!</span>";
				    return $brandmsg;
		        }else{
		        	$brandmsg = "<span class='error'>Brand not Updated!</span>";
			        return $brandmsg;
		        }
	}
 }
	 public function delBrandById($id){
 	$query = "delete from tbl_brand where brandId = '$id'";
 	$deldata = $this->db->delete($query);
 	if ($deldata) {
 		$delmsg = "<span class='success'>Brand Delete Successfully!</span>";
 		return $delmsg;
 	}else{
 		$delmsg = "<span class='error'>Brand Not Deleted ! </span>";
 		return $delmsg;
 	}
 }
 }
?>