<?php 
include 'inc/header.php'; 
include 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
            <?php
               if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                   $insertCopyright = $so->copyrightUpdate($_POST);

               }
            ?>
            <?php 
                $copyrightData = $so->getCopyright();
                if ($copyrightData) {
                    while ($result = $copyrightData->fetch_assoc()) {
            ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="copyright" value="<?php echo $result['copyright']; ?>" class="large" />
                    </td>
                </tr>
				
				 <tr> 
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