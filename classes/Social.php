<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
 class Social{
 	
 	private $db;
	private $fm;
	public function __construct(){
	 $this->db = new Database();
	 $this->fm = new Format();
	}

	public function getSocialById(){
		$query = "SELECT * FROM tbl_social_media WHERE id ='1'";
        $socialmedia = $this->db->select($query);
		return $socialmedia;
	} 
	public function socialUpdate($data){
        $fb  = $this->fm->validation($data['fb']);
        $tw  = $this->fm->validation($data['tw']);
        $gp  = $this->fm->validation($data['gp']);
        $em  = $this->fm->validation($data['em']);

		$fb  = mysqli_real_escape_string($this->db->link, $fb);
		$tw  = mysqli_real_escape_string($this->db->link, $tw);
		$gp  = mysqli_real_escape_string($this->db->link, $gp);
		$em  = mysqli_real_escape_string($this->db->link, $em);

	    if ($fb == '' || $tw == '' || $gp == '' || $em == '') {
	    	$msg = "<span class='error'> Fields must not be Empty !</span>";
			return $msg;
	    } else{

        $query = "UPDATE tbl_social_media
                    SET
                    fb = '$fb',
                    tw = '$tw',
                    gp = '$gp',
                    em = '$em'
                    WHERE id = '1'";
        $update_row = $this->db->update($query);
        if ($update_row) {
        	$msg = "<span class='success'>Updated Successfully!</span>";
				return $msg;
        }else{
        	$msg = "<span class='error'>Not Updated !</span>";
				return $msg;
        } 
          } 
       }

       public function getCopyright(){
       	$query = "SELECT * FROM tbl_copyright WHERE id ='1'";
       	$result = $this->db->select($query);
       	return $result;
       }

       public function copyrightUpdate($data){
        $copyright = $this->fm->validation($data['copyright']);
        $copyright = mysqli_real_escape_string($this->db->link, $copyright);
        if (empty($copyright)) {
        	$msg = "<span class='error'>Fields Must not be Empty</span>";
        	return $msg;
        }else{
        	$updateCopyright = "UPDATE tbl_copyright
        	                     SET
        	                     copyright = '$copyright'
        	                     WHERE id = '1'";
        	$updateresult = $this->db->update($updateCopyright);
        	if ($updateresult) {
        		$msg = "<span class='success'>Updated Successfully!</span>";
        		return $msg;
        	}else{
        		$msg = "<span class='error'>Not Updated</span>";
        		return $msg;
        	}
        }
       }
 }
?>