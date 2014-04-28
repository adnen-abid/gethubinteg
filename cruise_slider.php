
<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="cruise_sliders/style.css" />
	<script type="text/javascript" src="cruise_sliders/jquery.js"></script>
    <script type="text/javascript" src="cruise_sliders/wowslider.js"></script>
	<script type="text/javascript" src="cruise_sliders/script.js"></script>
	<!-- End WOWSlider.com HEAD section -->

	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
    <?php 
include('dbconnect.php');

$query=mysql_query("select * from criuse_cabin_images");
$i=0;
while($result=mysql_fetch_array($query))
	{?>  
<li><img src="admin/cruiseimages/<?php echo $result['image']; ?>" alt="cabin1" class="image<?php echo $i; ?>" title="" id="wows1_<?php echo $i; ?>"/></li>
<!--<li><img src="cruise_sliders/images/cabin2.jpg" alt="cabin2" title="" id="wows1_1"/></li>
<li><img src="cruise_sliders/images/cabin3.jpg" alt="cabin3" title="" id="wows1_2"/></li>
<li><img src="cruise_sliders/images/cabin4.jpg" alt="cabin4" title="" id="wows1_3"/></li>
<li><img src="cruise_sliders/images/cabin5.jpg" alt="cabin5" title="" id="wows1_4"/></li>-->
<?php $i++; } ?>
</ul></div>
<div class="ws_thumbs">
<div>
<?php 
$query1=mysql_query("select * from criuse_cabin_images");
while($result1=mysql_fetch_array($query1))
	{?>  
    <a href="#" title=""><img src="admin/cruiseimages/<?php echo $result1['image']; ?>" width="100" height="100" alt="" /></a>
    <?php } ?>
<!--<a href="#" title=""><img src="cruise_sliders/tooltips/cabin1.jpg" alt="" /></a>
<a href="#" title=""><img src="cruise_sliders/tooltips/cabin2.jpg" alt="" /></a>
<a href="#" title=""><img src="cruise_sliders/tooltips/cabin3.jpg" alt="" /></a>
<a href="#" title=""><img src="cruise_sliders/tooltips/cabin4.jpg" alt="" /></a>
<a href="#" title=""><img src="cruise_sliders/tooltips/cabin5.jpg" alt="" /></a>-->
</div>
</div>

	</div>
	
	<!-- End WOWSlider.com BODY section -->
