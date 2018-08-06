<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
 class Contact{
 	
 	private $db;
	private $fm;
	public function __construct()
	{
	 $this->db = new Database();
	 $this->fm = new Format();
	}
	public function contactInsert($data){
        $name     = $this->fm->validation($data['name']);
        $email    = $this->fm->validation($data['email']);
        $phone    = $this->fm->validation($data['phone']);
        $message  = $this->fm->validationbody($data['message']);

		$name     = mysqli_real_escape_string($this->db->link, $name);
		$email    = mysqli_real_escape_string($this->db->link, $email);
		$phone    = mysqli_real_escape_string($this->db->link, $phone);
		$message  = mysqli_real_escape_string($this->db->link, $message);

	    if ($name == '' || $email == '' || $phone == '' || $message == '' ) {
	    	$msg = "<span class='error'> Fields must not be Empty !</span>";
			return $msg;
	    }else{
        $query = "INSERT INTO tbl_contact(name,email,phone,message) VALUES('$name','$email','$phone','$message')";
        $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
        	$msg = "<span class='success'>Data Inserted Successfully!</span>";
				return $msg;
        }else{
        	$msg = "<span class='error'>Data Not Inserted !</span>";
				return $msg;
        }

	    }
        

	}



 }
?>