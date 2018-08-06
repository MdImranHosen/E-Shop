<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php
class Category{
	
	private $db;
	private $fm;
	public function __construct()
	{
	 $this->db = new Database();
	 $this->fm = new Format();
	}

	public function catInsert($catName){
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		if (empty($catName)) {
			$catmsg = "<span class='error'>Category Field must not be Empty !</span>";
			return $catmsg;
		}else{
			$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
			$catinsert = $this->db->insert($query);
			if ($catinsert) {
				$catmsg = "<span class='success'>Category Inserted Successfully!</span>";
				return $catmsg;
			} else{
				$catmsg = "<span class='error'>Category Not Inserted !</span>";
				return $catmsg;
			}
		}
	}

	public function getAllcat(){
		$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
		$result = $this->db->select($query);
		return  $result;
	}
	public function getCatById($id){
		$query = "SELECT * FROM tbl_category WHERE catId='$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function catUpdate($catName, $id){
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$id = mysqli_real_escape_string($this->db->link, $id);
		if (empty($catName)) {
			$catmsg = "<span class='error'>Category Field must not be Empty !</span>";
			return $catmsg;
	}else{
		$query = "UPDATE tbl_category
		         SET 
		         catName     = '$catName'
		         WHERE catId = '$id'";
		         $update_row = $this->db->update($query);
		        if ($update_row) {
		        	$catmsg = "<span class='success'>Category Updated Successfully!</span>";
				    return $catmsg;
		        }else{
		        	$catmsg = "<span class='error'>Category not Updated!</span>";
			        return $catmsg;
		        }
	}
 }
 public function delCatById($id){
 	$query = "delete from tbl_category where catId = '$id'";
 	$deldata = $this->db->delete($query);
 	if ($deldata) {
 		$delmsg = "<span class='success'>Category Delete Successfully!</span>";
 		return $delmsg;
 	}else{
 		$delmsg = "<span class='error'>Category Not Deleted ! </span>";
 		return $delmsg;
 	}
 }

		
}
?>