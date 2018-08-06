<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php 
  if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
     echo "<script>window.location = 'productlist.php'; </script>";
  }else{
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productid']);
  }
 $pd = new Product();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
     $updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
 }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block"> 
        <?php 
         if (isset($updateProduct)) {
             echo $updateProduct;
         }
        ?>
        <?php
         $getPro = $pd->getProById($id);
         if ($getPro) {
             while ($values = $getPro->fetch_assoc()) {
        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $values['productName']; ?>" class="medium" />
                    </td>
                </tr>
				        <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php
                               $cat = new Category();
                               $getCat = $cat->getAllcat();
                           if ($getCat) {
                            while ($result = $getCat->fetch_assoc()) {
                            ?>
                            <option
                             <?php 
                                 if ($values['catId'] == $result['catId']) { ?>
                                     selected = "selected"
                                <?php } ?>
                             value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				        <tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                      <select id="select" name="brandId">
                        <option>Select Brand</option>
                            <?php 
                              $brand = new Brand();
                              $getBrand = $brand->getAllBrand();
                           if ($getBrand) {
                            while ($result = $getBrand->fetch_assoc()) {
                            ?>
                        <option
                            <?php 
                                 if ($values['brandId'] == $result['brandId']) { ?>
                                     selected = "selected"
                                <?php } ?>
                             value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?>
                        </option>
                           <?php } } ?>
                      </select>
                    </td>
                </tr>
				
				        <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce">
                           <?php echo $values['body']; ?>
                        </textarea>
                    </td>
                </tr>
				        <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $values['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td> 
                        <img src="<?php echo $values['image']; ?>" width='60px' height='50px'>
                        <br/>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				        <tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php 
                              if ($values['type'] == 1) { ?>
                                <option selected = "selected" value="1">Featured</option>
                                <option value="2">General</option>    
                              <?php } elseif($values['type'] == 2){?>
                                <option value="1">Featured</option>
                                <option selected = "selected" value="2">General</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
               <tr>
                    <td>
                        <label>Search Tag</label>
                    </td>
                    <td>
                        <input type="text" name="searchtag" value="<?php echo $values['searchtag']; ?>" class="medium" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


