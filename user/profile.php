<?php
session_start();

//TODO: PHP DYNAMIC ELEMENTS
//TODO: UPDATE MODALS
//TODO: INCLUDE GH AND PH REQUESTS HERE. ALSO INCLUDE SUPPORT TICKETS

if(isset($_SESSION["email"]) && isset($_SESSION["loggedin"]) && isset($_SESSION["password"])){
    
    require_once('../scripts/connect.php');
    $sql= "SELECT * FROM user_table JOIN states ON user_table.state_id = states.state_id JOIN banks ON user_table.bank_id = banks.bank_id WHERE email = '{$_SESSION['email']}' AND password = '{$_SESSION['password']}' LIMIT 1";
        $result = $db->query($sql);
        if($result->num_rows === 1 ){
            while($row =  $result->fetch_array()){
            $user_id = $row["user_id"];
            $_SESSION["user_id"] = $row["user_id"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
            $password = $row["password"];
            $phone_number = $row["phone_number"];
            $gender = $row["gender"];
            
            $bank = $row["bank"];
            $bank_id = $row["bank_id"];
            $state = $row["state"];
            $state_id = $row["state_id"];
            $acc_number = $row["acc_number"];
            $don_balance = $row["don_balance"];
            $total_don = $row["total_don"];
            $total_rec = $row["total_rec"];
            $rec_balance = $row["rec_balance"];
            $profile_pic = $row["profile_pic"];
            $user_strikes = $row["user_strikes"];
            $signup_date = $row["signup_date"];
            $loggedin = $_SESSION["loggedin"];
			$logo = base64_encode($row["logo"]);
			$sessionpassword = $_SESSION["password"];
            }
        };
 
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
	
//Side Bar Notifications & Counts
	$nav_user_id = $_SESSION['user_id'];
	$navmatches ='';
	$navdonmatches = '';
	$navrecmatches = '';
	$sqlnavmatches = "SELECT * FROM match_table WHERE is_confirmed = 0 AND (donor_user_id = '{$_SESSION['user_id']}' OR reciever_user_id = '{$_SESSION['user_id']}')" ;
	$sqlnavdonmatches = "SELECT * FROM match_table WHERE is_confirmed = 0 AND donor_user_id = '{$_SESSION['user_id']}'" ;
	$sqlnavrecmatches = "SELECT * FROM match_table WHERE is_confirmed = 0 AND reciever_user_id = '{$_SESSION['user_id']}'" ;
	require_once('../scripts/connect.php');
	$matchesstore = $db->query($sqlnavmatches);
	$recmatchesstore = $db->query($sqlnavrecmatches);
	$donmatchesstore = $db->query($sqlnavdonmatches);
	$matchcount = $matchesstore->num_rows;
	$donmatchcount = $donmatchesstore->num_rows;
	$recmatchcount = $recmatchesstore->num_rows;
	
	if($matchesstore->num_rows > 0){
		$navmatches = '<span class="new badge colorbrand pulse">'.$matchcount.'</span>';
	}else if($matchesstore->num_rows == 0 ){
		$navmatches = '';
	};
      if($donmatchesstore->num_rows > 0){
		$navdonmatches = '<span class="new badge colordon pulse">'.$donmatchcount.'</span>';
	}else if($donmatchesstore->num_rows == 0 ){
		$navdonmatches = '';
	};
	  if($recmatchesstore->num_rows > 0){
		$navrecmatches = '<span class="new badge colorrec pulse">'.$recmatchcount.'</span>';
	}else if($recmatchesstore->num_rows == 0 ){
		$navrecmatches = '';
	};

	
    
        
}else{
    header("location: ../index.html"); 
    exit();
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../_assets/fonts/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="../_assets/fonts/svg-with-js/css/fa-svg-with-js.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../_assets/css/main.css" />
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_assets/css/materialize.min.css" media="screen,projection" />
    <link sizes="192x192" rel="icon" href="https://i.imgur.com/gXBVYAM.png" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
     
    <style>
	body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
  }

  main {
    flex: 1 0 auto;
  }
.loader{
    position: absolute; 
    top: 180px;
    left: 45%;
}

.containerc .row {
  margin: 0 auto;
}

/* label color */
form .input-field label{
    color: #333;
 }

.colordon {
background-color: #fb9100 !important;	
}
.colorfadedon{
background-color: #fb9100 !important;
}
.colortextdon{
color: #fb9100 !important;
}
.colorfadetextdon{
color: #fb9100 !important;
}
.colorrec{
background-color: #26a69a !important;	
}
.colorfaderec{
background-color: #26b69b !important;	
}
.colortextrec{
color: #26a69a !important;
}
.colorfadetextrec{
color: #26b69b !important;
}
.colorbrand{
background-color: #0091ea !important;	
}
.colorfadebrand{
background-color: #0091ea !important;
}
.colortextbrand{
color: #0091ea !important;
}
.colorfadetextbrand{
color: #0091ea !important;
}
.colordark{
background-color: #121212 !important;	
}
.colorfadedark{
background-color: #000000 !important;	
}
.colortextdark{
color: #121212 !important;
}
.colorfadetextdark{
color: #000000 !important;
}
.colortitletext{
color: #fff !important;
}
.colorsectiontext{
color: #000 !important;
}
.overlay{
background-color: rgba(0,0,0,0.5); background-size: cover;	
}
.imagebrand{
background-image :url(https://i.imgur.com/pwRcDNu.png);
}
.imagelogo{
	content: url("https://i.imgur.com/IRkldcO.png");
	
}
.bckgrndcolor{
	background-color: #e4e4e4 !important;
	
}


	</style>
    
    
    <title>KoboWise - <?php echo $first_name?>'s Profile</title>
</head>
<body>

    <!-- ====================== FIXED HEADER NAVIGATION ====================== -->
   <div class="navbar-fixed">
        <nav class="white darken-4">
            <div>
                <div class="nav-wrapper">
                    <a data-activates="side-nav" data-position="right" class="btn z-depth-0 white button-collapse show-on-large transparent">
                <i class="left fas fa-bars black-text" data-fa-transform="grow-18 down-25"></i>
                </a>
                    <a href="index.php" class="center brand-logo"><img class=" imagelogo" alt="" style="height: 40px; margin-top:10px;"></a>
                    
                    <ul class="hide-on-small-only right">

                        <li><a href="chat.php" data-tooltip="Chat" data-position="right" class="tooltipped modal-trigger">&nbsp;<i class="fa fa-comments fa-lg colortextbrand" data-fa-transform="right-2"></i></a></li>
                        <li><a href="logout.php" data-tooltip="Logout" data-position="right" class="tooltipped"><i class="fa fa-sign-in-alt fa-lg blue-grey-text" data-fa-transform="grow-5 right-2"></i></a></li>
                        <li><a href="profile.php" data-tooltip="My Profile" data-position="right" class="tooltipped"><img src="<?php echo $profile_pic; ?>" style="width:50px; height: 50px; margin-top:7px;" class="circle" alt=""></a></li>
<li><a href="profile.php" class="tooltipped black-text" data-tooltip = "My Profile"><?php echo $first_name; ?>&nbsp;<?php echo $last_name; ?> &nbsp;</a></li>

                    </ul>


                </div>
            </div>
        </nav>
    </div>
    <!-- ====================== END OF FIXED HEADER NAVIGATION ================== -->   
   
    <!-- ====================== SIDE BAR NAVIGATION ====================== -->
    <ul id="side-nav" class="side-nav white lighten-4">
        <li>
            <div class="user-view">
                <div class="background imagebrand" style="background-size:cover; background-color: blue;">
                    <img style="width:600px;" alt="">
                </div>
                <a href="profile.php"><img src="<?php echo $profile_pic; ?>" class="circle" alt=""></a>
                <a href="profile.php"><span class="name white-text"><?php echo $first_name." ".$last_name; ?></span></a>
                <a href="profile.php"><span class="email white-text"><?php echo $email; ?></span></a>

            </div>
        </li>
        <li>
            <a class="subheader">
                <div>My Account</div>
            </a>


        </li>
        <li>
            <a href="index.php">
                <div><i class="blue-grey-text fas fa-tachometer-alt fa-fw fa-lg"></i>&nbsp; &nbsp; Dashboard</div>
            </a>
        </li>
        <li class="active">
            <a>
                <div><i id ="profile_icon" class="colortextdon fas fa-user-edit fa-fw fa-lg" data-fa-transform="grow-4 up-1"></i>&nbsp; &nbsp; <b>My Profile</b><span id="profile2" class="colordon profile_note"></span></div>
            </a>
        </li>

        <div class="divider"></div>
        <li>
            <a class="subheader">
                <div>Pending Donations</div>
            </a>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header">
                        <div><i class="colortextbrand fas fa-user-friends fa-fw fa-lg"></i>&nbsp; &nbsp; Matches<?php echo $navmatches; ?></div>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="donations.php">
                                    <div><i class="colortextdon fas fa-money-bill-alt fa-fw fa-lg"></i> &nbsp; &nbsp; To Give<?php echo $navdonmatches; ?></div>
                                </a>
                            </li>
                            <li>
                                <a href="eligibility.php">
                                    <div><i class="colortextrec fas fa-money-bill-alt fa-fw fa-lg"></i> &nbsp; &nbsp; To Recieve<?php echo $navrecmatches; ?></div>
                                </a>
                            </li>
                            <li>
                                <a href="records.php">
                                    <div><i class="blue-grey-text text-lighten-1 fas fa-money-check-alt fa-fw fa-lg"></i>&nbsp; &nbsp; &nbsp;Records</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>


        </li>


        <div class="divider"></div>
        <li>
            <a class="subheader">
                <div>Information</div>
            </a>
        </li>
        <li>
            <a href="info.php">
                <div><i class="blue-grey-text fas fa-info fa-fw fa-lg"></i>&nbsp; &nbsp; &nbsp; Info and FAQs</div>
            </a>
        </li>
        <li>
            <a href="news.php">
                <div><i class="blue-grey-text fas fa-newspaper fa-fw fa-lg"></i>&nbsp; &nbsp; &nbsp; News and Updates</div>
            </a>
        </li>
        <li>
            <a href="support.php">
                <div><i class="blue-grey-text fas fa-cog fa-fw fa-lg"></i>&nbsp; &nbsp; &nbsp; Support </div>
            </a>
        </li>
        <li>
            <a href="logout.php">
                <div><i class="blue-grey-text fas fa-sign-in-alt fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; Logout </div>
            </a>
        </li>

    </ul>
    <!-- ====================== END OF SIDE BAR NAVIGATION ====================== -->
   
   <!-- ===================== BREADCRUMBS HERE ================================== -->
    <nav class="imagebrand" style="height:45px; background-size: cover; background-repeat: no-repeat;">
        <div class="nav-wrapper ">
            <div class="col s12 container" >
                <h5><i class="fa fa-user fa-sm" data-fa-transform="right-2 up-1"></i> &nbsp; My Profile <span class="right hide-on-small-only"><?php echo $email; ?></span></h5>
            </div>

        </div>
    </nav>
    <!-- ===================== END OF BREAD CRUMBS BREADCRUMBS ============== -->
                   
    <!-- ================ ACCOUNT BALANCE SECTION HERE ======================== -->
    <section class="section section-stats center grey lighten-4" style=" background:url(https://i.imgur.com/L6ZRj6S.jpg); background-size: cover; background-repeat: no-repeat;"><div style ="background-color: rgba(0,0,0,0.5);
    top:0;left:0; width: 100%;
    min-height: 500px; margin-top:-15px; margin-bottom:-35px; padding-top:20px;">
<!--  NOTIFICATIONA GO HERE    -->
       <div class="row" style="display: none;" >
          <div class="container center">
             <div class="card-panel" style="display:flex;">
               <a style="flex:1;" class="btn waves-effect waves-light red lighten-1" onclick="$('.tap-target').tapTarget('open')">START HERE</a>
                 
             </div>
          </div>
       </div>
      
      <!--  END OF NOTIFICATIONS   -->
       
        <div class="row">
            <div class="container">
              
    <div class="col s12 m6 hide-on-large-only">
      <div class="card hoverable">
        <div class="card-image">
          <img src="<?php echo $profile_pic;?>">
         
          <a class="btn-floating btn-large halfway-fab waves-effect waves-light colorrec modal-trigger" data-target="image_update_modal" id="pro_image1"><i class="fa fa-image fa-lg"></i></a>
        </div>
        <div class="card-content">
          <span class="card-title orange-text"><b><?php echo $first_name.' '.$last_name;?></b></span>
          <p class="left-align"> 
         <b>Name:</b> <?php echo $first_name.' '.$last_name;?> <br/> 
         <b>Email:</b> <?php echo $email;?> <br/> 
         <b>Gender:</b> <?php echo $gender;?> <br/> 
         <b>Location:</b> <?php echo $state;?> <br/> 
         <b>Signed Up:</b> <?php echo $signup_date;?> <br/> 
         </p>
        </div>
      </div>
    </div>
    
    <div class="col s12 m6 l8 hide-on-med-and-down">
    <div class="card horizontal hoverable">
      <div class="card-image">
        <img src="<?php echo $profile_pic;?>" style="height: 250px;">
        <a class="btn-floating btn-large halfway-fab waves-effect waves-light colorred modal-trigger" data-target="image_update_modal" id="pro_image2"><i class="fa fa-image fa-lg"></i></a>
      </div>
      <div class="card-stacked">
        <div class="card-content">
         <span class="card-title orange-text"><b><?php echo $first_name.' '.$last_name;?></b></span>
         <p class="left-align"> 
         <b>Name:</b> <?php echo $first_name.' '.$last_name;?> <br/> 
         <b>Email:</b> <?php echo $email;?> <br/> 
         <b>Gender:</b> <?php echo $gender;?> <br/> 
         <b>Location:</b> <?php echo $state;?> <br/> 
         <b>Signed Up:</b> <?php echo $signup_date;?> <br/> 
         </p>
        </div>
        </div>
    </div>
  </div>
  <div class="col s12 m6 l4">
     
      <div class="card grey hoverable darken-4">
        <div class="card-content white-text">
          <span class="card-title orange-text"><b>Status</b></span>
          <p>Your Details are Incomplete. Please Update following: <br> </p>
          <ul>
              <li>Profile Picture</li>
              <li>Contact Details</li>
              <li>Bank Details</li>
              <li>Password</li>
          </ul>
        </div>
        <div class="card-action">
          <a class="update btn waves-effect waves-light colorrec" id="pro_btn">Update</a>
        </div>
      </div>
  </div>
  
            </div>
        </div>
        <div class="row">
         
           <div class="container"> <ul class="collapsible popout hoverable">
    <li>
      <div class="collapsible-header"><i class="fa fa-address-card" data-fa-transform ="left-5 down-2"></i>Contact Details <span id ="cont_note" class="new badge colorrec" data-badge-caption="Complete"></span></div>
      <div class="white collapsible-body"><div class="input-field col s6">
          <input value="<?php echo $first_name;?>" id="first_name" type="text" disabled>
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input value="<?php echo $last_name;?>" id="last_name" type="text" disabled>
          <label for="last_name">Last Name</label>
        </div>
        <div class="input-field col s6">
          <input value="<?php echo $state;?>" id="location" type="text" disabled>
          <label for="location">location</label>
        </div>
        <div class="input-field col s6">
          <input value="<?php echo $phone_number;?>" id="phone_number" type="text" disabled>
          <label for="phone_number">Phone Number</label>
          <input value="<?php echo $user_id;?>" id="idprofile" type="hidden" disabled>
          <input value="<?php echo $user_id;?>" id="user_id1" type="hidden" disabled>
        </div>
          <a class="update btn waves-effect waves-light colorrec modal-trigger" data-target="all_update_modal" id="cont_btn">update Contact Details</a></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fa fa-university" data-fa-transform ="left-5 down-2"></i>Bank Details <span id="bank_note" class="new badge colorrec" data-badge-caption="Complete"></span></div>
      <div class="white collapsible-body"> <img class="responsive-img" src="data:image/jpeg;base64,<?php echo $logo;?>" alt="" style="width:250px;"><div class="input-field">
          
           <input value="<?php echo $bank;?>" id="bank" type="text" disabled>
          <label for="bank">Bank Name</label>
        
        </div>
        <div class="input-field col s12">
          <input value="<?php echo $acc_number;?>" id="acc_number" type="text" disabled>
          <label for="acc_number">Account Number</label>
        </div> <a class="update btn waves-effect waves-light colorrec modal-trigger" data-target="all_update_modal" id="bank_btn">update Bank Details</a></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fa fa-image" data-fa-transform ="left-5 down-4"></i>KoboWise Password <span id="pass_note" class="new badge colorrec" data-badge-caption="Complete"></span></div>
      <div class="white collapsible-body"><div class="input-field col s12">
          <input value="<?php echo $password; ?>" id="password" type="password" disabled>
          <label for="password">Password</label>
        </div>
        <div class="input-field col s12">
          
        </div> <a class="update btn waves-effect waves-light colorrec modal-trigger" data-target="all_update_modal" id="pass_btn">update Password</a></div>
    </li>
  </ul></div>
        </div>
        
    </div>

    </section>
<!--  ============== END OF ACCOUNT BALANCE SECTION ======================= -->

    
    <!-- ====================== FLOATING ACTION BUTTON ======================== -->
    <div class="fixed-action-btn click-to-toggle">
        <a id = "quick_menu" class="btn-floating btn-large blue-grey darken-2 waves-effect waves-light">
    <i class="fas fa-bars fa-2x" data-fa-transform="down-4"></i>
  </a>
        <ul>
           <li><a id="profile" class="btn-floating btn-large blue-grey darken-2 waves-effect waves-light tooltipped" data-tooltip="My Profile" data-position="left"><i class="fas fa-user fa-lg" data-fa-transform="grow-6 down-1"></i></a></li>
            <li><a href="donations.php" class="tooltipped btn-floating waves-effect waves-light blue-grey darken-2" data-tooltip="View Donations" data-position="left"><i class="fas fa-money-bill-wave fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a href="eligibility.php" class="tooltipped btn-floating waves-effect waves-light blue-grey darken-2" data-tooltip="View Eligibity" data-position="left"><i class="fas fa-money-check fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a href="support.php" class="tooltipped btn-floating blue-grey darken-2 waves-effect waves-light" data-tooltip="Help & Support" data-position="left"><i class="fas fa-cog fa-lg" data-fa-transform="grow-4 down-1"></i></a></li>
            <li><a href="logout.php" class="tooltipped btn-floating blue-grey darken-2 waves-effect waves-light" data-tooltip="logout" data-position="left"><i class="fas fa-sign-in-alt fa-lg" data-fa-transform="down-1"></i></a></li>
        </ul>
    </div>
    <!-- ==================== END OF FLOATING ACTION BUTTON =================== -->
   
   <!-- ===================== PROFILE DETAILS SECTION ========================= -->
   <div class="details" style='display: none;'>
    <p id="user_email"><?php echo $email;  ?></p>
    <p id="1first_name"><?php echo $first_name;  ?></p>
    <p id="1password"><?php echo $password;  ?></p>
    <p id="location"><?php echo $state_id;  ?></p>
    <p id="state_id"><?php echo $state_id;  ?></p>
    <p id="profile_pic"><?php echo $profile_pic;  ?></p>
    <p id="1acc_number"><?php echo $acc_number;  ?></p>
    <p id="bank"><?php echo $bank;  ?></p>
    <p id="bank_id"><?php echo $bank_id;  ?></p>
    <p id="1phone_number"><?php echo $phone_number;  ?></p>
    <p id="don_pending"><?php echo $don_pending;  ?></p>
    <p id="rec_pending"><?php echo $rec_pending;  ?></p>
    <p id="user_id"><?php echo $user_id;  ?></p>
    <p id="user_don_matches" value="<?php echo $navdonmatches;  ?>"><?php echo $navdonmatches;  ?></p>
    <p id="user_rec_matches" value="<?php echo $navrecmatches;  ?>"><?php echo $navrecmatches;  ?></p>
    <input type="hidden" value="" id="all_profile_status">
    <p id="sessionpassword" value="<?php echo $sessionpassword; ?>"><?php echo $sessionpassword; ?></p>
    
    
   <?php 
    echo "you're logged in as ". $first_name ."<br/>
 Email: ". $email ."<br/>
 First Name: ". $first_name ."<br/>
 last Name: ". $last_name ."<br/>
 Phone Number: ". $phone_number ."<br/>
 Location: ". $user_location ."<br/>
 Gender: ". $gender ."<br/>
 User ID: ". $user_id ."<br/>
 Logged In: ". $loggedin ."<br/>
 Your Password is: ". $password ."<br/>
 Profile Pic: ". $profile_pic ."<br/>
 Account Number: ". $acc_number."<br/>
 Bank: ". $bank."<br/>
 Donation Balance: ". $don_balance ."<br/>
 Eligibility Balance: ". $rec_balance ."<br/>
 Total Donations: ". $total_don ."<br/>
 Total Amount Recieved: ". $total_rec ."<br/>
 Number of Strikes: ". $user_strikes ."<br/>
 <a href='logout.php'>Log out?</a>";
    ?>
    </div>
   <!-- ===================== END OF PROFILE DETAILS SECTION ====================== -->
    
   <?php include "../_assets/includes/footer.php"; ?>
    <!-- ======================  MODALS ========================== -->
    <div id="all_update_modal" class="modal modal-fixed-footer">
    <form id="don_request_form">
    <div class="modal-content left">
    <h5 class="colortextbrand">Update Profile <i class="fas fa-spinner fa-pulse grey-text" id="loader_details" style="display:none;"></i></h5>
   
		<span class="blue-text"><i class="fa fa-user" data-fa-transform="shrink-4"></i>&nbsp; Contact Information</span>
       <div style="display:flex;"><div class="input-field" style="flex:1;">
          <input id="firstname1" type="text" required>
           <label for="firstname1">Firstname &nbsp;<span class="red-text" id="fname1"></span></label>
           
       </div>
         <div class="input-field" style="flex:1;">
          <input id="lastname1" type="text" required>
           <label for="lastname1">Surname&nbsp;<span class="red-text" id="lname1"></span></label>
           
		   </div></div>
         <div style="display:flex;"><div class="input-field" style='flex:1;'>
          <input id="email1" type="text" Disabled>
           <label for="email1">Email &nbsp;<span class="red-text" id="don"></span></label>
           
       </div><div class="input-field" style="flex:1;">
          <input id="phonenumber1" type="number" pattern="[0-9]*" required>
           <label for="phonenumber1">Phone #&nbsp;<span class="red-text" id="lphone1"></span></label>
           
			 </div></div>
       <div style="display:flex;"><div class="input-field" style='flex:1;'>
          <input id="gender1" type="text" Disabled>
           <label for="gender1">Gender &nbsp;<span class="red-text" id="don"></span></label>
           
       </div><div class="input-field" style="flex:1;">
                                <select id="location1">
    <?php echo $stateoptions; ?>
    </select>
                                <label>Location&nbsp;<span class="red-text" id="llocation1"></span></label>

                            </div></div>
        <span class="blue-text"><i class="fa fa-user" data-fa-transform="shrink-4"></i>&nbsp; Bank Details</span>
        
        <div style="display:flex;">
                            <div class="input-field" style="flex:1;">
                                <select id="bank1" class="icon">
    <?php echo $bankoptions; ?>
    </select>
                                <label>Bank&nbsp;<span class="red-text" id="lbank1"></span></label>
                               
                            </div>


                        </div>
                        <div class="input-field">
          <input id="account1" type="number" pattern="[0-9]*" required>
           <label for="account1">Account Number &nbsp;<span class="red-text" id="acc_1"></span></label>
           
       </div>
        <span class="blue-text"><i class="fa fa-user" data-fa-transform="shrink-4"></i>&nbsp; Password Change</span>
        <p>Password Must be at least <strong class="red-text text-lighten-1">6 alpha-numberic characters long</strong> and must include at least<strong class="red-text text-lighten-1"> 1 Uppercase letter, 1 lowercase letter, and 1 number</strong>. You may need to log in again after changing your password.</p>
        <div style="display:flex;"><div class="input-field" style="flex:1;">
          <input id="password1" type="password" required>
           <label for="password1">New Password &nbsp;<span class="red-text" id="lpassword1"></span></label>
           
       </div>
         </div><div style="display:flex;"><div class="input-field" style="flex:1;">
          <input id="password2" type="password" required>
           <label for="password2">Confirm Password &nbsp;<span class="red-text" id="lpassword2"></span></label>
           
		   </div></div>
        
         <p>
      
        <input type="checkbox" value="consent" id = "consent"/>
             <label for="consent">I have read, understood, and I consent to the <a>terms and conditions</a>.&nbsp;<span class="red-text" id="don_consent"></span></label>
      
    </p>
   
    
  </div>
	
    <div class="modal-footer center">
    
      <a class="btn red modal-close waves-effect waves-light" id="update_cancel">Cancel </a>
      <a type="submit" class="btn colorbrand waves-effect waves-light" id="update_now_btn" disable>Update <i class="fas fa-spinner fa-pulse" style="display:none;" id="loader_update"></i></a>
    </div>
        </form>
  </div>
    
    <div id="passwordmodal" class="modal">
    <div class="modal-content center">
      <h4 class="colortextbrand">Password Changed</h4>
      <p class="flow-text">Hello <span id="fname2" class="orange-text text-darken-2"></span>. You've Successfully Updated your Profile and Changed Your password. You may need to Login again.</p>
      
        
    </div>
    <div class="modal-footer">
      
      <a href="../index.html" class="btn colorbrand waves-effect waves-light">Okay</a>
    </div>
  </div>
     <div id="image_update_modal" class="modal">
    <div class="modal-content center">
      <h4 class="colortextbrand"><i class="fa fa-image"></i> Update Profile Picture</h4>
      <p class="flow-text">Upload a profile Image (jpg, jpeg, png or gif) or take a picture with your camera (for mobile devices):</p>
      <form id="upload_profile_image_form" action="upload.php" method='POST' enctype ='multipart/form-data'>
      <div id="loader_image" style="display:none;"><p class="grey-text center">Uploading Image</p><div class="progress">
      <div class="indeterminate"></div>
  </div></div>
    <div class="file-field input-field">
     <div class="btn colorrec">
        <span>Image &nbsp;<i class="fa fa-image"></i></span>
        <input type="file" name="image" id="image">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
      <input type="hidden" name="action" id="action" value="update_pro_pic">
      <input type="hidden" name="profile_user_id" id="profile_user_id" value="<?php echo $user_id?>">
    </div>
    
    <button type="submit" class="btn colorbrand waves-effect waves-light">Update Profile Image</button>
		</form>
         
    </div>
    <div class="modal-footer">
      <a class="btn red modal-close waves-effect waves-light">Cancel</a>
      
    </div>
		 
  </div>
    
<!--  ========================    END OF MODALS ====================  -->

    
    
    
    <!-- ==================== Preloader ============================== -->
    <div class="loader preloader-wrapper big active">
        <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-red">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
    <!-- ===================== End of Preloader ===================== -->
      
    <script type="text/javascript" src="../_assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../_assets/js/materialize.min.js"></script>
    <script type="text/javascript" src="../_assets/js/preload.js"></script>
    <script type="text/javascript" src="../_assets/fonts/svg-with-js/js/fontawesome-all.min.js"></script>
    <script>$(document).ready(function(){
  		var firstname1 = '';
        var lastname1 = '';
        var dfltpassword = 'Password1234';
        var phonenumber1 = '';
        var password1 = '';
        var password2 = '';
        var account1 = '';
        var state_id1 = '';
       var user_id = $('#idprofile').val();
       var sessionpassword = $('#1password').text();
        var name_reg=/^[a-z]{3,}$/i;
        var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
        var acc_reg=/^[0-9]{10}$/i;
        var phone_reg=/^[0-9]{11}$/i;
        var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;     
			console.log(sessionpassword);
     $('.modal').modal();  
			
	function cont_stat()
	{
	var phone_number = $('#1phone_number').text();
	var state_id = $('#state_id').text();
		console.log(phone_number + state_id);
		if(phone_number == '08011111111' || state_id == '0'){
	

			$('#cont_note').removeClass('colorrec').addClass('colordon').attr('data-badge-caption','Incomplete');
			$('#cont_btn').removeClass('colorrec').addClass('colordon').addClass('pulse');
		}		
	}
	cont_stat();
			
	function bank_stat()
	{
	var acc_number = $('#1acc_number').text();
	var bank_id = $('#bank_id').text();
		console.log(acc_number + bank_id);
		if(acc_number == '0000000000' || bank_id == '0'){
				$('#bank_note').removeClass('colorrec').addClass('colordon').attr('data-badge-caption','Incomplete');
				$('#bank_btn').removeClass('colorrec').addClass('colordon').addClass('pulse');
		}		
	}
	bank_stat();
	
	function pass_stat()
	{
	var password = $('#1password').text();
		console.log(password);
		if(password == dfltpassword){
				$('#pass_note').removeClass('colorrec').addClass('colordon').attr('data-badge-caption','Incomplete');
				$('#pass_btn').removeClass('colorrec').addClass('colordon').addClass('pulse');
		}		
	}
	pass_stat();
			
	function imag_stat()
	{
	var profile_pic = $('#profile_pic').text();
		console.log(profile_pic);
		if(profile_pic == "img/man.jpg"){
				$('#pro_image1').removeClass('colorrec').addClass('colordon').addClass('pulse');
				$('#pro_image2').removeClass('colorrec').addClass('colordon').addClass('pulse');
		}		
	}
	imag_stat();
			
    function status_check()
    {
     var firstname = $('#1first_name').text();
     var email = $('#user_email').text() ;
     var user_id = $('#idprofile').val();
     var password = $('#1password').text();
     var acc_number = $('#1acc_number').text();
     var profile_pic = $('#profile_pic').text();
     var phone_number = $('#1phone_number').text();
     var bank_id = $('#bank_id').text();
     var state_id = $('#state_id').text();
        
 
        $('#fname2').html(firstname);
//     
    var details = user_id + ' ' + firstname + ' ' + email + ' ' + password;
        $('#gotten_details').html(details);
        if(bank_id == '0' || password == dfltpassword || state_id == '0' || phone_number == '08011111111' || acc_number == '0000000000'){
            $('#quick_menu').addClass('pulse').removeClass('blue-grey').addClass('colorbrand');
            $('#profile').addClass('pulse').removeClass('blue-grey').addClass('colordon');
            $('#profile2').addClass('pulse');
            $('#pro_btn').addClass('pulse').removeClass('colorrec').addClass('colordon');
            $('.profile_note').addClass('new badge').html('Incomplete');
			$('#all_profile_status').val('NOTOK');
            
        }else {
			$('#all_profile_status').val('FINE');
			$('#profile_icon').removeClass('fa-user-edit').removeClass('colortextdon').addClass('fa-user-check').addClass('colortextrec');
		}; 
     }
    status_check();
    
	function don_status(){
		var doncnt = $('#user_don_matches').text();
		console.log(doncnt);
		if (doncnt == "" || doncnt == "0"){
			$('#don_notify').removeClass('pulse');
		}		
		else{
			$('#quick_menu').addClass('pulse').removeClass('blue-grey').addClass('colorbrand');
			$('#don_notify').addClass('pulse').removeClass('blue-grey').addClass('colordon');
		}
		
	}
	don_status();
	
			$(".update").click(function(){
				$("#loader_details").show();
				var user_id = $('#idprofile').val();
				
				$("#all_update_modal").modal('open');
				$.ajax({
                url:'../ajax/update.php',
                method:'POST',
                data:{id:user_id},
                dataType:'json',
                success:function(data){
					console.log(data);
					$("#loader_details").hide();
                    $('#firstname1').val(data.firstname);
                    $('#edit_user1').html(data.firstname);
                    $('#lastname1').val(data.lastname);
                    $('#email1').val(data.email);
                    $('#password1').val(data.password);
                    $('#password2').val(data.password);
                    $('#phonenumber1').val(data.phonenumber);
                    $('#account1').val(data.acc_number);
                    $('#location1').val(data.state_id);
                    $('#bank1').val(data.bank_id);
                    $('#gender1').val(data.gender);
                    $('#strikes1').val(data.strikes);
                    $('#email1').val(data.email);
                    $('#user_id1').val(data.user_id);
                    $('#profile_pic1').attr('src','../user/'+data.profilepic);
					Materialize.updateTextFields();
                   $("#location1").material_select();
					$("#bank1").material_select();
                },
            })
			});
			
			$('#update_cancel').click(function(){
	Materialize.toast('Update Cancelled',2000);	
		
	});
			$('#update_now_btn').click(function(){
				$("#loader_update").show();
		var user_id1 = $('#user_id1').val();
        var bank_id1 = $('#bank1').val();
		var firstname1 = $('#firstname1').val();
        var lastname1 = $('#lastname1').val();
        var phonenumber1 = $('#phonenumber1').val();
        var password1 = $('#password1').val();
        var password2 = $('#password2').val();
      //  var sessionpassword = $('#sessionpassword').val();
        var account1 = $('#account1').val();
        var state_id1 = $('#location1').val();
        var name_reg=/^[a-z]{3,}$/i;
        var acc_reg=/^[0-9]{10}$/i;
        var phone_reg=/^[0-9]{11}$/i;
        var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;        
				if(name_reg.test(firstname1)){
					$("#firstname1").removeClass("invalid");
            $("#firstname1").addClass("valid");
            $("#fname1").html("OK");
            $("#fname1").removeClass("red-text");
            $("#fname1").addClass("green-text");
					if(name_reg.test(lastname1)){
						 $("#lastname1").removeClass("invalid");
            $("#lastname1").addClass("valid");
            $("#lname1").html("OK");
            $("#lname1").removeClass("red-text");
            $("#lname1").addClass("green-text");
						if(phone_reg.test(phonenumber1)){
							if(phonenumber1 != "08011111111"){
								 $('#phonenumber1').addClass('valid');
                $('#phonenumber1').removeClass('invalid');
                $('#lphone1').addClass('green-text');
                $('#lphone1').removeClass('red-text');
                $('#lphone1').html('Ok');
							if(state_id1 > 0){
								$('#location1').removeClass('invalid');
                $('#location1').addClass('valid');
				$('#llocation1').removeClass('red-text');
                $('#llocation1').addClass('green-text');
                $('#llocation1').html('OK');
								if(bank_id1 > 0){
									$('#bank1').removeClass('invalid');
                $('#bank1').addClass('valid');
									$('#lbank1').removeClass('red-text');
                $('#lbank1').addClass('green-text');
                $('#lbank1').html('OK');
									if(acc_reg.test(account1)){ 
										if(account1 > 0){
											$('#account1').removeClass('invalid');
                $('#account1').addClass('valid');
                $('#acc_1').removeClass('red-text');
                $('#acc_1').addClass('green-text');
                $('#acc_1').html('OK');
										if(password_reg.test(password1)){
											if(password1 != dfltpassword){
											if(password1 == password2){
												var action = "user_user_update";
												$.ajax({
													url:'../ajax/update.php',
													method:'POST',
													dataType:'',
													data:{
														user_id1:user_id1,
        												bank_id1:bank_id1,
														firstname1:firstname1,
        												lastname1:lastname1,
        												phonenumber1:phonenumber1,
        												password1:password1,
        												password2:password2,
        												account1:account1,
        												state_id1:state_id1,
														action:action,						
													},
													success:function(response){
														$("#loader_update").hide();
														console.log(response);
														if(response == "success"){
												$("#lpassword2").removeClass("red-text");
            									$("#lpassword2").addClass("green-text");
												$("#lpassword1").removeClass("red-text");
            									$("#lpassword1").addClass("green-text");
												$("#lpassword2").html("OK");
												$("#lpassword1").html("OK");
            									$("#password1").removeClass("invalid");
            									$("#password1").addClass("valid");
												$("#password2").removeClass("invalid");
            									$("#password2").addClass("valid");
											   Materialize.toast('Update Successful',2000,'rounded', function(){
												   if(sessionpassword == password2){
																 location.reload();
															}else if(sessionpassword != password2){
																$('#passwordmodal').modal('open');
															}
											   }
											   );
															
															
														}else if(response == "failed"){
															 Materialize.toast('Database Error',2000);
														}else{
															 Materialize.toast('Something else wrong',2000);
														}
														
														
													}
												})
												
												
											   }else{
												   $("#loader_update").hide();
											  Materialize.toast('Password Missmatch',2000);
												   $("#lpassword2").html("Miss-Match");
												   $("#lpassword1").html("Miss-Match");
            $("#password1").removeClass("valid");
            $("#password1").addClass("invalid");
			$("#password2").removeClass("valid");
            $("#password2").addClass("invalid");
											   }
										}else {
											$("#loader_update").hide();
										Materialize.toast('Please Change Password',2000);
											$("#lpassword1").html("Change");
            $("#password1").removeClass("valid");
            $("#password1").addClass("invalid");
										}	}else{
											$("#loader_update").hide();
										Materialize.toast('Check Password Format',2000);
											$("#lpassword1").html("1 UpperCase, 1 lowerCase, 1 Number, at least 6 characters");
            $("#password1").removeClass("valid");
            $("#password1").addClass("invalid");
										}
									}else{
										$("#loader_update").hide();
										Materialize.toast('Change Account Number',2000);
										$('#account1').addClass('invalid');
                $('#account1').removeClass('valid');
                $('#acc_1').addClass('red-text');
                $('#acc_1').removeClass('green-text');
                $('#acc_1').html('Change');
									}	}else{
										$("#loader_update").hide();
									Materialize.toast('Check Account Number',2000);
									  $('#account1').addClass('invalid');
                $('#account1').removeClass('valid');
                $('#acc_1').addClass('red-text');
                $('#acc_1').removeClass('green-text');
                $('#acc_1').html('0-9 Exactly 10');
									}
								}else{
									$("#loader_update").hide();
							   Materialize.toast('Please Select A Bank',2000);
									$('#bank1').addClass('invalid');
                $('#bank1').removeClass('valid');
									$('#lbank1').addClass('red-text');
                $('#lbank1').removeClass('green-text');
                $('#lbank1').html('Change');
								}
							}else{
								$("#loader_update").hide();
						   Materialize.toast('Please Select A State',2000);
								$('#location1').addClass('invalid');
                $('#location1').removeClass('valid');
				$('#llocation1').addClass('red-text');
                $('#llocation1').removeClass('green-text');
                $('#llocation1').html('Change');
                							}
						}else{
							$("#loader_update").hide();
						Materialize.toast('Please Change Phone #',2000);
							$('#phonenumber1').addClass('invalid');
                $('#phonenumber1').removeClass('valid');
                $('#lphone1').addClass('red-text');
                $('#lphone1').removeClass('green-text');
                $('#lphone1').html('Change');
						} }else{
							$("#loader_update").hide();
					   Materialize.toast('Check Phone Number',2000);
							$('#phonenumber1').addClass('invalid');
                $('#phonenumber1').removeClass('valid');
                $('#lphone1').addClass('red-text');
                $('#lphone1').removeClass('green-text');
                $('#lphone1').html('Numbers Only, exactly 11');
						}
					}else{
						$("#loader_update").hide();
				   Materialize.toast('Check Last Name',2000);
			$("#lname1").html("Abc! >2");
            $("#lastname1").removeClass("valid");
            $("#lastname1").addClass("invalid");
            $("#lname1").removeClass("green-text");
            $("#lname1").addClass("red-text");
					}
				}else{
					$("#loader_update").hide();
				Materialize.toast('Check First Name',2000);
					$("#fname1").html("Abc! >2");
            $("#firstname1").removeClass("valid");
            $("#firstname1").addClass("invalid");
            $("#fname1").removeClass("green-text");
            $("#fname1").addClass("red-text");
				};
				
				console.log(user_id1 + ' ' +bank_id1+' '+firstname1+' '+lastname1+' '+phonenumber1+' '+account1+' '+password1+' '+password2+' '+state_id1);
          });
				
	$("#lastname1").focusout(function(){
       var storelastname = $("#lastname1").val();
        if(storelastname.length == ""){
            $("#lastname1").addClass("invalid");
            $("#lastname1").removeClass("valid");
            $("#lname1").html("Empty");
            $("#lname1").removeClass("green-text");
            $("#lname1").addClass("red-text");

        }else if(name_reg.test(storelastname)){
            
            $("#lastname1").removeClass("invalid");
            $("#lastname1").addClass("valid");
            $("#lname1").html("OK");
            $("#lname1").removeClass("red-text");
            $("#lname1").addClass("green-text");
           lastname1 = storelastname;
           
        }else{
            $("#lname1").html("Abc! >2");
            $("#lastname1").removeClass("valid");
            $("#lastname1").addClass("invalid");
            $("#lname1").removeClass("green-text");
            $("#lname1").addClass("red-text");
         }
        });
//    End of Last name Validation 	
				
// 	First Name Validation 
    $("#firstname1").focusout(function(){
        
        var storefirstname = $("#firstname1").val();
        if(storefirstname.length == ""){
            $("#firstname1").addClass("invalid");
            $("#firstname1").removeClass("valid");
            $("#fname1").html("Empty");
            $("#fname1").removeClass("green-text");
            $("#fname1").addClass("red-text");
            firstname = storefirstname;
        }else if(name_reg.test(storefirstname)){
            
            $("#firstname1").removeClass("invalid");
            $("#firstname1").addClass("valid");
            $("#fname1").html("OK");
            $("#fname1").removeClass("red-text");
            $("#fname1").addClass("green-text");
            firstname1 = storefirstname;
           
        }else{
            $("#fname1").html("Abc! >2");
            $("#firstname1").removeClass("valid");
            $("#firstname1").addClass("invalid");
            $("#fname1").removeClass("green-text");
            $("#fname1").addClass("red-text");
           
                
            }
        })
//    End of First name Validation 

//    Password Validation 
    $("#password1").focusout(function(){
        
        var storepassword = $("#password1").val();
        if(storepassword.length == ""){
            $("#password1").addClass("invalid");
            $("#password1").removeClass("valid");
            $("#lpassword1").html("");
       }else if(password_reg.test(storepassword)){
            
            $("#password1").removeClass("invalid");
            $("#password1").addClass("valid");
            $("#lpassword1").html("");
           
                     
        }else{
            $("#lpassword1").html("");
            $("#password1").removeClass("valid");
            $("#password1").addClass("invalid");
                
            }
        })
//    End of Password Validation 
    			
//    Password Validation 
    $("#password2").focusout(function(){
        
        var storepassword2 = $("#password2").val();
        var storepassword1 = $("#password1").val();
        if(storepassword2.length == ""){
            $("#password2").addClass("invalid");
            $("#password2").removeClass("valid");
            $("#lpassword2").html("");

        }else if(password_reg.test(storepassword2) && storepassword1 == storepassword2){
            
            $("#password2").removeClass("invalid");
            $("#password2").addClass("valid");
            $("#lpassword2").html("OK");
            $("#lpassword2").addClass("green-text");
            $("#lpassword2").removeClass("red-text");
                 
        }else{
			$("#lpassword2").addClass("red-text");
            $("#lpassword2").removeClass("green-text");
            $("#lpassword2").html("Missmatch");
            $("#password2").removeClass("valid");
            $("#password2").addClass("invalid");
              
            }
        })
//    End of Password Validation 
			
//	  Phone Number Validation
    $('#phonenumber1').focusout(function(){
            var phonenumber1 = $('#phonenumber1').val();
            if(phonenumber1 ==''){
             $('#phonenumber1').addClass('invalid');
                $('#phonenumber1').removeClass('valid');
                $('#lphone1').addClass('red-text');
                $('#lphone1').removeClass('green-text');
                $('#lphone1').html('Empty');
            };
            
            if(phonenumber1 != ''){if(phone_reg.test(phonenumber1)){
                $('#phonenumber1').addClass('valid');
                $('#phonenumber1').removeClass('invalid');
                $('#lphone1').addClass('green-text');
                $('#lphone1').removeClass('red-text');
                $('#lphone1').html('Ok');
            } else { 
                $('#phonenumber1').addClass('invalid');
                $('#phonenumber1').removeClass('valid');
                $('#lphone1').addClass('red-text');
                $('#lphone1').removeClass('green-text');
                $('#lphone1').html('Numbers Only, exactly 11');
                }}
        });
//	   End of Phone Number Validation 
			
// 		Account Number Validation
    $('#account1').focusout(function(){
            var account1 = $('#account1').val();
            if(account1 =='' || account1 =='0000000000'){
             $('#account1').addClass('invalid');
                $('#account1').removeClass('valid');
                $('#acc_1').addClass('red-text');
                $('#acc_1').removeClass('green-text');
                $('#acc_1').html('Empty');
            };
            
            if(account1 > 0 ){if(acc_reg.test(account1)){
                $('#account1').addClass('valid');
                $('#account1').removeClass('invalid');
                $('#acc_1').addClass('green-text');
                $('#acc_1').removeClass('danger-text');
                $('#acc_1').html('Ok');
            } else { 
                $('#account1').addClass('invalid');
                $('#account1').removeClass('valid');
                $('#acc_1').addClass('red-text');
                $('#acc_1').removeClass('green-text');
                $('#acc_1').html('0-9 Exactly 10');
                }}
        });
//		End of Account Number Validation
// 		Profil image update form
    $('#upload_profile_image_form').submit(function(event){
        event.preventDefault();
        var user_id = $('#idprofile').val();
        var image = $('#image').val();
        if(image == '' || user_id == '')
            {
                Materialize.toast('No File Selected', 1500);
                return false;
            }
        else
            {
               var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
                    {
                         Materialize.toast('Invalid Image Format', 1500);
                        $('#image').val('');
                return false;
                    }
                else
                    {	$('#loader_image').show();
                        $.ajax({
                            url:'../ajax/users.php',
                            method:'POST',
                            data: new FormData(this),
                            contentType:false,
                            processData:false, 
                            success:function(data)
                            {	$('#loader_image').hide();
                                console.log(data);
								if(data == 'Upload successful')
								{ 
									 Materialize.toast(data, 1000,'rounded', function(){
										 location.reload(true);
									 });
									}else{
									 Materialize.toast(data, 1500);
								}
                                
                            }
                            
                        })
                    }
            };
    });
    
   
			
	});
			
		
  </script>
</body>
</html>