<?php 
ini_set('display_errors', 1); 
error_reporting(E_ALL);        

 if(isset($_POST["id"])){
    
    
        $data = [];
        $query = "SELECT * FROM user_table JOIN states ON user_table.state_id = states.state_id JOIN banks ON user_table.bank_id = banks.bank_id WHERE user_table.user_id = '{$_POST['id']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        while($row = $result->fetch_array()){
            $data['user_id'] = $row['user_id'];
            $data['profilepic'] = $row['profile_pic'];
            $data['firstname'] = $row['first_name'];
            $data['lastname'] = $row['last_name'];
            $data['email'] = $row['email'];
            $data['password'] = $row['password'];
            $data['phonenumber'] = $row['phone_number'];
            $data['gender'] = $row['gender'];
            $data['state'] = $row['state'];
            $data['state_id'] = $row['state_id'];
            $data['acc_number'] = $row['acc_number'];
            $data['bank'] = $row['bank'];
            $data['bank_id'] = $row['bank_id'];
            $data['strikes'] = $row['user_strikes'];
                
        };
        echo json_encode($data);
    }; 

if(isset($_POST["userid"])){
                
        $query = "UPDATE user_table SET first_name = '{$_POST['firstname']}', last_name = '{$_POST['lastname']}', email = '{$_POST['email']}', phone_number = '{$_POST['phonenumber']}', password = '{$_POST['password']}', gender = '{$_POST['gender']}', state_id = '{$_POST['state_id']}', acc_number = '{$_POST['acc_number']}', bank_id = '{$_POST['bank_id']}', user_strikes = '{$_POST['strikes']}' WHERE user_id = '{$_POST['userid']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
    if($result){
        echo 'successful';
    }else{
          
        echo 'failed'; }
    };


if(isset($_POST["action"]) && $_POST["action"] == "user_user_update" && isset($_POST["user_id1"])){
                
        $query = "UPDATE user_table SET first_name = '{$_POST['firstname1']}', last_name = '{$_POST['lastname1']}', phone_number = '{$_POST['phonenumber1']}', password = '{$_POST['password1']}', state_id = '{$_POST['state_id1']}', acc_number = '{$_POST['account1']}', bank_id = '{$_POST['bank_id1']}' WHERE user_id = '{$_POST['user_id1']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
    if($result){
        echo 'success';
    }else{
          
        echo 'failed'; }
    };


 if(isset($_POST["viewid"])){
    
    
        $data = [];
        $query = "SELECT * FROM user_table JOIN states ON user_table.state_id = states.state_id JOIN banks ON user_table.bank_id = banks.bank_id WHERE user_table.user_id = '{$_POST['viewid']}'"; 
     require_once('../scripts/connect.php');
        $result = $db->query($query);
        while($row = $result->fetch_array()){
            $data['user_id'] = $row['user_id'];
            $data['profilepic'] = $row['profile_pic'];
            $data['firstname'] = $row['first_name'];
            $data['lastname'] = $row['last_name'];
            $data['email'] = $row['email'];
            $data['password'] = $row['password'];
            $data['phonenumber'] = $row['phone_number'];
            $data['gender'] = $row['gender'];
            $data['state'] = $row['state'];
            $data['state_id'] = $row['state_id'];
            $data['acc_number'] = $row['acc_number'];
            $data['bank'] = $row['bank'];
            $data['bank_id'] = $row['bank_id'];
            $data['strikes'] = $row['user_strikes'];
            $data['don_balance'] = $row['don_balance'];
            $data['rec_balance'] = $row['rec_balance'];
            $data['total_don'] = $row['total_don'];
            $data['total_rec'] = $row['total_rec'];
            $data['signup_date'] = $row['signup_date'];
                
        };
        echo json_encode($data);
    }; 


 if(isset($_POST["deleteid"])){
        
       $query1 = "DELETE FROM match_table WHERE reciever_user_id = '{$_POST['deleteid']}'";
       $query2 = "DELETE FROM match_table WHERE donor_user_id = '{$_POST['deleteid']}'";
       $query3 = "DELETE FROM donor_request_table WHERE donor_user_id = '{$_POST['deleteid']}'";
       $query4 = "DELETE FROM recieve_request_table WHERE reciever_user_id = '{$_POST['deleteid']}'";
       $query5 = "DELETE FROM support WHERE user_id = '{$_POST['deleteid']}'";
       $query6 = "DELETE FROM user_table WHERE user_id = '{$_POST['deleteid']}'";
       $query7 = "DELETE FROM chat_table WHERE chat_user_id = '{$_POST['deleteid']}'";
     require_once('../scripts/connect.php');
        $result1 = $db->query($query1);
        $result2 = $db->query($query2);
        $result3 = $db->query($query3);
        $result4 = $db->query($query4);
        $result5 = $db->query($query5);
        $result6 = $db->query($query6);
        $result7 = $db->query($query7);
     
        if($result7){
            echo 'deleted';
        }else{
            echo var_dump($result7);
        };
        
    }; 


?>