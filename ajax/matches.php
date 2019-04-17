<?php 
// ajax to fetch all users 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../vendor/autoload.php';

if(isset($_POST["action"]))
{
    require_once('../scripts/connect.php');
	
	// Get ALL MATCHES to display on ADMIN MATCHES PAGE
    if($_POST["action"] == "fetch")
    {
        $query = "SELECT * FROM match_table AS m INNER JOIN user_table AS d ON d.user_id = m.donor_user_id INNER JOIN user_table AS r ON r.user_id = m.reciever_user_id ORDER BY m.is_paid ASC";
        $result = $db->query($query);
        $output = '';
        $disabled = '';
        $btnstyle = '';
        while($row = $result->fetch_array())
        {   
            if($row['amount_unmatched'] < $row['amount_offered']){
                $disabled = 'disabled';
                $btnstyle = 'btn-secondary';
            }else {
                $disabled = '';
                $btnstyle = 'btn-primary';
            }
            $output .= '<tr id="user'.$row["user_id"].'">
                            <td>'.$row["donor_request_id"].'</td>
                            <td>'.$row["first_name"].' '.$row["last_name"].'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["phone_number"].'</td>
                           <td>'.$row["amount_offered"].'</td>
                           <td>'.$row["date_offered"].'</td>
                            <td>'.$row["amount_unmatched"].'</td>
                            <td><button type="button" name="change" id="'.$row["donor_request_id"].'" value="'.$row["donor_user_id"].'" class="change btn '.$btnstyle.'" '.$disabled.'>Change</button></td>
                            <td><button type="button" name="view" id="'.$row["donor_request_id"].'" class="view btn btn-warning" value="'.$row["donor_user_id"].'">View</button></td>
                            <td><button type="button" name="cancel" id="'.$row["donor_request_id"].'" class="cancel btn btn-danger" '.$disabled.'>Cancel</button></td>
                        </tr>
                            '; 
        } 
        echo ($output);
    }
	
	// INSERT MATCH FROM ADMIN MATCH TABLE INTO MATCH TABLES IN DATABASE
    if($_POST['action'] =="insert_match" && isset($_POST['match_amount']) && $_POST['match_amount'] <= $_POST['donation_amount_unmatched'] && $_POST['match_amount'] <= $_POST['reciever_amount_unmatched'])
    { 
       $output = "";
        
            
            $query = "INSERT INTO match_table (donor_user_id, donor_request_id, reciever_user_id, recieve_request_id, matched_amount, date_matched) VALUES ('{$_POST['donation_user_id']}','{$_POST['donation_id']}','{$_POST['reciever_user_id']}','{$_POST['recieve_request_id']}','{$_POST['match_amount']}',NOW())";
			$query2 = "UPDATE donor_request_table SET amount_to_give = (amount_to_give + '{$_POST['match_amount']}'), amount_unmatched = (amount_unmatched - '{$_POST['match_amount']}'), date_matched = NOW() WHERE donor_request_id = '{$_POST['donation_id']}'";
			$query3 = "UPDATE recieve_request_table SET amount_unmatched = amount_unmatched - '{$_POST['match_amount']}', date_matched = NOW() WHERE recieve_request_id = '{$_POST['recieve_request_id']}' ";
            require_once('../scripts/connect.php');
            $result = $db->query($query);
            $result2 = $db->query($query2);
            $result3 = $db->query($query3);
            if($result == true && $result2 == true && $result3 == true){
                $output = "success";
            }else{
                $output = "failed";
            };
        echo ($output);
        mysqli_close($db);
    }
    
	//get Match data to display on USER Index page I have paid modal
	if($_POST['action'] == 'confirmpay' && isset($_POST['match_id']))
    {
        $data = [];
        $query = "SELECT * FROM match_table JOIN user_table ON user_table.user_id = match_table.reciever_user_id JOIN banks ON user_table.bank_id = banks.bank_id WHERE match_table.match_id = '{$_POST['match_id']}' AND match_table.donor_user_id = '{$_POST['user_id']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        while($row = $result->fetch_array()){
            $data['match_id'] = $row['match_id'];
            $data['user_id'] = $row['user_id'];
            $data['firstname'] = $row['first_name'];
            $data['lastname'] = $row['last_name'];
            $data['bank'] = $row['bank'];
            $data['acc_number'] = $row['acc_number'];
            $data['matched_amount'] = $row['matched_amount'];
                
        };
        echo json_encode($data);
    }
	
	//get Match data to display on USER Index page Recieve modal
	if($_POST['action'] == 'confirmrec' && isset($_POST['match_id']))
    {
        $data = [];
        $query = "SELECT * FROM match_table JOIN user_table ON user_table.user_id = match_table.donor_user_id JOIN banks ON user_table.bank_id = banks.bank_id WHERE match_table.match_id = '{$_POST['match_id']}' AND match_table.reciever_user_id = '{$_POST['user_id']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        while($row = $result->fetch_array()){
            $data['match_id'] = $row['match_id'];
            $data['match_donor_request_id'] = $row['donor_request_id'];
            $data['match_recieve_request_id'] = $row['recieve_request_id'];
            $data['user_id'] = $row['user_id'];
            $data['match_donor_id'] = $row['donor_user_id'];
            $data['match_reciever_id'] = $row['reciever_user_id'];
            $data['firstname'] = $row['first_name'];
            $data['lastname'] = $row['last_name'];
            $data['gender'] = $row['gender'];
            $data['phone_number'] = $row['phone_number'];
            $data['matched_amount'] = $row['matched_amount'];
                
        };
        echo json_encode($data);
    }
	
	// User clicks I have paid button to update database
	if($_POST['action'] == 'is_paid' && isset($_POST['match_id']) && isset($_POST['reciever_id']))
    {
        $query = "UPDATE match_table SET is_paid = 1, date_paid = now() WHERE reciever_user_id = '{$_POST['reciever_id']}' AND match_id = '{$_POST['match_id']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
    if($result){
        echo 'success';
    }else{
          
        echo 'failed'; }
        
    };
	
	
	// User clicks I have Recieved button to update database
	if($_POST['action'] == 'finalconf' && isset($_POST['match_id']) && isset($_POST['don_id']) && isset($_POST['rec_id']) && isset($_POST['match_amount']))
    {
        $query1 = "UPDATE match_table SET is_confirmed = 1, date_confirmed = now() WHERE reciever_user_id = '{$_POST['rec_id']}' AND match_id = '{$_POST['match_id']}'"; 
        $query2 = "UPDATE donor_request_table JOIN user_table ON donor_request_table.donor_user_id = user_table.user_id SET amount_given = amount_given + '{$_POST['match_amount']}', amount_remaining = amount_remaining - '{$_POST['match_amount']}', don_balance = don_balance + '{$_POST['match_amount']}', total_don = total_don + '{$_POST['match_amount']}', rec_balance = rec_balance + '{$_POST['match_amount']}', eligibility = eligibility + '{$_POST['match_amount']}' WHERE donor_request_id = '{$_POST['don_req_id']}' AND donor_user_id = '{$_POST['don_id']}'"; 
        $query3 = "UPDATE recieve_request_table JOIN user_table ON recieve_request_table.reciever_user_id = user_table.user_id SET amount_recieved = amount_recieved + '{$_POST['match_amount']}', amount_remaining = amount_remaining - '{$_POST['match_amount']}', total_rec = total_rec + '{$_POST['match_amount']}', rec_balance = rec_balance - '{$_POST['match_amount']}' WHERE recieve_request_id = '{$_POST['rec_req_id']}' AND reciever_user_id = '{$_POST['rec_id']}'";
        
		require_once('../scripts/connect.php');
        $result1 = $db->query($query1);
        $result2 = $db->query($query2);
        $result3 = $db->query($query3);
       
    if($result3 == true){
        echo 'success';
    }else{
          
        echo 'failed'; 
	};
        
    }
	
	
	
	
    if($_POST['action'] == 'check' && isset($_POST['donid']))
    {
        $data = [];
        $query = "SELECT * FROM donor_request_table JOIN user_table ON user_table.user_id = donor_request_table.donor_user_id WHERE user_table.user_id = '{$_POST['userid']}' AND donor_request_table.donor_request_id = '{$_POST['donid']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        while($row = $result->fetch_array()){
            $data['donation_id'] = $row['donor_request_id'];
            $data['user_id'] = $row['user_id'];
            $data['firstname'] = $row['first_name'];
            $data['lastname'] = $row['last_name'];
            $data['email'] = $row['email'];
            $data['phonenumber'] = $row['phone_number'];
            $data['amount_offered'] = $row['amount_offered'];
                
        };
        echo json_encode($data);
    }
    
    if($_POST['action'] == 'update_donation' && isset($_POST['don_update_id']) & isset($_POST['user_update_id']))
    {
        $query = "UPDATE donor_request_table SET amount_offered = '{$_POST['new_amount']}', amount_unmatched = '{$_POST['new_amount']}', amount_remaining = '{$_POST['new_amount']}', date_offered = now() WHERE donor_user_id = '{$_POST['user_update_id']}' AND donor_request_id = '{$_POST['don_update_id']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
    if($result){
        echo 'successful';
    }else{
          
        echo 'failed'; }
        
    }
    
    if($_POST['action'] == 'view_donation' && isset($_POST['don_view_id']) && isset($_POST['user_view_id']))
    {
        $data = [];
        $datematched = '';
        $no_of_matches = '';
        $no_paid = '';
        $no_confirmed = '';
        $notified = '';
        
        $query = "SELECT * FROM donor_request_table JOIN user_table ON user_table.user_id = donor_request_table.donor_user_id JOIN states ON states.state_id = user_table.state_id WHERE user_table.user_id = '{$_POST['user_view_id']}' AND donor_request_table.donor_request_id = '{$_POST['don_view_id']}'"; 
        $query2 = "SELECT * FROM match_table WHERE donor_request_id = '{$_POST['don_view_id']}'";
        $query3 = "SELECT * FROM match_table WHERE donor_request_id = '{$_POST['don_view_id']}' AND is_paid = 1";
        $query4 = "SELECT * FROM match_table WHERE donor_request_id = '{$_POST['don_view_id']}' AND is_confirmed = 1";
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        $result2 = $db->query($query2);
        $result3 = $db->query($query3);
        $result4 = $db->query($query4);
        if($result2->num_rows == null){
            $no_of_matches = 0;
        }else if($result2->num_rows != null){
            $no_of_matches = $result->num_rows;
        };
        if($result3->num_rows == null){
            $no_paid = 0;
        }else if($result3->num_rows != null){
            $no_paid = $result3->num_rows;
        };
        if($result4->num_rows == null){
            $no_confirmed = 0;
        }else if($result4->num_rows != null){
            $no_confirmed = $result4->num_rows;
        };
    
        while($row = $result->fetch_array()){
            
            if($row['amount_offered'] == $row['amount_unmatched']){
                $datematched = 'not yet matched';
            }else{
                $datematched = $row['date_matched'];
            };
            if($row['notified_complete'] == 0){
                $notified = 'Not yet notified';
            }else{
                $notified = 'Has been notified';
            };
            $data['donation_id'] = $row['donor_request_id'];
            $data['date_offered'] = $row['date_offered'];
            $data['profilepic'] = $row['profile_pic'];
            $data['amount_unmatched'] = $row['amount_unmatched'];
            $data['user_id'] = $row['user_id'];
            $data['firstname'] = $row['first_name'];
            $data['lastname'] = $row['last_name'];
            $data['email'] = $row['email'];
            $data['gender'] = $row['gender'];
            $data['state'] = $row['state'];
            $data['phonenumber'] = $row['phone_number'];
            $data['amount_offered'] = $row['amount_offered'];
            $data['amount_given'] = $row['amount_given'];
            $data['amount_remaining'] = $row['amount_remaining'];
            $data['amount_matched'] = $row['amount_to_give'];
            $data['no_of_matches'] = $no_of_matches;
            $data['no_paid'] = $no_paid;
            $data['no_confirmed'] = $no_confirmed;
            $data['date_matched'] = $datematched;
            $data['notified'] = $notified;
            
                
        };
        echo json_encode($data);
    }
	
    // GET ALL MATCHES AND DISPLAY ON ADMIN MATCHES PAGE
    if($_POST["action"] == "mini")
    {
        $query = "SELECT m.match_id, d.first_name dfirst_name, d.last_name dlast_name, m.is_paid, m.is_confirmed, sd.state sdstate, sr.state srstate, m.matched_amount, r.first_name rfirst_name, r.last_name rlast_name, m.date_matched FROM match_table AS m INNER JOIN user_table AS d ON d.user_id = m.donor_user_id INNER JOIN states AS sd ON d.state_id = sd.state_id INNER JOIN user_table AS r ON r.user_id = m.reciever_user_id INNER JOIN states AS sr ON r.state_id = sr.state_id ORDER BY m.is_paid ASC";
        $result = $db->query($query);
        $output2 = '';
        $pstatus = '';
        $cstatus = '';
		$revdisabled ='';
        while($row = $result->fetch_array())
        {   
            if($row['is_paid'] == 0){
                $pstatus = '<span class = "text-primary">Unpaid</span>';
                $cstatus = '<span class = "text-primary">UnConfirmed</span>';
				$revdisabled = '';
            }else if($row['is_paid'] == 1){
                if($row['is_confirmed'] == 0){
				$revdisabled = 'disabled';                    
                $pstatus = '<span class = "text-success">Paid</span>';
                $cstatus = '<span class = "text-primary">UnConfirmed</span>';
                    
                }else if($row['is_confirmed'] == 1){
                $revdisabled = 'disabled'; 
                $pstatus = '<span class = "text-success">Paid</span>';
                $cstatus = '<span class = "text-success">Confirmed</span>';    
                }
            }
            $output2 .= '<tr id="user'.$row["match_id"].'">
                            <td>'.$row["match_id"].'</td>
                            <td>'.$row["dfirst_name"].' '.$row["dlast_name"].'</td>
                            <td>'.$row["sdstate"].'</td>
                            <td>&#8358; '.$row["matched_amount"].'</td>
                            <td>'.$row["rfirst_name"].' '.$row["rlast_name"].'</td>
                            <td>'.$row["srstate"].'</td>
                            <td>'.$row["date_matched"].'</td>
                            <td>'.$pstatus.'</td>
                            <td>'.$cstatus.'</td>
                            <td><button type="button" name="update" id="'.$row["match_id"].'" class="update btn btn-secondary">Update</button></td>
                            <td><button type="button" name="view" id="'.$row["match_id"].'" class="view btn btn-warning">View</button></td>
                            <td><button type="button" value="'.$row["matched_amount"].'" name="delete" id="'.$row["match_id"].'" class="delete btn btn-danger" '.$revdisabled.'>Delete</button></t d>
                        </tr>
                            '; 
        } 
        echo($output2);
    }
    
    if($_POST["action"] == "get_donors" && isset($_POST["user_id"]))
    {
        $query = "SELECT * FROM match_table AS m INNER JOIN user_table AS r ON r.user_id = m.reciever_user_id INNER JOIN states AS sr ON r.state_id = sr.state_id INNER JOIN banks AS br ON br.bank_id = r.bank_id WHERE m.donor_user_id = '{$_POST["user_id"]}' AND is_confirmed = 0 ORDER BY m.is_paid ASC";
        $result = $db->query($query);
        $output2 = '';
        $pstatus = '';
        
		
        while($row = $result->fetch_array())
        {   
            if($row['is_paid'] == 0){
                $pstatus = '<a class = "pay btn deep-orange lighten-1 waves-effect waves-light modal-trigger" id="'.$row["match_id"].'" data-target="pay_modal">I have paid</span>';
                
            }else if($row['is_paid'] == 1){
                            
                $pstatus = '<span class="deep-orange-text text-lighten-2">AWAITING CONFIRMATION </span>';
                    }
            
            $output2 .= '<tr><td>
                                <div class="chip">
                                    <img src="'.$row["profile_pic"].'" alt="'.$row["first_name"].' '.$row["last_name"].'"> '.$row["first_name"].' '.$row["last_name"].'
                                </div>
                            </td>
                            <td>'.$row["phone_number"].'</td>
                            <td>&#8358; '.$row["matched_amount"].'</td>
                            <td><div class="chip">
                                    <img src="data:image/jpeg;base64,'.base64_encode($row["logo"]).'" alt="'.$row["bank"].'"> '.$row["bank"].'
                                </div></td>
                            <td>'.$row["acc_number"].'</td>
                            <td><div class="data-countdown" data-countdown="'.$row["date_matched"].'"></div></td>
                            <td>'.$pstatus.'</td></tr>'; 
        } 
        echo($output2);
    }
    
    
    if($_POST["action"] == "get_recievers" && isset($_POST["user_id"]))
    {
        $query = "SELECT * FROM match_table AS m INNER JOIN user_table AS d ON d.user_id = m.donor_user_id INNER JOIN states AS sd ON d.state_id = sd.state_id INNER JOIN banks AS bd ON bd.bank_id = d.bank_id WHERE m.reciever_user_id = '{$_POST["user_id"]}' AND is_confirmed = 0 ORDER BY m.is_paid DESC";
        $result = $db->query($query);
        $output3 = '';
        $pstatus = '';
		$gender = '';
        $mtime ='';
		$duetime='';
		 while($row = $result->fetch_array())
        {   
            if($row['is_paid'] == 0){
                $pstatus = '<span class = "teal-text text-lighten-1"d>AWAITING PAYMENT</span>';
				$row['date_paid'] = 'Not yet paid';
                
            }else if($row['is_paid'] == 1){
                $pstatus = '<a class ="confirm btn teal lighten-1" id="'.$row["match_id"].'">Confirm</span>';            
                
                    };
			 if($row['gender'] == 'female'){
				 $gender = 'F';
			 }else if($row['gender'] == 'male'){
				 $gender = 'M';
			 }
            $mtime = strtotime($row["date_matched"]);
			$duetime = strtotime("+72 hours", $mtime);
			$dtime = date("Y-m-d H:i:s", substr($duetime, 0, 10));
            $output3 .= '<tr><td>
                                <div class="chip">
                                    <img src="'.$row["profile_pic"].'" alt="'.$row["first_name"].' '.$row["last_name"].'"> '.$row["first_name"].' '.$row["last_name"].'
                                </div>
                            </td>
							<td>'.$gender.'</td>
                            <td>'.$row["phone_number"].'</td>
                            <td>&#8358; '.$row["matched_amount"].'</td>
                            <td><div class="chip">
                                    <img src="../_assets/img/matchqrcode.png" alt="'.$row["bank"].'"> '.$row["match_id"].'
                                </div></td>
                            <td>'.$dtime.'</td>
                            <td>'.$row["date_paid"].'</td>
						   <td>'.$pstatus.'</td></tr>'; 
        } 
        echo($output3);
    }
   
   //get Match data to display on USER Index page I have paid modal
	if($_POST['action'] == 'get_for_cancel' && isset($_POST['match_id']))
    {
        $data = [];
        $query = "SELECT * FROM match_table WHERE match_table.match_id = '{$_POST['match_id']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        while($row = $result->fetch_array()){
            $data['match_id'] = $row['match_id'];
            $data['donor_user_id'] = $row['donor_user_id'];
            $data['donor_request_id'] = $row['donor_request_id'];
            $data['reciever_user_id'] = $row['reciever_user_id'];
            $data['recieve_request_id'] = $row['recieve_request_id'];
            $data['matched_amount'] = $row['matched_amount'];
                
        };
        echo json_encode($data);
    }
   
	if($_POST['action'] == 'reversematch' && isset($_POST["reverseid"])){
        
       $query1 = "DELETE FROM match_table WHERE match_id = '{$_POST['reverseid']}'";
       $query2 = "UPDATE donor_request_table SET amount_unmatched = amount_unmatched + '{$_POST['matched_amount']}' WHERE donor_request_id = '{$_POST['donation_request_id']}'";
       $query3 = "UPDATE recieve_request_table SET amount_unmatched = amount_unmatched + '{$_POST['matched_amount']}' WHERE recieve_request_id = '{$_POST['reciever_request_id']}'";
       
     require_once('../scripts/connect.php');
        $result1 = $db->query($query1);
        $result2 = $db->query($query2);
        $result3 = $db->query($query3);
        
     
        if($result3){
            echo 'reversed';
        }else{
            echo var_dump($result3);
        };
        
    };
	
	
	if($_POST['action'] == 'reset_all'){
        
       $query1 = "DELETE FROM match_table";
       $query2 = "DELETE FROM donor_request_table";
       $query3 = "DELETE FROM recieve_request_table";
       $query4 = "UPDATE user_table SET don_balance = 0, rec_balance = 0, total_don = 0, total_rec = 0, eligibility = 0";
       
     require_once('../scripts/connect.php');
        $result1 = $db->query($query1);
        $result2 = $db->query($query2);
        $result3 = $db->query($query3);
        $result3 = $db->query($query4);
        
     
        if($result1){
            echo 'all reset';
        }else{
            echo 'reset_failed';
        };
        
    };
	
	if($_POST['action'] == 'chat'){
		$message = mysqli_real_escape_string($db, $_POST['message']);
		$query = "INSERT INTO chat_table (chat_user_id, chat_message, chat_date) VALUES ('{$_POST['user_id']}','$message',NOW())";
      $result = $db->query($query);
		if($result){
            echo 'sent';
        }else{
            echo var_dump($message);
        };
	};
	
	if($_POST['action'] == 'get_chat'){
		$chat = '';
		$query = "SELECT * FROM chat_table JOIN user_table ON chat_table.chat_user_id = user_table.user_id ORDER BY chat_date DESC";
      $result = $db->query($query);
		if($result->num_rows > 0){
            while($row = $result->fetch_array()){
				$chat.='<li class="collection-item avatar">
      <img src="user/'.$row["profile_pic"].'" alt="" class="circle">
		<span class="title orange-text">'.$row["first_name"].'</span><span class="grey-text">&nbsp; &#8226; '.$row["chat_date"].'</span>
      <p>'.$row["chat_message"].'
      </p>
     
    </li>';
				
				
			}
			
			echo $chat;
        }else{
            echo var_dump($message);
        };
	};
	
	if($_POST['action'] == 'forgotemail'){
		$query = "SELECT * FROM user_table WHERE email = '{$_POST['email']}' LIMIT 1";
      $result = $db->query($query);
		if($result->num_rows > 0){
		while($row = $result->fetch_array()){
			$username = $row['first_name'];
			$usermail = $row['email'];
			$password = $row['password'];
		}
			
		$bizname = "KoboWise";
		$website = "www.kobowise.cf";
		
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
    	$mail->Subject = 'Forgot Your Password?';
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

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
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

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
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

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
           display: none !important;
           opacity: 0.01 !important;
       }
       
       img.g-img + div {
           display: none !important;
       }

        
        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
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

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
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
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #222222;">
    <tr>
    <td>
    <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            Hello '.$username.', it seems you forgot your '.$bizname.' Password. No worries. Here are your Login Details again - Your email is: '.$usermail.'. And your password is: '.$password.'. For security purposes, please Login to '.$website.' and change your password as soon as possible. You are recieving this email because you tried to recover your password on '.$website.'. If you think we made a mistake, please ignore this message, otherwise, please login and change your password. Thank you for using '.$bizname.'.
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
	        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->

        <!-- Email Body : BEGIN -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;" class="email-container">
	        <!-- Email Header : BEGIN -->
            <tr>
                <td style="padding: 10px 0; text-align: center">
                    <img src="https://i.imgur.com/IRkldcO.png" width="200" height="50" alt="Kobowise Logo" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px;">
                </td>
            </tr>
	        <!-- Email Header : END -->

            
			 <!-- Background Image with Text : BEGIN -->
            <tr>
                <!-- Bulletproof Background Images c/o https://backgrounds.cm -->
                <td valign="middle" style="text-align: center; background-image: url(https://i.imgur.com/yBvsOQj.jpg); background-color: #eeeeee; background-position: center center !important; background-size: cover !important;">
	                
	                <div>
	                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
	                        <tr>
	                            <td valign="middle" style="text-align: left; padding-left: 15px; padding-top: 200px; padding-bottom: 20px; font-family: sans-serif; font-size: 15px; line-height: 40px; color: #fefefe; background-color:rgba(0,0,0,0.3);">
	                                <h2 style="margin: 0; text-shadow: 1px 1px #616161;">Password <span style="color: #ff7600;">Recovery</span></h2>
	                            </td>
	                        </tr>
	                    </table>
	                </div>
	               
	            </td>
	        </tr>
	        <!-- Background Image with Text : END -->

            <!-- 1 Column Text + Button : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding-bottom: 0px;">
								<h1 style="margin: 0 0 10px; font-size: 20px; line-height: 30px; color: #333333; font-weight: normal;">Hello <span style="color: #ff7600; font-weight: 600;">'.$username.'</span>.</h1>
								<p style="margin: 0 0 10px;">It seems you forgot your <span style ="color: #26a69a; font-weight: 600;">'.$bizname.'</span> <span style="font-weight: 600;">Password</span>. No worries, we all forget things sometimes. Here is a quick reminder of your account details: </p>
                                <ul style="padding: 0; margin: 0; list-style-type: disc;">
									<li style="margin:0 0 10px 20px;" class="list-item-first">Name: <span style=" font-weight: bold;">'.$username.'</span></li>
									<li style="margin:0 0 10px 20px;">Email: <span style=" font-weight: bold;">'.$usermail.'</span></li>
									<li style="margin: 0 0 0 20px;" class="list-item-last">Your Password: <span style="color:#ff7000; font-weight: bold;">'.$password.'</span></li>
								</ul>
								<p style="margin: 0 10 0px;">Please Login and &#40; for security purposes &#41; Change Your Password as soon as possible. And always keep <strong>ALL</strong> your passwords safe.</p> <p style="color: grey; text-align: center;"><i>Pro Tip: With Google Chrome, You can save your Login Details in your browser.</i></p><p style="text-align: center;">Dear <span style="color: #ff7600;">'.$username.',</span> Thank you for using <span style="color: #26a69a;">'.$bizname.'</span>.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 20px 20px;">
                                <!-- Button : BEGIN -->
                                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                                    <tr>
                                        <td class="button-td button-td-primary" style="border-radius: 4px; background: #eeeeee;">
											<a class="button-a button-a-primary" href="'.$website.'" style="background: #222222; border: 1px solid #000000; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 13px; color: #ffffff; display: block; border-radius: 4px;">Click Here to Login</a>
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
	                            You are getting this mail because we think you tried to recover your password from '.$website.'. If you think this is a mistake, just ignore this message.
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
                    <img src="https://i.imgur.com/IRkldcO.png" width="200" height="50" alt="KoboWise Logo" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px;">
                </td></tr>
	        <tr>
	            <td style="padding-top: 10px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">
	               
	          
	                '.$website.'<br><span class="unstyle-auto-detected-links">123 KoboWise Street, SpringField, OR, 97477 US<br>(123) 456-7890</span>
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
	                                <p style="margin: 0; font-size: 12px;">Email scanners, Sniffers and Phishers can hack into your account by getting your information from this email. To prevent this, please login and change your password as soon as you can.</p>
	                            </td>
	                        </tr>
	                    </table>
	                  
	                </div>
	            </td>
	        </tr>
	    </table>
	    <!-- Full Bleed Background Section : END -->

   
    </center>
</body>
</html>
';
    	$mail->AltBody = 'Hello '.$username.', it seems you forgot your '.$bizname.' Password. No worries. Here are your Login Details again - Your email is: '.$usermail.'. And your password is: '.$password.'. For security purposes, please Login to '.$website.' and change your password as soon as possible. You are recieving this email because you tried to recover your password on '.$website.'. If you think we made a mistake, please ignore this message, otherwise, please login and change your password. Thank you for using '.$bizname.'.';
		
		$mail->send();
			
			echo "success";
        }else{
            echo "failed";
        };
	};
	
	if($_POST['action'] == 'get_transactions')
	{
		$txns = '';
		$query = "SELECT d.first_name dfirst_name, d.profile_pic dprofile_pic, m.matched_amount, r.first_name rfirst_name, r.profile_pic rprofile_pic, m.date_confirmed FROM match_table AS m INNER JOIN user_table AS d ON d.user_id = m.donor_user_id INNER JOIN user_table AS r ON r.user_id = m.reciever_user_id WHERE (m.reciever_user_id = '{$_POST['user_id']}' OR m.donor_user_id = '{$_POST['user_id']}') AND m.is_confirmed = 1 ORDER BY m.date_confirmed DESC LIMIT 5";
      $result = $db->query($query);
		if($result->num_rows > 0){
            while($row = $result->fetch_array()){
				$txns.='<tr>
                            <td>
                                <div class="chip">
                                    <img src="'.$row["dprofile_pic"].'" alt="Contact Person"> <span class="teal-text">'.$row["dfirst_name"].'<span class="hide-on-small-only"></span></span>
                                </div>
                            </td>
							<td>&#8358;<span class="teal-text">'.$row["matched_amount"].'</span></td>

                            <td>
                                <div class="chip">
                                    <img src="'.$row["rprofile_pic"].'" alt="Contact Person"> <span class="teal-text">'.$row["rfirst_name"].'</span>
                                </div>
                            </td>
                            
                            
							<td><span class="teal-text hide-on-small-only">'.$row["date_confirmed"].'</span></td>
                        </tr>';
				
				
			}
			
			echo $txns;
        }else{
            echo "Seems you don't have any Transactions yet";
        };
	};
	
	if($_POST['action'] == 'admin_give_eligibility'){
		$query = "UPDATE user_table SET don_balance = don_balance + '{$_POST['match_amount']}', total_don = total_don + '{$_POST['match_amount']}', rec_balance = rec_balance + '{$_POST['match_amount']}', eligibility = eligibility + '{$_POST['match_amount']}' WHERE user_id = '{$_POST['user_id']}'"; 
		
		$result = $db->query($query);
		if($result){
			echo "success";
		}else{
			echo var_dump($result);
		}
	};
	
}

?>