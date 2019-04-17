<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../vendor/autoload.php';

if (isset($_POST['action']))
{	
	
	require_once('../scripts/connect.php');	
	
	if($_POST['action'] == 'gglsignin')
	{
		$check="SELECT * FROM user_table WHERE email = '{$_POST['email']}' LIMIT 1";
		$rcheck = $db->query($check);
		if($rcheck->num_rows === 1){
			
			while($row =  $rcheck->fetch_array())
			{
  			 $_SESSION["email"]= $row["email"];
  			 $_SESSION["user_id"]= $row["user_id"];
  			 $_SESSION["loggedin"]= "1";
  			 $_SESSION["last_name"]= $row["last_name"];
			 $_SESSION["first_name"]= $row["first_name"];
			 $_SESSION["password"]= $row["password"];
			 $_SESSION["phone_number"]= $row["phone_number"];
			 $_SESSION["profile_pic"]= $row["profile_pic"];
			 $_SESSION["gender"]= $row["gender"];

  			 $data["first_name"] = $row["first_name"];
  			 $data["last_name"] = $row["last_name"];
  			 $data["gender"] = $row["gender"];
  			 $data["email"] = $row["email"];
  			 $data["id"] = $row["user_id"];
         	 $data["response"] = 'returnee';
     		}
		
			exit(json_encode($data));
			
		}else if($rcheck->num_rows != 1){
			$dfltpassword = 'Password1234';
			$bizname = 'KoboWise';
			
			$userimage = $_POST['profilepic'];
			$insertggluser = "INSERT INTO user_table (first_name, last_name, email, gender, profile_pic, signup_date) VALUES ('{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['email']}','{$_POST['gender']}', '{$userimage}',NOW())";
			$rinsertggluser = $db->query($insertggluser);
			if($rinsertggluser == true)
			{
			 $_SESSION["email"]= $_POST["email"];
  			 $_SESSION["loggedin"]= "1";
  			 $_SESSION["last_name"]= $_POST["lastname"];
			 $_SESSION["first_name"]= $_POST["firstname"];
			 $_SESSION["password"]= $dfltpassword;
			 				
			 $data["first_name"] = $_POST["firstname"];
			 $username = $_POST["firstname"];
  			 $data["last_name"] = $_POST["lastname"];
  			 $data["gender"] = $_POST["gender"];
  			 $data["email"] = $_POST["email"];
  			 $usermail = $_POST["email"];
  			 $data["response"] = 'firsttime';
			 $password = $dfltpassword;		
			include_once "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
			$mail = new PHPMailer();
		
			$mail->Host = 'smtp.gmail.com'; 
		
			$mail->Username = 'techybanky@gmail.com';                 // SMTP username
    		$mail->Password = 'exxonmobil';                           // SMTP password
			$mail->SMTPSecure = 'ssl';     
    		$mail->Port = 465;
    		$mail->setFrom('no-reply@kobowise.cf', 'KoboWise');
			$mail->addAddress($usermail, $username);
			$mail->addAddress('ngeopolis@gmail.com'); // Admin Mail CC
			
		// CONTENT 
		
			$mail->isHTML(true);                                  // Set email format to HTML
    		$mail->Subject = 'Welcome to KoboWise';
    		$mail->Body    = '
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    
    <style>

        
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

      
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

       
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        
        a {
            text-decoration: none;
        }

       
        img {
            -ms-interpolation-mode:bicubic;
        }

        
        *[x-apple-data-detectors],  
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

       
        .a6S {
           display: none !important;
           opacity: 0.01 !important;
       }
       img.g-img + div {
           display: none !important;
       }

         @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            .email-container {
                min-width: 320px !important;
            }
        }
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-container {
                min-width: 375px !important;
            }
        }
        @media only screen and (min-device-width: 414px) {
            .email-container {
                min-width: 414px !important;
            }
        }

    </style>
    
    <style>

        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
	    .button-td-primary:hover,
	    .button-a-primary:hover {
	        background: #555555 !important;
	        border-color: #555555 !important;
	    }

         @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            
            .stack-column-center {
                text-align: center !important;
            }

            
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            
            .email-container p {
                font-size: 17px !important;
            }
        }

    </style>
    
</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #eeeeee;">    <center style="width: 100%; background-color: #eeeeee;">
    

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            Hello '.$username.', Welcome to '.$bizname.'. Your email is: '.$usermail.'. And your password is: '.$password.'. For security purposes, please Login to www.kobowise.cf and change your password as soon as possible. You are recieving this email because You signed up on www.kobowise.cf. If you think we made a mistake, please ignore this message, otherwise, Congratulations and welcome to KoboWise.
        </div>
         <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
	        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;" class="email-container">
	        <!-- Email Header : BEGIN -->
            <tr style="background: white;">
                <td style="padding: 10px 0; text-align: center">
                    <img src="https://i.imgur.com/IRkldcO.png" width="200" height="50" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px;">
                </td>
            </tr>
	         <tr>
                <td valign="middle" style="text-align: center; background-image: url(https://i.imgur.com/lTMD24W.jpg); background-color: #eeeeee; background-position: center center !important; background-size: cover !important;">
	                 <div>
	                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
	                        <tr>
	                            <td valign="middle" style="text-align: left; padding-left: 15px; padding-top: 200px; padding-bottom: 20px; font-family: sans-serif; font-size: 15px; line-height: 40px; color: #fefefe; background-color:rgba(0,0,0,0.3);">
	                                <h2 style="margin: 0; text-shadow: 1px 1px #222;">Welcome <span style="color: #ff7600; font-weight: 600;">'.$username.'</span></h2>
	                            </td>
	                        </tr>
	                    </table>
	                </div>
	                
	            </td>
	        </tr>
	       <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding-bottom: 0px;">
								<h2 style="margin: 0 0 10px; font-size: 20px; line-height: 30px; color: #333333; font-weight: normal;">Hello <span style="color: #ff7600; font-weight: 600;">'.$username.'</span>.</h2>
								<p style="margin: 0 0 10px;">Welcome to <span style ="color: #26a69a; font-weight: 600;">KoboWise</span> - The Fastest, Easiest, and Safest way to Earn Passive Income Online. Congratulations on Signing up. Here are Your Profile/login Details:</p>
                                <ul style="padding: 0; margin: 0; list-style-type: disc;">
									<li style="margin:0 0 10px 20px;" class="list-item-first">Name: <span style=" font-weight: bold;">'.$username.'</span></li>
									<li style="margin:0 0 10px 20px;">Email: <span style=" font-weight: bold;">'.$usermail.'</span></li>
									<li style="margin: 0 0 0 20px;" class="list-item-last">Password: <span style="color:#ff7000; font-weight: bold;">'.$password.'</span></li>
								</ul>
								<p style="margin: 0 10 0px;">Please Login and Change Your Password as soon as possible. Congrats again <span style="color: #ff7600;">'.$username.'</span> and Welcome to <span style="color: #26a69a;">KoboWise</span>.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 20px 20px;">
                                <!-- Button : BEGIN -->
                                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                                    <tr>
                                        <td class="button-td button-td-primary" style="border-radius: 4px; background: #eeeeee;">
											<a class="button-a button-a-primary" href="https://kobowise.cf" style="background: #222222; border: 1px solid #000000; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 13px; color: #ffffff; display: block; border-radius: 4px;">Click Here to Login</a>
										</td>
                                    </tr>
                                </table>
                                <!-- Button : END -->
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
            <!-- 1 Column Text + Button : END -->
   	        <!-- Clear Spacer : BEGIN -->
	        <tr>
	            <td aria-hidden="true" height="20" style="font-size: 0px; line-height: 0px;">
	                &nbsp;
	            </td>
	        </tr>
	        <!-- Clear Spacer : END -->

	        <!-- 1 Column Text : BEGIN -->
	        <tr>
	            <td style="background-color: none;">
	                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
	                    <tr>
	                        <td style="padding: 10px; font-family: sans-serif; font-size: 12px; line-height: 20px; color: #888888; text-align: center;">
	                            You got this mail because we think you tried to sign up on www.kobowise.com, which is really cool. If you think we made a mistake, just ignore this message.
	                        </td>
	                    </tr>
	                </table>
	            </td>
	        </tr>
	        <!-- 1 Column Text : END -->

	    </table>
	    <!-- Email Body : END -->

	    <!-- Email Footer : BEGIN -->
	    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px;">
        <tr><td style="padding-top: 20px; text-align: center">
                    <img src="https://i.imgur.com/IRkldcO.png" width="200" height="50" alt="alt_text" border="0" style="height: auto; background: #ddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #eeeee;">
                </td></tr>
	        <tr>
	            <td style="padding-top: 10px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">
	               
	          
	                Kobowise.cf<br><span class="unstyle-auto-detected-links">123 KoboWise Address, SpringField, OR, 97477 US<br>(123) 456-7890</span>
	                <br><br>
	                
	            </td>
	        </tr>
	    </table>
	    <!-- Email Footer : END -->

	    <!-- Full Bleed Background Section : BEGIN -->
	    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #709f2b;">
	        <tr>
	            <td valign="top">
	                <div style="max-width: 600px; margin: auto;" class="email-container">
	                    
	                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
	                        <tr>
	                            <td style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 12px; line-height: 20px; color: #ffffff;">
	                                <p style="margin: 0; font-size: 12px;">Email scanners, Sniffers and Phishers can hack into your KoboWise account by getting your information from this email. To prevent this, please login and change your password as soon as possible.</p>
	                            </td>
	                        </tr>
	                    </table>
	                   
	                </div>
	            </td>
	        </tr>
	    </table>
	    
    </center>
</body>
</html>
';
    	$mail->AltBody = 'Welcome to KoboWise. 
		Hello '.$username.'. Welcome to KoboWise and Congratulations on Signing up. Here are your Profile/Login Details: 
		Name: '.$username.'. 
		Email:  '.$usermail.'. 
		Password: '.$password.'. 
		Please Login and Change Your Password as soon as possible. Congratulations again and Welcome to KoboWise. 
		
		You got this mail because we think you tried to sign up on www.kobowise.com. If you think we made a mistake, just ignore this message.';

		
			$mail->send();	
				
			}else{
			 $data[]="";	
			}
			
		exit(json_encode($data));
			 
		}
		
	}
	if($_POST['action'] == 'fbsignin')
	{
		$check="SELECT * FROM user_table WHERE email = '{$_POST['email']}' LIMIT 1";
		$rcheck = $db->query($check);
		if($rcheck->num_rows === 1){
			
			while($row =  $rcheck->fetch_array())
			{
  			 $_SESSION["email"]= $row["email"];
  			 $_SESSION["user_id"]= $row["user_id"];
  			 $_SESSION["loggedin"]= "1";
  			 $_SESSION["last_name"]= $row["last_name"];
			 $_SESSION["first_name"]= $row["first_name"];
			 $_SESSION["password"]= $row["password"];
			 $_SESSION["phone_number"]= $row["phone_number"];
			 $_SESSION["profile_pic"]= $row["profile_pic"];
			 $_SESSION["gender"]= $row["gender"];

  			 $data["first_name"] = $row["first_name"];
  			 $data["last_name"] = $row["last_name"];
  			 $data["gender"] = $row["gender"];
  			 $data["email"] = $row["email"];
  			 $data["id"] = $row["user_id"];
         	 $data["response"] = 'returnee';
     		}
		
			exit(json_encode($data));
			
		}else if($rcheck->num_rows != 1){
			$dfltpassword = 'Password1234';
			$bizname = 'KoboWise';
			$userimage = $_POST['profilepic'];
			$insertggluser = "INSERT INTO user_table (first_name, last_name, email, gender, profile_pic, signup_date) VALUES ('{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['email']}','{$_POST['gender']}', '{$userimage}',NOW())";
			$rinsertggluser = $db->query($insertggluser);
			if($rinsertggluser == true)
			{
			 $_SESSION["email"]= $_POST["email"];
  			 $_SESSION["loggedin"]= "1";
  			 $_SESSION["last_name"]= $_POST["lastname"];
			 $_SESSION["first_name"]= $_POST["firstname"];
			 $_SESSION["password"]= $dfltpassword;
			 				
			 $data["first_name"] = $_POST["firstname"];
			 $username = $_POST["firstname"];
  			 $data["last_name"] = $_POST["lastname"];
  			 $data["gender"] = $_POST["gender"];
  			 $data["email"] = $_POST["email"];
  			 $usermail = $_POST["email"];
  			 $data["response"] = 'firsttime';
			 $password = $dfltpassword;
				
			include_once "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
			$mail = new PHPMailer();
		
			$mail->Host = 'smtp.gmail.com'; 
		
			$mail->Username = 'techybanky@gmail.com';                 // SMTP username
    		$mail->Password = 'exxonmobil';                           // SMTP password
			$mail->SMTPSecure = 'ssl';     
    		$mail->Port = 465;
    		$mail->setFrom('no-reply@kobowise.cf', 'KoboWise');
			$mail->addAddress($usermail, $username);
			$mail->addAddress('ngeopolis@gmail.com'); // Admin Mail CC
			
		// CONTENT 
		
			$mail->isHTML(true);                                  // Set email format to HTML
    		$mail->Subject = 'Welcome to KoboWise';
    		$mail->Body    = '
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    
    <style>

        
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

      
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

       
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        
        a {
            text-decoration: none;
        }

       
        img {
            -ms-interpolation-mode:bicubic;
        }

        
        *[x-apple-data-detectors],  
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

       
        .a6S {
           display: none !important;
           opacity: 0.01 !important;
       }
       img.g-img + div {
           display: none !important;
       }

         @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            .email-container {
                min-width: 320px !important;
            }
        }
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-container {
                min-width: 375px !important;
            }
        }
        @media only screen and (min-device-width: 414px) {
            .email-container {
                min-width: 414px !important;
            }
        }

    </style>
    
    <style>

        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
	    .button-td-primary:hover,
	    .button-a-primary:hover {
	        background: #555555 !important;
	        border-color: #555555 !important;
	    }

         @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            
            .stack-column-center {
                text-align: center !important;
            }

            
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            
            .email-container p {
                font-size: 17px !important;
            }
        }

    </style>
    
