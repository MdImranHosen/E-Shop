 <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
    	<?php 
    	   $copyrightData = $so->getCopyright();
    	   if ($copyrightData) {
    	   	while ($result = $copyrightData->fetch_assoc()) {
    	?>
        <p>
         &copy; <?php echo $result['copyright']; ?>
        </p>
        <?php } } ?>
    </div>
</body>
</html>
