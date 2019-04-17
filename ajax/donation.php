<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['donation'])){
    $don_request = "INSERT INTO donor_request_table (donor_user_id, amount_offered, amount_remaining, amount_unmatched, date_offered) VALUES ('{$_POST['user_id']}','{$_POST['donation']}','{$_POST['donation']}','{$_POST['donation']}',NOW())";
    require_once('../scripts/connect.php');
    $result = $db->query($don_request);

//		$usermail = $_POST['user_email'];
//		$username = $_POST['first_name'];
//		$donation = $_POST['donation'];
//		$bizname = "KoboWise";
//        
//		include_once "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
//		$mail = new PHPMailer();
//		
//		$mail->Host = 'smtp.gmail.com'; 
//		
//		$mail->Username = 'techybanky@gmail.com';                 // SMTP username
//    	$mail->Password = 'exxonmobil';                           // SMTP password
//		$mail->SMTPSecure = 'ssl';     
//    	$mail->Port = 465;
//    	$mail->setFrom('no-reply@kobowise.cf', 'KoboWise');
//		$mail->addAddress($usermail, $username);
//		$mail->addAddress('ngeopolis@gmail.com'); // Admin Mail CC
//    
//    	// CONTENT 
//	
//		$mail->isHTML(true);                                  // Set email format to HTML
//    	$mail->Subject = 'Donation Request Recieved';
//    	$mail->Body    = '';
//	
//		$mail->AltBody = 'Welcome to KoboWise. 
//		Hello '.$username.'. Welcome to KoboWise and Congratulations on Signing up. Here are your Profile/Login Details: 
//		Name: '.$username.'. 
//		Email:  '.$usermail.'. 
//		Password: '.$password.'. 
//		Please Login and Change Your Password as soon as possible. Congratulations again and Welcome to KoboWise. 
//		
//		You got this mail because we think you tried to sign up on www.kobowise.com. If you think we made a mistake, just ignore this message.';
//		
//		$mail->send();
		
    
    exit("successful"); 

} else { 
    
    exit("failed");
    
}

?>