</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #eeeeee;">    <center style="width: 100%; background-color: #eeeeee;">
    

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            Hello '.$username.', Welcome to '.$bizname.'. Your email is: '.$usermail.'. And your password is: '.$password.'. For security purposes, please Login to www.kobowise.cf and change your password as soon as possible. You are recieving this email because You signed up on www.kobowise.cf. If you think we made a mistake, please ignore this message, otherwise, Congratulations and welcome to KoboWise.
        </div>
         <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
	        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;" class="email-container">
	        <!-- Email Header : BEGIN -->
            <tr style="background: white;">
                <td style="padding: 10px 0; text-align: center">
                    <img src="https://i.imgur.com/IRkldcO.png" width="200" height="50" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px;">
                </td>
            </tr>
	         <tr>
                <td valign="middle" style="text-align: center; background-image: url(https://i.imgur.com/lTMD24W.jpg); background-color: #eeeeee; background-position: center center !important; background-size: cover !important;">
	                 <div>
	                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
	                        <tr>
	                            <td valign="middle" style="text-align: left; padding-left: 15px; padding-top: 200px; padding-bottom: 20px; font-family: sans-serif; font-size: 15px; line-height: 40px; color: #fefefe; background-color:rgba(0,0,0,0.3);">
	                                <h2 style="margin: 0; text-shadow: 1px 1px #222;">Welcome <span style="color: #ff7600; font-weight: 600;">'.$username.'</span></h2>
	                            </td>
	                        </tr>
	                    </table>
	                </div>
	                
	            </td>
	        </tr>
	       <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding-bottom: 0px;">
								<h2 style="margin: 0 0 10px; font-size: 20px; line-height: 30px; color: #333333; font-weight: normal;">Hello <span style="color: #ff7600; font-weight: 600;">'.$username.'</span>.</h2>
								<p style="margin: 0 0 10px;">Welcome to <span style ="color: #26a69a; font-weight: 600;">KoboWise</span> - The Fastest, Easiest, and Safest way to Earn Passive Income Online. Congratulations on Signing up. Here are Your Profile/login Details:</p>
                                <ul style="padding: 0; margin: 0; list-style-type: disc;">
									<li style="margin:0 0 10px 20px;" class="list-item-first">Name: <span style=" font-weight: bold;">'.$username.'</span></li>
									<li style="margin:0 0 10px 20px;">Email: <span style=" font-weight: bold;">'.$usermail.'</span></li>
									<li style="margin: 0 0 0 20px;" class="list-item-last">Password: <span style="color:#ff7000; font-weight: bold;">'.$password.'</span></li>
								</ul>
								<p style="margin: 0 10 0px;">Please Login and Change Your Password as soon as possible. Congrats again <span style="color: #ff7600;">'.$username.'</span> and Welcome to <span style="color: #26a69a;">KoboWise</span>.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 20px 20px;">
                                <!-- Button : BEGIN -->
                                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                                    <tr>
                                        <td class="button-td button-td-primary" style="border-radius: 4px; background: #eeeeee;">
											<a class="button-a button-a-primary" href="https://kobowise.cf" style="background: #222222; border: 1px solid #000000; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 13px; color: #ffffff; display: block; border-radius: 4px;">Click Here to Login</a>
										</td>
                                    </tr>
                                </table>
                                <!-- Button : END -->
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
            <!-- 1 Column Text + Button : END -->
   	        <!-- Clear Spacer : BEGIN -->
	        <tr>
	            <td aria-hidden="true" height="20" style="font-size: 0px; line-height: 0px;">
	                &nbsp;
	            </td>
	        </tr>
	        <!-- Clear Spacer : END -->

	        <!-- 1 Column Text : BEGIN -->
	        <tr>
	            <td style="background-color: none;">
	                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
	                    <tr>
	                        <td style="padding: 10px; font-family: sans-serif; font-size: 12px; line-height: 20px; color: #888888; text-align: center;">
	                            You got this mail because we think you tried to sign up on www.kobowise.com, which is really cool. If you think we made a mistake, just ignore this message.
	                        </td>
	                    </tr>
	                </table>
	            </td>
	        </tr>
	        <!-- 1 Column Text : END -->

	    </table>
	    <!-- Email Body : END -->

	    <!-- Email Footer : BEGIN -->
	    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px;">
        <tr><td style="padding-top: 20px; text-align: center">
                    <img src="https://i.imgur.com/IRkldcO.png" width="200" height="50" alt="alt_text" border="0" style="height: auto; background: #ddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #eeeee;">
                </td></tr>
	        <tr>
	            <td style="padding-top: 10px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">
	               
	          
	                Kobowise.cf<br><span class="unstyle-auto-detected-links">123 KoboWise Address, SpringField, OR, 97477 US<br>(123) 456-7890</span>
	                <br><br>
	                
	            </td>
	        </tr>
	    </table>
	    <!-- Email Footer : END -->

	    <!-- Full Bleed Background Section : BEGIN -->
	    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #709f2b;">
	        <tr>
	            <td valign="top">
	                <div style="max-width: 600px; margin: auto;" class="email-container">
	                    
	                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
	                        <tr>
	                            <td style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 12px; line-height: 20px; color: #ffffff;">
	                                <p style="margin: 0; font-size: 12px;">Email scanners, Sniffers and Phishers can hack into your KoboWise account by getting your information from this email. To prevent this, please login and change your password as soon as possible.</p>
	                            </td>
	                        </tr>
	                    </table>
	                   
	                </div>
	            </td>
	        </tr>
	    </table>
	    
    </center>
</body>
</html>
';
    	$mail->AltBody = 'Welcome to KoboWise. 
		Hello '.$username.'. Welcome to KoboWise and Congratulations on Signing up. Here are your Profile/Login Details: 
		Name: '.$username.'. 
		Email:  '.$usermail.'. 
		Password: '.$password.'. 
		Please Login and Change Your Password as soon as possible. Congratulations again and Welcome to KoboWise. 
		
		You got this mail because we think you tried to sign up on www.kobowise.com. If you think we made a mistake, just ignore this message.';

		
			$mail->send();
			 				
			}else{
			 $data[]="";	
			}
			
		exit(json_encode($data));
			 
		}
		
	}
//	echo $response;
}

?>