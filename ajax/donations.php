<?php 
// ajax to fetch all users 

if(isset($_POST["action"]))
{
    require_once('../scripts/connect.php');
    if($_POST["action"] == "fetch")
    {
        $query = "SELECT * FROM donor_request_table JOIN user_table ON user_table.user_id = donor_request_table.donor_user_id ORDER BY donor_request_table.amount_unmatched DESC";
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
            $output .= '<tr id="donation'.$row["donor_request_id"].'">
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
    
    if($_POST["action"] == "mini")
    {
        $query = "SELECT * FROM user_table ORDER BY user_id ASC";
        $result = $db->query($query);
        $output2 = '';
        while($row = $result->fetch_array())
        {
            $output2 .= '<tr id="user'.$row["user_id"].'">
                            <td>'.$row["user_id"].'</td>
                            <td>'.$row["first_name"].' '.$row["last_name"].'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["phone_number"].'</td>
                            <td>'.$row["gender"].'</td>
                            <td>'.$row["signup_date"].'</td>
                            <td><button type="button" name="update" id="'.$row["user_id"].'" class="update btn btn-secondary">Update</button></td>
                            <td><button type="button" name="view" id="'.$row["user_id"].'" class="view btn btn-warning">View</button></td>
                            <td><button type="button" name="delete" id="'.$row["user_id"].'" class="delete btn btn-danger">Delete</button></t d>
                        </tr>
                            '; 
        } 
        echo($output2);
    }
   
	if($_POST["action"] == "get_user")
    {
        $query = "SELECT * FROM donor_request_table WHERE donor_request_table.donor_user_id = '{$_POST['user_id']}' ORDER BY donor_request_table.date_offered DESC";
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
                            <td>'.$row["amount_offered"].'</td>
                            <td>'.$row["date_offered"].'</td>
                            <td>'.$row["amount_unmatched"].'</td>
                           <td>'.$row["amount_remaining"].'</td>
                           <td>'.$row["amount_to_give"].'</td>
                            <td>'.$row["amount_given"].'</td>
                            <td><button type="button" name="change" id="'.$row["donor_request_id"].'" value="'.$row["donor_request_id"].'" class="change btn '.$btnstyle.'" '.$disabled.'>Change</button></td>
                            <td><button type="button" name="view" id="'.$row["donor_request_id"].'" class="view btn btn-warning" value="'.$row["donor_request_id"].'">View</button></td>
                            <td><button type="button" name="cancel" id="'.$row["donor_request_id"].'" class="cancel btn btn-danger" '.$disabled.'>Cancel</button></td>
                        </tr>
                            '; 
        } 
        echo ($output);
    };
	
	if($_POST['action']=='get_u_don_req_tab'){
		$record_per_page = 5;
		$page = '';
		$dsbleft = '';
		$dsbright = '';
		$status = '';
		$output = '<table class="responsive-table centered blue-grey darken-4 white-text">
                    <thead class="blue-grey darken-2">
                        <tr>
                            <th>
                                S/N
                            </th>
                            <th>Date</th>
                            <th>Amount Offered</th>
                            <th>status</th>
                            <th>Remaining</th>
                            <th>Date Matched</th>
                            <th>Change</th>
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
		
		$query = "SELECT * FROM donor_request_table WHERE donor_user_id = '{$_POST['user_id']}' ORDER BY amount_remaining DESC LIMIT $start_from, $record_per_page";
		$result = $db->query($query);
		if($result->num_rows >0){
			
		while($row = $result->fetch_array()){
			 if($row['amount_unmatched'] < $row['amount_offered'] && $row['amount_unmatched'] > 0){
                $disabled = 'disabled';
                $chbtnstyle = 'btn-flat';
                $cabtnstyle = 'btn-flat';
                $status = '<span class="blue-text">Partially matched</span>';
				$date_matched = $row['date_matched'];
            }else if($row['amount_unmatched'] < $row['amount_offered'] && $row['amount_unmatched'] == 0){
				$disabled = 'disabled';
                $chbtnstyle = 'btn-flat';
                $cabtnstyle = 'btn-flat';
                $status = '<span class="green-text">Completely matched</span>';
				$date_matched = $row['date_matched'];
				 
			 }else if($row['amount_unmatched'] == $row['amount_offered']){
                $disabled = '';
                $cabtnstyle = 'red';
                $chbtnstyle = 'amber';
                $status = '<span class="white-text">Searching <i class="fas fa-spinner fa-pulse white-text"></i></span>';
				$date_matched = 'Not yet Matched';
            }
			
			
			$output .= '<tr>
			<td>'.$row["donor_request_id"].'</td>
			<td>'.$row["date_offered"].'</td>
			<td>&#8358;'.$row["amount_offered"].'</td>
			<td>'.$status.'</td>
			<td>&#8358;'.$row["amount_remaining"].'</td>
			<td>'.$date_matched.'</td>
			<td><a id="'.$row["donor_request_id"].'" value="'.$row["amount_offered"].'" class="btn don_change '.$chbtnstyle.' '.$disabled.'">Change</a></td>
			<td><a id="'.$row["donor_request_id"].'" class="btn don_cancel '.$cabtnstyle.' '.$disabled.'" >Cancel</a></td>
			</tr>';
		}
		$output.='</tbody></table><div class="col s12 m12 l12 center"> <ul class="pagination"><li id="'.$page.'" value="'.$prvpg.'" class="don_req_page_left '.$dsbleft.'"><a><i class="fa fa-caret-left"></i></a></li>';
		$page_query = "SELECT * FROM donor_request_table WHERE donor_user_id = '{$_POST['user_id']}' ORDER BY date_offered DESC";
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
			$output .= '<li id="'.$i.'" class="waves-effect don_req_page_link '.$active.'"><a>'.$i.'</a></li>';
		};
		if($page == $total_pages){
			$dsbright = 'disabled';
		}else{
			$dsbright = '';
		}
		$output .='<li id="'.$page.'" value="'.$nxtpg.'" class="don_req_page_right '.$dsbright.'"><a><i class="fa fa-caret-right"></i></a></li>
  </ul><input type="hidden" id="last_don_req_page" value="'.$total_pages.'"></div>';	
			
		
			
		}else{
			$output.='<tr><td>Seems</td> <td>You</td> <td>haven\'t</td> <td>offered</td> <td>any</td> <td>Donations</td> <td>Yet</td><td><a class="btn waves-effect waves-light blue">Donate</a></td></tr></tbody></table><div class="col s12 m12 l12 center"> <ul class="pagination"><li class="disabled"><a href="#!"><i class="fa fa-caret-left"></i></a></li><li id="1" class="don_req_page_link active"><a>1</a></li><li class="disabled"><a><i class="fa fa-caret-right"></i></a></li>
  </ul></div>';
		}
	echo $output;
	}
	
	if($_POST['action']=='get_u_don_match_tab'){
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
		
		$query = "SELECT * FROM match_table JOIN user_table ON match_table.reciever_user_id = user_table.user_id JOIN banks ON user_table.bank_id = banks.bank_id WHERE match_table.donor_user_id = '{$_POST['user_id']}' ORDER BY is_confirmed ASC LIMIT $start_from, $record_per_page";
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
		$page_query = "SELECT * FROM match_table WHERE donor_user_id = '{$_POST['user_id']}' ORDER BY is_paid ASC";
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
	
	if($_POST['action'] == 'admincancel'){
		$query = "DELETE FROM donor_request_table WHERE donor_request_id = '{$_POST['deleteid']}'";
		$result = $db->query($query);
		
		if($result){
            echo 'deleted';
        }else{
            echo var_dump($result);
        };
		
	}
	
	
}

?>