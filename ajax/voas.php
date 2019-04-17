<?php 
// ajax for VOAS 

if(isset($_POST["action"]))
{
    //Get all VOAs and Display on ADMIN VOA PAGE
    require_once('../scripts/connect.php');
    if($_POST["action"] == "fetch")
    {
        $query = "SELECT * FROM recieve_request_table JOIN user_table ON user_table.user_id = recieve_request_table.reciever_user_id ORDER BY recieve_request_table.date_requested DESC";
        $result = $db->query($query);
        $output = '';
        $disabled = '';
        $btnstyle = '';
		$voa_approval = '';
        while($row = $result->fetch_array())
        {   
            if($row['amount_unmatched'] < $row['amount_to_recieve'] && $row['voa_approval'] == 1){
                $disabled = 'disabled';
                $btnstyle = 'btn-secondary';
            }else {
                $disabled = '';
                $btnstyle = 'btn-primary';
            }
			if($row['voa_approval'] == 0){
				$voa_approval = '<span class="text-primary">Not Yet Approved</span>';
			}else if($row['voa_approval'] == 1){
				$voa_approval = '<span class="text-success">Approved</span>';
			}else if($row['voa_approval'] == 2){
				$voa_approval = '<span class="text-danger">Unapproved</span>';
			}
            $output .= '<tr id="user'.$row["user_id"].'">
                            <td>'.$row["recieve_request_id"].'</td>
                            <td>'.$row["first_name"].' '.$row["last_name"].'</td>
                            <td>&#8358; '.$row["amount_to_recieve"].'</td>
                            <td><a href="'.$row["voa_link"].'" target="_blank">'.$row["voa_link"].'</a></td>
                            <td>'.$voa_approval.'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["phone_number"].'</td>
                           <td>'.$row["date_requested"].'</td>
                           <td>&#8358; '.$row["amount_unmatched"].'</td>
                            <td><button type="button" name="change" id="'.$row["recieve_request_id"].'" value="'.$row["reciever_user_id"].'" class="approve btn '.$btnstyle.'" '.$disabled.'>Approve</button></td>
                            <td><button type="button" id="'.$row["recieve_request_id"].'" class="approve btn btn-warning" value="'.$row["reciever_user_id"].'">Unapprove</button></td>
                            <td><button type="button" name="cancel" id="'.$row["recieve_request_id"].'" class="Delete btn btn-danger" '.$disabled.'>Delete</button></td>
                        </tr>
                            '; 
        } 
        echo ($output);
    }
    
    //Get SINGLE USER VOA REQUEST DETAILS in APPROVE/DISAPPROVE MODALS on ADMIN VOA PAGE
    if($_POST['action'] == 'check' && isset($_POST['recid']))
    {
        $data = [];
        $astatus = '';
        $adate = '';
        $matchdate = '';
        $matchstatus = '';
        $query = "SELECT * FROM recieve_request_table JOIN user_table ON user_table.user_id = recieve_request_table.reciever_user_id JOIN states ON user_table.state_id = states.state_id WHERE recieve_request_table.recieve_request_id = '{$_POST['recid']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        while($row = $result->fetch_array()){
            
            $data['recieve_request_id'] = $row['recieve_request_id'];
            $data['date_requested'] = $row['date_requested'];
            $data['firstname'] = $row['first_name'];
            $data['lastname'] = $row['last_name'];
            $data['email'] = $row['email'];
            $data['amount_requested'] = $row['amount_to_recieve'];
            $data['voa_link'] = '<a href="'.$row['voa_link'].'" target="_blank">'.$row['voa_link'].'</a>';
            $data['gender'] = $row['gender'];
            $data['state'] = $row['state'];
            $data['user_strikes'] = $row['user_strikes'];
                
        };
        echo json_encode($data);
    }
    
    //INSERT VOA LINK FROM USER REQUEST ON USER HOME PAGE
    if($_POST['action'] == 'inserturl' && isset($_POST['voa_url']))
    {
        $output ='';
        $query = "INSERT INTO recieve_request_table (reciever_user_id, amount_to_recieve, amount_remaining, amount_unmatched, voa_link, date_requested) VALUES ('{$_POST['user_id']}','{$_POST['eligibility']}','{$_POST['eligibility']}','{$_POST['eligibility']}','{$_POST['voa_url']}', NOW())";
        $query2 = "UPDATE user_table SET eligibility = 0, don_balance = 0 WHERE user_id = '{$_POST['user_id']}'";
        $result = $db->query($query);
        $result2 = $db->query($query2);
        if($result == true && $result2 == true){
            $output = "successful";
        }else{
            $ouptut = "failed";
        }
        echo $output;
    }
    
    //INSERT VOA FILE FROM USER REQUEST ON USER HOME PAGE
    if($_POST['action'] == 'insertfile' && isset($_POST['voa_file']))
    {
        $output ='';
        $_POST['voa_link'] = urlencode($_POST['voa_link']) ;
        $query = "INSERT INTO recieve_request_table (reciever_user_id, amount_to_recieve, amount_remaining, amount_unmatched, voa_link, date_requested) VALUES ('{$_POST['user_id']}','{$_POST['eligibility']}','{$_POST['eligibility']}','{$_POST['eligibility']}','{$_POST['voa_url']}', NOW())";
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        if($result == true){
            $output = "successful";
        }else{
            $ouptut = "failed";
        }
        echo $output;
    }
    
    //INSERT BOTH VOA FILE AND VOA LINK FROM USER REQUEST ON USER HOME PAGE
    if($_POST['action'] == 'insertboth' && isset($_POST['voa_file']) && isset($_POST['voa_url']))
    {
        $output ='';
        $_POST['voa_link'] = urlencode($_POST['voa_link']) ;
        $query = "INSERT INTO recieve_request_table (reciever_user_id, amount_to_recieve, amount_remaining, amount_unmatched, voa_link, date_requested) VALUES ('{$_POST['user_id']}','{$_POST['eligibility']}','{$_POST['eligibility']}','{$_POST['eligibility']}','{$_POST['voa_url']}', NOW())";
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        if($result == true){
            $output = "successful";
        }else{
            $ouptut = "failed";
        }
        echo $output;
    }
    
    //APPROVE VOA REQUEST FROM ADMIN VOA PAGE
    if($_POST['action'] == 'approve_voa' && isset($_POST['requestid']))
    {
        $query = "UPDATE recieve_request_table SET voa_approval = 1, date_approved = now() WHERE recieve_request_id = '{$_POST['requestid']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
    if($result){
        echo 'successful';
    }else{
          
        echo 'failed'; }
        
    }
    
    //UNAPPROVE VOA REQUEST FROM ADMIN VOA PAGE
    if($_POST['action'] == 'unapprove_voa' && isset($_POST['requestid']))
    {
        $query = "UPDATE recieve_request_table SET voa_approval = 2, date_approved = now() WHERE recieve_request_id = '{$_POST['requestid']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
    if($result){
        echo 'successful';
    }else{
          
        echo 'failed'; }
        
    }
	
	//GET VOA REQUEST FROM USER ELIGIBILITY PAGE
	
	if($_POST['action']=='get_u_rec_req_tab'){
		$record_per_page = 5;
		$page = '';
		$dsbleft = '';
		$dsbright = '';
		$status = '';
		$voa_approval = '';
		$output = '<table class="responsive-table centered blue-grey darken-4 white-text">
                    <thead class="blue-grey darken-2">
                        <tr>
                            <th>
                                S/N
                            </th>
                            <th>Date Requested</th>
                            <th>Eligibility</th>
                            <th>VoA Link</th>
                            <th>Approval</th>
                            <th>Status</th>
                            <th>Amount Remaining</th>
                            <th>Change VoA</th>
                            <th>Cancel</th>

                        </tr>
                    </thead>

                    <tbody>';
		$date_matched = '';
		$chbtnstyle = '';
		$cabtnstyle = '';
		if(isset($_POST["page"])){
			$page = $_POST['page'];
		}else{
			$page = 1;
		}
		if($page == 1){
				$dsbleft = 'disabled';
			}else{
				$dsbleft = '';
		};
		$nxtpg = $page + 1;
		$prvpg = $page - 1;
		$start_from = ($page - 1) * $record_per_page;
		
		$query = "SELECT * FROM recieve_request_table WHERE reciever_user_id = '{$_POST['user_id']}' ORDER BY amount_remaining DESC LIMIT $start_from, $record_per_page";
		$result = $db->query($query);
		if($result->num_rows >0){
			
		while($row = $result->fetch_array()){
			 if($row['amount_unmatched'] < $row['amount_to_recieve'] && $row['amount_unmatched'] > 0){
                $disabled = 'disabled';
                $chbtnstyle = 'btn-flat';
                $cabtnstyle = 'btn-flat';
                $status = '<span class="blue-text">Partially matched</span>';
				$date_matched = $row['date_matched'];
            }else if($row['amount_unmatched'] < $row['amount_to_recieve'] && $row['amount_unmatched'] == 0){
				$disabled = 'disabled';
                $chbtnstyle = 'btn-flat';
                $cabtnstyle = 'btn-flat';
                $status = '<span class="green-text">Completely matched</span>';
				$date_matched = $row['date_matched'];
				 
			 }else if($row['amount_unmatched'] == $row['amount_to_recieve']){
                $disabled = '';
                $cabtnstyle = 'red';
                $chbtnstyle = 'amber';
                $status = '<span class="amber-text">Searching for Match</span>';
				$date_matched = 'Not yet Matched';
            };
			if($row['voa_approval'] == 0){
				$voa_approval = '<span class="text-primary">Not Yet Approved</span>';
			}else if($row['voa_approval'] == 1){
				$voa_approval = '<span class="text-success">Approved</span>';
			}else if($row['voa_approval'] == 2){
				$voa_approval = '<span class="text-danger">Unapproved</span>';
			}
			
			
			$output .= '<tr>
			<td>'.$row["recieve_request_id"].'</td>
			<td>'.$row["date_requested"].'</td>
			<td>&#8358;'.$row["amount_to_recieve"].'</td>
			<td><a href = "'.$row["voa_link"].'" target = "_blank">VoA Link</a></td>
			<td>'.$voa_approval.'</td>
			<td>'.$status.'</td>
			<td>&#8358;'.$row["amount_remaining"].'</td>
			<td><a id="'.$row["recieve_request_id"].'" class="btn don_change '.$chbtnstyle.' '.$disabled.'">Change</a></td>
			<td><a id="'.$row["recieve_request_id"].'" class="btn don_cancel '.$cabtnstyle.' '.$disabled.'" >Cancel</a></td>
			</tr>';
		}
		$output.='</tbody></table><div class="col s12 m12 l12 center"> <ul class="pagination"><li id="'.$page.'" value="'.$prvpg.'" class="don_req_page_left '.$dsbleft.'"><a><i class="fa fa-caret-left"></i></a></li>';
		$page_query = "SELECT * FROM recieve_request_table WHERE reciever_user_id = '{$_POST['user_id']}' ORDER BY date_requested DESC";
			$active = '';
		$page_result = $db->query($page_query);
		$total_number = $page_result->num_rows;
		$total_pages = ceil($total_number/$record_per_page);
		for($i=1; $i<=$total_pages; $i++){
			if($i == $page){
				$active = 'active';
			}else{
				$active = '';
			}
			$output .= '<li id="'.$i.'" class="waves-effect rec_req_page_link '.$active.'"><a>'.$i.'</a></li>';
		};
		if($page == $total_pages){
			$dsbright = 'disabled';
		}else{
			$dsbright = '';
		}
		$output .='<li id="'.$page.'" value="'.$nxtpg.'" class="rec_req_page_right '.$dsbright.'"><a><i class="fa fa-caret-right"></i></a></li>
  </ul><input type="hidden" id="last_don_req_page" value="'.$total_pages.'"></div>';	
			
		
			
		}else{
			$output.='<tr><td>Seems</td> <td>You</td> <td>haven\'t</td> <td>offered</td> <td>any</td> <td>Donations</td> <td>Yet</td><td><a class="btn waves-effect waves-light blue">Donate</a></td></tr></tbody></table><div class="col s12 m12 l12 center"> <ul class="pagination"><li class="disabled"><a href="#!"><i class="fa fa-caret-left"></i></a></li><li id="1" class="don_req_page_link active"><a>1</a></li><li class="disabled"><a><i class="fa fa-caret-right"></i></a></li>
  </ul></div>';
		}
	echo $output;
	}
	
	
	if($_POST['action']=='get_u_rec_match_tab'){
		$record_per_page = 5;
		$page = '';
		$dsbleft = '';
		$dsbright = '';
		$output = '<table class="responsive-table centered blue-grey darken-4 white-text">
                    <thead class="blue-grey darken-2">
                        <tr>
                            <th>
                                Match Code
                            </th>
                            <th><div>Name</div></th>
                            <th>Sex</th>
                            <th>Phone Number</th>
                            <th>Amount</th>
                            <th><div>Bank<div></th>
                            <th>Account Number</th>
                            <th>Date Matched</th>
                            <th>Confirmation</th>
                            
                            

                        </tr>
                    </thead>

                    <tbody>';
		$date_paid = '';		
		if(isset($_POST["page"])){
			$page = $_POST['page'];
		}else{
			$page = 1;
		}
		if($page == 1){
				$dsbleft = 'disabled';
			}else{
				$dsbleft = '';
		};
		$nxtpg = $page + 1;
		$prvpg = $page - 1;
		$start_from = ($page - 1) * $record_per_page;
		
		$query = "SELECT * FROM match_table JOIN user_table ON match_table.donor_user_id = user_table.user_id JOIN banks ON user_table.bank_id = banks.bank_id WHERE match_table.reciever_user_id = '{$_POST['user_id']}' ORDER BY is_confirmed ASC LIMIT $start_from, $record_per_page";
		$result = $db->query($query);
		if($result->num_rows >0){
			
		while($row = $result->fetch_array()){
			 if($row['is_paid'] == 0){
                $date_paid = '<a id="'.$row["match_id"].'" class="btn pay blue waves-effect waves-light">I have paid</a>';
             	
            }else if($row['is_paid'] == 1 && $row['is_confirmed'] == 0){
				$date_paid = '<span class="orange-text">AWAITING CONFIRMATION</span>';
              				 
			 }else if($row['is_paid'] == 1 && $row['is_confirmed'] == 1){
                $date_paid = '<span class="green-text">CONFIRMED</span>';
                     };
			if($row['gender'] == 'female'){
				 $gender = 'F';
			 }else if($row['gender'] == 'male'){
				 $gender = 'M';
			 }
			
			
			$output .= '<tr>
			<td>'.$row["match_id"].'</td>
			<td><div class="chip">
                                    <img src="'.$row["profile_pic"].'" alt="'.$row["first_name"].' '.$row["last_name"].'"> '.$row["first_name"].' '.$row["last_name"].'
                                </div></td>
			<td>'.$gender.'</td>
			<td>'.$row["phone_number"].'</td>
			
			<td>&#8358;'.$row["matched_amount"].'</td>
			<td><div class="chip">
                                    <img src="data:image/jpeg;base64,'.base64_encode($row["logo"]).'" alt="'.$row["bank"].'"> '.$row["bank"].'
                                </div></td>
			<td>'.$row["acc_number"].'</td>
			<td>'.$row["date_matched"].'</td>
			<td>'.$date_paid.'</td>
			
			</tr>';
		}
		$output.='</tbody></table><div class="col s12 m12 l12 center"> <ul class="pagination"><li id="'.$page.'" value="'.$prvpg.'" class="don_match_page_left '.$dsbleft.'"><a><i class="fa fa-caret-left"></i></a></li>';
		$page_query = "SELECT * FROM match_table WHERE reciever_user_id = '{$_POST['user_id']}' ORDER BY is_paid ASC";
			$active = '';
		$page_result = $db->query($page_query);
		$total_number = $page_result->num_rows;
		$total_pages = ceil($total_number/$record_per_page);
		for($i=1; $i<=$total_pages; $i++){
			if($i == $page){
				$active = 'active';
			}else{
				$active = '';
			}
			$output .= '<li id="'.$i.'" class="waves-effect don_match_page_link '.$active.'"><a>'.$i.'</a></li>';
		};
		if($page == $total_pages){
			$dsbright = 'disabled';
		}else{
			$dsbright = '';
		}
		$output .='<li id="'.$page.'" value="'.$nxtpg.'" class="don_match_page_right '.$dsbright.'"><a><i class="fa fa-caret-right"></i></a></li>
  </ul><input type="hidden" id="last_don_match_page" value="'.$total_pages.'"></div>';	
			
		
			
		}else{
			$output.='<tr><td>Seems</td> <td>You</td> <td>haven\'t</td> <td>offered</td> <td>any</td> <td>Donations</td> <td>Yet</td><td><a class="btn waves-effect waves-light blue">Donate</a></td></tr></tbody></table><div class="col s12 m12 l12 center"> <ul class="pagination"><li class="disabled"><a href="#!"><i class="fa fa-caret-left"></i></a></li><li id="1" class="don_req_page_link active"><a>1</a></li><li class="disabled"><a><i class="fa fa-caret-right"></i></a></li>
  </ul></div>';
		}
	echo $output;
	}
	
    if($_POST['action'] == 'updateurl'){
		$query = "UPDATE recieve_request_table SET voa_approval = 0, date_requested = now(), voa_link = '{$_POST['voa_url']}' WHERE recieve_request_id = '{$_POST['voa_id']}' AND reciever_user_id = '{$_POST['user_id']}'";
		$result = $db->query($query);
		if($result){
			echo "successful";
		}else{
			echo"failed";
		}
	}
    //TODO: DELETE/CANCEL VOA REQUEST FROM ADMIN VOA PAGE
    
    //TODO: CLOSE DATABASE CONNECTION FROM VOA AJAX PAGE
}

?>