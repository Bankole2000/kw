<?php

if(isset($_POST['action'])){

	require_once('../scripts/connect.php');
	
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
		$query = "SELECT * FROM chat_table JOIN user_table ON chat_table.chat_user_id = user_table.user_id ORDER BY chat_date DESC LIMIT 50";
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
            echo 'There are no Chat message At the moment';
        };
	};
}
?>

