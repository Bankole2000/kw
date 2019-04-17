<?php 
// ajax to fetch all users 
function compress_image($source_url, $destination_url, $quality){
			$info = getimagesize($source_url);
			if($info['mime'] == 'image/jpeg'){
				$image = imagecreatefromjpeg($source_url);
			}
			else if($info['mime'] == 'image/gif'){
				$image = imagecreatefromgif($source_url);
			}
			else if($info['mime'] == 'image/png'){
				$image = imagecreatefrompng($source_url);
			}
			imagejpeg($image, $destination_url, $quality);
			return $destination_url;
		}
if(isset($_POST["action"]))
{
    require_once('../scripts/connect.php');
    if($_POST["action"]== "fetch")
    {
        $query = "SELECT * FROM gw.user_table ORDER BY user_id ASC";
        $result = $db->query($query);
        $output = '';
        while($row = $result->fetch_array())
        {
            $output .= '<tr id="user'.$row["user_id"].'">
                            <td>'.$row["user_id"].'</td>
                            <td><div class="chip">
                                    <img src="../user/'.$row["profile_pic"].'" alt="'.$row["first_name"].'"> '.$row["first_name"].' '.$row["last_name"].'</div></td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["phone_number"].'</td>
                           <td>'.$row["password"].'</td>
                           <td>'.$row["gender"].'</td>
                            <td>'.$row["state_id"].'</td>
                           <td>'.$row["acc_number"].'</td>
                            <td>'.$row["bank_id"].'</td>
                            <td>'.$row["signup_date"].'</td>
                            <td><button type="button" name="update" id="'.$row["user_id"].'" class="update btn orange waves-effect waves-light">Update</button></td>
                            <td><button type="button" name="delete" id="'.$row["user_id"].'" class="delete btn red waves-effect waves-light">Delete</button></td>
                        </tr>
                            '; 
        } 
        echo($output);
    } 
    if($_POST['action'] == 'insert')
    {
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $query = "INSERT INTO banks(bank, logo) VALUES ('{$_POST['bank_name']}', '$file')";
        $result2 = $db->query($query);
        echo 'bank inserted successfully';
    }
    
    if($_POST['action'] == 'add_user')
    {
        $userimage="";
        if($_POST['gender'] == 'Male' || $_POST['gender'] == 'male' ){
            $userimage = "img/man.jpg";
            
        }else if($_POST['gender'] == 'Female' || $_POST['gender'] == 'female'){
            $userimage = "img/lady.jpg";
        };
        $query = "SELECT * FROM gw.user_table WHERE email = '{$_POST['email1']}' LIMIT 1";
        $result3 = $db->query($query);
        if($result3->num_rows != 1){
           $adduser = "INSERT INTO user_table(first_name, last_name, email, password, phone_number, gender, state_id, bank_id, acc_number, profile_pic, signup_date) VALUES ('{$_POST['firstname']}','{$_POST['surname']}','{$_POST['email1']}','{$_POST['password']}','{$_POST['phone_number']}','{$_POST['gender']}','{$_POST['location']}','{$_POST['bank']}','{$_POST['acc_number']}', '$userimage', NOW())";
             require_once('../scripts/connect.php');
        $result4 = $db->query($adduser);
            echo 'User Added Successfully';
        }else if($result3->num_rows == 1){
            echo 'User Already Exists';
        }
        
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
	if($_POST['action'] == 'update_pro_pic')
    {
		
		
		$file = $_FILES['image'];
		$user_id = $_POST['profile_user_id'];
		$fileName= $_FILES['image']['name'];
		$fileTmp_name= $_FILES['image']['tmp_name'];
		$fileSize= $_FILES['image']['size'];
		$fileError= $_FILES['image']['error'];
		$fileType= $_FILES['image']['type'];
		
		$fileExt= explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		
		
	$allowed = array('jpg','jpeg','png');
	
	if(in_array($fileActualExt, $allowed)){
		if($fileError == 0){
			if($fileSize < 5000000 ){
				$fileNameNew= $user_id.".".$fileActualExt;
				$fileDestination = '../user/propics/'.$fileNameNew;
				$filedbname = 'propics/'.$fileNameNew;
				compress_image($fileTmp_name, $fileDestination, 70);
		//		move_uploaded_file($fileTmp_name, $fileDestination);
				$query = "UPDATE user_table SET profile_pic = '$filedbname' WHERE user_id = '{$_POST['profile_user_id']}'";
				$result2 = $db->query($query);
				echo 'Upload successful';
				
			}else{
				echo "File Too Large";
			}
			
		}else{
			echo"Couldn't Upload".$fileError ;
		}
		
	}else{
		echo "Wrong File Type";
	}
//        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
//        $query = "INSERT INTO banks(bank, logo) VALUES ('{$_POST['bank_name']}', '$file')";
//        $result2 = $db->query($query);
//        echo 'bank inserted successfully';
    }
   
}

?>