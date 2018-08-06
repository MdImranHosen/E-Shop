<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
     $insertSocial = $so->socialUpdate($_POST);
 }
?>
<div class="grid_10">
<div class="box round first grid">
<h2>Update Social Media</h2>
<div class="block">
<?php 
 if (isset($insertSocial)) {
     echo $insertSocial;
 }
?>
<?php 
 $socialmedia = $so->getSocialById();
 
 if ($socialmedia) {
     while ($result = $socialmedia->fetch_assoc()) {
         
?>               
 <form action="" method="post">
    <table class="form">					
        <tr>
            <td>
                <label>Facebook</label>
            </td>
            <td>
                <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
            </td>
        </tr>
		 <tr>
            <td>
                <label>Twitter</label>
            </td>
            <td>
                <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
            </td>
        </tr>
		
		 <tr>
            <td>
                <label>Google Plus</label>
            </td>
            <td>
                <input type="text" name="gp" value="<?php echo $result['gp']; ?>" class="medium" />
            </td>
        </tr>
		
		 <tr>
            <td>
                <label>E-mail</label>
            </td>
            <td>
                <input type="text" name="em" value="<?php echo $result['em']; ?>" class="medium" />
            </td>
        </tr>
		
		 <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" Value="Update" />
            </td>
        </tr>
    </table>
 </form>
 <?php } } ?>
</div>
</div>
</div>
<?php include 'inc/footer.php';?>