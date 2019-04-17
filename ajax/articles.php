<?php 
if(isset($_POST["action"]))
{
	require_once('../scripts/connect.php');
	
	//GET INFO articles to display on ADMIN ARTICLES PAGE
	if($_POST['action'] == 'ainfofetch')
	{
		$query = "SELECT * FROM articles WHERE category = 'info' ORDER BY article_id DESC";
		$result = $db->query($query);
        $output = '';
        while($row = $result->fetch_array())
        {
            $output .= '<tr id="article'.$row["article_id"].'">
                            <td>'.$row["article_id"].'</td>
                            
                            <td>'.$row["title"].'</td>
                            <td>'.$row["category"].'</td>
                            <td>'.$row["date_added"].'</td>
                            <td>'.$row["image"].'</td>
                            <td>'.$row["link"].'</td>
                            <td><button type="button" name="update" id="'.$row["article_id"].'" class="update btn btn-secondary">Edit</button></td>
                            <td><button type="button" name="view" id="'.$row["article_id"].'" class="view btn btn-warning">View</button></td>
                            <td><button type="button" name="delete" id="'.$row["article_id"].'" class="delete btn btn-danger">Delete</button></t d>
                        </tr>
                            '; 
        } 
        echo($output);
	}
	
	//GET NEWS articles to display on ADMIN ARTICLES PAGE
	if($_POST['action'] == 'anewsfetch')
	{
		$query = "SELECT * FROM articles WHERE category = 'news' ORDER BY article_id DESC";
		$result = $db->query($query);
        $output = '';
        while($row = $result->fetch_array())
        {
            $output .= '<tr id="article'.$row["article_id"].'">
                            <td>'.$row["article_id"].'</td>
                            <td>'.$row["title"].'</td>
                            <td>'.$row["category"].'</td>
                            <td>'.$row["date_added"].'</td>
                            <td>'.$row["image"].'</td>
                            <td>'.$row["link"].'</td>
                            <td><button type="button" name="update" id="'.$row["article_id"].'" class="update btn btn-secondary">Edit</button></td>
                            <td><button type="button" name="view" id="'.$row["article_id"].'" class="view btn btn-warning">View</button></td>
                            <td><button type="button" name="delete" id="'.$row["article_id"].'" class="delete btn btn-danger">Delete</button></t d>
                        </tr>
                            '; 
        } 
        echo($output);
	}
	
	//INSERT NEWS articles to display on ADMIN ARTICLES PAGE
	if($_POST['action'] == 'art_insert')
	{   
		$content = mysqli_real_escape_string($db, $_POST['content']);
		$query = "INSERT INTO articles (title, content, image, link, category, date_added) VALUES ('{$_POST['title']}','{$content}','{$_POST['image']}','{$_POST['link']}', '{$_POST['category']}',NOW())";
		$result = $db->query($query);
        $output = '';
        if($result == true)
        {
            $output = 'successful'; 
        }else {
			$output = mysqli_error($result);
		}
        echo($output);
	}
	
	//GET Articles for update on ADMIN ARTICLES PAGE UPDATE MODAL
	if($_POST['action'] == 'artgetup')
	{  
		$query = "SELECT * FROM articles WHERE article_id = '{$_POST['id']}' LIMIT 1";
		$result = $db->query($query);
        $data = [];
        while($row = $result->fetch_array())
        {
            $data['article_id'] = $row['article_id'];
            $data['title'] = $row['title'];
            $data['content'] = $row['content'];
            $data['link'] = $row['link'];
            $data['image'] = $row['image'];
            $data['category'] = $row['category'];
        } 
        echo json_encode($data);
	}
	
	if($_POST["action"] == "art_update"){
        $content = mysqli_real_escape_string($db, $_POST['content']);
        $query = "UPDATE articles SET title = '{$_POST['title']}', content = '{$content}', image = '{$_POST['image']}', link = '{$_POST['link']}', category = '{$_POST['category']}', date_added = NOW() WHERE article_id = '{$_POST['id']}'"; 
     
        $result = $db->query($query);
    if($result){
        echo 'success';
    }else{
          
        echo 'failed'; }
    };
	
	//GET Articles for update on ADMIN ARTICLES PAGE UPDATE MODAL
	if($_POST['action'] == 'artgetview')
	{  
		$query = "SELECT * FROM articles WHERE article_id = '{$_POST['id']}' LIMIT 1";
		$result = $db->query($query);
        $data = [];
        while($row = $result->fetch_array())
        {
            $data['article_id'] = $row['article_id'];
            $data['title'] = $row['title'];
            $data['content'] = $row['content'];
            $data['link'] = $row['link'];
            $data['image'] = $row['image'];
            $data['category'] = $row['category'];
            $data['date'] = $row['date_added'];
        } 
        echo json_encode($data);
	}
	
}
?>