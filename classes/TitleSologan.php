<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 

/**
* TitleSologan class
*/
class TitleSologan{
 	
 	private $db;
	private $fm;
	public function __construct()
	{
	 $this->db = new Database();
	 $this->fm = new Format();
	}

	public function titleSologanUpdate($data, $file){
      $title  = $this->fm->validation($data['title']);
      $slogan = $this->fm->validation($data['slogan']);
      
      $title  = mysqli_real_escape_string($this->db->link, $title);
      $slogan = mysqli_real_escape_string($this->db->link, $slogan);

      $permited  = array('png');
      $file_name = $file['image']['name'];
      $file_size = $file['image']['size'];
      $file_temp = $file['image']['tmp_name'];

      $div = explode('.', $file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
      $uploded_image = "upload/logo/".$unique_image;

      if ($title == '' || $slogan == '' ) {
      	$msg = "<span class='error'>Fields Must Not be Empty!</span>";
      	return $msg;
      }else{
      	if (!empty($file_name)) {
      		if ($file_size >1048576) {
      			$msg = "<span class='error'>Image Size Should be less then 1MB.</span>";
      			return $msg;
      		}elseif(in_array($file_ext, $permited) === false){
               $msg = "<span class='error'>You Can Upload Only:-".implode(", ", $permited)."</span>";
               return $msg;
      		}else{
      			move_uploaded_file($file_temp, $uploded_image);

      			$query = "UPDATE tbl_titleslogan
                                SET
                                title  = '$title',
                                slogan = '$slogan',
                                image  = '$uploded_image'
                                WHERE id = '1'";
                   $updateTitles = $this->db->update($query);
                   if ($updateTitles) {
                   	$msg = "<span class='success'>Updated Successfuly!</span>";
                   	return $msg;
                   }else{
                   	$msg = "<span class='error'>Not Updated!</span>";
                   	return $msg;
                   }

      		}
      	} else{

      		$query = "UPDATE tbl_titleslogan 
      		          SET
      		          title  = '$title',
      		          slogan = '$slogan'
      		          WHERE id = '1'";
      		$updateData = $this->db->update($query);
      		if ($updateData) {
      			$msg = "<span class='success'>Updated Successfuly!</span>";
      			return $msg;
      		}else{
      			$msg = "<span class='error'>Not Updated!</span>";
      			return $msg;
      		}

      	}
      }

	}

	public function titleSloganSelect(){
		$query = "SELECT * FROM tbl_titleslogan WHERE id = '1'";
		$result = $this->db->select($query);
		return $result;
	} 

}