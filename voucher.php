<?php $this->load->view('header'); ?>
<?php 	$hotelcode = $this->Home_Model->get_hotelcode($bookid);
		$hotel_det = $this->Home_Model->gethoteldet($hotelcode->hotel_code); 
		$guest_det = $this->Home_Model->get_guestdet($bookid); ?>

<!--body part start-->
	<div id="body">
<!--body content area start-->
    	<div id="wrapper">
        <!--body leftside area start-->
        	<!--body leftside area end-->
    <!--body rightside area start-->
    	<div style="float:left; width:948px; height:auto; margin:10px 10px 10px 0; padding:0 10px; border:1px solid #ccc; border-radius:8px; padding:15px 5px;">
        	<div class="right_heading" style="height:30px; width:953px; text-transform:uppercase; font-size:22px;">Booking Summary
            <span style="float:right"><input type="image" src="<?php print WEB_DIR ?>images/print_voucher.png" width="30" height="30" value="Print this Page" alt="Print This Page" onclick="window.print();" ></span></div>
            <div class="right_sort" style="width:948px; margin-top:15px; color:#2F7AD7; font-weight:bold;">Hotel Information
            </div>       
            <div class="voucher_box">
            	<table cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    
                    <td width="50%" align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                	<tr>                    
                    <td width="21%"><strong>Hotel name:</strong></td>
                    <td width="79%"><?php echo $hotel_det->name; ?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td> <?php echo $hotel_det->hotel_code; ?></td>
                    </tr>
                    <tr>
                    <td width="21%"><strong>Tel:</strong></td>
                    
                    <td width="79%"><?php if($hotel_det->phone != ''){echo $hotel_det->phone;}else{echo '<span style="color:#6D0001">Not Available..!</span>';} ?></td>
                    </tr>
                    </table>
                    </td>
                    
                    <td width="50%" align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                	<tr> 
                    <td width="18%"><strong>Address:</strong></td>
                    <td width="82%"><?php if($hotel_det->address != ''){echo $hotel_det->address;}else{echo '<span style="color:#6D0001">Not Available..!</span>';}?></td>
                    </tr>
                    <tr>
                    <td width="18%"><strong>Zone:</strong></td>
                    <td width="82%"><?php if($hotel_det->zone != ''){echo $hotel_det->zone;}else{echo '<span style="color:#6D0001">Not Available..!</span>';} ?></td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                </table>
            </div> 	 
            
           <!-- <div class="right_sort" style="width:948px; margin-top:15px; color:#600001; font-weight:bold;">Guest Details</div>       
            <div class="voucher_box">
            	<table cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    
                    <td width="50%" align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                	<tr>                    
                    <td width="21%"><strong>Hotel name:</strong></td>
                    <td width="79%">Citrus Hotel</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td> Subang Jaya.</td>
                    </tr>
                    <tr>
                    <td width="21%"><strong>Tel:</strong></td>
                    
                    <td width="79%">123456789</td>
                    </tr>
                    </table>
                    </td>
                    
                    <td width="50%" align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                	<tr> 
                    <td width="18%"><strong>Address:</strong></td>
                    <td width="82%">Bangalore</td>
                    </tr>
                    <tr>
                    <td width="18%"><strong>Country:</strong></td>
                    <td width="82%">India</td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                </table>
            </div> 	 -->
            
            <div class="right_sort" style="width:948px; margin-top:15px; color:#2F7AD7; font-weight:bold;">Guest Details
            </div>       
            <div class="voucher_box">
            	<table cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    
                    <td width="" align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                	<tr>                    
                    <td width="36%"><strong>Guest Details:</strong></td>
                    <td width="64%"><?php echo $guest_det->salutation." ".$guest_det->fname." ".$guest_det->lname; ?></td>
                    </tr>
                    <tr>
                    <td><strong>Guest Email Id:</strong></strong></td>
                    <td><?php echo $hotelcode->email; ?></td>
                    </tr>
                    <tr>
                    <td width="36%"><strong>Mobile:</strong></td>
                    
                    <td width="64%"><?php echo $guest_det->contact_no; ?></td>
                    </tr>
                    <!--<tr>
                    <td width="36%"><strong>Country:</strong></td>
                    
                    <td width="64%">India</td>
                    </tr>-->
                     <tr>
                    <td width="59%"><strong>Status:</strong></td>
                    <td width="41%"><?php echo $hotelcode->status; ?></td>
                    </tr>
                    </table>
                    </td>
                    
                    <td width="" align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" width="106%">
                	<tr> 
                    <td width="59%"><strong>Date Reservation Made:</strong></td>
                    <td width="41%"><?php echo $hotelcode->voucher_date; ?></td>
                    </tr>
                    <tr>
                    <td width="59%" height="27"><strong>Check In Date:</strong></td>
                    <td width="41%"><?php echo $hotelcode->check_in; ?></td>
                    </tr>
                    <tr>
                    <td width="59%"><strong>Check Out Date:</strong></td>
                    <td width="41%"><?php echo $hotelcode->check_out; ?></td>
                    </tr>
                    <tr>
                    <td width="59%"><strong>Room Type:</strong></td>
                    <td width="41%"><?php echo $hotelcode->room_type; ?></td>
                    </tr>
                   
                    </table>
                    </td>
                    
                     <td width="" align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                	<tr> 
                    <td width="70%"><strong>Number of Adult:</strong></td>
                    <td width="30%"><?php echo $hotelcode->adult_count; ?></td>
                    </tr>
                    <tr>
                    <td width="70%" height="27"><strong>Number of Childrens:</strong></td>
                    <td width="30%"><?php echo $hotelcode->child_count; ?></td>
                    </tr>
                     <tr>
                    <td width="70%"><strong>Number of Rooms:</strong></td>
                    <td width="30%"><?php echo $hotelcode->no_of_room; ?></td>
                    </tr> 
                    <tr>
                    <td width="70%"><strong>Number of Nights:</strong></td>
                    <td width="30%"><?php echo $this->session->userdata('dt'); ?></td>
                    </tr> 
                    </table>
                    </td>
                    </tr>
                </table>
            </div> 	 
            
            <div class="right_sort" style="width:948px; margin-top:15px; color:#2F7AD7; font-weight:bold;">Egyptian Spirit Booking.com Contact Details</div>       
            <div class="voucher_box">
            	<table cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    
                    <td width="50%" align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                	<tr>                    
                    <td width="19%"><strong>Email Id:</strong></td>
                    <td width="81%">egyptspirit@gmail.com</td>
                    </tr>
                   
                    <tr>
                    <td width="19%"><strong>Contact:</strong></td>
                    
                    <td width="81%">1800-566-655</td>
                    </tr>
                    </table>
                    </td>
                    
                    
                    </tr>
                </table>
            </div> 	 
                   	
        </div>
    	
        
        
    
    <!--body rightside area end-->
    
    
   		</div>
<!--body content area end-->
    </div>
<!--body part end-->

<!--footer part start-->
   <?php $this->load->view('footer'); ?>
