<?php 
session_start();

function check_loginemail(){
    if(isset($_POST['loginemail'])){
       
         require_once('../scripts/connect.php');
         $email=$_POST['loginemail'];
        $sql= "SELECT * FROM user_table WHERE email = '{$_POST['loginemail']}'";
        $result = $db->query($sql);
        if($result->num_rows === 1 ){
            exit('success');
        }else{
            exit('fail');
        }
          
    };
}

check_loginemail();

function loginsubmit(){
    
    if(isset($_POST['loginemail2']) && isset($_POST['loginpassword'])){
       
         require_once('../scripts/connect.php');
         $email=$_POST['loginemail2'];
        $sql= "SELECT * FROM user_table WHERE email = '{$_POST['loginemail2']}' AND password = '{$_POST['loginpassword']}' LIMIT 1";
        $result = $db->query($sql);
        if($result->num_rows === 1 ){
     while($row =  $result->fetch_array()){
  $_SESSION["email"]= $row["email"];
  $_SESSION["user_id"]= $row["user_id"];
  $_SESSION["loggedin"]= "1";
  $_SESSION["last_name"]= $row["last_name"];
         $_SESSION["first_name"]= $row["first_name"];
         $_SESSION["password"]= $row["password"];
         $_SESSION["phone_number"]= $row["phone_number"];
         $_SESSION["state_id"]= $row["state_id"];
         $_SESSION["profile_pic"]= $row["profile_pic"];
         $_SESSION["gender"]= $row["gender"];
           
  $data["first_name"] = $row["first_name"];
  $data["last_name"] = $row["last_name"];
  $data["gender"] = $row["gender"];
  $data["email"] = $row["email"];
  $data["id"] = $row["user_id"];
         
     }
            exit(json_encode($data));
        }else{
            $data[]="";
            exit(json_encode($data));
        }
          
    };
    
    
}

loginsubmit();
?>