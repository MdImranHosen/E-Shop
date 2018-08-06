<?php
$filepath = realpath(dirname(__FILE__));                
include_once ($filepath.'/../classes/Customer.php');
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 

  if (!isset($_GET['custId']) || $_GET['custId'] == NULL) {
     echo "<script>window.location = 'inbox.php'; </script>";
  }else{
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php'; </script>";
  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock">
               <?php
               $cus = new Customer();
                $getCustomer = $cus->getCustomerById($id);
                if ($getCustomer) {
                  while ($result = $getCustomer->fetch_assoc()) { ?>
                   
                
                 <form action="" method="post">
                    <table class="form">					
                        <tr> 
                            <td>Name</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['name']; ?>" class="medium" /></td>
                        </tr>
                        <tr> 
                            <td>Address</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['address']; ?>" class="medium" /></td>
                        </tr>
                        <tr> 
                            <td>City</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['city']; ?>" class="medium" /></td>
                        </tr>
                        <tr> 
                            <td>Country</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['country']; ?>" class="medium" /></td>
                        </tr>
                        <tr> 
                            <td>Zip Code</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['zip_code']; ?>" class="medium" /></td>
                        </tr>
                        <tr> 
                            <td>Phone</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['phoneNumber']; ?>" class="medium" /></td>
                        </tr>
                        <tr> 
                            <td>E-mail</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $result['email']; ?>" class="medium" /></td>
                        </tr>
						             <tr> 
                            <td></td>
                            <td>
                                <input type="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
                     <?php }  }  ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>