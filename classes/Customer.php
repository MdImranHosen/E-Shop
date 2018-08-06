<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php  
 class Customer{
 	
 	private $db;
	private $fm;
	public function __construct()
	{
	 $this->db = new Database();
	 $this->fm = new Format();
	}
	public function getCustomerRegister($data){
     $name        = $this->fm->validation($data['name']);
     $address     = $this->fm->validation($data['address']);
     $city        = $this->fm->validation($data['city']);
     $country     = $this->fm->validation($data['country']);
     $zip_code    = $this->fm->validation($data['zip_code']);
     $email       = $this->fm->validation($data['email']);
     $phoneNumber = $this->fm->validation($data['phoneNumber']);
     $password    = $this->fm->validation($data['password']);

     $name = mysqli_real_escape_string($this->db->link, $name);
     $address = mysqli_real_escape_string($this->db->link, $address);      
     $city = mysqli_real_escape_string($this->db->link, $city);      
     $country = mysqli_real_escape_string($this->db->link, $country);      
     $zip_code = mysqli_real_escape_string($this->db->link, $zip_code);      
     $email = mysqli_real_escape_string($this->db->link, $email);      
     $phoneNumber = mysqli_real_escape_string($this->db->link, $phoneNumber);      
     $password = mysqli_real_escape_string($this->db->link, md5($password));      
     if ($name == '' || $address == '' || $city == '' || $country == '' || $zip_code == '' || $email == '' || $phoneNumber == '' || $password == '') {
	    	$msg = "<span class='error'> Fields must not be Empty !</span>";
			return $msg;
	    }
	  $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
	  $mailchk   = $this->db->select($mailquery);
	  if ($mailchk !=false) {
	  	$msg = "<span class='error'> Email alredy Exist !</span>";
			return $msg;
	  }else{
	  	$query = "INSERT INTO tbl_customer(name,address,city,country,zip_code,email,phoneNumber,password) VALUES('$name','$address','$city','$country','$zip_code','$email','$phoneNumber','$password')";
	  	$inserted_row = $this->db->insert($query);
	  	if ($inserted_row) {
	  		$msg = "<span class='success'>Customer Data Inserted Successfully!</span>";
				return $msg;
	  	}else{
	  		$msg = "<span class='error'>Customer Data Not Inserted !</span>";
				return $msg;
	  	}
	  }
	}
	public function customersLogin($data){
		$email       = $this->fm->validation($data['email']);
		$password    = $this->fm->validation($data['password']);
		$email = mysqli_real_escape_string($this->db->link, $email);
		$password = mysqli_real_escape_string($this->db->link, md5($password));
		if (empty($email) || empty($password)) {
			$msg = "<span class='error'> Fields must not be Empty !</span>";
			return $msg;
		}
		$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
		$custLogin = $this->db->select($query);
		if ($custLogin !=false) {
			$result = $custLogin->fetch_assoc();
				Session::set("cuslogin", true);
				Session::set("cmrId", $result['customerId']);
				Session::set("cmrName", $result['name']);
				header("Location:cart.php");
			} else{
				$msg = "<span class='error'>Email or Password not matched !</span>";
				return $msg;
			}
		}
		public function getCustomerData($id){
			$query  = "SELECT * FROM tbl_customer WHERE customerId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function customerUpdate($data, $cmrId){
         $name        = $this->fm->validation($data['name']);
	     $address     = $this->fm->validation($data['address']);
	     $city        = $this->fm->validation($data['city']);
	     $country     = $this->fm->validation($data['country']);
	     $zip_code    = $this->fm->validation($data['zip_code']);
	     $phoneNumber = $this->fm->validation($data['phoneNumber']);

	     $name = mysqli_real_escape_string($this->db->link, $name);
	     $address = mysqli_real_escape_string($this->db->link, $address);      
	     $city = mysqli_real_escape_string($this->db->link, $city);      
	     $country = mysqli_real_escape_string($this->db->link, $country);      
	     $zip_code = mysqli_real_escape_string($this->db->link, $zip_code);      
	     $phoneNumber = mysqli_real_escape_string($this->db->link, $phoneNumber);      
	     if ($name == '' || $address == '' || $city == '' || $country == '' || $zip_code == '' || $phoneNumber == '' ) {
		    	$msg = "<span class='error'> Fields must not be Empty !</span>";
				return $msg;
		    }else{
		  	$query = "UPDATE tbl_customer
		  	           SET
		  	           name        = '$name',
		  	           address     = '$address',
		  	           city        = '$city',
		  	           country     = '$country',
		  	           zip_code    = '$zip_code',
		  	           phoneNumber = '$phoneNumber'
		  	           WHERE customerId = '$cmrId'";
		  	$inserted_row = $this->db->update($query);
		  	if ($inserted_row) {
		  		$msg = "<span class='success'>Customer Data Updated Successfully!</span>";
					return $msg;
		  	}else{
		  		$msg = "<span class='error'>Customer Data Not Updated !</span>";
					return $msg;
		  	}
		  }
		}
		public function getCustomerById($id){
			$query  = "SELECT * FROM tbl_customer WHERE customerId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
 }
?>