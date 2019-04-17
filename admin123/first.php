<?php
session_start();
if (empty($_SESSION["admin_email"])) {
    header("location: login.php"); 
    exit();
    
    
    
        
};
?>


    <?php
//get States & Banks
 $stateoptions = "";
 $bankoptions = "";
 $states = "SELECT * FROM states ORDER BY state_id";
 $banks = "SELECT * FROM banks ORDER BY bank_id";
require_once('../scripts/connect.php');
        $result1 = $db->query($states);
        $result2 = $db->query($banks);
        while($row1 = $result1->fetch_array())
        {
            $stateoptions .= '<option value="'.$row1["state_id"].'">'.$row1["state"].'</option>';
        };
        while($row2 = $result2->fetch_array())
        {
            $bankoptions .= '<option value="'.$row2["bank_id"].'" data-icon="data:image/jpeg;base64,'.base64_encode($row2["logo"]).'">'.$row2["bank"].'</option>';
        };
       
//get users 
$query = "SELECT * FROM gw.user_table ORDER BY user_id ASC";
$result = $db->query($query);
        $output = '';
        while($row = $result->fetch_array())
        {
            $output .= '<tr>
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
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="../_assets/css/bs/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../_assets/css/bs/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="../_assets/css/bs/bootstrap.min.css">
    <link rel="stylesheet" href="../_assets/css/bs/bootstrap.min.css.map">
    <link rel="stylesheet" href="../_assets/css/bs/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../_assets/css/bs/bootstrap-reboot.min.css.map">
    <link rel="stylesheet" href="../_assets/fonts/css/fontawesome-all.min.css">
    <link href="../_assets/fonts/svg-with-js/css/fa-svg-with-js.css" rel="stylesheet">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div>Bootstrap</div>
    
    <script type="text/javascript" src="../_assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/bootstrap.min.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/bootstrap.min.js.map"></script>
    <script type="text/javascript" src="../_assets/js/bs/bootstrap.bundle.min.js.map"></script>
    <script type="text/javascript" src="../_assets/js/bs/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/popper.min.js.map"></script>
</body>
</html>