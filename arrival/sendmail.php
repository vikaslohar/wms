<?php
 require '/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php';
// require '../PHPMailer/PHPMailerAutoload.php';
 	require_once("../include/config.php");
	require_once("../include/connection.php");
	$pid=$_REQUEST['pid'];	
	$foccode=$_REQUEST['foccode'];	
	$flg=$_REQUEST['flg'];
	$trid=trim($_REQUEST['trid']);
	$plant_code=trim($_REQUEST['plant_code']);
	$pdfpath='/opt/lampp/htdocs/wms-d/pdffiles/RawSeedsUnloadingSheet_AR'.$pid.'.pdf';
	//$pdfpath='../pdffiles/RawSeedsUnloadingSheet_AR'.$pid.'.pdf';
//Create a new PHPMailer instance
	function is_connected()
	{
		$connected = @fsockopen("www.example.com", 80); 
											//website, port  (try 80 or 443)
		if ($connected){
			$is_conn = true; //action when connected
			fclose($connected);
		}else{
			$is_conn = false; //action in connection failure
		}
		return $is_conn;
	
	}
	if(is_connected()==true)
	{
		if(file_exists($pdfpath)==true)
		{ 
			$mail = new PHPMailer;   
			$mail->isSMTP();
		// change this to 0 if the site is going live
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->CharSet = "UTF-8";
		 //use SMTP authentication
			$mail->SMTPAuth = true;
		//Username to use for SMTP authentication
			if($plant_code=="D")
			{
				$mail->Username = "wms.djl@vnrseeds.in";
				$mail->Password = "mqbp fghq vvft zcpw";
				$mail->setFrom('wms.djl@vnrseeds.in', 'VNR Seeds Deorjhal Plant');
				$mail->addReplyTo('wms.djl@vnrseeds.in', 'VNR Seeds Deorjhal Plant');
			}
			else if($plant_code=="B")
			{
				$mail->Username = "wms.bry@vnrseeds.in";
				$mail->Password = "ctbk pgtc jadd ymep";
				$mail->setFrom('wms.bry@vnrseeds.in', 'VNR Seeds Boriya Plant');
				$mail->addReplyTo('wms.bry@vnrseeds.in', 'VNR Seeds Boriya Plant');
			}
			else
			{
				$mail->Username = "wms.djl@vnrseeds.in";
				$mail->Password = "mqbp fghq vvft zcpw";
				$mail->setFrom('wms.djl@vnrseeds.in', 'VNR Seeds Deorjhal Plant');
				$mail->addReplyTo('wms.djl@vnrseeds.in', 'VNR Seeds Deorjhal Plant');
			}
			/*$mail->Username = "wms.hyd@vnrseeds.in";
			$mail->Password = "user@2020";
			$mail->setFrom('wms.hyd@vnrseeds.in', 'VNR Seeds Hyderabad Plant');
			$mail->addReplyTo('wms.hyd@vnrseeds.in', 'VNR Seeds Hyderabad Plant');*/
		  //  $mail->addAddress('ishwari.yadav@vnrseeds.com', 'Ishwari Yadav');
			$mail->Subject = 'Unloading Slip AR'.$pid;
			$mail->addAttachment($pdfpath, 'Unloading Sheet AR'.$pid.'.pdf');
			// $message is gotten from the form
			$mail->Body    = 'Dear Sir,<br/>Please find enclosed herewith Unloading sheet for your reference.';
			$mail->AltBody = 'Dear Sir, Please find enclosed herewith Unloading sheet for your reference.';
			//$mail->msgHTML('Hi! This is my first e-mail sent through PHPMailer.');
		//$mail->AltBody = $filteredmessage;
		
			
			
			$new = explode(",", $foccode);
			foreach ($new as $addr) 
			{
				if($addr<>"")
				{
					/*echo $addr."<br />";
					$sql_issueg21=mysqli_query($link,"select * from tblproductionpersonnel where productionpersonnelid='$addr' order by productionpersonnelid") or die(mysqli_error($link));
					while($row_issueg21=mysqli_fetch_array($sql_issueg21))
					{
						$address=$row_issueg21['emailid'];
						$fullname=$row_issueg21['productionpersonnel'];
						echo $address." = ".$fullname."<br />";
						$mail->AddAddress($address,$fullname);*/
						$mail->addAddress($addr);
					//} 
				}
			}	
			if($plant_code=="D")
			{
				$mail->AddCC('rajkumar.kundu@vnrseeds.com', 'Rajkumar Kundu Sir');
				$mail->AddCC('ravinder.yadav@vnrseeds.com', 'Ravindra Yadav');
				$mail->AddCC('jagdeep.kumar@vnrseeds.in', 'Jagdeep Kumar');
			}
			else if($plant_code=="B")
			{
				$mail->AddCC('rajkumar.kundu@vnrseeds.com', 'Rajkumar Kundu Sir');
				$mail->AddCC('rajesh.pal@vnrseeds.in', 'Rajesh Pal Singh');
				$mail->AddCC('jagdeep.kumar@vnrseeds.in', 'Jagdeep Kumar');
			}
			else
			{
				$mail->AddCC('rajkumar.kundu@vnrseeds.com', 'Rajkumar Kundu Sir');
				$mail->AddCC('ravinder.yadav@vnrseeds.com', 'Ravindra Yadav');
				$mail->AddCC('jagdeep.kumar@vnrseeds.in', 'Jagdeep Kumar');
			}
			/*$mail->AddCC('pk.kapri@vnrseeds.com', 'P. K. Kapri');
			$mail->AddCC('dattukant.vnrseeds@gmail.com', 'Dattukant');
			$mail->AddCC('sunil.kalaskar@vnrseeds.com', 'Sunil Kalaskar');*/
			//var_dump($mail);
			if (!$mail->send()) 
			{
				//echo "Mailer Error: " . $mail->ErrorInfo;
				echo "We are extremely sorry to inform you that your message
	could not be delivered,please try again.";
			} 
			else 
			{
				$sqlissue=mysqli_query($link,"UPDATE tblarrival_sub SET emailflg='".$flg."' where old='".$trid."'") or die(mysqli_error($link));
				$sqlissue1=mysqli_query($link,"UPDATE tblarrival_sub_unld SET emailflg='".$flg."' where old='".$trid."'") or die(mysqli_error($link));
				echo "Your message was successfully delivered to ".$addr;
			}
	
		/*if (!$mail->send()) {
			echo "We are extremely sorry to inform you that your message
	could not be delivered,please try again.";
		} else {
			echo "Your message was successfully delivered,you would be contacted shortly.";
			}*/
				
		}
		else
		{
			echo "Unloadingsheet PDF file is not generated, Please generate the PDF file and then try again.";
		}
	}
	else
	{
		echo "You are not connected to Internet, Please connect to Internet and then try again.";
	}
?> <br /><br /><img src="../images/close_1.gif" border="0" onClick="window.close()" />
