<?php
@session_start();
class Home extends Controller {

	function Home()
	{
		parent::Controller();	
		$this->load->model('Home_Model');
		$this->load->library('pagination');	
		$this->load->model('Transfer_Model');	
		$this->load->model('Tour_Model');
		$this->load->model('Agent_Model');
	}
	
    
	function index()
	{
		session_destroy();				
		if($this->session->userdata('agent_id')=='')
		{
	
		    //$data['hotel'] = $this->Home_Model->get_hotels();
			$data['country_youtravel'] = $this->Home_Model->country_youtravel();
			$this->load->view('index',$data); 
			
		}
		else
		{
			redirect('home/agent_main_home','refresh');
		}
		
		
	}
	function mail_contact()
	{
		$this->load->view('contact_mail');
	}
	function request_quotes()
	{
		$this->load->view('request_quotes');
	}
	function customer_service_resort()
	{
		$data['content'] = $this->Home_Model->fly_airport();
		$this->load->view('customer_service_resort',$data);
	}
	function free_childstay()
	{
		$data['content'] = $this->Home_Model->fly_airport();
		$this->load->view('free_childstay',$data);
	}
	function hotel_transfer_free()
	{
		$data['content'] = $this->Home_Model->fly_airport();
		$this->load->view('hotel_transfer_free',$data);
	}
	function request_send()
	{
		//echo $_SESSION["captcha"];
		$data['FirstName' ] = $FirstName = $this->input->post('FirstName');
		$data['LastName' ] = $LastName = $this->input->post('LastName');
		$data['EmailAddress' ] = $EmailAddress = $this->input->post('EmailAddress');
		$data['phonenumber' ] = $phonenumber = $this->input->post('phonenumber');
		$data['package_type' ] = $package_type = $this->input->post('package_type');
		$data['board_basis' ] = $board_basis = $this->input->post('board_basis');
		$data['destination' ] = $destination = $this->input->post('destination');
		$data['nights' ] = $nights = $this->input->post('nights');
		$data['starrate' ] = $starrate = $this->input->post('starrate');
		$data['comments' ] = $comments = $this->input->post('comments');
		$data['msg'] = 'CAPTCHA wrong';
		$captcha =  $this->input->post('captcha');
		//echo  $_SESSION["captcha"]; exit;
		if($captcha == $_SESSION["captcha"])
		{
			$subject="Request Quote From ".$FirstName."";
			//$from="w.ashour@egyptspirit.co.uk";
			$from= $EmailAddress;
			$headers ="MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$to = "w.ashour@egyptspirit.co.uk";
			//$to = "balup.provab@gmail.com";
			$message = '';
			$headers .="From: $from";
			$message .= "<table>
			<tr><td colspan='2'><img src='".WEB_DIR."images/email.png' /></td></tr>
			<tr><td>Dear Admin,</td></tr>
						<tr><td colspan='2'>You have a Quote Request</td></tr>
						<tr><td colspan='2'>Please have a look</td></tr>
						<tr><td>Name: </td><td>".$FirstName.", ".$LastName."</td></tr>
						<tr><td>Phone: </td><td>".$phonenumber."</td></tr>
						<tr><td>Package Type: </td><td>".$package_type."</td></tr>
						<tr><td>Board Basis: </td><td>".$board_basis."</td></tr>
						<tr><td>Destination: </td><td>".$destination."</td></tr>
						<tr><td>Nights: </td><td>".$nights."</td></tr>
						<tr><td>Star Rates: </td><td>".$starrate."</td></tr>
						<tr><td>Comments: </td><td>".$comments."</td></tr></table>";
			ini_set("SMTP","mail.provab.com");
			ini_set("smtp_port",25);
			$mail= mail($to, $subject, $message, $headers);
			redirect('home/request_send2','refresh');
		}
		else
		{
			$this->load->view('request_quotes',$data);
		}
		//unset($_SESSION["captcha"]);
	}
	function request_send2()
	{
		$this->load->view('request_quotes_send');
	}
	function contact_send()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$message = $this->input->post('message');
		$telephone = $this->input->post('telephone');
		$what_time = $this->input->post('what_time');
		$subject="Request Quote From ".$name."";
        //$from="w.ashour@egyptspirit.co.uk";
		$from= $email;
        $headers ="MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$to = "w.ashour@egyptspirit.co.uk";
		//$to = "balup.provab@gmail.com";
		$message = '';
        $headers .="From: $from";
		$message .= "<table>
		<tr><td colspan='2'><img src='".WEB_DIR."images/email.png' /></td></tr>
		<tr><td>Dear Admin,</td></tr>
					<tr><td colspan='2'>You have a Quote Request</td></tr>
					<tr><td colspan='2'>Please have a look</td></tr>
					<tr><td>Name: </td><td>".$name."</td></tr>
					<tr><td>Phone: </td><td>".$phone."</td></tr>
					<tr><td>Message: </td><td>".$message."</td></tr></table>";
        ini_set("SMTP","mail.provab.com");
        ini_set("smtp_port",25);
        $mail= mail($to, $subject, $message, $headers);
		redirect('home/contact_send2','refresh');
	}
	function contact_send2()
	{
		$this->load->view('contact_mail_send');
	}
	function newsletter_send()
	{
		$email = $this->input->post('subscribe');
		$subject="Subscribe From ".$email."";
        //$from="w.ashour@egyptspirit.co.uk";
		$from= $email;
        $headers ="MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$to = "w.ashour@egyptspirit.co.uk";
		//$to = "balup.provab@gmail.com";
		$message = '';
        $headers .="From: $from";
		$message .= "<table>
		<tr><td colspan='2'><img src='".WEB_DIR."images/email.png' /></td></tr>
		<tr><td>Dear Admin,</td></tr>
					
					<tr><td colspan='2'>You have a Subscribe Request</td></tr>
					<tr><td colspan='2'>Please have a look</td></tr>
					<tr><td>From: </td><td>".$email."</td></tr>
					</table>";
        ini_set("SMTP","mail.provab.com");
        ini_set("smtp_port",25);
        $mail= mail($to, $subject, $message, $headers);
		redirect('home/newsletter_send2','refresh');
	}
	function newsletter_send2()
	{
		$data['country_youtravel'] = $this->Home_Model->country_youtravel();
		$this->load->view('newsletter_send',$data);
	}
	function whyus()
	{
		$data['content'] = $this->Home_Model->getwhyus();
		$this->load->view('whyus',$data);
	}
	function flight()
	{
		//$data['country_youtravel'] = $this->Home_Model->country_youtravel();
		//echo "hihiho"; exit;
		$this->load->view('flight_hotel/flight');
	}
	/* HOTEL + FLIGHT + HOTEL */
	function agent_login()
	{
		//echo "worst";exit;
		$rules['login_name']="required";
		$rules['password']="required";
			
		
		 $this->validation->set_rules($rules);
				
				
		$fields['login_name']="Login Name";
		$fields['password']="Password";
	
				
		$this->validation->set_fields($fields);
		
		if($this->validation->run()==FALSE)
		{
			//echo "hihii"; exit;			
			//$this->load->view('index');
			
			redirect('home/index','refresh');
		}
		else
		{
			 $login_name=$this->input->post('login_name');
			 $password=$this->input->post('password');
			 $sub_agent=$this->input->post('sub_agent');
			 
			
		
				if($sub_agent!='' and $sub_agent=='sub_agent')
				{
					//echo "iojijiji"; exit;					
					$user_id=$this->Home_Model->check_sub_agent_login($login_name,$password);
					
					$this->session->set_userdata(array('user_id'=>$user_id->user_id));
					
					redirect('agent_dashboard/subagent_main_home','refresh'); //subagent_main_home
				}
				else
				{
				 $res=$this->Home_Model->check_agent_login($login_name,$password);
				
				 }

					if($res!='')
					{
					
					$agentid=$this->session->set_userdata(array('agentid'=>$res->agentid));
				    
                    $current_time = date("g:i A");
   					$current_date = date("l, F jS, Y");
					$time=$current_date." ".$current_time;
					
					$agent_id=$this->session->set_userdata(array('agent_id'=>$res->agent_id));
					$status=1;
					$dat=$this->Home_Model->update_status_login($status,$res->agentid,$time);
					
					redirect('home/agent_main_home','refresh');
					}
					else
					{
						$data['error']='Error in Credentials entered';
						$this->load->view('agent_login_new',$data);
					}
				
				
				
						
			}
	}
	function agent_main_home()
		{
			
			?>
       <script language="Javascript" type="text/javascript">
 
		var urrl = '<?php print WEB_URL.'home/agent_main_home_new'; ?>';
		 window.top.location.href=urrl;
 
</script>
<?php
			
		}
		function agent_main_home_new()
		{
			
			if($this->session->userdata('agent_id')!='')
			{
			$data['a_id']=$this->session->userdata('agent_id');	
			$agnt=$this->session->userdata('agentid');	
			
			//echo 'ss'.$agnt;exit;		
			$data['last_log']=$this->Agent_Model->agent_last_login($agnt);		
			$data['acc_info']=$this->Agent_Model->accnt_information($agnt);			
			
				//$data['used_amt']=$this->Agent_Model->agent_used_amount($agnt);	
				
			
			//$this->load->view('agent_home/header',$data);
			$this->load->view('agent_home/agent_dashboard_display',$data);
			//$this->load->view('agent_home/footer_agent');
			}
			else
			{
					redirect('home/index', 'refresh');
			}
		}
		function packages_front()
		{
			$this->load->view('package_home_page');
		}
		function hotel_load()
		{
			
		$sec_res=session_id();
		$data['country_travel'] = $country_travel = $this->input->post('country_travel');
		$data['destination'] = $destination = $this->input->post('destination'); 
		$data['resort'] = $resort = $this->input->post('resort'); 
		$data['All_board'] = $All_board = $this->input->post('All_board');
		$data['roomonly'] = $roomonly = $this->input->post('roomonly');
		$data['self_cat'] = $self_cat = $this->input->post('self_cat');
		$data['bed_break'] = $bed_break = $this->input->post('bed_break');
		$data['half_board'] = $half_board = $this->input->post('half_board');
		$data['full_board'] = $full_board = $this->input->post('full_board');
		$data['all_inclusive'] = $all_inclusive = $this->input->post('all_inclusive');
		$data['villa'] = $villa = $this->input->post('villa');
		$data['all_star'] = $all_star = $this->input->post('all_star');
		$data['star1'] = $star1 = $this->input->post('star1');
		$data['star2'] = $star2 = $this->input->post('star2');
		$data['star3'] = $star3 = $this->input->post('star3');
		$data['star4'] = $star4 = $this->input->post('star4');
		$data['star5'] = $star5 = $this->input->post('star5');
		
		$this->Home_Model->delete_search_result($sec_res);
		//$data['citycode']=$this->input->post('cityval');
		//$data['disp_city']= $disp_city = $this->input->post('cityval');
		$data['citycode']=$this->input->post('destination');
		$data['disp_city']= $disp_city = $this->input->post('destination');
		
		$data['hotel_name']= $hotel_name = $this->input->post('hotel_name');	
		$data['sd']= $cin = $this->input->post('checkin');
		$data['ed']= $cout = $this->input->post('checkout');
		//echo $cin."-".$cout."-".$disp_city."-".$hotel_name; exit;
		$data['roomcount']= $roomcount = $this->input->post('room_count');
		$data['adult']=$adult=$this->input->post('adult');
		$data['child']=$child=$this->input->post('child');
		$data['child_age']=$child_age=$this->input->post('child_age');
		/* adults and childs for Youtravel */
		if(isset($adult[0]))
		{
			$ADLTS_1 = $adult[0];
		}
		else
		{
			$ADLTS_1 = '0';
		}
		if(isset($adult[1]))
		{
			$ADLTS_2 = $adult[1];
		}
		else
		{
			$ADLTS_2 = '0';
		}
		if(isset($adult[2]))
		{
			$ADLTS_3 = $adult[2];
		}
		else
		{
			$ADLTS_3 = '0';
		}
		
		if(isset($child[0]))
		{
			$CHILD_1 = $child[0];
		}
		else
		{
			$CHILD_1 = '0';
		}
		if(isset($child[1]))
		{
			$CHILD_2 = $child[1];
		}
		else
		{
			$CHILD_2 = '0';
		}
		if(isset($child[2]))
		{
			$CHILD_3 = $child[2];
		}
		else
		{
			$CHILD_3 = '0';
		}
		//print_r($child_age);
		$ChildAgeR1C1 = $child_age[0];
		$ChildAgeR1C2 = $child_age[1];
		$ChildAgeR2C1 = $child_age[2];
		$ChildAgeR2C2 = $child_age[3];
		$ChildAgeR3C1 = $child_age[4];
		$ChildAgeR3C2 = $child_age[5];
		//$ChildAgeR2C1 = $child_age[2];
		 //exit;
		 /* adults and childs for Youtravel */
		//print_r($adult); exit;
		
		
		$data['boardtype']=$boardtype=$this->input->post('All_board');
		$data['starrating']=$starrating=$this->input->post('all_star');
		
		$data['costtype'] =$costtype="EUR";
		$adultval = $_POST['adult'];
		$childval = $_POST['child'];
		$room_used_type=array();
		$adult_count=0;
		$child_count=0;

	    for($i=0;$i< $_POST['room_count'];$i++)
		{
			
			if($adultval[$i]==1 && $childval[$i]==0)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==1 && $childval[$i]==1)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 1;
    		}
			if($adultval[$i]==1 && $childval[$i]==2)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 2;
    		}
			
			if($adultval[$i]==2 && $childval[$i]==0)
			{
				
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 0;
    		}
            if($adultval[$i]==2 && $childval[$i]==1)
			{
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 1;
    		}
            if($adultval[$i]==2 && $childval[$i]==2)
			{
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==3 && $childval[$i]==0)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==3 && $childval[$i]==1)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 1;
    		}
            if($adultval[$i]==3 && $childval[$i]==2)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==4 && $childval[$i]==0)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==4 && $childval[$i]==1)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 1;
    		}
			if($adultval[$i]==4 && $childval[$i]==2)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==5 )
			{
				
				$room_used_type[] = 9;
				$adult_count = $adult_count + 5; 
				//$child_count = $child_count + 2;
			}
			
			
		}
		
		//print_r($room_used_type); exit;
		$this->session->set_userdata(array('All_board'=>$All_board,'roomonly'=>$roomonly,'self_cat'=>$self_cat,'bed_break'=>$bed_break,'half_board'=>$half_board,'full_board'=>$full_board,'all_inclusive'=>$all_inclusive,'villa'=>$villa,'all_star'=>$all_star,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'ADLTS_1'=>$ADLTS_1,'ADLTS_2'=>$ADLTS_2,'ADLTS_3'=>$ADLTS_3,'CHILD_1'=>$CHILD_1,'CHILD_2'=>$CHILD_2,'CHILD_3'=>$CHILD_3,'ChildAgeR1C1'=>$ChildAgeR1C1,'ChildAgeR1C2'=>$ChildAgeR1C2,'ChildAgeR2C1'=>$ChildAgeR2C1,'ChildAgeR2C2'=>$ChildAgeR2C2,'ChildAgeR3C1'=>$ChildAgeR3C1,'ChildAgeR3C2'=>$ChildAgeR3C2,'country_travel'=>$country_travel,'destination'=>$destination,'resort'=>$resort,'roomusedtype'=>$room_used_type, 'hotel_name'=>$hotel_name, 'adult_count'=>$adult_count, 'child_count'=>$child_count, 'roomcount'=>$data['roomcount'],'child_age'=>$child_age, 'sec_res'=>$sec_res,'citycode'=>$data['citycode'],'cin'=>$cin,'cout'=>$cout,'disp_city'=>$disp_city, 'boardtype'=>$boardtype, 'starrating'=>$starrating));
	    $this->load->view('load_customer',$data);//exit;
		
		
	
			//$this->load->view('hotel_search_result');
		}
		function get_destination()
		{
			$url = 'http://xml.youtravel.com/webservices/get_destinations.asp?LangID=EN&Username=egyptspirit&Password=sprite2013';
			
			  $ch = curl_init();
			  $timeout = 30;
			  curl_setopt($ch, CURLOPT_URL, $url);
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			  $data = curl_exec($ch);
			  curl_close($ch);
			  $array =$this->xml2array($data);
			 // echo "<pre>"; print_r($array); exit;
			 if(isset($array['HtSearchRq']['Country']))
			 {
				$Country = $array['HtSearchRq']['Country'];
				foreach($Country as $cnt)
				{
					$code = $cnt['attr']['Code'];
					echo $Name = $cnt['attr']['Name'];
					$ID = $cnt['attr']['ID'];
					$Destination = $cnt['Destination'];
					foreach($Destination as $dest)
					{
						//echo "<pre>"; print_r($dest); 
						if(isset($dest['attr']['name']))
						{
							$name = $dest['attr']['name'];
						}
						else
						{
							$name = '';
						}
						if(isset($dest['attr']['ID']))
						{
							$ID = $dest['attr']['ID'];
						}
						else
						{
							$ID = '';
						}
						if(isset($dest['ISO_Codes']['attr']['Code_1']))
						{
							$Code_1 = $dest['ISO_Codes']['attr']['Code_1'];
						}
						else
						{
							$Code_1 = '';
						}
						if(isset($dest['ISO_Codes']['attr']['Code_2']))
						{
							$Code_2 =  $dest['ISO_Codes']['attr']['Code_2'];
						}
						else
						{
							$Code_2 = '';
						}
						if(isset($dest['ISO_Codes']['attr']['Code_3']))
						{
							$Code_3 =  $dest['ISO_Codes']['attr']['Code_3'];
						}
						else
						{
							$Code_3 = '';
						}
						if(isset($dest['Resort']))
						{
							$resort = $dest['Resort'];
							foreach($resort as $reso)
							{
								//echo "<pre>"; print_r($reso);
								if(isset($reso['attr']['ID']))
								{
									$resort_id = $reso['attr']['ID'];
								}
								else
								{
									$resort_id = '';
								}
								if(isset($reso['Resort_Name']['value']))
								{
									$Resort_Name = $reso['Resort_Name']['value'];
								}
								else
								{
									$Resort_Name = '';
								}
								//$this->Home_Model->insert_destination($code,$name,$ID,$Code_1,$Code_2,$Code_3,$resort_id,$Resort_Name);
							}
							
						}
						/*
						if(isset($dest['Resort']['attr']['ID']))
						{
							$resort_id = $dest['Resort']['attr']['ID'];
						}
						else
						{
							$resort_id = '';
						}
						if(isset($dest['Resort']['Resort_Name']['value']))
						{
							$Resort_Name = $dest['Resort']['Resort_Name']['value'];
						}
						else
						{
							$Resort_Name = '';
						}*/
						//$this->Home_Model->insert_destination($code,$name,$ID,$Code_1,$Code_2,$Code_3,$resort_id,$Resort_Name);
					}
				}
			 }
				
		}
		function get_data($url) {
			  $ch = curl_init();
			  $timeout = 30;
			  curl_setopt($ch, CURLOPT_URL, $url);
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			  $data = curl_exec($ch);
			  curl_close($ch);
			  return $data; 
			}
		function hotel_search_youtravel($country,$destination,$resort)
		{
			//echo $destination; exit;
			$checkin = $this->session->userdata('check_in_new'); 
			$cin = $this->session->userdata('cin');
			$cout = $this->session->userdata('cout');
			
			 
			$All_board=$this->session->userdata('All_board');
			$roomonly=$this->session->userdata('roomonly');
			$self_cat=$this->session->userdata('self_cat');
			$bed_break=$this->session->userdata('bed_break');
			$half_board= $this->session->userdata('half_board');
			$full_board =$this->session->userdata('full_board');
			$all_inclusive=$this->session->userdata('$all_inclusive');
			$villa=$this->session->userdata('villa');
			$board = '';
			if($All_board != '')
			{
				$board .='BT=1';
			}
			if($roomonly != '')
			{
				$board .='BT_RO=1';
			}
			if($self_cat != '')
			{
				$board .='BT_SC=1';
			}
			if($bed_break != '')
			{
				$board .='BT_BB=1';
			}
			if($half_board != '')
			{
				$board .='BT_HB=1';
			}
			if($full_board != '')
			{
				$board .='BT_FB=1';
			}
			if($all_inclusive != '')
			{
				$board .='BT_AI=1';
			}
			if($villa != '')
			{
				$board .='BT_VILLA=1';
			}
			$star = '';
			if($this->session->userdata('all_star') !='')
			{
			   	$all_star= $this->session->userdata('all_star');
				$star .='StarCatAll=1';
			}
			
			
			if($this->session->userdata('star1') !='')
			{
			   	$star1= $this->session->userdata('star1');
				$star .='StarCat1=1';
			}
			
			
			//$star1= $this->session->userdata('star1');
			if($this->session->userdata('star2') !='')
			{
			   	$star2= $this->session->userdata('star2');
				$star .='StarCat2=1';
			}
						//$star2 = $this->session->userdata('star2');
			if($this->session->userdata('star3') !='')
			{
			   	$star3= $this->session->userdata('star3');
				$star .='StarCat3=1';
			}
			
			//$star3 = $this->session->userdata('star3');
			if($this->session->userdata('star4') !='')
			{
			   	$star4= $this->session->userdata('star4');
				$star .='StarCat4=1';
			}
			
			//$star4 = $this->session->userdata('star4');
			if($this->session->userdata('star5') !='')
			{
			   	$star5= $this->session->userdata('star5');
				$star .='StarCat5=1';
			}
			
			//$star5 = $this->session->userdata('star5');
			$days = $this->session->userdata('dt'); 
			$sec_res = $this->session->userdata('sec_res');
			$dest = $this->Home_Model->Youtavel_destcode($destination);
			if($dest !='')
			{
				$dest_code = $dest->Code_1; 
			}
			
			$ADLTS_1 = $this->session->userdata('ADLTS_1'); 
			$ADLTS_2 = $this->session->userdata('ADLTS_2'); 
			//$ADLTS_2 = '1';
			$ADLTS_3 = $this->session->userdata('ADLTS_3');
			//$ADLTS_3 = '0';
			$CHILD_1 = $this->session->userdata('CHILD_1');
			$CHILD_2 = $this->session->userdata('CHILD_2');
			$CHILD_3 = $this->session->userdata('CHILD_3');
			$ChildAgeR1C1 = $this->session->userdata('ChildAgeR1C1');
			$ChildAgeR1C2 = $this->session->userdata('ChildAgeR1C2');
			$ChildAgeR2C1 = $this->session->userdata('ChildAgeR2C1');
			$ChildAgeR2C2 = $this->session->userdata('ChildAgeR2C2');
			$ChildAgeR3C1 = $this->session->userdata('ChildAgeR3C1');
			$ChildAgeR3C2 = $this->session->userdata('ChildAgeR3C2');
			$nor = $this->session->userdata('nor');
			// exit;
			//&Rsrt='.$Rsrt.'
			//&StarCatAll='.$all_star.'&StarCat1='.$star1.'&StarCat2='.$star2.'&StarCat3='.$star3.'&StarCat4='.$star4.'&StarCat5='.$star5.'
			//&BT='.$All_board.'&BT_RO='.$roomonly.'&BT_SC='.$self_cat.'&BT_BB='.$bed_break.'&BT_HB='.$half_board.'&BT_FB='.$full_board.'&BT_AI='.$all_inclusive.'&BT_VILLA='.$villa.'
			//&'.$star.'
			$url = 'http://xml.youtravel.com/webservices/index.asp?Checkin_Date='.$checkin.'&Username=egyptspirit&Password=sprite2013&Nights='.$days.'&LangID=EN&Rooms='.$nor.'&ADLTS_1='.$ADLTS_1.'&CHILD_1='.$CHILD_1.'&ADLTS_2='.$ADLTS_2.'&CHILD_2='.$CHILD_2.'&ADLTS_3='.$ADLTS_3.'&CHILD_3='.$CHILD_3.'&ChildAgeR1C1='.$ChildAgeR1C1.'&ChildAgeR1C2='.$ChildAgeR1C2.'&ChildAgeR2C1='.$ChildAgeR2C1.'&ChildAgeR2C2='.$ChildAgeR2C2.'&ChildAgeR3C1='.$ChildAgeR3C1.'&ChildAgeR3C2='.$ChildAgeR3C2.'&DSTN='.$dest_code.'&Currency=GBP&'.$star.'&'.$board.'';
			//exit;
			//echo $url;  exit;
			 $res = $this->get_data($url);
			 $array =$this->xml2array($res);
			//echo "<pre>"; print_r($res); exit;
			if(isset($array['HtSearchRq']['session']))
			{
				//echo "<pre>"; print_r($array['HtSearchRq']['session']);
				$session_you = $array['HtSearchRq']['session']['attr']['id']; 
				$currrency = $array['HtSearchRq']['session']['Currency']['value']; 
				$hotel = array($array['HtSearchRq']['session']['Hotel']);
				//echo "<pre>"; print_r($hotel);exit;
				foreach($hotel as $h)
				{
					//echo "for one hotel results";exit;
					if(isset($h['attr']))
					{
						
						//echo "<pre>"; print_r($h['Room_2']);exit;
						if(isset($h['attr']['ID']))
						{
							 $hotel_id = $h['attr']['ID'];
						}
						if(isset($h['Hotel_Name']['value']))
						{
							$Hotel_Name = $h['Hotel_Name']['value'];
						}
						if(isset($h['Youtravel_Rating']['value']))
						{
							$Youtravel_Rating = $h['Youtravel_Rating']['value'];
						}
						
						if(isset($h['Official_Rating']['value']))
						{
							$Official_Rating = $h['Official_Rating']['value'];
						}
						if(isset($h['Board_Type']['value']))
						{
							$Board_Type = $h['Board_Type']['value'];
						}
						if(isset($h['Child_Age']['value']))
						{
							$Child_Age = $h['Child_Age']['value'];
						}
						if(isset($h['Country']['value']))
						{
							$Country = $h['Country']['value'];
						}
						if(isset($h['Destination']['value']))
						{
							$Destination = $h['Destination']['value'];
						}
						if(isset($h['Resort']['value']))
						{
							$Resort = $h['Resort']['value'];
						}
						if(isset($h['Image']['value']))
						{
							$Image = $h['Image']['value'];
						}
						if(isset($h['Hotel_Desc']['value']))
						{
							$Hotel_Desc = $h['Hotel_Desc']['value'];
						}
						//echo "<pre>"; print_r($h); exit;
						if(isset($h['Room_1']))
						{
							$Room_1 = array($h['Room_1']);
							//echo"<pre>"; print_r($Room_1);
							foreach($Room_1 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								//foreach($Room as $rooms)
								//{
									//echo "<pre>"; print_r($rooms);
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';	
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
													
								//}
								$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
							}
							/* NEW for 2 room */
							if(isset($h['Room_2']))
							{
							$Room_2 = array($h['Room_2']);
							//echo"<pre>"; print_r($Room_2); exit;
							foreach($Room_2 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								//foreach($Room as $rooms)
								//{
									//echo "<pre>"; print_r($rooms);
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';	
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
													
								//}
								$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
							}
							}
							if(isset($h['Room_3']))
							{
							$Room_3 = array($h['Room_2']);
							//echo"<pre>"; print_r($Room_2); exit;
							foreach($Room_3 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers2 as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								//foreach($Room as $rooms)
								//{
									//echo "<pre>"; print_r($rooms);
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';	
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
													
								//}
								$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
							}
							}
							/* NEW for 2 room */
							}
						//echo $Final_Rate;
					
						
					}
					else
					{
					foreach($h as $ht)
					{
						
						//echo "<pre>"; print_r($ht);
						if(isset($ht['attr']['ID']))
						{
							 $hotel_id = $ht['attr']['ID'];
						}
						if(isset($ht['Hotel_Name']['value']))
						{
							$Hotel_Name = $ht['Hotel_Name']['value'];
						}
						if(isset($ht['Youtravel_Rating']['value']))
						{
							$Youtravel_Rating = $ht['Youtravel_Rating']['value'];
						}
						
						if(isset($ht['Official_Rating']['value']))
						{
							$Official_Rating = $ht['Official_Rating']['value'];
						}
						if(isset($ht['Board_Type']['value']))
						{
							$Board_Type = $ht['Board_Type']['value'];
						}
						if(isset($ht['Child_Age']['value']))
						{
							$Child_Age = $ht['Child_Age']['value'];
						}
						if(isset($ht['Country']['value']))
						{
							$Country = $ht['Country']['value'];
						}
						if(isset($ht['Destination']['value']))
						{
							$Destination = $ht['Destination']['value'];
						}
						if(isset($ht['Resort']['value']))
						{
							$Resort = $ht['Resort']['value'];
						}
						if(isset($ht['Image']['value']))
						{
							$Image = $ht['Image']['value'];
						}
						if(isset($ht['Hotel_Desc']['value']))
						{
							$Hotel_Desc = $ht['Hotel_Desc']['value'];
						}
						if(isset($ht['Room_1']))
						{
							$Room_1 = array($ht['Room_1']);
							//echo"<pre>"; print_r($Room_1);
							foreach($Room_1 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								if(isset($Room['attr']['Id']))
								{
									//$room_id = $Room['attr']['Id'];
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($$Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
								else
								{
								foreach($Room as $rooms)
								{
									
									//echo "<pre>"; print_r($rooms);
									//$room_id = $rooms['attr']['Id'];
									if(isset($rooms['attr']['Id']))
									{
										$room_id = $rooms['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($rooms['Type']['value']))
									{
										$Type = $rooms['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									//$Type = $rooms['Type']['value'];
									if(isset($rooms['Board']['value']))
									{
										$Board = $rooms['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $rooms['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $rooms['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$$Offers['Lastminute_Offer'] = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									
									
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
										$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);				
								}
								//$this->Home_Model->insert_youtravel($hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
							}
							}
						if(isset($ht['Room_2']))
						{
							$Room_1 = array($ht['Room_2']);
							//echo"<pre>"; print_r($Room_1);
							foreach($Room_1 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								if(isset($Room['attr']['Id']))
								{
									//$room_id = $Room['attr']['Id'];
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($$Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
								else
								{
								foreach($Room as $rooms)
								{
									
									//echo "<pre>"; print_r($rooms);
									//$room_id = $rooms['attr']['Id'];
									if(isset($rooms['attr']['Id']))
									{
										$room_id = $rooms['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($rooms['Type']['value']))
									{
										$Type = $rooms['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									//$Type = $rooms['Type']['value'];
									if(isset($rooms['Board']['value']))
									{
										$Board = $rooms['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $rooms['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $rooms['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$$Offers['Lastminute_Offer'] = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									
									
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
										$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);				
								}
								//$this->Home_Model->insert_youtravel($hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
							}
							}
						if(isset($ht['Room_3']))
						{
							$Room_3 = array($ht['Room_3']);
							//echo"<pre>"; print_r($Room_1);
							foreach($Room_3 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								if(isset($Room['attr']['Id']))
								{
									//$room_id = $Room['attr']['Id'];
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($$Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
								else
								{
								foreach($Room as $rooms)
								{
									
									//echo "<pre>"; print_r($rooms);
									//$room_id = $rooms['attr']['Id'];
									if(isset($rooms['attr']['Id']))
									{
										$room_id = $rooms['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($rooms['Type']['value']))
									{
										$Type = $rooms['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									//$Type = $rooms['Type']['value'];
									if(isset($rooms['Board']['value']))
									{
										$Board = $rooms['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $rooms['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $rooms['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$$Offers['Lastminute_Offer'] = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									
									
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
										$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);				
								}
								//$this->Home_Model->insert_youtravel($hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
							}
							}
							
							
						//echo $Final_Rate;
					}
					
					}
					}
					
				
				//echo "sdfg";exit;
			//redirect('home/search_result_new','refresh');
			}
				
			
				//echo "<pre>";  print_r($hotel_id);
			//}
}
			function hotel_search_youtravel_flight($country,$destination,$resort)
		{
			//echo $destination; exit;
			$checkin = $this->session->userdata('check_in_new'); 
			$cin = $this->session->userdata('cin');
			$cout = $this->session->userdata('cout');
			
			 $dest_code = '';
			$All_board=$this->session->userdata('All_board');
			$roomonly=$this->session->userdata('roomonly');
			$self_cat=$this->session->userdata('self_cat');
			$bed_break=$this->session->userdata('bed_break');
			$half_board= $this->session->userdata('half_board');
			$full_board =$this->session->userdata('full_board');
			$all_inclusive=$this->session->userdata('$all_inclusive');
			$villa=$this->session->userdata('villa');
			$board = '';
			if($All_board != '')
			{
				$board .='BT=1';
			}
			if($roomonly != '')
			{
				$board .='BT_RO=1';
			}
			if($self_cat != '')
			{
				$board .='BT_SC=1';
			}
			if($bed_break != '')
			{
				$board .='BT_BB=1';
			}
			if($half_board != '')
			{
				$board .='BT_HB=1';
			}
			if($full_board != '')
			{
				$board .='BT_FB=1';
			}
			if($all_inclusive != '')
			{
				$board .='BT_AI=1';
			}
			if($villa != '')
			{
				$board .='BT_VILLA=1';
			}
			$star = '';
			if($this->session->userdata('all_star') !='')
			{
			   	$all_star= $this->session->userdata('all_star');
				$star .='StarCatAll=1';
			}
			
			
			if($this->session->userdata('star1') !='')
			{
			   	$star1= $this->session->userdata('star1');
				$star .='StarCat1=1';
			}
			
			
			//$star1= $this->session->userdata('star1');
			if($this->session->userdata('star2') !='')
			{
			   	$star2= $this->session->userdata('star2');
				$star .='StarCat2=1';
			}
						//$star2 = $this->session->userdata('star2');
			if($this->session->userdata('star3') !='')
			{
			   	$star3= $this->session->userdata('star3');
				$star .='StarCat3=1';
			}
			
			//$star3 = $this->session->userdata('star3');
			if($this->session->userdata('star4') !='')
			{
			   	$star4= $this->session->userdata('star4');
				$star .='StarCat4=1';
			}
			
			//$star4 = $this->session->userdata('star4');
			if($this->session->userdata('star5') !='')
			{
			   	$star5= $this->session->userdata('star5');
				$star .='StarCat5=1';
			}
			
			//$star5 = $this->session->userdata('star5');
			$days = $this->session->userdata('dt'); 
			$sec_res = $this->session->userdata('sec_res');
			$dest = $this->Home_Model->Youtavel_destcode($destination);
			if($dest !='')
			{
				$dest_code = $dest->Code_1; 
			}
			
			$ADLTS_1 = $this->session->userdata('ADLTS_1'); 
			$ADLTS_2 = $this->session->userdata('ADLTS_2'); 
			//$ADLTS_2 = '1';
			$ADLTS_3 = $this->session->userdata('ADLTS_3');
			//$ADLTS_3 = '0';
			$CHILD_1 = $this->session->userdata('CHILD_1');
			$CHILD_2 = $this->session->userdata('CHILD_2');
			$CHILD_3 = $this->session->userdata('CHILD_3');
			$ChildAgeR1C1 = $this->session->userdata('ChildAgeR1C1');
			$ChildAgeR1C2 = $this->session->userdata('ChildAgeR1C2');
			$ChildAgeR2C1 = $this->session->userdata('ChildAgeR2C1');
			$ChildAgeR2C2 = $this->session->userdata('ChildAgeR2C2');
			$ChildAgeR3C1 = $this->session->userdata('ChildAgeR3C1');
			$ChildAgeR3C2 = $this->session->userdata('ChildAgeR3C2');
			$nor = $this->session->userdata('nor');
			// exit;
			//&Rsrt='.$Rsrt.'
			//&StarCatAll='.$all_star.'&StarCat1='.$star1.'&StarCat2='.$star2.'&StarCat3='.$star3.'&StarCat4='.$star4.'&StarCat5='.$star5.'
			//&BT='.$All_board.'&BT_RO='.$roomonly.'&BT_SC='.$self_cat.'&BT_BB='.$bed_break.'&BT_HB='.$half_board.'&BT_FB='.$full_board.'&BT_AI='.$all_inclusive.'&BT_VILLA='.$villa.'
			//&'.$star.'
			$url = 'http://xml.youtravel.com/webservices/index.asp?Checkin_Date='.$checkin.'&Username=egyptspirit&Password=sprite2013&Nights='.$days.'&LangID=EN&Rooms='.$nor.'&ADLTS_1='.$ADLTS_1.'&CHILD_1='.$CHILD_1.'&ADLTS_2='.$ADLTS_2.'&CHILD_2='.$CHILD_2.'&ADLTS_3='.$ADLTS_3.'&CHILD_3='.$CHILD_3.'&ChildAgeR1C1='.$ChildAgeR1C1.'&ChildAgeR1C2='.$ChildAgeR1C2.'&ChildAgeR2C1='.$ChildAgeR2C1.'&ChildAgeR2C2='.$ChildAgeR2C2.'&ChildAgeR3C1='.$ChildAgeR3C1.'&ChildAgeR3C2='.$ChildAgeR3C2.'&DSTN='.$dest_code.'&Currency=GBP&'.$star.'&'.$board.'';
			//exit;
			//echo $url;  exit;
			 $res = $this->get_data($url);
			 $array =$this->xml2array($res);
			//echo "<pre>"; print_r($array); exit;
			if(isset($array['HtSearchRq']['session']))
			{
				//echo "<pre>"; print_r($array['HtSearchRq']['session']);
				$session_you = $array['HtSearchRq']['session']['attr']['id']; 
				$currrency = $array['HtSearchRq']['session']['Currency']['value']; 
				$hotel = array($array['HtSearchRq']['session']['Hotel']);
				//echo "<pre>"; print_r($hotel);exit;
				foreach($hotel as $h)
				{
					//echo "for one hotel results";exit;
					if(isset($h['attr']))
					{
						
						//echo "<pre>"; print_r($h['Room_2']);exit;
						if(isset($h['attr']['ID']))
						{
							 $hotel_id = $h['attr']['ID'];
						}
						if(isset($h['Hotel_Name']['value']))
						{
							$Hotel_Name = $h['Hotel_Name']['value'];
						}
						if(isset($h['Youtravel_Rating']['value']))
						{
							$Youtravel_Rating = $h['Youtravel_Rating']['value'];
						}
						
						if(isset($h['Official_Rating']['value']))
						{
							$Official_Rating = $h['Official_Rating']['value'];
						}
						if(isset($h['Board_Type']['value']))
						{
							$Board_Type = $h['Board_Type']['value'];
						}
						if(isset($h['Child_Age']['value']))
						{
							$Child_Age = $h['Child_Age']['value'];
						}
						if(isset($h['Country']['value']))
						{
							$Country = $h['Country']['value'];
						}
						if(isset($h['Destination']['value']))
						{
							$Destination = $h['Destination']['value'];
						}
						if(isset($h['Resort']['value']))
						{
							$Resort = $h['Resort']['value'];
						}
						if(isset($h['Image']['value']))
						{
							$Image = $h['Image']['value'];
						}
						if(isset($h['Hotel_Desc']['value']))
						{
							$Hotel_Desc = $h['Hotel_Desc']['value'];
						}
						//echo "<pre>"; print_r($h); exit;
						if(isset($h['Room_1']))
						{
							$Room_1 = array($h['Room_1']);
							//echo"<pre>"; print_r($Room_1);
							foreach($Room_1 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								//foreach($Room as $rooms)
								//{
									//echo "<pre>"; print_r($rooms);
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';	
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
													
								//}
								$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
							}
							/* NEW for 2 room */
							if(isset($h['Room_2']))
							{
							$Room_2 = array($h['Room_2']);
							//echo"<pre>"; print_r($Room_2); exit;
							foreach($Room_2 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								//foreach($Room as $rooms)
								//{
									//echo "<pre>"; print_r($rooms);
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';	
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
													
								//}
								$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
							}
							}
							if(isset($h['Room_3']))
							{
							$Room_3 = array($h['Room_2']);
							//echo"<pre>"; print_r($Room_2); exit;
							foreach($Room_3 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers2 as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								//foreach($Room as $rooms)
								//{
									//echo "<pre>"; print_r($rooms);
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';	
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
													
								//}
								$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
							}
							}
							/* NEW for 2 room */
							}
						//echo $Final_Rate;
					
						
					}
					else
					{
					foreach($h as $ht)
					{
						
						//echo "<pre>"; print_r($ht);
						if(isset($ht['attr']['ID']))
						{
							 $hotel_id = $ht['attr']['ID'];
						}
						if(isset($ht['Hotel_Name']['value']))
						{
							$Hotel_Name = $ht['Hotel_Name']['value'];
						}
						if(isset($ht['Youtravel_Rating']['value']))
						{
							$Youtravel_Rating = $ht['Youtravel_Rating']['value'];
						}
						
						if(isset($ht['Official_Rating']['value']))
						{
							$Official_Rating = $ht['Official_Rating']['value'];
						}
						if(isset($ht['Board_Type']['value']))
						{
							$Board_Type = $ht['Board_Type']['value'];
						}
						if(isset($ht['Child_Age']['value']))
						{
							$Child_Age = $ht['Child_Age']['value'];
						}
						if(isset($ht['Country']['value']))
						{
							$Country = $ht['Country']['value'];
						}
						if(isset($ht['Destination']['value']))
						{
							$Destination = $ht['Destination']['value'];
						}
						if(isset($ht['Resort']['value']))
						{
							$Resort = $ht['Resort']['value'];
						}
						if(isset($ht['Image']['value']))
						{
							$Image = $ht['Image']['value'];
						}
						if(isset($ht['Hotel_Desc']['value']))
						{
							$Hotel_Desc = $ht['Hotel_Desc']['value'];
						}
						if(isset($ht['Room_1']))
						{
							$Room_1 = array($ht['Room_1']);
							//echo"<pre>"; print_r($Room_1);
							foreach($Room_1 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								if(isset($Room['attr']['Id']))
								{
									//$room_id = $Room['attr']['Id'];
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($$Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
								else
								{
								foreach($Room as $rooms)
								{
									
									//echo "<pre>"; print_r($rooms);
									//$room_id = $rooms['attr']['Id'];
									if(isset($rooms['attr']['Id']))
									{
										$room_id = $rooms['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($rooms['Type']['value']))
									{
										$Type = $rooms['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									//$Type = $rooms['Type']['value'];
									if(isset($rooms['Board']['value']))
									{
										$Board = $rooms['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $rooms['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $rooms['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$$Offers['Lastminute_Offer'] = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									
									
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
										$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);				
								}
								//$this->Home_Model->insert_youtravel($hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
							}
							}
						if(isset($ht['Room_2']))
						{
							$Room_1 = array($ht['Room_2']);
							//echo"<pre>"; print_r($Room_1);
							foreach($Room_1 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								if(isset($Room['attr']['Id']))
								{
									//$room_id = $Room['attr']['Id'];
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($$Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
								else
								{
								foreach($Room as $rooms)
								{
									
									//echo "<pre>"; print_r($rooms);
									//$room_id = $rooms['attr']['Id'];
									if(isset($rooms['attr']['Id']))
									{
										$room_id = $rooms['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($rooms['Type']['value']))
									{
										$Type = $rooms['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									//$Type = $rooms['Type']['value'];
									if(isset($rooms['Board']['value']))
									{
										$Board = $rooms['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $rooms['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $rooms['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$$Offers['Lastminute_Offer'] = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									
									
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
										$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);				
								}
								//$this->Home_Model->insert_youtravel($hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
							}
							}
						if(isset($ht['Room_3']))
						{
							$Room_3 = array($ht['Room_3']);
							//echo"<pre>"; print_r($Room_1);
							foreach($Room_3 as $rm)
							{
								
								$Passengers = $rm['Passengers'];
								foreach($Passengers as $ps)
								{
									//echo"<pre>"; print_r($ps);
									$Adults = $ps['Adults'];
									$Children = $ps['Children'];
									$Infants = $ps['Infants'];
								}
								$Room = $rm['Room'];
								//echo"<pre>"; print_r($Room);
								if(isset($Room['attr']['Id']))
								{
									//$room_id = $Room['attr']['Id'];
									if(isset($Room['attr']['Id']))
									{
										$room_id = $Room['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($Room['Type']['value']))
									{
										$Type = $Room['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									if(isset($Room['Board']['value']))
									{
										$Board = $Room['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $Room['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $Room['Offers']['attr'];
									if(isset($$Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$Lastminute_Offer = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
									$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
								else
								{
								foreach($Room as $rooms)
								{
									
									//echo "<pre>"; print_r($rooms);
									//$room_id = $rooms['attr']['Id'];
									if(isset($rooms['attr']['Id']))
									{
										$room_id = $rooms['attr']['Id'];
									}
									else
									{
										$room_id = '';
									}
									if(isset($rooms['Type']['value']))
									{
										$Type = $rooms['Type']['value'];
									}
									else
									{
										$Type = '';
									}
									//$Type = $rooms['Type']['value'];
									if(isset($rooms['Board']['value']))
									{
										$Board = $rooms['Board']['value'];
									}
									else
									{
										$Board = '';
									}
									$Rates = $rooms['Rates']['attr'];
									if(isset($Rates['Original_Rate']))
									{
										$Original_Rate = $Rates['Original_Rate'];
									}
									else
									{
										$Original_Rate = '';
									}
									$Final_Rate = $Rates['Final_Rate'];
									if($Rates['Final_Rate'] != '')
									{
										$Final_Rate = $Rates['Final_Rate'];
									}
									else
									{
										$Final_Rate = '';
									}
									$Offers = $rooms['Offers']['attr'];
									if(isset($Offers['Lastminute_Offer']))
									{
										$Lastminute_Offer = $Offers['Lastminute_Offer'];
									}
									else
									{
										$$Offers['Lastminute_Offer'] = '';
									}
									if(isset($Offers['Early_Booking_Discount']))
									{
										$Early_Booking_Discount = $Offers['Early_Booking_Discount'];
									}
									else
									{
										$Early_Booking_Discount = '';
									}
									
									if(isset($Offers['Free_Stay']))
									{
										$Free_Stay = $Offers['Free_Stay'];
									}
									else
									{
										$Free_Stay= '';	
									}
									
									if(isset($Offers['Free_Transfer']))
									{
										$Free_Transfer = $Offers['Free_Transfer'];
									}
									else
									{
										$Free_Transfer= '';	
									}
									
									
									//$Gala_Meals = $Offers['Gala_Meals'];
									if(isset($Offers['Gala_Meals']))
									{
										$Gala_Meals = $Offers['Gala_Meals'];
									}
									else
									{
										$Gala_Meals= '';	
									}
									$id = $this->Home_Model->insert_youtravel($cin,$cout,$session_you,$days,$sec_res,$hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);				
								}
								//$this->Home_Model->insert_youtravel($hotel_id,$Hotel_Name,$Youtravel_Rating,$Official_Rating,$Board_Type,$Child_Age,$Country,$Destination,$Resort,$Image,$Hotel_Desc,$Adults,$Children,$Infants,$room_id,$Type,$Board,$Original_Rate,$Final_Rate,$Lastminute_Offer,$Early_Booking_Discount,$Free_Stay,$Free_Transfer,$Gala_Meals);
								}
							}
							}
							
							
						//echo $Final_Rate;
					}
					
					}
					}
					
				
			}
				
			
				
		}
		function hotel_det_trav1()
		{
			$room_id = $this->input->post('room_id');
			$room_id2 = $this->input->post('room2_id');
			$hotel_id = $this->input->post('hotel_id');
			
			$this->Home_Model->delete_hotel_det($hotel_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$data['room_id2'] = $room_id2;
			$url = 'http://xml.youtravel.com/webservices/get_hoteldetails.asp?LangID=EN&HID='.$hotel_id.'&Username=egyptspirit&Password=sprite2013';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			//echo "<pre>"; print_r($array); 
			if(isset($array['HtSearchRq']['Hotel']))
			{
				$Success = $array['HtSearchRq']['Success']['value']; 
				$LangID = $array['HtSearchRq']['LangID']['value']; 
				$Destination = $array['HtSearchRq']['Destination']['value']; 
				$HID = $array['HtSearchRq']['HID']['value']; 
				$Hotel = $array['HtSearchRq']['Hotel'];
				$name = $Hotel['attr']['Name'];
				$Youtravel_Rating = $Hotel['Youtravel_Rating']['value'];
				$Official_Rating = $Hotel['Official_Rating']['value'];
				$Board_Type = $Hotel['Board_Type']['value'];
				$Hotel_Desc = $Hotel['Hotel_Desc']['value'];
				
				$Hotel_Photos = $Hotel['Hotel_Photos'];
				//echo "<pre>"; print_r($Hotel_Photos);
				foreach($Hotel_Photos as $photo)
				{
					foreach($photo as $ph)
					{
						//echo "<pre>"; print_r($ph);
						$photos = $ph['value'];
						$this->Home_Model->insert_hotelphotos($hotel_id,$photos);
					}
				}
				$Hotel_Facilities = $Hotel['Hotel_Facilities'];
				foreach($Hotel_Facilities as $fac)
				{
					foreach($fac as $faci)
					{
						//echo "<pre>"; print_r($ph);
						 $facility = $faci['value'];
						$this->Home_Model->insert_hotelfac($hotel_id,$facility);
					}
				}
				$Room_Types = $Hotel['Room_Types'];
				//echo "<pre>"; print_r($Room_Types);
				$Room = $Room_Types['Room']; 
				//echo "<pre>"; print_r($Room);
				if(isset($Room['attr']))
				{
					$room_name = $Room['attr']['name'];
					$rom_fac = $Room['Facility'];
					foreach($rom_fac as $rom_fac)
					{
						$room_facility = $rom_fac['value'];
						$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
					}
					
				}
				else
				{
					foreach($Room as $rom)	
					{
						$room_name = $rom['attr']['name'];
						$rom_fac = $rom['Facility'];
						foreach($rom_fac as $rom_fac)
						{
							$room_facility = $rom_fac['value'];
							$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
						}
					}
				}
				$AI_Type = $Hotel['AI_Type']['value'];
				$AI_Desc = $Hotel['AI_Desc']['value'];
				$AI_Facilities = $Hotel['AI_Facilities'];
				$AI_Facility = $AI_Facilities['AI_Facility'];
				foreach($AI_Facility as $ai_fac)
				{
					$AI_Facility = $ai_fac['value'];
				}
				//$extras = $Hotel['Erratas']['value'];
				$this->Home_Model->youtravel_hotel_det($hotel_id,$Success,$LangID,$Destination,$name,$Official_Rating,$Board_Type,$Hotel_Desc);
			}
			$data['hotel_det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			$data['hotel_det2'] = $this->Home_Model->youtravel_hotel_det2($hotel_id);
			$data['hotel_fac'] = $this->Home_Model->youtravel_hotel_fac($hotel_id);
			$data['room_fac'] = $this->Home_Model->youtravel_room_fac($hotel_id);
			$data['pictures'] = $this->Home_Model->youtravel_pictures($hotel_id);
			$this->load->view('youtravel_hotel_det_new',$data);
		
		}
		function hotel_det_trav2()
		{
			$room_id = $this->input->post('room_id');
			$room_id2 = $this->input->post('room2_id');
			$room_id3 = $this->input->post('room3_id');
			$hotel_id = $this->input->post('hotel_id');
			
			$this->Home_Model->delete_hotel_det($hotel_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$data['room_id2'] = $room_id2;
			$data['room_id3'] = $room_id3;
			$url = 'http://xml.youtravel.com/webservices/get_hoteldetails.asp?LangID=EN&HID='.$hotel_id.'&Username=egyptspirit&Password=sprite2013';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			//echo "<pre>"; print_r($array); 
			if(isset($array['HtSearchRq']['Hotel']))
			{
				$Success = $array['HtSearchRq']['Success']['value']; 
				$LangID = $array['HtSearchRq']['LangID']['value']; 
				$Destination = $array['HtSearchRq']['Destination']['value']; 
				$HID = $array['HtSearchRq']['HID']['value']; 
				$Hotel = $array['HtSearchRq']['Hotel'];
				$name = $Hotel['attr']['Name'];
				$Youtravel_Rating = $Hotel['Youtravel_Rating']['value'];
				$Official_Rating = $Hotel['Official_Rating']['value'];
				$Board_Type = $Hotel['Board_Type']['value'];
				$Hotel_Desc = $Hotel['Hotel_Desc']['value'];
				
				$Hotel_Photos = $Hotel['Hotel_Photos'];
				//echo "<pre>"; print_r($Hotel_Photos);
				foreach($Hotel_Photos as $photo)
				{
					foreach($photo as $ph)
					{
						//echo "<pre>"; print_r($ph);
						$photos = $ph['value'];
						$this->Home_Model->insert_hotelphotos($hotel_id,$photos);
					}
				}
				$Hotel_Facilities = $Hotel['Hotel_Facilities'];
				foreach($Hotel_Facilities as $fac)
				{
					foreach($fac as $faci)
					{
						//echo "<pre>"; print_r($ph);
						 $facility = $faci['value'];
						$this->Home_Model->insert_hotelfac($hotel_id,$facility);
					}
				}
				$Room_Types = $Hotel['Room_Types'];
				//echo "<pre>"; print_r($Room_Types);
				$Room = $Room_Types['Room']; 
				//echo "<pre>"; print_r($Room);
				if(isset($Room['attr']))
				{
					$room_name = $Room['attr']['name'];
					$rom_fac = $Room['Facility'];
					foreach($rom_fac as $rom_fac)
					{
						$room_facility = $rom_fac['value'];
						$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
					}
					
				}
				else
				{
					foreach($Room as $rom)	
					{
						$room_name = $rom['attr']['name'];
						$rom_fac = $rom['Facility'];
						foreach($rom_fac as $rom_fac)
						{
							$room_facility = $rom_fac['value'];
							$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
						}
					}
				}
				$AI_Type = $Hotel['AI_Type']['value'];
				$AI_Desc = $Hotel['AI_Desc']['value'];
				$AI_Facilities = $Hotel['AI_Facilities'];
				$AI_Facility = $AI_Facilities['AI_Facility'];
				foreach($AI_Facility as $ai_fac)
				{
					$AI_Facility = $ai_fac['value'];
				}
				//$extras = $Hotel['Erratas']['value'];
				$this->Home_Model->youtravel_hotel_det($hotel_id,$Success,$LangID,$Destination,$name,$Official_Rating,$Board_Type,$Hotel_Desc);
			}
			$data['hotel_det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			$data['hotel_det2'] = $this->Home_Model->youtravel_hotel_det2($hotel_id);
			$data['hotel_fac'] = $this->Home_Model->youtravel_hotel_fac($hotel_id);
			$data['room_fac'] = $this->Home_Model->youtravel_room_fac($hotel_id);
			$data['pictures'] = $this->Home_Model->youtravel_pictures($hotel_id);
			$this->load->view('youtravel_hotel_det_new2',$data);
		
		}
		function hotel_det_trav($hotel_id,$room_id)
		{
			$this->Home_Model->delete_hotel_det($hotel_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$url = 'http://xml.youtravel.com/webservices/get_hoteldetails.asp?LangID=EN&HID='.$hotel_id.'&Username=egyptspirit&Password=sprite2013';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			//echo "<pre>"; print_r($array); 
			if(isset($array['HtSearchRq']['Hotel']))
			{
				$Success = $array['HtSearchRq']['Success']['value']; 
				$LangID = $array['HtSearchRq']['LangID']['value']; 
				$Destination = $array['HtSearchRq']['Destination']['value']; 
				$HID = $array['HtSearchRq']['HID']['value']; 
				$Hotel = $array['HtSearchRq']['Hotel'];
				$name = $Hotel['attr']['Name'];
				$Youtravel_Rating = $Hotel['Youtravel_Rating']['value'];
				$Official_Rating = $Hotel['Official_Rating']['value'];
				$Board_Type = $Hotel['Board_Type']['value'];
				$Hotel_Desc = $Hotel['Hotel_Desc']['value'];
				
				$Hotel_Photos = $Hotel['Hotel_Photos'];
				//echo "<pre>"; print_r($Hotel_Photos);
				foreach($Hotel_Photos as $photo)
				{
					foreach($photo as $ph)
					{
						//echo "<pre>"; print_r($ph);
						$photos = $ph['value'];
						$this->Home_Model->insert_hotelphotos($hotel_id,$photos);
					}
				}
				$Hotel_Facilities = $Hotel['Hotel_Facilities'];
				foreach($Hotel_Facilities as $fac)
				{
					foreach($fac as $faci)
					{
						//echo "<pre>"; print_r($ph);
						 $facility = $faci['value'];
						$this->Home_Model->insert_hotelfac($hotel_id,$facility);
					}
				}
				$Room_Types = $Hotel['Room_Types'];
				//echo "<pre>"; print_r($Room_Types);
				$Room = $Room_Types['Room']; 
				//echo "<pre>"; print_r($Room);
				if(isset($Room['attr']))
				{
					$room_name = $Room['attr']['name'];
					$rom_fac = $Room['Facility'];
					foreach($rom_fac as $rom_fac)
					{
						$room_facility = $rom_fac['value'];
						$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
					}
					
				}
				else
				{
					foreach($Room as $rom)	
					{
						$room_name = $rom['attr']['name'];
						$rom_fac = $rom['Facility'];
						foreach($rom_fac as $rom_fac)
						{
							$room_facility = $rom_fac['value'];
							$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
						}
					}
				}
				$AI_Type = $Hotel['AI_Type']['value'];
				$AI_Desc = $Hotel['AI_Desc']['value'];
				$AI_Facilities = $Hotel['AI_Facilities'];
				$AI_Facility = $AI_Facilities['AI_Facility'];
				foreach($AI_Facility as $ai_fac)
				{
					$AI_Facility = $ai_fac['value'];
				}
				//$extras = $Hotel['Erratas']['value'];
				$this->Home_Model->youtravel_hotel_det($hotel_id,$Success,$LangID,$Destination,$name,$Official_Rating,$Board_Type,$Hotel_Desc);
			}
			$data['hotel_det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			$data['hotel_det2'] = $this->Home_Model->youtravel_hotel_det2($hotel_id);
			$data['hotel_fac'] = $this->Home_Model->youtravel_hotel_fac($hotel_id);
			$data['room_fac'] = $this->Home_Model->youtravel_room_fac($hotel_id);
			$data['pictures'] = $this->Home_Model->youtravel_pictures($hotel_id);
			$this->load->view('youtravel_hotel_det',$data);
		}
		function hotel_extra($hotel_id,$room_id)
	   {
		   		
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			
		   $this->load->view('hotel_extrass',$data);
	   }
	   function hotel_extra_new($hotel_id,$room_id,$room_id2)
	   {
		   		
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			$data['room_det2'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id2);
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			
		   $this->load->view('hotel_extrass_new',$data);
	   }
	   function hotel_extra_new2($hotel_id,$room_id,$room_id2)
	   {
		   		
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			$data['room_det2'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id2);
			$data['room_det3'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id2);
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			
		   $this->load->view('hotel_extrass_new2',$data);
	   }
	   
	   function hotel_transfer_add($hotel_id,$room_id)
	   {
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$this->load->view('hotel_transfer',$data);
	   }
	   function hotel_excursion_add($hotel_id,$room_id,$ex_id)
	   {
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			
			$destination = $this->session->userdata('airport_to');
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
			$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$this->load->view('hotel_activity',$data);
	   }
	   function hotel_booking_withact($hotel_id,$room_id,$ex_id)
		{
			 	
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$data['ex_det'] = $this->Home_Model->get_excursion_det($ex_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$this->load->view('hotel_booking_withact',$data);
		}
		function hotel_booking($hotel_id,$room_id)
		{
			 	
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$data['country'] = $this->Home_Model->get_country();
			$this->load->view('hotel_booking',$data);
		}
		function book_package()
		{
			$data['amount'] = $this->input->post('amount');
			$this->load->view('paypal',$data);
		}
		function book_package_hotelcrs($hotel_id)
		{
			$data['hotel_id'] = $hotel_id;
			$data['amount'] = $this->input->post('amount');
			$this->load->view('paypal',$data);
		}
		function book_flight_hotel()
		{
			$data['amount'] = $this->input->post('amount');
			$this->load->view('paypal_flight',$data);
		}
		function hotel_booking_withtran($hotel_id,$room_id)
		{
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$this->load->view('hotel_booking_withtran',$data);
		}
		function hotel_excursion_add1($hotel_id,$room_id,$ex_id)
	   {
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			
			$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			
			$destination = $this->session->userdata('airport_to');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			
			$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$this->load->view('hotel_activity',$data);
	   }
		function youtravel_booking($hotel_id,$room_id)
		{
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			
			$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			$data['hotel_det2'] = $this->Home_Model->youtravel_hotel_det2($hotel_id);
			$data['hotel_fac'] = $this->Home_Model->youtravel_hotel_fac($hotel_id);
			$data['room_fac'] = $this->Home_Model->youtravel_room_fac($hotel_id);
			$this->load->view('youtravel_booking_from',$data);
		}
		function youtravel_book()
		{
			$cin = $this->session->userdata('cin');
			$cout = $this->session->userdata('cout');
			$hotel_id = $this->input->post('hotel_id');
			$room_id = $this->input->post('room_id');
			$checkin = $this->session->userdata('check_in_new');
			$ADLTS_1 = $this->session->userdata('ADLTS_1'); 
			$ADLTS_2 = $this->session->userdata('ADLTS_2');
			$ADLTS_3 = $this->session->userdata('ADLTS_3');
			$CHILD_1 = $this->session->userdata('CHILD_1');
			$CHILD_2 = $this->session->userdata('CHILD_2');
			$CHILD_3 = $this->session->userdata('CHILD_3');
			$ChildAgeR1C1 = $this->session->userdata('ChildAgeR1C1');
			$ChildAgeR1C2 = $this->session->userdata('ChildAgeR1C2');
			$ChildAgeR2C1 = $this->session->userdata('ChildAgeR2C1');
			$ChildAgeR2C2 = $this->session->userdata('ChildAgeR2C2');
			$ChildAgeR3C1 = $this->session->userdata('ChildAgeR3C1');
			$ChildAgeR3C2 = $this->session->userdata('ChildAgeR3C2');
			$nor = $this->session->userdata('nor');
			$All_board=$this->session->userdata('All_board');
			$roomonly=$this->session->userdata('roomonly');
			$self_cat=$this->session->userdata('self_cat');
			$bed_break=$this->session->userdata('bed_break');
			$half_board= $this->session->userdata('half_board');
			$full_board =$this->session->userdata('full_board');
			$all_inclusive=$this->session->userdata('$all_inclusive');
			$villa=$this->session->userdata('villa');
			$all_star= $this->session->userdata('all_star');
			$star1= $this->session->userdata('star1');
			$star2 = $this->session->userdata('star2');
			$star3 = $this->session->userdata('star3');
			$star4 = $this->session->userdata('star4');
			$star5 = $this->session->userdata('star5');
			$days = $this->session->userdata('dt'); 
			$session = $this->Home_Model->get_sessionid($hotel_id,$room_id);
			$sessionid = $session->sessionid;
			$room_type = $session->room_type;
			$Room1_Rate = $session->final_rate;
			$email = $this->input->post('email');
			$contact_no = $this->input->post('contact');
			$Customer_title1 = $this->input->post('salutation');
			$Customer_title = $Customer_title1[0];
			$fname1 = $this->input->post('fname');
			$Customer_firstname = $fname1[0];
			$lname =  $this->input->post('lname');
			$Customer_Lastname = $lname[0]; 
			$url = 'http://testxml.youtravel.com/webservices/bookings.asp?LangID=EN&HID='.$hotel_id.'&Username=xmltestme&Password=testme&Session_ID='.$sessionid.'&Checkin_Date='.$checkin.'&Nights='.$days.'&Rooms='.$nor.'&ADLTS_1='.$ADLTS_1.'&CHILD_1='.$CHILD_1.'&ADLTS_2='.$ADLTS_2.'&CHILD_2='.$CHILD_2.'&ADLTS_3='.$ADLTS_3.'&CHILD_3='.$CHILD_3.'&ChildAgeR1C1='.$ChildAgeR1C1.'&ChildAgeR1C2='.$ChildAgeR1C2.'&ChildAgeR2C1='.$ChildAgeR2C1.'&ChildAgeR2C2='.$ChildAgeR2C2.'&ChildAgeR3C1='.$ChildAgeR3C1.'&ChildAgeR3C2='.$ChildAgeR3C2.'&RID='.$room_id.'&Customer_title='.$Customer_title.'&Customer_firstname='.$Customer_firstname.'&Customer_Lastname='.$Customer_Lastname.'&Room1_Rate='.$Room1_Rate.'&Email='.$email.'';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			//echo "<pre>"; print_r($array);
			if(isset($array['HtSearchRq']))
			{
				$res = $array['HtSearchRq'];
				$Success = $res['Success']['value'];
				$ErrorMsg = $res['ErrorMsg']['value'];
				if($Success == 'False')
				{
					if($ErrorMsg == 'Current rate for Room1_Rate is different than the original search')
					{
						$ErrorMsg = $res['ErrorMsg']['value'];
						$new_rate = $res['New_Rate']['value'];
						//echo $new_rate;
						$Room1_Rate = $new_rate;
						$url = 'http://testxml.youtravel.com/webservices/bookings.asp?LangID=EN&HID='.$hotel_id.'&Username=xmltestme&Password=testme&Session_ID='.$sessionid.'&Checkin_Date='.$checkin.'&Nights='.$days.'&Rooms='.$nor.'&ADLTS_1='.$ADLTS_1.'&CHILD_1='.$CHILD_1.'&ADLTS_2='.$ADLTS_2.'&CHILD_2='.$CHILD_2.'&ADLTS_3='.$ADLTS_3.'&CHILD_3='.$CHILD_3.'&ChildAgeR1C1='.$ChildAgeR1C1.'&ChildAgeR1C2='.$ChildAgeR1C2.'&ChildAgeR2C1='.$ChildAgeR2C1.'&ChildAgeR2C2='.$ChildAgeR2C2.'&ChildAgeR3C1='.$ChildAgeR3C1.'&ChildAgeR3C2='.$ChildAgeR3C2.'&RID='.$room_id.'&Customer_title='.$Customer_title.'&Customer_firstname='.$Customer_firstname.'&Customer_Lastname='.$Customer_Lastname.'&Room1_Rate='.$Room1_Rate.'&Email='.$email.'';
						$res_new = $this->get_data($url);
						$array_new =$this->xml2array($res_new);	
						//echo "<pre>"; 	print_r($array_new); 
						$res_book = $array_new['HtSearchRq'];
						$Success_book = $res_book['Success']['value'];	
						$Booking_ref_book = $res_book['Booking_ref']['value'];
						$Voucher_Url_book = $res_book['Voucher_Url']['value'];
						$api = 'youtravel';
						$book_id = $this->Home_Model->insert_book_youtravel($api,$cin,$cout,$hotel_id,$room_type,$Room1_Rate,$Booking_ref_book,$Voucher_Url_book);
						for($i=0; $i< count($fname1); $i++)
						{
							$this->Home_Model->insert_passenger_info($contact_no,$fname1[$i],$lname[$i],$Customer_title1[$i],$email,$book_id);
						}
						$data['bookid'] = $book_id;
						$data['Voucher_Url_book'] = $Voucher_Url_book;
						$data['Booking_ref_book']= $Booking_ref_book;
						redirect('home/youtravel_success/'.$book_id,'refresh');
						
					}
					
					if($ErrorMsg == 'Session Expired')
					{
						$data['error'] = 'Your Session Expired, Please do a Research for the Hotels <a href='.WEB_URL.'home/index><b>Search from here</b></a>';
						$data['hotel_det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
						$this->load->view('youtravel_errors',$data);
					}
				}
				elseif($ErrorMsg == "The room does not exist or it doesn't belong to the specific hotel or it cannot occupy the number of people")
				{
					$data['error'] = $ErrorMsg;
					$data['hotel_det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
					$this->load->view('youtravel_errors',$data);
				}
				else
				{
					$res1 = $array['HtSearchRq'];
					$Success = $res1['Success']['value'];	
					$Booking_ref = $res1['Booking_ref']['value'];
					$Voucher_Url = $res1['Voucher_Url']['value'];
				}
			}
			
		}
		function youtravel_success($bookid)
		{
			$data['bookid'] = $bookid;
			$res = $this->Home_Model->get_book_det($bookid);
			$data['Voucher_Url_book'] = $res->voucher_url;
			$data['booking_refno'] = $res->booking_ref_no;
			$this->load->view('youtravel_success',$data);			
		}
		function cancel_youtravel($booking_refno)
		{
			$url = 'http://testxml.youtravel.com/webservices/get_canx_fees.asp?Booking_ref='.$booking_refno.'&Username=xmltestme&Password=testme';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			//echo "<pre>"; print_r($array); exit;
			if(isset($array['HtSearchRq']))
			{
				$res = $array['HtSearchRq'];
				$Booking_ref = $res['Booking_ref']['value'];
				$data['fees'] = $Fees = $res['Fees']['value'];
				$Currency = $res['Currency']['value'];
			}
			else
			{
				$data['fees'] = '0';
			}
			$data['booking_refno'] = $booking_refno;
			$this->load->view('youtravel_confirm',$data);
		}
		function cancelconfirm_youtravel($booking_refno,$fees)
		{
			$url ='http://testxml.youtravel.com/webservices/cancel.asp?Booking_ref='.$booking_refno.'&Username=xmltestme&Password=testme';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			
			//echo "<pre>"; print_r($array); exit;
			if(isset($array['HtSearchRq']))
			{
				$res = $array['HtSearchRq'];
				$Success = $res['Success']['value'];
				$Booking_ref = $res['Booking_ref']['value'];
			}
			$data['fees'] = $fees;
			$data['booking_refno'] = $booking_refno;
			$this->load->view('youtravel_complete',$data);
			
		}
		function xml2array($contents, $get_attributes=1)
		{
			
				
				/**
				* xml2array() will convert the given XML text to an array in the XML structure.
				* Link: http://www.bin-co.com/php/scripts/xml2array/
				* Arguments : $contents - The XML text
				* $get_attributes - 1 or 0. If this is 1 the function will get the attributes as well as the tag values - this results in a different 							array structure in the return value.
				* Return: The parsed XML in an array form.
				*/
				if(!$contents) return array();
				
				if(!function_exists('xml_parser_create')) 
				{
				//print "'xml_parser_create()' function not found!";
				return array();
				}
				//Get the XML parser of PHP - PHP must have this module for the parser to work
				$parser = xml_parser_create();
				xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
				xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
				xml_parse_into_struct( $parser, $contents, $xml_values );
				xml_parser_free( $parser );
				
				if(!$xml_values) return;//Hmm...
				
				// Initializations
				$xml_array = array();
				$parents = array();
				$opened_tags = array();
				$arr = array();
				
				$current = &$xml_array;
				
				//Go through the tags.
				foreach($xml_values as $data) {
				unset($attributes,$value);//Remove existing values, or there will be trouble
				
				//This command will extract these variables into the foreach scope
				// tag(string), type(string), level(int), attributes(array).
				extract($data);//We could use the array by itself, but this cooler.
				
				$result = '';
				if($get_attributes) {//The second argument of the function decides this.
				$result = array();
				if(isset($value)) $result['value'] = $value;
				
				// Set the attributes too.
				if(isset($attributes)) {
				foreach($attributes as $attr => $val) {
				if($get_attributes == 1) $result['attr'][$attr] = $val; // Set all the attributes in a array called 'attr'
				/** : TODO: should we change the key name to '_attr'? Someone may use the tagname 'attr'. Same goes for 'value' too */
				}
				}
				} elseif(isset($value)) {
				$result = $value;
				}
				
				// See tag status and do the needed.
				if($type == "open") { // The starting of the tag "
				$parent[$level-1] = &$current;
				
				if(!is_array($current) or (!in_array($tag, array_keys($current)))) { // Insert New tag
				$current[$tag] = $result;
				$current = &$current[$tag];
				
				} else { // There was another element with the same tag name
				if(isset($current[$tag][0])) {
				array_push($current[$tag], $result);
				} else {
				$current[$tag] = array($current[$tag],$result);
				}
				$last = count($current[$tag]) - 1;
				$current = &$current[$tag][$last];
				}
				
				} elseif($type == "complete") { // Tags that ends in 1 line "
				// See if the key is already taken.
				if(!isset($current[$tag])) { // New Key
				$current[$tag] = $result;
				
				} else { // If taken, put all things inside a list(array)
				if((is_array($current[$tag]) and $get_attributes == 0)//If it is already an array\85
				or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $get_attributes == 1)) {
				array_push($current[$tag],$result); // \85push the new element into that array.
				} else { //If it is not an array\85
				$current[$tag] = array($current[$tag],$result); //\85Make it an array using using the existing value and the new value
				}
				}
				
				} elseif($type == 'close') { //End of tag "
				$current = &$parent[$level-1];
				}
				}
				//print_r( $xml_array);
				return($xml_array);
		
			
		}
		function search_hotel()
	    {
		$city1=$this->session->userdata('citycode');
		if($city1=="")
		{
			$city1=$this->input->post('citycode');
			
		}
		//$expcicode=explode(",",$city1);
		
		//$citi=$expcicode[0];
		//$cntry=$expcicode[1];
			//echo $city1; exit;
		
		$row1=$this->Home_Model->cityCode_gta($city1);
		if($row1 !='')
		{
			$city_gta_code=trim($row1->cityCode);
			$destinationType=trim($row1->destinationType);
			$countrycode=trim($row1->countryCode);
		}
		$roomcount=$this->session->userdata('roomcount');
		$roomusedtypeval=$this->session->userdata('roomusedtype');
		$roomusedtype=$roomusedtypeval[0];
						
		//$city=$city_gta_code;			
		$sec_res=$this->session->userdata('sec_res');	
		//$cin=$this->session->userdata('sec_res');	
		//$cout=$this->session->userdata('sec_res');	
		$check_in = $this->input->post('sd');
		$check_out = $this->input->post('ed');		
		$costval=$this->input->post('costtype');
		$out=explode("/",$this->input->post('ed'));
		$cout=$out[2]."-".$out[1]."-".$out[0];
		$in=explode("/",$this->input->post('sd'));
		$cin=$in[2]."-".$in[1]."-".$in[0];
		$diff = strtotime($cout) - strtotime($cin);
		
		$data['rtype']=$roomusedtype;
		$child=0;
        $adult=0;
		$noofroom1=0;
			for($i=0;$i< count($roomcount);$i++)
			{
			
                switch($roomusedtypeval[$i])
				{
					case 1:
						$adult=$adult+(1*$roomcount[$i]);
						$noofroom1=$noofroom1+$roomcount[$i];
					break;
					
					case 3:				
						$adult=$adult+(2*$roomcount[$i]);
						$noofroom1=$noofroom1+$roomcount[$i];
					break;
					
					case 9:
						$adult=$adult+(4*$roomcount[$i]);
						$noofroom1=$noofroom1+$roomcount[$i];
					break;
					
					case 6:
						$adult=$adult+(2*$roomcount[$i]);
						$noofroom1=$noofroom1+$roomcount[$i];
					break;
					
					case 5:
						 $adult=$adult+(1*$roomcount[$i]);
						 $noofroom1=$noofroom1+$roomcount[$i];
				   break;
				   
				   case 8:
						 $adult=$adult+(3*$roomcount[$i]);
						 $noofroom1=$noofroom1+$roomcount[$i];
				   break;
				   
				   case 4:												
						 $child=$child+(1*$roomcount[$i]);
						 $adult=$adult+(2*$roomcount[$i]);	
						 $noofroom1=$noofroom1+$roomcount[$i]; 
					break;
					
					case 7:
						$child=$child+(1*$roomcount[$i]);
						$adult=$adult+(2*$roomcount[$i]);								
						$noofroom1=$noofroom1+$roomcount[$i];					
					break;
				}
									
			}
                        
				$data['child']=$child;
               	$data['adult']=$adult;
				$data['nor']=$noofroom1;
				$data['room']=$noofroom=$noofroom1;		
		
		$sec   = $diff % 60;
		$diff  = intval($diff / 60);
		$min   = $diff % 60;
		$diff  = intval($diff / 60);
		$hours = $diff % 24;
		$days  = intval($diff / 24);
		$data['dt']=$days;
		$this->session->set_userdata(array('check_in_new'=>$check_in,'dt'=>$days,'adult'=>$data['adult'],'child'=>$data['child'],'nor'=>$data['nor'],
		'cin'=>$cin,'cout'=>$cout,'rtype'=>$data['rtype']));
		//echo $adult; exit;
		$this->crs_availability($cin,$cout,$days,$sec_res);
		$country_travel = $this->session->userdata('country_travel');
		$destination = $this->session->userdata('destination');
		$resort = $this->session->userdata('resort');
		$this->hotel_search_youtravel($country_travel,$destination,$resort);

		//exit;
		redirect('home/search_result','refresh');
	}	
	function crs_availability($cin,$cout,$days,$sec_res)
	{
		//echo "<pre>"; print_r($this->session->userdata); exit;
	$hotelName = $this->session->userdata('hotel_name');
	$roomusedtype = $this->session->userdata('roomusedtype');
	//print_r($roomusedtype); exit;
	$roomcount = $this->session->userdata('roomcount');
	   $condition='';
	   $sel='';
	  // echo $hotelName;
	   for($rm=0;$rm< count($roomcount);$rm++)
	   {
		  // echo $roomusedtype[$rm]; exit;
	    if($roomusedtype[$rm]==1 )
	    {
			if(!empty($hotelName) && $hotelName !='Enter Hotel name')
			{
				
				$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
				
			}
	    //$condition .= " AND b.single_room > 0";
		// $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
	     $sel .= ",b.single_room";
		 
	    }
	    if($roomusedtype[$rm]==3)
	    {
			if(!empty($hotelName) && $hotelName !='Enter Hotel name')
			{
				$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
				
			}
	    // $condition .= " AND b.twin_room > 0";
		// $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
	    // $sel .= ",b.twin_room";
		 $sel .= ",b.single_room";
	    }
		 if($roomusedtype[$rm]==4)
	    {
			if(!empty($hotelName) && $hotelName !='Enter Hotel name')
			{
				$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
				
			}
	   //  $condition .= " AND b.twin_room > 0";
		// $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
	     $sel .= ",b.twin_room";
	    }
		 if($roomusedtype[$rm]==7)
	    {
			if(!empty($hotelName) && $hotelName !='Enter Hotel name')
			{
				$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
				
			}
	    // $condition .= " AND b.twin_room > 0";
		// $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
	     $sel .= ",b.triple_room";
	    }
	    if($roomusedtype[$rm]==8)
	    {
			if(!empty($hotelName))
			{
				$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
				
			}
	     //$condition .= " AND b.triple_room > 0";
		// $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
	     $sel .= ",b.triple_room";
	    }
	    if($roomusedtype[$rm]==9)
	    {
			if(!empty($hotelName))
			{
				$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
				
			}
	     //$condition .= " AND b.quad_room > 0";
		 //$condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
	     $sel .= ",b.quad_room";
	    }
	   }
	   $cin=$this->session->userdata('cin');
	  $cout=$this->session->userdata('cout');
	 	$city=$this->session->userdata('citycode'); 
	 //echo  $city = $this->session->userdata('destination'); exit;
		//echo $condition; exit;
		//echo "SELECT a.*,b.categoryname,b.breakfast,b.roomdescription $sel FROM hotel_details AS a INNER JOIN room_details AS b ON a.hotel_id=b.hotel_id  WHERE  a.city='$city' AND a.status='active'  $condition GROUP BY b.hotel_id"; exit;
		//SELECT a.*,b.categoryname,b.breakfast,b.roomdescription $sel FROM hotel_details AS a INNER JOIN room_details AS b ON a.hotel_id=b.hotel_id  WHERE  a.city ='$city' AND a.status='active' $condition GROUP BY b.hotel_id 
		//
	 $querydb=$this->db->query("SELECT a.*,b.categoryname,b.breakfast,b.roomdescription $sel FROM hotel_details AS a INNER JOIN room_details AS b ON a.hotel_id=b.hotel_id  WHERE  a.city='$city' AND a.status='active'  $condition GROUP BY b.hotel_id");
	

		
		   $resultdb=$querydb->result();
		   $rw= $querydb->num_rows(); 	
		   for($i=0;$i < count($resultdb); $i++)
		   {
			   
			   $cityCode = $resultdb[$i]->city;
			    $hotel_id=$resultdb[$i]->hotel_id;
			    $itemCode=$resultdb[$i]->hotel_code;
			    $itemVal=$resultdb[$i]->name;
				$starVal=$resultdb[$i]->rating;
				$roomDesc='';
				if(isset($resultdb[$i]->single_room))
				{
				$roomDesc.="Single -".$resultdb[$i]->categoryname."+";
				}
				if(isset($resultdb[$i]->twin_room))
				{
				$roomDesc.="Twin -".$resultdb[$i]->categoryname."+";
				}
				if(isset($resultdb[$i]->triple_room))
				{
				$roomDesc.="Triple -".$resultdb[$i]->categoryname."+";
				}
				if(isset($resultdb[$i]->quad_room))
				{
				$roomDesc.="Quad -".$resultdb[$i]->categoryname."+";
				}
	
	
			 $roomDesc = substr($roomDesc, 0, -1); 
	
				$meal = $resultdb[$i]->breakfast;
				if($meal == 0)
				{
					$mealsval = "Room Only";
				}
				else
				{
					$mealsval = $meal;
				}
		
				$roomdescCode = '';
				$ConfirmationVal = $resultdb[$i]->status;
			
				$desc =$resultdb[$i]->description;
				if($resultdb[$i]->image != '')
				{
				$image = WEB_DIR_ADMIN.'hotel_logo/'.$resultdb[$i]->image;
				}
				else
				{
					$image = WEB_DIR.'supplier_logo/noimage.jpg';
				}
				$supplier_id=$resultdb[$i]->supplier_id;
			
		     // $pernight=0;
			 //echo $resultdb[$i]; 
				if(isset($resultdb[$i]->single_room))
				{
					//echo "1";
					$pernight  =  $resultdb[$i]->single_room;
				}
				if(isset($resultdb[$i]->twin_room))
				{
					//echo "2";
					$pernight  = $pernight+ $resultdb[$i]->twin_room;
				}
				if(isset($resultdb[$i]->triple_room))
				{
					//echo "3";
			    	$pernight  =  $pernight+$resultdb[$i]->triple_room;
				}
				if(isset($resultdb[$i]->quad_room))
				{
					//echo "4";
			    	$pernight  =  $pernight+$resultdb[$i]->quad_room;
				}

			
				//echo $resultdb[$i]->single_room; exit;
				$currencyVal = 'GBP';
				$curtype='GBP';
			   		$dateFromValc = '';
				$dateToValc = '';  	  
				$dateFromTimeValc = '';  	  
				$dateToTimeVal = ''; 
				$serviceval = '';
				 	  $finalcurval ='';
					  $cancelCodeVal='';
					  $purTokenVal='';
	
	$roomDesc11 = $roomDesc;
	$pernight11 = $pernight;	
			//echo $pernight; 
	 //$com_rate=$this->Agent_Model->comp_info($hotel_id);
	$com_rate='';
	   if(isset($com_rate))
	   {
	     if($com_rate=="")
	     {
	      $com_rate=0;
	     }
	     else
	     {
	
			  $com_rate=$com_rate[0]->comprate;
		  }
	   }
		 $hotel_mark=0;
		 $admark=0;
		//$hotel_markup=$this->Agent_Model->markup_supplier($hotel_id);
		$hotel_markup='';
		if($hotel_markup!="")
		{
	    $hotel_markup_type=$hotel_markup->type;

	     if($hotel_markup_type=='amt')
	     {
		$hotel_mark=$hotel_markup->amount;
	      
	      
	     }
	     else
	     {
		$markup=$hotel_markup->markup;
		 $hotel_mark=$pernight11*$markup/100;
	     
	     }
	     
	     
	   
	   
		}
		  $api4="gta";
	      $common_commission=$this->Home_Model->get_common_markup($api4);
	      $admark=$common_commission*$pernight11/100;
	  //echo $pernight11; exit;
	  $finalperNightValh= $pernight11+$hotel_mark+$admark+$com_rate;
	  $night=$this->session->userdata('dt');	
	  $finalNightValh = $finalperNightValh*$night;
	
		//echo $finalNightValh; exit;
	  $api4='crs';
			$this->Home_Model->insert_search_result_crs($sec_res,$api4,$cityCode,$itemCode,$itemVal,$starVal,$finalperNightValh,$finalNightValh,$currencyVal,$roomDesc11,$mealsval,$dateFromValc,$dateToValc,$dateFromTimeValc,$dateToTimeVal,$serviceval,$finalcurval,$cancelCodeVal,$purTokenVal,'0','0',$roomdescCode,$ConfirmationVal,$cin,$cout,'0',$image,$desc);
	
	}
		
				  
	}
	function search_result_new()
	{
		
			
		//echo "ishan";
	//	echo "<pre>";
		//print_r($this->session->userdata); exit;
		$flight_id_new = $this->session->userdata('flight_id_new'); 
		$air_from_new = $this->session->userdata('air_from_new');
		$air_to_new = $this->session->userdata('air_to_new'); 
	 	$pid = $this->session->userdata('pid');
		
		$data['flight_new'] = $this->Home_Model->flight_det_new($pid);
		 
		$seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		
		$data['cost']=$this->session->userdata('cost');
		$data['costtype']=$this->session->userdata('costtype');
		$cin=$this->session->userdata('cin');
		$cout=$this->session->userdata('cout');
		$data['disp_city']=$this->session->userdata('disp_city');
		$data['star']='all';
		
		$city = $this->session->userdata('city');
		if($city !='City ,Area, Airport')
		{
			$city=$this->session->userdata('city');
		}
		else
		{
			$city ='';
		}
		$data['cin']=$cin;
		$data['cout']=$cout;
		
		$data['nor']=$this->session->userdata('nor');
		$data['rtype']=$this->session->userdata('rtype');
		$data['city']=$this->session->userdata('city');
		$noofroom=$this->session->userdata('nor');
		$roomusedtype=$this->session->userdata('rtype');
		$days=$this->session->userdata('dt');
		
		
		$data['dt']=$days;
		$data['room']=$this->session->userdata('room');
		$data['adult']=$this->session->userdata('adult');
		$data['child']=$this->session->userdata('child');
		
		
		$data['a_id']=$this->session->userdata('agent_id');	
		
		$agnt=$this->session->userdata('agentid');			
		//$data['last_log']=$this->Agent_Model->agent_last_login($agnt);		
		//$data['acc_info']=$this->Agent_Model->accnt_information($agnt);			
		
		$sec_res=$this->session->userdata('sec_res');	
		$hname=$this->session->userdata('hot_name'); 
		$hotel_name_month=$this->session->userdata('pop_hotel_name'); 
		
		//echo $hotel_name_month; exit;
		//echo "<pre>";
		//print_r($this->session->userdata);exit;
		 if($hname!='')
		{
			
			$hname1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hname);
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hname1%' GROUP BY `hotel_name`");
			$result=$query->result();
			
		}
	    else if($hotel_name_month!='')
		{
			
			$hotel_name_month1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hotel_name_month);
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hotel_name_month%' GROUP BY `hotel_name`");
			$result=$query->result();
			
		}
		
		else
		{
			
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`");
			//echo "SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`"; exit;
			$result=$query->result();
			

			//$result=$query->result();
			//exit;
		}
		
			
				
			$perpage=10;
			
			
			 if($hname=='' && $hotel_name_month=='')
			{
				//exit;
				$sresult=$this->Home_Model->get_search_result_info($sec_res,$perpage,$this->uri->segment(3));
				//echo "<pre>"; print_r($sresult);
			}
			
			elseif($hname!='')
			{
				
				$hotel=$hname;
				$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
			}
			else
			{
				
				
				$hotel=$hotel_name_month;
				$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
			}
		
			
			$count= count($result); 
			$data['total_rows']=$count;
			$config['base_url'] = base_url().'/home/search_result/';
			$config['total_rows'] =$count;
			$config['per_page'] = '10';
			
			
			$this->pagination->initialize($config);
			
			
			
			
			  $start_key=$this->uri->segment(3);
				
					if($start_key=='')
					{
						$start_key=0;
					}			
						
					
					
					
			if($sresult!=''){
			//echo count($sresult);exit;
			foreach($sresult as $row){
				
			
				$cityNamesvalue[]=$row->city_name;
				$hotelCodevalue[]=$row->hotel_id;
				$cityCodevalue[]=$row->city_name;
				$hotelNamesvalue[]=$row->hotel_name;
				$categoryCodevalue[]=$row->star_rate;
				$pricePerNightvalue[]=$row->nightperroom;
				$RoomCostvalue1[]=$row->cost_value;
				$RoomCost[]=$row->cost_type;
				$apiNameValue[]=$row->api_name;
				$roomtypeValue[]=$row->room_type;
				$inclusionValue[]=$row->inclusion;
				$image[]=$row->image;
			
			}
			
		//	print_r($cityNamesvalue);exit;
			
				if(count($hotelCodevalue)>0)
					{
						$h=0;						
						$end_key = $start_key+10;
						if(count($hotelCodevalue) < $end_key)
						{
							$end_key = count($hotelCodevalue);
						}
						$cityNamesvalue1=array();
						$hotelCodevalue1= array();
						$cityCodevalue1= array();
						$hotelNamesvalue1= array();
						$categoryCodevalue1= array();
						$pricePerNightvalue1= array();
						$RoomCostvalue11=array();	
						$RoomCost1=array();	
						$apiNameValue1=array();	
						$roomtypeValue1=array();	
						$inclusionValue1=array();
						$image1=array();
					
						for($t=$start_key;$t< $end_key;$t++)
						{
							$cityNamesvalue1[$h] = $cityNamesvalue[$t];
							$hotelCodevalue1[$h]= $hotelCodevalue[$t];
							$cityCodevalue1[$h] = $cityCodevalue[$t];
							$hotelNamesvalue1[$h]= $hotelNamesvalue[$t];
							$categoryCodevalue1[$h] = $categoryCodevalue[$t];
							$pricePerNightvalue1[$h] = $pricePerNightvalue[$t];
							$RoomCostvalue11[$h] = $RoomCostvalue1[$t];
							$RoomCost1[$h] = $RoomCost[$t];
							$apiNameValue1[$h] = $apiNameValue[$t];
							$roomtypeValue1[$h]= $roomtypeValue[$t];
							$inclusionValue1[$h]= $inclusionValue[$t];
							$image1[$h]= $image[$t];
							$h++;					
						}					
					}
								
			
				$data['criteria_id']=$sec_res;
				$data['cityNamesvalue']=$cityNamesvalue1;
				$data['hotelCodevalue']=$hotelCodevalue1;
				$data['cityCodevalue']=$cityCodevalue1;
				$data['hotelNamesvalue']=$hotelNamesvalue1;
				$data['categoryCodevalue']=$categoryCodevalue1;		
				$data['pricePerNightvalue']=$pricePerNightvalue1;	
				$data['RoomCostvalue1']=$RoomCostvalue11;
				$data['RoomCost']=$RoomCost1;		
				$data['apiNameValue']=$apiNameValue1;	
				$data['roomtypeValue']=$roomtypeValue1;		
				$data['inclusionValue']=$inclusionValue1;
				$data['image']=$image1;	
				$data['result'] = $sresult;
				//print_r($sresult); exit;
			$this->load->view('flight_hotel/search_result_hotel',$data);
		}
		else
		{
			$this->load->view('flight_hotel/search_result_hotel',$data);
		}
	   
	}
	function search_result_new1($pid)
	{
		
			
		//echo "ishan";
	//	echo "<pre>";
		//print_r($this->session->userdata); exit;
		$flight_id_new = $this->session->userdata('flight_id_new'); 
		$air_from_new = $this->session->userdata('air_from_new');
		$air_to_new = $this->session->userdata('air_to_new'); 
	 	$pid = $pid; 
		
		$data['flight_new'] = $this->Home_Model->flight_det_new($pid);
		 
		$seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		
		$data['cost']=$this->session->userdata('cost');
		$data['costtype']=$this->session->userdata('costtype');
		$cin=$this->session->userdata('cin');
		$cout=$this->session->userdata('cout');
		$data['disp_city']=$this->session->userdata('disp_city');
		$data['star']='all';
		
		$city = $this->session->userdata('city');
		if($city !='City ,Area, Airport')
		{
			$city=$this->session->userdata('city');
		}
		else
		{
			$city ='';
		}
		$data['cin']=$cin;
		$data['cout']=$cout;
		
		$data['nor']=$this->session->userdata('nor');
		$data['rtype']=$this->session->userdata('rtype');
		$data['city']=$this->session->userdata('city');
		$noofroom=$this->session->userdata('nor');
		$roomusedtype=$this->session->userdata('rtype');
		$days=$this->session->userdata('dt');
		
		
		$data['dt']=$days;
		$data['room']=$this->session->userdata('room');
		$data['adult']=$this->session->userdata('adult');
		$data['child']=$this->session->userdata('child');
		
		
		$data['a_id']=$this->session->userdata('agent_id');	
		
		$agnt=$this->session->userdata('agentid');			
		//$data['last_log']=$this->Agent_Model->agent_last_login($agnt);		
		//$data['acc_info']=$this->Agent_Model->accnt_information($agnt);			
		
		$sec_res=$this->session->userdata('sec_res');	
		$hname=$this->session->userdata('hot_name'); 
		$hotel_name_month=$this->session->userdata('pop_hotel_name'); 
		
		//echo $hotel_name_month; exit;
		//echo "<pre>";
		//print_r($this->session->userdata);exit;
		 if($hname!='')
		{
			
			$hname1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hname);
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hname1%' GROUP BY `hotel_name`");
			$result=$query->result();
			
		}
	    else if($hotel_name_month!='')
		{
			
			$hotel_name_month1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hotel_name_month);
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hotel_name_month%' GROUP BY `hotel_name`");
			$result=$query->result();
			
		}
		
		else
		{
			
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`");
			//echo "SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`"; exit;
			$result=$query->result();
			

			//$result=$query->result();
			//exit;
		}
		
			
				
			$perpage=10;
			
			
			 if($hname=='' && $hotel_name_month=='')
			{
				//exit;
				$sresult=$this->Home_Model->get_search_result_info($sec_res,$perpage,$this->uri->segment(3));
				//echo "<pre>"; print_r($sresult);
			}
			
			elseif($hname!='')
			{
				
				$hotel=$hname;
				$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
			}
			else
			{
				
				
				$hotel=$hotel_name_month;
				$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
			}
		
			
			$count= count($result); 
			$data['total_rows']=$count;
			$config['base_url'] = base_url().'/home/search_result/';
			$config['total_rows'] =$count;
			$config['per_page'] = '10';
			
			
			$this->pagination->initialize($config);
			
			
			
			
			  $start_key=$this->uri->segment(3);
				
					if($start_key=='')
					{
						$start_key=0;
					}			
						
					
					
					
			if($sresult!=''){
			//echo count($sresult);exit;
			foreach($sresult as $row){
				
			
				$cityNamesvalue[]=$row->city_name;
				$hotelCodevalue[]=$row->hotel_id;
				$cityCodevalue[]=$row->city_name;
				$hotelNamesvalue[]=$row->hotel_name;
				$categoryCodevalue[]=$row->star_rate;
				$pricePerNightvalue[]=$row->nightperroom;
				$RoomCostvalue1[]=$row->cost_value;
				$RoomCost[]=$row->cost_type;
				$apiNameValue[]=$row->api_name;
				$roomtypeValue[]=$row->room_type;
				$inclusionValue[]=$row->inclusion;
				$image[]=$row->image;
			
			}
			
		//	print_r($cityNamesvalue);exit;
			
				if(count($hotelCodevalue)>0)
					{
						$h=0;						
						$end_key = $start_key+10;
						if(count($hotelCodevalue) < $end_key)
						{
							$end_key = count($hotelCodevalue);
						}
						$cityNamesvalue1=array();
						$hotelCodevalue1= array();
						$cityCodevalue1= array();
						$hotelNamesvalue1= array();
						$categoryCodevalue1= array();
						$pricePerNightvalue1= array();
						$RoomCostvalue11=array();	
						$RoomCost1=array();	
						$apiNameValue1=array();	
						$roomtypeValue1=array();	
						$inclusionValue1=array();
						$image1=array();
					
						for($t=$start_key;$t< $end_key;$t++)
						{
							$cityNamesvalue1[$h] = $cityNamesvalue[$t];
							$hotelCodevalue1[$h]= $hotelCodevalue[$t];
							$cityCodevalue1[$h] = $cityCodevalue[$t];
							$hotelNamesvalue1[$h]= $hotelNamesvalue[$t];
							$categoryCodevalue1[$h] = $categoryCodevalue[$t];
							$pricePerNightvalue1[$h] = $pricePerNightvalue[$t];
							$RoomCostvalue11[$h] = $RoomCostvalue1[$t];
							$RoomCost1[$h] = $RoomCost[$t];
							$apiNameValue1[$h] = $apiNameValue[$t];
							$roomtypeValue1[$h]= $roomtypeValue[$t];
							$inclusionValue1[$h]= $inclusionValue[$t];
							$image1[$h]= $image[$t];
							$h++;					
						}					
					}
								
			
				$data['criteria_id']=$sec_res;
				$data['cityNamesvalue']=$cityNamesvalue1;
				$data['hotelCodevalue']=$hotelCodevalue1;
				$data['cityCodevalue']=$cityCodevalue1;
				$data['hotelNamesvalue']=$hotelNamesvalue1;
				$data['categoryCodevalue']=$categoryCodevalue1;		
				$data['pricePerNightvalue']=$pricePerNightvalue1;	
				$data['RoomCostvalue1']=$RoomCostvalue11;
				$data['RoomCost']=$RoomCost1;		
				$data['apiNameValue']=$apiNameValue1;	
				$data['roomtypeValue']=$roomtypeValue1;		
				$data['inclusionValue']=$inclusionValue1;
				$data['image']=$image1;	
				$data['result'] = $sresult;
				//print_r($sresult); exit;
			$this->load->view('flight_hotel/search_result_hotel',$data);
		}
		else
		{
			$this->load->view('flight_hotel/search_result_hotel',$data);
		}
	   
	}
	function hotel_det_new($hotelcode,$price,$costtype,$result_id)
   {
	$data['hotelcode'] = $hotelcode;
	$data['price'] = $price;
	$data['costtype'] = $costtype;
	$data['result_id']= $result_id;
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);
	$hotelid = $det->hotel_id;
	$data['meals'] = $this->Home_Model->hotel_meals($hotelid);
	$data['pictures'] = $this->Home_Model->hotel_pictures($hotelid);
	$data['loc'] = $loc = $this->Home_Model->hotel_more_det($hotelcode);
	//$data['rooms'] =$this->Home_Model->
	$this->load->view('flight_hotel/hotel_inner_new',$data);
   }
   function flight_hotel_extras($result_id,$hotel_id,$price,$api,$pid)
   {
	   //echo $hotel_id; exit;
	   $data['pid'] = $pid;
	  $data['flight_new'] = $flight_new = $this->Home_Model->flight_det_new($pid);
	  //echo "<pre>"; print_r($flight_new); exit;
	   $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		$data['det1'] = $this->Home_Model->hotel_more_det($hotel_id);
		//$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$data['room_det1'] = $this->Home_Model->get_hotel_searchinfo($hotel_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = '';
		
	   $this->load->view('flight_hotel/flight_hotel_extrass_crs',$data);
   }
   function flight_hotel_extras1($hotel_id,$room_id,$pid)
   {
	  $data['pid'] = $pid; 
	   $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	   $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		
	   $this->load->view('flight_hotel/flight_hotel_extrass',$data);
   }
   function transfer_add_hotel($hotel_id,$room_id,$pid)
   {
	   $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		$data['pid'] = $pid;
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
	    $this->load->view('flight_hotel/flight_hotel_transfer',$data);
   }
   function baggage_add_transfer($hotel_id,$room_id,$pid)
    {
	   $data['pid'] = $pid;
	   $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
	    $this->load->view('flight_hotel/baggage_add_transfer',$data);
   }
   function baggage_add_hotel($hotel_id,$room_id,$pid)
   {
	   $data['pid'] = $pid;
	   $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
	    $this->load->view('flight_hotel/flight_hotel_baggage',$data);
   }
   
   function baggage_add_hotel_crs($hotel_id,$pid)
   {
	   $data['pid'] = $pid;
	   $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['det1'] = $this->Home_Model->hotel_more_det($hotel_id);
		
		$data['room_det1'] = $this->Home_Model->get_hotel_searchinfo($hotel_id);
		
		$destination = $this->session->userdata('airport_to');
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = '';
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
	    $this->load->view('flight_hotel/flight_hotel_baggage_crs',$data);
   }
   
   function transfer_add_baggage($hotel_id,$room_id,$pid)
   {
	   $data['pid'] = $pid;
	   $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
	    $this->load->view('flight_hotel/transfer_add_baggage',$data);
   }
   function transfer_add($hotel_id,$room_id)
   {
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
	    $this->load->view('flight_hotel/flight_hotel_transfer',$data);
   }
   function excursion_add_hotel($hotel_id,$room_id,$ex_id,$pid)
   {
	    $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		
		$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
	    $this->load->view('flight_hotel/flight_hotel_activity',$data);
   }
   function excursion_withtrans_baggage($hotel_id,$room_id,$ex_id,$pid)
   {
	    $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		
		$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		$data['pid'] = $pid;
		$data['ex_id'] = $ex_id;
	    $this->load->view('flight_hotel/flight_all_extrass2',$data);
   }
   function excursion_withtrans_hotel($hotel_id,$room_id,$ex_id,$pid)
   {
	    $data['flight_new'] = $this->Home_Model->flight_det_new($pid);
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		
		$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		$data['ex_id']= $ex_id;
	    $this->load->view('flight_hotel/flight_all_extrass',$data);
   }
   function excursion_add($hotel_id,$room_id,$ex_id)
   {
	    $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		
		$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
	    $this->load->view('flight_hotel/flight_hotel_activity',$data);
   }
   function hotel_det_trav_new($hotel_id,$room_id)
		{
			$this->Home_Model->delete_hotel_det($hotel_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$url = 'http://xml.youtravel.com/webservices/get_hoteldetails.asp?LangID=EN&HID='.$hotel_id.'&Username=egyptspirit&Password=sprite2013';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			//echo "<pre>"; print_r($array); 
			if(isset($array['HtSearchRq']['Hotel']))
			{
				$Success = $array['HtSearchRq']['Success']['value']; 
				$LangID = $array['HtSearchRq']['LangID']['value']; 
				$Destination = $array['HtSearchRq']['Destination']['value']; 
				$HID = $array['HtSearchRq']['HID']['value']; 
				$Hotel = $array['HtSearchRq']['Hotel'];
				$name = $Hotel['attr']['Name'];
				$Youtravel_Rating = $Hotel['Youtravel_Rating']['value'];
				$Official_Rating = $Hotel['Official_Rating']['value'];
				$Board_Type = $Hotel['Board_Type']['value'];
				$Hotel_Desc = $Hotel['Hotel_Desc']['value'];
				
				$Hotel_Photos = $Hotel['Hotel_Photos'];
				//echo "<pre>"; print_r($Hotel_Photos);
				foreach($Hotel_Photos as $photo)
				{
					foreach($photo as $ph)
					{
						//echo "<pre>"; print_r($ph);
						$photos = $ph['value'];
						$this->Home_Model->insert_hotelphotos($hotel_id,$photos);
					}
				}
				$Hotel_Facilities = $Hotel['Hotel_Facilities'];
				foreach($Hotel_Facilities as $fac)
				{
					foreach($fac as $faci)
					{
						//echo "<pre>"; print_r($ph);
						 $facility = $faci['value'];
						$this->Home_Model->insert_hotelfac($hotel_id,$facility);
					}
				}
				$Room_Types = $Hotel['Room_Types'];
				//echo "<pre>"; print_r($Room_Types);
				$Room = $Room_Types['Room']; 
				//echo "<pre>"; print_r($Room);
				if(isset($Room['attr']))
				{
					$room_name = $Room['attr']['name'];
					$rom_fac = $Room['Facility'];
					foreach($rom_fac as $rom_fac)
					{
						$room_facility = $rom_fac['value'];
						$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
					}
					
				}
				else
				{
					foreach($Room as $rom)	
					{
						$room_name = $rom['attr']['name'];
						$rom_fac = $rom['Facility'];
						foreach($rom_fac as $rom_fac)
						{
							$room_facility = $rom_fac['value'];
							$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
						}
					}
				}
				if(isset($Hotel['AI_Type']['value']))
				{
					$AI_Type = $Hotel['AI_Type']['value'];
				}
				else
				{
					$AI_Type = '';
				}
				if(isset($Hotel['AI_Desc']['value']))
				{
					$AI_Desc = $Hotel['AI_Desc']['value'];
				}
				else
				{
					$AI_Desc = '';
				}
				if(isset($Hotel['AI_Facilities']))
				{
					$AI_Facilities = $Hotel['AI_Facilities'];
					if(isset($AI_Facilities['AI_Facility']))
					{
						$AI_Facility = $AI_Facilities['AI_Facility'];
						foreach($AI_Facility as $ai_fac)
						{
							$AI_Facility = $ai_fac['value'];
						}
					}
				}
				else
				{
					$AI_Facility = '';
				}
				//$extras = $Hotel['Erratas']['value'];
				$this->Home_Model->youtravel_hotel_det($hotel_id,$Success,$LangID,$Destination,$name,$Official_Rating,$Board_Type,$Hotel_Desc);
			}
			$data['hotel_det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			$data['hotel_det2'] = $this->Home_Model->youtravel_hotel_det2($hotel_id);
			$data['hotel_fac'] = $this->Home_Model->youtravel_hotel_fac($hotel_id);
			$data['room_fac'] = $this->Home_Model->youtravel_room_fac($hotel_id);
			$data['pictures'] = $this->Home_Model->youtravel_pictures($hotel_id);
			$this->load->view('flight_hotel/youtravel_hotel_det',$data);
		}
	function hotel_det_trav_new4($hotelcode,$price,$costtype,$result_id)
	   {
		  // echo $hotelcode; exit;
		$data['hotelcode'] = $hotelcode;
		$data['price'] = $price;
		$data['costtype'] = $costtype;
		$data['result_id']= $result_id;
		$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);
		$hotelid = $det->hotel_id;
		$data['meals'] = $this->Home_Model->hotel_meals($hotelid);
		$data['pictures'] = $this->Home_Model->hotel_pictures($hotelid);
		$data['loc'] = $loc = $this->Home_Model->hotel_more_det($hotelcode);
		//$data['rooms'] =$this->Home_Model->
		$pid = $this->input->post('pid2');
		$data['pid'] = $pid;
		$data['flight_new'] = $this->Home_Model->flight_det_new($pid);
		$this->load->view('flight_hotel/hotel_inner_new',$data);
	   }
		function hotel_det_trav_new1($hotel_id,$room_id)
		{
			
			$pid = $this->input->post('pid');
			$this->Home_Model->delete_hotel_det($hotel_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$data['pid'] = $pid;
			$url = 'http://xml.youtravel.com/webservices/get_hoteldetails.asp?LangID=EN&HID='.$hotel_id.'&Username=egyptspirit&Password=sprite2013';
			//echo $url; exit;
			$data['flight_new'] = $this->Home_Model->flight_det_new($pid);
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			//echo "<pre>"; print_r($array);  exit;
			if(isset($array['HtSearchRq']['Hotel']))
			{
				$Success = $array['HtSearchRq']['Success']['value']; 
				$LangID = $array['HtSearchRq']['LangID']['value']; 
				$Destination = $array['HtSearchRq']['Destination']['value']; 
				$HID = $array['HtSearchRq']['HID']['value']; 
				$Hotel = $array['HtSearchRq']['Hotel'];
				$name = $Hotel['attr']['Name'];
				$Youtravel_Rating = $Hotel['Youtravel_Rating']['value'];
				$Official_Rating = $Hotel['Official_Rating']['value'];
				$Board_Type = $Hotel['Board_Type']['value'];
				$Hotel_Desc = $Hotel['Hotel_Desc']['value'];
				
				$Hotel_Photos = $Hotel['Hotel_Photos'];
				//echo "<pre>"; print_r($Hotel_Photos);
				foreach($Hotel_Photos as $photo)
				{
					foreach($photo as $ph)
					{
						//echo "<pre>"; print_r($ph);
						$photos = $ph['value'];
						$this->Home_Model->insert_hotelphotos($hotel_id,$photos);
					}
				}
				$Hotel_Facilities = $Hotel['Hotel_Facilities'];
				foreach($Hotel_Facilities as $fac)
				{
					foreach($fac as $faci)
					{
						//echo "<pre>"; print_r($ph);
						 $facility = $faci['value'];
						$this->Home_Model->insert_hotelfac($hotel_id,$facility);
					}
				}
				$Room_Types = $Hotel['Room_Types'];
				//echo "<pre>"; print_r($Room_Types);
				$Room = $Room_Types['Room']; 
				//echo "<pre>"; print_r($Room);
				if(isset($Room['attr']))
				{
					$room_name = $Room['attr']['name'];
					$rom_fac = $Room['Facility'];
					foreach($rom_fac as $rom_fac)
					{
						$room_facility = $rom_fac['value'];
						$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
					}
					
				}
				else
				{
					foreach($Room as $rom)	
					{
						$room_name = $rom['attr']['name'];
						$rom_fac = $rom['Facility'];
						foreach($rom_fac as $rom_fac)
						{
							$room_facility = $rom_fac['value'];
							$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
						}
					}
				}
				if(isset($Hotel['AI_Type']['value']))
				{
					$AI_Type = $Hotel['AI_Type']['value'];
				}
				else
				{
					$AI_Type = '';
				}
				if(isset($Hotel['AI_Desc']['value']))
				{
					$AI_Desc = $Hotel['AI_Desc']['value'];
				}
				else
				{
					$AI_Desc = '';
				}
				if(isset($Hotel['AI_Facilities']))
				{
					$AI_Facilities = $Hotel['AI_Facilities'];
					if(isset($AI_Facilities['AI_Facility']))
					{
						$AI_Facility = $AI_Facilities['AI_Facility'];
						foreach($AI_Facility as $ai_fac)
						{
							$AI_Facility = $ai_fac['value'];
						}
					}
				}
				else
				{
					$AI_Facility = '';
				}
				//$extras = $Hotel['Erratas']['value'];
				$this->Home_Model->youtravel_hotel_det($hotel_id,$Success,$LangID,$Destination,$name,$Official_Rating,$Board_Type,$Hotel_Desc);
			}
			$data['hotel_det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			$data['hotel_det2'] = $this->Home_Model->youtravel_hotel_det2($hotel_id);
			$data['hotel_fac'] = $this->Home_Model->youtravel_hotel_fac($hotel_id);
			$data['room_fac'] = $this->Home_Model->youtravel_room_fac($hotel_id);
			$data['pictures'] = $this->Home_Model->youtravel_pictures($hotel_id);
			$data['pid'] = $pid;
			$this->load->view('flight_hotel/youtravel_hotel_det',$data);
		}
		function book_elsy_flight_hotel($hotel_id,$room_id)
		{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$session_id = $this->session->userdata('sessionid');
		$this->Home_Model->delete_getdet_flight($session_id);
		$flight_id = $this->input->post('flight_id');
		//$flight_id = "130418094609-41-2640-976|130418094609-34-2384-879";
		$air_from = $this->input->post('air_from');
		$air_to = $this->input->post('air_to');
		$data['flight_id'] = $flight_id;
		$data['country'] = $this->Home_Model->get_country();
		$xml ='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				  <soap:Body>
					<GetFlightDetails xmlns="ElsyArres.API">
					  <SoapMessage>
						<Password>1009E55E71</Password>
						<Username>EgyptspiritAPI</Username>
						<LanguageCode>EN</LanguageCode>
						<CurrencyCode>GBP</CurrencyCode>
						<Request>
						  <FlightId>'.$flight_id.'</FlightId>
						</Request>
					  </SoapMessage>
					</GetFlightDetails>
				  </soap:Body>
				</soap:Envelope>';
				//echo $xml; exit;
				//$url =  "https://testv80.elsyarres.net/service.asmx";  //test
				$url = "http://www1v80.elsyarres.net/service.asmx";  //live
			$soap = "ElsyArres.API/GetFlightDetails";
			$ch2=curl_init();
			curl_setopt($ch2, CURLOPT_URL, $url);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
	
			$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
	
			// Execute request, store response and HTTP response code
			$data2=curl_exec($ch2);
			$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
			curl_close($ch2);
			
			$array = $this->xml2array($data2); 
			//echo "<pre>"; print_r($data2); exit;
			if(isset($array['soap:Envelope']['attr']))
	        {
				 if($array['soap:Envelope']['soap:Body'])
			 	 {
					$xmlns = $array['soap:Envelope']['soap:Body'];
					if(isset($xmlns['GetFlightDetailsResponse']))
					{
						$SoapMessage = $xmlns['GetFlightDetailsResponse']['SoapMessage'];
						$Response = $SoapMessage['Response'];
						if(isset($Response['CurrencyCode']))
						{
							$currency = $Response['CurrencyCode'];
						}
						else
						{
							$currency = '';
						}
						$FlightDetails = $Response['FlightDetails'];
						if(isset($FlightDetails['MinSinglePaxAge']['value']))
						{
							$MinSinglePaxAge = $FlightDetails['MinSinglePaxAge']['value'];
						}
						else
						{
							$MinSinglePaxAge = '';
						}
						if(isset($FlightDetails['Provider']['value']))
						{
							$Provider = $FlightDetails['Provider']['value'];
						}
						else
						{
							$Provider = '';
						}
						if(isset($FlightDetails['CC3DSecure']['value']))
						{
							$CC3DSecure = $FlightDetails['CC3DSecure']['value'];
						}
						else
						{
							$CC3DSecure = '';
						}
						if(isset($FlightDetails['CCRequiredForCheckIn']['value']))
						{
							$CCRequiredForCheckIn = $FlightDetails['CCRequiredForCheckIn']['value'];
						}
						else
						{
							$CCRequiredForCheckIn = '';
						}
						if(isset($FlightDetails['PassportNoRequired']['value']))
						{
							$PassportNoRequired = $FlightDetails['PassportNoRequired']['value'];
						}
						else
						{
							$PassportNoRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$PassportDetailsRequired = $FlightDetails['PassportDetailsRequired']['value'];
						}
						else
						{
							$PassportDetailsRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$CCExpiryDate = $FlightDetails['CCExpiryDate']['value'];
						}
						else
						{
							$CCExpiryDate = '';
						}
						
						if(isset($FlightDetails['RealRoundtrip']['value']))
						{
							$RealRoundtrip = $FlightDetails['RealRoundtrip']['value'];
						}
						else
						{
							$RealRoundtrip = '';
						}
						if(isset($FlightDetails['TotalFare']['value']))
						{
							$TotalFare = $FlightDetails['TotalFare']['value'];
						}
						else
						{
							$TotalFare = '';
						}
						if(isset($FlightDetails['Outbound']))
						{
							$Outbound = $FlightDetails['Outbound'];
							if(isset($Outbound['CarName']['value']))
							{
								$CarName = $Outbound['CarName']['value'];
							}
							else
							{
								$CarName = 	'';
							}
							if(isset($Outbound['CarCode']['value']))
							{
								$CarCode = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode = 	'';
							}
							if(isset($Outbound['DepName']['value']))
							{
								$DepName = $Outbound['DepName']['value'];
							}
							else
							{
								$DepName = 	'';
							}
							if(isset($Outbound['DepCode']['value']))
							{
								$DepCode = $Outbound['DepCode']['value'];
							}
							else
							{
								$DepCode = 	'';
							}
							if(isset($Outbound['DestName']['value']))
							{
								$DestName = $Outbound['DestName']['value'];
							}
							else
							{
								$DestName = 	'';
							}
							if(isset($Outbound['DestCode']['value']))
							{
								$DestCode = $Outbound['DestCode']['value'];
							}
							else
							{
								$DestCode = 	'';
							}
							if(isset($Outbound['Duration']['value']))
							{
								$Duration = $Outbound['Duration']['value'];
							}
							else
							{
								$Duration = 	'';
							}
							if(isset($Outbound['FlightNo']['value']))
							{
								$FlightNo = $Outbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo = 	'';
							}
							if(isset($Outbound['DepDateTime']['value']))
							{
								$DepDateTime = $Outbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime = 	'';
							}
							if(isset($Outbound['ArrDateTime']['value']))
							{
								$ArrDateTime = $Outbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime = 	'';
							}
							if(isset($Outbound['Legs']))
							{
								$Legs = $Outbound['Legs'];
								if(isset($Legs['Leg']))
								{
									$Leg =  $Legs['Leg'];
									if(isset($Leg['FlightNo']['value']))
									{
										$FlightNo_leg = $Leg['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg = '';
									}
									if(isset($Leg['DepTime']['value']))
									{
										$leg_DepTime = $Leg['DepTime']['value'];
									}
									else
									{
										$leg_DepTime = '';
									}
									if(isset($Leg['ArrTime']['value']))
									{
										$leg_ArrTime = $Leg['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime = '';
									}
								}
							}
							if(isset($Outbound['BillingAmount']['value']))
							{
								$BillingAmount = $Outbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount = 	'';
							}
							
							  $url = "http://www.google.com/ig/calculator?hl=en&q=1".$currency."=?GBP";
							  $options = array(
								CURLOPT_RETURNTRANSFER => true, // return web page
							  CURLOPT_HEADER         => false,// don't return headers
							  CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
							 );
							
							 $ch = curl_init($url);
							   curl_setopt_array( $ch, $options );
							   $amtcon = curl_exec( $ch ); //let's fetch the result using cURL
							 curl_close( $ch );
							 
							 if( $amtcon === FALSE )
							   return $amtcon;
							
							  $amtcon = explode('"',$amtcon);
							  $amtcon = str_replace(chr(160), '', substr( $amtcon[3], 0, strpos($amtcon[3], ' ') ) );
							  ( $amtcon == 0 ) ? FALSE : $amtcon;
							  
							  $TotalFare = $amtcon;
							  
							$this->Home_Model->insert_getflight_det_outbound($session_id,$flight_id,$MinSinglePaxAge,$Provider,$CC3DSecure,$CCRequiredForCheckIn,$PassportNoRequired,$PassportDetailsRequired,$CCExpiryDate,$RealRoundtrip,$TotalFare,$CarName,$CarCode,$DepName,$DepCode,$DestName,$DestCode,$Duration,$FlightNo,$DepDateTime,$ArrDateTime,$FlightNo_leg,$leg_ArrTime,$leg_DepTime,$BillingAmount);
						}
						$type = $this->session->userdata('type');
						if($type == 'ROUNDTRIP')
						{
							if(isset($FlightDetails['Inbound']))
							{
							$Inbound = $FlightDetails['Inbound'];
							if(isset($Inbound['CarName']['value']))
							{
								$CarName_inbound = $Inbound['CarName']['value'];
							}
							else
							{
								$CarName_inbound = 	'';
							}
							if(isset($Inbound['CarCode']['value']))
							{
								$CarCode_inbound = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode_inbound = 	'';
							}
							if(isset($Inbound['DepName']['value']))
							{
								$DepName_inbound = $Inbound['DepName']['value'];
							}
							else
							{
								$DepName_inbound = 	'';
							}
							if(isset($Inbound['DepCode']['value']))
							{
								$DepCode_inbound = $Inbound['DepCode']['value'];
							}
							else
							{
								$DepCode_inbound = 	'';
							}
							if(isset($Inbound['DestName']['value']))
							{
								$DestName_inbound = $Inbound['DestName']['value'];
							}
							else
							{
								$DestName_inbound = 	'';
							}
							if(isset($Inbound['DestCode']['value']))
							{
								$DestCode_inbound = $Inbound['DestCode']['value'];
							}
							else
							{
								$DestCode_inbound = 	'';
							}
							if(isset($Inbound['Duration']['value']))
							{
								$Duration_inbound = $Inbound['Duration']['value'];
							}
							else
							{
								$Duration_inbound = 	'';
							}
							if(isset($Inbound['FlightNo']['value']))
							{
								$FlightNo_inbound = $Inbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo_inbound = 	'';
							}
							if(isset($Inbound['DepDateTime']['value']))
							{
								$DepDateTime_inbound = $Inbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime_inbound = 	'';
							}
							if(isset($Inbound['ArrDateTime']['value']))
							{
								$ArrDateTime_inbound = $Inbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime_inbound = 	'';
							}
							if(isset($Inbound['Legs']))
							{
								$Legs_in = $Inbound['Legs'];
								if(isset($Legs_in['Leg']))
								{
									$Leg_in =  $Legs_in['Leg'];
									if(isset($Leg_in['FlightNo']['value']))
									{
										$FlightNo_leg_in = $Leg_in['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg_in = '';
									}
									if(isset($Leg_in['DepTime']['value']))
									{
										$leg_DepTime_in = $Leg_in['DepTime']['value'];
									}
									else
									{
										$leg_DepTime_in = '';
									}
									if(isset($Leg_in['ArrTime']['value']))
									{
										$leg_ArrTime_in = $Leg_in['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime_in = '';
									}
								}
							}
							if(isset($Inbound['BillingAmount']['value']))
							{
								$BillingAmount_in = $Inbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount_in = 	'';
							}
						$this->Home_Model->insert_getflight_det_inbound($session_id,$flight_id,$MinSinglePaxAge,$RealRoundtrip,$TotalFare,$CarName_inbound,$CarCode_inbound,$DepName_inbound,$DepCode_inbound,$DestName_inbound,$DestCode_inbound,$Duration_inbound,$FlightNo_inbound,$DepDateTime_inbound,$ArrDateTime_inbound,$FlightNo_leg_in,$leg_ArrTime_in,$leg_DepTime_in,$BillingAmount_in);
						}
						}
						//echo "<pre>"; print_r($Leg);
						
						
					}
				 }
			}
			//exit;
		$data['MinSinglePaxAge'] =  $MinSinglePaxAge;
		//echo $air_from; exit;
		$flight = $this->Home_Model->getflight_det_new($flight_id,$air_from,$air_to);
		//echo "<pre>"; print_r($flight); exit;
		if($TotalFare != '')
		{
			$data['total_fare'] = $TotalFare;
		}
		else
		{
			$data['total_fare'] = $flight->TotalFare;
		}
		$data['BagFee'] = $flight->BagFee;
		$data['CcFee'] = $flight->CcFee;
		$data['air_from'] = $air_from;
		$data['air_to'] = $air_to;
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		$this->load->view('flight_hotel/book_elsy_flight_new',$data);
	}
	function book_elsy_flight_hotel2($hotel_id,$room_id)
		{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$session_id = $this->session->userdata('sessionid');
		$this->Home_Model->delete_getdet_flight($session_id);
		$flight_id = $this->input->post('flight_id');
		//$flight_id = "130418094609-41-2640-976|130418094609-34-2384-879";
		$air_from = $this->input->post('air_from');
		$air_to = $this->input->post('air_to');
		$data['flight_id'] = $flight_id;
		$data['country'] = $this->Home_Model->get_country();
		$xml ='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				  <soap:Body>
					<GetFlightDetails xmlns="ElsyArres.API">
					  <SoapMessage>
						<Password>1009E55E71</Password>
						<Username>EgyptspiritAPI</Username>
						<LanguageCode>EN</LanguageCode>
						<CurrencyCode>GBP</CurrencyCode>
						<Request>
						  <FlightId>'.$flight_id.'</FlightId>
						</Request>
					  </SoapMessage>
					</GetFlightDetails>
				  </soap:Body>
				</soap:Envelope>';
				//echo $xml; exit;
				//$url =  "https://testv80.elsyarres.net/service.asmx";  //test
				$url = "http://www1v80.elsyarres.net/service.asmx";  //live
			$soap = "ElsyArres.API/GetFlightDetails";
			$ch2=curl_init();
			curl_setopt($ch2, CURLOPT_URL, $url);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
	
			$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
	
			// Execute request, store response and HTTP response code
			$data2=curl_exec($ch2);
			$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
			curl_close($ch2);
			
			$array = $this->xml2array($data2); 
			//echo "<pre>"; print_r($data2); exit;
			if(isset($array['soap:Envelope']['attr']))
	        {
				 if($array['soap:Envelope']['soap:Body'])
			 	 {
					$xmlns = $array['soap:Envelope']['soap:Body'];
					if(isset($xmlns['GetFlightDetailsResponse']))
					{
						$SoapMessage = $xmlns['GetFlightDetailsResponse']['SoapMessage'];
						$Response = $SoapMessage['Response'];
						if(isset($Response['CurrencyCode']))
						{
							$currency = $Response['CurrencyCode'];
						}
						else
						{
							$currency = '';
						}
						$FlightDetails = $Response['FlightDetails'];
						if(isset($FlightDetails['MinSinglePaxAge']['value']))
						{
							$MinSinglePaxAge = $FlightDetails['MinSinglePaxAge']['value'];
						}
						else
						{
							$MinSinglePaxAge = '';
						}
						if(isset($FlightDetails['Provider']['value']))
						{
							$Provider = $FlightDetails['Provider']['value'];
						}
						else
						{
							$Provider = '';
						}
						if(isset($FlightDetails['CC3DSecure']['value']))
						{
							$CC3DSecure = $FlightDetails['CC3DSecure']['value'];
						}
						else
						{
							$CC3DSecure = '';
						}
						if(isset($FlightDetails['CCRequiredForCheckIn']['value']))
						{
							$CCRequiredForCheckIn = $FlightDetails['CCRequiredForCheckIn']['value'];
						}
						else
						{
							$CCRequiredForCheckIn = '';
						}
						if(isset($FlightDetails['PassportNoRequired']['value']))
						{
							$PassportNoRequired = $FlightDetails['PassportNoRequired']['value'];
						}
						else
						{
							$PassportNoRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$PassportDetailsRequired = $FlightDetails['PassportDetailsRequired']['value'];
						}
						else
						{
							$PassportDetailsRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$CCExpiryDate = $FlightDetails['CCExpiryDate']['value'];
						}
						else
						{
							$CCExpiryDate = '';
						}
						
						if(isset($FlightDetails['RealRoundtrip']['value']))
						{
							$RealRoundtrip = $FlightDetails['RealRoundtrip']['value'];
						}
						else
						{
							$RealRoundtrip = '';
						}
						if(isset($FlightDetails['TotalFare']['value']))
						{
							$TotalFare = $FlightDetails['TotalFare']['value'];
						}
						else
						{
							$TotalFare = '';
						}
						if(isset($FlightDetails['Outbound']))
						{
							$Outbound = $FlightDetails['Outbound'];
							if(isset($Outbound['CarName']['value']))
							{
								$CarName = $Outbound['CarName']['value'];
							}
							else
							{
								$CarName = 	'';
							}
							if(isset($Outbound['CarCode']['value']))
							{
								$CarCode = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode = 	'';
							}
							if(isset($Outbound['DepName']['value']))
							{
								$DepName = $Outbound['DepName']['value'];
							}
							else
							{
								$DepName = 	'';
							}
							if(isset($Outbound['DepCode']['value']))
							{
								$DepCode = $Outbound['DepCode']['value'];
							}
							else
							{
								$DepCode = 	'';
							}
							if(isset($Outbound['DestName']['value']))
							{
								$DestName = $Outbound['DestName']['value'];
							}
							else
							{
								$DestName = 	'';
							}
							if(isset($Outbound['DestCode']['value']))
							{
								$DestCode = $Outbound['DestCode']['value'];
							}
							else
							{
								$DestCode = 	'';
							}
							if(isset($Outbound['Duration']['value']))
							{
								$Duration = $Outbound['Duration']['value'];
							}
							else
							{
								$Duration = 	'';
							}
							if(isset($Outbound['FlightNo']['value']))
							{
								$FlightNo = $Outbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo = 	'';
							}
							if(isset($Outbound['DepDateTime']['value']))
							{
								$DepDateTime = $Outbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime = 	'';
							}
							if(isset($Outbound['ArrDateTime']['value']))
							{
								$ArrDateTime = $Outbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime = 	'';
							}
							if(isset($Outbound['Legs']))
							{
								$Legs = $Outbound['Legs'];
								if(isset($Legs['Leg']))
								{
									$Leg =  $Legs['Leg'];
									if(isset($Leg['FlightNo']['value']))
									{
										$FlightNo_leg = $Leg['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg = '';
									}
									if(isset($Leg['DepTime']['value']))
									{
										$leg_DepTime = $Leg['DepTime']['value'];
									}
									else
									{
										$leg_DepTime = '';
									}
									if(isset($Leg['ArrTime']['value']))
									{
										$leg_ArrTime = $Leg['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime = '';
									}
								}
							}
							if(isset($Outbound['BillingAmount']['value']))
							{
								$BillingAmount = $Outbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount = 	'';
							}
							
							  $url = "http://www.google.com/ig/calculator?hl=en&q=1".$currency."=?GBP";
							  $options = array(
								CURLOPT_RETURNTRANSFER => true, // return web page
							  CURLOPT_HEADER         => false,// don't return headers
							  CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
							 );
							
							 $ch = curl_init($url);
							   curl_setopt_array( $ch, $options );
							   $amtcon = curl_exec( $ch ); //let's fetch the result using cURL
							 curl_close( $ch );
							 
							 if( $amtcon === FALSE )
							   return $amtcon;
							
							  $amtcon = explode('"',$amtcon);
							  $amtcon = str_replace(chr(160), '', substr( $amtcon[3], 0, strpos($amtcon[3], ' ') ) );
							  ( $amtcon == 0 ) ? FALSE : $amtcon;
							  
							  $TotalFare = $amtcon;
							  
							$this->Home_Model->insert_getflight_det_outbound($session_id,$flight_id,$MinSinglePaxAge,$Provider,$CC3DSecure,$CCRequiredForCheckIn,$PassportNoRequired,$PassportDetailsRequired,$CCExpiryDate,$RealRoundtrip,$TotalFare,$CarName,$CarCode,$DepName,$DepCode,$DestName,$DestCode,$Duration,$FlightNo,$DepDateTime,$ArrDateTime,$FlightNo_leg,$leg_ArrTime,$leg_DepTime,$BillingAmount);
						}
						$type = $this->session->userdata('type');
						if($type == 'ROUNDTRIP')
						{
							if(isset($FlightDetails['Inbound']))
							{
							$Inbound = $FlightDetails['Inbound'];
							if(isset($Inbound['CarName']['value']))
							{
								$CarName_inbound = $Inbound['CarName']['value'];
							}
							else
							{
								$CarName_inbound = 	'';
							}
							if(isset($Inbound['CarCode']['value']))
							{
								$CarCode_inbound = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode_inbound = 	'';
							}
							if(isset($Inbound['DepName']['value']))
							{
								$DepName_inbound = $Inbound['DepName']['value'];
							}
							else
							{
								$DepName_inbound = 	'';
							}
							if(isset($Inbound['DepCode']['value']))
							{
								$DepCode_inbound = $Inbound['DepCode']['value'];
							}
							else
							{
								$DepCode_inbound = 	'';
							}
							if(isset($Inbound['DestName']['value']))
							{
								$DestName_inbound = $Inbound['DestName']['value'];
							}
							else
							{
								$DestName_inbound = 	'';
							}
							if(isset($Inbound['DestCode']['value']))
							{
								$DestCode_inbound = $Inbound['DestCode']['value'];
							}
							else
							{
								$DestCode_inbound = 	'';
							}
							if(isset($Inbound['Duration']['value']))
							{
								$Duration_inbound = $Inbound['Duration']['value'];
							}
							else
							{
								$Duration_inbound = 	'';
							}
							if(isset($Inbound['FlightNo']['value']))
							{
								$FlightNo_inbound = $Inbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo_inbound = 	'';
							}
							if(isset($Inbound['DepDateTime']['value']))
							{
								$DepDateTime_inbound = $Inbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime_inbound = 	'';
							}
							if(isset($Inbound['ArrDateTime']['value']))
							{
								$ArrDateTime_inbound = $Inbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime_inbound = 	'';
							}
							if(isset($Inbound['Legs']))
							{
								$Legs_in = $Inbound['Legs'];
								if(isset($Legs_in['Leg']))
								{
									$Leg_in =  $Legs_in['Leg'];
									if(isset($Leg_in['FlightNo']['value']))
									{
										$FlightNo_leg_in = $Leg_in['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg_in = '';
									}
									if(isset($Leg_in['DepTime']['value']))
									{
										$leg_DepTime_in = $Leg_in['DepTime']['value'];
									}
									else
									{
										$leg_DepTime_in = '';
									}
									if(isset($Leg_in['ArrTime']['value']))
									{
										$leg_ArrTime_in = $Leg_in['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime_in = '';
									}
								}
							}
							if(isset($Inbound['BillingAmount']['value']))
							{
								$BillingAmount_in = $Inbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount_in = 	'';
							}
						$this->Home_Model->insert_getflight_det_inbound($session_id,$flight_id,$MinSinglePaxAge,$RealRoundtrip,$TotalFare,$CarName_inbound,$CarCode_inbound,$DepName_inbound,$DepCode_inbound,$DestName_inbound,$DestCode_inbound,$Duration_inbound,$FlightNo_inbound,$DepDateTime_inbound,$ArrDateTime_inbound,$FlightNo_leg_in,$leg_ArrTime_in,$leg_DepTime_in,$BillingAmount_in);
						}
						}
						//echo "<pre>"; print_r($Leg);
						
						
					}
				 }
			}
			//exit;
		$data['MinSinglePaxAge'] =  $MinSinglePaxAge;
		//echo $air_from; exit;
		$flight = $this->Home_Model->getflight_det_new($flight_id,$air_from,$air_to);
		//echo "<pre>"; print_r($flight); exit;
		if($TotalFare != '')
		{
			$data['total_fare'] = $TotalFare;
		}
		else
		{
			$data['total_fare'] = $flight->TotalFare;
		}
		$data['BagFee'] = $flight->BagFee;
		$data['CcFee'] = $flight->CcFee;
		$data['air_from'] = $air_from;
		$data['air_to'] = $air_to;
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		$this->load->view('flight_hotel/book_elsy_flight_new2',$data);
	}
	function book_elsy_flight_all($hotel_id,$room_id)
		{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$session_id = $this->session->userdata('sessionid');
		$this->Home_Model->delete_getdet_flight($session_id);
		$flight_id = $this->input->post('flight_id');
		//$flight_id = "130418094609-41-2640-976|130418094609-34-2384-879";
		$air_from = $this->input->post('air_from');
		$air_to = $this->input->post('air_to');
		$data['pid'] = $this->input->post('pid');
		$data['ex_id'] = $ex_id = $this->input->post('ex_id');
		$data['flight_id'] = $flight_id;
		$data['country'] = $this->Home_Model->get_country();
		$xml ='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				  <soap:Body>
					<GetFlightDetails xmlns="ElsyArres.API">
					  <SoapMessage>
						<Password>1009E55E71</Password>
						<Username>EgyptspiritAPI</Username>
						<LanguageCode>EN</LanguageCode>
						<CurrencyCode>GBP</CurrencyCode>
						<Request>
						  <FlightId>'.$flight_id.'</FlightId>
						</Request>
					  </SoapMessage>
					</GetFlightDetails>
				  </soap:Body>
				</soap:Envelope>';
				//echo $xml; exit;
				//$url =  "https://testv80.elsyarres.net/service.asmx";  //test
				$url = "http://www1v80.elsyarres.net/service.asmx";  //live
			$soap = "ElsyArres.API/GetFlightDetails";
			$ch2=curl_init();
			curl_setopt($ch2, CURLOPT_URL, $url);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
	
			$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
	
			// Execute request, store response and HTTP response code
			$data2=curl_exec($ch2);
			$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
			curl_close($ch2);
			
			$array = $this->xml2array($data2); 
			//echo "<pre>"; print_r($data2); exit;
			if(isset($array['soap:Envelope']['attr']))
	        {
				 if($array['soap:Envelope']['soap:Body'])
			 	 {
					$xmlns = $array['soap:Envelope']['soap:Body'];
					if(isset($xmlns['GetFlightDetailsResponse']))
					{
						$SoapMessage = $xmlns['GetFlightDetailsResponse']['SoapMessage'];
						$Response = $SoapMessage['Response'];
						if(isset($Response['CurrencyCode']))
						{
							$currency = $Response['CurrencyCode'];
						}
						else
						{
							$currency = '';
						}
						$FlightDetails = $Response['FlightDetails'];
						if(isset($FlightDetails['MinSinglePaxAge']['value']))
						{
							$MinSinglePaxAge = $FlightDetails['MinSinglePaxAge']['value'];
						}
						else
						{
							$MinSinglePaxAge = '';
						}
						if(isset($FlightDetails['Provider']['value']))
						{
							$Provider = $FlightDetails['Provider']['value'];
						}
						else
						{
							$Provider = '';
						}
						if(isset($FlightDetails['CC3DSecure']['value']))
						{
							$CC3DSecure = $FlightDetails['CC3DSecure']['value'];
						}
						else
						{
							$CC3DSecure = '';
						}
						if(isset($FlightDetails['CCRequiredForCheckIn']['value']))
						{
							$CCRequiredForCheckIn = $FlightDetails['CCRequiredForCheckIn']['value'];
						}
						else
						{
							$CCRequiredForCheckIn = '';
						}
						if(isset($FlightDetails['PassportNoRequired']['value']))
						{
							$PassportNoRequired = $FlightDetails['PassportNoRequired']['value'];
						}
						else
						{
							$PassportNoRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$PassportDetailsRequired = $FlightDetails['PassportDetailsRequired']['value'];
						}
						else
						{
							$PassportDetailsRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$CCExpiryDate = $FlightDetails['CCExpiryDate']['value'];
						}
						else
						{
							$CCExpiryDate = '';
						}
						
						if(isset($FlightDetails['RealRoundtrip']['value']))
						{
							$RealRoundtrip = $FlightDetails['RealRoundtrip']['value'];
						}
						else
						{
							$RealRoundtrip = '';
						}
						if(isset($FlightDetails['TotalFare']['value']))
						{
							$TotalFare = $FlightDetails['TotalFare']['value'];
						}
						else
						{
							$TotalFare = '';
						}
						if(isset($FlightDetails['Outbound']))
						{
							$Outbound = $FlightDetails['Outbound'];
							if(isset($Outbound['CarName']['value']))
							{
								$CarName = $Outbound['CarName']['value'];
							}
							else
							{
								$CarName = 	'';
							}
							if(isset($Outbound['CarCode']['value']))
							{
								$CarCode = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode = 	'';
							}
							if(isset($Outbound['DepName']['value']))
							{
								$DepName = $Outbound['DepName']['value'];
							}
							else
							{
								$DepName = 	'';
							}
							if(isset($Outbound['DepCode']['value']))
							{
								$DepCode = $Outbound['DepCode']['value'];
							}
							else
							{
								$DepCode = 	'';
							}
							if(isset($Outbound['DestName']['value']))
							{
								$DestName = $Outbound['DestName']['value'];
							}
							else
							{
								$DestName = 	'';
							}
							if(isset($Outbound['DestCode']['value']))
							{
								$DestCode = $Outbound['DestCode']['value'];
							}
							else
							{
								$DestCode = 	'';
							}
							if(isset($Outbound['Duration']['value']))
							{
								$Duration = $Outbound['Duration']['value'];
							}
							else
							{
								$Duration = 	'';
							}
							if(isset($Outbound['FlightNo']['value']))
							{
								$FlightNo = $Outbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo = 	'';
							}
							if(isset($Outbound['DepDateTime']['value']))
							{
								$DepDateTime = $Outbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime = 	'';
							}
							if(isset($Outbound['ArrDateTime']['value']))
							{
								$ArrDateTime = $Outbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime = 	'';
							}
							if(isset($Outbound['Legs']))
							{
								$Legs = $Outbound['Legs'];
								if(isset($Legs['Leg']))
								{
									$Leg =  $Legs['Leg'];
									if(isset($Leg['FlightNo']['value']))
									{
										$FlightNo_leg = $Leg['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg = '';
									}
									if(isset($Leg['DepTime']['value']))
									{
										$leg_DepTime = $Leg['DepTime']['value'];
									}
									else
									{
										$leg_DepTime = '';
									}
									if(isset($Leg['ArrTime']['value']))
									{
										$leg_ArrTime = $Leg['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime = '';
									}
								}
							}
							if(isset($Outbound['BillingAmount']['value']))
							{
								$BillingAmount = $Outbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount = 	'';
							}
							 $url = "http://www.google.com/ig/calculator?hl=en&q=1".$currency."=?GBP";
							  $options = array(
								CURLOPT_RETURNTRANSFER => true, // return web page
							  CURLOPT_HEADER         => false,// don't return headers
							  CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
							 );
							
							 $ch = curl_init($url);
							   curl_setopt_array( $ch, $options );
							   $amtcon = curl_exec( $ch ); //let's fetch the result using cURL
							 curl_close( $ch );
							 
							 if( $amtcon === FALSE )
							   return $amtcon;
							
							  $amtcon = explode('"',$amtcon);
							  $amtcon = str_replace(chr(160), '', substr( $amtcon[3], 0, strpos($amtcon[3], ' ') ) );
							  ( $amtcon == 0 ) ? FALSE : $amtcon;
							  
							  $TotalFare = $amtcon;
							$this->Home_Model->insert_getflight_det_outbound($session_id,$flight_id,$MinSinglePaxAge,$Provider,$CC3DSecure,$CCRequiredForCheckIn,$PassportNoRequired,$PassportDetailsRequired,$CCExpiryDate,$RealRoundtrip,$TotalFare,$CarName,$CarCode,$DepName,$DepCode,$DestName,$DestCode,$Duration,$FlightNo,$DepDateTime,$ArrDateTime,$FlightNo_leg,$leg_ArrTime,$leg_DepTime,$BillingAmount);
						}
						$type = $this->session->userdata('type');
						if($type == 'ROUNDTRIP')
						{
							if(isset($FlightDetails['Inbound']))
							{
							$Inbound = $FlightDetails['Inbound'];
							if(isset($Inbound['CarName']['value']))
							{
								$CarName_inbound = $Inbound['CarName']['value'];
							}
							else
							{
								$CarName_inbound = 	'';
							}
							if(isset($Inbound['CarCode']['value']))
							{
								$CarCode_inbound = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode_inbound = 	'';
							}
							if(isset($Inbound['DepName']['value']))
							{
								$DepName_inbound = $Inbound['DepName']['value'];
							}
							else
							{
								$DepName_inbound = 	'';
							}
							if(isset($Inbound['DepCode']['value']))
							{
								$DepCode_inbound = $Inbound['DepCode']['value'];
							}
							else
							{
								$DepCode_inbound = 	'';
							}
							if(isset($Inbound['DestName']['value']))
							{
								$DestName_inbound = $Inbound['DestName']['value'];
							}
							else
							{
								$DestName_inbound = 	'';
							}
							if(isset($Inbound['DestCode']['value']))
							{
								$DestCode_inbound = $Inbound['DestCode']['value'];
							}
							else
							{
								$DestCode_inbound = 	'';
							}
							if(isset($Inbound['Duration']['value']))
							{
								$Duration_inbound = $Inbound['Duration']['value'];
							}
							else
							{
								$Duration_inbound = 	'';
							}
							if(isset($Inbound['FlightNo']['value']))
							{
								$FlightNo_inbound = $Inbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo_inbound = 	'';
							}
							if(isset($Inbound['DepDateTime']['value']))
							{
								$DepDateTime_inbound = $Inbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime_inbound = 	'';
							}
							if(isset($Inbound['ArrDateTime']['value']))
							{
								$ArrDateTime_inbound = $Inbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime_inbound = 	'';
							}
							if(isset($Inbound['Legs']))
							{
								$Legs_in = $Inbound['Legs'];
								if(isset($Legs_in['Leg']))
								{
									$Leg_in =  $Legs_in['Leg'];
									if(isset($Leg_in['FlightNo']['value']))
									{
										$FlightNo_leg_in = $Leg_in['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg_in = '';
									}
									if(isset($Leg_in['DepTime']['value']))
									{
										$leg_DepTime_in = $Leg_in['DepTime']['value'];
									}
									else
									{
										$leg_DepTime_in = '';
									}
									if(isset($Leg_in['ArrTime']['value']))
									{
										$leg_ArrTime_in = $Leg_in['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime_in = '';
									}
								}
							}
							if(isset($Inbound['BillingAmount']['value']))
							{
								$BillingAmount_in = $Inbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount_in = 	'';
							}
						$this->Home_Model->insert_getflight_det_inbound($session_id,$flight_id,$MinSinglePaxAge,$RealRoundtrip,$TotalFare,$CarName_inbound,$CarCode_inbound,$DepName_inbound,$DepCode_inbound,$DestName_inbound,$DestCode_inbound,$Duration_inbound,$FlightNo_inbound,$DepDateTime_inbound,$ArrDateTime_inbound,$FlightNo_leg_in,$leg_ArrTime_in,$leg_DepTime_in,$BillingAmount_in);
						}
						}
						//echo "<pre>"; print_r($Leg);
						
						
					}
				 }
			}
			//exit;
		$data['MinSinglePaxAge'] =  $MinSinglePaxAge;
		//echo $air_from; exit;
		$flight = $this->Home_Model->getflight_det_new($flight_id,$air_from,$air_to);
		//echo "<pre>"; print_r($flight); exit;
		if($TotalFare != '')
		{
			$data['total_fare'] = $TotalFare;
		}
		else
		{
			$data['total_fare'] = $flight->TotalFare;
		}
		$data['BagFee'] = $flight->BagFee;
		$data['CcFee'] = $flight->CcFee;
		$data['air_from'] = $air_from;
		$data['air_to'] = $air_to;
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
		$this->load->view('flight_hotel/book_elsy_flight_all',$data);
	}
	function flight_hotel_booking($hotel_id,$room_id)
	{
		 $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		$data['country'] = $this->Home_Model->get_country();
		$this->load->view('flight_hotel/flight_hotel_booking',$data);
	}
	function flight_hotel_booking_withtran($hotel_id,$room_id)
	{
		 $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		$this->load->view('flight_hotel/flight_hotel_booking_withtran',$data);
	}
	function flight_hotel_booking_withact($hotel_id,$room_id,$ex_id)
	{
		 $seg_id = $this->session->userdata('seg_id'); 
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
		$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
		
		$destination = $this->session->userdata('airport_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		$data['ex_det'] = $this->Home_Model->get_excursion_det($ex_id);
		$data['hotel_id'] = $hotel_id;
		$data['room_id'] = $room_id;
		$this->load->view('flight_hotel/flight_hotel_booking_withact',$data);
	}
	function search_result()
	{
			
		//echo "ishan";
		//echo "<pre>";
		//print_r($this->session->userdata);//exit;
		$data['cost']=$this->session->userdata('cost');
		$data['costtype']=$this->session->userdata('costtype');
		$cin=$this->session->userdata('cin');
		$cout=$this->session->userdata('cout');
		$data['disp_city']=$this->session->userdata('disp_city');
		$data['star']='all';
		
		$city = $this->session->userdata('city');
		if($city !='City ,Area, Airport')
		{
			$city=$this->session->userdata('city');
		}
		else
		{
			$city ='';
		}
		$data['cin']=$cin;
		$data['cout']=$cout;
		
		$data['nor']=$this->session->userdata('nor');
		$data['rtype']=$this->session->userdata('rtype');
		$data['city']=$this->session->userdata('city');
		$noofroom=$this->session->userdata('nor');
		$roomusedtype=$this->session->userdata('rtype');
		$days=$this->session->userdata('dt');
		
		
		$data['dt']=$days;
		$data['room']=$this->session->userdata('room');
		$data['adult']=$this->session->userdata('adult');
		$data['child']=$this->session->userdata('child');
		
		
		$data['a_id']=$this->session->userdata('agent_id');	
		
		$agnt=$this->session->userdata('agentid');			
		//$data['last_log']=$this->Agent_Model->agent_last_login($agnt);		
		//$data['acc_info']=$this->Agent_Model->accnt_information($agnt);			
		
		$sec_res=$this->session->userdata('sec_res');	
		$hname=$this->session->userdata('hot_name'); 
		$hotel_name_month=$this->session->userdata('pop_hotel_name'); 
		
		//echo $hotel_name_month; exit;
		//echo "<pre>";
		//print_r($this->session->userdata);exit;
		 if($hname!='')
		{
			
			$hname1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hname);
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hname1%' `nightperroom` !='0' GROUP BY `hotel_name`");
			$result=$query->result();
			
		}
	    else if($hotel_name_month!='')
		{
			
			$hotel_name_month1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hotel_name_month);
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hotel_name_month%' GROUP BY `hotel_name`");
			$result=$query->result();
			
		}
		
		else
		{
			//echo "SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `nightperroom` !='0' GROUP BY `hotel_name` ORDER BY `nightperroom`"; exit;
			$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `nightperroom` !='0' AND `status` IN ('active')  GROUP BY `hotel_name` ORDER BY `nightperroom`");
			//echo "SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`"; exit;
			$result=$query->result();
			

			//$result=$query->result();
			//exit;
		}
		
		/*//print_r($result);
		$perpage=10;
		//$this->session->set_userdata(array('perpage'=>$perpage));
			
			
		 if($hname=='' && $hotel_name_month=='')
		{
			//exit;
			$sresult=$this->Home_Model->get_search_result_info($sec_res,$perpage,$this->uri->segment(3));
			$sresult1=$this->Home_Model->get_search_result_info_per($sec_res,$perpage,$this->uri->segment(3));
		}
		
		elseif($hname!='')
		{
			
			$hotel=$hname;
			$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
		}
		else
		{
			
			
			$hotel=$hotel_name_month;
			$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
		}
	
		//print_r($sresult);
	        $count= count($sresult); 
		$data['total_rows']=$count;
		$config['base_url'] = base_url().'/home/search_result/';
		$config['total_rows'] =$count;
		$config['per_page'] = '10';
		
		$this->pagination->initialize($config);
		
		
		
		
		  $start_key=$this->uri->segment(3);
			
				if($start_key=='')
				{
					$start_key=0;
				}	*/		
				
			$perpage=10;
			
			
		 if($hname=='' && $hotel_name_month=='')
		{
			//exit;
			$sresult=$this->Home_Model->get_search_result_info($sec_res,$perpage,$this->uri->segment(3));
			//echo "<pre>"; print_r($sresult);
		}
		
		elseif($hname!='')
		{
			
			$hotel=$hname;
			$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
		}
		else
		{
			
			
			$hotel=$hotel_name_month;
			$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
		}
	
		
	    $count= count($result); 
		$data['total_rows']=$count;
		$config['base_url'] = base_url().'/home/search_result/';
		$config['total_rows'] =$count;
		$config['per_page'] = '10';
		
		
		$this->pagination->initialize($config);
		
		
		
		
		  $start_key=$this->uri->segment(3);
			
				if($start_key=='')
				{
					$start_key=0;
				}			
					
				
				
				
		if($sresult!=''){
		//echo count($sresult);exit;
		foreach($sresult as $row){
			
		
			$cityNamesvalue[]=$row->city_name;
			$hotelCodevalue[]=$row->hotel_id;
			$cityCodevalue[]=$row->city_name;
			$hotelNamesvalue[]=$row->hotel_name;
			$categoryCodevalue[]=$row->star_rate;
			$pricePerNightvalue[]=$row->nightperroom;
			$RoomCostvalue1[]=$row->cost_value;
			$RoomCost[]=$row->cost_type;
			$apiNameValue[]=$row->api_name;
			$roomtypeValue[]=$row->room_type;
			$inclusionValue[]=$row->inclusion;
			$image[]=$row->image;
		
		}
		
	//	print_r($cityNamesvalue);exit;
		
			if(count($hotelCodevalue)>0)
				{
					$h=0;						
					$end_key = $start_key+10;
					if(count($hotelCodevalue) < $end_key)
					{
						$end_key = count($hotelCodevalue);
					}
					$cityNamesvalue1=array();
					$hotelCodevalue1= array();
					$cityCodevalue1= array();
					$hotelNamesvalue1= array();
					$categoryCodevalue1= array();
					$pricePerNightvalue1= array();
					$RoomCostvalue11=array();	
					$RoomCost1=array();	
					$apiNameValue1=array();	
					$roomtypeValue1=array();	
					$inclusionValue1=array();
					$image1=array();
				
					for($t=$start_key;$t< $end_key;$t++)
					{
						$cityNamesvalue1[$h] = $cityNamesvalue[$t];
						$hotelCodevalue1[$h]= $hotelCodevalue[$t];
						$cityCodevalue1[$h] = $cityCodevalue[$t];
						$hotelNamesvalue1[$h]= $hotelNamesvalue[$t];
						$categoryCodevalue1[$h] = $categoryCodevalue[$t];
					    $pricePerNightvalue1[$h] = $pricePerNightvalue[$t];
						$RoomCostvalue11[$h] = $RoomCostvalue1[$t];
						$RoomCost1[$h] = $RoomCost[$t];
						$apiNameValue1[$h] = $apiNameValue[$t];
						$roomtypeValue1[$h]= $roomtypeValue[$t];
						$inclusionValue1[$h]= $inclusionValue[$t];
					    $image1[$h]= $image[$t];
						$h++;					
					}					
			 	}
							
		
			$data['criteria_id']=$sec_res;
			$data['cityNamesvalue']=$cityNamesvalue1;
			$data['hotelCodevalue']=$hotelCodevalue1;
			$data['cityCodevalue']=$cityCodevalue1;
			$data['hotelNamesvalue']=$hotelNamesvalue1;
		    $data['categoryCodevalue']=$categoryCodevalue1;		
		    $data['pricePerNightvalue']=$pricePerNightvalue1;	
		    $data['RoomCostvalue1']=$RoomCostvalue11;
			$data['RoomCost']=$RoomCost1;		
		    $data['apiNameValue']=$apiNameValue1;	
			$data['roomtypeValue']=$roomtypeValue1;		
		    $data['inclusionValue']=$inclusionValue1;
		    $data['image']=$image1;	
		    $data['result'] = $sresult;
			//print_r($sresult); exit;
		$this->load->view('search_result',$data);
	}
	else
	{
		$this->load->view('search_result',$data);
	}
   }
   function hotel_det($hotelcode,$price,$costtype,$result_id)
   {
	$data['hotelcode'] = $hotelcode;
	$data['price'] = $price;
	$data['costtype'] = $costtype;
	$data['result_id']= $result_id;
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);
	$hotelid = $det->hotel_id;
	$data['meals'] = $this->Home_Model->hotel_meals($hotelid);
	$data['pictures'] = $this->Home_Model->hotel_pictures($hotelid);
	$data['loc'] = $loc = $this->Home_Model->hotel_more_det($hotelcode);
	//$data['rooms'] =$this->Home_Model->
	$this->load->view('hotel_inner',$data);
   }
   function hotel_pictures($hotelcode,$price,$costtype,$result_id)
   {
	$data['hotelcode'] = $hotelcode;
	$data['price'] = $price;
	$data['costtype'] = $costtype;
	$data['result_id']= $result_id;
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);	
	$data['hotelid'] = $hotelid = $det->hotel_id;
	$data['pictures'] = $this->Home_Model->hotel_pictures($hotelid);
	$this->load->view('hotel_inner_pic',$data);
   }
   function hotel_location($hotelcode,$price,$costtype,$result_id)
   {
	$data['hotelcode'] = $hotelcode;
	$data['price'] = $price;
	$data['costtype'] = $costtype;
	$data['result_id']= $result_id;
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);	
	$this->load->view('hotel_inner_location',$data);
   }
   function hotel_booking_view_crs($resultid,$hotelcode,$price)
   {
	/*$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);
	$data['res'] = $res = $this->Home_Model->hotel_result($resultid);	
	$data['price'] = $price;
	//print_r($res); exit;	
	$this->load->view('hotel_booking_view',$data);*/
	 $data['det'] = $det = $this->Home_Model->hotel_more_det($resultid);
	// $data['res'] = $res = $this->Home_Model->hotel_result($resultid);	
	 $data['price'] = $price;
	 //print_r($res); exit;	
	 $data['hotel_id'] = $resultid;
	 $this->session->set_userdata(array('result_id'=>$resultid));
	 $data['destination'] = $destination = $det->city.", Egypt";
			
	 $data['excursion'] = $this->Home_Model->search_excursion($destination);
	 $this->load->view('hotel_extrass_crs_fromhome',$data);   
   }
   function hotel_booking_view_new($resultid,$hotelcode,$price)
   {
	 $data['room_count_window'] = $room_cnt = $_REQUEST['room_count_window']; 
	 $data['checkin_window'] = $checkin = $this->input->post('checkin_window');
	 $data['checkout_window'] = $checkout_window = $this->input->post('checkout_window');
	 $data['adult_window'] = $adult = $this->input->post('adult_window');
	 $data['child_window'] = $child = $this->input->post('child_window');
	 $data['det'] = $det = $this->Home_Model->hotel_more_det($resultid);
	// $data['res'] = $res = $this->Home_Model->hotel_result($resultid);	
	 $data['price'] = $price;
	 //print_r($res); exit;	
	 $data['hotel_id'] = $resultid;
	 $this->session->set_userdata(array('result_id'=>$resultid));
	 $data['destination'] = $destination = $det->city.", Egypt";
			
	 $data['excursion'] = $this->Home_Model->search_excursion($destination);
	 $this->session->set_userdata(array('room_count_window'=>$room_cnt,'checkin_window'=>$checkin,'checkout_window'=>$checkout_window,'adult_window'=>$adult,'child_window'=>$child));
	 $this->load->view('hotel_extrass_crs_fromhome',$data);   
   }
   function hotel_booking_window($resultid,$hotelcode,$price)
   {
	    $data['det'] = $det = $this->Home_Model->hotel_more_det($resultid);
	// $data['res'] = $res = $this->Home_Model->hotel_result($resultid);	
	 $data['price'] = $price;
	 //print_r($res); exit;	
	 $data['hotel_id'] = $resultid;
	 $this->session->set_userdata(array('result_id'=>$resultid));
	 $data['destination'] = $destination = $det->city.", Egypt";
			
	 $data['excursion'] = $this->Home_Model->search_excursion($destination);
	 $this->load->view('hotel_booking_window',$data); 
   }
   function hotel_booking_home($hotelcode)
   {
	   $resultid = $this->session->userdata('result_id');
	   $data['det'] = $this->Home_Model->hotel_more_det($hotelcode);
			
	  // $data['res'] = $res = $this->Home_Model->hotel_result($resultid);	
	   $destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
	   $data['excursion'] = $this->Home_Model->search_excursion($destination);
	   $data['hotel_id'] = $hotelcode;
	   $data['country'] = $this->Home_Model->get_country();
	   $this->load->view('hotel_booking_home',$data);
   }
   function hotel_booking_home_trans($hotelcode)
   {
	   $resultid = $this->session->userdata('result_id');
	   $data['det'] = $this->Home_Model->hotel_more_det($hotelcode);
			
	  // $data['res'] = $res = $this->Home_Model->hotel_result($resultid);	
	   $destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
	   $data['excursion'] = $this->Home_Model->search_excursion($destination);
	   $data['hotel_id'] = $hotelcode;
	   $data['country'] = $this->Home_Model->get_country();
	   $this->load->view('hotel_booking_home_trans',$data);
   }
    function hotel_transfer_add2($hotel_id,$room_id)
	   {
			 $data['det'] = $this->Home_Model->hotel_more_det($hotel_id);
			
			
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			
			$data['excursion'] = $excursion = $this->Home_Model->search_excursion($destination);
			//echo "<pre>"; print_r($excursion); exit;
			$this->load->view('hotel_transfer2',$data);
	   }
   function hotel_extra_crs($resultid,$hotelcode,$price)
   {
	   //echo "<pre>"; print_r($this->session->userdata); exit;
		$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);
		$data['res'] = $res = $this->Home_Model->hotel_result($resultid);	
		$data['price'] = $price;
		//print_r($res); exit;	
		$data['hotel_id'] = $hotelcode;
		$this->session->set_userdata(array('result_id'=>$resultid));
		$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		$this->load->view('hotel_extrass_crs',$data);    
   }
   function hotel_booking_crs($hotel_id)
		{
			$resultid = $this->session->userdata('result_id');
			$data['det'] = $this->Home_Model->hotel_more_det($hotel_id);
			
			$data['res'] = $res = $this->Home_Model->hotel_result($resultid);	
			$destination = $this->session->userdata('disp_city').", ".$this->session->userdata('country_travel');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$data['hotel_id'] = $hotel_id;
			$data['country'] = $this->Home_Model->get_country();
			$this->load->view('hotel_booking_crs',$data);
		}
   function loadpictures()
   {
	   	$this->load->view('hotel_imagesindex');
   }
   function booking_crs1()
   {
		$bookingItemCodeval ='';
		$statusval='On Request';
		$api_reference='';
		$client_reference='';
		$checkin = $this->input->post('checkin1');
		$checkin1 = explode('/',$checkin);
		$cin1 = $checkin1[2].'-'.$checkin1[1].'-'.$checkin1[0];
		$checkout = $this->input->post('checkout1');
		$checkout1 = explode('/',$checkout);
		$cout1 = $checkout1[2].'-'.$checkout1[1].'-'.$checkout1[0];
		$hotelcode = $this->input->post('hotel_code');
		$roomtype = $this->input->post('roomtype');
		if($roomtype == 1)
		{
			$childcount = 2;
			$adult_count = 1;
			$room_type_c = 'Single-Room';
			$booked_amount = $this->input->post('roomtype1');
			$title1 = $this->input->post('title1');
			$fname1 = $this->input->post('fname1');
			$lname1 = $this->input->post('lname1');
		}
		else if($roomtype == 2)
		{
			$childcount = 2;
			$adult_count = 2;
			$room_type_c = 'Twin-Room';
			$booked_amount = $this->input->post('roomtype2');
			$title1 = $this->input->post('title1');
			$fname1 = $this->input->post('fname1');
			$lname1 = $this->input->post('lname1');
			$title2 = $this->input->post('title2');
			$fname2 = $this->input->post('fname2');
			$lname2 = $this->input->post('lname2');
		}
		else if($roomtype == 4)
		{
			$childcount = 4;
			$adult_count = 4;
			$room_type_c = 'Quad-Room';
			$booked_amount = $this->input->post('roomtype3');
			$title1 = $this->input->post('title1');
			$fname1 = $this->input->post('fname1');
			$lname1 = $this->input->post('lname1');
			$title2 = $this->input->post('title2');
			$fname2 = $this->input->post('fname2');
			$lname2 = $this->input->post('lname2');
			$title3 = $this->input->post('title3');
			$fname3 = $this->input->post('fname3');
			$lname3 = $this->input->post('lname3');
			$title4 = $this->input->post('title4');
			$fname4 = $this->input->post('fname4');
			$lname4 = $this->input->post('lname4');
		}
		$cancel_amount = $this->input->post('cancel_amount');
		$contact = $this->input->post('contact');
		$email = $this->input->post('email');
		$remarks = $this->input->post('remarks');
		$hname = $this->input->post('hotel_name');
		$hotel_address = $this->input->post('hotel_address');
		$inclusion = '';
		$pax='';
		$total_amt = $booked_amount * $adult_count;
		$room_type_c = 
		
		$book_id=$this->Home_Model->crs_booking1($bookingItemCodeval,'crs',$statusval,$api_reference,$client_reference,$cin1,$cout1,$hotelcode,$booked_amount,$hname,$hotel_address,$cancel_amount,$remarks,$roomtype,$contact,$email,$adult_count,$childcount,$inclusion,$pax,$total_amt,$room_type_c);
		if($roomtype == 1)
		{		
								
					$this->Home_Model->add_paaanger($book_id,$fname1,$lname1,$title1,$contact);
								
			//$this->Home_Model->add_paaanger1($book_id,$fname1,$lname1,$title1,$contact);
		}
		else if($roomtype == 2)
		{	
								
					$this->Home_Model->add_paaanger($book_id,$fname1,$lname1,$title1,$contact);
					$this->Home_Model->add_paaanger($book_id,$fname2,$lname2,$title2,$contact);
								
			//$this->Home_Model->add_paaanger2($book_id,$fname1,$lname1,$title1,$fname2,$lname2,$title2,$contact);
		}
		else if($roomtype == 4)
		{					
				
					$this->Home_Model->add_paaanger($book_id,$fname1,$lname1,$title1,$contact);
					$this->Home_Model->add_paaanger($book_id,$fname2,$lname2,$title2,$contact);				
					$this->Home_Model->add_paaanger($book_id,$fname3,$lname3,$title3,$contact);
					$this->Home_Model->add_paaanger($book_id,$fname4,$lname4,$title4,$contact);
					
				
			//$this->Home_Model->add_paaanger4($book_id,$fname1,$lname1,$title1,$fname2,$lname2,$title2,$fname3,$lname3,$title3,$fname4,$lname4,$title4,$contact);
		}
		
		$this->session->set_userdata(array('book_id'=>$book_id));
		$data['booked_amount'] = $booked_amount;
		redirect('home/thank_you/'.$book_id,'refresh');


	

   }
   function booking_crs()
   {
	
	$bookingItemCodeval ='';
	$statusval='On Request';
	$api_reference='';
	$client_reference='';
	$checkin=$this->session->userdata('cin');
	$cout=$this->session->userdata('cout');
	$hotelcode=$this->input->post('hotelcode');
	$booked_amount=$this->input->post('booked_amount');
	$hname = $this->input->post('hotelname');
	$address = $this->input->post('address');
	$cancel_amount = $this->input->post('cancel_amount');
	$location = $this->input->post('location');
	$remarks = $this->input->post('remarks');
	$inclusion = '';
	$room_type = $this->input->post('roomtype');
	$pax='';
	$hotel_city_code='';
	$nor = $this->input->post('nor');
	$fname1=$this->input->post('fname');
	$lname1=$this->input->post('lname');
	$salutation1=$this->input->post('salutation');
	$contact=$this->input->post('contact');
	$email = $this->input->post('email');
	$adult_count = count($fname1);
	
	$childname = $this->input->post('fname1');
	$childlast=$this->input->post('lname1');
	$salutationchild=$this->input->post('salutation1');
	
	$childcount = count($childname);
	
	$check_in = explode('-',$checkin);
	$cin1 = $check_in[0].'-'.$check_in[2].'-'.$check_in[1];
	
	$check_out = explode('-',$cout);
	$cout1 = $check_out[0].'-'.$check_out[2].'-'.$check_out[1];
	$nights = $this->session->userdata('dt');
	$book_id=$this->Home_Model->crs_booking($bookingItemCodeval,'crs',$statusval,$api_reference,$client_reference,$checkin,$cout,$hotelcode,$booked_amount,$hname,$address,$cancel_amount,$location,$remarks,$inclusion,$room_type,$pax,$hotel_city_code,$nor,$adult_count,$email,$childcount,$nights);
	
	for($i=0;$i< count($fname1);$i++)
	{					
		$this->Home_Model->add_paaanger($book_id,$fname1[$i],$lname1[$i],$salutation1[$i],$contact);
	}
	$this->session->set_userdata(array('book_id'=>$book_id));
	//redirect('home/thank_you/'.$book_id,'refresh');
	$data['booked_amount'] = $booked_amount;
	//$this->load->view('paypal',$data);
	redirect('home/thank_you/'.$book_id,'refresh');
   }
   function thank_you($bookid)
	{
		$data['bookid'] = $bookid;
		$this->load->view('thank_you',$data);
	}
	function view_voucher($bookid)
	{
		$data['bookid'] = $bookid;
		$this->load->view('voucher',$data);
	}
	function hotel_det1($hotelcode,$price,$costtype)
   {
	$data['hotelcode'] = $hotelcode;
	$data['price'] = $price;
	$data['costtype'] = $costtype;
	$data['result_id']= '';
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);
	$data['hotelid'] = $hotelid = $det->hotel_id;
	$data['pictures'] = $pictures =  $this->Home_Model->hotel_pictures($hotelcode);
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);
	//echo "<pre>"; print_r($det); exit;
	$data['meals'] = $this->Home_Model->hotel_meals($hotelcode);
	//$data['rooms'] =$this->Home_Model->
	$this->load->view('hotel_inner_ext',$data);
   }
   function hotel_pictures1($hotelcode,$price,$costtype)
   {
	$data['hotelcode'] = $hotelcode;
	$data['price'] = $price;
	$data['costtype'] = $costtype;
	$data['result_id']= '';
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);	
	$data['hotelid'] = $hotelid = $det->hotel_id;
	$data['pictures'] = $pictures =  $this->Home_Model->hotel_pictures($hotelid);
	$this->load->view('hotel_inner_pic_ext',$data);
   }
   function hotel_location1($hotelcode,$price,$costtype)
   {
	$data['hotelcode'] = $hotelcode;
	$data['price'] = $price;
	$data['costtype'] = $costtype;
	$data['result_id']= '';
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);	
	$this->load->view('hotel_inner_location_ext',$data);
   }
   function hotel_booking_view_crs1($hotelcode,$price)
   {
	$data['det'] = $det = $this->Home_Model->hotel_more_det($hotelcode);
	
	$data['res'] = $res = '';
	$data['price'] = $price;
	$data['res'] = $res = $this->Home_Model->get_hotel_rate($det->hotel_id);
	//print_r($res); exit;	
	$this->load->view('hotel_booking_view_ext',$data); 
   }
	/* Activities */
	function activities()
	{
		$this->load->view('activity/activities');
	}
   /* Activities End */
	/* Cruise */
	function cruise()
	{
		
		$this->load->view('cruise/cruise');
	}
	function cruise_load()
	{
		$data['cityval'] = $cityval = $this->input->post('cityval');
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');
		$state_room = $this->input->post('state_room');
		$adult =$this->input->post('adult'); 
		$child =$this->input->post('child'); 
		$this->session->set_userdata(array('cruise_city'=>$cityval,'cruise_checkin'=>$checkin,'cruise_checkout'=>$checkout,'state_room'=>$state_room,'cruise_adult'=>$adult,'cruise_child'=>$child));
		$this->load->view('cruise/cruise_load',$data);
		
	}
	function cruise_search()
	{
		$city_val = $this->session->userdata('cruise_city');
		$data['cruise'] = $this->Home_Model->cruise_search($city_val);
		$this->load->view('cruise/cruise_search_result',$data);
	}
	function cruise_inner($cruise_id)
	{
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisename($cruise_id);
		$data['cruise_cab'] = $this->Home_Model->cruise_cab($cruise_id);
		$data['cab_gallery'] = $this->Home_Model->cabin_gallery($cruise_id);
		$data['deck_gallery'] = $this->Home_Model->deck_gallery($cruise_id);
		$data['entertain_gallery'] = $this->Home_Model->entertainment_gallery($cruise_id);
		$data['luxor_gallery'] = $this->Home_Model->luxor_gallery($cruise_id);
		$data['sight_gallery'] = $this->Home_Model->sight_gallery($cruise_id);
		
		$data['deck_plan'] = $this->Home_Model->deck_plan($cruise_id);
		$data['itinerary'] = $this->Home_Model->cruise_itinerary($cruise_id);
		$data['entertain'] = $this->Home_Model->cruise_entertain($cruise_id);
		$data['luxor'] = $this->Home_Model->cruise_luxor($cruise_id);
		$data['sights'] = $this->Home_Model->cruise_sights($cruise_id);
		$this->load->view('cruise/cruise_inner',$data);
	}
	function cruise_inner_fromhome($cruise_id)
	{
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisename($cruise_id);
		$data['cruise_cab'] = $this->Home_Model->cruise_cab($cruise_id);
		$data['cab_gallery'] = $this->Home_Model->cabin_gallery($cruise_id);
		$data['deck_gallery'] = $this->Home_Model->deck_gallery($cruise_id);
		$data['entertain_gallery'] = $this->Home_Model->entertainment_gallery($cruise_id);
		$data['luxor_gallery'] = $this->Home_Model->luxor_gallery($cruise_id);
		$data['sight_gallery'] = $this->Home_Model->sight_gallery($cruise_id);
		
		$data['deck_plan'] = $this->Home_Model->deck_plan($cruise_id);
		$data['itinerary'] = $this->Home_Model->cruise_itinerary($cruise_id);
		$data['entertain'] = $this->Home_Model->cruise_entertain($cruise_id);
		$data['luxor'] = $this->Home_Model->cruise_luxor($cruise_id);
		$data['sights'] = $this->Home_Model->cruise_sights($cruise_id);
		$this->load->view('cruise/cruise_inner_home',$data);
	}
	function Deck_plan()
	{
		$this->load->view('cruise/Deck_plan_inner');
	}
	function cruise_book($cruise_id)
	{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
		$destination = $this->session->userdata('cruise_city');
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		
		$this->load->view('cruise/cruise_extra',$data);
		//$this->load->view('cruise/booking_view',$data); 
	}
	
	 function cruise_book_home2($cruise_id)
	{
		 $data['checkin_window'] = $checkin = $this->input->post('checkin_window');
		 $data['checkout_window'] = $checkout_window = $this->input->post('checkout_window');
		 $data['adult_window'] = $adult = $this->input->post('adult_window');
		 $data['child_window'] = $child = $this->input->post('child_window');
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $cruise_name = $this->Home_Model->get_cruisedet($cruise_id);
		$destination = $cruise_name->cruise_city;
		$data['destination'] = $destination;
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		$this->session->set_userdata(array('checkin_cruise'=>$checkin,'checkout_cruise'=>$checkout_window,'adult_cruise'=>$adult,'child_cruise'=>$child));
		$this->load->view('cruise/cruise_extra_home',$data);
		//$this->load->view('cruise/booking_view',$data); 
	}
	function cruise_book_home($cruise_id)
	{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $cruise_name = $this->Home_Model->get_cruisedet($cruise_id);
		$destination = $cruise_name->cruise_city;
		$data['destination'] = $destination;
		$data['excursion'] = $this->Home_Model->search_excursion($destination);
		
		$this->load->view('cruise/cruise_extra_home',$data);
		//$this->load->view('cruise/booking_view',$data); 
	}
	function cruise_booking_home($cruise_id)
	{
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
		$data['country'] = $this->Home_Model->get_country();
		$this->load->view('cruise/cruise_booking_home',$data);
	}
	function cruise_booking($cruise_id)
	{
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
		$data['country'] = $this->Home_Model->get_country();
		$this->load->view('cruise/cruise_booking',$data);
	}
	function book_crusie_normal()
		{
			$package_id = $this->input->post('crusie_id');
			$package_price = $this->input->post('crusie_price'); 
			$contact_title = $this->input->post('contact_title');
			$lead_fname = $this->input->post('lead_fname');
			$lead_lname = $this->input->post('lead_lname');
			$lead_postcode = $this->input->post('lead_postcode');
			$lead_address = $this->input->post('lead_address');
			$lead_city = $this->input->post('lead_city');
			$lead_country = $this->input->post('lead_country');
			$lead_telephone = $this->input->post('lead_telephone');
			$lead_mobile = $this->input->post('lead_mobile');
			$lead_email = $this->input->post('lead_email');
			$passenger_title = $this->input->post('passenger_title');
			$passenger_fname = $this->input->post('passenger_fname');
			$passenger_lname = $this->input->post('passenger_lname');
			$passenger_dob = $this->input->post('passenger_dob');
			$requests = $this->input->post('requests');
			$status = "On Request" ;
			$category = "crusie";
			$number_of_persons = $this->input->post('number_of_persons');
			if($number_of_persons != '')
			{
			  	$total_price = $number_of_persons * $package_price;
			}
			else
			{
				$total_price = $package_price;
			}
			$id = $this->Tour_Model->package_book_normal($category,$package_id,$package_price,$number_of_persons,$total_price,$contact_title,$lead_fname,$lead_lname,$lead_postcode,$lead_address,$lead_city,$lead_country,$lead_telephone,$lead_mobile,$lead_email,$passenger_title,$passenger_fname,$passenger_lname,$passenger_dob,$requests,$status);
		    redirect('home/cruise_thank_you/'.$id,'refresh');
		}
		function cruise_book_withexcur()
		{
			$package_id = $this->input->post('crusie_id');
			$package_price = $this->input->post('crusie_price'); 
			$excursion_id = $this->input->post('excursion_id');
			$excursion_price = $this->input->post('excursion_price');
			$contact_title = $this->input->post('contact_title');
			$lead_fname = $this->input->post('lead_fname');
			$lead_lname = $this->input->post('lead_lname');
			$lead_postcode = $this->input->post('lead_postcode');
			$lead_address = $this->input->post('lead_address');
			$lead_city = $this->input->post('lead_city');
			$lead_country = $this->input->post('lead_country');
			$lead_telephone = $this->input->post('lead_telephone');
			$lead_mobile = $this->input->post('lead_mobile');
			$lead_email = $this->input->post('lead_email');
			$passenger_title = $this->input->post('passenger_title');
			$passenger_fname = $this->input->post('passenger_fname');
			$passenger_lname = $this->input->post('passenger_lname');
			$passenger_dob = $this->input->post('passenger_dob');
			$requests = $this->input->post('requests');
			$status = "On Request" ;
			$category = "package";
			$number_of_persons = $this->input->post('number_of_persons');
			if($number_of_persons != '')
			{
				$total_package = $number_of_persons * $package_price;
				$total_excursion = $number_of_persons * $excursion_price;
			}
			else
			{
				$total_package = $package_price;
				$total_excursion = $excursion_price;
			}
			$total_price = $total_package + $total_excursion;
			$id = $this->Tour_Model->package_book_with_excursion($category,$package_id,$excursion_id,$excursion_price,$package_price,$number_of_persons,$total_price,$contact_title,$lead_fname,$lead_lname,$lead_postcode,$lead_address,$lead_city,$lead_country,$lead_telephone,$lead_mobile,$lead_email,$passenger_title,$passenger_fname,$passenger_lname,$passenger_dob,$requests,$status);
		    redirect('home/cruise_thank_you2/'.$id,'refresh');
		}
	function cruise_booking_withexc($cruise_id,$ex_id)
	{
		$data['cruise_id'] = $cruise_id;
		$data['ex_id'] = $ex_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
		$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
		$data['country'] = $this->Home_Model->get_country();
		$this->load->view('cruise/cruise_booking2',$data);
	}
	function cruise_excursion($cruise_id,$excursion_id)
	{
		$data['cruise_id'] = $cruise_id;
		$data['ex_id'] = $excursion_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
		$data['excursion_det'] = $this->Home_Model->get_excursion_det($excursion_id);
		$this->load->view('cruise/cruise_excursion',$data);
	}
	function booking_crs_cruise($cruise_id)
	{
		$fname1 = $this->input->post('fname');
		$lname1 = $this->input->post('lname');
		$salutation = $this->input->post('salutation1');
		$email = $this->input->post('email');
		$cruise_checkin = $this->input->post('checkin');
		$cruise_checkout = $this->input->post('checkout');
		$adult_cnt = $this->input->post('adult_cnt');
		$child_cnt = $this->input->post('chil_cnt');
		$contact = $this->input->post('contact');
		$book_id=$this->Home_Model->crs_booking_cruise($cruise_id,$email,$cruise_checkin,$cruise_checkout,$adult_cnt,$child_cnt);
		for($i=0;$i< count($fname1);$i++)
		{
			$this->Home_Model->add_paaanger_cruise($book_id,$fname1[$i],$lname1[$i],$salutation[$i],$contact);
		}
		redirect('home/cruise_thank_you/'.$book_id,'refresh');
	}
	function cruise_thank_you($book_id)
	{
		$data['bookid'] = $book_id;
		$this->load->view('cruise/thank_you',$data);
	}
	function cruise_thank_you2($book_id)
	{
		$data['bookid'] = $book_id;
		$this->load->view('cruise/thank_you2',$data);
	}
	function view_voucher_cruise2($bookid)
	{
		$data['bookid'] = $bookid;
		$this->load->view('cruise/voucher2',$data);
	}
	function view_voucher_cruise($bookid)
	{
		$data['bookid'] = $bookid;
		$this->load->view('cruise/voucher',$data);
	}
	/* Cruise end */
	function aboutus()
	{
		$data['content'] = $this->Home_Model->getaboutus();
		$this->load->view('aboutus',$data); 
	}
	function advertise()
	{
		$data['content'] = $this->Home_Model->getadvertise();
		$this->load->view('aboutus',$data); 
	}
	function franchise()
	{
		$data['content'] = $this->Home_Model->getfranchise();
		$this->load->view('franchise',$data); 
	}
	function testimonials()
	{
		$data['content'] = $this->Home_Model->gettestimonials();
		$this->load->view('testimonials',$data);
	}
	function careers()
	{
		$data['content'] = $this->Home_Model->getcareers();
		$this->load->view('careers',$data);
	}
	function faq()
	{
		$data['content'] = $this->Home_Model->getfaq();
		$this->load->view('faq',$data);
	}
	function partner_offers()
	{
		$data['content'] = $this->Home_Model->getpartners();
		$this->load->view('partner',$data);
	}
	function privacy()
	{
		$data['content'] = $this->Home_Model->getprivacy();
		$this->load->view('privacy',$data);
	}
	function terms()
	{
		$data['content'] = $this->Home_Model->getterms();
		$this->load->view('terms',$data);
	}
	function cancelation()
	{
		$data['content'] = $this->Home_Model->getcancelation();
		$this->load->view('privacy',$data);
	}
	function payment()
	{
		$data['content'] = $this->Home_Model->getpayment();
		$this->load->view('privacy',$data);
	}
	function disclaimer()
	{
		$data['content'] = $this->Home_Model->getdisclaimer();
		$this->load->view('privacy',$data);
	}
	function contact()
	{
		$data['content'] = $this->Home_Model->getcontactus();
		$this->load->view('contact',$data);
	}
	function help()
	{
		$data['content'] = $this->Home_Model->gethelp();
		$this->load->view('help',$data);
	}
	function jobs()
	{
		$data['content'] = $this->Home_Model->getjobs();
		$this->load->view('jobs',$data);
	}
	function tta()
	{
		$data['content'] = $this->Home_Model->gettta();
		$this->load->view('tta',$data);
	}
	function dest_guide()
	{
		$data['content'] = $this->Home_Model->getdest_guide();
		$this->load->view('dest_guide',$data);
	}
	function flights_guide()
	{
		$data['content'] = $this->Home_Model->getflights_guide();
		$this->load->view('flights_guide',$data);
	}
	function sup_fail_cov()
	{
		$data['content'] = $this->Home_Model->getsup_fail_cov();
		$this->load->view('sup_fail_cov',$data);
	}
	/* CAR */
	function car()
	{
		$this->load->view('car/car');
	}
	function load_transfer()
	{
		//$country = $this->input->post('country');
		$service_type = $this->input->post('service_type');
		$city_transfer = $this->input->post('city_transfer');
		$capacity_transfer = $this->input->post('capacity_transfer');
		$this->session->set_userdata(array('service_type'=>$service_type,'city_transfer'=>$city_transfer,'capacity_transfer'=>$capacity_transfer));
		$this->load->view('car/load_car'); 
	}
	function agent_search_transfer()
	{
		$service_type = $this->session->userdata('service_type');
		$city_transfer = $this->session->userdata('city_transfer');
		$capacity_transfer = $this->session->userdata('capacity_transfer');
		$data['transfer_res'] = $this->Transfer_Model->transfer_result_search($service_type,$city_transfer,$capacity_transfer);
		$data['get_europe_country'] = $this->Transfer_Model->get_europe_country();
		$data['get_europe_city'] = $this->Transfer_Model->get_europe_city();
		
		//echo "<pre>"; print_r($data['transfer_res']);exit;
		$this->load->view('car/search_result',$data);
		
	}
	/* CAR */
	/* Excursions */
	function excursion()
	{
		$this->load->view('excursion/excursion');
	}
	function excursion_loading()
	{
		$data['city'] = $activity_city = $this->input->post('activity_city');
		$this->session->set_userdata(array('ex_city'=>$activity_city));
		$this->load->view('excursion/loading',$data);
	}
	function search_excursion()
	{
		$city = $this->input->post('activity_city');
		$data['excursion'] = $this->Home_Model->search_excursion($city);
		$this->load->view('excursion/search_result',$data);
	}
	function excursion_inner($excursion_id)
	{
		$data['excursion'] = $this->Home_Model->get_excursiondet($excursion_id);
		$data['excursion_id'] = $excursion_id;
		$this->load->view('excursion/excursion_detail',$data);
	}
	function excursion_form($excursion_id)
	{
		$date_travel = $this->input->post('checkin');
		$adult = $this->input->post('adult');
		$child = $this->input->post('child');
		$infant = $this->input->post('infant');
		$promotion_code = $this->input->post('promotion_code');
		$this->session->set_userdata(array('ex_datetravel'=>$date_travel,'ex_adult'=>$adult,'ex_child'=>$child,'ex_infant'=>$infant,'ex_prmotioncode'=>$promotion_code));
		$data['excursion'] = $this->Home_Model->get_excursiondet($excursion_id);
		$data['excursion_id'] = $excursion_id;
		$this->load->view('excursion/excursion_summary',$data);
	}
	function booking_crs_excursion($excursion_id)
	{
		$fname1 = $this->input->post('fname');
		$lname1 = $this->input->post('lname');
		$salutation = $this->input->post('salutation');
		$email = $this->input->post('email');
		$ex_checkin = $this->input->post('checkin');
		$adult_cnt = $this->input->post('adult_cnt');
		$contact = $this->input->post('contact');
		$adult = $this->session->userdata('ex_adult');
		$child = $this->session->userdata('ex_child');
		$infant = $this->session->userdata('ex_infant');
		$book_id=$this->Home_Model->crs_booking_excursion($excursion_id,$email,$ex_checkin,$adult_cnt,$child,$infant);
		for($i=0;$i< count($fname1);$i++)
		{
			$this->Home_Model->add_paaanger_excursion($book_id,$fname1[$i],$lname1[$i],$salutation[$i],$contact);
		}
		redirect('home/excursion_thank_you/'.$book_id,'refresh');
	}
	function excursion_thank_you($book_id)
	{
		$data['bookid'] = $book_id;
		$this->load->view('excursion/thank_you',$data);
	}
	function view_voucher_excursion($bookid)
	{
		$data['bookid'] = $bookid;
		$this->load->view('excursion/voucher',$data);
	}
	function modify_Table()
	{
		$this->Home_Model->update_table();
	}
	function flight_load_dest()
	{
		$sec_res=session_id();
		$end = date('d/m/Y'); 
		$return = date('d/m/Y', strtotime('+8 day'));
		$data['type']= $type = $this->input->get('type'); 
		$from1 = $this->input->get('airport_from');
		$to1 = $this->input->get('airport_to');
		if($from1 == '1')
		{
			$data['from'] = $from = 'London, United Kingdom - Heathrow';
			
		}
		if($to1 =='2')
		{
			$data['to'] = $to = 'Cairo, Egypt';
		}
		if($from1 == '3')
		{
			$data['from'] = $from = 'London, United Kingdom - Gatwick';
			
		}
		if($to1 =='4')
		{
			$data['to'] = $to = 'Aswan, Egypt';
		}
		if($from1 == '5')
		{
			$data['from'] = $from = 'Bristol, United Kingdom';
			
		}
		if($to1 =='6')
		{
			$data['to'] = $to = 'Soma Bay';
		}
		if($from1 == '7')
		{
			$data['from'] = $from = 'London, United Kingdom - Stansted';
			
		}
		if($to1 =='8')
		{
			$data['to'] = $to = 'El Gouna';
		}
		if($from1 == '9')
		{
			$data['from'] = $from = 'London, United Kingdom - Luton';
			
		}
		if($to1 =='10')
		{
			$data['to'] = $to = 'Hurghada, Egypt';
		}
		if($from1 == '11')
		{
			$data['from'] = $from = 'Glasgow, United Kingdom - Prestwick';
			
		}
		if($to1 =='12')
		{
			$data['to'] = $to = 'Taba, Egypt';
		}
		if($from1 == '13')
		{
			$data['from'] = $from = 'Liverpool, United Kingdom';
			
		}
		if($to1 =='14')
		{
			$data['to'] = $to = 'Cairo, Egypt';
		}
		if($from1 == '15')
		{
			$data['from'] = $from = 'Birmingham, United Kingdom';
			
		}
		if($to1 =='16')
		{
			$data['to'] = $to = 'Aswan, Egypt';
		}
		if($from1 == '17')
		{
			$data['from'] = $from = 'Bristol, United Kingdom';
			
		}
		if($to1 =='18')
		{
			$data['to'] = $to = 'Hurghada, Egypt';
		}
		if($from1 == '19')
		{
			$data['from'] = $from = 'Humberside, United Kingdom';
			
		}
		if($to1 =='20')
		{
			$data['to'] = $to = 'Taba, Egypt';
		}
		if($from1 == '21')
		{
			$data['from'] = $from = 'Glasgow, United Kingdom - Prestwick';
			
		}
		if($to1 =='22')
		{
			$data['to'] = $to = 'Marsa Alam';
		}
		
		$to_air = explode(',',$to);
		$to_new = $to_air[0];
		$data['departure']= $departure= date('d/m/Y', strtotime('+7 day'));
		$data['return']=$return;
		//$data['departure'] ='31/12/2012';
		//$data['return']= '01/01/2013';
		$data['adult']= $adult= '1';
		$data['child']= $child= '0';
		$data['infant']= $infant = '0';
		$data['class']= $class = 'ECONOMY';
		$this->session->set_userdata(array('air_from'=>$from,'air_to'=>$to_new,'airport_to'=>$to,'depdate'=>$departure,'retdate'=>$return,'adult_flight'=>$adult,'child_flight'=>$child,'infant_flight'=>$infant,'sec_res'=>$sec_res,'class'=>$class,'type'=>$type,'sessionid'=>$sec_res));
		$this->load->view('flight_hotel/load_flight',$data);
	}
	function flight_load()
	{
		$sec_res=session_id();
		$data['type'] = $type = $this->input->post('flight_type_alone');
		$data['air_from'] = $airport_from_alone = $this->input->post('airport_from_alone');
		$data['air_to']= $airport_to_alone = $this->input->post('airport_to_alone');
		$data['checkin_alone']= $checkin_alone = $this->input->post('checkin_alone');
		$data['checkout_alone']= $checkout_alone = $this->input->post('checkout_alone');
		$data['duration']= $duration_alone = $this->input->post('duration_alone');
		$data['adult_alone']= $adult_alone = $this->input->post('adult_alone');
		$data['child_alone']= $child_alone = $this->input->post('child_alone');
		$data['infant_alone']= $infant_alone = $this->input->post('infant_alone');
		$data['class_alone']= $class_alone = $this->input->post('class_alone');
		$this->session->set_userdata(array('air_from'=>$airport_from_alone,'airport_to'=>$airport_to_alone,'depdate'=>$checkin_alone,'retdate'=>$checkout_alone,'adult_flight'=>$adult_alone,'child_flight'=>$child_alone,'infant_flight'=>$infant_alone,'class'=>$class_alone,'type'=>$type,'sessionid'=>$sec_res,'adult_count'=>$adult_alone,'child_count'=>$child_alone,'infant_count'=>$infant_alone));
		//exit;
		$this->load->view('flight_hotel/load_flight_alone',$data);
	}
	function hotel_flight_load()
	{
		$sec_res=session_id();
		$data['room_cnt'] = $room_count = $this->input->post('room_count2');
		//echo "<pre>"; print_r($room_count); exit;
		$data['adult'] = $adult = $this->input->post('adult2');
		$data['child'] = $child = $this->input->post('child2');
		$child_age=$this->input->post('child_age2');
		$data['infant']= $infant = $this->input->post('infant_hf');
		$data['class']= $class2 = $this->input->post('class_hf');
	//	echo "<pre>"; print_r($infant); exit;
		//echo "<pre>"; print_r($adult); 
		//echo $adult[1]; exit;
		if($adult[0] != '')
		{
			$ADLTS_1 = $adult[0];
			$adult = $adult[0];
			$child = $child[0];
			//$infant = $infant[0];
		}
		if(isset($adult[1]) != '')
			{
				$ADLTS_2 = $adult[1]; 
				$adult = $adult[1];
				$child = $child[1];
				//$infant = $infant[1];
			}
		if(isset($adult[2]) != '')
			{
				$ADLTS_3 = $adult[2];
				$adult = $adult[2];
				$child = $child[2];
				//$infant = $infant[2];
			}
		
		else
		{
			$ADLTS_2 = '0';
			$ADLTS_3 = '0';
		}
		
		if(isset($child[0]))
		{
			$CHILD_1 = $child[0];
			
		}
		else
		{
			$CHILD_1 = '0';
		}
		if(isset($child[1]))
		{
			$CHILD_2 = $child[1];
		}
		else
		{
			$CHILD_2 = '0';
		}
		if(isset($child[2]))
		{
			$CHILD_3 = $child[2];
		}
		else
		{
			$CHILD_3 = '0';
		}
		/*if(isset($infant[0]))
		{
			
		}*/
		//echo $ADLTS_2; exit;
		//print_r($child_age);
		$ChildAgeR1C1 = $child_age[0];
		$ChildAgeR1C2 = $child_age[1];
		$ChildAgeR2C1 = $child_age[2];
		$ChildAgeR2C2 = $child_age[3];
		$ChildAgeR3C1 = $child_age[4];
		$ChildAgeR3C2 = $child_age[5];
		
		$data['type']= $type = $this->input->post('flight_type');
		$data['from']= $from = $this->input->post('airport_from1');
		$data['to']= $to1 = $this->input->post('airport_to1');
		$to_air = explode(',',$to1);
		$to = $to_air[0];
		$data['departure']= $departure = $this->input->post('checkin2');
		$data['return']= $return = $this->input->post('checkout2');
		//$data['adult']= $adult = $this->input->post('adult_hf');
		//$data['child']= $child = $this->input->post('child_hf');
		
		
		$data['All_board'] = $All_board = $this->input->post('All_board_fl');
		$data['roomonly'] = $roomonly = $this->input->post('roomonly_fl');
		$data['self_cat'] = $self_cat = $this->input->post('self_cat_fl');
		$data['bed_break'] = $bed_break = $this->input->post('bed_break_fl');
		$data['half_board'] = $half_board = $this->input->post('half_board_fl');
		$data['full_board'] = $full_board = $this->input->post('full_board_fl');
		$data['all_inclusive'] = $all_inclusive = $this->input->post('all_inclusive_fl');
		$data['villa'] = $villa = $this->input->post('villa_fl');
		
		$data['all_star'] = $all_star = $this->input->post('all_star_fl');
		$data['star1'] = $star1 = $this->input->post('star1_fl');
		$data['star2'] = $star2 = $this->input->post('star2_fl');
		$data['star3'] = $star3 = $this->input->post('star3_fl');
		$data['star4'] = $star4 = $this->input->post('star4_fl');
		$data['star5'] = $star5 = $this->input->post('star5_fl');
		
		
		$this->session->set_userdata(array('nor'=>$room_count,'All_board'=>$All_board,'roomonly'=>$roomonly,'self_cat'=>$self_cat,'bed_break'=>$bed_break,'half_board'=>$half_board,'full_board'=>$full_board,'all_inclusive'=>$all_inclusive,'villa'=>$villa,'all_star'=>$all_star,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'air_from'=>$from,'air_to'=>$to,'airport_to'=>$to1,'depdate'=>$departure,'retdate'=>$return,'adult_flight'=>$adult,'child_flight'=>$child,'infant_flight'=>$infant,'sec_res'=>$sec_res,'class'=>$class2,'type'=>$type,'sessionid'=>$sec_res,'adult_count'=>$data['adult'],'child_count'=>$data['child'],'infant_count'=>$data['infant']));
		//exit;
		$this->load->view('flight_hotel/load_flight',$data);
	}
	function flight_availability()
	{
		$sessionid=$this->session->userdata('sessionid');
		$this->Home_Model->delete_flight_result($sessionid);
		$airport_from = $this->input->post('airport_from');
		$airport_to = $this->input->post('airport_to');
		
		$air_from = $this->Home_Model->get_airport_code($airport_from);  
		$air_to = $this->Home_Model->get_airport_code($airport_to); 
		$type = $this->input->post('type');
		$departure = $this->input->post('departure');
		
		$date_from = explode('/',$departure);
		$date_from_db = $date_from[2].'-'.$date_from[1].'-'.$date_from[0];  
			
		$dep = explode('/',$departure);
		$year = substr($dep[2],2,4);
		$depdate = $dep[0].$dep[1].$year;
		$return = $this->input->post('return');
		if($return !='')
		{
			$ret = explode('/',$return);
			$year_return = substr($ret[2],2,4);
			$retdate = $ret[0].$ret[1].$year_return; 
			
			$date_to = explode('/',$return);
			$date_to_db = $date_to[2].'-'.$date_to[1].'-'.$date_to[0]; 
		}
		else
		{
			$retdate = '';
			$date_to_db = '';
		}
		$adults_count = $this->input->post('adult_fl'); 
		$child = $this->input->post('child'); 
		$infant = $this->input->post('infant'); 
		$class = $this->input->post('class');
		$user = 'xml@egyptspirit.co.uk';
		$pass = '*GadsyaHkdaoy*';
		
		//mysql_query("delete from segments where sess_id='".$sessionid."'");
		//mysql_query("delete from flight_price_details where criteria_id='".$sessionid."'");
		
			//$URL='http://test.justgo.ro/xml/api.html/';
			$URL='http://www.justgo.ro/xml/api.html';
			
		 $data = '<JUSTGO>
						<HEADER>
							<USER login="'.$user.'" key="'.$pass.'"/>
							<OPERATION>REQFLTAVAIL</OPERATION>
						</HEADER>
						<REQUEST_FLT_AVAIL from="'.$air_from.'" to="'.$air_to.'" class="'.$class.'" type="'.$type.'" depdate="'.$depdate.'" retdate="'.$retdate.'">
							<NBPASSENGERS ad="'.$adults_count.'" ch="'.$child.'" be="'.$infant.'"/>
						</REQUEST_FLT_AVAIL>
					</JUSTGO>';
		  $xml = 'xml=' . urlencode($data); 
		$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$headers[] = 'Connection: Keep-Alive';
		$headers[] = 'Content-type:application/x-www-form-urlencoded;charset=UTF-8';



		$process = curl_init($URL);
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
	      
		curl_setopt($process, CURLOPT_ENCODING , '');
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
	    
		curl_setopt($process, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
	       
		$xmls = curl_exec($process);
		curl_close($process);
	      //print_r($xmls); exit;

	 $result = simplexml_load_string($xmls);
	//print_r($result);exit;
		foreach($result as $row ){
			$iter=$row->ITINERARY;					
			$prop = $row->PROP;
			$info_resp = $row->INFO_RESP;
			$curency = $info_resp['currency'];
			foreach($prop as $prode){
			$airline = $prode['airline'];
			$idprop = $prode['idprop'];
			$price = $prode->PRICE;
			 $prad =$price['prad'];
			 $prch = $price['prch'];
			 $prbe = $price['prbe'];
			 $total = $price['total'];
			 $taxes = $price['taxes'];
			 $taxad = $price['taxad'];
			 $taxch = $price['taxch'];
			 $taxbe = $price['taxbe'];
			$segdetail = $prode->SEG_DETAIL;
			//echo "<pre>";print_r($price);
			mysql_query("INSERT INTO `flight_price_details` (`criteria_id`,`currency`,`airline`, `idprop`, `prad`, `prch`, `prbe`, `total`, `taxes`, `taxad`, `taxch`, `taxbe`,`airport_from`,`airport_to`,`departure`,`return`) VALUES ('$sessionid','$curency', '$airline', '$idprop', '$prad', '$prch', '$prbe', '$total', '$taxes', '$taxad', '$taxch', '$taxbe','$airport_from','$airport_to','$date_from_db','$date_to_db')");
				$fpid = mysql_insert_id();
		foreach($segdetail as $row1){
			$nbseg = $row1['nbseg'];
			$idseg  = $row1['idseg'];
			$codseg  = $row1['codseg'];
			$nbopt  = $row1['nbopt'];
			$datdep  = $row1['datdep'];
			$timdep  = $row1['timdep'];
			$datarr  = $row1['datarr'];
			$timarr  = $row1['timarr'];
			$from  = $row1['from'];
			$to  = $row1['to'];
			$airline1  = $row1['airline'];
			$flnb  = $row1['flnb'];
			$q1 = mysql_query("INSERT INTO segments (`idprop`,`nbseg`, `idseg`, `codseg`, `nbopt`, `datdep`, `timdep`, `datarr`, `timarr`, `from`, `to`, `airline`, `flnb`,`sess_id`,`airport_from`,`airport_to`,`departure`,`return`,`f_priceid`) VALUES ('$idprop','$nbseg', '$idseg', '$codseg', '$nbopt', '$datdep', '$timdep', '$datarr', '$timarr', '$from', '$to', '$airline1', '$flnb','$sessionid','$from','$to','$date_from_db','$date_to_db','$fpid')");  
		
			}
		
		
	  }
	}
	
	
	$this->flight_availability_elsseyarres($date_from_db,$date_to_db,$air_from,$air_to,$adults_count,$child,$infant);
	//$this->flight_availability_elsseyarres_alternate($date_from_db,$date_to_db,$air_from,$air_to,$adults_count,$child,$infant);
	  // $this->hotel_availability($this->session->userdata('air_to'),$sessionid);
	  $this->session->set_userdata(array('adults_count'=>$adults_count,'child_count'=>$child,'infant_count'=>$infant,'date_from_db'=>$date_from_db)); 
	  redirect('home/flight_result_alone/'.$sessionid.'/'.$air_from.'/'.$air_to.'','refresh');
	}
	function hotel_flight_availability()
	{
		$sessionid=$this->session->userdata('sessionid');
		$this->Home_Model->delete_flight_result($sessionid);
		
		
		
		$airport_from = $this->input->post('airport_from');
		$airport_to = $this->input->post('airport_to');
		
		$air_from = $this->Home_Model->get_airport_code($airport_from);  
		$air_to = $this->Home_Model->get_airport_code($airport_to); 
		$type = $this->input->post('type');
		$departure = $this->input->post('departure');
		
		$date_from = explode('/',$departure);
		$date_from_db = $date_from[2].'-'.$date_from[1].'-'.$date_from[0];  
			
		$dep = explode('/',$departure);
		$year = substr($dep[2],2,4);
		$depdate = $dep[0].$dep[1].$year;
		$return = $this->input->post('return');
		if($return !='')
		{
			$ret = explode('/',$return);
			$year_return = substr($ret[2],2,4);
			$retdate = $ret[0].$ret[1].$year_return; 
			
			$date_to = explode('/',$return);
			$date_to_db = $date_to[2].'-'.$date_to[1].'-'.$date_to[0]; 
		}
		else
		{
			$retdate = '';
			$date_to_db = '';
		}
		$adults = $this->session->userdata('adult_count'); 
		$infants = $this->session->userdata('infant_count'); 
		if(isset($infants[0]))
		{
			$infants1 = $infants[0];
		}
		else
		{
			$infants1 = '0';
		}
		if(isset($infants[1]))
		{
			$infants2 = $infants[1];
		}
		else
		{
			$infants2 = '0';
		}
		if(isset($infants[2]))
		{
			$infants3 = $infants[2];
		}
		else
		{
			$infants3 = '0';
		}
		//echo "<pre>"; print_r($infants); exit;
		$infant = $infants1 + $infants2 + $infants3; 
		if(isset($adults[0]))
		{
			$adults1 = $adults[0];
		}
		else
		{
			$adults1 = '1';
		}
		if(isset($adults[1]))
		{
			$adults2 = $adults[1];
		}
		else
		{
			$adults2 = '0';
		}
		if(isset($adults[2]))
		{
			$adults3 = $adults[2];
		}
		else
		{
			$adults3 = '0';
		}
		$adults_count = $adults1 + $adults2 + $adults3; 
		
		
		//$child = $this->input->post('child');
		$child_count = $this->session->userdata('child_count');
		if(isset($child_count[0]))
		{
			$child1 = $child_count[0];
		}
		else
		{
			$child1 = '0';
		}
		if(isset($child_count[1]))
		{
			$child2 = $child_count[1];
		}
		else
		{
			$child2 = '0';
		}
		if(isset($child_count[2]))
		{
			$child3 = $child_count[2];
		}
		else
		{
			$child3 = '0';
		}
		$child = $child1 + $child2 + $child3;
		//$infant = $this->input->post('infant');
		//echo "<pre>"; print_r($infant); exit;
		$class = $this->input->post('class');
		
		
		
		//$this->session->set_userdata(array('depdate'=>$depdate,'retdate'=>$retdate,'air_from'=>$air_from,'air_to'=>$air_to,'adult_flight'=>$adults,'child_flight'=>$child,'infant_flight'=>$infant,'class'=>$class,'sessionid'=>$sessionid));
		
		$user = 'xml@egyptspirit.co.uk';
		$pass = '*GadsyaHkdaoy*';
		
		//mysql_query("delete from segments where sess_id='".$sessionid."'");
		//mysql_query("delete from flight_price_details where criteria_id='".$sessionid."'");
		
			//$URL='http://test.justgo.ro/xml/api.html/';
			$URL='http://www.justgo.ro/xml/api.html';
			
		 $data = '<JUSTGO>
						<HEADER>
							<USER login="'.$user.'" key="'.$pass.'"/>
							<OPERATION>REQFLTAVAIL</OPERATION>
						</HEADER>
						<REQUEST_FLT_AVAIL from="'.$air_from.'" to="'.$air_to.'" class="'.$class.'" type="'.$type.'" depdate="'.$depdate.'" retdate="'.$retdate.'">
							<NBPASSENGERS ad="'.$adults_count.'" ch="'.$child.'" be="'.$infant.'"/>
						</REQUEST_FLT_AVAIL>
					</JUSTGO>';
		  $xml = 'xml=' . urlencode($data); 
		$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$headers[] = 'Connection: Keep-Alive';
		$headers[] = 'Content-type:application/x-www-form-urlencoded;charset=UTF-8';



		$process = curl_init($URL);
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
	      
		curl_setopt($process, CURLOPT_ENCODING , '');
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
	    
		curl_setopt($process, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
	       
		$xmls = curl_exec($process);
		curl_close($process);
	      //print_r($xmls); exit;

	 $result = simplexml_load_string($xmls);
	//print_r($result);exit;
		foreach($result as $row ){
			$iter=$row->ITINERARY;					
			$prop = $row->PROP;
			$info_resp = $row->INFO_RESP;
			$curency = $info_resp['currency'];
			foreach($prop as $prode){
			$airline = $prode['airline'];
			$idprop = $prode['idprop'];
			$price = $prode->PRICE;
			 $prad =$price['prad'];
			 $prch = $price['prch'];
			 $prbe = $price['prbe'];
			 $total = $price['total'];
			 $taxes = $price['taxes'];
			 $taxad = $price['taxad'];
			 $taxch = $price['taxch'];
			 $taxbe = $price['taxbe'];
			$segdetail = $prode->SEG_DETAIL;
			//echo "<pre>";print_r($price);
			mysql_query("INSERT INTO `flight_price_details` (`criteria_id`,`currency`,`airline`, `idprop`, `prad`, `prch`, `prbe`, `total`, `taxes`, `taxad`, `taxch`, `taxbe`,`airport_from`,`airport_to`,`departure`,`return`) VALUES ('$sessionid','$curency', '$airline', '$idprop', '$prad', '$prch', '$prbe', '$total', '$taxes', '$taxad', '$taxch', '$taxbe','$airport_from','$airport_to','$date_from_db','$date_to_db')");
				$fpid = mysql_insert_id();
		foreach($segdetail as $row1){
			$nbseg = $row1['nbseg'];
			$idseg  = $row1['idseg'];
			$codseg  = $row1['codseg'];
			$nbopt  = $row1['nbopt'];
			$datdep  = $row1['datdep'];
			$timdep  = $row1['timdep'];
			$datarr  = $row1['datarr'];
			$timarr  = $row1['timarr'];
			$from  = $row1['from'];
			$to  = $row1['to'];
			$airline1  = $row1['airline'];
			$flnb  = $row1['flnb'];
			$q1 = mysql_query("INSERT INTO segments (`idprop`,`nbseg`, `idseg`, `codseg`, `nbopt`, `datdep`, `timdep`, `datarr`, `timarr`, `from`, `to`, `airline`, `flnb`,`sess_id`,`airport_from`,`airport_to`,`departure`,`return`,`f_priceid`) VALUES ('$idprop','$nbseg', '$idseg', '$codseg', '$nbopt', '$datdep', '$timdep', '$datarr', '$timarr', '$from', '$to', '$airline1', '$flnb','$sessionid','$from','$to','$date_from_db','$date_to_db','$fpid')");  
		
			}
		
		
	  }
	}
	
	
	$this->flight_availability_elsseyarres($date_from_db,$date_to_db,$air_from,$air_to,$adults_count,$child,$infant);
	//$this->flight_availability_elsseyarres_alternate($date_from_db,$date_to_db,$air_from,$air_to,$adults_count,$child,$infant);
	  // $this->hotel_availability($this->session->userdata('air_to'),$sessionid);
	  $this->session->set_userdata(array('adults_count'=>$adults_count,'child_count'=>$child,'infant_count'=>$infant,'date_from_db'=>$date_from_db)); 
	  redirect('home/hotel_flight_result_new/'.$sessionid.'/'.$air_from.'/'.$air_to.'','refresh');
	}
	function flight_availability_elsseyarres_alternate($date_from_db1,$date_to_db,$air_from,$air_to,$adults_count,$child,$infant)
	{
		//echo $date_from_db1;
		$date_from_db = date("Y-m-d", strtotime('+1 day', strtotime($date_from_db1))); 
		$sessionid=$this->session->userdata('sessionid');
		$this->Home_Model->delete_getdet_flight_new($sessionid,$air_from,$air_to);
		//echo "<pre>"; print_r($infant); exit;
		if($infant != '')
		{
			$infant = $infant;
		}
		else
		{
			$infant = '0';
		}
		if($child != '')
		{
			$child = $child;
		}
		else
		{
			$child = '0';
		}
		$type = $this->session->userdata('type');
		if($type == 'ROUNDTRIP')
		{
			$return ='<ReturnDate>'.$date_to_db.'</ReturnDate>';
		}
		else
		{
			$return = '';
		}
		
		/*<Password>0555B8836C</Password>
			<Username>EgyptspiritAPI</Username>*/
		$sessionid=$this->session->userdata('sessionid');
		$xml = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
 			<soap:Body>
			<SearchFlights xmlns="ElsyArres.API">
			<SoapMessage>
			<Password>1009E55E71</Password>
			<Username>EgyptspiritAPI</Username>
			<LanguageCode>EN</LanguageCode>
			<Request>
			<CurrencyCode>GBP</CurrencyCode>
			<Departure>'.trim($air_from).'</Departure>
			<DepartureDate>'.$date_from_db.'</DepartureDate>
			<Destination>'.trim($air_to).'</Destination>
			<MetaSearch>false</MetaSearch>
			<NearbyDepartures>false</NearbyDepartures>
			<NearbyDestinations>false</NearbyDestinations>
			<NumADT>'.$adults_count.'</NumADT>
			<NumCHD>'.$child.'</NumCHD>
			<NumINF>'.$infant.'</NumINF>
			'.$return.'
			<Providers>ElsyArres</Providers>
			<RROnly>false</RROnly>
			<WaitForResult>true</WaitForResult>
			</Request></SoapMessage></SearchFlights></soap:Body></soap:Envelope>';
			//echo $xml;   exit;
			//$url =  "https://testv80.elsyarres.net/service.asmx";  //test
			$url = "http://www1v80.elsyarres.net/service.asmx";      //live
			$soap = "ElsyArres.API/SearchFlights";
			$ch2=curl_init();
			curl_setopt($ch2, CURLOPT_URL, $url);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
	
			$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
	
			// Execute request, store response and HTTP response code
			$data2=curl_exec($ch2);
			$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
			curl_close($ch2);
			
			$array = $this->xml2array($data2); 
			//echo "<pre>"; print_r($data2);  exit;
			if(isset($array['soap:Envelope']['attr']))
	        {
				 if($array['soap:Envelope']['soap:Body'])
			 	 {
					$xmlns = $array['soap:Envelope']['soap:Body'];
					if(isset($xmlns['SearchFlightsResponse']))
					{
						$search_flights = $xmlns['SearchFlightsResponse'];
						$xml = $search_flights['attr']['xmlns'];
						if($search_flights['SoapMessage'])
						{
							$soap_message = $search_flights['SoapMessage'];
							$username = $soap_message['Username']['value'];
							$Password = $soap_message['Password']['value'];
							$LanguageCode = $soap_message['LanguageCode']['value'];
							$Request = $soap_message['Request'];
							$Departure = $Request['Departure']['value'];
							$Destination = $Request['Destination']['value'];
							$DepartureDate = $Request['DepartureDate']['value'];
							if(isset($Request['ReturnDate']['value']))
							{
								$ReturnDate = $Request['ReturnDate']['value'];
							}
							else
							{
								$ReturnDate = '';
							}
							if(isset($Request['NumADT']['value']))
							{
								$NumADT = $Request['NumADT']['value'];
							}
							else
							{
								$NumADT = '';
							}
							if(isset($Request['NumINF']['value']))
							{
								$NumINF = $Request['NumINF']['value'];
							}
							else
							{
								$NumINF = '';
							}
							if(isset($Request['NumCHD']['value']))
							{
								$NumCHD = $Request['NumCHD']['value'];
							}
							else
							{
								$NumCHD = '';
							}
							$CurrencyCode = $Request['CurrencyCode']['value'];
							$WaitForResult = $Request['WaitForResult']['value'];
							$NearbyDepartures = $Request['NearbyDepartures']['value'];
							$RROnly = $Request['RROnly']['value'];
							$MetaSearch = $Request['MetaSearch']['value'];
							$response = $soap_message['Response'];
							if(isset($response['SearchFlightId']['value']))
							{
								$SearchFlightId = $response['SearchFlightId']['value'];
							}
							else
							{
								$SearchFlightId = '';
							}
							$Roundtrip = $response['Roundtrip']['value'];
							$api = 'elsseyarres';
							
							//echo "<pre>"; print_r($response['Flights']['Flight']); exit;
							
								//$flights1 = $response['Flights']['Flight']; //echo "<pre>"; print_r($flights1); exit;
								if(isset($response['Flights']['Flight']['Outbound']))
								{
									$flights = $response['Flights']['Flight']['Outbound'];
									//echo "<pre>"; print_r($flights); exit;
							
									$flight = $response['Flights']['Flight'];
										//echo "<pre>"; print_r($flight); 
										
											//echo "<pre>"; print_r($Outbound); 
											$Outbound = $flights;
												if(isset($Outbound['CarName']['value']))
												{
													$CarName_outbond = $Outbound['CarName']['value'];
												}
												else
												{
													$CarName_outbond = '';
												}
											
												if(isset($Outbound['CarCode']['value']))
												{
													$CarCode_outbond = $Outbound['CarCode']['value'];
												}
												else
												{
													$CarCode_outbond = '';
												}
												if(isset($Outbound['DepName']['value']))
												{
													$DepName_outbond = $Outbound['DepName']['value'];
												}
												else
												{
													$DepName_outbond = '';
												}
												if(isset($Outbound['DepCode']['value']))
												{
													$DepCode_outbond = $Outbound['DepCode']['value'];
												}
												else
												{
													$DepCode_outbond = '';
												}
												if(isset($Outbound['DestName']['value']))
												{
													$DestName_outbond = $Outbound['DestName']['value'];
												}
												else
												{
													$DestName_outbond = '';
												}
												if(isset($Outbound['DestCode']['value']))
												{
													$DestCode_outbond = $Outbound['DestCode']['value'];
												}
												else
												{
													$DestCode_outbond = '';
												}
												if(isset($Outbound['Duration']['value']))
												{
													$Duration_outbond = $Outbound['Duration']['value'];
												}
												else
												{
													$Duration_outbond = '';
												}
												if(isset($Outbound['FlightNo']['value']))
												{
													$FlightNo_outbond = $Outbound['FlightNo']['value'];
												}
												else
												{
													$FlightNo_outbond = '';
												}
												if(isset($Outbound['DepDateTime']['value']))
												{
													$DepDateTime_outbond = $Outbound['DepDateTime']['value'];
												}
												else
												{
													$DepDateTime_outbond = '';
												}
												if(isset($Outbound['ArrDateTime']['value']))
												{
													$ArrDateTime_outbond = $Outbound['ArrDateTime']['value'];
												}
												else
												{
													$ArrDateTime_outbond = '';
												}
												if(isset($Outbound['Legs']))
												{
													$Legs_outbond = $Outbound['Legs'];
													foreach($Legs_outbond as $leg_outbond)
													{
														if(isset($leg_outbond['Sequence']['value']))
														{
															$Sequence_outbond = $leg_outbond['Sequence']['value'];
														}
														else
														{
															$Sequence_outbond = '';
														}
														//$FlightNo_outbond = $leg_outbond['FlightNo']['value'];
														if(isset($leg_outbond['DepCode']['value']))
														{
															$DepCode_outbond = $leg_outbond['DepCode']['value'];
														}
														else
														{
															$DepCode_outbond = '';
														}
														if(isset($leg_outbond['DepName']['value']))
														{
															$DepName_outbond = $leg_outbond['DepName']['value'];
														}
														else
														{
															$DepName_outbond = '';
														}
														if(isset($leg_outbond['DestName']['value']))
														{
															$DestName_outbond = $leg_outbond['DestName']['value'];
														}
														else
														{
															$DestName_outbond = '';
														}
														if(isset($leg_outbond['DepTime']['value']))
														{
															$DepTime_outbond = $leg_outbond['DepTime']['value'];
														}
														else
														{
															$DepTime_outbond = '';
														}
														if(isset($leg_outbond['ArrTime']['value']))
														{
															$ArrTime_outbond = $leg_outbond['ArrTime']['value'];
														}
														else
														{
															$ArrTime_outbond = '';
														}
														//$CarCode_outbond = $leg_outbond['CarCode']['value'];
														//$CarName_outbond = $leg_outbond['CarName']['value'];
														if(isset($leg_outbond['FareClass']['value']))
														{
															$FareClass_outbond = $leg_outbond['FareClass']['value'];
														}
														else
														{
															$FareClass_outbond = '';
														}
														if(isset($leg_outbond['ArrDateTime']['value']))
														{
															$ArrDateTime_outbond = $leg_outbond['ArrDateTime']['value'];
														}
														else
														{
															$ArrDateTime_outbond = '';
														}
														if(isset($leg_outbond['DepDateTime']['value']))
														{
															$DepDateTime_outbond = $leg_outbond['DepDateTime']['value'];
														}
														else
														{
															$DepDateTime_outbond = '';
														}
													}
												}
												if(isset($Outbound['Taxes']['value']))
												{
													$Taxes_outbond = $Outbound['Taxes']['value'];
												}
												else
												{
													$Taxes_outbond = '';
												}
												if(isset($Outbound['FareADT']['value']))
												{
													$FareADT_outbond = $Outbound['FareADT']['value'];
												}
												else
												{
													$FareADT_outbond = '';
												}
												if(isset($Outbound['FareCHD']['value']))
												{
													$FareCHD_outbond = $Outbound['FareCHD']['value'];
												}
												else
												{
													$FareCHD_outbond = '';
												}
												
												if(isset($Outbound['FareINF']['value']))
												{
													$FareINF_outbond = $Outbound['FareINF']['value'];
												}
												else
												{
													$FareINF_outbond = '';
												}
												if(isset($Outbound['MiscFees']['value']))
												{
													$MiscFees_outbond = $Outbound['MiscFees']['value'];
												}
												else
												{
													$MiscFees_outbond = '';
												}
												if(isset($Outbound['Idx']['value']))
												{
													$Idx_outbond = $Outbound['Idx']['value'];
												}
												else
												{
													$Idx_outbond = '';
												}
												if(isset($Outbound['FareClass']['value']))
												{
													$FareClass_outbond = $Outbound['FareClass']['value'];
												}
												else
												{
													$FareClass_outbond = '';
												}
												if(isset($Outbound['FareType']['value']))
												{
													$FareType_outbond = $Outbound['FareType']['value'];
												}
												else
												{
													$FareType_outbond = '';
												}
												if(isset($Outbound['FareId']['value']))
												{
													$FareId_outbond = $Outbound['FareId']['value'];
												}
										
										
										if(isset($flight['BagFee']['value']))
										{
											$BagFee = $flight['BagFee']['value'];
										}
										else
										{
											$BagFee = '';
										}
										
										if(isset($flight['CcFee']['value']))
										{
											$CcFee = $flight['CcFee']['value'];
										}
										else
										{
											$CcFee = '';
										}
										if(isset($flight['HandlingFee']['value']))
										{
											$HandlingFee = $flight['HandlingFee']['value'];
										}
										else
										{
											$HandlingFee = '';
										}
										if(isset($flight['TotalFare']['value']))
										{
											$TotalFare = $flight['TotalFare']['value'];
										}
										else
										{
											$TotalFare = '';
										}
										if(isset($flight['FlightId']['value']))
										{
											$FlightId = $flight['FlightId']['value'];
										}
										else
										{
											$FlightId = '';
										}
										if(isset($flight['Provider']['value']))
										{
											$Provider = $flight['Provider']['value'];
										}
										else
										{
											$Provider = '';
										}
										$flight_id = $this->Home_Model->insert_flight_elsseyarres($api,$sessionid,$username,$Password,$LanguageCode,$Departure,$Destination,$DepartureDate,$ReturnDate,$NumADT,$NumINF,$NumCHD,$CurrencyCode,$WaitForResult,$RROnly,$MetaSearch,$SearchFlightId,$Roundtrip,$BagFee,$CcFee,$HandlingFee,$TotalFare);
											$flight_id2 = $this->Home_Model->insert_flight_outbound($flight_id,$sessionid,$CarName_outbond,$CarCode_outbond,$DepName_outbond,$DepCode_outbond,$DestName_outbond,$DestCode_outbond,$Duration_outbond,$FlightNo_outbond,$DepDateTime_outbond,$ArrDateTime_outbond,$Taxes_outbond,$FareADT_outbond,$FareCHD_outbond,$FareINF_outbond,$MiscFees_outbond,$Idx_outbond,$FareClass_outbond,$FareType_outbond,$FareId_outbond,$BagFee,$CcFee,$HandlingFee,$TotalFare,$FlightId,$Provider,$NumADT,$NumINF,$NumCHD);
										
										
										//exit;
										//echo $CarName_outbond;
										//echo "<pre>"; print_r($flight); exit;
										if($type == 'ROUNDTRIP')
										{
											$Inbound = $response['Flights']['Flight']['Inbound'];
												//echo "<pre>"; print_r($Inbound);
											//$Inbound = $inbound['Inbound'];
											if(isset($Inbound['CarName']['value']))
											{
												$CarName_inbond = $Inbound['CarName']['value'];
											}
											else
											{
												$CarName_inbond = '';
											}
											if(isset($Inbound['CarCode']['value']))
											{
												$CarCode_inbond = $Inbound['CarCode']['value'];
											}
											else
											{
												$CarCode_inbond = '';
											}
											if(isset($Inbound['DepName']['value']))
											{
												$DepName_inbond = $Inbound['DepName']['value'];
											}
											else
											{
												$DepName_inbond = '';
											}
											if(isset($Inbound['DepCode']['value']))
											{
												$DepCode_inbond = $Inbound['DepCode']['value'];
											}
											else
											{
												$DepCode_inbond = '';
											}
											if(isset($Inbound['DestName']['value']))
											{
												$DestName_inbond = $Inbound['DestName']['value'];
											}
											else
											{
												$DestName_inbond = '';
											}
											if(isset($Inbound['DestCode']['value']))
											{
												$DestCode_inbond = $Inbound['DestCode']['value'];
											}
											else
											{
												$DestCode_inbond = '';
											}
											if(isset($Inbound['Duration']['value']))
											{
												$Duration_inbond = $Inbound['Duration']['value'];
											}
											else
											{
												$Duration_inbond = '';
											}
											if(isset($Inbound['FlightNo']['value']))
											{
												$FlightNo_inbond = $Inbound['FlightNo']['value'];
											}
											else
											{
												$FlightNo_inbond = '';
											}
											if(isset($Inbound['DepDateTime']['value']))
											{
												$DepDateTime_inbond = $Inbound['DepDateTime']['value'];
											}
											else
											{
												$DepDateTime_inbond = '';
											}
											if(isset($Inbound['ArrDateTime']['value']))
											{
												$ArrDateTime_inbond = $Inbound['ArrDateTime']['value'];
											}
											else
											{
												$ArrDateTime_inbond = '';
											}
											if(isset($Inbound['Legs']))
											{
												$Legs_inbond = $Inbound['Legs'];
												foreach($Legs_inbond as $leg_inbond)
												{
													if(isset($leg_inbond['Sequence']['value']))
													{
														$Sequence_inbond = $leg_inbond['Sequence']['value'];
													}
													else
													{
														$Sequence_inbond = '';
													}
													//$FlightNo_inbond = $leg_inbond['FlightNo']['value'];
													if(isset($leg_inbond['DepCode']['value']))
													{
														$DepCode_inbond = $leg_inbond['DepCode']['value'];
													}
													else
													{
														$DepCode_inbond = '';
													}
													if(isset($leg_inbond['DepName']['value']))
													{
														$DepName_inbond = $leg_inbond['DepName']['value'];
													}
													else
													{
														$DepName_inbond = '';
													}
													if(isset($leg_inbond['DestName']['value']))
													{
														$DestName_inbond = $leg_inbond['DestName']['value'];
													}
													else
													{
														$DestName_inbond = ''; 
													}
													if(isset($leg_inbond['DepTime']['value']))
													{
														$DepTime_inbond = $leg_inbond['DepTime']['value'];
													}
													else
													{
														$DepTime_inbond = '';
													}
													if(isset($leg_inbond['ArrTime']['value']))
													{
														$ArrTime_inbond = $leg_inbond['ArrTime']['value'];
													}
													else
													{
														$ArrTime_inbond = '';
													}
													//$CarCode_inbond = $leg_inbond['CarCode']['value'];
													//$CarName_inbond = $leg_inbond['CarName']['value'];
													if(isset($leg_inbond['FareClass']['value']))
													{
														$FareClass_inbond = $leg_inbond['FareClass']['value'];
													}
													else
													{
														$FareClass_inbond = '';
													}
													if(isset($leg_inbond['ArrDateTime']['value']))
													{
														$ArrDateTime_inbond = $leg_inbond['ArrDateTime']['value'];
													}
													else
													{
														$ArrDateTime_inbond  ='';
													}
													if(isset($leg_inbond['DepDateTime']['value']))
													{
														$DepDateTime_inbond = $leg_inbond['DepDateTime']['value'];
													}
													else
													{
														$DepDateTime_inbond = '';
													}
												}
												if(isset($Inbound['Taxes']['value']))
												{
													$Taxes_inbond = $Inbound['Taxes']['value'];
												}
												else
												{
													$Taxes_inbond = '';
												}
												if(isset( $Inbound['FareADT']['value']))
												{
													$FareADT_inbond = $Inbound['FareADT']['value'];
												}
												else
												{
													$FareADT_inbond = '';
												}
												if(isset($Inbound['FareCHD']['value']))
												{
													$FareCHD_inbond = $Inbound['FareCHD']['value'];
												}
												else
												{
													$FareCHD_inbond = '';
												}
												if(isset($Inbound['FareINF']['value']))
												{
													$FareINF_inbond = $Inbound['FareINF']['value'];
												}
												else
												{
													$FareINF_inbond = '';
												}
												if(isset($Inbound['MiscFees']['value']))
												{
													$MiscFees_inbond = $Inbound['MiscFees']['value'];
												}
												else
												{
													$MiscFees_inbond = '';
												}
												if(isset($Inbound['Idx']['value']))
												{
													$Idx_inbond = $Inbound['Idx']['value'];
												}
												else
												{
													$Idx_inbond = '';
												}
												if(isset($Inbound['FareClass']['value']))
												{
													$FareClass_inbond = $Inbound['FareClass']['value'];
												}
												else
												{
													$FareClass_inbond = '';
												}
												if(isset($Inbound['FareType']['value']))
												{
													$FareType_inbond = $Inbound['FareType']['value'];
												}
												else
												{
													$FareType_inbond = '';
												}
												if(isset($Inbound['FareId']['value']))
												{
													$FareId_inbond = $Inbound['FareId']['value'];
												}
												else
												{
													$FareId_inbond =  '';
												}
											}
											$flight_id3 = $this->Home_Model->insert_flight_inbound($flight_id,$sessionid,$CarName_inbond,$CarCode_inbond,$DepName_inbond,$DepCode_inbond,$DestName_inbond,$DestCode_inbond,$Duration_inbond,$FlightNo_inbond,$DepDateTime_inbond,$ArrDateTime_inbond,$Taxes_inbond,$FareADT_inbond,$FareCHD_inbond,$FareINF_inbond,$MiscFees_inbond,$Idx_inbond,$FareClass_inbond,$FareType_inbond,$FareId_inbond,$BagFee,$HandlingFee,$TotalFare,$FlightId,$Provider);
										
										}
									
											
										
								
									}
								elseif(isset($response['Flights']['Flight']))
								{
									
									
								//echo "<pre>"; print_r($response['Flights']['Flight']); exit;
									foreach($response['Flights']['Flight'] as $Outbound1)
									{
										//echo "<pre>"; print_r($Outbound); 
										
											//echo "<pre>"; print_r($Outbound); 
											$Outbound = $Outbound1['Outbound'];
												if(isset($Outbound['CarName']['value']))
												{
													$CarName_outbond = $Outbound['CarName']['value'];
												}
												else
												{
													$CarName_outbond = '';
												}
											
												if(isset($Outbound['CarCode']['value']))
												{
													$CarCode_outbond = $Outbound['CarCode']['value'];
												}
												else
												{
													$CarCode_outbond = '';
												}
												if(isset($Outbound['DepName']['value']))
												{
													$DepName_outbond = $Outbound['DepName']['value'];
												}
												else
												{
													$DepName_outbond = '';
												}
												if(isset($Outbound['DepCode']['value']))
												{
													$DepCode_outbond = $Outbound['DepCode']['value'];
												}
												else
												{
													$DepCode_outbond = '';
												}
												if(isset($Outbound['DestName']['value']))
												{
													$DestName_outbond = $Outbound['DestName']['value'];
												}
												else
												{
													$DestName_outbond = '';
												}
												if(isset($Outbound['DestCode']['value']))
												{
													$DestCode_outbond = $Outbound['DestCode']['value'];
												}
												else
												{
													$DestCode_outbond = '';
												}
												if(isset($Outbound['Duration']['value']))
												{
													$Duration_outbond = $Outbound['Duration']['value'];
												}
												else
												{
													$Duration_outbond = '';
												}
												if(isset($Outbound['FlightNo']['value']))
												{
													$FlightNo_outbond = $Outbound['FlightNo']['value'];
												}
												else
												{
													$FlightNo_outbond = '';
												}
												if(isset($Outbound['DepDateTime']['value']))
												{
													$DepDateTime_outbond = $Outbound['DepDateTime']['value'];
												}
												else
												{
													$DepDateTime_outbond = '';
												}
												if(isset($Outbound['ArrDateTime']['value']))
												{
													$ArrDateTime_outbond = $Outbound['ArrDateTime']['value'];
												}
												else
												{
													$ArrDateTime_outbond = '';
												}
												if(isset($Outbound['Legs']))
												{
													$Legs_outbond = $Outbound['Legs'];
													foreach($Legs_outbond as $leg_outbond)
													{
														if(isset($leg_outbond['Sequence']['value']))
														{
															$Sequence_outbond = $leg_outbond['Sequence']['value'];
														}
														else
														{
															$Sequence_outbond = '';
														}
														//$FlightNo_outbond = $leg_outbond['FlightNo']['value'];
														if(isset($leg_outbond['DepCode']['value']))
														{
															$DepCode_outbond = $leg_outbond['DepCode']['value'];
														}
														else
														{
															$DepCode_outbond = '';
														}
														if(isset($leg_outbond['DepName']['value']))
														{
															$DepName_outbond = $leg_outbond['DepName']['value'];
														}
														else
														{
															$DepName_outbond = '';
														}
														if(isset($leg_outbond['DestName']['value']))
														{
															$DestName_outbond = $leg_outbond['DestName']['value'];
														}
														else
														{
															$DestName_outbond = '';
														}
														if(isset($leg_outbond['DepTime']['value']))
														{
															$DepTime_outbond = $leg_outbond['DepTime']['value'];
														}
														else
														{
															$DepTime_outbond = '';
														}
														if(isset($leg_outbond['ArrTime']['value']))
														{
															$ArrTime_outbond = $leg_outbond['ArrTime']['value'];
														}
														else
														{
															$ArrTime_outbond = '';
														}
														//$CarCode_outbond = $leg_outbond['CarCode']['value'];
														//$CarName_outbond = $leg_outbond['CarName']['value'];
														if(isset($leg_outbond['FareClass']['value']))
														{
															$FareClass_outbond = $leg_outbond['FareClass']['value'];
														}
														else
														{
															$FareClass_outbond = '';
														}
														if(isset($leg_outbond['ArrDateTime']['value']))
														{
															$ArrDateTime_outbond = $leg_outbond['ArrDateTime']['value'];
														}
														else
														{
															$ArrDateTime_outbond = '';
														}
														if(isset($leg_outbond['DepDateTime']['value']))
														{
															$DepDateTime_outbond = $leg_outbond['DepDateTime']['value'];
														}
														else
														{
															$DepDateTime_outbond = '';
														}
													}
												}
												if(isset($Outbound['Taxes']['value']))
												{
													$Taxes_outbond = $Outbound['Taxes']['value'];
												}
												else
												{
													$Taxes_outbond = '';
												}
												if(isset($Outbound['FareADT']['value']))
												{
													$FareADT_outbond = $Outbound['FareADT']['value'];
												}
												else
												{
													$FareADT_outbond = '';
												}
												if(isset($Outbound['FareCHD']['value']))
												{
													$FareCHD_outbond = $Outbound['FareCHD']['value'];
												}
												else
												{
													$FareCHD_outbond = '';
												}
												
												if(isset($Outbound['FareINF']['value']))
												{
													$FareINF_outbond = $Outbound['FareINF']['value'];
												}
												else
												{
													$FareINF_outbond = '';
												}
												if(isset($Outbound['MiscFees']['value']))
												{
													$MiscFees_outbond = $Outbound['MiscFees']['value'];
												}
												else
												{
													$MiscFees_outbond = '';
												}
												if(isset($Outbound['Idx']['value']))
												{
													$Idx_outbond = $Outbound['Idx']['value'];
												}
												else
												{
													$Idx_outbond = '';
												}
												if(isset($Outbound['FareClass']['value']))
												{
													$FareClass_outbond = $Outbound['FareClass']['value'];
												}
												else
												{
													$FareClass_outbond = '';
												}
												if(isset($Outbound['FareType']['value']))
												{
													$FareType_outbond = $Outbound['FareType']['value'];
												}
												else
												{
													$FareType_outbond = '';
												}
												if(isset($Outbound['FareId']['value']) && $Outbound['FareId']['value']!='')
												{
													$FareId_outbond = $Outbound['FareId']['value'];
												}else
												{
													$FareId_outbond = '';
												}
										
										
										if(isset($Outbound1['BagFee']['value']))
										{
											$BagFee = $Outbound1['BagFee']['value'];
										}
										else
										{
											$BagFee = '';
										}
										
										if(isset($Outbound1['CcFee']['value']))
										{
											$CcFee = $Outbound1['CcFee']['value'];
										}
										else
										{
											$CcFee = '';
										}
										if(isset($Outbound1['HandlingFee']['value']))
										{
											$HandlingFee = $Outbound1['HandlingFee']['value'];
										}
										else
										{
											$HandlingFee = '';
										}
										if(isset($Outbound1['TotalFare']['value']))
										{
											$TotalFare = $Outbound1['TotalFare']['value'];
										}
										else
										{
											$TotalFare = '';
										}
										if(isset($Outbound1['FlightId']['value']))
										{
											$FlightId = $Outbound1['FlightId']['value'];
										}
										else
										{
											$FlightId = '';
										}
										if(isset($Outbound1['Provider']['value']))
										{
											$Provider = $Outbound1['Provider']['value'];
										}
										else
										{
											$Provider = '';
										}
										
										$flight_id = $this->Home_Model->insert_flight_elsseyarres($api,$sessionid,$username,$Password,$LanguageCode,$Departure,$Destination,$DepartureDate,$ReturnDate,$NumADT,$NumINF,$NumCHD,$CurrencyCode,$WaitForResult,$RROnly,$MetaSearch,$SearchFlightId,$Roundtrip,$BagFee,$CcFee,$HandlingFee,$TotalFare);
											$flight_id2 = $this->Home_Model->insert_flight_outbound($flight_id,$sessionid,$CarName_outbond,$CarCode_outbond,$DepName_outbond,$DepCode_outbond,$DestName_outbond,$DestCode_outbond,$Duration_outbond,$FlightNo_outbond,$DepDateTime_outbond,$ArrDateTime_outbond,$Taxes_outbond,$FareADT_outbond,$FareCHD_outbond,$FareINF_outbond,$MiscFees_outbond,$Idx_outbond,$FareClass_outbond,$FareType_outbond,$FareId_outbond,$BagFee,$CcFee,$HandlingFee,$TotalFare,$FlightId,$Provider,$NumADT,$NumINF,$NumCHD);
										
										
										//exit;
										//echo $CarName_outbond;
										//echo "<pre>"; print_r($flight); exit;
										if($type == 'ROUNDTRIP')
										{
											
											
											$Inbound = $Outbound1['Inbound'];
											if(isset($Inbound['CarName']['value']))
											{
												$CarName_inbond = $Inbound['CarName']['value'];
											}
											else
											{
												$CarName_inbond = '';
											}
											if(isset($Inbound['CarCode']['value']))
											{
												$CarCode_inbond = $Inbound['CarCode']['value'];
											}
											else
											{
												$CarCode_inbond = '';
											}
											if(isset($Inbound['DepName']['value']))
											{
												$DepName_inbond = $Inbound['DepName']['value'];
											}
											else
											{
												$DepName_inbond = '';
											}
											if(isset($Inbound['DepCode']['value']))
											{
												$DepCode_inbond = $Inbound['DepCode']['value'];
											}
											else
											{
												$DepCode_inbond = '';
											}
											if(isset($Inbound['DestName']['value']))
											{
												$DestName_inbond = $Inbound['DestName']['value'];
											}
											else
											{
												$DestName_inbond = '';
											}
											if(isset($Inbound['DestCode']['value']))
											{
												$DestCode_inbond = $Inbound['DestCode']['value'];
											}
											else
											{
												$DestCode_inbond = '';
											}
											if(isset($Inbound['Duration']['value']))
											{
												$Duration_inbond = $Inbound['Duration']['value'];
											}
											else
											{
												$Duration_inbond = '';
											}
											if(isset($Inbound['FlightNo']['value']))
											{
												$FlightNo_inbond = $Inbound['FlightNo']['value'];
											}
											else
											{
												$FlightNo_inbond = '';
											}
											if(isset($Inbound['DepDateTime']['value']))
											{
												$DepDateTime_inbond = $Inbound['DepDateTime']['value'];
											}
											else
											{
												$DepDateTime_inbond = '';
											}
											if(isset($Inbound['ArrDateTime']['value']))
											{
												$ArrDateTime_inbond = $Inbound['ArrDateTime']['value'];
											}
											else
											{
												$ArrDateTime_inbond = '';
											}
											if(isset($Inbound['Legs']))
											{
												$Legs_inbond = $Inbound['Legs'];
												foreach($Legs_inbond as $leg_inbond)
												{
													if(isset($leg_inbond['Sequence']['value']))
													{
														$Sequence_inbond = $leg_inbond['Sequence']['value'];
													}
													else
													{
														$Sequence_inbond = '';
													}
													//$FlightNo_inbond = $leg_inbond['FlightNo']['value'];
													if(isset($leg_inbond['DepCode']['value']))
													{
														$DepCode_inbond = $leg_inbond['DepCode']['value'];
													}
													else
													{
														$DepCode_inbond = '';
													}
													if(isset($leg_inbond['DepName']['value']))
													{
														$DepName_inbond = $leg_inbond['DepName']['value'];
													}
													else
													{
														$DepName_inbond = '';
													}
													if(isset($leg_inbond['DestName']['value']))
													{
														$DestName_inbond = $leg_inbond['DestName']['value'];
													}
													else
													{
														$DestName_inbond = '';
													}
													if(isset($leg_inbond['DepTime']['value']))
													{
														$DepTime_inbond = $leg_inbond['DepTime']['value'];
													}
													else
													{
														$DepTime_inbond = '';
													}
													if(isset($leg_inbond['ArrTime']['value']))
													{
														$ArrTime_inbond = $leg_inbond['ArrTime']['value'];
													}
													else
													{
														$ArrTime_inbond = '';
													}
													//$CarCode_inbond = $leg_inbond['CarCode']['value'];
													//$CarName_inbond = $leg_inbond['CarName']['value'];
													if(isset($leg_inbond['FareClass']['value']))
													{
														$FareClass_inbond = $leg_inbond['FareClass']['value'];
													}
													else
													{
														$FareClass_inbond = '';
													}
													if(isset($leg_inbond['ArrDateTime']['value']))
													{
														$ArrDateTime_inbond = $leg_inbond['ArrDateTime']['value'];
													}
													else
													{
														$ArrDateTime_inbond = '';
													}
													if(isset($leg_inbond['DepDateTime']['value']))
													{
														$DepDateTime_inbond = $leg_inbond['DepDateTime']['value'];
													}
													else
													{
														$DepDateTime_inbond = '';
													}
												}
											}
												//echo '<pre>'; print_r($Inbound['Taxes']['value']);
												if(isset($Inbound['Taxes']['value']) && $Inbound['Taxes']['value']!='')
												{
												$Taxes_inbond = $Inbound['Taxes']['value'];
												}
												else
												{
													$Taxes_inbond = '';
												}
												
												if(isset($Inbound['FareADT']['value']))
												{
												$FareADT_inbond = $Inbound['FareADT']['value'];
												}
												else
												{
													$FareADT_inbond = '';
												}
												
												if(isset($Inbound['FareCHD']['value']))
												{
												$FareCHD_inbond = $Inbound['FareCHD']['value'];
												}
												else
												{
													$FareCHD_inbond = '';

												}
												
												if(isset($Inbound['FareINF']['value']))
												{
												$FareINF_inbond = $Inbound['FareINF']['value'];
												}
												else
												{
													$FareINF_inbond = '';
												}
												
												if(isset($Inbound['MiscFees']['value']))
												{
												$MiscFees_inbond = $Inbound['MiscFees']['value'];
												}
												else
												{
													$MiscFees_inbond = '';
												}
												
												if(isset($Inbound['Idx']['value']))
												{
												$Idx_inbond = $Inbound['Idx']['value'];
												}else
												{
													$Idx_inbond = '';
												}
												
												if(isset($Inbound['FareClass']['value']))
												{
												$FareClass_inbond = $Inbound['FareClass']['value'];
												}else
												{
													$FareClass_inbond = '';
												}
												
												if(isset($Inbound['FareType']['value']))
												{
												$FareType_inbond = $Inbound['FareType']['value'];
												}
												else
												{
													$FareType_inbond = '';
												}
												
												if(isset($Inbound['FareId']['value']))
												{
												$FareId_inbond = $Inbound['FareId']['value'];
												}
												else
												{
													$FareId_inbond = '';
												}
											
											$flight_id3 = $this->Home_Model->insert_flight_inbound($flight_id,$sessionid,$CarName_inbond,$CarCode_inbond,$DepName_inbond,$DepCode_inbond,$DestName_inbond,$DestCode_inbond,$Duration_inbond,$FlightNo_inbond,$DepDateTime_inbond,$ArrDateTime_inbond,$Taxes_inbond,$FareADT_inbond,$FareCHD_inbond,$FareINF_inbond,$MiscFees_inbond,$Idx_inbond,$FareClass_inbond,$FareType_inbond,$FareId_inbond,$BagFee,$HandlingFee,$TotalFare,$FlightId,$Provider);
										
										}
									
											
										
									}
									
									
								}
								
								}
								
								
								
						   
							
						      
						
					}
				 }
			}
			
			 // exit;
	}
	function flight_availability_elsseyarres($date_from_db,$date_to_db,$air_from,$air_to,$adults_count,$child,$infant)
	{
		//echo $air_from; exit;
		$sessionid=$this->session->userdata('sessionid');
		$this->Home_Model->delete_getdet_flight_new($sessionid,$air_from,$air_to);
		//echo "<pre>"; print_r($infant); exit;
		if($infant != '')
		{
			$infant = $infant;
		}
		else
		{
			$infant = '0';
		}
		if($child != '')
		{
			$child = $child;
		}
		else
		{
			$child = '0';
		}
		$type = $this->session->userdata('type');
		if($type == 'ROUNDTRIP')
		{
			$return ='<ReturnDate>'.$date_to_db.'</ReturnDate>';
		}
		else
		{
			$return = '';
		}
		
		/*<Password>0555B8836C</Password>
			<Username>EgyptspiritAPI</Username>*/
		$sessionid=$this->session->userdata('sessionid');
		$xml = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
 			<soap:Body>
			<SearchFlights xmlns="ElsyArres.API">
			<SoapMessage>
			<Password>1009E55E71</Password>
			<Username>EgyptspiritAPI</Username>
			<LanguageCode>EN</LanguageCode>
			<Request>
			<CurrencyCode>GBP</CurrencyCode>
			<Departure>'.trim($air_from).'</Departure>
			<DepartureDate>'.$date_from_db.'</DepartureDate>
			<Destination>'.trim($air_to).'</Destination>
			<MetaSearch>false</MetaSearch>
			<NearbyDepartures>false</NearbyDepartures>
			<NearbyDestinations>false</NearbyDestinations>
			<NumADT>'.$adults_count.'</NumADT>
			<NumCHD>'.$child.'</NumCHD>
			<NumINF>'.$infant.'</NumINF>
			'.$return.'
			<Providers>ElsyArres</Providers>
			<RROnly>false</RROnly>
			<WaitForResult>true</WaitForResult>
			</Request></SoapMessage></SearchFlights></soap:Body></soap:Envelope>';
			//echo $xml;   exit;
			//$url =  "https://testv80.elsyarres.net/service.asmx";  //test
			$url = "http://www1v80.elsyarres.net/service.asmx";      //live
			$soap = "ElsyArres.API/SearchFlights";
			$ch2=curl_init();
			curl_setopt($ch2, CURLOPT_URL, $url);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
			//curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
			//curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
	
			$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			//curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			//curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
	
			// Execute request, store response and HTTP response code
			$data2=curl_exec($ch2);
			$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
			curl_close($ch2);
			
			$array = $this->xml2array($data2); 
			//echo "<pre>"; print_r($data2);  exit;
			if(isset($array['soap:Envelope']['attr']))
	        {
				 if($array['soap:Envelope']['soap:Body'])
			 	 {
					$xmlns = $array['soap:Envelope']['soap:Body'];
					if(isset($xmlns['SearchFlightsResponse']))
					{
						$search_flights = $xmlns['SearchFlightsResponse'];
						$xml = $search_flights['attr']['xmlns'];
						if($search_flights['SoapMessage'])
						{
							$soap_message = $search_flights['SoapMessage'];
							$username = $soap_message['Username']['value'];
							$Password = $soap_message['Password']['value'];
							$LanguageCode = $soap_message['LanguageCode']['value'];
							$Request = $soap_message['Request'];
							$Departure = $Request['Departure']['value'];
							$Destination = $Request['Destination']['value'];
							$DepartureDate = $Request['DepartureDate']['value'];
							if(isset($Request['ReturnDate']['value']))
							{
								$ReturnDate = $Request['ReturnDate']['value'];
							}
							else
							{
								$ReturnDate = '';
							}
							if(isset($Request['NumADT']['value']))
							{
								$NumADT = $Request['NumADT']['value'];
							}
							else
							{
								$NumADT = '';
							}
							if(isset($Request['NumINF']['value']))
							{
								$NumINF = $Request['NumINF']['value'];
							}
							else
							{
								$NumINF = '';
							}
							if(isset($Request['NumCHD']['value']))
							{
								$NumCHD = $Request['NumCHD']['value'];
							}
							else
							{
								$NumCHD = '';
							}
							$CurrencyCode = $Request['CurrencyCode']['value'];
							$WaitForResult = $Request['WaitForResult']['value'];
							$NearbyDepartures = $Request['NearbyDepartures']['value'];
							$RROnly = $Request['RROnly']['value'];
							$MetaSearch = $Request['MetaSearch']['value'];
							$response = $soap_message['Response'];
							if(isset($response['SearchFlightId']['value']))
							{
								$SearchFlightId = $response['SearchFlightId']['value'];
							}
							else
							{
								$SearchFlightId = '';
							}
							$Roundtrip = $response['Roundtrip']['value'];
							$api = 'elsseyarres';
							
							//echo "<pre>"; print_r($response['Flights']['Flight']); exit;
							
								//$flights1 = $response['Flights']['Flight']; //echo "<pre>"; print_r($flights1); exit;
								if(isset($response['Flights']['Flight']['Outbound']))
								{
									$flights = $response['Flights']['Flight']['Outbound'];
									//echo "<pre>"; print_r($flights); exit;
							
									$flight = $response['Flights']['Flight'];
										//echo "<pre>"; print_r($flight); 
										
											//echo "<pre>"; print_r($Outbound); 
											$Outbound = $flights;
												if(isset($Outbound['CarName']['value']))
												{
													$CarName_outbond = $Outbound['CarName']['value'];
												}
												else
												{
													$CarName_outbond = '';
												}
											
												if(isset($Outbound['CarCode']['value']))
												{
													$CarCode_outbond = $Outbound['CarCode']['value'];
												}
												else
												{
													$CarCode_outbond = '';
												}
												if(isset($Outbound['DepName']['value']))
												{
													$DepName_outbond = $Outbound['DepName']['value'];
												}
												else
												{
													$DepName_outbond = '';
												}
												if(isset($Outbound['DepCode']['value']))
												{
													$DepCode_outbond = $Outbound['DepCode']['value'];
												}
												else
												{
													$DepCode_outbond = '';
												}
												if(isset($Outbound['DestName']['value']))
												{
													$DestName_outbond = $Outbound['DestName']['value'];
												}
												else
												{
													$DestName_outbond = '';
												}
												if(isset($Outbound['DestCode']['value']))
												{
													$DestCode_outbond = $Outbound['DestCode']['value'];
												}
												else
												{
													$DestCode_outbond = '';
												}
												if(isset($Outbound['Duration']['value']))
												{
													$Duration_outbond = $Outbound['Duration']['value'];
												}
												else
												{
													$Duration_outbond = '';
												}
												if(isset($Outbound['FlightNo']['value']))
												{
													$FlightNo_outbond = $Outbound['FlightNo']['value'];
												}
												else
												{
													$FlightNo_outbond = '';
												}
												if(isset($Outbound['DepDateTime']['value']))
												{
													$DepDateTime_outbond = $Outbound['DepDateTime']['value'];
												}
												else
												{
													$DepDateTime_outbond = '';
												}
												if(isset($Outbound['ArrDateTime']['value']))
												{
													$ArrDateTime_outbond = $Outbound['ArrDateTime']['value'];
												}
												else
												{
													$ArrDateTime_outbond = '';
												}
												if(isset($Outbound['Legs']))
												{
													$Legs_outbond = $Outbound['Legs'];
													foreach($Legs_outbond as $leg_outbond)
													{
														if(isset($leg_outbond['Sequence']['value']))
														{
															$Sequence_outbond = $leg_outbond['Sequence']['value'];
														}
														else
														{
															$Sequence_outbond = '';
														}
														//$FlightNo_outbond = $leg_outbond['FlightNo']['value'];
														if(isset($leg_outbond['DepCode']['value']))
														{
															$DepCode_outbond = $leg_outbond['DepCode']['value'];
														}
														else
														{
															$DepCode_outbond = '';
														}
														if(isset($leg_outbond['DepName']['value']))
														{
															$DepName_outbond = $leg_outbond['DepName']['value'];
														}
														else
														{
															$DepName_outbond = '';
														}
														if(isset($leg_outbond['DestName']['value']))
														{
															$DestName_outbond = $leg_outbond['DestName']['value'];
														}
														else
														{
															$DestName_outbond = '';
														}
														if(isset($leg_outbond['DepTime']['value']))
														{
															$DepTime_outbond = $leg_outbond['DepTime']['value'];
														}
														else
														{
															$DepTime_outbond = '';
														}
														if(isset($leg_outbond['ArrTime']['value']))
														{
															$ArrTime_outbond = $leg_outbond['ArrTime']['value'];
														}
														else
														{
															$ArrTime_outbond = '';
														}
														//$CarCode_outbond = $leg_outbond['CarCode']['value'];
														//$CarName_outbond = $leg_outbond['CarName']['value'];
														if(isset($leg_outbond['FareClass']['value']))
														{
															$FareClass_outbond = $leg_outbond['FareClass']['value'];
														}
														else
														{
															$FareClass_outbond = '';
														}
														if(isset($leg_outbond['ArrDateTime']['value']))
														{
															$ArrDateTime_outbond = $leg_outbond['ArrDateTime']['value'];
														}
														else
														{
															$ArrDateTime_outbond = '';
														}
														if(isset($leg_outbond['DepDateTime']['value']))
														{
															$DepDateTime_outbond = $leg_outbond['DepDateTime']['value'];
														}
														else
														{
															$DepDateTime_outbond = '';
														}
													}
												}
												if(isset($Outbound['Taxes']['value']))
												{
													$Taxes_outbond = $Outbound['Taxes']['value'];
												}
												else
												{
													$Taxes_outbond = '';
												}
												if(isset($Outbound['FareADT']['value']))
												{
													$FareADT_outbond = $Outbound['FareADT']['value'];
												}
												else
												{
													$FareADT_outbond = '';
												}
												if(isset($Outbound['FareCHD']['value']))
												{
													$FareCHD_outbond = $Outbound['FareCHD']['value'];
												}
												else
												{
													$FareCHD_outbond = '';
												}
												
												if(isset($Outbound['FareINF']['value']))
												{
													$FareINF_outbond = $Outbound['FareINF']['value'];
												}
												else
												{
													$FareINF_outbond = '';
												}
												if(isset($Outbound['MiscFees']['value']))
												{
													$MiscFees_outbond = $Outbound['MiscFees']['value'];
												}
												else
												{
													$MiscFees_outbond = '';
												}
												if(isset($Outbound['Idx']['value']))
												{
													$Idx_outbond = $Outbound['Idx']['value'];
												}
												else
												{
													$Idx_outbond = '';
												}
												if(isset($Outbound['FareClass']['value']))
												{
													$FareClass_outbond = $Outbound['FareClass']['value'];
												}
												else
												{
													$FareClass_outbond = '';
												}
												if(isset($Outbound['FareType']['value']))
												{
													$FareType_outbond = $Outbound['FareType']['value'];
												}
												else
												{
													$FareType_outbond = '';
												}
												if(isset($Outbound['FareId']['value']))
												{
													$FareId_outbond = $Outbound['FareId']['value'];
												}
										
										
										if(isset($flight['BagFee']['value']))
										{
											$BagFee = $flight['BagFee']['value'];
										}
										else
										{
											$BagFee = '';
										}
										
										if(isset($flight['CcFee']['value']))
										{
											$CcFee = $flight['CcFee']['value'];
										}
										else
										{
											$CcFee = '';
										}
										if(isset($flight['HandlingFee']['value']))
										{
											$HandlingFee = $flight['HandlingFee']['value'];
										}
										else
										{
											$HandlingFee = '';
										}
										if(isset($flight['TotalFare']['value']))
										{
											$TotalFare = $flight['TotalFare']['value'];
										}
										else
										{
											$TotalFare = '';
										}
										if(isset($flight['FlightId']['value']))
										{
											$FlightId = $flight['FlightId']['value'];
										}
										else
										{
											$FlightId = '';
										}
										if(isset($flight['Provider']['value']))
										{
											$Provider = $flight['Provider']['value'];
										}
										else
										{
											$Provider = '';
										}
										$flight_id = $this->Home_Model->insert_flight_elsseyarres($api,$sessionid,$username,$Password,$LanguageCode,$Departure,$Destination,$DepartureDate,$ReturnDate,$NumADT,$NumINF,$NumCHD,$CurrencyCode,$WaitForResult,$RROnly,$MetaSearch,$SearchFlightId,$Roundtrip,$BagFee,$CcFee,$HandlingFee,$TotalFare);
											$flight_id2 = $this->Home_Model->insert_flight_outbound($flight_id,$sessionid,$CarName_outbond,$CarCode_outbond,$DepName_outbond,$DepCode_outbond,$DestName_outbond,$DestCode_outbond,$Duration_outbond,$FlightNo_outbond,$DepDateTime_outbond,$ArrDateTime_outbond,$Taxes_outbond,$FareADT_outbond,$FareCHD_outbond,$FareINF_outbond,$MiscFees_outbond,$Idx_outbond,$FareClass_outbond,$FareType_outbond,$FareId_outbond,$BagFee,$CcFee,$HandlingFee,$TotalFare,$FlightId,$Provider,$NumADT,$NumINF,$NumCHD);
										
										
										//exit;
										//echo $CarName_outbond;
										//echo "<pre>"; print_r($flight); exit;
										if($type == 'ROUNDTRIP')
										{
											$Inbound = $response['Flights']['Flight']['Inbound'];
												//echo "<pre>"; print_r($Inbound);
											//$Inbound = $inbound['Inbound'];
											if(isset($Inbound['CarName']['value']))
											{
												$CarName_inbond = $Inbound['CarName']['value'];
											}
											else
											{
												$CarName_inbond = '';
											}
											if(isset($Inbound['CarCode']['value']))
											{
												$CarCode_inbond = $Inbound['CarCode']['value'];
											}
											else
											{
												$CarCode_inbond = '';
											}
											if(isset($Inbound['DepName']['value']))
											{
												$DepName_inbond = $Inbound['DepName']['value'];
											}
											else
											{
												$DepName_inbond = '';
											}
											if(isset($Inbound['DepCode']['value']))
											{
												$DepCode_inbond = $Inbound['DepCode']['value'];
											}
											else
											{
												$DepCode_inbond = '';
											}
											if(isset($Inbound['DestName']['value']))
											{
												$DestName_inbond = $Inbound['DestName']['value'];
											}
											else
											{
												$DestName_inbond = '';
											}
											if(isset($Inbound['DestCode']['value']))
											{
												$DestCode_inbond = $Inbound['DestCode']['value'];
											}
											else
											{
												$DestCode_inbond = '';
											}
											if(isset($Inbound['Duration']['value']))
											{
												$Duration_inbond = $Inbound['Duration']['value'];
											}
											else
											{
												$Duration_inbond = '';
											}
											if(isset($Inbound['FlightNo']['value']))
											{
												$FlightNo_inbond = $Inbound['FlightNo']['value'];
											}
											else
											{
												$FlightNo_inbond = '';
											}
											if(isset($Inbound['DepDateTime']['value']))
											{
												$DepDateTime_inbond = $Inbound['DepDateTime']['value'];
											}
											else
											{
												$DepDateTime_inbond = '';
											}
											if(isset($Inbound['ArrDateTime']['value']))
											{
												$ArrDateTime_inbond = $Inbound['ArrDateTime']['value'];
											}
											else
											{
												$ArrDateTime_inbond = '';
											}
											if(isset($Inbound['Legs']))
											{
												$Legs_inbond = $Inbound['Legs'];
												foreach($Legs_inbond as $leg_inbond)
												{
													if(isset($leg_inbond['Sequence']['value']))
													{
														$Sequence_inbond = $leg_inbond['Sequence']['value'];
													}
													else
													{
														$Sequence_inbond = '';
													}
													//$FlightNo_inbond = $leg_inbond['FlightNo']['value'];
													if(isset($leg_inbond['DepCode']['value']))
													{
														$DepCode_inbond = $leg_inbond['DepCode']['value'];
													}
													else
													{
														$DepCode_inbond = '';
													}
													if(isset($leg_inbond['DepName']['value']))
													{
														$DepName_inbond = $leg_inbond['DepName']['value'];
													}
													else
													{
														$DepName_inbond = '';
													}
													if(isset($leg_inbond['DestName']['value']))
													{
														$DestName_inbond = $leg_inbond['DestName']['value'];
													}
													else
													{
														$DestName_inbond = ''; 
													}
													if(isset($leg_inbond['DepTime']['value']))
													{
														$DepTime_inbond = $leg_inbond['DepTime']['value'];
													}
													else
													{
														$DepTime_inbond = '';
													}
													if(isset($leg_inbond['ArrTime']['value']))
													{
														$ArrTime_inbond = $leg_inbond['ArrTime']['value'];
													}
													else
													{
														$ArrTime_inbond = '';
													}
													//$CarCode_inbond = $leg_inbond['CarCode']['value'];
													//$CarName_inbond = $leg_inbond['CarName']['value'];
													if(isset($leg_inbond['FareClass']['value']))
													{
														$FareClass_inbond = $leg_inbond['FareClass']['value'];
													}
													else
													{
														$FareClass_inbond = '';
													}
													if(isset($leg_inbond['ArrDateTime']['value']))
													{
														$ArrDateTime_inbond = $leg_inbond['ArrDateTime']['value'];
													}
													else
													{
														$ArrDateTime_inbond  ='';
													}
													if(isset($leg_inbond['DepDateTime']['value']))
													{
														$DepDateTime_inbond = $leg_inbond['DepDateTime']['value'];
													}
													else
													{
														$DepDateTime_inbond = '';
													}
												}
												if(isset($Inbound['Taxes']['value']))
												{
													$Taxes_inbond = $Inbound['Taxes']['value'];
												}
												else
												{
													$Taxes_inbond = '';
												}
												if(isset( $Inbound['FareADT']['value']))
												{
													$FareADT_inbond = $Inbound['FareADT']['value'];
												}
												else
												{
													$FareADT_inbond = '';
												}
												if(isset($Inbound['FareCHD']['value']))
												{
													$FareCHD_inbond = $Inbound['FareCHD']['value'];
												}
												else
												{
													$FareCHD_inbond = '';
												}
												if(isset($Inbound['FareINF']['value']))
												{
													$FareINF_inbond = $Inbound['FareINF']['value'];
												}
												else
												{
													$FareINF_inbond = '';
												}
												if(isset($Inbound['MiscFees']['value']))
												{
													$MiscFees_inbond = $Inbound['MiscFees']['value'];
												}
												else
												{
													$MiscFees_inbond = '';
												}
												if(isset($Inbound['Idx']['value']))
												{
													$Idx_inbond = $Inbound['Idx']['value'];
												}
												else
												{
													$Idx_inbond = '';
												}
												if(isset($Inbound['FareClass']['value']))
												{
													$FareClass_inbond = $Inbound['FareClass']['value'];
												}
												else
												{
													$FareClass_inbond = '';
												}
												if(isset($Inbound['FareType']['value']))
												{
													$FareType_inbond = $Inbound['FareType']['value'];
												}
												else
												{
													$FareType_inbond = '';
												}
												if(isset($Inbound['FareId']['value']))
												{
													$FareId_inbond = $Inbound['FareId']['value'];
												}
												else
												{
													$FareId_inbond =  '';
												}
											}
											$flight_id3 = $this->Home_Model->insert_flight_inbound($flight_id,$sessionid,$CarName_inbond,$CarCode_inbond,$DepName_inbond,$DepCode_inbond,$DestName_inbond,$DestCode_inbond,$Duration_inbond,$FlightNo_inbond,$DepDateTime_inbond,$ArrDateTime_inbond,$Taxes_inbond,$FareADT_inbond,$FareCHD_inbond,$FareINF_inbond,$MiscFees_inbond,$Idx_inbond,$FareClass_inbond,$FareType_inbond,$FareId_inbond,$BagFee,$HandlingFee,$TotalFare,$FlightId,$Provider);
										
										}
									
											
										
								
									}
								elseif(isset($response['Flights']['Flight']))
								{
									
									
								//echo "<pre>"; print_r($response['Flights']['Flight']); exit;
									foreach($response['Flights']['Flight'] as $Outbound1)
									{
										//echo "<pre>"; print_r($Outbound); 
										
											//echo "<pre>"; print_r($Outbound); 
											$Outbound = $Outbound1['Outbound'];
												if(isset($Outbound['CarName']['value']))
												{
													$CarName_outbond = $Outbound['CarName']['value'];
												}
												else
												{
													$CarName_outbond = '';
												}
											
												if(isset($Outbound['CarCode']['value']))
												{
													$CarCode_outbond = $Outbound['CarCode']['value'];
												}
												else
												{
													$CarCode_outbond = '';
												}
												if(isset($Outbound['DepName']['value']))
												{
													$DepName_outbond = $Outbound['DepName']['value'];
												}
												else
												{
													$DepName_outbond = '';
												}
												if(isset($Outbound['DepCode']['value']))
												{
													$DepCode_outbond = $Outbound['DepCode']['value'];
												}
												else
												{
													$DepCode_outbond = '';
												}
												if(isset($Outbound['DestName']['value']))
												{
													$DestName_outbond = $Outbound['DestName']['value'];
												}
												else
												{
													$DestName_outbond = '';
												}
												if(isset($Outbound['DestCode']['value']))
												{
													$DestCode_outbond = $Outbound['DestCode']['value'];
												}
												else
												{
													$DestCode_outbond = '';
												}
												if(isset($Outbound['Duration']['value']))
												{
													$Duration_outbond = $Outbound['Duration']['value'];
												}
												else
												{
													$Duration_outbond = '';
												}
												if(isset($Outbound['FlightNo']['value']))
												{
													$FlightNo_outbond = $Outbound['FlightNo']['value'];
												}
												else
												{
													$FlightNo_outbond = '';
												}
												if(isset($Outbound['DepDateTime']['value']))
												{
													$DepDateTime_outbond = $Outbound['DepDateTime']['value'];
												}
												else
												{
													$DepDateTime_outbond = '';
												}
												if(isset($Outbound['ArrDateTime']['value']))
												{
													$ArrDateTime_outbond = $Outbound['ArrDateTime']['value'];
												}
												else
												{
													$ArrDateTime_outbond = '';
												}
												if(isset($Outbound['Legs']))
												{
													$Legs_outbond = $Outbound['Legs'];
													foreach($Legs_outbond as $leg_outbond)
													{
														if(isset($leg_outbond['Sequence']['value']))
														{
															$Sequence_outbond = $leg_outbond['Sequence']['value'];
														}
														else
														{
															$Sequence_outbond = '';
														}
														//$FlightNo_outbond = $leg_outbond['FlightNo']['value'];
														if(isset($leg_outbond['DepCode']['value']))
														{
															$DepCode_outbond = $leg_outbond['DepCode']['value'];
														}
														else
														{
															$DepCode_outbond = '';
														}
														if(isset($leg_outbond['DepName']['value']))
														{
															$DepName_outbond = $leg_outbond['DepName']['value'];
														}
														else
														{
															$DepName_outbond = '';
														}
														if(isset($leg_outbond['DestName']['value']))
														{
															$DestName_outbond = $leg_outbond['DestName']['value'];
														}
														else
														{
															$DestName_outbond = '';
														}
														if(isset($leg_outbond['DepTime']['value']))
														{
															$DepTime_outbond = $leg_outbond['DepTime']['value'];
														}
														else
														{
															$DepTime_outbond = '';
														}
														if(isset($leg_outbond['ArrTime']['value']))
														{
															$ArrTime_outbond = $leg_outbond['ArrTime']['value'];
														}
														else
														{
															$ArrTime_outbond = '';
														}
														//$CarCode_outbond = $leg_outbond['CarCode']['value'];
														//$CarName_outbond = $leg_outbond['CarName']['value'];
														if(isset($leg_outbond['FareClass']['value']))
														{
															$FareClass_outbond = $leg_outbond['FareClass']['value'];
														}
														else
														{
															$FareClass_outbond = '';
														}
														if(isset($leg_outbond['ArrDateTime']['value']))
														{
															$ArrDateTime_outbond = $leg_outbond['ArrDateTime']['value'];
														}
														else
														{
															$ArrDateTime_outbond = '';
														}
														if(isset($leg_outbond['DepDateTime']['value']))
														{
															$DepDateTime_outbond = $leg_outbond['DepDateTime']['value'];
														}
														else
														{
															$DepDateTime_outbond = '';
														}
													}
												}
												if(isset($Outbound['Taxes']['value']))
												{
													$Taxes_outbond = $Outbound['Taxes']['value'];
												}
												else
												{
													$Taxes_outbond = '';
												}
												if(isset($Outbound['FareADT']['value']))
												{
													$FareADT_outbond = $Outbound['FareADT']['value'];
												}
												else
												{
													$FareADT_outbond = '';
												}
												if(isset($Outbound['FareCHD']['value']))
												{
													$FareCHD_outbond = $Outbound['FareCHD']['value'];
												}
												else
												{
													$FareCHD_outbond = '';
												}
												
												if(isset($Outbound['FareINF']['value']))
												{
													$FareINF_outbond = $Outbound['FareINF']['value'];
												}
												else
												{
													$FareINF_outbond = '';
												}
												if(isset($Outbound['MiscFees']['value']))
												{
													$MiscFees_outbond = $Outbound['MiscFees']['value'];
												}
												else
												{
													$MiscFees_outbond = '';
												}
												if(isset($Outbound['Idx']['value']))
												{
													$Idx_outbond = $Outbound['Idx']['value'];
												}
												else
												{
													$Idx_outbond = '';
												}
												if(isset($Outbound['FareClass']['value']))
												{
													$FareClass_outbond = $Outbound['FareClass']['value'];
												}
												else
												{
													$FareClass_outbond = '';
												}
												if(isset($Outbound['FareType']['value']))
												{
													$FareType_outbond = $Outbound['FareType']['value'];
												}
												else
												{
													$FareType_outbond = '';
												}
												if(isset($Outbound['FareId']['value']) && $Outbound['FareId']['value']!='')
												{
													$FareId_outbond = $Outbound['FareId']['value'];
												}else
												{
													$FareId_outbond = '';
												}
										
										
										if(isset($Outbound1['BagFee']['value']))
										{
											$BagFee = $Outbound1['BagFee']['value'];
										}
										else
										{
											$BagFee = '';
										}
										
										if(isset($Outbound1['CcFee']['value']))
										{
											$CcFee = $Outbound1['CcFee']['value'];
										}
										else
										{
											$CcFee = '';
										}
										if(isset($Outbound1['HandlingFee']['value']))
										{
											$HandlingFee = $Outbound1['HandlingFee']['value'];
										}
										else
										{
											$HandlingFee = '';
										}
										if(isset($Outbound1['TotalFare']['value']))
										{
											$TotalFare = $Outbound1['TotalFare']['value'];
										}
										else
										{
											$TotalFare = '';
										}
										if(isset($Outbound1['FlightId']['value']))
										{
											$FlightId = $Outbound1['FlightId']['value'];
										}
										else
										{
											$FlightId = '';
										}
										if(isset($Outbound1['Provider']['value']))
										{
											$Provider = $Outbound1['Provider']['value'];
										}
										else
										{
											$Provider = '';
										}
										
										$flight_id = $this->Home_Model->insert_flight_elsseyarres($api,$sessionid,$username,$Password,$LanguageCode,$Departure,$Destination,$DepartureDate,$ReturnDate,$NumADT,$NumINF,$NumCHD,$CurrencyCode,$WaitForResult,$RROnly,$MetaSearch,$SearchFlightId,$Roundtrip,$BagFee,$CcFee,$HandlingFee,$TotalFare);
											$flight_id2 = $this->Home_Model->insert_flight_outbound($flight_id,$sessionid,$CarName_outbond,$CarCode_outbond,$DepName_outbond,$DepCode_outbond,$DestName_outbond,$DestCode_outbond,$Duration_outbond,$FlightNo_outbond,$DepDateTime_outbond,$ArrDateTime_outbond,$Taxes_outbond,$FareADT_outbond,$FareCHD_outbond,$FareINF_outbond,$MiscFees_outbond,$Idx_outbond,$FareClass_outbond,$FareType_outbond,$FareId_outbond,$BagFee,$CcFee,$HandlingFee,$TotalFare,$FlightId,$Provider,$NumADT,$NumINF,$NumCHD);
										
										
										//exit;
										//echo $CarName_outbond;
										//echo "<pre>"; print_r($flight); exit;
										if($type == 'ROUNDTRIP')
										{
											
											
											$Inbound = $Outbound1['Inbound'];
											if(isset($Inbound['CarName']['value']))
											{
												$CarName_inbond = $Inbound['CarName']['value'];
											}
											else
											{
												$CarName_inbond = '';
											}
											if(isset($Inbound['CarCode']['value']))
											{
												$CarCode_inbond = $Inbound['CarCode']['value'];
											}
											else
											{
												$CarCode_inbond = '';
											}
											if(isset($Inbound['DepName']['value']))
											{
												$DepName_inbond = $Inbound['DepName']['value'];
											}
											else
											{
												$DepName_inbond = '';
											}
											if(isset($Inbound['DepCode']['value']))
											{
												$DepCode_inbond = $Inbound['DepCode']['value'];
											}
											else
											{
												$DepCode_inbond = '';
											}
											if(isset($Inbound['DestName']['value']))
											{
												$DestName_inbond = $Inbound['DestName']['value'];
											}
											else
											{
												$DestName_inbond = '';
											}
											if(isset($Inbound['DestCode']['value']))
											{
												$DestCode_inbond = $Inbound['DestCode']['value'];
											}
											else
											{
												$DestCode_inbond = '';
											}
											if(isset($Inbound['Duration']['value']))
											{
												$Duration_inbond = $Inbound['Duration']['value'];
											}
											else
											{
												$Duration_inbond = '';
											}
											if(isset($Inbound['FlightNo']['value']))
											{
												$FlightNo_inbond = $Inbound['FlightNo']['value'];
											}
											else
											{
												$FlightNo_inbond = '';
											}
											if(isset($Inbound['DepDateTime']['value']))
											{
												$DepDateTime_inbond = $Inbound['DepDateTime']['value'];
											}
											else
											{
												$DepDateTime_inbond = '';
											}
											if(isset($Inbound['ArrDateTime']['value']))
											{
												$ArrDateTime_inbond = $Inbound['ArrDateTime']['value'];
											}
											else
											{
												$ArrDateTime_inbond = '';
											}
											if(isset($Inbound['Legs']))
											{
												$Legs_inbond = $Inbound['Legs'];
												foreach($Legs_inbond as $leg_inbond)
												{
													if(isset($leg_inbond['Sequence']['value']))
													{
														$Sequence_inbond = $leg_inbond['Sequence']['value'];
													}
													else
													{
														$Sequence_inbond = '';
													}
													//$FlightNo_inbond = $leg_inbond['FlightNo']['value'];
													if(isset($leg_inbond['DepCode']['value']))
													{
														$DepCode_inbond = $leg_inbond['DepCode']['value'];
													}
													else
													{
														$DepCode_inbond = '';
													}
													if(isset($leg_inbond['DepName']['value']))
													{
														$DepName_inbond = $leg_inbond['DepName']['value'];
													}
													else
													{
														$DepName_inbond = '';
													}
													if(isset($leg_inbond['DestName']['value']))
													{
														$DestName_inbond = $leg_inbond['DestName']['value'];
													}
													else
													{
														$DestName_inbond = '';
													}
													if(isset($leg_inbond['DepTime']['value']))
													{
														$DepTime_inbond = $leg_inbond['DepTime']['value'];
													}
													else
													{
														$DepTime_inbond = '';
													}
													if(isset($leg_inbond['ArrTime']['value']))
													{
														$ArrTime_inbond = $leg_inbond['ArrTime']['value'];
													}
													else
													{
														$ArrTime_inbond = '';
													}
													//$CarCode_inbond = $leg_inbond['CarCode']['value'];
													//$CarName_inbond = $leg_inbond['CarName']['value'];
													if(isset($leg_inbond['FareClass']['value']))
													{
														$FareClass_inbond = $leg_inbond['FareClass']['value'];
													}
													else
													{
														$FareClass_inbond = '';
													}
													if(isset($leg_inbond['ArrDateTime']['value']))
													{
														$ArrDateTime_inbond = $leg_inbond['ArrDateTime']['value'];
													}
													else
													{
														$ArrDateTime_inbond = '';
													}
													if(isset($leg_inbond['DepDateTime']['value']))
													{
														$DepDateTime_inbond = $leg_inbond['DepDateTime']['value'];
													}
													else
													{
														$DepDateTime_inbond = '';
													}
												}
											}
												//echo '<pre>'; print_r($Inbound['Taxes']['value']);
												if(isset($Inbound['Taxes']['value']) && $Inbound['Taxes']['value']!='')
												{
												$Taxes_inbond = $Inbound['Taxes']['value'];
												}
												else
												{
													$Taxes_inbond = '';
												}
												
												if(isset($Inbound['FareADT']['value']))
												{
												$FareADT_inbond = $Inbound['FareADT']['value'];
												}
												else
												{
													$FareADT_inbond = '';
												}
												
												if(isset($Inbound['FareCHD']['value']))
												{
												$FareCHD_inbond = $Inbound['FareCHD']['value'];
												}
												else
												{
													$FareCHD_inbond = '';

												}
												
												if(isset($Inbound['FareINF']['value']))
												{
												$FareINF_inbond = $Inbound['FareINF']['value'];
												}
												else
												{
													$FareINF_inbond = '';
												}
												
												if(isset($Inbound['MiscFees']['value']))
												{
												$MiscFees_inbond = $Inbound['MiscFees']['value'];
												}
												else
												{
													$MiscFees_inbond = '';
												}
												
												if(isset($Inbound['Idx']['value']))
												{
												$Idx_inbond = $Inbound['Idx']['value'];
												}else
												{
													$Idx_inbond = '';
												}
												
												if(isset($Inbound['FareClass']['value']))
												{
												$FareClass_inbond = $Inbound['FareClass']['value'];
												}else
												{
													$FareClass_inbond = '';
												}
												
												if(isset($Inbound['FareType']['value']))
												{
												$FareType_inbond = $Inbound['FareType']['value'];
												}
												else
												{
													$FareType_inbond = '';
												}
												
												if(isset($Inbound['FareId']['value']))
												{
												$FareId_inbond = $Inbound['FareId']['value'];
												}
												else
												{
													$FareId_inbond = '';
												}
											
											$flight_id3 = $this->Home_Model->insert_flight_inbound($flight_id,$sessionid,$CarName_inbond,$CarCode_inbond,$DepName_inbond,$DepCode_inbond,$DestName_inbond,$DestCode_inbond,$Duration_inbond,$FlightNo_inbond,$DepDateTime_inbond,$ArrDateTime_inbond,$Taxes_inbond,$FareADT_inbond,$FareCHD_inbond,$FareINF_inbond,$MiscFees_inbond,$Idx_inbond,$FareClass_inbond,$FareType_inbond,$FareId_inbond,$BagFee,$HandlingFee,$TotalFare,$FlightId,$Provider);
										
										}
									
											
										
									}
									
									
								}
								
								}
								
								
								
						   
							
						      
						
					}
				 }
			}
			
			 // exit;
	}
	function get_hotels_flight_elsy()
		{
			$session_id = $this->session->userdata('sessionid');
		//$this->Home_Model->delete_getdet_flight($session_id);
			$data['flight_id'] = $flight_id = $this->input->post('flight_id');
			$data['air_from'] =  $air_from = $this->input->post('air_from');
			$data['air_to'] = $air_to = $this->input->post('air_to');
			$data['pid'] = $pid = $this->input->post('pid');
			//echo $pid; exit;
		$sec_res=$this->session->userdata('sessionid');

		//$seg_id = $this->input->post('seg_id'); 
		//$f_priceid = $this->input->post('f_priceid');
		
		//$seg_id_r = $this->input->post('seg_id_r');
		
		//$f_priceid_r = $this->input->post('f_priceid_r');
		
		//$data['country_travel'] = $country_travel = $this->input->post('country_travel');
		$data['country_travel'] = $country_travel = '';
		$data['destination'] = $destination = $this->session->userdata('air_to'); 
		//$data['resort'] = $resort = $this->input->post('resort'); 
		$data['resort'] = $resort = '';
		$data['All_board'] = $All_board = $this->session->userdata('All_board');
		//$data['All_board'] = $All_board = 'BT';
		$data['roomonly'] = $roomonly = $this->session->userdata('roomonly');
		//$data['roomonly'] = $roomonly = 'BT_RO';
		//BT_SC
		//BT_BB
		//half_board
		//full_board
		//all_inclusive
		//villa
		$data['self_cat'] = $self_cat = $this->session->userdata('self_cat');
		//$data['self_cat'] = $self_cat = '';
		$data['bed_break'] = $bed_break = $this->session->userdata('bed_break');
		//$data['bed_break'] = $bed_break = '';
		$data['half_board'] = $half_board = $this->session->userdata('half_board');
		//$data['half_board'] = $half_board = '';
		$data['full_board'] = $full_board = $this->session->userdata('full_board');
		//$data['full_board'] = $full_board = '';
		$data['all_inclusive'] = $all_inclusive = $this->session->userdata('all_inclusive');
		//$data['all_inclusive'] = $all_inclusive = '';
		$data['villa'] = $villa = $this->session->userdata('villa');
		//$data['villa'] = $villa = '';
		$data['all_star'] = $all_star = $this->session->userdata('all_star');
		//$data['all_star'] = $all_star = 'StarCatAll';
		$data['star1'] = $star1 = $this->session->userdata('star1');
		//$data['star1'] = $star1 = '';
		$data['star2'] = $star2 = $this->session->userdata('star2');
		//$data['star2'] = $star2 = '';
		$data['star3'] = $star3 = $this->session->userdata('star3');
		//$data['star3'] = $star3 = '';
		$data['star4'] = $star4 = $this->session->userdata('star4');
		//$data['star4'] = $star4 = '';
		$data['star5'] = $star5 = $this->session->userdata('star5');
		//$data['star5'] = $star5 = '';
		
		$this->Home_Model->delete_search_result($sec_res);
		//$data['citycode']=$this->input->post('cityval');
		//$data['disp_city']= $disp_city = $this->input->post('cityval');
		$data['citycode']=$this->session->userdata('air_to');
		$data['disp_city']= $disp_city = $this->session->userdata('air_to');
		
		//$data['hotel_name']= $hotel_name = $this->input->post('hotel_name');	
		$data['hotel_name']= $hotel_name = '';
		$this->session->userdata('depdate');
		$data['sd']= $cin = $this->session->userdata('depdate');;
		$data['ed']= $cout = $this->session->userdata('retdate');;
		//echo $cin."-".$cout."-".$disp_city."-".$hotel_name; exit;
		//$data['roomcount']= $roomcount = $this->input->post('room_count');
		$data['roomcount']= $roomcount = '1';
		$data['adult']=$adult=$this->session->userdata('adult_flight');
		$data['child']=$child=$this->session->userdata('child_flight');
		//$data['child_age']=$child_age=$this->input->post('child_age');
		$data['child_age']=$child_age= '';
		/* adults and childs for Youtravel */
		if(isset($adult[0]))
		{
			$ADLTS_1 = $adult[0];
		}
		else
		{
			$ADLTS_1 = '0';
		}
		if(isset($adult[1]))
		{
			$ADLTS_2 = $adult[1];
		}
		else
		{
			$ADLTS_2 = '0';
		}
		if(isset($adult[2]))
		{
			$ADLTS_3 = $adult[2];
		}
		else
		{
			$ADLTS_3 = '0';
		}
		
		if(isset($child[0]))
		{
			$CHILD_1 = $child[0];
		}
		else
		{
			$CHILD_1 = '0';
		}
		if(isset($child[1]))
		{
			$CHILD_2 = $child[1];
		}
		else
		{
			$CHILD_2 = '0';
		}
		if(isset($child[2]))
		{
			$CHILD_3 = $child[2];
		}
		else
		{
			$CHILD_3 = '0';
		}
		//print_r($child_age);
		/*$ChildAgeR1C1 = $child_age[0];
		$ChildAgeR1C2 = $child_age[1];
		$ChildAgeR2C1 = $child_age[2];
		$ChildAgeR2C2 = $child_age[3];
		$ChildAgeR3C1 = $child_age[4];
		$ChildAgeR3C2 = $child_age[5];*/
		
		$ChildAgeR1C1 = '3';
		$ChildAgeR1C2 = '0';
		$ChildAgeR2C1 = '0';
		$ChildAgeR2C2 = '0';
		$ChildAgeR3C1 = '0';
		$ChildAgeR3C2 = '0';
		//$ChildAgeR2C1 = $child_age[2];
		 //exit;
		 /* adults and childs for Youtravel */
		//print_r($adult); exit;
		
		
		$data['boardtype']=$boardtype=$this->input->post('All_board');
		$data['boardtype']= $boardtype = 'BT';
		//$data['starrating']=$starrating=$this->input->post('all_star');
		$data['starrating']=$starrating= 'StarCatAll';
		
		$data['costtype'] =$costtype="GBP";
		/*$adultval = $_POST['adult'];
		$childval = $_POST['child'];*/
		$adultval = $this->session->userdata('adult_flight');
		$childval = $this->session->userdata('child_flight');
		$room_used_type=array();
		$adult_count=1;
		$child_count=0;

	    
		$this->session->set_userdata(array('All_board'=>$All_board,'roomonly'=>$roomonly,'self_cat'=>$self_cat,'bed_break'=>$bed_break,'half_board'=>$half_board,'full_board'=>$full_board,'all_inclusive'=>$all_inclusive,'villa'=>$villa,'all_star'=>$all_star,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'ADLTS_1'=>$ADLTS_1,'ADLTS_2'=>$ADLTS_2,'ADLTS_3'=>$ADLTS_3,'CHILD_1'=>$CHILD_1,'CHILD_2'=>$CHILD_2,'CHILD_3'=>$CHILD_3,'ChildAgeR1C1'=>$ChildAgeR1C1,'ChildAgeR1C2'=>$ChildAgeR1C2,'ChildAgeR2C1'=>$ChildAgeR2C1,'ChildAgeR2C2'=>$ChildAgeR2C2,'ChildAgeR3C1'=>$ChildAgeR3C1,'ChildAgeR3C2'=>$ChildAgeR3C2,'country_travel'=>$country_travel,'destination'=>$destination,'resort'=>$resort,'roomusedtype'=>$room_used_type, 'hotel_name'=>$hotel_name, 'adult_count'=>$adult_count, 'child_count'=>$child_count, 'roomcount'=>$data['roomcount'],'child_age'=>$child_age, 'sec_res'=>$sec_res,'citycode'=>$data['citycode'],'cin'=>$cin,'cout'=>$cout,'disp_city'=>$disp_city, 'boardtype'=>$boardtype, 'starrating'=>$starrating));
	    $this->load->view('flight_hotel/load_customer_new',$data); 
		
		
	
			//$this->load->view('hotel_search_result');
		}
		function get_hotels_flight_elsy1()
		{
			$session_id = $this->session->userdata('sessionid');
		//$this->Home_Model->delete_getdet_flight($session_id);
			$data['flight_id'] = $flight_id = $this->input->post('flight_id');
			$data['air_from'] =  $air_from = $this->input->post('air_from');
			$data['air_to'] = $air_to = $this->input->post('air_to');
			$data['pid'] = $pid = $this->input->post('pid1');
			//echo $pid; exit;
		$sec_res=$this->session->userdata('sessionid');

		//$seg_id = $this->input->post('seg_id'); 
		//$f_priceid = $this->input->post('f_priceid');
		
		//$seg_id_r = $this->input->post('seg_id_r');
		
		//$f_priceid_r = $this->input->post('f_priceid_r');
		
		//$data['country_travel'] = $country_travel = $this->input->post('country_travel');
		$data['country_travel'] = $country_travel = '';
		$data['destination'] = $destination = $this->session->userdata('air_to'); 
		//$data['resort'] = $resort = $this->input->post('resort'); 
		$data['resort'] = $resort = '';
		$data['All_board'] = $All_board = $this->session->userdata('All_board');
		//$data['All_board'] = $All_board = 'BT';
		$data['roomonly'] = $roomonly = $this->session->userdata('roomonly');
		//$data['roomonly'] = $roomonly = 'BT_RO';
		//BT_SC
		//BT_BB
		//half_board
		//full_board
		//all_inclusive
		//villa
		$data['self_cat'] = $self_cat = $this->session->userdata('self_cat');
		//$data['self_cat'] = $self_cat = '';
		$data['bed_break'] = $bed_break = $this->session->userdata('bed_break');
		//$data['bed_break'] = $bed_break = '';
		$data['half_board'] = $half_board = $this->session->userdata('half_board');
		//$data['half_board'] = $half_board = '';
		$data['full_board'] = $full_board = $this->session->userdata('full_board');
		//$data['full_board'] = $full_board = '';
		$data['all_inclusive'] = $all_inclusive = $this->session->userdata('all_inclusive');
		//$data['all_inclusive'] = $all_inclusive = '';
		$data['villa'] = $villa = $this->session->userdata('villa');
		//$data['villa'] = $villa = '';
		$data['all_star'] = $all_star = $this->session->userdata('all_star');
		//$data['all_star'] = $all_star = 'StarCatAll';
		$data['star1'] = $star1 = $this->session->userdata('star1');
		//$data['star1'] = $star1 = '';
		$data['star2'] = $star2 = $this->session->userdata('star2');
		//$data['star2'] = $star2 = '';
		$data['star3'] = $star3 = $this->session->userdata('star3');
		//$data['star3'] = $star3 = '';
		$data['star4'] = $star4 = $this->session->userdata('star4');
		//$data['star4'] = $star4 = '';
		$data['star5'] = $star5 = $this->session->userdata('star5');
		//$data['star5'] = $star5 = '';
		
		$this->Home_Model->delete_search_result($sec_res);
		//$data['citycode']=$this->input->post('cityval');
		//$data['disp_city']= $disp_city = $this->input->post('cityval');
		$data['citycode']=$this->session->userdata('air_to');
		$data['disp_city']= $disp_city = $this->session->userdata('air_to');
		
		//$data['hotel_name']= $hotel_name = $this->input->post('hotel_name');	
		$data['hotel_name']= $hotel_name = '';
		$this->session->userdata('depdate');
		$data['sd']= $cin = $this->session->userdata('depdate');;
		$data['ed']= $cout = $this->session->userdata('retdate');;
		//echo $cin."-".$cout."-".$disp_city."-".$hotel_name; exit;
		//$data['roomcount']= $roomcount = $this->input->post('room_count');
		$data['roomcount']= $roomcount = '1';
		$data['adult']=$adult=$this->session->userdata('adult_flight');
		$data['child']=$child=$this->session->userdata('child_flight');
		//$data['child_age']=$child_age=$this->input->post('child_age');
		$data['child_age']=$child_age= '';
		/* adults and childs for Youtravel */
		if(isset($adult[0]))
		{
			$ADLTS_1 = $adult[0];
		}
		else
		{
			$ADLTS_1 = '0';
		}
		if(isset($adult[1]))
		{
			$ADLTS_2 = $adult[1];
		}
		else
		{
			$ADLTS_2 = '0';
		}
		if(isset($adult[2]))
		{
			$ADLTS_3 = $adult[2];
		}
		else
		{
			$ADLTS_3 = '0';
		}
		
		if(isset($child[0]))
		{
			$CHILD_1 = $child[0];
		}
		else
		{
			$CHILD_1 = '0';
		}
		if(isset($child[1]))
		{
			$CHILD_2 = $child[1];
		}
		else
		{
			$CHILD_2 = '0';
		}
		if(isset($child[2]))
		{
			$CHILD_3 = $child[2];
		}
		else
		{
			$CHILD_3 = '0';
		}
		//print_r($child_age);
		/*$ChildAgeR1C1 = $child_age[0];
		$ChildAgeR1C2 = $child_age[1];
		$ChildAgeR2C1 = $child_age[2];
		$ChildAgeR2C2 = $child_age[3];
		$ChildAgeR3C1 = $child_age[4];
		$ChildAgeR3C2 = $child_age[5];*/
		
		$ChildAgeR1C1 = '3';
		$ChildAgeR1C2 = '0';
		$ChildAgeR2C1 = '0';
		$ChildAgeR2C2 = '0';
		$ChildAgeR3C1 = '0';
		$ChildAgeR3C2 = '0';
		//$ChildAgeR2C1 = $child_age[2];
		 //exit;
		 /* adults and childs for Youtravel */
		//print_r($adult); exit;
		
		
		$data['boardtype']=$boardtype=$this->input->post('All_board');
		$data['boardtype']= $boardtype = 'BT';
		//$data['starrating']=$starrating=$this->input->post('all_star');
		$data['starrating']=$starrating= 'StarCatAll';
		
		$data['costtype'] =$costtype="GBP";
		/*$adultval = $_POST['adult'];
		$childval = $_POST['child'];*/
		$adultval = $this->session->userdata('adult_flight');
		$childval = $this->session->userdata('child_flight');
		$room_used_type=array();
		$adult_count=1;
		$child_count=0;

	    /*for($i=0;$i< $roomcount;$i++)
		{
			
			if($adultval[$i]==1 && $childval[$i]==0)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==1 && $childval[$i]==1)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 1;
    		}
			if($adultval[$i]==1 && $childval[$i]==2)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 2;
    		}
			
			if($adultval[$i]==2 && $childval[$i]==0)
			{
				
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 0;
    		}
            if($adultval[$i]==2 && $childval[$i]==1)
			{
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 1;
    		}
            if($adultval[$i]==2 && $childval[$i]==2)
			{
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==3 && $childval[$i]==0)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==3 && $childval[$i]==1)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 1;
    		}
            if($adultval[$i]==3 && $childval[$i]==2)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==4 && $childval[$i]==0)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==4 && $childval[$i]==1)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 1;
    		}
			if($adultval[$i]==4 && $childval[$i]==2)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==5 )
			{
				
				$room_used_type[] = 9;
				$adult_count = $adult_count + 5; 
				//$child_count = $child_count + 2;
			}
			
			
		}*/
		
		//print_r($room_used_type); exit;
		$this->session->set_userdata(array('All_board'=>$All_board,'roomonly'=>$roomonly,'self_cat'=>$self_cat,'bed_break'=>$bed_break,'half_board'=>$half_board,'full_board'=>$full_board,'all_inclusive'=>$all_inclusive,'villa'=>$villa,'all_star'=>$all_star,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'ADLTS_1'=>$ADLTS_1,'ADLTS_2'=>$ADLTS_2,'ADLTS_3'=>$ADLTS_3,'CHILD_1'=>$CHILD_1,'CHILD_2'=>$CHILD_2,'CHILD_3'=>$CHILD_3,'ChildAgeR1C1'=>$ChildAgeR1C1,'ChildAgeR1C2'=>$ChildAgeR1C2,'ChildAgeR2C1'=>$ChildAgeR2C1,'ChildAgeR2C2'=>$ChildAgeR2C2,'ChildAgeR3C1'=>$ChildAgeR3C1,'ChildAgeR3C2'=>$ChildAgeR3C2,'country_travel'=>$country_travel,'destination'=>$destination,'resort'=>$resort,'roomusedtype'=>$room_used_type, 'hotel_name'=>$hotel_name, 'adult_count'=>$adult_count, 'child_count'=>$child_count, 'roomcount'=>$data['roomcount'],'child_age'=>$child_age, 'sec_res'=>$sec_res,'citycode'=>$data['citycode'],'cin'=>$cin,'cout'=>$cout,'disp_city'=>$disp_city, 'boardtype'=>$boardtype, 'starrating'=>$starrating));
	    $this->load->view('flight_hotel/load_customer_new',$data); 
		
		
	
			//$this->load->view('hotel_search_result');
		}
		function search_hotel_flight_new()
		{
			//echo "<pre>"; print_r($this->session->userdata); exit;
			$city1=$this->session->userdata('citycode');
			if($city1=="")
			{
				$city1=$this->input->post('citycode');
				
			}
			//$expcicode=explode(",",$city1);
			
			//$citi=$expcicode[0];
			//$cntry=$expcicode[1];
				//echo $city1; exit;
			
			$row1=$this->Home_Model->cityCode_gta($city1);
			if($row1 !='')
			{
				$city_gta_code=trim($row1->cityCode);
				$destinationType=trim($row1->destinationType);
				$countrycode=trim($row1->countryCode);
			}
			$roomcount=$this->session->userdata('roomcount');
			$roomusedtypeval=$this->session->userdata('roomusedtype');
			//$roomusedtype=$roomusedtypeval[0];
			$roomusedtype = $roomusedtypeval;
			//$city=$city_gta_code;			
			$sec_res=$this->session->userdata('sec_res');	
			//$cin=$this->session->userdata('sec_res');	
			//$cout=$this->session->userdata('sec_res');	
			$check_in = $this->input->post('sd');
			$check_out = $this->input->post('ed');		
			$costval=$this->input->post('costtype');
			
			$data['flight_id'] = $flight_id = $this->input->post('flight_id');
			$data['air_from'] = $air_from = $this->input->post('air_from');		
			$data['air_to'] = $air_to = $this->input->post('air_to');
			$data['pid'] = $pid = $this->input->post('pid');
			
			$out=explode("/",$this->input->post('ed'));
			$cout=$out[2]."-".$out[1]."-".$out[0];
			$in=explode("/",$this->input->post('sd'));
			$cin=$in[2]."-".$in[1]."-".$in[0];
			$diff = strtotime($cout) - strtotime($cin);
			
			$data['rtype']=$roomusedtype;
			$child=0;
			$adult=0;
			$noofroom1=0;
				/*for($i=0;$i< count($roomcount);$i++)
				{
				
					switch($roomusedtypeval[$i])
					{
						case 1:
							$adult=$adult+(1*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 3:				
							$adult=$adult+(2*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 9:
							$adult=$adult+(4*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 6:
							$adult=$adult+(2*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 5:
							 $adult=$adult+(1*$roomcount[$i]);
							 $noofroom1=$noofroom1+$roomcount[$i];
					   break;
					   
					   case 8:
							 $adult=$adult+(3*$roomcount[$i]);
							 $noofroom1=$noofroom1+$roomcount[$i];
					   break;
					   
					   case 4:												
							 $child=$child+(1*$roomcount[$i]);
							 $adult=$adult+(2*$roomcount[$i]);	
							 $noofroom1=$noofroom1+$roomcount[$i]; 
						break;
						
						case 7:
							$child=$child+(1*$roomcount[$i]);
							$adult=$adult+(2*$roomcount[$i]);								
							$noofroom1=$noofroom1+$roomcount[$i];					
						break;
					}
										
				}*/
							
					/*$data['child']=$child;
					$data['adult']=$adult;
					$data['nor']=$noofroom1;
					$data['room']=$noofroom=$noofroom1;	*/	
					$data['child']='0';
					$data['adult']= '1';
					$data['nor']= $this->session->userdata('nor');
					$data['room']= '1';	
			
			$sec   = $diff % 60;
			$diff  = intval($diff / 60);
			$min   = $diff % 60;
			$diff  = intval($diff / 60);
			$hours = $diff % 24;
			$days  = intval($diff / 24);
			$data['dt']=$days;
			//,'nor'=>$data['nor'],
			$this->session->set_userdata(array('check_in_new'=>$check_in,'dt'=>$days,'adult'=>$data['adult'],'child'=>$data['child'],
			'cin'=>$cin,'cout'=>$cout,'rtype'=>$data['rtype'],'flight_id_new'=>$flight_id,'air_from_new'=>$air_from,'air_to_new'=>$air_to,'pid'=>$pid));
			//echo $adult; exit;
			$this->crs_availability_new($cin,$cout,$days,$sec_res);
			$country_travel = $this->session->userdata('country_travel');
			$destination = $this->session->userdata('destination');
			$resort = $this->session->userdata('resort');
			$this->hotel_search_youtravel_flight($country_travel,$destination,$resort);
	
			//exit;
			redirect('home/search_result_new1/'.$pid.'','refresh');
		
		}
		function flight_extrass()
		{
			$pid = $this->input->post('pid');
			$data['flight_new'] = $this->Home_Model->flight_det_new($pid);
			$data['flight_id'] = $flight_id = $this->input->post('flight_id');
			$data['air_from'] = $this->input->post('air_from');
			$data['air_to'] = $this->input->post('air_to');
			$data['flight_id'] = $flight_id;
			$data['pid'] = $pid;
			$this->load->view('flight_hotel/flight_extrass',$data);
		}
		function baggage_add_flight($pid)
		{
			$data['flight_new'] = $this->Home_Model->flight_det_new($pid);
			$data['pid'] = $pid;
			$this->load->view('flight_hotel/flight_extrass_added',$data);
		}
		function book_elsy_flightbaggage()
		{
			
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$session_id = $this->session->userdata('sessionid');
		$this->Home_Model->delete_getdet_flight($session_id);
		$flight_id = $this->input->post('flight_id');
		//$flight_id = "130418094609-41-2640-976|130418094609-34-2384-879";
		$air_from = $this->input->post('air_from');
		$air_to = $this->input->post('air_to');
		$data['flight_id'] = $flight_id;
		$data['country'] = $this->Home_Model->get_country();
		$xml ='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				  <soap:Body>
					<GetFlightDetails xmlns="ElsyArres.API">
					  <SoapMessage>
						<Password>1009E55E71</Password>
						<Username>EgyptspiritAPI</Username>
						<LanguageCode>EN</LanguageCode>
						<CurrencyCode>GBP</CurrencyCode>
						<Request>
						  <FlightId>'.$flight_id.'</FlightId>
						</Request>
					  </SoapMessage>
					</GetFlightDetails>
				  </soap:Body>
				</soap:Envelope>';
				//echo $xml; exit;
				//$url =  "https://testv80.elsyarres.net/service.asmx";  //test
				$url = "http://www1v80.elsyarres.net/service.asmx";  //live
			$soap = "ElsyArres.API/GetFlightDetails";
			$ch2=curl_init();
			curl_setopt($ch2, CURLOPT_URL, $url);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
	
			$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
	
			// Execute request, store response and HTTP response code
			$data2=curl_exec($ch2);
			$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
			curl_close($ch2);
			
			$array = $this->xml2array($data2); 
			//echo "<pre>"; print_r($data2); exit;
			if(isset($array['soap:Envelope']['attr']))
	        {
				 if($array['soap:Envelope']['soap:Body'])
			 	 {
					$xmlns = $array['soap:Envelope']['soap:Body'];
					if(isset($xmlns['GetFlightDetailsResponse']))
					{
						$SoapMessage = $xmlns['GetFlightDetailsResponse']['SoapMessage'];
						$Response = $SoapMessage['Response'];
						if(isset($Response['CurrencyCode']))
						{
							$currency = $Response['CurrencyCode'];
						}
						else
						{
							$currency = '';
						}
						$FlightDetails = $Response['FlightDetails'];
						if(isset($FlightDetails['MinSinglePaxAge']['value']))
						{
							$MinSinglePaxAge = $FlightDetails['MinSinglePaxAge']['value'];
						}
						else
						{
							$MinSinglePaxAge = '';
						}
						if(isset($FlightDetails['Provider']['value']))
						{
							$Provider = $FlightDetails['Provider']['value'];
						}
						else
						{
							$Provider = '';
						}
						if(isset($FlightDetails['CC3DSecure']['value']))
						{
							$CC3DSecure = $FlightDetails['CC3DSecure']['value'];
						}
						else
						{
							$CC3DSecure = '';
						}
						if(isset($FlightDetails['CCRequiredForCheckIn']['value']))
						{
							$CCRequiredForCheckIn = $FlightDetails['CCRequiredForCheckIn']['value'];
						}
						else
						{
							$CCRequiredForCheckIn = '';
						}
						if(isset($FlightDetails['PassportNoRequired']['value']))
						{
							$PassportNoRequired = $FlightDetails['PassportNoRequired']['value'];
						}
						else
						{
							$PassportNoRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$PassportDetailsRequired = $FlightDetails['PassportDetailsRequired']['value'];
						}
						else
						{
							$PassportDetailsRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$CCExpiryDate = $FlightDetails['CCExpiryDate']['value'];
						}
						else
						{
							$CCExpiryDate = '';
						}
						
						if(isset($FlightDetails['RealRoundtrip']['value']))
						{
							$RealRoundtrip = $FlightDetails['RealRoundtrip']['value'];
						}
						else
						{
							$RealRoundtrip = '';
						}
						if(isset($FlightDetails['TotalFare']['value']))
						{
							$TotalFare = $FlightDetails['TotalFare']['value'];
						}
						else
						{
							$TotalFare = '';
						}
						if(isset($FlightDetails['Outbound']))
						{
							$Outbound = $FlightDetails['Outbound'];
							if(isset($Outbound['CarName']['value']))
							{
								$CarName = $Outbound['CarName']['value'];
							}
							else
							{
								$CarName = 	'';
							}
							if(isset($Outbound['CarCode']['value']))
							{
								$CarCode = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode = 	'';
							}
							if(isset($Outbound['DepName']['value']))
							{
								$DepName = $Outbound['DepName']['value'];
							}
							else
							{
								$DepName = 	'';
							}
							if(isset($Outbound['DepCode']['value']))
							{
								$DepCode = $Outbound['DepCode']['value'];
							}
							else
							{
								$DepCode = 	'';
							}
							if(isset($Outbound['DestName']['value']))
							{
								$DestName = $Outbound['DestName']['value'];
							}
							else
							{
								$DestName = 	'';
							}
							if(isset($Outbound['DestCode']['value']))
							{
								$DestCode = $Outbound['DestCode']['value'];
							}
							else
							{
								$DestCode = 	'';
							}
							if(isset($Outbound['Duration']['value']))
							{
								$Duration = $Outbound['Duration']['value'];
							}
							else
							{
								$Duration = 	'';
							}
							if(isset($Outbound['FlightNo']['value']))
							{
								$FlightNo = $Outbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo = 	'';
							}
							if(isset($Outbound['DepDateTime']['value']))
							{
								$DepDateTime = $Outbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime = 	'';
							}
							if(isset($Outbound['ArrDateTime']['value']))
							{
								$ArrDateTime = $Outbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime = 	'';
							}
							if(isset($Outbound['Legs']))
							{
								$Legs = $Outbound['Legs'];
								if(isset($Legs['Leg']))
								{
									$Leg =  $Legs['Leg'];
									if(isset($Leg['FlightNo']['value']))
									{
										$FlightNo_leg = $Leg['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg = '';
									}
									if(isset($Leg['DepTime']['value']))
									{
										$leg_DepTime = $Leg['DepTime']['value'];
									}
									else
									{
										$leg_DepTime = '';
									}
									if(isset($Leg['ArrTime']['value']))
									{
										$leg_ArrTime = $Leg['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime = '';
									}
								}
							}
							if(isset($Outbound['BillingAmount']['value']))
							{
								$BillingAmount = $Outbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount = 	'';
							}
							$url = "http://www.google.com/ig/calculator?hl=en&q=1".$currency."=?GBP";
							  $options = array(
								CURLOPT_RETURNTRANSFER => true, // return web page
							  CURLOPT_HEADER         => false,// don't return headers
							  CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
							 );
							
							 $ch = curl_init($url);
							   curl_setopt_array( $ch, $options );
							   $amtcon = curl_exec( $ch ); //let's fetch the result using cURL
							 curl_close( $ch );
							 
							 if( $amtcon === FALSE )
							   return $amtcon;
							
							  $amtcon = explode('"',$amtcon);
							  $amtcon = str_replace(chr(160), '', substr( $amtcon[3], 0, strpos($amtcon[3], ' ') ) );
							  ( $amtcon == 0 ) ? FALSE : $amtcon;
							  
							  $TotalFare = $amtcon;
							$this->Home_Model->insert_getflight_det_outbound($session_id,$flight_id,$MinSinglePaxAge,$Provider,$CC3DSecure,$CCRequiredForCheckIn,$PassportNoRequired,$PassportDetailsRequired,$CCExpiryDate,$RealRoundtrip,$TotalFare,$CarName,$CarCode,$DepName,$DepCode,$DestName,$DestCode,$Duration,$FlightNo,$DepDateTime,$ArrDateTime,$FlightNo_leg,$leg_ArrTime,$leg_DepTime,$BillingAmount);
						}
						$type = $this->session->userdata('type');
						if($type == 'ROUNDTRIP')
						{
							if(isset($FlightDetails['Inbound']))
							{
							$Inbound = $FlightDetails['Inbound'];
							if(isset($Inbound['CarName']['value']))
							{
								$CarName_inbound = $Inbound['CarName']['value'];
							}
							else
							{
								$CarName_inbound = 	'';
							}
							if(isset($Inbound['CarCode']['value']))
							{
								$CarCode_inbound = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode_inbound = 	'';
							}
							if(isset($Inbound['DepName']['value']))
							{
								$DepName_inbound = $Inbound['DepName']['value'];
							}
							else
							{
								$DepName_inbound = 	'';
							}
							if(isset($Inbound['DepCode']['value']))
							{
								$DepCode_inbound = $Inbound['DepCode']['value'];
							}
							else
							{
								$DepCode_inbound = 	'';
							}
							if(isset($Inbound['DestName']['value']))
							{
								$DestName_inbound = $Inbound['DestName']['value'];
							}
							else
							{
								$DestName_inbound = 	'';
							}
							if(isset($Inbound['DestCode']['value']))
							{
								$DestCode_inbound = $Inbound['DestCode']['value'];
							}
							else
							{
								$DestCode_inbound = 	'';
							}
							if(isset($Inbound['Duration']['value']))
							{
								$Duration_inbound = $Inbound['Duration']['value'];
							}
							else
							{
								$Duration_inbound = 	'';
							}
							if(isset($Inbound['FlightNo']['value']))
							{
								$FlightNo_inbound = $Inbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo_inbound = 	'';
							}
							if(isset($Inbound['DepDateTime']['value']))
							{
								$DepDateTime_inbound = $Inbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime_inbound = 	'';
							}
							if(isset($Inbound['ArrDateTime']['value']))
							{
								$ArrDateTime_inbound = $Inbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime_inbound = 	'';
							}
							if(isset($Inbound['Legs']))
							{
								$Legs_in = $Inbound['Legs'];
								if(isset($Legs_in['Leg']))
								{
									$Leg_in =  $Legs_in['Leg'];
									if(isset($Leg_in['FlightNo']['value']))
									{
										$FlightNo_leg_in = $Leg_in['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg_in = '';
									}
									if(isset($Leg_in['DepTime']['value']))
									{
										$leg_DepTime_in = $Leg_in['DepTime']['value'];
									}
									else
									{
										$leg_DepTime_in = '';
									}
									if(isset($Leg_in['ArrTime']['value']))
									{
										$leg_ArrTime_in = $Leg_in['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime_in = '';
									}
								}
							}
							if(isset($Inbound['BillingAmount']['value']))
							{
								$BillingAmount_in = $Inbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount_in = 	'';
							}
						$this->Home_Model->insert_getflight_det_inbound($session_id,$flight_id,$MinSinglePaxAge,$RealRoundtrip,$TotalFare,$CarName_inbound,$CarCode_inbound,$DepName_inbound,$DepCode_inbound,$DestName_inbound,$DestCode_inbound,$Duration_inbound,$FlightNo_inbound,$DepDateTime_inbound,$ArrDateTime_inbound,$FlightNo_leg_in,$leg_ArrTime_in,$leg_DepTime_in,$BillingAmount_in);
						}
						}
						//echo "<pre>"; print_r($Leg);
						
						
					}
				 }
			}
			//exit;
		$data['MinSinglePaxAge'] =  $MinSinglePaxAge;
		//echo $air_from; exit;
		$flight = $this->Home_Model->getflight_det_new($flight_id,$air_from,$air_to);
		//echo "<pre>"; print_r($flight); exit;
		if($TotalFare != '')
		{
			$data['total_fare'] = $TotalFare;
		}
		else
		{
			$data['total_fare'] = $flight->TotalFare;
		}
		$data['BagFee'] = $flight->BagFee;
		$data['CcFee'] = $flight->CcFee;
		$data['air_from'] = $air_from;
		$data['air_to'] = $air_to;
		$this->load->view('flight_hotel/book_elsy_flightbaggage',$data);
	
		}
	function book_elsy_flight()
	{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$session_id = $this->session->userdata('sessionid');
		$this->Home_Model->delete_getdet_flight($session_id);
		$flight_id = $this->input->post('flight_id');
		//$flight_id = "130418094609-41-2640-976|130418094609-34-2384-879";
		$air_from = $this->input->post('air_from');
		$air_to = $this->input->post('air_to');
		$data['flight_id'] = $flight_id;
		$data['country'] = $this->Home_Model->get_country();
		$xml ='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				  <soap:Body>
					<GetFlightDetails xmlns="ElsyArres.API">
					  <SoapMessage>
						<Password>1009E55E71</Password>
						<Username>EgyptspiritAPI</Username>
						<LanguageCode>EN</LanguageCode>
						<CurrencyCode>GBP</CurrencyCode>
						<Request>
						  <FlightId>'.$flight_id.'</FlightId>
						</Request>
					  </SoapMessage>
					</GetFlightDetails>
				  </soap:Body>
				</soap:Envelope>';
				//echo $xml; exit;
				//$url =  "https://testv80.elsyarres.net/service.asmx";  //test
				$url = "http://www1v80.elsyarres.net/service.asmx";  //live
			$soap = "ElsyArres.API/GetFlightDetails";
			$ch2=curl_init();
			curl_setopt($ch2, CURLOPT_URL, $url);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
	
			$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
	
			// Execute request, store response and HTTP response code
			$data2=curl_exec($ch2);
			$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
			curl_close($ch2);
			
			$array = $this->xml2array($data2); 
			//echo "<pre>"; print_r($data2); exit;
			if(isset($array['soap:Envelope']['attr']))
	        {
				 if($array['soap:Envelope']['soap:Body'])
			 	 {
					$xmlns = $array['soap:Envelope']['soap:Body'];
					if(isset($xmlns['GetFlightDetailsResponse']))
					{
						$SoapMessage = $xmlns['GetFlightDetailsResponse']['SoapMessage'];
						$Response = $SoapMessage['Response'];
						if(isset($Response['CurrencyCode']))
						{
							$currency = $Response['CurrencyCode'];
						}
						else
						{
							$currency = '';
						}
						$FlightDetails = $Response['FlightDetails'];
						if(isset($FlightDetails['MinSinglePaxAge']['value']))
						{
							$MinSinglePaxAge = $FlightDetails['MinSinglePaxAge']['value'];
						}
						else
						{
							$MinSinglePaxAge = '';
						}
						if(isset($FlightDetails['Provider']['value']))
						{
							$Provider = $FlightDetails['Provider']['value'];
						}
						else
						{
							$Provider = '';
						}
						if(isset($FlightDetails['CC3DSecure']['value']))
						{
							$CC3DSecure = $FlightDetails['CC3DSecure']['value'];
						}
						else
						{
							$CC3DSecure = '';
						}
						if(isset($FlightDetails['CCRequiredForCheckIn']['value']))
						{
							$CCRequiredForCheckIn = $FlightDetails['CCRequiredForCheckIn']['value'];
						}
						else
						{
							$CCRequiredForCheckIn = '';
						}
						if(isset($FlightDetails['PassportNoRequired']['value']))
						{
							$PassportNoRequired = $FlightDetails['PassportNoRequired']['value'];
						}
						else
						{
							$PassportNoRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$PassportDetailsRequired = $FlightDetails['PassportDetailsRequired']['value'];
						}
						else
						{
							$PassportDetailsRequired = '';
						}
						if(isset($FlightDetails['PassportDetailsRequired']['value']))
						{
							$CCExpiryDate = $FlightDetails['CCExpiryDate']['value'];
						}
						else
						{
							$CCExpiryDate = '';
						}
						
						if(isset($FlightDetails['RealRoundtrip']['value']))
						{
							$RealRoundtrip = $FlightDetails['RealRoundtrip']['value'];
						}
						else
						{
							$RealRoundtrip = '';
						}
						if(isset($FlightDetails['TotalFare']['value']))
						{
							$TotalFare = $FlightDetails['TotalFare']['value'];
						}
						else
						{
							$TotalFare = '';
						}
						if(isset($FlightDetails['Outbound']))
						{
							$Outbound = $FlightDetails['Outbound'];
							if(isset($Outbound['CarName']['value']))
							{
								$CarName = $Outbound['CarName']['value'];
							}
							else
							{
								$CarName = 	'';
							}
							if(isset($Outbound['CarCode']['value']))
							{
								$CarCode = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode = 	'';
							}
							if(isset($Outbound['DepName']['value']))
							{
								$DepName = $Outbound['DepName']['value'];
							}
							else
							{
								$DepName = 	'';
							}
							if(isset($Outbound['DepCode']['value']))
							{
								$DepCode = $Outbound['DepCode']['value'];
							}
							else
							{
								$DepCode = 	'';
							}
							if(isset($Outbound['DestName']['value']))
							{
								$DestName = $Outbound['DestName']['value'];
							}
							else
							{
								$DestName = 	'';
							}
							if(isset($Outbound['DestCode']['value']))
							{
								$DestCode = $Outbound['DestCode']['value'];
							}
							else
							{
								$DestCode = 	'';
							}
							if(isset($Outbound['Duration']['value']))
							{
								$Duration = $Outbound['Duration']['value'];
							}
							else
							{
								$Duration = 	'';
							}
							if(isset($Outbound['FlightNo']['value']))
							{
								$FlightNo = $Outbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo = 	'';
							}
							if(isset($Outbound['DepDateTime']['value']))
							{
								$DepDateTime = $Outbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime = 	'';
							}
							if(isset($Outbound['ArrDateTime']['value']))
							{
								$ArrDateTime = $Outbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime = 	'';
							}
							if(isset($Outbound['Legs']))
							{
								$Legs = $Outbound['Legs'];
								if(isset($Legs['Leg']))
								{
									$Leg =  $Legs['Leg'];
									if(isset($Leg['FlightNo']['value']))
									{
										$FlightNo_leg = $Leg['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg = '';
									}
									if(isset($Leg['DepTime']['value']))
									{
										$leg_DepTime = $Leg['DepTime']['value'];
									}
									else
									{
										$leg_DepTime = '';
									}
									if(isset($Leg['ArrTime']['value']))
									{
										$leg_ArrTime = $Leg['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime = '';
									}
								}
							}
							if(isset($Outbound['BillingAmount']['value']))
							{
								$BillingAmount = $Outbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount = 	'';
							}
							$url = "http://www.google.com/ig/calculator?hl=en&q=1".$currency."=?GBP";
							  $options = array(
								CURLOPT_RETURNTRANSFER => true, // return web page
							  CURLOPT_HEADER         => false,// don't return headers
							  CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
							 );
							
							 $ch = curl_init($url);
							   curl_setopt_array( $ch, $options );
							   $amtcon = curl_exec( $ch ); //let's fetch the result using cURL
							 curl_close( $ch );
							 
							 if( $amtcon === FALSE )
							   return $amtcon;
							
							  $amtcon = explode('"',$amtcon);
							  $amtcon = str_replace(chr(160), '', substr( $amtcon[3], 0, strpos($amtcon[3], ' ') ) );
							  ( $amtcon == 0 ) ? FALSE : $amtcon;
							  
							  $TotalFare = $amtcon;
							$this->Home_Model->insert_getflight_det_outbound($session_id,$flight_id,$MinSinglePaxAge,$Provider,$CC3DSecure,$CCRequiredForCheckIn,$PassportNoRequired,$PassportDetailsRequired,$CCExpiryDate,$RealRoundtrip,$TotalFare,$CarName,$CarCode,$DepName,$DepCode,$DestName,$DestCode,$Duration,$FlightNo,$DepDateTime,$ArrDateTime,$FlightNo_leg,$leg_ArrTime,$leg_DepTime,$BillingAmount);
						}
						$type = $this->session->userdata('type');
						if($type == 'ROUNDTRIP')
						{
							if(isset($FlightDetails['Inbound']))
							{
							$Inbound = $FlightDetails['Inbound'];
							if(isset($Inbound['CarName']['value']))
							{
								$CarName_inbound = $Inbound['CarName']['value'];
							}
							else
							{
								$CarName_inbound = 	'';
							}
							if(isset($Inbound['CarCode']['value']))
							{
								$CarCode_inbound = $Outbound['CarCode']['value'];
							}
							else
							{
								$CarCode_inbound = 	'';
							}
							if(isset($Inbound['DepName']['value']))
							{
								$DepName_inbound = $Inbound['DepName']['value'];
							}
							else
							{
								$DepName_inbound = 	'';
							}
							if(isset($Inbound['DepCode']['value']))
							{
								$DepCode_inbound = $Inbound['DepCode']['value'];
							}
							else
							{
								$DepCode_inbound = 	'';
							}
							if(isset($Inbound['DestName']['value']))
							{
								$DestName_inbound = $Inbound['DestName']['value'];
							}
							else
							{
								$DestName_inbound = 	'';
							}
							if(isset($Inbound['DestCode']['value']))
							{
								$DestCode_inbound = $Inbound['DestCode']['value'];
							}
							else
							{
								$DestCode_inbound = 	'';
							}
							if(isset($Inbound['Duration']['value']))
							{
								$Duration_inbound = $Inbound['Duration']['value'];
							}
							else
							{
								$Duration_inbound = 	'';
							}
							if(isset($Inbound['FlightNo']['value']))
							{
								$FlightNo_inbound = $Inbound['FlightNo']['value'];
							}
							else
							{
								$FlightNo_inbound = 	'';
							}
							if(isset($Inbound['DepDateTime']['value']))
							{
								$DepDateTime_inbound = $Inbound['DepDateTime']['value'];
							}
							else
							{
								$DepDateTime_inbound = 	'';
							}
							if(isset($Inbound['ArrDateTime']['value']))
							{
								$ArrDateTime_inbound = $Inbound['ArrDateTime']['value'];
							}
							else
							{
								$ArrDateTime_inbound = 	'';
							}
							if(isset($Inbound['Legs']))
							{
								$Legs_in = $Inbound['Legs'];
								if(isset($Legs_in['Leg']))
								{
									$Leg_in =  $Legs_in['Leg'];
									if(isset($Leg_in['FlightNo']['value']))
									{
										$FlightNo_leg_in = $Leg_in['FlightNo']['value'];
									}
									else
									{
										$FlightNo_leg_in = '';
									}
									if(isset($Leg_in['DepTime']['value']))
									{
										$leg_DepTime_in = $Leg_in['DepTime']['value'];
									}
									else
									{
										$leg_DepTime_in = '';
									}
									if(isset($Leg_in['ArrTime']['value']))
									{
										$leg_ArrTime_in = $Leg_in['ArrTime']['value'];
									}
									else
									{
										$leg_ArrTime_in = '';
									}
								}
							}
							if(isset($Inbound['BillingAmount']['value']))
							{
								$BillingAmount_in = $Inbound['BillingAmount']['value'];
							}
							else
							{
								$BillingAmount_in = 	'';
							}
						$this->Home_Model->insert_getflight_det_inbound($session_id,$flight_id,$MinSinglePaxAge,$RealRoundtrip,$TotalFare,$CarName_inbound,$CarCode_inbound,$DepName_inbound,$DepCode_inbound,$DestName_inbound,$DestCode_inbound,$Duration_inbound,$FlightNo_inbound,$DepDateTime_inbound,$ArrDateTime_inbound,$FlightNo_leg_in,$leg_ArrTime_in,$leg_DepTime_in,$BillingAmount_in);
						}
						}
						//echo "<pre>"; print_r($Leg);
						
						
					}
				 }
			}
			//exit;
		$data['MinSinglePaxAge'] =  $MinSinglePaxAge;
		//echo $air_from; exit;
		$flight = $this->Home_Model->getflight_det_new($flight_id,$air_from,$air_to);
		//echo "<pre>"; print_r($flight); exit;
		if($TotalFare != '')
		{
			$data['total_fare'] = $TotalFare;
		}
		else
		{
			$data['total_fare'] = $flight->TotalFare;
		}
		$data['BagFee'] = $flight->BagFee;
		$data['CcFee'] = $flight->CcFee;
		$data['air_from'] = $air_from;
		$data['air_to'] = $air_to;
		$this->load->view('book_elsy_flight',$data);
	}
	function book_elsy_flight_continue_baggage()
	{
		
		//exit;
		//$passenger_title = $this->input->post('passenger_title');
		$gender_adult = $this->input->post('gender_adult');
		$passenger_fname = $this->input->post('passenger_fname');
		$passenger_lname = $this->input->post('passenger_lname');
		$passenger_dob =  $this->input->post('passenger_dob');
		$child_dob = $this->input->post('child_dob');
		$child_fname = $this->input->post('child_fname');
		$child_lname = $this->input->post('child_lname');
		$gender_child = $this->input->post('gender_child');
		
		$infant_fname = $this->input->post('infant_fname');
		$infant_lname = $this->input->post('infant_lname');
		$gender_infant = $this->input->post('gender_infant');
		$infant_dob = $this->input->post('infant_dob');
		$child_count = $this->session->userdata('child_count');
		$infant_count = $this->session->userdata('infant_count');
		
		$passport_number  = $this->input->post('passport_number');
		if($passport_number != '')
		{
			for($p =0; $p< count($passport_number); $p++)
			{
				$passport ='<PassportNumber>'.$passport_number[$p].'</PassportNumber>';
			}
		}
		else
		{
			$passport = '<PassportNumber></PassportNumber>';
		}
		$passport_det = '';
		$issue_city  = $this->input->post('issue_city');
		$issue_country  = $this->input->post('issue_country');
		$issue_date  = $this->input->post('issue_date');
		$expiry_date  = $this->input->post('expiry_date');
		
		$passport_number_ch  = $this->input->post('passport_number_ch');
		if($passport_number_ch != '')
		{
			for($p =0; $p< count($passport_number_ch); $p++)
			{
				$passport_ch ='<PassportNumber>'.$passport_number_ch[$p].'</PassportNumber>';
			}
		}
		else
		{
			$passport_ch = '<PassportNumber></PassportNumber>';
		}
		$issue_city_ch  = $this->input->post('issue_city_ch');
		$issue_country_ch  = $this->input->post('issue_country_ch');
		$issue_date_ch  = $this->input->post('issue_date_ch');
		$expiry_date_ch  = $this->input->post('expiry_date_ch');
		
		$passport_number_in  = $this->input->post('passport_number_in');
		if($passport_number_in != '')
		{
			for($p =0; $p< count($passport_number_in); $p++)
			{
				$passport_in ='<PassportNumber>'.$passport_number_in[$p].'</PassportNumber>';
			}
		}
		else
		{
			$passport_in = '<PassportNumber></PassportNumber>';
		}
		$issue_city_in  = $this->input->post('issue_city_in');
		$issue_country_in  = $this->input->post('issue_country_in');
		$issue_date_in  = $this->input->post('issue_date_in');
		$expiry_date_in  = $this->input->post('expiry_date_in');
		
		/*for($bb =0; $bb<= count($passenger_dob); $bb++)
		{   
			$dob = explode('/',$passenger_dob[$bb]);
		}
		echo "<pre>"; print_r($dob); exit;*/
		// <Birthday>'.$dob[2]."-".$dob['1']."-".$dob['0'].'</Birthday>
		//echo count($infant_fname); exit;
		$passenger_lname = $this->input->post('passenger_lname');
		$passenger = '';
		for($i =0; $i<count($passenger_fname); $i++)
		{
			
			if($issue_city != '' && $issue_country != '' && $expiry_date != '' && $issue_date != '')
			{	
				$passport_det = '<PassportDetails>
								   		<PassType>Passport</PassType>
										<IssueDate>'.$issue_date[$i].'</IssueDate>
										<ExpiryDate>'.$expiry_date[$i].'</ExpiryDate>
										<CountryCode>'.strtoupper($issue_country[$i]).'</CountryCode>
										<IssueCity>'.$issue_city[$i].'</IssueCity>
								  </PassportDetails>';
					
			}
			else
			{
				$passport_det = '';
			}
			$passenger.='<Passenger>
								  <Birthday>'.$passenger_dob[$i].'</Birthday>
								  <FirstName>'.$passenger_fname[$i].'</FirstName>
								  <LastName>'.$passenger_lname[$i].'</LastName>
								   '.$passport.''.$passport_det.'
								   <Sex>'.$gender_adult[$i].'</Sex>
								  <Type>ADULT</Type>
								</Passenger>';
		}
		if($child_count != '0')
		{
			for($i =0; $i<count($child_fname); $i++)
			{
				if($issue_date_ch != '' && $expiry_date_ch != '' && $issue_country_ch != '' && $issue_city_ch != '')
				{	
					$passport_det_ch = '<PassportDetails>
								   		<PassType>Passport</PassType>
										<IssueDate>'.$issue_date_ch[$i].'</IssueDate>
										<ExpiryDate>'.$expiry_date_ch[$i].'</ExpiryDate>
										<CountryCode>'.strtoupper($issue_country_ch[$i]).'</CountryCode>
										<IssueCity>'.$issue_city_ch[$i].'</IssueCity>
								  </PassportDetails>';
						
				}
				else
				{
					$passport_det_ch = '';
				}
				$passenger.='<Passenger>
									  <Birthday>'.$child_dob[$i].'</Birthday>
									  <FirstName>'.$child_fname[$i].'</FirstName>
									  <LastName>'.$child_lname[$i].'</LastName>
										'.$passport_ch.''.$passport_det_ch.'
									  <Sex>'.$gender_child[$i].'</Sex>
									  <Type>CHILD</Type>
									</Passenger>';
			}
		}
		if($infant_count != '0')
		{
			for($i =0; $i<count($infant_fname); $i++)
			{
				if($issue_date_in != '' && $expiry_date_in != '' && $issue_country_in != '' && $issue_city_in != '')
				{	
					$passport_det_in = '<PassportDetails>
								   		<PassType>Passport</PassType>
										<IssueDate>'.$issue_date_in[$i].'</IssueDate>
										<ExpiryDate>'.$expiry_date_in[$i].'</ExpiryDate>
										<CountryCode>'.strtoupper($issue_country_in[$i]).'</CountryCode>
										<IssueCity>'.$issue_city_in[$i].'</IssueCity>
								  </PassportDetails>';
						
				}
				else
				{
					$passport_det_in = '';
				}
				$passenger.='<Passenger>
									  <Birthday>'.$infant_dob[$i].'</Birthday>
									  <FirstName>'.$infant_fname[$i].'</FirstName>
									  <LastName>'.$infant_lname[$i].'</LastName>
									  '.$passport_in.''.$passport_det_in.'
									  <Sex>'.$gender_infant[$i].'</Sex>
									  <Type>INFANT</Type>
									</Passenger>';
			}
		}
	//	echo "<pre>"; print_r($passenger); exit;
		//$passenger_dob =  $this->input->post('passenger_dob');
		//$dob = explode('/',$passenger_dob);
		$FirstName = $this->input->post('lead_fname');
		$flight_id = $this->input->post('flight_id'); 
		$LastName = $this->input->post('lead_lname');
		$HouseNo = $this->input->post('HouseNo');
		$lead_postcode = $this->input->post('lead_postcode');
		$lead_city = $this->input->post('lead_city');
		$lead_email = $this->input->post('lead_email');
		
		$air_from = $this->input->post('air_from'); 
		$air_to = $this->input->post('air_to'); 
		
		$flight = $this->Home_Model->getflight_det_new($flight_id,$air_from,$air_to);
		//$total_fare = $flight->TotalFare;
		$BagFee= $flight->BagFee;
		//$CcFee = $flight->CcFee;
		$total_fare = $this->input->post('total_fare');
		$CcFee = $this->input->post('CcFee');
		$total = $total_fare + $CcFee + $BagFee;
		//+ $BagFee
		
		$xml = '<?xml version="1.0" encoding="utf-8"?>
					<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
					  <soap:Body>
						<PrepareBookFlights xmlns="ElsyArres.API">
						  <SoapMessage>
							<Password>1009E55E71</Password>
							<Username>EgyptspiritAPI</Username>
							<LanguageCode>EN</LanguageCode>
							<Request>
							  <ClientIP>123.201.254.254</ClientIP>
							  <ConfirmedCurrency>GBP</ConfirmedCurrency>
							  <ConfirmedPrice>'.$total.'</ConfirmedPrice>
							  <ConfirmPossibleDuplicate>false</ConfirmPossibleDuplicate>
							  <CustomerInfo>
								<City>Test City</City>
								<CompanyName>Test Company Ltd.</CompanyName>
								<CountryCode>IN</CountryCode>
								<Email>balup.provab@gmail.com</Email>
								<FirstName>'.$FirstName.'</FirstName>
								<HouseNo>'.$HouseNo.'</HouseNo>
								<LastName>'.$LastName.'</LastName>
								<PhoneArea>234</PhoneArea>
								<PhoneCountry>1</PhoneCountry>
								<PhoneNumber>567890</PhoneNumber>
								<Sex>MALE</Sex>
								<Street>Test Street</Street>
								<Zip>12345</Zip>
							  </CustomerInfo>
							  <FlightId>'.$flight_id.'</FlightId>
							  <PassengerInfo>'.$passenger.'
							    </PassengerInfo>
							  <PaymentInfo>
								<BillingAddress>
								  <City>'.$lead_city.'</City>
								  <CountryCode>DE</CountryCode>
								  <HouseNo>'.$HouseNo.'</HouseNo>
								  <Street>bangalore</Street>
								  <Zip>'.$lead_postcode.'</Zip>
								</BillingAddress>
								<CVC>123</CVC>
								<Expiry>03/21</Expiry>
								<Holder>test</Holder>
								<Number>4111111111111111</Number>
								<PaymentCode>VISA</PaymentCode>
							  </PaymentInfo>
							</Request>
						  </SoapMessage>
						</PrepareBookFlights>
					  </soap:Body>
					</soap:Envelope>';
		
					//echo $xml; exit; 
			//$url =  "http://testv80.elsyarres.net/service.asmx";
			$url =  "http://www1v80.elsyarres.net/service.asmx";
				$soap = "ElsyArres.API/PrepareBookFlights";
				//$soap = "ElsyArres.API/BookFlights";
				$ch2=curl_init();
				curl_setopt($ch2, CURLOPT_URL, $url);
				curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
				curl_setopt($ch2, CURLOPT_HEADER, 0);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_POST, 1);
				curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
		
				$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
				curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
				curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
		
				// Execute request, store response and HTTP response code
				$data2=curl_exec($ch2);
				$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
				curl_close($ch2);
				//echo $data2; exit;
				$array = $this->xml2array($data2);
				//echo "<pre>"; print_r($data2); exit;
				$array1 = $array;
				if(isset($array['soap:Envelope']['attr']))
				{
					 if($array['soap:Envelope']['soap:Body'])
					 {
						$xmlns = $array['soap:Envelope']['soap:Body'];
						if(isset($xmlns['PrepareBookFlightsResponse']))
						{
							$PrepareBookFlightsResponse = $xmlns['PrepareBookFlightsResponse'];
							$SoapMessage = $PrepareBookFlightsResponse['SoapMessage'];
							//echo "<pre>"; print_r($SoapMessage);  
							//echo $SoapMessage['ErrorCode']['value'];  exit;
							/*if($SoapMessage['ErrorCode']['value'] != '0' || $SoapMessage['ErrorCode']['value'] != '')
							{
								//echo "hixcvcxvfcxvii"; exit;
								if($SoapMessage['ErrorMessage'] != '')
								{
									if($SoapMessage['ErrorCode']['value'] == '5025')
									{
										$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
										$new_price1 = explode('[',$ErrorMessage);
										//echo "<pre>"; print_r($new_price1); exit;
										$newprice = $new_price1[3];
										$total1 = explode(']',$newprice);
										$total = $total1[0];
										redirect('home/new_flight_book/'.$total.'/'.$flight_id,'refresh');
									}
									else if($SoapMessage['ErrorCode']['value'] =='5026')
									{
										$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
										
										redirect('home/new_flight_book/'.$total.'/'.$flight_id,'refresh');
									}
									else
									{
										$data['ErrorMessage'] = $SoapMessage['ErrorMessage']['value'];
										$this->load->view('flight_error',$data);
									}
								}
								else
								{
									//echo "hii";
								}
								
							}
							else
							{*/
								//echo "hi"; exit;
								$PrepareBookFlightsResponse = $xmlns['PrepareBookFlightsResponse'];
							
								$SoapMessage = $PrepareBookFlightsResponse['SoapMessage'];
								//echo "<pre>"; print_r($SoapMessage);  
								/*if($SoapMessage['ErrorCode']['value'] != '0')
								{
									$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
								}
								else
								{*/
									$response = $SoapMessage['Response']; 
									
									$FlightDetails = $response['FlightDetails'];
									//echo "<pre>"; print_r($FlightDetails);	
									$TotalFare = $FlightDetails['TotalFare']['value'];
									if(isset($SoapMessage['ErrorMessage']['value']))
									{
										if($SoapMessage['ErrorMessage']['value'] !='')
										{
											$data['ErrorMessage'] = $SoapMessage['ErrorMessage']['value'];
											$this->load->view('flight_error',$data);
										}
										else
										{
											//echo "hoihjohjio"; 
										}
									}
									else
									{
									$xml_book = '<?xml version="1.0" encoding="utf-8"?>
										<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
										  <soap:Body>
											<BookFlights xmlns="ElsyArres.API">
											  <SoapMessage>
										<Password>1009E55E71</Password>
													<Username>EgyptspiritAPI</Username>
													<LanguageCode>EN</LanguageCode>
												<Request>
												  <FlightId>'.$flight_id.'</FlightId>
												  <ConfirmNewPrice>true</ConfirmNewPrice>
												  <ClientIP></ClientIP>
												  <CustomContainer></CustomContainer>
												</Request>
												<Response />
											  </SoapMessage>
											</BookFlights>
										  </soap:Body>
										</soap:Envelope>';
									//echo $xml_book; exit;
									//$url =  "http://testv80.elsyarres.net/service.asmx";
									$url =  "http://www1v80.elsyarres.net/service.asmx";
									$soap = "ElsyArres.API/BookFlights";
									//$soap = "ElsyArres.API/BookFlights";
									$ch2=curl_init();
									curl_setopt($ch2, CURLOPT_URL, $url);
									curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
									curl_setopt($ch2, CURLOPT_HEADER, 0);
									curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch2, CURLOPT_POST, 1);
									curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml_book);
									curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
									curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
									//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
									curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
									curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
							
									$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
									curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
									curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
							
									// Execute request, store response and HTTP response code
									$data_book=curl_exec($ch2);
									$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
									curl_close($ch2);
									//echo $data_book; exit;
									$array_book = $this->xml2array($data_book);
									//echo "<pre>";  print_r($array_book); exit;
									redirect('home/flight_thankyou/'.$total.'/'.$flight_id,'refresh');
									}
								//}
							
							//}
							
						}
					 }
				}
				
				
	
	}
	function book_elsy_flight_continue()
	
	{
		//exit;
		//$passenger_title = $this->input->post('passenger_title');
		$gender_adult = $this->input->post('gender_adult');
		$passenger_fname = $this->input->post('passenger_fname');
		$passenger_lname = $this->input->post('passenger_lname');
		$passenger_dob =  $this->input->post('passenger_dob');
		$child_dob = $this->input->post('child_dob');
		$child_fname = $this->input->post('child_fname');
		$child_lname = $this->input->post('child_lname');
		$gender_child = $this->input->post('gender_child');
		
		$infant_fname = $this->input->post('infant_fname');
		$infant_lname = $this->input->post('infant_lname');
		$gender_infant = $this->input->post('gender_infant');
		$infant_dob = $this->input->post('infant_dob');
		$child_count = $this->session->userdata('child_count');
		$infant_count = $this->session->userdata('infant_count');
		
		$passport_number  = $this->input->post('passport_number');
		if($passport_number != '')
		{
			for($p =0; $p< count($passport_number); $p++)
			{
				$passport ='<PassportNumber>'.$passport_number[$p].'</PassportNumber>';
			}
		}
		else
		{
			$passport = '<PassportNumber></PassportNumber>';
		}
		$passport_det = '';
		$issue_city  = $this->input->post('issue_city');
		$issue_country  = $this->input->post('issue_country');
		$issue_date  = $this->input->post('issue_date');
		$expiry_date  = $this->input->post('expiry_date');
		
		$passport_number_ch  = $this->input->post('passport_number_ch');
		if($passport_number_ch != '')
		{
			for($p =0; $p< count($passport_number_ch); $p++)
			{
				$passport_ch ='<PassportNumber>'.$passport_number_ch[$p].'</PassportNumber>';
			}
		}
		else
		{
			$passport_ch = '<PassportNumber></PassportNumber>';
		}
		$issue_city_ch  = $this->input->post('issue_city_ch');
		$issue_country_ch  = $this->input->post('issue_country_ch');
		$issue_date_ch  = $this->input->post('issue_date_ch');
		$expiry_date_ch  = $this->input->post('expiry_date_ch');
		
		$passport_number_in  = $this->input->post('passport_number_in');
		if($passport_number_in != '')
		{
			for($p =0; $p< count($passport_number_in); $p++)
			{
				$passport_in ='<PassportNumber>'.$passport_number_in[$p].'</PassportNumber>';
			}
		}
		else
		{
			$passport_in = '<PassportNumber></PassportNumber>';
		}
		$issue_city_in  = $this->input->post('issue_city_in');
		$issue_country_in  = $this->input->post('issue_country_in');
		$issue_date_in  = $this->input->post('issue_date_in');
		$expiry_date_in  = $this->input->post('expiry_date_in');
		
		/*for($bb =0; $bb<= count($passenger_dob); $bb++)
		{   
			$dob = explode('/',$passenger_dob[$bb]);
		}
		echo "<pre>"; print_r($dob); exit;*/
		// <Birthday>'.$dob[2]."-".$dob['1']."-".$dob['0'].'</Birthday>
		//echo count($infant_fname); exit;
		$passenger_lname = $this->input->post('passenger_lname');
		$passenger = '';
		for($i =0; $i<count($passenger_fname); $i++)
		{
			
			if($issue_city != '' && $issue_country != '' && $expiry_date != '' && $issue_date != '')
			{	
				$passport_det = '<PassportDetails>
								   		<PassType>Passport</PassType>
										<IssueDate>'.$issue_date[$i].'</IssueDate>
										<ExpiryDate>'.$expiry_date[$i].'</ExpiryDate>
										<CountryCode>'.strtoupper($issue_country[$i]).'</CountryCode>
										<IssueCity>'.$issue_city[$i].'</IssueCity>
								  </PassportDetails>';
					
			}
			else
			{
				$passport_det = '';
			}
			$passenger.='<Passenger>
								  <Birthday>'.$passenger_dob[$i].'</Birthday>
								  <FirstName>'.$passenger_fname[$i].'</FirstName>
								  <LastName>'.$passenger_lname[$i].'</LastName>
								   '.$passport.''.$passport_det.'
								   <Sex>'.$gender_adult[$i].'</Sex>
								  <Type>ADULT</Type>
								</Passenger>';
		}
		if($child_count != '0')
		{
			for($i =0; $i<count($child_fname); $i++)
			{
				if($issue_date_ch != '' && $expiry_date_ch != '' && $issue_country_ch != '' && $issue_city_ch != '')
				{	
					$passport_det_ch = '<PassportDetails>
								   		<PassType>Passport</PassType>
										<IssueDate>'.$issue_date_ch[$i].'</IssueDate>
										<ExpiryDate>'.$expiry_date_ch[$i].'</ExpiryDate>
										<CountryCode>'.strtoupper($issue_country_ch[$i]).'</CountryCode>
										<IssueCity>'.$issue_city_ch[$i].'</IssueCity>
								  </PassportDetails>';
						
				}
				else
				{
					$passport_det_ch = '';
				}
				$passenger.='<Passenger>
									  <Birthday>'.$child_dob[$i].'</Birthday>
									  <FirstName>'.$child_fname[$i].'</FirstName>
									  <LastName>'.$child_lname[$i].'</LastName>
										'.$passport_ch.''.$passport_det_ch.'
									  <Sex>'.$gender_child[$i].'</Sex>
									  <Type>CHILD</Type>
									</Passenger>';
			}
		}
		if($infant_count != '0')
		{
			for($i =0; $i<count($infant_fname); $i++)
			{
				if($issue_date_in != '' && $expiry_date_in != '' && $issue_country_in != '' && $issue_city_in != '')
				{	
					$passport_det_in = '<PassportDetails>
								   		<PassType>Passport</PassType>
										<IssueDate>'.$issue_date_in[$i].'</IssueDate>
										<ExpiryDate>'.$expiry_date_in[$i].'</ExpiryDate>
										<CountryCode>'.strtoupper($issue_country_in[$i]).'</CountryCode>
										<IssueCity>'.$issue_city_in[$i].'</IssueCity>
								  </PassportDetails>';
						
				}
				else
				{
					$passport_det_in = '';
				}
				$passenger.='<Passenger>
									  <Birthday>'.$infant_dob[$i].'</Birthday>
									  <FirstName>'.$infant_fname[$i].'</FirstName>
									  <LastName>'.$infant_lname[$i].'</LastName>
									  '.$passport_in.''.$passport_det_in.'
									  <Sex>'.$gender_infant[$i].'</Sex>
									  <Type>INFANT</Type>
									</Passenger>';
			}
		}
	//	echo "<pre>"; print_r($passenger); exit;
		//$passenger_dob =  $this->input->post('passenger_dob');
		//$dob = explode('/',$passenger_dob);
		$FirstName = $this->input->post('lead_fname');
		$flight_id = $this->input->post('flight_id'); 
		$LastName = $this->input->post('lead_lname');
		$HouseNo = $this->input->post('HouseNo');
		$lead_postcode = $this->input->post('lead_postcode');
		$lead_city = $this->input->post('lead_city');
		$lead_email = $this->input->post('lead_email');
		
		$air_from = $this->input->post('air_from'); 
		$air_to = $this->input->post('air_to'); 
		
		$flight = $this->Home_Model->getflight_det_new($flight_id,$air_from,$air_to);
		//$total_fare = $flight->TotalFare;
		$BagFee= $flight->BagFee;
		//$CcFee = $flight->CcFee;
		$total_fare = $this->input->post('total_fare');
		$CcFee = $this->input->post('CcFee');
		$total = $total_fare + $CcFee;
		//+ $BagFee
		
		$xml = '<?xml version="1.0" encoding="utf-8"?>
					<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
					  <soap:Body>
						<PrepareBookFlights xmlns="ElsyArres.API">
						  <SoapMessage>
							<Password>1009E55E71</Password>
							<Username>EgyptspiritAPI</Username>
							<LanguageCode>EN</LanguageCode>
							<Request>
							  <ClientIP>123.201.254.254</ClientIP>
							  <ConfirmedCurrency>GBP</ConfirmedCurrency>
							  <ConfirmedPrice>'.$total.'</ConfirmedPrice>
							  <ConfirmPossibleDuplicate>false</ConfirmPossibleDuplicate>
							  <CustomerInfo>
								<City>Test City</City>
								<CompanyName>Test Company Ltd.</CompanyName>
								<CountryCode>IN</CountryCode>
								<Email>balup.provab@gmail.com</Email>
								<FirstName>'.$FirstName.'</FirstName>
								<HouseNo>'.$HouseNo.'</HouseNo>
								<LastName>'.$LastName.'</LastName>
								<PhoneArea>234</PhoneArea>
								<PhoneCountry>1</PhoneCountry>
								<PhoneNumber>567890</PhoneNumber>
								<Sex>MALE</Sex>
								<Street>Test Street</Street>
								<Zip>12345</Zip>
							  </CustomerInfo>
							  <FlightId>'.$flight_id.'</FlightId>
							  <PassengerInfo>'.$passenger.'
							    </PassengerInfo>
							  <PaymentInfo>
								<BillingAddress>
								  <City>'.$lead_city.'</City>
								  <CountryCode>DE</CountryCode>
								  <HouseNo>'.$HouseNo.'</HouseNo>
								  <Street>bangalore</Street>
								  <Zip>'.$lead_postcode.'</Zip>
								</BillingAddress>
								<CVC>123</CVC>
								<Expiry>03/21</Expiry>
								<Holder>test</Holder>
								<Number>4111111111111111</Number>
								<PaymentCode>VISA</PaymentCode>
							  </PaymentInfo>
							</Request>
						  </SoapMessage>
						</PrepareBookFlights>
					  </soap:Body>
					</soap:Envelope>';
		
					//echo $xml; exit; 
			//$url =  "http://testv80.elsyarres.net/service.asmx";
			$url =  "http://www1v80.elsyarres.net/service.asmx";
				$soap = "ElsyArres.API/PrepareBookFlights";
				//$soap = "ElsyArres.API/BookFlights";
				$ch2=curl_init();
				curl_setopt($ch2, CURLOPT_URL, $url);
				curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
				curl_setopt($ch2, CURLOPT_HEADER, 0);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_POST, 1);
				curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
		
				$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
				curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
				curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
		
				// Execute request, store response and HTTP response code
				$data2=curl_exec($ch2);
				$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
				curl_close($ch2);
				//echo $data2; exit;
				$array = $this->xml2array($data2);
				//echo "<pre>"; print_r($data2); exit;
				$array1 = $array;
				if(isset($array['soap:Envelope']['attr']))
				{
					 if($array['soap:Envelope']['soap:Body'])
					 {
						$xmlns = $array['soap:Envelope']['soap:Body'];
						if(isset($xmlns['PrepareBookFlightsResponse']))
						{
							$PrepareBookFlightsResponse = $xmlns['PrepareBookFlightsResponse'];
							$SoapMessage = $PrepareBookFlightsResponse['SoapMessage'];
							//echo "<pre>"; print_r($SoapMessage);  
							//echo $SoapMessage['ErrorCode']['value'];  exit;
							/*if($SoapMessage['ErrorCode']['value'] != '0' || $SoapMessage['ErrorCode']['value'] != '')
							{
								//echo "hixcvcxvfcxvii"; exit;
								if($SoapMessage['ErrorMessage'] != '')
								{
									if($SoapMessage['ErrorCode']['value'] == '5025')
									{
										$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
										$new_price1 = explode('[',$ErrorMessage);
										//echo "<pre>"; print_r($new_price1); exit;
										$newprice = $new_price1[3];
										$total1 = explode(']',$newprice);
										$total = $total1[0];
										redirect('home/new_flight_book/'.$total.'/'.$flight_id,'refresh');
									}
									else if($SoapMessage['ErrorCode']['value'] =='5026')
									{
										$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
										
										redirect('home/new_flight_book/'.$total.'/'.$flight_id,'refresh');
									}
									else
									{
										$data['ErrorMessage'] = $SoapMessage['ErrorMessage']['value'];
										$this->load->view('flight_error',$data);
									}
								}
								else
								{
									//echo "hii";
								}
								
							}
							else
							{*/
								//echo "hi"; exit;
								$PrepareBookFlightsResponse = $xmlns['PrepareBookFlightsResponse'];
							
								$SoapMessage = $PrepareBookFlightsResponse['SoapMessage'];
								//echo "<pre>"; print_r($SoapMessage);  
								/*if($SoapMessage['ErrorCode']['value'] != '0')
								{
									$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
								}
								else
								{*/
									$response = $SoapMessage['Response']; 
									
									$FlightDetails = $response['FlightDetails'];
									//echo "<pre>"; print_r($FlightDetails);	
									$TotalFare = $FlightDetails['TotalFare']['value'];
									if(isset($SoapMessage['ErrorMessage']['value']))
									{
										if($SoapMessage['ErrorMessage']['value'] !='')
										{
											$data['ErrorMessage'] = $SoapMessage['ErrorMessage']['value'];
											$this->load->view('flight_error',$data);
										}
										else
										{
											//echo "hoihjohjio"; 
										}
									}
									else
									{
									$xml_book = '<?xml version="1.0" encoding="utf-8"?>
										<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
										  <soap:Body>
											<BookFlights xmlns="ElsyArres.API">
											  <SoapMessage>
										<Password>1009E55E71</Password>
													<Username>EgyptspiritAPI</Username>
													<LanguageCode>EN</LanguageCode>
												<Request>
												  <FlightId>'.$flight_id.'</FlightId>
												  <ConfirmNewPrice>true</ConfirmNewPrice>
												  <ClientIP></ClientIP>
												  <CustomContainer></CustomContainer>
												</Request>
												<Response />
											  </SoapMessage>
											</BookFlights>
										  </soap:Body>
										</soap:Envelope>';
									//echo $xml_book; exit;
									//$url =  "http://testv80.elsyarres.net/service.asmx";
									$url =  "http://www1v80.elsyarres.net/service.asmx";
									$soap = "ElsyArres.API/BookFlights";
									//$soap = "ElsyArres.API/BookFlights";
									$ch2=curl_init();
									curl_setopt($ch2, CURLOPT_URL, $url);
									curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
									curl_setopt($ch2, CURLOPT_HEADER, 0);
									curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch2, CURLOPT_POST, 1);
									curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml_book);
									curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
									curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
									//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
									curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
									curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
							
									$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
									curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
									curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
							
									// Execute request, store response and HTTP response code
									$data_book=curl_exec($ch2);
									$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
									curl_close($ch2);
									//echo $data_book; exit;
									$array_book = $this->xml2array($data_book);
									//echo "<pre>";  print_r($array_book); exit;
									redirect('home/flight_thankyou/'.$total.'/'.$flight_id,'refresh');
									}
								//}
							
							//}
							
						}
					 }
				}
				
				
	}
	function new_flight_book($total,$flight_id)
	{
		//w.ashour@egyptspirit.co.uk
		//exit;
		$xml = '<?xml version="1.0" encoding="utf-8"?>
					<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
					  <soap:Body>
						<PrepareBookFlights xmlns="ElsyArres.API">
						  <SoapMessage>
							<Password>0555B8836C</Password>
							<Username>EgyptspiritAPI</Username>
							<LanguageCode>EN</LanguageCode>
							<Request>
							  <ClientIP>123.201.254.254</ClientIP>
							  <ConfirmedCurrency>GBP</ConfirmedCurrency>
							  <ConfirmedPrice>'.$total.'</ConfirmedPrice>
							  <ConfirmPossibleDuplicate>false</ConfirmPossibleDuplicate>
							  <CustomerInfo>
								<City>Test City</City>
								<CompanyName>Test Company Ltd.</CompanyName>
								<CountryCode>DE</CountryCode>
								<Email>balup.provab@gmail.com</Email>
								<FirstName>FirstnameA</FirstName>
								<HouseNo>111</HouseNo>
								<LastName>LastNameA</LastName>
								<PhoneArea>234</PhoneArea>
								<PhoneCountry>1</PhoneCountry>
								<PhoneNumber>567890</PhoneNumber>
								<Sex>MALE</Sex>
								<Street>Test Street</Street>
								<Zip>12345</Zip>
							  </CustomerInfo>
							  <FlightId>'.$flight_id.'</FlightId>
							  <PassengerInfo>
								<Passenger>
								  <BaggageCode>0</BaggageCode>
								  <Birthday>1983-01-22</Birthday>
								  <FirstName>FirstnameA</FirstName>
								  <LastName>LastNameA</LastName>
								  <PassportNumber>000001</PassportNumber>
								  <Sex>MALE</Sex>
								  <Type>ADULT</Type>
								</Passenger>
							  </PassengerInfo>
							  <PaymentInfo>
								<BillingAddress>
								  <City>bangalore</City>
								  <CountryCode>DE</CountryCode>
								  <HouseNo>111</HouseNo>
								  <Street>bangalore</Street>
								  <Zip>12345</Zip>
								</BillingAddress>
								<CVC>123</CVC>
								<Expiry>03/21</Expiry>
								<Holder>test</Holder>
								<Number>4111111111111111</Number>
								<PaymentCode>VISA</PaymentCode>
							  </PaymentInfo>
							</Request>
						  </SoapMessage>
						</PrepareBookFlights>
					  </soap:Body>
					</soap:Envelope>';
		
					//echo $xml; 
			$url =  "http://testv80.elsyarres.net/service.asmx";
				$soap = "ElsyArres.API/PrepareBookFlights";
				//$soap = "ElsyArres.API/BookFlights";
				$ch2=curl_init();
				curl_setopt($ch2, CURLOPT_URL, $url);
				curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
				curl_setopt($ch2, CURLOPT_HEADER, 0);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_POST, 1);
				curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
		
				$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
				curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
				curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
		
				// Execute request, store response and HTTP response code
				$data2=curl_exec($ch2);
				$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
				curl_close($ch2);
				//echo $data2; exit;
				$array = $this->xml2array($data2);
				//echo "<pre>"; print_r($array); exit;
				$array1 = $array;
				if(isset($array['soap:Envelope']['attr']))
				{
					 if($array['soap:Envelope']['soap:Body'])
					 {
						$xmlns = $array['soap:Envelope']['soap:Body'];
						if(isset($xmlns['PrepareBookFlightsResponse']))
						{
							$PrepareBookFlightsResponse = $xmlns['PrepareBookFlightsResponse'];
							$SoapMessage = $PrepareBookFlightsResponse['SoapMessage'];
							//echo "<pre>"; print_r($SoapMessage); 
							if($SoapMessage['ErrorCode']['value'] != '0')
							{ 
								if($SoapMessage['ErrorMessage'] != '')
								{
									if($SoapMessage['ErrorCode']['value'] == '5025' || $SoapMessage['ErrorCode']['value'] == '7001')
									{
										$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
										$new_price1 = explode('[',$ErrorMessage);
										//echo "<pre>"; print_r($new_price1); exit;
										$newprice = $new_price1[3];
										$total1 = explode(']',$newprice);
										$total = $total1[0];
										redirect('home/new_flight_book/'.$total.'/'.$flight_id,'refresh');
									}
									else if($SoapMessage['ErrorCode']['value'] !='5026')
									{
										$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
										/*$new_price1 = explode('[',$ErrorMessage);
										//echo "<pre>"; print_r($new_price1); exit;
										$newprice = $new_price1[3];
										$total1 = explode(']',$newprice);
										$total = $total1[0];*/
										redirect('home/new_flight_book/'.$total.'/'.$flight_id,'refresh');
									}
									else
									{
										$data['ErrorMessage'] = $SoapMessage['ErrorMessage']['value'];
										$this->load->view('flight_error',$data);
									}
								}
							}
							else
							{
								$PrepareBookFlightsResponse = $xmlns['PrepareBookFlightsResponse'];
							
								$SoapMessage = $PrepareBookFlightsResponse['SoapMessage'];
								//echo "<pre>"; print_r($SoapMessage);  
								if($SoapMessage['ErrorCode']['value'] != '0')
								{
									$ErrorMessage = $SoapMessage['ErrorMessage']['value'];
								}
								else
								{
									$response = $SoapMessage['Response']; 
									
									$FlightDetails = $response['FlightDetails'];
									//echo "<pre>"; print_r($FlightDetails);	
									$xml_book = '<?xml version="1.0" encoding="utf-8"?>
										<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
										  <soap:Body>
											<BookFlights xmlns="ElsyArres.API">
											  <SoapMessage>
										<Password>0555B8836C</Password>
													<Username>EgyptspiritAPI</Username>
													<LanguageCode>EN</LanguageCode>
												<Request>
												  <FlightId>'.$flight_id.'</FlightId>
												  <ConfirmNewPrice>true</ConfirmNewPrice>
												  <ClientIP></ClientIP>
												  <CustomContainer></CustomContainer>
												</Request>
												<Response />
											  </SoapMessage>
											</BookFlights>
										  </soap:Body>
										</soap:Envelope>';
									//echo $xml;
									$url =  "http://testv80.elsyarres.net/service.asmx";
									$soap = "ElsyArres.API/BookFlights";
									//$soap = "ElsyArres.API/BookFlights";
									$ch2=curl_init();
									curl_setopt($ch2, CURLOPT_URL, $url);
									curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
									curl_setopt($ch2, CURLOPT_HEADER, 0);
									curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch2, CURLOPT_POST, 1);
									curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml_book);
									curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
									curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
									//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
									curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
									curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
							
									$httpHeader2 = array("SOAPAction: {$soap}","Content-Type: text/xml; charset=utf-8","Content-Encoding: UTF-8");
									curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
									curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
							
									// Execute request, store response and HTTP response code
									$data_book=curl_exec($ch2);
									$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
									curl_close($ch2);
									//echo $data_book; exit;
									$array_book = $this->xml2array($data2);
									redirect('home/flight_thankyou/1/'.$total.'/'.$flight_id,'refresh');
								}
							}
						}
					 }
				}
				
				//redirect('home/flight_thankyou/1','refresh');
	}
	function flight_thankyou($total,$flight_id)
	{
		$data['total'] = $total;
		//$data['bookid'] = $book_id;
		$data['flight_id'] = $flight_id;
		$this->load->view('flight_thank_you',$data);
	}
	function hotel_availability($from,$sessionid)
	{
		//echo $from; exit;
		$res = $this->Home_Model->hotel_availability($from);
		if($res != false)
		{
				
			foreach($res as $rw)
			{
				$this->Home_Model->insert_search($rw->hotel_id,$sessionid);
			}
			//redirect('home/hotel_flight_result/'.$sessionid.'','refresh');
		}
		else
		{
			redirect('home/hotel_flight_result/'.$sessionid.'','refresh');
		}
	}
	function hotel_flight_result($sessionid)
	{
		$data['sessionid']=$sessionid;
		$hotel_id = $this->Home_Model->get_hotel($sessionid);
		
		//$data['hotel_res'] = $this->Home_Model->get_hotel_det($hotel_id);
		//$data['price'] = $this->Home_Model->get_hotel_price($hotel_id);
		$this->load->view('flight_hotel/search_result',$data);
	}
	function hotel_flight_result_new($sessionid,$air_from,$air_to)
	{
		$data['sessionid']=$sessionid;
		$data['air_from'] = $air_from;
		$data['air_to'] = $air_to;
		$hotel_id = $this->Home_Model->get_hotel($sessionid);
		
		//$data['hotel_res'] = $this->Home_Model->get_hotel_det($hotel_id);
		//$data['price'] = $this->Home_Model->get_hotel_price($hotel_id);
		$this->load->view('flight_hotel/search_result_new',$data);
	}
	function flight_result_alone($sessionid,$air_from,$air_to)
	{
		$data['sessionid']=$sessionid;
		$data['air_from'] = $air_from;
		$data['air_to'] = $air_to;
		$hotel_id = $this->Home_Model->get_hotel($sessionid);
		
		//$data['hotel_res'] = $this->Home_Model->get_hotel_det($hotel_id);
		//$data['price'] = $this->Home_Model->get_hotel_price($hotel_id);
		$this->load->view('flight_hotel/flight_result_alone',$data);
	}
	function get_cruise_flight()
	{
		$data['cityval'] = $cityval = $this->session->userdata('air_to');
		$data['pid'] = $this->input->post('pid');
		$seg_id = $this->input->post('seg_id');
		$f_priceid = $this->input->post('f_priceid');
		
		$seg_id_r = $this->input->post('seg_id_r');
		
		$f_priceid_r = $this->input->post('f_priceid_r');
		//echo $cityval; exit;
		$checkin = $this->session->userdata('depdate');
		$checkout = $this->session->userdata('retdate');
		$state_room = '';
		$adult =$this->session->userdata('adult_flight'); 
		$child =$this->session->userdata('child_flight'); 
		$this->session->set_userdata(array('cruise_city'=>$cityval,'cruise_checkin'=>$checkin,'cruise_checkout'=>$checkout,'state_room'=>$state_room,'cruise_adult'=>$adult,'cruise_child'=>$child,'seg_id'=>$seg_id,'f_priceid'=>$f_priceid,'seg_id_r'=>$seg_id_r,'f_priceid_r'=>$f_priceid_r));
		$this->load->view('cruise_flight/cruise_load',$data);
		
	}
	function cruise_flight_search()
	{
		$pid = $this->input->post('pid');
		$data['flight_new'] = $this->Home_Model->flight_det_new($pid);
		
		$seg_id = $this->session->userdata('seg_id');
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		 
		$data['seg_id'] = $seg_id;
		$data['f_priceid'] = $f_priceid;
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$city_val = $this->session->userdata('air_to');
		$data['cruise'] = $this->Home_Model->cruise_search($city_val);
		
		$this->load->view('cruise_flight/cruise_search_result',$data);
	}
	function cruise_flight_det($cruise_id)
	{
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisename($cruise_id);
		$data['cruise_cab'] = $this->Home_Model->cruise_cab($cruise_id);
		$data['cab_gallery'] = $this->Home_Model->cabin_gallery($cruise_id);
		$data['deck_gallery'] = $this->Home_Model->deck_gallery($cruise_id);
		$data['entertain_gallery'] = $this->Home_Model->entertainment_gallery($cruise_id);
		$data['luxor_gallery'] = $this->Home_Model->luxor_gallery($cruise_id);
		$data['sight_gallery'] = $this->Home_Model->sight_gallery($cruise_id);
		
		$data['deck_plan'] = $this->Home_Model->deck_plan($cruise_id);
		$data['itinerary'] = $this->Home_Model->cruise_itinerary($cruise_id);
		$data['entertain'] = $this->Home_Model->cruise_entertain($cruise_id);
		$data['luxor'] = $this->Home_Model->cruise_luxor($cruise_id);
		$data['sights'] = $this->Home_Model->cruise_sights($cruise_id);
		$this->load->view('cruise_flight/cruise_inner',$data);
	}
	function cruise_flight_extrass($cruise_id)
	{
		$data['cruise_id'] = $cruise_id;
		$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
		
		$seg_id = $this->session->userdata('seg_id');
		$f_priceid = $this->session->userdata('f_priceid');
		
		$seg_id_r = $this->session->userdata('seg_id_r');
		
		$f_priceid_r = $this->session->userdata('f_priceid_r');
		 
		$data['seg_id'] = $seg_id;
		$data['f_priceid'] = $f_priceid;
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$city_val = $this->session->userdata('air_to');
		
		$data['excursion'] = $this->Home_Model->search_excursion($city_val);
		$this->load->view('cruise_flight/cruise_extrass',$data);
	}
	function transfer_cruise_flight($cruise_id)
	   {
			$seg_id = $this->session->userdata('seg_id'); 
			$f_priceid = $this->session->userdata('f_priceid');
			
			$seg_id_r = $this->session->userdata('seg_id_r');
			
			$f_priceid_r = $this->session->userdata('f_priceid_r');
			
			$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
			
			$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
			
			
			$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
			
			$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
			
		
			$destination = $this->session->userdata('airport_to');
			
			
			$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			$this->load->view('cruise_flight/cruise_flight_transfer',$data);
	   }
	   function cruise_excursion_add($cruise_id,$ex_id)
	   {
			$seg_id = $this->session->userdata('seg_id'); 
			$f_priceid = $this->session->userdata('f_priceid');
			
			$seg_id_r = $this->session->userdata('seg_id_r');
			
			$f_priceid_r = $this->session->userdata('f_priceid_r');
			
			$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
			
			$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
			
			
			$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
			
			$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
			
			$destination = $this->session->userdata('airport_to');
			
			$data['excursion'] = $this->Home_Model->search_excursion($destination);
			
			$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
			$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
		
			$this->load->view('cruise_flight/cruise_flight_activity',$data);
	   }
	   function cruise_flight_book($ex_id,$cruise_id)
		{
			 $seg_id = $this->session->userdata('seg_id'); 
			$f_priceid = $this->session->userdata('f_priceid');
			
			$seg_id_r = $this->session->userdata('seg_id_r');
			
			$f_priceid_r = $this->session->userdata('f_priceid_r');
			
			$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
			
			$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
			
			
			$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
			
			$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
			
			$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
			$data['country'] = $this->Home_Model->get_country();
			$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
			$this->load->view('cruise_flight/cruise_flight_booking',$data);
		}
		function cruise_flight_book_tran($cruise_id)
		{
			 $seg_id = $this->session->userdata('seg_id'); 
			$f_priceid = $this->session->userdata('f_priceid');
			
			$seg_id_r = $this->session->userdata('seg_id_r');
			
			$f_priceid_r = $this->session->userdata('f_priceid_r');
			
			$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
			
			$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
			
			
			$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
			
			$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
			
		
			$data['country'] = $this->Home_Model->get_country();
			$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
			$this->load->view('cruise_flight/cruise_flight_trans_booking',$data);
		}
		function cruise_flight_book_act($cruise_id,$ex_id)
		{
			$seg_id = $this->session->userdata('seg_id'); 
			$f_priceid = $this->session->userdata('f_priceid');
			
			$seg_id_r = $this->session->userdata('seg_id_r');
			
			$f_priceid_r = $this->session->userdata('f_priceid_r');
			
			$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
			
			$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
			
			
			$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
			
			$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
			
		
			$data['country'] = $this->Home_Model->get_country();
			$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
			$data['ex_det'] = $this->Home_Model->get_excursion_det($ex_id);
			$this->load->view('cruise_flight/cruise_flight_book_act',$data);
		}
	function get_hotels_flight()
		{
			//echo "<pre>"; print_r($this->session->userdata); exit;
		$sec_res=$this->session->userdata('sessionid');

		$seg_id = $this->input->post('seg_id'); 
		$f_priceid = $this->input->post('f_priceid');
		
		$seg_id_r = $this->input->post('seg_id_r');
		
		$f_priceid_r = $this->input->post('f_priceid_r');
		
		//$data['country_travel'] = $country_travel = $this->input->post('country_travel');
		$data['country_travel'] = $country_travel = '';
		$data['destination'] = $destination = $this->session->userdata('air_to'); 
		//$data['resort'] = $resort = $this->input->post('resort'); 
		$data['resort'] = $resort = '';
		$data['All_board'] = $All_board = $this->session->userdata('All_board');
		//$data['All_board'] = $All_board = 'BT';
		$data['roomonly'] = $roomonly = $this->session->userdata('roomonly');
		//$data['roomonly'] = $roomonly = 'BT_RO';
		//BT_SC
		//BT_BB
		//half_board
		//full_board
		//all_inclusive
		//villa
		$data['self_cat'] = $self_cat = $this->session->userdata('self_cat');
		//$data['self_cat'] = $self_cat = '';
		$data['bed_break'] = $bed_break = $this->session->userdata('bed_break');
		//$data['bed_break'] = $bed_break = '';
		$data['half_board'] = $half_board = $this->session->userdata('half_board');
		//$data['half_board'] = $half_board = '';
		$data['full_board'] = $full_board = $this->session->userdata('full_board');
		//$data['full_board'] = $full_board = '';
		$data['all_inclusive'] = $all_inclusive = $this->session->userdata('all_inclusive');
		//$data['all_inclusive'] = $all_inclusive = '';
		$data['villa'] = $villa = $this->session->userdata('villa');
		//$data['villa'] = $villa = '';
		$data['all_star'] = $all_star = $this->session->userdata('all_star');
		//$data['all_star'] = $all_star = 'StarCatAll';
		$data['star1'] = $star1 = $this->session->userdata('star1');
		//$data['star1'] = $star1 = '';
		$data['star2'] = $star2 = $this->session->userdata('star2');
		//$data['star2'] = $star2 = '';
		$data['star3'] = $star3 = $this->session->userdata('star3');
		//$data['star3'] = $star3 = '';
		$data['star4'] = $star4 = $this->session->userdata('star4');
		//$data['star4'] = $star4 = '';
		$data['star5'] = $star5 = $this->session->userdata('star5');
		//$data['star5'] = $star5 = '';
		
		$this->Home_Model->delete_search_result($sec_res);
		//$data['citycode']=$this->input->post('cityval');
		//$data['disp_city']= $disp_city = $this->input->post('cityval');
		$data['citycode']=$this->session->userdata('air_to');
		$data['disp_city']= $disp_city = $this->session->userdata('air_to');
		
		//$data['hotel_name']= $hotel_name = $this->input->post('hotel_name');	
		$data['hotel_name']= $hotel_name = '';
		$this->session->userdata('depdate');
		$data['sd']= $cin = $this->session->userdata('depdate');;
		$data['ed']= $cout = $this->session->userdata('retdate');;
		//echo $cin."-".$cout."-".$disp_city."-".$hotel_name; exit;
		//$data['roomcount']= $roomcount = $this->input->post('room_count');
		$data['roomcount']= $roomcount = '1';
		$data['adult']=$adult=$this->session->userdata('adult_flight');
		$data['child']=$child=$this->session->userdata('child_flight');
		//$data['child_age']=$child_age=$this->input->post('child_age');
		$data['child_age']=$child_age= '';
		/* adults and childs for Youtravel */
		if(isset($adult[0]))
		{
			$ADLTS_1 = $adult[0];
		}
		else
		{
			$ADLTS_1 = '0';
		}
		if(isset($adult[1]))
		{
			$ADLTS_2 = $adult[1];
		}
		else
		{
			$ADLTS_2 = '0';
		}
		if(isset($adult[2]))
		{
			$ADLTS_3 = $adult[2];
		}
		else
		{
			$ADLTS_3 = '0';
		}
		
		if(isset($child[0]))
		{
			$CHILD_1 = $child[0];
		}
		else
		{
			$CHILD_1 = '0';
		}
		if(isset($child[1]))
		{
			$CHILD_2 = $child[1];
		}
		else
		{
			$CHILD_2 = '0';
		}
		if(isset($child[2]))
		{
			$CHILD_3 = $child[2];
		}
		else
		{
			$CHILD_3 = '0';
		}
		//print_r($child_age);
		/*$ChildAgeR1C1 = $child_age[0];
		$ChildAgeR1C2 = $child_age[1];
		$ChildAgeR2C1 = $child_age[2];
		$ChildAgeR2C2 = $child_age[3];
		$ChildAgeR3C1 = $child_age[4];
		$ChildAgeR3C2 = $child_age[5];*/
		
		$ChildAgeR1C1 = '3';
		$ChildAgeR1C2 = '0';
		$ChildAgeR2C1 = '0';
		$ChildAgeR2C2 = '0';
		$ChildAgeR3C1 = '0';
		$ChildAgeR3C2 = '0';
		//$ChildAgeR2C1 = $child_age[2];
		 //exit;
		 /* adults and childs for Youtravel */
		//print_r($adult); exit;
		
		
		$data['boardtype']=$boardtype=$this->input->post('All_board');
		$data['boardtype']= $boardtype = 'BT';
		//$data['starrating']=$starrating=$this->input->post('all_star');
		$data['starrating']=$starrating= 'StarCatAll';
		
		$data['costtype'] =$costtype="GBP";
		/*$adultval = $_POST['adult'];
		$childval = $_POST['child'];*/
		$adultval = $this->session->userdata('adult_flight');
		$childval = $this->session->userdata('child_flight');
		$room_used_type=array();
		$adult_count=1;
		$child_count=0;

	    /*for($i=0;$i< $roomcount;$i++)
		{
			
			if($adultval[$i]==1 && $childval[$i]==0)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==1 && $childval[$i]==1)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 1;
    		}
			if($adultval[$i]==1 && $childval[$i]==2)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 2;
    		}
			
			if($adultval[$i]==2 && $childval[$i]==0)
			{
				
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 0;
    		}
            if($adultval[$i]==2 && $childval[$i]==1)
			{
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 1;
    		}
            if($adultval[$i]==2 && $childval[$i]==2)
			{
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==3 && $childval[$i]==0)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==3 && $childval[$i]==1)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 1;
    		}
            if($adultval[$i]==3 && $childval[$i]==2)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==4 && $childval[$i]==0)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==4 && $childval[$i]==1)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 1;
    		}
			if($adultval[$i]==4 && $childval[$i]==2)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==5 )
			{
				
				$room_used_type[] = 9;
				$adult_count = $adult_count + 5; 
				//$child_count = $child_count + 2;
			}
			
			
		}*/
		
		//print_r($room_used_type); exit;
		$this->session->set_userdata(array('seg_id'=>$seg_id,'f_priceid'=>$f_priceid,'seg_id_r'=>$seg_id_r,'f_priceid_r'=>$f_priceid_r,'All_board'=>$All_board,'roomonly'=>$roomonly,'self_cat'=>$self_cat,'bed_break'=>$bed_break,'half_board'=>$half_board,'full_board'=>$full_board,'all_inclusive'=>$all_inclusive,'villa'=>$villa,'all_star'=>$all_star,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'ADLTS_1'=>$ADLTS_1,'ADLTS_2'=>$ADLTS_2,'ADLTS_3'=>$ADLTS_3,'CHILD_1'=>$CHILD_1,'CHILD_2'=>$CHILD_2,'CHILD_3'=>$CHILD_3,'ChildAgeR1C1'=>$ChildAgeR1C1,'ChildAgeR1C2'=>$ChildAgeR1C2,'ChildAgeR2C1'=>$ChildAgeR2C1,'ChildAgeR2C2'=>$ChildAgeR2C2,'ChildAgeR3C1'=>$ChildAgeR3C1,'ChildAgeR3C2'=>$ChildAgeR3C2,'country_travel'=>$country_travel,'destination'=>$destination,'resort'=>$resort,'roomusedtype'=>$room_used_type, 'hotel_name'=>$hotel_name, 'adult_count'=>$adult_count, 'child_count'=>$child_count, 'roomcount'=>$data['roomcount'],'child_age'=>$child_age, 'sec_res'=>$sec_res,'citycode'=>$data['citycode'],'cin'=>$cin,'cout'=>$cout,'disp_city'=>$disp_city, 'boardtype'=>$boardtype, 'starrating'=>$starrating));
	    $this->load->view('flight_hotel/load_customer',$data); 
		
		
	
			//$this->load->view('hotel_search_result');
		}
		function get_hotels_flight2()
		{
			//echo "<pre>"; print_r($this->session->userdata); exit;
		$sec_res=$this->session->userdata('sessionid');
		
		$data['flight_id'] = $flight_id = $this->input->post('flight_id');
			$data['air_from'] =  $air_from = $this->input->post('air_from');
			$data['air_to'] = $air_to = $this->input->post('air_to');
			$data['pid'] = $pid = $this->input->post('pid');
			
		$seg_id = $this->input->post('seg_id'); 
		$f_priceid = $this->input->post('f_priceid');
		
		$seg_id_r = $this->input->post('seg_id_r');
		
		$f_priceid_r = $this->input->post('f_priceid_r');
		
		//$data['country_travel'] = $country_travel = $this->input->post('country_travel');
		$data['country_travel'] = $country_travel = '';
		$data['destination'] = $destination = $this->session->userdata('air_to'); 
		//$data['resort'] = $resort = $this->input->post('resort'); 
		$data['resort'] = $resort = '';
		$data['All_board'] = $All_board = $this->session->userdata('All_board');
		//$data['All_board'] = $All_board = 'BT';
		$data['roomonly'] = $roomonly = $this->session->userdata('roomonly');
		//$data['roomonly'] = $roomonly = 'BT_RO';
		//BT_SC
		//BT_BB
		//half_board
		//full_board
		//all_inclusive
		//villa
		$data['self_cat'] = $self_cat = $this->session->userdata('self_cat');
		//$data['self_cat'] = $self_cat = '';
		$data['bed_break'] = $bed_break = $this->session->userdata('bed_break');
		//$data['bed_break'] = $bed_break = '';
		$data['half_board'] = $half_board = $this->session->userdata('half_board');
		//$data['half_board'] = $half_board = '';
		$data['full_board'] = $full_board = $this->session->userdata('full_board');
		//$data['full_board'] = $full_board = '';
		$data['all_inclusive'] = $all_inclusive = $this->session->userdata('all_inclusive');
		//$data['all_inclusive'] = $all_inclusive = '';
		$data['villa'] = $villa = $this->session->userdata('villa');
		//$data['villa'] = $villa = '';
		$data['all_star'] = $all_star = $this->session->userdata('all_star');
		//$data['all_star'] = $all_star = 'StarCatAll';
		$data['star1'] = $star1 = $this->session->userdata('star1');
		//$data['star1'] = $star1 = '';
		$data['star2'] = $star2 = $this->session->userdata('star2');
		//$data['star2'] = $star2 = '';
		$data['star3'] = $star3 = $this->session->userdata('star3');
		//$data['star3'] = $star3 = '';
		$data['star4'] = $star4 = $this->session->userdata('star4');
		//$data['star4'] = $star4 = '';
		$data['star5'] = $star5 = $this->session->userdata('star5');
		//$data['star5'] = $star5 = '';
		
		$this->Home_Model->delete_search_result($sec_res);
		//$data['citycode']=$this->input->post('cityval');
		//$data['disp_city']= $disp_city = $this->input->post('cityval');
		$data['citycode']=$this->session->userdata('air_to');
		$data['disp_city']= $disp_city = $this->session->userdata('air_to');
		
		//$data['hotel_name']= $hotel_name = $this->input->post('hotel_name');	
		$data['hotel_name']= $hotel_name = '';
		$this->session->userdata('depdate');
		$data['sd']= $cin = $this->session->userdata('depdate');;
		$data['ed']= $cout = $this->session->userdata('retdate');;
		//echo $cin."-".$cout."-".$disp_city."-".$hotel_name; exit;
		//$data['roomcount']= $roomcount = $this->input->post('room_count');
		$data['roomcount']= $roomcount = '1';
		$data['adult']=$adult=$this->session->userdata('adult_flight');
		$data['child']=$child=$this->session->userdata('child_flight');
		//$data['child_age']=$child_age=$this->input->post('child_age');
		$data['child_age']=$child_age= '';
		/* adults and childs for Youtravel */
		if(isset($adult[0]))
		{
			$ADLTS_1 = $adult[0];
		}
		else
		{
			$ADLTS_1 = '0';
		}
		if(isset($adult[1]))
		{
			$ADLTS_2 = $adult[1];
		}
		else
		{
			$ADLTS_2 = '0';
		}
		if(isset($adult[2]))
		{
			$ADLTS_3 = $adult[2];
		}
		else
		{
			$ADLTS_3 = '0';
		}
		
		if(isset($child[0]))
		{
			$CHILD_1 = $child[0];
		}
		else
		{
			$CHILD_1 = '0';
		}
		if(isset($child[1]))
		{
			$CHILD_2 = $child[1];
		}
		else
		{
			$CHILD_2 = '0';
		}
		if(isset($child[2]))
		{
			$CHILD_3 = $child[2];
		}
		else
		{
			$CHILD_3 = '0';
		}
		//print_r($child_age);
		/*$ChildAgeR1C1 = $child_age[0];
		$ChildAgeR1C2 = $child_age[1];
		$ChildAgeR2C1 = $child_age[2];
		$ChildAgeR2C2 = $child_age[3];
		$ChildAgeR3C1 = $child_age[4];
		$ChildAgeR3C2 = $child_age[5];*/
		
		$ChildAgeR1C1 = '3';
		$ChildAgeR1C2 = '0';
		$ChildAgeR2C1 = '0';
		$ChildAgeR2C2 = '0';
		$ChildAgeR3C1 = '0';
		$ChildAgeR3C2 = '0';
		//$ChildAgeR2C1 = $child_age[2];
		 //exit;
		 /* adults and childs for Youtravel */
		//print_r($adult); exit;
		
		
		$data['boardtype']=$boardtype=$this->input->post('All_board');
		$data['boardtype']= $boardtype = 'BT';
		//$data['starrating']=$starrating=$this->input->post('all_star');
		$data['starrating']=$starrating= 'StarCatAll';
		
		$data['costtype'] =$costtype="GBP";
		/*$adultval = $_POST['adult'];
		$childval = $_POST['child'];*/
		$adultval = $this->session->userdata('adult_flight');
		$childval = $this->session->userdata('child_flight');
		$room_used_type=array();
		$adult_count=1;
		$child_count=0;

	    /*for($i=0;$i< $roomcount;$i++)
		{
			
			if($adultval[$i]==1 && $childval[$i]==0)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==1 && $childval[$i]==1)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 1;
    		}
			if($adultval[$i]==1 && $childval[$i]==2)
			{
				$room_used_type[] = 1;
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 2;
    		}
			
			if($adultval[$i]==2 && $childval[$i]==0)
			{
				
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 0;
    		}
            if($adultval[$i]==2 && $childval[$i]==1)
			{
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 1;
    		}
            if($adultval[$i]==2 && $childval[$i]==2)
			{
				$room_used_type[] = 3;
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==3 && $childval[$i]==0)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==3 && $childval[$i]==1)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 1;
    		}
            if($adultval[$i]==3 && $childval[$i]==2)
			{
				$room_used_type[] = 8;
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==4 && $childval[$i]==0)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 0;
    		}
			if($adultval[$i]==4 && $childval[$i]==1)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 1;
    		}
			if($adultval[$i]==4 && $childval[$i]==2)
			{
				$room_used_type[] = 9;
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 2;
    		}
			if($adultval[$i]==5 )
			{
				
				$room_used_type[] = 9;
				$adult_count = $adult_count + 5; 
				//$child_count = $child_count + 2;
			}
			
			
		}*/
		
		//print_r($room_used_type); exit;
		$this->session->set_userdata(array('seg_id'=>$seg_id,'f_priceid'=>$f_priceid,'seg_id_r'=>$seg_id_r,'f_priceid_r'=>$f_priceid_r,'All_board'=>$All_board,'roomonly'=>$roomonly,'self_cat'=>$self_cat,'bed_break'=>$bed_break,'half_board'=>$half_board,'full_board'=>$full_board,'all_inclusive'=>$all_inclusive,'villa'=>$villa,'all_star'=>$all_star,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'ADLTS_1'=>$ADLTS_1,'ADLTS_2'=>$ADLTS_2,'ADLTS_3'=>$ADLTS_3,'CHILD_1'=>$CHILD_1,'CHILD_2'=>$CHILD_2,'CHILD_3'=>$CHILD_3,'ChildAgeR1C1'=>$ChildAgeR1C1,'ChildAgeR1C2'=>$ChildAgeR1C2,'ChildAgeR2C1'=>$ChildAgeR2C1,'ChildAgeR2C2'=>$ChildAgeR2C2,'ChildAgeR3C1'=>$ChildAgeR3C1,'ChildAgeR3C2'=>$ChildAgeR3C2,'country_travel'=>$country_travel,'destination'=>$destination,'resort'=>$resort,'roomusedtype'=>$room_used_type, 'hotel_name'=>$hotel_name, 'adult_count'=>$adult_count, 'child_count'=>$child_count, 'roomcount'=>$data['roomcount'],'child_age'=>$child_age, 'sec_res'=>$sec_res,'citycode'=>$data['citycode'],'cin'=>$cin,'cout'=>$cout,'disp_city'=>$disp_city, 'boardtype'=>$boardtype, 'starrating'=>$starrating));
	    $this->load->view('cruise_flight_hotel/load_customer',$data); 
		
		
	
			//$this->load->view('hotel_search_result');
		}
		function search_hotel_flight2()
		{
			$data['flight_id'] = $flight_id = $this->input->post('flight_id');
			$data['air_from'] = $air_from = $this->input->post('air_from');		
			$data['air_to'] = $air_to = $this->input->post('air_to');
			$data['pid'] = $pid = $this->input->post('pid');
			
			$city1=$this->session->userdata('citycode');
			if($city1=="")
			{
				$city1=$this->input->post('citycode');
				
			}
			//$expcicode=explode(",",$city1);
			
			//$citi=$expcicode[0];
			//$cntry=$expcicode[1];
				//echo $city1; exit;
			
			$row1=$this->Home_Model->cityCode_gta($city1);
			if($row1 !='')
			{
				$city_gta_code=trim($row1->cityCode);
				$destinationType=trim($row1->destinationType);
				$countrycode=trim($row1->countryCode);
			}
			$roomcount=$this->session->userdata('roomcount');
			$roomusedtypeval=$this->session->userdata('roomusedtype');
			//$roomusedtype=$roomusedtypeval[0];
			$roomusedtype = $roomusedtypeval;
			//$city=$city_gta_code;			
			$sec_res=$this->session->userdata('sec_res');	
			//$cin=$this->session->userdata('sec_res');	
			//$cout=$this->session->userdata('sec_res');	
			$check_in = $this->input->post('sd');
			$check_out = $this->input->post('ed');		
			$costval=$this->input->post('costtype');
			$out=explode("/",$this->input->post('ed'));
			$cout=$out[2]."-".$out[1]."-".$out[0];
			$in=explode("/",$this->input->post('sd'));
			$cin=$in[2]."-".$in[1]."-".$in[0];
			$diff = strtotime($cout) - strtotime($cin);
			
			$data['rtype']=$roomusedtype;
			$child=0;
			$adult=0;
			$noofroom1=0;
				/*for($i=0;$i< count($roomcount);$i++)
				{
				
					switch($roomusedtypeval[$i])
					{
						case 1:
							$adult=$adult+(1*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 3:				
							$adult=$adult+(2*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 9:
							$adult=$adult+(4*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 6:
							$adult=$adult+(2*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 5:
							 $adult=$adult+(1*$roomcount[$i]);
							 $noofroom1=$noofroom1+$roomcount[$i];
					   break;
					   
					   case 8:
							 $adult=$adult+(3*$roomcount[$i]);
							 $noofroom1=$noofroom1+$roomcount[$i];
					   break;
					   
					   case 4:												
							 $child=$child+(1*$roomcount[$i]);
							 $adult=$adult+(2*$roomcount[$i]);	
							 $noofroom1=$noofroom1+$roomcount[$i]; 
						break;
						
						case 7:
							$child=$child+(1*$roomcount[$i]);
							$adult=$adult+(2*$roomcount[$i]);								
							$noofroom1=$noofroom1+$roomcount[$i];					
						break;
					}
										
				}*/
							
					/*$data['child']=$child;
					$data['adult']=$adult;
					$data['nor']=$noofroom1;
					$data['room']=$noofroom=$noofroom1;	*/	
					$data['child']='0';
					$data['adult']= '1';
					$data['nor']= '1';
					$data['room']= '1';	
			
			$sec   = $diff % 60;
			$diff  = intval($diff / 60);
			$min   = $diff % 60;
			$diff  = intval($diff / 60);
			$hours = $diff % 24;
			$days  = intval($diff / 24);
			$data['dt']=$days;
			$this->session->set_userdata(array('check_in_new'=>$check_in,'dt'=>$days,'adult'=>$data['adult'],'child'=>$data['child'],'nor'=>$data['nor'],
			'cin'=>$cin,'cout'=>$cout,'rtype'=>$data['rtype']));
			//echo $adult; exit;
			//$this->crs_availability_new($cin,$cout,$days,$sec_res);
			$country_travel = $this->session->userdata('country_travel');
			$destination = $this->session->userdata('destination');
			$resort = $this->session->userdata('resort');
			$this->hotel_search_youtravel_flight($country_travel,$destination,$resort);
	
			//exit;
			redirect('home/search_result_new3/'.$pid,'refresh');
		
		
			
		}
		function search_result_new3($pid)
		{
		
			
			//echo "ishan";
			//echo "<pre>";
			//print_r($this->session->userdata);//exit;
			$pid = $pid; 
		
		$data['flight_new'] = $this->Home_Model->flight_det_new($pid);
		
			$seg_id = $this->session->userdata('seg_id'); 
			$f_priceid = $this->session->userdata('f_priceid');
			
			$seg_id_r = $this->session->userdata('seg_id_r');
			
			$f_priceid_r = $this->session->userdata('f_priceid_r');
			
			$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
			
			$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
			
			
			$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
			
			$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
			
			
			$data['cost']=$this->session->userdata('cost');
			$data['costtype']=$this->session->userdata('costtype');
			$cin=$this->session->userdata('cin');
			$cout=$this->session->userdata('cout');
			$data['disp_city']=$this->session->userdata('disp_city');
			$data['star']='all';
			
			$city = $this->session->userdata('city');
			if($city !='City ,Area, Airport')
			{
				$city=$this->session->userdata('city');
			}
			else
			{
				$city ='';
			}
			$data['cin']=$cin;
			$data['cout']=$cout;
			
			$data['nor']=$this->session->userdata('nor');
			$data['rtype']=$this->session->userdata('rtype');
			$data['city']=$this->session->userdata('city');
			$noofroom=$this->session->userdata('nor');
			$roomusedtype=$this->session->userdata('rtype');
			$days=$this->session->userdata('dt');
			
			
			$data['dt']=$days;
			$data['room']=$this->session->userdata('room');
			$data['adult']=$this->session->userdata('adult');
			$data['child']=$this->session->userdata('child');
			
			
			$data['a_id']=$this->session->userdata('agent_id');	
			
			$agnt=$this->session->userdata('agentid');			
			//$data['last_log']=$this->Agent_Model->agent_last_login($agnt);		
			//$data['acc_info']=$this->Agent_Model->accnt_information($agnt);			
			
			$sec_res=$this->session->userdata('sec_res');	
			$hname=$this->session->userdata('hot_name'); 
			$hotel_name_month=$this->session->userdata('pop_hotel_name'); 
			
			//echo $hotel_name_month; exit;
			//echo "<pre>";
			//print_r($this->session->userdata);exit;
			 if($hname!='')
			{
				
				$hname1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hname);
				$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hname1%' GROUP BY `hotel_name`");
				$result=$query->result();
				
			}
			else if($hotel_name_month!='')
			{
				
				$hotel_name_month1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hotel_name_month);
				$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hotel_name_month%' GROUP BY `hotel_name`");
				$result=$query->result();
				
			}
			
			else
			{
				
				$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`");
				//echo "SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`"; exit;
				$result=$query->result();
				
	
				//$result=$query->result();
				//exit;
			}
			
			/*//print_r($result);
			$perpage=10;
			//$this->session->set_userdata(array('perpage'=>$perpage));
				
				
			 if($hname=='' && $hotel_name_month=='')
			{
				//exit;
				$sresult=$this->Home_Model->get_search_result_info($sec_res,$perpage,$this->uri->segment(3));
				$sresult1=$this->Home_Model->get_search_result_info_per($sec_res,$perpage,$this->uri->segment(3));
			}
			
			elseif($hname!='')
			{
				
				$hotel=$hname;
				$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
			}
			else
			{
				
				
				$hotel=$hotel_name_month;
				$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
			}
		
			//print_r($sresult);
				$count= count($sresult); 
	
			$data['total_rows']=$count;
			$config['base_url'] = base_url().'/home/search_result/';
			$config['total_rows'] =$count;
			$config['per_page'] = '10';
			
			$this->pagination->initialize($config);
			
			
			
			
			  $start_key=$this->uri->segment(3);
				
					if($start_key=='')
					{
						$start_key=0;
					}	*/		
					
				$perpage=10;
				
				
				 if($hname=='' && $hotel_name_month=='')
				{
					//exit;
					$sresult=$this->Home_Model->get_search_result_info($sec_res,$perpage,$this->uri->segment(3));
					//echo "<pre>"; print_r($sresult);
				}
				
				elseif($hname!='')
				{
					
					$hotel=$hname;
					$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
				}
				else
				{
					
					
					$hotel=$hotel_name_month;
					$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
				}
			
				
				$count= count($result); 
				$data['total_rows']=$count;
				$config['base_url'] = base_url().'/home/search_result/';
				$config['total_rows'] =$count;
				$config['per_page'] = '10';
				
				
				$this->pagination->initialize($config);
				
				
				
				
				  $start_key=$this->uri->segment(3);
					
						if($start_key=='')
						{
							$start_key=0;
						}			
							
						
						
						
				if($sresult!=''){
				//echo count($sresult);exit;
				foreach($sresult as $row){
					
				
					$cityNamesvalue[]=$row->city_name;
					$hotelCodevalue[]=$row->hotel_id;
					$cityCodevalue[]=$row->city_name;
					$hotelNamesvalue[]=$row->hotel_name;
					$categoryCodevalue[]=$row->star_rate;
					$pricePerNightvalue[]=$row->nightperroom;
					$RoomCostvalue1[]=$row->cost_value;
					$RoomCost[]=$row->cost_type;
					$apiNameValue[]=$row->api_name;
					$roomtypeValue[]=$row->room_type;
					$inclusionValue[]=$row->inclusion;
					$image[]=$row->image;
				
				}
				
			//	print_r($cityNamesvalue);exit;
				
					if(count($hotelCodevalue)>0)
						{
							$h=0;						
							$end_key = $start_key+10;
							if(count($hotelCodevalue) < $end_key)
							{
								$end_key = count($hotelCodevalue);
							}
							$cityNamesvalue1=array();
							$hotelCodevalue1= array();
							$cityCodevalue1= array();
							$hotelNamesvalue1= array();
							$categoryCodevalue1= array();
							$pricePerNightvalue1= array();
							$RoomCostvalue11=array();	
							$RoomCost1=array();	
							$apiNameValue1=array();	
							$roomtypeValue1=array();	
							$inclusionValue1=array();
							$image1=array();
						
							for($t=$start_key;$t< $end_key;$t++)
							{
								$cityNamesvalue1[$h] = $cityNamesvalue[$t];
								$hotelCodevalue1[$h]= $hotelCodevalue[$t];
								$cityCodevalue1[$h] = $cityCodevalue[$t];
								$hotelNamesvalue1[$h]= $hotelNamesvalue[$t];
								$categoryCodevalue1[$h] = $categoryCodevalue[$t];
								$pricePerNightvalue1[$h] = $pricePerNightvalue[$t];
								$RoomCostvalue11[$h] = $RoomCostvalue1[$t];
								$RoomCost1[$h] = $RoomCost[$t];
								$apiNameValue1[$h] = $apiNameValue[$t];
								$roomtypeValue1[$h]= $roomtypeValue[$t];
								$inclusionValue1[$h]= $inclusionValue[$t];
								$image1[$h]= $image[$t];
								$h++;					
							}					
						}
									
				
					$data['criteria_id']=$sec_res;
					$data['cityNamesvalue']=$cityNamesvalue1;
					$data['hotelCodevalue']=$hotelCodevalue1;
					$data['cityCodevalue']=$cityCodevalue1;
					$data['hotelNamesvalue']=$hotelNamesvalue1;
					$data['categoryCodevalue']=$categoryCodevalue1;		
					$data['pricePerNightvalue']=$pricePerNightvalue1;	
					$data['RoomCostvalue1']=$RoomCostvalue11;
					$data['RoomCost']=$RoomCost1;		
					$data['apiNameValue']=$apiNameValue1;	
					$data['roomtypeValue']=$roomtypeValue1;		
					$data['inclusionValue']=$inclusionValue1;
					$data['image']=$image1;	
					$data['result'] = $sresult;
					//print_r($sresult); exit;
				$this->load->view('cruise_flight_hotel/search_result_hotel_new',$data);
			}
			else
			{
				$this->load->view('cruise_flight_hotel/search_result_hotel_new',$data);
			}
		   
		
		}
		function search_result_new2()
		{
		
			
			//echo "ishan";
			//echo "<pre>";
			//print_r($this->session->userdata);//exit;
			$seg_id = $this->session->userdata('seg_id'); 
			$f_priceid = $this->session->userdata('f_priceid');
			
			$seg_id_r = $this->session->userdata('seg_id_r');
			
			$f_priceid_r = $this->session->userdata('f_priceid_r');
			
			$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
			
			$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
			
			
			$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
			
			$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
			
			
			$data['cost']=$this->session->userdata('cost');
			$data['costtype']=$this->session->userdata('costtype');
			$cin=$this->session->userdata('cin');
			$cout=$this->session->userdata('cout');
			$data['disp_city']=$this->session->userdata('disp_city');
			$data['star']='all';
			
			$city = $this->session->userdata('city');
			if($city !='City ,Area, Airport')
			{
				$city=$this->session->userdata('city');
			}
			else
			{
				$city ='';
			}
			$data['cin']=$cin;
			$data['cout']=$cout;
			
			$data['nor']=$this->session->userdata('nor');
			$data['rtype']=$this->session->userdata('rtype');
			$data['city']=$this->session->userdata('city');
			$noofroom=$this->session->userdata('nor');
			$roomusedtype=$this->session->userdata('rtype');
			$days=$this->session->userdata('dt');
			
			
			$data['dt']=$days;
			$data['room']=$this->session->userdata('room');
			$data['adult']=$this->session->userdata('adult');
			$data['child']=$this->session->userdata('child');
			
			
			$data['a_id']=$this->session->userdata('agent_id');	
			
			$agnt=$this->session->userdata('agentid');			
			//$data['last_log']=$this->Agent_Model->agent_last_login($agnt);		
			//$data['acc_info']=$this->Agent_Model->accnt_information($agnt);			
			
			$sec_res=$this->session->userdata('sec_res');	
			$hname=$this->session->userdata('hot_name'); 
			$hotel_name_month=$this->session->userdata('pop_hotel_name'); 
			
			//echo $hotel_name_month; exit;
			//echo "<pre>";
			//print_r($this->session->userdata);exit;
			 if($hname!='')
			{
				
				$hname1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hname);
				$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hname1%' GROUP BY `hotel_name`");
				$result=$query->result();
				
			}
			else if($hotel_name_month!='')
			{
				
				$hotel_name_month1=preg_replace('/[^a-zA-Z0-9_ -]/s', '', $hotel_name_month);
				$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') AND `hotel_name` LIKE '%$hotel_name_month%' GROUP BY `hotel_name`");
				$result=$query->result();
				
			}
			
			else
			{
				
				$query=$this->db->query("SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`");
				//echo "SELECT * FROM (`search_result`) WHERE `criteria_id` = '$sec_res' AND `status` IN ('active') GROUP BY `hotel_name` ORDER BY `nightperroom`"; exit;
				$result=$query->result();
				
	
				//$result=$query->result();
				//exit;
			}
			
			/*//print_r($result);
			$perpage=10;
			//$this->session->set_userdata(array('perpage'=>$perpage));
				
				
			 if($hname=='' && $hotel_name_month=='')
			{
				//exit;
				$sresult=$this->Home_Model->get_search_result_info($sec_res,$perpage,$this->uri->segment(3));
				$sresult1=$this->Home_Model->get_search_result_info_per($sec_res,$perpage,$this->uri->segment(3));
			}
			
			elseif($hname!='')
			{
				
				$hotel=$hname;
				$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
			}
			else
			{
				
				
				$hotel=$hotel_name_month;
				$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
			}
		
			//print_r($sresult);
				$count= count($sresult); 
	
			$data['total_rows']=$count;
			$config['base_url'] = base_url().'/home/search_result/';
			$config['total_rows'] =$count;
			$config['per_page'] = '10';
			
			$this->pagination->initialize($config);
			
			
			
			
			  $start_key=$this->uri->segment(3);
				
					if($start_key=='')
					{
						$start_key=0;
					}	*/		
					
				$perpage=10;
				
				
				 if($hname=='' && $hotel_name_month=='')
				{
					//exit;
					$sresult=$this->Home_Model->get_search_result_info($sec_res,$perpage,$this->uri->segment(3));
					//echo "<pre>"; print_r($sresult);
				}
				
				elseif($hname!='')
				{
					
					$hotel=$hname;
					$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
				}
				else
				{
					
					
					$hotel=$hotel_name_month;
					$sresult=$this->Home_Model->get_search_result_info_hotel($sec_res,$hotel,$perpage,$this->uri->segment(3));
				}
			
				
				$count= count($result); 
				$data['total_rows']=$count;
				$config['base_url'] = base_url().'/home/search_result/';
				$config['total_rows'] =$count;
				$config['per_page'] = '10';
				
				
				$this->pagination->initialize($config);
				
				
				
				
				  $start_key=$this->uri->segment(3);
					
						if($start_key=='')
						{
							$start_key=0;
						}			
							
						
						
						
				if($sresult!=''){
				//echo count($sresult);exit;
				foreach($sresult as $row){
					
				
					$cityNamesvalue[]=$row->city_name;
					$hotelCodevalue[]=$row->hotel_id;
					$cityCodevalue[]=$row->city_name;
					$hotelNamesvalue[]=$row->hotel_name;
					$categoryCodevalue[]=$row->star_rate;
					$pricePerNightvalue[]=$row->nightperroom;
					$RoomCostvalue1[]=$row->cost_value;
					$RoomCost[]=$row->cost_type;
					$apiNameValue[]=$row->api_name;
					$roomtypeValue[]=$row->room_type;
					$inclusionValue[]=$row->inclusion;
					$image[]=$row->image;
				
				}
				
			//	print_r($cityNamesvalue);exit;
				
					if(count($hotelCodevalue)>0)
						{
							$h=0;						
							$end_key = $start_key+10;
							if(count($hotelCodevalue) < $end_key)
							{
								$end_key = count($hotelCodevalue);
							}
							$cityNamesvalue1=array();
							$hotelCodevalue1= array();
							$cityCodevalue1= array();
							$hotelNamesvalue1= array();
							$categoryCodevalue1= array();
							$pricePerNightvalue1= array();
							$RoomCostvalue11=array();	
							$RoomCost1=array();	
							$apiNameValue1=array();	
							$roomtypeValue1=array();	
							$inclusionValue1=array();
							$image1=array();
						
							for($t=$start_key;$t< $end_key;$t++)
							{
								$cityNamesvalue1[$h] = $cityNamesvalue[$t];
								$hotelCodevalue1[$h]= $hotelCodevalue[$t];
								$cityCodevalue1[$h] = $cityCodevalue[$t];
								$hotelNamesvalue1[$h]= $hotelNamesvalue[$t];
								$categoryCodevalue1[$h] = $categoryCodevalue[$t];
								$pricePerNightvalue1[$h] = $pricePerNightvalue[$t];
								$RoomCostvalue11[$h] = $RoomCostvalue1[$t];
								$RoomCost1[$h] = $RoomCost[$t];
								$apiNameValue1[$h] = $apiNameValue[$t];
								$roomtypeValue1[$h]= $roomtypeValue[$t];
								$inclusionValue1[$h]= $inclusionValue[$t];
								$image1[$h]= $image[$t];
								$h++;					
							}					
						}
									
				
					$data['criteria_id']=$sec_res;
					$data['cityNamesvalue']=$cityNamesvalue1;
					$data['hotelCodevalue']=$hotelCodevalue1;
					$data['cityCodevalue']=$cityCodevalue1;
					$data['hotelNamesvalue']=$hotelNamesvalue1;
					$data['categoryCodevalue']=$categoryCodevalue1;		
					$data['pricePerNightvalue']=$pricePerNightvalue1;	
					$data['RoomCostvalue1']=$RoomCostvalue11;
					$data['RoomCost']=$RoomCost1;		
					$data['apiNameValue']=$apiNameValue1;	
					$data['roomtypeValue']=$roomtypeValue1;		
					$data['inclusionValue']=$inclusionValue1;
					$data['image']=$image1;	
					$data['result'] = $sresult;
					//print_r($sresult); exit;
				$this->load->view('cruise_flight_hotel/search_result_hotel',$data);
			}
			else
			{
				$this->load->view('cruise_flight_hotel/search_result_hotel',$data);
			}
		   
		
		}
		 function hotel_det_trav_new2($hotel_id,$room_id)
		{
			$this->Home_Model->delete_hotel_det($hotel_id);
			$data['hotel_id'] = $hotel_id;
			$data['room_id'] = $room_id;
			$url = 'http://xml.youtravel.com/webservices/get_hoteldetails.asp?LangID=EN&HID='.$hotel_id.'&Username=egyptspirit&Password=sprite2013';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			//echo "<pre>"; print_r($array); 
			if(isset($array['HtSearchRq']['Hotel']))
			{
				$Success = $array['HtSearchRq']['Success']['value']; 
				$LangID = $array['HtSearchRq']['LangID']['value']; 
				$Destination = $array['HtSearchRq']['Destination']['value']; 
				$HID = $array['HtSearchRq']['HID']['value']; 
				$Hotel = $array['HtSearchRq']['Hotel'];
				$name = $Hotel['attr']['Name'];
				$Youtravel_Rating = $Hotel['Youtravel_Rating']['value'];
				$Official_Rating = $Hotel['Official_Rating']['value'];
				$Board_Type = $Hotel['Board_Type']['value'];
				$Hotel_Desc = $Hotel['Hotel_Desc']['value'];
				
				$Hotel_Photos = $Hotel['Hotel_Photos'];
				//echo "<pre>"; print_r($Hotel_Photos);
				foreach($Hotel_Photos as $photo)
				{
					foreach($photo as $ph)
					{
						//echo "<pre>"; print_r($ph);
						$photos = $ph['value'];
						$this->Home_Model->insert_hotelphotos($hotel_id,$photos);
					}
				}
				$Hotel_Facilities = $Hotel['Hotel_Facilities'];
				foreach($Hotel_Facilities as $fac)
				{
					foreach($fac as $faci)
					{
						//echo "<pre>"; print_r($ph);
						 $facility = $faci['value'];
						$this->Home_Model->insert_hotelfac($hotel_id,$facility);
					}
				}
				$Room_Types = $Hotel['Room_Types'];
				//echo "<pre>"; print_r($Room_Types);
				$Room = $Room_Types['Room']; 
				//echo "<pre>"; print_r($Room);
				if(isset($Room['attr']))
				{
					$room_name = $Room['attr']['name'];
					$rom_fac = $Room['Facility'];
					foreach($rom_fac as $rom_fac)
					{
						$room_facility = $rom_fac['value'];
						$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
					}
					
				}
				else
				{
					foreach($Room as $rom)	
					{
						$room_name = $rom['attr']['name'];
						$rom_fac = $rom['Facility'];
						foreach($rom_fac as $rom_fac)
						{
							$room_facility = $rom_fac['value'];
							$this->Home_Model->insert_room_fac($hotel_id,$room_name,$room_facility);
						}
					}
				}
				if(isset($Hotel['AI_Type']['value']))
				{
					$AI_Type = $Hotel['AI_Type']['value'];
				}
				else
				{
					$AI_Type = '';
				}
				if(isset($Hotel['AI_Desc']['value']))
				{
					$AI_Desc = $Hotel['AI_Desc']['value'];
				}
				else
				{
					$AI_Desc = '';
				}
				if(isset($Hotel['AI_Facilities']))
				{
					$AI_Facilities = $Hotel['AI_Facilities'];
					if(isset($AI_Facilities['AI_Facility']))
					{
						$AI_Facility = $AI_Facilities['AI_Facility'];
						foreach($AI_Facility as $ai_fac)
						{
							$AI_Facility = $ai_fac['value'];
						}
					}
				}
				else
				{
					$AI_Facility = '';
				}
				//$extras = $Hotel['Erratas']['value'];
				$this->Home_Model->youtravel_hotel_det($hotel_id,$Success,$LangID,$Destination,$name,$Official_Rating,$Board_Type,$Hotel_Desc);
			}
			$data['hotel_det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
			$data['hotel_det2'] = $this->Home_Model->youtravel_hotel_det2($hotel_id);
			$data['hotel_fac'] = $this->Home_Model->youtravel_hotel_fac($hotel_id);
			$data['room_fac'] = $this->Home_Model->youtravel_room_fac($hotel_id);
			$data['pictures'] = $this->Home_Model->youtravel_pictures($hotel_id);
			$this->load->view('cruise_flight_hotel/youtravel_hotel_det',$data);
		}
		
		function flight_hotel_extras2($hotel_id,$room_id)
		   {
			   $seg_id = $this->session->userdata('seg_id'); 
				$f_priceid = $this->session->userdata('f_priceid');
				
				$seg_id_r = $this->session->userdata('seg_id_r');
				
				$f_priceid_r = $this->session->userdata('f_priceid_r');
				
				$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
				
				$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
				
				
				$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
				
				$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
				
				$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
				
				$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
				
				$destination = $this->session->userdata('airport_to');
				
				$data['excursion'] = $this->Home_Model->search_excursion($destination);
				$data['hotel_id'] = $hotel_id;
				$data['room_id'] = $room_id;
				
				$city_val = $this->session->userdata('airport_to');
				$data['cruise'] = $this->Home_Model->cruise_search($city_val);
				
			   $this->load->view('cruise_flight_hotel/flight_hotel_extrass',$data);
		   }
		   function cruise_flight_det2($cruise_id,$hotel_id,$room_id)
			{
				$data['cruise_id'] = $cruise_id;
				$data['cruise_name'] = $this->Home_Model->get_cruisename($cruise_id);
				$data['cruise_cab'] = $this->Home_Model->cruise_cab($cruise_id);
				$data['cab_gallery'] = $this->Home_Model->cabin_gallery($cruise_id);
				$data['deck_gallery'] = $this->Home_Model->deck_gallery($cruise_id);
				$data['entertain_gallery'] = $this->Home_Model->entertainment_gallery($cruise_id);
				$data['luxor_gallery'] = $this->Home_Model->luxor_gallery($cruise_id);
				$data['sight_gallery'] = $this->Home_Model->sight_gallery($cruise_id);
				
				$data['deck_plan'] = $this->Home_Model->deck_plan($cruise_id);
				$data['itinerary'] = $this->Home_Model->cruise_itinerary($cruise_id);
				$data['entertain'] = $this->Home_Model->cruise_entertain($cruise_id);
				$data['luxor'] = $this->Home_Model->cruise_luxor($cruise_id);
				$data['sights'] = $this->Home_Model->cruise_sights($cruise_id);
				$data['hotel_id'] = $hotel_id;
				$data['room_id'] = $room_id;
				$this->load->view('cruise_flight_hotel/cruise_inner',$data);
			}
			function cruise_flight_extrass2($cruise_id,$hotel_id,$room_id)
			{
				$data['cruise_id'] = $cruise_id;
				$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
				
				$seg_id = $this->session->userdata('seg_id');
				$f_priceid = $this->session->userdata('f_priceid');
				
				$seg_id_r = $this->session->userdata('seg_id_r');
				
				$f_priceid_r = $this->session->userdata('f_priceid_r');
				 
				$data['seg_id'] = $seg_id;
				$data['f_priceid'] = $f_priceid;
				$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
				
				$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
				
				
				$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
				
				$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
				
				$city_val = $this->session->userdata('airport_to');
				
				$data['excursion'] = $this->Home_Model->search_excursion($city_val);
				$data['hotel_id'] = $hotel_id;
				$data['room_id'] = $room_id;
				$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
				$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
				$this->load->view('cruise_flight_hotel/cruise_extrass',$data);
			}
			function transfer_cruise_flight_hotel($cruise_id,$hotel_id,$room_id)
		   {
				$seg_id = $this->session->userdata('seg_id'); 
				$f_priceid = $this->session->userdata('f_priceid');
				
				$seg_id_r = $this->session->userdata('seg_id_r');
				
				$f_priceid_r = $this->session->userdata('f_priceid_r');
				
				$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
				
				$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
				
				
				$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
				
				$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
				
			
				$destination = $this->session->userdata('airport_to');
				
				
				$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
				
				$data['excursion'] = $this->Home_Model->search_excursion($destination);
				
				$data['hotel_id'] = $hotel_id;
				$data['room_id'] = $room_id;
				$data['cruise_id'] = $cruise_id;
				$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
				$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
				
				$this->load->view('cruise_flight_hotel/cruise_flight_hotel_transfer',$data);
		   }
		   function cruise_excursion_add2($ex_id,$cruise_id,$hotel_id,$room_id)
		   {
				$seg_id = $this->session->userdata('seg_id'); 
				$f_priceid = $this->session->userdata('f_priceid');
				
				$seg_id_r = $this->session->userdata('seg_id_r');
				
				$f_priceid_r = $this->session->userdata('f_priceid_r');
				
				$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
				
				$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
				
				
				$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
				
				$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
				
				$destination = $this->session->userdata('airport_to');
				
				$data['excursion'] = $this->Home_Model->search_excursion($destination);
				
				$data['excursion_det'] = $this->Home_Model->get_excursion_det($ex_id);
				$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
				
				$data['hotel_id'] = $hotel_id;
				$data['room_id'] = $room_id;
				$data['cruise_id'] = $cruise_id;
				$data['ex_id'] = $ex_id;
				$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
				$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
			
				$this->load->view('cruise_flight_hotel/cruise_flight_hotel_activity',$data);
		   }
		   function flight_hotel_cruise_book($hotel_id,$room_id,$cruise_id)
		   {
			   $data['hotel_id'] = $hotel_id;
			   $data['room_id'] = $room_id;
			   $data['cruise_id'] = $cruise_id;
			   $seg_id = $this->session->userdata('seg_id'); 
				$f_priceid = $this->session->userdata('f_priceid');
				
				$seg_id_r = $this->session->userdata('seg_id_r');
				
				$f_priceid_r = $this->session->userdata('f_priceid_r');
				
				$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
				
				$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
				
				
				$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
				
				$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
				$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
				$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
				$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
				
				$this->load->view('cruise_flight_hotel/cruise_flight_hotel_booking',$data);
		   }
		   function flight_hotel_cruise_transfer_book($hotel_id,$room_id,$cruise_id)
		   {
			   $data['hotel_id'] = $hotel_id;
			   $data['room_id'] = $room_id;
			   $data['cruise_id'] = $cruise_id;
			   $seg_id = $this->session->userdata('seg_id'); 
				$f_priceid = $this->session->userdata('f_priceid');
				
				$seg_id_r = $this->session->userdata('seg_id_r');
				
				$f_priceid_r = $this->session->userdata('f_priceid_r');
				
				$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
				
				$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
				
				
				$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
				
				$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
				$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
				$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
				$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
				
				$this->load->view('cruise_flight_hotel/cruise_flight_hotel_trans_booking',$data);
		   }
		   function flight_hotel_cruise_act_book($hotel_id,$room_id,$cruise_id,$ex_id)
		   {
			   $data['hotel_id'] = $hotel_id;
			   $data['room_id'] = $room_id;
			   $data['cruise_id'] = $cruise_id;
			   $data['ex_id'] = $ex_id;
			   $data['ex_det'] = $this->Home_Model->get_excursion_det($ex_id);
			   $seg_id = $this->session->userdata('seg_id'); 
				$f_priceid = $this->session->userdata('f_priceid');
				
				$seg_id_r = $this->session->userdata('seg_id_r');
				
				$f_priceid_r = $this->session->userdata('f_priceid_r');
				
				$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
				
				$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
				
				
				$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
				
				$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
				$data['det'] = $this->Home_Model->youtravel_hotel_det1($hotel_id);
		
				$data['room_det'] = $this->Home_Model->youtravel_hotel_roomdet($hotel_id,$room_id);
				$data['cruise_name'] = $this->Home_Model->get_cruisedet($cruise_id);
				
				$this->load->view('cruise_flight_hotel/flight_hotel_cruise_act_book',$data);
		   }
		function search_hotel_flight()
		{
			//echo "<pre>"; print_r($this->session->userdata); exit;
			$city1=$this->session->userdata('citycode');
			if($city1=="")
			{
				$city1=$this->input->post('citycode');
				
			}
			//$expcicode=explode(",",$city1);
			
			//$citi=$expcicode[0];
			//$cntry=$expcicode[1];
				//echo $city1; exit;
			
			$row1=$this->Home_Model->cityCode_gta($city1);
			if($row1 !='')
			{
				$city_gta_code=trim($row1->cityCode);
				$destinationType=trim($row1->destinationType);
				$countrycode=trim($row1->countryCode);
			}
			$roomcount=$this->session->userdata('roomcount');
			$roomusedtypeval=$this->session->userdata('roomusedtype');
			//$roomusedtype=$roomusedtypeval[0];
			$roomusedtype = $roomusedtypeval;
			//$city=$city_gta_code;			
			$sec_res=$this->session->userdata('sec_res');	
			//$cin=$this->session->userdata('sec_res');	
			//$cout=$this->session->userdata('sec_res');	
			$check_in = $this->input->post('sd');
			$check_out = $this->input->post('ed');		
			$costval=$this->input->post('costtype');
			$out=explode("/",$this->input->post('ed'));
			$cout=$out[2]."-".$out[1]."-".$out[0];
			$in=explode("/",$this->input->post('sd'));
			$cin=$in[2]."-".$in[1]."-".$in[0];
			$diff = strtotime($cout) - strtotime($cin);
			
			$data['rtype']=$roomusedtype;
			$child=0;
			$adult=0;
			$noofroom1=0;
				/*for($i=0;$i< count($roomcount);$i++)
				{
				
					switch($roomusedtypeval[$i])
					{
						case 1:
							$adult=$adult+(1*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 3:				
							$adult=$adult+(2*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 9:
							$adult=$adult+(4*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 6:
							$adult=$adult+(2*$roomcount[$i]);
							$noofroom1=$noofroom1+$roomcount[$i];
						break;
						
						case 5:
							 $adult=$adult+(1*$roomcount[$i]);
							 $noofroom1=$noofroom1+$roomcount[$i];
					   break;
					   
					   case 8:
							 $adult=$adult+(3*$roomcount[$i]);
							 $noofroom1=$noofroom1+$roomcount[$i];
					   break;
					   
					   case 4:												
							 $child=$child+(1*$roomcount[$i]);
							 $adult=$adult+(2*$roomcount[$i]);	
							 $noofroom1=$noofroom1+$roomcount[$i]; 
						break;
						
						case 7:
							$child=$child+(1*$roomcount[$i]);
							$adult=$adult+(2*$roomcount[$i]);								
							$noofroom1=$noofroom1+$roomcount[$i];					
						break;
					}
										
				}*/
							
					/*$data['child']=$child;
					$data['adult']=$adult;
					$data['nor']=$noofroom1;
					$data['room']=$noofroom=$noofroom1;	*/	
					$data['child']='0';
					$data['adult']= '1';
					$data['nor']= $this->session->userdata('nor');
					$data['room']= '1';	
			
			$sec   = $diff % 60;
			$diff  = intval($diff / 60);
			$min   = $diff % 60;
			$diff  = intval($diff / 60);
			$hours = $diff % 24;
			$days  = intval($diff / 24);
			$data['dt']=$days;
			//,'nor'=>$data['nor'],
			$this->session->set_userdata(array('check_in_new'=>$check_in,'dt'=>$days,'adult'=>$data['adult'],'child'=>$data['child'],
			'cin'=>$cin,'cout'=>$cout,'rtype'=>$data['rtype']));
			//echo $adult; exit;
			//$this->crs_availability_new($cin,$cout,$days,$sec_res);
			$country_travel = $this->session->userdata('country_travel');
			$destination = $this->session->userdata('destination');
			$resort = $this->session->userdata('resort');
			$this->hotel_search_youtravel_flight($country_travel,$destination,$resort);
	
			//exit;
			redirect('home/search_result_new','refresh');
		
		}
		function crs_availability_new()
		{
			$hotelName = $this->session->userdata('hotel_name');
			$roomusedtype = $this->session->userdata('roomusedtype');
			//print_r($roomusedtype); exit;
			$roomcount = $this->session->userdata('roomcount');
			   $condition='';
			   $sel='';
			   for($rm=0;$rm< count($roomcount);$rm++)
			   {
				if($roomusedtype==1 )
				{
					if(!empty($hotelName) && $hotelName !='Enter Hotel name')
					{
						$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
						
					}
				 $condition .= " AND b.single_room > 0";
				 $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
				 $sel .= ",b.single_room";
				 
				}
				if($roomusedtype==3)
				{
					if(!empty($hotelName))
					{
						$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
						
					}
				 $condition .= " AND b.twin_room > 0";
				 $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
				 $sel .= ",b.twin_room";
				}
				 if($roomusedtype==4)
				{
					if(!empty($hotelName))
					{
						$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
						
					}
				 $condition .= " AND b.twin_room > 0";
				 $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
				 $sel .= ",b.twin_room";
				}
				 if($roomusedtype==7)
				{
					if(!empty($hotelName))
					{
						$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
						
					}
				 $condition .= " AND b.twin_room > 0";
				 $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
				 $sel .= ",b.triple_room";
				}
				if($roomusedtype==8)
				{
					if(!empty($hotelName))
					{
						$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
						
					}
				 $condition .= " AND b.triple_room > 0";
				 $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
				 $sel .= ",b.triple_room";
				}
				if($roomusedtype==9)
				{
					if(!empty($hotelName))
					{
						$condition .= " AND a.name LIKE '$hotelName%' OR a.name LIKE '%$hotelName' OR a.name LIKE '%$hotelName%'";
						
					}
				 $condition .= " AND b.quad_room > 0";
				 $condition .= " AND b.check_in < '$cin' AND b.check_out > '$cout'";
				 $sel .= ",b.quad_room";
				}
			   }
			   $cin=$this->session->userdata('cin');
			  $cout=$this->session->userdata('cout');
			  $city=$this->session->userdata('citycode'); 
				//echo $city; exit;
				//echo "SELECT a.*,b.categoryname,b.breakfast,b.roomdescription $sel FROM hotel_details AS a INNER JOIN room_details AS b ON a.hotel_id=b.hotel_id  WHERE  a.city='$city' AND a.status='active'  $condition GROUP BY b.hotel_id"; exit;
			 $querydb=$this->db->query("SELECT a.*,b.categoryname,b.breakfast,b.roomdescription $sel FROM hotel_details AS a INNER JOIN room_details AS b ON a.hotel_id=b.hotel_id  WHERE  a.city ='$city' AND a.status='active'  $condition GROUP BY b.hotel_id");
			
		
				
				   $resultdb=$querydb->result();
				   //echo "<pre>"; print_r($resultdb);  exit;
				   $rw= $querydb->num_rows(); 	
				   for($i=0;$i < count($resultdb); $i++)
				   {
					   
					   $cityCode = $resultdb[$i]->city;
						$hotel_id=$resultdb[$i]->hotel_id;
						$itemCode=$resultdb[$i]->hotel_code;
						$itemVal=$resultdb[$i]->name;
						$starVal=$resultdb[$i]->rating;
						//$price = $resultdb[$i]->single_room;
						$rate = $this->Home_Model->get_hotelprice($hotel_id);
						if($rate->single_room !='0')
						{
							$price = $rate->single_room;
						}
						else
						{
							$price = '24';
						}
						$roomDesc='';
						if(isset($resultdb[$i]->single_room))
						{
						$roomDesc.="Single -".$resultdb[$i]->categoryname."+";
						}
						if(isset($resultdb[$i]->twin_room))
						{
						$roomDesc.="Twin -".$resultdb[$i]->categoryname."+";
						}
						if(isset($resultdb[$i]->triple_room))
						{
						$roomDesc.="Triple -".$resultdb[$i]->categoryname."+";
						}
						if(isset($resultdb[$i]->quad_room))
						{
						$roomDesc.="Quad -".$resultdb[$i]->categoryname."+";
						}
			
			
					 $roomDesc = substr($roomDesc, 0, -1); 
			
						$meal = $resultdb[$i]->breakfast;
						if($meal == 0)
		
						{
							$mealsval = "Room Only";
						}
						else
						{
							$mealsval = $meal;
						}
				
						$roomdescCode = '';
						$ConfirmationVal = $resultdb[$i]->status;
					
						$desc =$resultdb[$i]->description;
						if($resultdb[$i]->image != '')
						{
						$image = WEB_DIR_ADMIN.'hotel_logo/'.$resultdb[$i]->image;
						}
						else
						{
							$image = WEB_DIR.'supplier_logo/noimage.jpg';
						}
						$supplier_id=$resultdb[$i]->supplier_id;
					
					  $pernight='1';
						if(isset($resultdb[$i]->single_room))
						{
							$pernight  =  $resultdb[$i]->single_room;
						}
						if(isset($resultdb[$i]->twin_room))
						{
							$pernight  = $pernight+ $resultdb[$i]->twin_room;
						}
						if(isset($resultdb[$i]->triple_room))
						{
							$pernight  =  $pernight+$resultdb[$i]->triple_room;
						}
						if(isset($resultdb[$i]->quad_room))
						{
							$pernight  =  $pernight+$resultdb[$i]->quad_room;
						}
		
					
						
						$currencyVal = 'GBP';
						$curtype='GBP';
							$dateFromValc = '';
						$dateToValc = '';  	  
						$dateFromTimeValc = '';  	  
						$dateToTimeVal = ''; 
						$serviceval = '';
							  $finalcurval ='';
							  $cancelCodeVal='';
							  $purTokenVal='';
			
			$roomDesc11 = $roomDesc;
			$pernight11 = $pernight;	
					
			 //$com_rate=$this->Agent_Model->comp_info($hotel_id);
			$com_rate='';
			   if(isset($com_rate))
			   {
				 if($com_rate=="")
				 {
				  $com_rate=0;
				 }
				 else
				 {
			
					  $com_rate=$com_rate[0]->comprate;
				  }
			   }
				 $hotel_mark=0;
				 $admark=0;
				//$hotel_markup=$this->Agent_Model->markup_supplier($hotel_id);
				$hotel_markup='';
				if($hotel_markup!="")
				{
				$hotel_markup_type=$hotel_markup->type;
		
				 if($hotel_markup_type=='amt')
				 {
				$hotel_mark=$hotel_markup->amount;
				  
				  
				 }
				 else
				 {
				$markup=$hotel_markup->markup;
				 $hotel_mark=$pernight11*$markup/100;
				 
				 }
				 
				 
			   
			   
				}
				  $api4="gta";
				  $common_commission=$this->Home_Model->get_common_markup($api4);
				  $admark=$common_commission*$pernight11/100;
			  
			  //$finalperNightValh= $pernight11+$hotel_mark+$admark+$com_rate;
			  $night=$this->session->userdata('dt');	
			  //$finalNightValh = $finalperNightValh*$night;
			  
			  $finalNightValh = $price;
			  $finalperNightValh= $price;
			  //echo $finalNightValh."<br />";
			  
					
			  $api4='crs';
			  $sec_res = $this->session->userdata('sessionid');
					$this->Home_Model->insert_search_result_crs($sec_res,$api4,$cityCode,$itemCode,$itemVal,$starVal,$finalperNightValh,$finalNightValh,$currencyVal,$roomDesc11,$mealsval,$dateFromValc,$dateToValc,$dateFromTimeValc,$dateToTimeVal,$serviceval,$finalcurval,$cancelCodeVal,$purTokenVal,'0','0',$roomdescCode,$ConfirmationVal,$cin,$cout,'0',$image,$desc);
			
			}
				
						  
			
		}
	function hotel_availabilitynew()
	{
		//echo $from; exit;
		$res = $this->Home_Model->hotel_availability($from);
		if($res != false)
		{
				
			foreach($res as $rw)
			{
				$this->Home_Model->insert_search($rw->hotel_id,$sessionid);
			}
			//redirect('home/hotel_flight_result/'.$sessionid.'','refresh');
		}
		/*else
		{
			redirect('home/hotel_flight_result/'.$sessionid.'','refresh');
		}*/
	}
	function package_flighthotel()
	{
		$hotel_id = $this->input->post('hotel_id');
		$seg_id = $this->input->post('seg_id'); 
		$f_priceid = $this->input->post('f_priceid');
		
		$seg_id_r = $this->input->post('seg_id_r');
		
		$f_priceid_r = $this->input->post('f_priceid_r');
		 
		$data['seg_id'] = $seg_id;
		$data['f_priceid'] = $f_priceid;
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$this->load->view('flight_hotel/flight_description',$data);
		
	}
	function flight_paymentgateway()
	{
		$pid = $this->input->post('pid'); 
		$passenger_name = $this->input->post('passenger_name');
		$total = $this->input->post('total');
		$pid2 = $this->input->post('pid2');
		$total2 = $this->input->post('total2');
		$this->session->set_userdata(array('pid'=>$pid,'pid2'=>$pid2,'passenger_name'=>$passenger_name,'total'=>$total,'total2'=>$total2));
		$data['total'] = $total;
		$data['sessionid'] = $this->session->userdata('sessionid');
		$this->load->view('flight_hotel/payment_flight',$data);
	}
	function flight_description_book()
	{
		//$this->load->view('agent_search/flight_search_description_book');
		$depdate = $this->session->userdata('depdate');
		$retdate = $this->session->userdata('retdate');
		$air_from = $this->session->userdata('air_from');
		$air_to = $this->session->userdata('air_to');
		$class = $this->session->userdata('class');
		$adult = $this->session->userdata('adult_flight');
		$child = $this->session->userdata('child_flight');
		$infant = $this->session->userdata('infant_flight');
		$pid = $this->session->userdata('pid'); 
		$pid2 = $this->session->userdata('pid2'); 
		
		$passenger_name = $this->session->userdata('passenger_name');
		$segment='';
		$details = '';
		$q2=mysql_query("select * from flight_price_details where pid='".$pid."' ");
		$row2 = mysql_fetch_array($q2);
		$idprop = $row2['idprop'];
		$q4=mysql_query("select * from segments where idprop='".$idprop."'");
			while($row5 = mysql_fetch_array($q4)){
				$segment .= '<SEGMENT idseg="'.$row5['idseg'].'" />';
		
				$details .='<SEG_DETAIL nbseg="'.$row5['nbseg'].'" idseg="'.$row5['idseg'].'" codseg="'.$row5['codseg'].'"
		nbopt="'.$row5['nbopt'].'" datdep="'.$row5['datdep'].'" timdep="'.$row5['timdep'].'" datarr="'.$row5['datarr'].'" timarr="'.$row5['timarr'].'"
		from="'.$row5['from'].'" to="'.$row5['to'].'" airline="'.$row5['airline'].'" flnb="'.$row5['flnb'].'" />';	
				}
		//$URL='http://justgo.ro/xml/api.html/';
		$URL='http://www.justgo.ro/xml/api.html';
		
		$user = 'xml@egyptspirit.co.uk';
		$pass = '*GadsyaHkdaoy*';
		
		$data = '<JUSTGO>
		<HEADER>
		<USER login="'.$user.'" key="'.$pass.'"/>
		<OPERATION>REQFLTBOOK</OPERATION>
		</HEADER>
		<REQUEST_FLT_BOOK>
		<BOOK type="FLIGHT" idprop="'.$idprop.'" class="'.$class.'" />
		<NBPASSENGERS ad="'.$adult.'" ch="'.$child.'" be="'.$infant.'" />
		<PASSENGERLIST>
		<PASSENGER lname="Popescu" fname="Ion" dob="010472"
		salutation="MR" sex="M" passpnb="1234567890" passppl="Bucuresti"
		passpdat="241212" idcard="9876543210" nat="Romana" cardnb="123321"
		cardname="Flying Blue" />
		</PASSENGERLIST>
		<PRICE prad="'.$_POST['prad'].'" prch="'.$_POST['prch'].'" prbe="'.$_POST['prbe'].'" total="'.$_POST['total'].'"
		taxes="'.$_POST['taxes'].'" taxad="'.$_POST['taxad'].'" taxch="'.$_POST['taxch'].'" taxbe="'.$_POST['taxbe'].'" />
		<ITINERARIES>
		<ITINERARY code="DEP" datdep="'.$depdate.'" from="'.$air_from.'" to="'.$air_to.'" />
		</ITINERARIES>
		<SEGMENTS>'.$segment.'</SEGMENTS>
		<DETAILS>'.$details.'</DETAILS>
		</REQUEST_FLT_BOOK>
		</JUSTGO>';
		//echo  $data;exit;
		$xml = 'xml=' . urlencode($data);
		$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$headers[] = 'Connection: Keep-Alive';
		$headers[] = 'Content-type:application/x-www-form-urlencoded;charset=UTF-8';



		$process = curl_init($URL);
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
	      
		curl_setopt($process, CURLOPT_ENCODING , '');
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
	    
		curl_setopt($process, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
	       
		$xmls = curl_exec($process);
		curl_close($process);
		
		//print_r($xmls);	 exit;
		$error_message='';
		$dom = new DOMDocument();
		$dom->loadXML($xmls);

		$ErrorList = $dom->getElementsByTagName( "ERROR" );
		if($ErrorList)
		{
			$this->load->view('flight_hotel/flight_description_error');
		}
		else
		{
			$seg_id = $this->input->post('seg_id'); 
			$f_priceid = $this->input->post('f_priceid'); 
			$name = $this->input->post('passenger_name');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$pin = $this->input->post('pin');
			$mobile = $this->input->post('mobile');
			$email_id = $this->input->post('email_id');
			$book_id = $this->Home_Model->insert_flight_bookdetails($name,$city,$state,$pin,$mobile,$email_id);
			redirect('home/flight_search_description_book/'.$seg_id.'/'.$f_priceid.'/'.$book_id.'','refresh');
		}
	}
	function flight_search_description_book($seg_id,$f_priceid,$book_id)
	{
		$data['seg_id'] = $seg_id;
		$data['f_priceid'] = $f_priceid;
		$data['flight_det'] =$dat= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		$data['passenger_det'] = $this->Home_Model->flight_passenger_det($book_id);
		$this->load->view('flight_hotel/flight_description_book',$data);
		//$this->load->view('agent_search/flight_search_description',$data);
	}
	function cruise_flight_load()
	{
		$sec_res=session_id();
		
		$data['type']		= $type 		= $this->input->post('flight_type_cf');
		$data['from']		= $from 		= $this->input->post('airport_from_cf');
		$data['to']			= $to 			= $this->input->post('airport_to_cf');
		$data['departure']	= $departure 	= $this->input->post('checkin_cf');
		$data['return']		= $return 		= $this->input->post('checkout_cf');
		$data['adult']		= $adult 		= $this->input->post('adult_cf');
		$data['child']		= $child 		= $this->input->post('child_cf');
		$data['infant']		= $infant 		= $this->input->post('infant_cf');
		$data['class']		= $class2 		= $this->input->post('class_cf');
		
		$this->session->set_userdata(array('air_from'=>$from,'air_to'=>$to,'depdate'=>$departure,'retdate'=>$return,'adult_flight'=>$adult,'child_flight'=>$child,'infant_flight'=>$infant,'sec_res'=>$sec_res,'class'=>$class2,'type'=>$type,'sessionid'=>$sec_res));
		$this->load->view('cruise_flight/load_cruise_flight',$data);
	}
	function cruise_flight_availability()
	{
		$sessionid=$this->session->userdata('sessionid');
		$this->Home_Model->delete_flight_cruise_result($sessionid);
		
		
		
		$airport_from = $this->input->post('airport_from');
		$airport_to = $this->input->post('airport_to');
		
		$air_from = $this->Home_Model->get_airport_code($airport_from);  
		$air_to = $this->Home_Model->get_airport_code($airport_to); 
		$type = $this->input->post('type');
		$departure = $this->input->post('departure'); 
		
		$date_from = explode('/',$departure);
		$date_from_db = $date_from[2].'-'.$date_from[1].'-'.$date_from[0]; 
			
		$dep = explode('/',$departure);
		$year = substr($dep[2],2,4);
		$depdate = $dep[0].$dep[1].$year;
		$return = $this->input->post('return');
		if($return !='')
		{
			$ret = explode('/',$return);
			$year_return = substr($ret[2],2,4);
			$retdate = $ret[0].$ret[1].$year_return; 
			
			$date_to = explode('/',$return);
			$date_to_db = $date_to[2].'-'.$date_to[1].'-'.$date_to[0]; 
		}
		else
		{
			$retdate = '';
			$date_to_db = '';
		}
		$adults = $this->input->post('adult_fl');
		$child = $this->input->post('child');
		$infant = $this->input->post('infant');
		$class = $this->input->post('class');
		//$this->session->set_userdata(array('air_from'=>$from,'air_to'=>$to));
		
		//$user = 'greenenergyapi@hotmail.com';
		//$pass = '*DAudnau-dg$hdsH*';
		$user = 'xml@egyptspirit.co.uk';
		$pass = '*GadsyaHkdaoy*';
		
		/*mysql_query("delete from segments where sess_id='".$sessionid."'");
		mysql_query("delete from flight_price_details where criteria_id='".$sessionid."'");
		
			//$URL='http://test.justgo.ro/xml/api.html/';
			$URL='http://www.justgo.ro/xml/api.html';
			
		 $data = '<JUSTGO>
						<HEADER>
							<USER login="'.$user.'" key="'.$pass.'"/>
							<OPERATION>REQFLTAVAIL</OPERATION>
						</HEADER>
						<REQUEST_FLT_AVAIL from="'.$air_from.'" to="'.$air_to.'" class="'.$class.'" type="'.$type.'" depdate="'.$depdate.'" retdate="'.$retdate.'">
							<NBPASSENGERS ad="'.$adults.'" ch="'.$child.'" be="'.$infant.'"/>
						</REQUEST_FLT_AVAIL>
					</JUSTGO>';
		  $xml = 'xml=' . urlencode($data); 
		$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$headers[] = 'Connection: Keep-Alive';
		$headers[] = 'Content-type:application/x-www-form-urlencoded;charset=UTF-8';



		$process = curl_init($URL);
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
	      
		curl_setopt($process, CURLOPT_ENCODING , '');
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
	    
		curl_setopt($process, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
	       
		$xmls = curl_exec($process);
		curl_close($process);
	      //print_r($xmls); exit;

	 $result = simplexml_load_string($xmls);
	//print_r($result);exit;
		foreach($result as $row ){
			$iter=$row->ITINERARY;					
			$prop = $row->PROP;
			$info_resp = $row->INFO_RESP;
			$curency = $info_resp['currency'];
			foreach($prop as $prode){
			$airline = $prode['airline'];
			$idprop = $prode['idprop'];
			$price = $prode->PRICE;
			 $prad =$price['prad'];
			 $prch = $price['prch'];
			 $prbe = $price['prbe'];
			 $total = $price['total'];
			 $taxes = $price['taxes'];
			 $taxad = $price['taxad'];
			 $taxch = $price['taxch'];
			 $taxbe = $price['taxbe'];
			$segdetail = $prode->SEG_DETAIL;
			//echo "<pre>";print_r($price);
			mysql_query("INSERT INTO `flight_price_details` (`criteria_id`,`currency`,`airline`, `idprop`, `prad`, `prch`, `prbe`, `total`, `taxes`, `taxad`, `taxch`, `taxbe`,`airport_from`,`airport_to`,`departure`,`return`) VALUES ('$sessionid','$curency', '$airline', '$idprop', '$prad', '$prch', '$prbe', '$total', '$taxes', '$taxad', '$taxch', '$taxbe','$airport_from','$airport_to','$date_from_db','$date_to_db')");
				$fpid = mysql_insert_id();
		foreach($segdetail as $row1){
			$nbseg = $row1['nbseg'];
			$idseg  = $row1['idseg'];
			$codseg  = $row1['codseg'];
			$nbopt  = $row1['nbopt'];
			$datdep  = $row1['datdep'];
			$timdep  = $row1['timdep'];
			$datarr  = $row1['datarr'];
			$timarr  = $row1['timarr'];
			$from  = $row1['from'];
			$to  = $row1['to'];
			$airline1  = $row1['airline'];
			$flnb  = $row1['flnb'];
			$q1 = mysql_query("INSERT INTO segments (`idprop`,`nbseg`, `idseg`, `codseg`, `nbopt`, `datdep`, `timdep`, `datarr`, `timarr`, `from`, `to`, `airline`, `flnb`,`sess_id`,`airport_from`,`airport_to`,`departure`,`return`,`f_priceid`) VALUES ('$idprop','$nbseg', '$idseg', '$codseg', '$nbopt', '$datdep', '$timdep', '$datarr', '$timarr', '$from', '$to', '$airline1', '$flnb','$sessionid','$from','$to','$date_from_db','$date_to_db','$fpid')");  
		
			}
		
		
	  }
	}*/
	$this->flight_availability_elsseyarres($date_from_db,$date_to_db,$air_from,$air_to,$adults,$child,$infant);
	//$this->flight_availability_elsseyarres_alternate($date_from_db,$date_to_db,$air_from,$air_to,$adults,$child,$infant);
	$this->session->set_userdata(array('adults_count'=>$adults,'child_count'=>$child,'infant_count'=>$infant,'date_from_db'=>$date_from_db)); 
	   $this->cruise_availability($this->session->userdata('air_to'),$sessionid); 
	  redirect('home/cruise_flight_result/'.$sessionid.'','refresh');
	}
	function cruise_availability($from,$sessionid)
	{
		
		$res = $this->Home_Model->cruise_availability($from);
		if($res != false)
		{
				
			foreach($res as $rw)
			{
				$this->Home_Model->insert_search_cruise($rw->cruise_id,$sessionid);
			}
			//redirect('home/hotel_flight_result/'.$sessionid.'','refresh');
		}
		else
		{
			redirect('home/cruise_flight_result/'.$sessionid.'','refresh');
		}
	}
	function cruise_flight_result($sessionid)
	{
		//echo $this->session->userdata('air_from'); exit;
		$data['sessionid']			= $sessionid;
		$cruise_id 					= $this->Home_Model->get_cruise($sessionid);
		$data['hotel_res']  		= $hotel_res 		 = $this->Home_Model->get_cruise_det($cruise_id);
		$data['price'] 				= $price 			 = $this->Home_Model->get_cruise_price($cruise_id);
		$data['cruise_name'] 		= $cruise_name 		 = $this->Home_Model->get_cruisename($cruise_id);
		$data['cruise_cab'] 		= $cruise_cab 		 = $this->Home_Model->cruise_cab($cruise_id);
		$data['cab_gallery'] 		= $cab_gallery 		 = $this->Home_Model->cabin_gallery($cruise_id);
		$data['deck_gallery'] 		= $deck_gallery 	 = $this->Home_Model->deck_gallery($cruise_id);
		$data['entertain_gallery']  = $entertain_gallery = $this->Home_Model->entertainment_gallery($cruise_id);
		$data['luxor_gallery'] 		= $luxor_gallery 	 = $this->Home_Model->luxor_gallery($cruise_id);
		$data['sight_gallery'] 		= $sight_gallery 	 = $this->Home_Model->sight_gallery($cruise_id);
		$data['deck_plan'] 			= $deck_plan 		 = $this->Home_Model->deck_plan($cruise_id);
		$data['itinerary'] 			= $itinerary 		 = $this->Home_Model->cruise_itinerary($cruise_id);
		$data['entertain'] 			= $entertain 		 = $this->Home_Model->cruise_entertain($cruise_id);
		$data['luxor'] 				= $luxor 		 	 = $this->Home_Model->cruise_luxor($cruise_id);
		$data['sights'] 			= $sights 			 = $this->Home_Model->cruise_sights($cruise_id);
		$air_from = $this->session->userdata('air_from');
		$air_to = $this->session->userdata('air_to');
		$data['air_from'] = $air_from1 = $this->Home_Model->get_airport_code($air_from);  
		//echo $air_from1; exit;
		$data['air_to'] = $this->Home_Model->get_airport_code($air_to); 
		$this->load->view('cruise_flight/search_result',$data);
	}
	function package_flight_cruise()
	{
		$hotel_id = $this->input->post('hotel_id');
		$seg_id = $this->input->post('seg_id'); 
		$f_priceid = $this->input->post('f_priceid');
		
		$seg_id_r = $this->input->post('seg_id_r');
		
		$f_priceid_r = $this->input->post('f_priceid_r');
		 
		$data['seg_id'] = $seg_id;
		$data['f_priceid'] = $f_priceid;
		$data['flight_det'] =$flight_det= $this->Home_Model->get_flight_details($seg_id,$f_priceid);
		//print_r($flight_det);exit;
		
		$data['flght_det_r'] = $flght_det_r =  $this->Home_Model->get_flight_details_r($seg_id_r,$f_priceid_r);
		
		
		$data['price_det'] = $this->Home_Model->get_flight_fare($f_priceid);
		
		$data['price_det_r'] = $this->Home_Model->get_flight_fare($f_priceid_r);
		
		$this->load->view('cruise_flight/cruise_flight_description',$data);
		
	}
	function cruise_flight_hotel_load()
	{
		/*$sec_res=session_id();
		
		$data['type']		= $type 		= $this->input->post('flight_type_cfh');
		$data['from']		= $from 		= $this->input->post('airport_from_cfh');
		//$data['to']			= $to 			= $this->input->post('airport_to_cfh');
		$data['departure']	= $departure 	= $this->input->post('checkin_cfh');
		$data['return']		= $return 		= $this->input->post('checkout_cfh');
		$data['adult']		= $adult 		= $this->input->post('adult_cfh');
		$data['child']		= $child 		= $this->input->post('child_cfh');
		$data['infant']		= $infant 		= $this->input->post('infant_cfh');
		$data['class']		= $class2 		= $this->input->post('class_cfh');
		$data['to']= $to1 = $this->input->post('airport_to_cfh');
		$to_air = explode(',',$to1);
		$to = $to_air[0];
		$this->session->set_userdata(array('air_from'=>$from,'air_to'=>$to,'airport_to'=>$to1,'depdate'=>$departure,'retdate'=>$return,'adult_flight'=>$adult,'child_flight'=>$child,'infant_flight'=>$infant,'sec_res'=>$sec_res,'class'=>$class2,'type'=>$type,'sessionid'=>$sec_res));*/
		$sec_res=session_id();
		$data['room_cnt'] = $room_count = $this->input->post('room_count3');
		//echo "<pre>"; print_r($room_count); exit;
		$data['adult'] = $adult = $this->input->post('adult3');
		$data['child'] = $child = $this->input->post('child3');
		$child_age=$this->input->post('child_age3');
		//echo "<pre>"; print_r($adult); 
		//echo $adult[1]; exit;
		if($adult[0] != '')
		{
			$ADLTS_1 = $adult[0];
			$adult = $adult[0];
			$child = $child[0];
		}
		if(isset($adult[1]) != '')
			{
				$ADLTS_2 = $adult[1]; 
				$adult = $adult[1];
				$child = $child[1];
			}
		if(isset($adult[2]) != '')
			{
				$ADLTS_3 = $adult[2];
				$adult = $adult[2];
				$child = $child[2];
			}
		
		else
		{
			$ADLTS_2 = '0';
			$ADLTS_3 = '0';
		}
		
		if(isset($child[0]))
		{
			$CHILD_1 = $child[0];
			
		}
		else
		{
			$CHILD_1 = '0';
		}
		if(isset($child[1]))
		{
			$CHILD_2 = $child[1];
		}
		else
		{
			$CHILD_2 = '0';
		}
		if(isset($child[2]))
		{
			$CHILD_3 = $child[2];
		}
		else
		{
			$CHILD_3 = '0';
		}
		//echo $ADLTS_2; exit;
		//print_r($child_age);
		$ChildAgeR1C1 = $child_age[0];
		$ChildAgeR1C2 = $child_age[1];
		$ChildAgeR2C1 = $child_age[2];
		$ChildAgeR2C2 = $child_age[3];
		$ChildAgeR3C1 = $child_age[4];
		$ChildAgeR3C2 = $child_age[5];
		
		$data['type']= $type = $this->input->post('flight_type_cfh');
		$data['from']= $from = $this->input->post('airport_from_cfh');
		$data['to']= $to1 = $this->input->post('airport_to_cfh');
		$to_air = explode(',',$to1);
		$to = $to_air[0];
		$data['departure']	= $departure 	= $this->input->post('checkin_cfh');
		$data['return']		= $return 		= $this->input->post('checkout_cfh');
		//$data['adult']= $adult = $this->input->post('adult_hf');
		//$data['child']= $child = $this->input->post('child_hf');
		$data['infant']		= $infant 		= $this->input->post('infant_cfh');
		$data['class']		= $class2 		= $this->input->post('class_cfh');
		
		
		$data['All_board'] = $All_board = $this->input->post('All_board_fl');
		$data['roomonly'] = $roomonly = $this->input->post('roomonly_fl');
		$data['self_cat'] = $self_cat = $this->input->post('self_cat_fl');
		$data['bed_break'] = $bed_break = $this->input->post('bed_break_fl');
		$data['half_board'] = $half_board = $this->input->post('half_board_fl');
		$data['full_board'] = $full_board = $this->input->post('full_board_fl');
		$data['all_inclusive'] = $all_inclusive = $this->input->post('all_inclusive_fl');
		$data['villa'] = $villa = $this->input->post('villa_fl');
		
		$data['all_star'] = $all_star = $this->input->post('all_star_fl');
		$data['star1'] = $star1 = $this->input->post('star1_fl');
		$data['star2'] = $star2 = $this->input->post('star2_fl');
		$data['star3'] = $star3 = $this->input->post('star3_fl');
		$data['star4'] = $star4 = $this->input->post('star4_fl');
		$data['star5'] = $star5 = $this->input->post('star5_fl');
		
		
		$this->session->set_userdata(array('nor'=>$room_count,'All_board'=>$All_board,'roomonly'=>$roomonly,'self_cat'=>$self_cat,'bed_break'=>$bed_break,'half_board'=>$half_board,'full_board'=>$full_board,'all_inclusive'=>$all_inclusive,'villa'=>$villa,'all_star'=>$all_star,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'air_from'=>$from,'air_to'=>$to,'airport_to'=>$to1,'depdate'=>$departure,'retdate'=>$return,'adult_flight'=>$adult,'child_flight'=>$child,'infant_flight'=>$infant,'sec_res'=>$sec_res,'class'=>$class2,'type'=>$type,'sessionid'=>$sec_res,'adult_count'=>$data['adult'],'child_count'=>$data['child']));
		$this->load->view('cruise_flight_hotel/load_cruise_flight_hotel',$data);
	}
	function cruise_flight_hotel_availability()
	{
		$sessionid=$this->session->userdata('sessionid');
		$this->Home_Model->delete_flight_cruise_hotel_result($sessionid);
		
		
		
		$airport_from = $this->input->post('airport_from');
		$airport_to = $this->input->post('airport_to');
		
		$air_from = $this->Home_Model->get_airport_code($airport_from);  
		$air_to = $this->Home_Model->get_airport_code($airport_to); 
		$type = $this->input->post('type');
		$departure = $this->input->post('departure'); 
		
		$date_from = explode('/',$departure);
		$date_from_db = $date_from[2].'-'.$date_from[1].'-'.$date_from[0]; 
			
		$dep = explode('/',$departure);
		$year = substr($dep[2],2,4);
		$depdate = $dep[0].$dep[1].$year;
		$return = $this->input->post('return');
		if($return !='')
		{
			$ret = explode('/',$return);
			$year_return = substr($ret[2],2,4);
			$retdate = $ret[0].$ret[1].$year_return; 
			
			$date_to = explode('/',$return);
			$date_to_db = $date_to[2].'-'.$date_to[1].'-'.$date_to[0]; 
		}
		else
		{
			$retdate = '';
			$date_to_db = '';
		}
		$adults = $this->session->userdata('adult_count'); 
		//echo "<pre>"; print_r($adults); exit;
		if(isset($adults[0]))
		{
			$adults1 = $adults[0];
		}
		else
		{
			$adults1 = '1';
		}
		if(isset($adults[1]))
		{
			$adults2 = $adults[1];
		}
		else
		{
			$adults2 = '0';
		}
		if(isset($adults[2]))
		{
			$adults3 = $adults[2];
		}
		else
		{
			$adults3 = '0';
		}
		$adults = $adults1 + $adults2 + $adults3; 
		
		
		//$child = $this->input->post('child');
		$child_count = $this->session->userdata('child_count');
		if(isset($child_count[0]))
		{
			$child1 = $child_count[0];
		}
		else
		{
			$child1 = '0';
		}
		if(isset($child_count[1]))
		{
			$child2 = $child_count[1];
		}
		else
		{
			$child2 = '0';
		}
		if(isset($child_count[2]))
		{
			$child3 = $child_count[2];
		}
		else
		{
			$child3 = '0';
		}
		$child = $child1 + $child2 + $child3;
		//$adults = $this->input->post('adult_fl');
		//$child = $this->input->post('child');
		$infant = $this->input->post('infant');
		$class = $this->input->post('class');
		//$this->session->set_userdata(array('depdate'=>$depdate,'retdate'=>$retdate,'air_from'=>$air_from,'air_to'=>$air_to,'adult_flight'=>$adults,'child_flight'=>$child,'infant_flight'=>$infant,'class'=>$class,'sessionid'=>$sessionid));
		
		/*$user = 'greenenergyapi@hotmail.com';
		$pass = '*DAudnau-dg$hdsH*';*/
		$user = 'xml@egyptspirit.co.uk';
		$pass = '*GadsyaHkdaoy*';
		
		mysql_query("delete from segments where sess_id='".$sessionid."'");
		mysql_query("delete from flight_price_details where criteria_id='".$sessionid."'");
		
			//$URL='http://test.justgo.ro/xml/api.html/';
			$URL='http://www.justgo.ro/xml/api.html';
			
		 $data = '<JUSTGO>
						<HEADER>
							<USER login="'.$user.'" key="'.$pass.'"/>
							<OPERATION>REQFLTAVAIL</OPERATION>
						</HEADER>
						<REQUEST_FLT_AVAIL from="'.$air_from.'" to="'.$air_to.'" class="'.$class.'" type="'.$type.'" depdate="'.$depdate.'" retdate="'.$retdate.'">
							<NBPASSENGERS ad="'.$adults.'" ch="'.$child.'" be="'.$infant.'"/>
						</REQUEST_FLT_AVAIL>
					</JUSTGO>';
		  $xml = 'xml=' . urlencode($data); 
		$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$headers[] = 'Connection: Keep-Alive';
		$headers[] = 'Content-type:application/x-www-form-urlencoded;charset=UTF-8';

	//echo $data;

		$process = curl_init($URL);
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
	      
		curl_setopt($process, CURLOPT_ENCODING , '');
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
	    
		curl_setopt($process, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
	       
		$xmls = curl_exec($process);
		curl_close($process);
	      //print_r($xmls); exit;

	 $result = simplexml_load_string($xmls);
	//print_r($result);exit;
		foreach($result as $row ){
			$iter=$row->ITINERARY;					
			$prop = $row->PROP;
			$info_resp = $row->INFO_RESP;
			$curency = $info_resp['currency'];
			foreach($prop as $prode){
			$airline = $prode['airline'];
			$idprop = $prode['idprop'];
			$price = $prode->PRICE;
			 $prad =$price['prad'];
			 $prch = $price['prch'];
			 $prbe = $price['prbe'];
			 $total = $price['total'];
			 $taxes = $price['taxes'];
			 $taxad = $price['taxad'];
			 $taxch = $price['taxch'];
			 $taxbe = $price['taxbe'];
			$segdetail = $prode->SEG_DETAIL;
			//echo "<pre>";print_r($price);
			//mysql_query("INSERT INTO `flight_price_details` (`criteria_id`,`currency`,`airline`, `idprop`, `prad`, `prch`, `prbe`, `total`, `taxes`, `taxad`, `taxch`, `taxbe`,`airport_from`,`airport_to`,`departure`,`return`) VALUES ('$sessionid','$curency', '$airline', '$idprop', '$prad', '$prch', '$prbe', '$total', '$taxes', '$taxad', '$taxch', '$taxbe','$airport_from','$airport_to','$date_from_db','$date_to_db')");
				$fpid = mysql_insert_id();
		foreach($segdetail as $row1){
			$nbseg = $row1['nbseg'];
			$idseg  = $row1['idseg'];
			$codseg  = $row1['codseg'];
			$nbopt  = $row1['nbopt'];
			$datdep  = $row1['datdep'];
			$timdep  = $row1['timdep'];
			$datarr  = $row1['datarr'];
			$timarr  = $row1['timarr'];
			$from  = $row1['from'];
			$to  = $row1['to'];
			$airline1  = $row1['airline'];
			$flnb  = $row1['flnb'];
			//$q1 = mysql_query("INSERT INTO segments (`idprop`,`nbseg`, `idseg`, `codseg`, `nbopt`, `datdep`, `timdep`, `datarr`, `timarr`, `from`, `to`, `airline`, `flnb`,`sess_id`,`airport_from`,`airport_to`,`departure`,`return`,`f_priceid`) VALUES ('$idprop','$nbseg', '$idseg', '$codseg', '$nbopt', '$datdep', '$timdep', '$datarr', '$timarr', '$from', '$to', '$airline1', '$flnb','$sessionid','$from','$to','$date_from_db','$date_to_db','$fpid')");  
		
			}
		
		
	  }
	}
	$this->flight_availability_elsseyarres($date_from_db,$date_to_db,$air_from,$air_to,$adults,$child,$infant);
	//$this->flight_availability_elsseyarres_alternate($date_from_db,$date_to_db,$air_from,$air_to,$adults,$child,$infant);
	$this->session->set_userdata(array('adults_count'=>$adults,'child_count'=>$child,'infant_count'=>$infant,'date_from_db'=>$date_from_db)); 
	  // $this->cruise_fh_availability($this->session->userdata('air_to'),$sessionid); 
	  
	  redirect('home/cruise_flight_hotel_result/'.$sessionid.'','refresh');
	}
	function cruise_fh_availability($from,$sessionid)
	{
		
		$resc = $this->Home_Model->cruise_availability($from);
		 
		//echo $from.$sessionid;
		//print_r($res);
		//exit;
		if($resc != false)
		{
				
			foreach($resc as $rwc)
			{
				//$this->Home_Model->insert_search_cruise_flight_hotel1($rwc->cruise_id,$sessionid);
				$this->hotel_fc_availability($this->session->userdata('air_to'),$sessionid,$rwc->cruise_id);
			}
			//redirect('home/hotel_flight_result/'.$sessionid.'','refresh');
		}
		else
		{
			redirect('home/cruise_flight_hotel_result/'.$sessionid.'','refresh');
		}
	}
	function hotel_fc_availability($from,$sessionid,$cruise_id)
	{
		
		$resh = $this->Home_Model->hotel_availability($from);
		if($resh != false)
		{
				
			foreach($resh as $rwh)
			{
				$this->Home_Model->insert_search_cruise_flight_hotel($rwh->hotel_id,$sessionid,$cruise_id);
				//$hotelId = $rwh->hotel_id;
			}
			//redirect('home/hotel_flight_result/'.$sessionid.'','refresh');
		}
		else
		{
			redirect('home/cruise_flight_hotel_result/'.$sessionid.'','refresh');
		}
	}
	function cruise_flight_hotel_result($sessionid)
	{
		$data['sessionid']=$sessionid;
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$air_from = $this->session->userdata('air_from');
		$air_to = $this->session->userdata('airport_to');
		$data['air_from'] = $this->Home_Model->get_airport_code($air_from);  
		$data['air_to'] = $this->Home_Model->get_airport_code($air_to); 
		//$hotel_id = $this->Home_Model->get_cruise_flight_hotel1($sessionid);//echo $hotel_id;exit;
		//$data['hotel_res'] = $this->Home_Model->get_hotel_det($hotel_id);
		//$data['price'] = $this->Home_Model->get_hotel_price($hotel_id);
		//$cruise_id = $this->Home_Model->get_cruise_flight_hotel2($sessionid);
		//$data['cruise_res'] = $cruise_res = $this->Home_Model->get_cruise_det($cruise_id);
		$this->load->view('cruise_flight_hotel/search_result',$data);
	}
	function date_change()
	{
		$this->db->select('*');
		$this->db->from('room_details');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			$res = $query->result();
		}	
		foreach($res as $row)
		{
			$chkin = $row->check_in;
			/*$chck = explode('/',$chkin);
			$ch_dte = $chck[2].'-'.$chck[1].'-'.$chck[0];*/
			
			$chkout = $row->check_out;
			/*$chckout = explode('/',$chkout);
			$chckout_dte = $chckout[2].'-'.$chckout[1].'-'.$chckout[0];
			*/
			
			$checkout = explode('-',$chkout);
			$check_month = $checkout[1];
			$check_day = $checkout[2];
			$year = $checkout[0];
			//echo strlen($check_month); 
			if(strlen($check_month) == '1')
			{
				$month = '0'.$check_month;
				$day =$check_day;
			}
			else
			{
				$month = $check_month;
				$day = $check_day;
			}
			$ch_out = $year.'-'.$month.'-'.$day;
			$data = array('check_out'=>$ch_out);
			//$this->db->where('check_in',$chkin);
			$this->db->where('check_out',$chkout);
			$this->db->update('room_details',$data);
		}
	}
	/* Excursions */
	function get_destinations_search()
	{
		//echo "asdfasdf";exit;
		$city = $this->input->post('id');
		$city_values = $this->Home_Model->get_destination_dropdown($city);
		if($city_values!=false)
		{
		echo '<select name="destination" id="destination"  style="width:180px;" class="textbox width_textbox" onchange="return get_dest_resort(this.value)">
				<option value="">--Select--</option>';
		foreach($city_values as $city_names){
	 echo '<option value="'.$city_names->Name.'">'.$city_names->Name.'</option>';
		}
		echo '</select>';
		}else
		{
		echo '<select name="destination" id="destination"  style="width:180px;" class="textbox width_textbox" >';
		echo '<option value="">--Select--</option>';
		echo '</select>';
		}
		//echo '';
		
	}
	function get_resort_search()
	{
		$city = $this->input->post('id');
		$city_values = $this->Home_Model->get_resort_dropdown($city);
		if($city_values!=false)
		{
		echo '<select name="resort" id="resort"  style="width:180px;" class="textbox width_textbox" >
		<option value="">--Select--</option>';
		foreach($city_values as $city_names){
	 echo '<option value="'.$city_names->resort_id.'">'.$city_names->Resort_Name.'</option>';
		}
		echo '</select>';
		}else
		{
		echo '<select name="resort" id="resort"  style="width:180px;" class="textbox width_textbox" >';
		echo '<option value="">--Select--</option>';
		echo '</select>';
		}
	}
	function brochure()
	{
		ini_set('memory_limit', '-1');
		$data['country'] = $this->Home_Model->get_country();
		$this->load->view('brochure',$data);
	}
	function brochure_online()
	{
		$this->load->view('brochure_online');
	}
	function brochure_by_email()
	{
		$brochure1 = $this->input->post('brochure1');
		$brochure_map = $this->input->post('brochure_map');
		$brochure_tourism = $this->input->post('brochure_tourism');
		$brochure_golf = $this->input->post('brochure_golf');
		$brochure_luxor = $this->input->post('brochure_luxor');
		$brochure_nile = $this->input->post('brochure_nile');
		$brochure_redsea = $this->input->post('brochure_redsea');
		$brochure_spa = $this->input->post('brochure_spa');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email_brochure = $this->input->post('email_brochure');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$zip = $this->input->post('zip');
		$this->Home_Model->insert_brochure_req($brochure1,$brochure_map,$brochure_tourism,$brochure_golf,$brochure_luxor,$brochure_nile,$brochure_redsea,$brochure_spa,$firstname,$lastname,$email_brochure,$phone,$address,$city,$country,$state,$zip);
		
		redirect('home/brochure_send','refresh');
	}
	function brochure_send()
	{
		$data['content'] = "The brochure Requests send to the Authorities, They will Contact You Soon!!!";
		$this->load->view('brochure_by_email',$data);
	}
	function call_me_back()
	{
		$telephone = $this->input->post('telephone');
		$what_time = $this->input->post('what_time');
		$subject="Call Me Back From Egyptspirit";
        $from="w.ashour@egyptspirit.co.uk";
		//$from="balup.provab@gmail.com";
        $headers ="MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$to = "w.ashour@egyptspirit.co.uk";
        $headers .="From: $from";
		$message .= "<table><tr><td>Dear Admin,</td></tr>
					<tr><td colspan='2'>You have Call me back Request</td></tr>
					<tr><td>Telephone: </td><td>".$telephone."</td></tr>
					<tr><td>Call at: </td><td>".$what_time."</td></tr></table>";
        ini_set("SMTP","mail.provab.com");
        ini_set("smtp_port",25);
        $mail= mail($to, $subject, $message, $headers);
		redirect('home/call_me','refresh');
	}
	function call_me()
	{
		$data['content'] = "<b>THANK YOU </b><br /><br />Your Call Me Back request has been sent and we will be in touch.";
		$this->load->view('call_me',$data);
	}
	function holiday_luxor()
	{
		$this->load->view('holiday_luxor');
	}
	function holiday_aswan()
	{
		$this->load->view('holiday_aswan');
	}
	function holiday_cairo()
	{
		$this->load->view('holiday_cairo');
	}
	function holiday_sharm()
	{
		$this->load->view('holiday_sharm');
	}
	function holiday_hurghada()
	{
		$this->load->view('holiday_hurghada');
	}
	function holiday_taba()
	{
		$this->load->view('holiday_taba');
	}
	function fly_airport()
	{
		$data['content'] = $this->Home_Model->fly_airport();
		$this->load->view('fly_airport',$data);
	}
	function fly_style()
	{
		$data['content'] = $this->Home_Model->fly_style();
		$this->load->view('fly_style',$data);
	}
	function great_value()
	{
		$this->load->view('great_value');
	}
	function extra_luggage()
	{
		$this->load->view('extra_luggage');
	}
	function excursion_12()
	{
		$this->load->view('12_excursion');
	}
	function excursion_6()
	{
		$this->load->view('6_excursion');
	}
	function qualified_guide()
	{
		$this->load->view('qualified_guide');
	}
	function free_child()
	{
		$this->load->view('free_child');
	}
	function unbeatable_hand()
	{
		$this->load->view('unbeatable_hand');
	}
	function your_needs()
	{
		$this->load->view('your_needs');
	}
	function Guarateed_places()
	{
		$this->load->view('Guarateed_places');
	}
	function plane_holiday()
	{
		$this->load->view('plane_holiday');
	}
	function health_plan()
	{
		$this->load->view('health_plan');
	}
	function booking_discount()
	{
		$this->load->view('booking_discount');
	}
	function holiday_Gouna()
	{
		$this->load->view('holiday_El_Gouna');
	}
	function holiday_Nilecruise()
	{
		$this->load->view('holiday_Nilecruise');
	}
	function holiday_11()
	{
		$this->load->view('holiday_11&12night');
	}
}//end of class


?>
