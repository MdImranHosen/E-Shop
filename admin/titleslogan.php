<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<style>
.leftside{float:left; width: 70%;}
.rightside{float:left; width: 30%;}
.rightside img{width: 150px;height: 130px;}
</style>
<div class="grid_10">
    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
              $titleSologanUp = $ts->titleSologanUpdate($_POST, $_FILES);
      }
    ?>
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php
               if (isset($titleSologanUp)) {
                   echo $titleSologanUp;
               }
             ?>
        <?php 
          $titlesloganData = $ts->titleSloganSelect();
          if ($titlesloganData) {
              while ($result = $titlesloganData->fetch_assoc()) {
        ?> 
     <div class="block sloginblock">
        <div class="leftside">   
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Logo</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            
        </div>
             <div class="rightside">
                      <img src="<?php echo $result['image']; ?>" alt="Logo">
            </div>
        </div>
        <?php } } ?>
    </div>
</div>
<?php include 'inc/footer.php';?>