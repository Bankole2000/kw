<?php
session_start();

if(isset($_SESSION["email"]) && isset($_SESSION["user_id"]) && isset($_SESSION["loggedin"]) && isset($_SESSION["password"])){
    
    require_once('../scripts/connect.php');
    $sql= "SELECT * FROM user_table WHERE email = '{$_SESSION['email']}' AND password = '{$_SESSION['password']}' LIMIT 1";
        $result = $db->query($sql);
        if($result->num_rows === 1 ){
            while($row =  $result->fetch_array()){
            $user_id = $row["user_id"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
            $password = $row["password"];
            $phone_number = $row["phone_number"];
            $gender = $row["gender"];
            $bank_id = $row["bank_id"];
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
			$_SESSION['user_id'] = $row["user_id"];
            }
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
	
	$sqldon_amount_remaining = "SELECT SUM(amount_remaining) AS don_remaining FROM donor_request_table WHERE donor_user_id = '{$_SESSION['user_id']}'";
	$sqlrec_amount_remaining = "SELECT SUM(amount_remaining) AS rec_remaining FROM recieve_request_table WHERE reciever_user_id = '{$_SESSION['user_id']}'";
	$res1 = $db->query($sqldon_amount_remaining);
	$res2 = $db->query($sqlrec_amount_remaining);
	$res1row = $res1->fetch_array();
	$res2row = $res2->fetch_array();
	$don_amount_remaining = $res1row['don_remaining'];
	$rec_amount_remaining = $res2row['rec_remaining'];
	
	$sqltabdon_amount_remaining = "SELECT SUM(amount_to_give - amount_given) AS tabdon_remaining FROM donor_request_table WHERE donor_user_id = '{$_SESSION['user_id']}'";
	$sqltabsumdon_unmatched = "SELECT SUM(amount_unmatched) AS tabdon_unmatched FROM donor_request_table WHERE donor_user_id = '{$_SESSION['user_id']}'";
	$sqltabsumrec_unmatched = "SELECT SUM(amount_unmatched) AS tabrec_unmatched FROM recieve_request_table WHERE reciever_user_id = '{$_SESSION['user_id']}'";
	$sqltabrec_amount_remaining = "SELECT SUM(amount_to_recieve - amount_recieved) AS tabrec_remaining FROM recieve_request_table WHERE reciever_user_id = '{$_SESSION['user_id']}'";
	$rest1 = $db->query($sqltabdon_amount_remaining);
	$rest2 = $db->query($sqltabrec_amount_remaining);
	$rest3 = $db->query($sqltabsumdon_unmatched);
	$rest4 = $db->query($sqltabsumrec_unmatched);
	$rest1row = $rest1->fetch_array();
	$rest2row = $rest2->fetch_array();
	$rest3row = $rest3->fetch_array();
	$rest4row = $rest4->fetch_array();
	$tabdon_amount_remaining = $rest1row['tabdon_remaining'];
	$tabrec_amount_remaining = $rest2row['tabrec_remaining'];
	$tabdon_amount_unmatched = $rest3row['tabdon_unmatched'];
	$tabrec_amount_unmatched = $rest4row['tabrec_unmatched'];
	$donmatchsearch = '';
	$recmatchsearch = '';
	if($tabdon_amount_unmatched > 0){
		$donmatchsearch = 'display:block;';
	}else if($tabdon_amount_unmatched == 0){
		$donmatchsearch = 'display:none;';
	};
	if($tabrec_amount_unmatched > 0){
			$recmatchsearch = 'display:block;';
	}else if($tabrec_amount_unmatched == 0){
		$recmatchsearch = 'display:none;';
	};
							
//End of Side Bar Notifications $ counts
    
	// Get Tab Matches
	$rtm='';
	$rtmps='';
	$dtmps='';
	$dtm='';
	$rtmsql ="SELECT * FROM match_table JOIN user_table ON user_table.user_id = match_table.donor_user_id WHERE reciever_user_id = '{$_SESSION['user_id']}' AND is_confirmed = 0";
	$dtmsql ="SELECT * FROM match_table JOIN user_table ON user_table.user_id = match_table.reciever_user_id WHERE donor_user_id = '{$_SESSION['user_id']}' AND is_confirmed = 0";
	$resrtmsql = $db->query($rtmsql);
	$resdtmsql = $db->query($dtmsql);
	if($resrtmsql->num_rows > 0){
		$rtm = '<ul class="collection">';
		while($rtmrow = $resrtmsql->fetch_array()){
			if($rtmrow["is_paid"] == 0){
				$rtmps ='<span class="orange-text">Unpaid</span>';
			}else if($rtmrow["is_paid"] == 1){
				$rtmps ='<span class="green-text">Paid</span>';
			}
			
			$rtm .= '<li class="collection-item avatar">
      <img src="'.$rtmrow["profile_pic"].'" alt="" class="circle" style="width:50px; height:50px;">
      <span class="title orange-text"><b>'.$rtmrow["first_name"].' '.$rtmrow["last_name"].'</b></span>
      <p>Amount: &#8358; <span class="orange-text">'.$rtmrow["matched_amount"].'</span> - '.$rtmps.' - <span class="orange-text">Unconfirmed</span></p>      
    </li>';
		}$rtm .= '<ul>'; 
	}else{
		$rtm = '<p>You do not have any matches to recieve yet</p>';
	}
	if($resdtmsql->num_rows > 0){
		$dtm = '<ul class="collection">';
		while($dtmrow = $resdtmsql->fetch_array()){
			if($dtmrow["is_paid"] == 0){
				$dtmps ='<span class="orange-text">Unpaid</span>';
			}else if($dtmrow["is_paid"] == 1){
				$dtmps ='<span class="green-text">Paid</span>';
			}
			
			$dtm .= '<li class="collection-item avatar">
      <img src="'.$dtmrow["profile_pic"].'" alt="" class="circle" style="width:50px; height:50px;">
      <span class="title orange-text"><b>'.$dtmrow["first_name"].' '.$dtmrow["last_name"].'</b></span>
      <p>Amount: &#8358; <span class="orange-text">'.$dtmrow["matched_amount"].'</span> - '.$dtmps.' - <span class="orange-text">Unconfirmed</span></p>      
    </li>';
		}$dtm .= '<ul>'; 
	}else{
		$dtm = '<p>You do not have any matches to donate to yet</p>';
	}
	
	
        
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
    
    
    <title>KoboWise - Donations</title>
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

                        <li><a href="chat.php" data-tooltip="Chat" data-position="right" class="tooltipped modal-trigger"><i class="fa fa-comments fa-lg colortextbrand" data-fa-transform="right-2"></i></a></li>
                        <li><a href="logout.php" data-tooltip="Logout" data-position="right" class="tooltipped"><i class="fa fa-sign-in-alt fa-lg blue-grey-text" data-fa-transform="grow-5 right-2"></i></a></li>
                        <li><a href="profile.php" data-tooltip="My Profile" data-position="right" class="tooltipped"><img src="<?php echo $profile_pic; ?>" style="width:50px; height:50px; margin-top:7px;" class="circle" alt=""></a></li>
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
                    <img src="" style="width:600px;" alt="">
                </div>
                <a href="profile.php"><img src="<?php echo $profile_pic; ?>" class="circle" alt=""></a>
                <a href="profile.php"><span class="name white-text"><?php echo $first_name." ".$last_name; ?></span></a>
                <a href="profile.php"><span class="email white-text"><?php echo $email; ?></span></a>

            </div>
        </li>
        <li>
            <a class="active subheader">
                <div>My Account</div>
            </a>


        </li>
        <li>
            <a href="index.php">
                <div><i class="blue-grey-text text-lighten-1 fas fa-tachometer-alt fa-fw fa-lg" data-fa-transform="up-1"></i>&nbsp; &nbsp;Dashboard</div>
            </a>
        </li>
        <li>
            <a href="profile.php">
                <div><i id = "profile_icon" class="colortextdon text-lighten-1 fas fa-user-edit fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; My Profile<span id="profile2" class="colordon profile_note"></span></div>
            </a>
        </li>

        <div class="divider"></div>
        <li>
            <a class="subheader">
                <div>Pending Donations</div>
            </a>
        </li>
        <li class="no-padding active">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header">
                        <div><i class="colortextbrand fas fa-user-friends fa-fw fa-lg" data-fa-transform="grow-4"></i>&nbsp; &nbsp; Matches<?php echo $navmatches; ?></div>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li class="grey lighten-3">
                                <a href="donations.php">
                                    <div><i class="colortextdon text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform="grow-4"></i> &nbsp; &nbsp; To Give<?php echo $navdonmatches;?></div>
                                </a>
                            </li>
                            <li>
                                <a href="eligibility.php">
                                    <div><i class="colortextrec fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform=""></i> &nbsp; &nbsp; To Recieve<?php echo $navrecmatches;?></div>
                                </a>
                            </li>
                            <li>
                                <a href="records.php">
                                    <div><i class="blue-grey-text text-lighten-1 fas fa-money-check-alt fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp;Records</div>
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
                <div><i class="blue-grey-text fas fa-info fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; Info and FAQs</div>
            </a>
        </li>
        <li>
            <a href="news.php">
                <div><i class="blue-grey-text fas fa-newspaper fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; News and Updates</div>
            </a>
        </li>
        <li>
            <a href="support.php">
                <div><i class="blue-grey-text fas fa-cog fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; Support </div>
            </a>
        </li>
        <li>
            <a href="logout.php">
                <div><i class="blue-grey-text fa fa-sign-in-alt fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; Logout </div>
            </a>
        </li>

    </ul>
    <!-- ====================== END OF SIDE BAR NAVIGATION ====================== -->
   
   <!-- ===================== BREADCRUMBS HERE ================================== -->
    <nav class="blue-grey darken-4" style="height:45px; background:url(../_assets/img/bckgrnds/material1.png); background-size: cover; background-repeat: no-repeat;">
        <div class="nav-wrapper ">
            <div class="col s12 container" >
                <h5><i class="fa fa-money-bill-wave fa-sm" data-fa-transform="right-2 up-1"></i> &nbsp; Donations <span class="right hide-on-small-only"><?php echo $email; ?></span></h5>
            </div>

        </div>
    </nav>
    <!-- ===================== END OF BREAD CRUMBS BREADCRUMBS ============== -->
    <section class="parallax-container section" style="height:200px;"><div style ="background-color: rgba(0,0,0,0.5);
    top:0;left:0; width: 100%;
    min-height: 500px; margin-top:-15px; margin-bottom:-35px; padding-top:20px;">
      

       <div class="row center" style="margin-top:130px;">
		   <div class="container"><h3 class="white-text">Your Donations</h3></div></div></div><div class="parallax" ><img src="../_assets/img/bckgrnds/euro.jpg" alt=""></div></section>
    
    <section class="section center grey"><div class="row container">
    <div class="col s12 m6 l6">
    <div class="card colordark white-text">

                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fa fa-money-bill-alt colortextdon text-lighten-1" data-fa-transform=" left-10"></i>DONATIONS</span>


                        <div class="divider"></div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right"><?php echo $don_balance;?></h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button class="btn make_donation1 colordon waves-effect waves-light" style="width:100%;">MAKE DONATION</button>
                    </div>
                </div>
    </div>
    <div class="col s12 m6 l6">
    	<div class="card colordon white-text center" style="padding-left:20px; padding-right:20px; padding-top:5px; padding-bottom:-10px">
                    <div class="card-title">
                        <strong><h4 class="right">.00</h4><h4 class="count right"><?php echo $total_don;?></h4><h4 class="right">&#8358;</h4></strong> </div>
                    <div class="card-content">

                        Total Donated


                    </div>
                </div>
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header waves-effect waves-orange">
                            <div><i class="fa fa-money-bill-alt colortextdon text-lighten-1" data-fa-transform="grow-4"></i>&nbsp; &#8358;<?php echo $don_amount_remaining;?> to Donate &nbsp; <i class="fa fa-caret-right"></i></div>
                            <?php echo $navdonmatches;?></div>
                        <div class="white collapsible-body">
                           <?php echo $dtm;?>
                            <span style="<?php echo $donmatchsearch;?>"><p><b>Searching for Matches for you.</b> &#40;<i>This may take up to, but no more than, 72 hours</i>&#41;</p>
                            <div class="progress">
      <div class="indeterminate"></div>
  </div></span> 
                     
                        </div>
					</li></ul>
    </div>
    </div></section>
    
    <section class="section"><div class="row">
		   <div class="container"><h4 class="colortextdon">Requests <i class="fas fa-spinner fa-pulse grey-text"></i></h4></div><div class="col s12 m12 l12" id="don_requests_tab">
                
                        
                   
		</div></div></section>
    
    <section class="section">
               <div class="row">
               <div class="container"><h4 class="colortextdon">Matches <i class="fas fa-spinner fa-pulse grey-text"></i></h4></div>
               <div class="col s12 m12 l12" id="don_matches_tab">
                <table class="responsive-table centered blue-grey darken-4 white-text">
                    <thead class="blue-grey darken-2">
                        <tr>
                            <th>
                                <div>Name</div>
                            </th>
                            <th>Sex</th>
                            <th>Phone Number</th>
                            <th>Amount </th>
                            <th>Match Code</th>
                            <th>Date Matched</th>
                            <th>Date Paid</th>
                            <th>Confirmation</th>

                        </tr>
                    </thead>

                    <tbody id="to_recieve">
                        
                    </tbody>
                    
                </table>
                <div class="col s12 m12 l12 center"> <ul class="pagination">
    <li class="disabled"><a href="#!"><i class="fa fa-caret-left"></i></a></li>
    <li class="active"><a href="#!">1</a></li>
    <li class="waves-effect"><a href="#!">2</a></li>
    <li class="waves-effect"><a href="#!">3</a></li>
    <li class="waves-effect"><a href="#!">4</a></li>
    <li class="waves-effect"><a href="#!">5</a></li>
    <li class="waves-effect"><a href="#!"><i class="fa fa-caret-right"></i></a></li>
  </ul></div>
		</div></div></section>
    
    
    <section class="section white">
      <div class="row container">
        <div class="col s12 m6 l6"><h2 class="header colortextbrand">Guidelines</h2>
        <p class="grey-text text-darken-3">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p></div><div class="col s12 m6 l6"><p class="flow-text center colortextbrand">FAQs</p><ul class="collapsible popout">
    <li>
      <div class="collapsible-header">How Do I make a Donation</div>
      <div class="collapsible-body"><span>First you start with Updating Your Profile - Once your profile is updated, you can begin making an recieving donations</span></div>
    </li>
    <li>
      <div class="collapsible-header">How Much Can I donate</div>
      <div class="collapsible-body"><span>Any amount between &#8358;2000 (two thousand naira) and &#8358;200,000 (two hundred thousand naira is allowed)</span></div>
    </li>
    <li>
      <div class="collapsible-header">Third</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, animi. ipsum dolor sit amet.</span></div>
    </li>
  </ul></div>
      </div>
    </section>
    <section class="parallax-container section" style="height:100px;"><div style ="background-color: rgba(255,255,255,0.5);
    top:0;left:0; width: 100%;
    min-height: 500px; margin-top:-15px; margin-bottom:-35px; padding-top:20px;">
      

       <div class="row" style="margin-top:40px;">
		   <div class="container"><h3 class="colortextdon">Guidelines</h3></div></div></div><div class="parallax" ><img src="../_assets/img/bckgrnds/afrobiz6.jpg" alt=""></div></section>
    <div class="divider"></div>
     <!-- ================= SYSTEM WATCH SECTION ================= -->
    <div class="section">
        
         <div class="row">
            <div class="col s12 m12 l6 grey lighten-4" style="padding-bottom:20px;">
                <h5 class="flow-text center"><i class="fa fa-user-friends fa-sm"></i>&nbsp; Your Transactions</h5>
                <table class="highlight centered grey lighten-4">

                    <thead class="orange lighten-2">
                        <tr>
                            <th>
                                <div>Donor</div>
                            </th>

                            <th>
                                <div>Amount</div>
                            </th>
                            <th>
                                <div>Recipient</div>
                            </th>
                            <th class="hide-on-small-only">
                                <div>Date Confirmed</div>
                            </th>
                           
                        </tr>
                    </thead>


                    <tbody id="transactions">
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../_assets/img/person1.jpg" alt="Contact Person"> Jane
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../_assets/img/person3.jpg" alt="Contact Person"> Jane
                                </div>
                            </td>
                           
                            <td>$10000.87</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../_assets/img/person4.jpg" alt="Contact Person"> Jane
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../_assets/img/person2.jpg" alt="Contact Person"> Jane
                                </div>
                            </td>
                           
                            <td>$10000.87</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../_assets/img/person3.jpg" alt="Contact Person"> Jane
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../_assets/img/person1.jpg" alt="Contact Person"> Jane
                                </div>
                            </td>
                            
                            <td>$10000.87</td>
                        </tr>
                    </tbody>
                </table>
                <a href="records.php" class="btn waves-effect waves-light" style="width:100%;"><i class="fa fa-money-check"></i>&nbsp; View Transactions</a>
            </div>
            <div class="col s12 m12 l6 grey lighten-4"><h5 class="flow-text center"><i class="fa fa-user-friends fa-sm"></i>&nbsp; KoboWise Chat</h5><div class="video-container"><iframe src="../chat.html" frameborder="0" height ="800" width="450" id="chatframe"></iframe></div>
    
        <div class="input-field col s12" style="padding-bottom:20px;">
          
          <textarea id="chat_message" class="materialize-textarea"></textarea>
          <label for="chat_message"><i class="fa fa-edit"></i>&nbsp;Chat Message</label>
          <button class="btn waves-effect waves-light" id="chat_submit" style="width:100%; margin-top:-20px; "><i class="fa fa-paper-plane"></i>&nbsp;Send Message</button>
        </div>
     
   
  </div>
        </div>
    </div>
    <!-- ================= END OF SYSTEM WATCH SECTION ================= -->
     
    
   <div style="display:none;"> 
   <p id="user_email"><?php echo $email;  ?></p>
    <p id="first_name"><?php echo $first_name;  ?></p>
    <p id="password"><?php echo $password;  ?></p>
    <p id="location"><?php echo $state_id;  ?></p>
    <p id="profile_pic"><?php echo $profile_pic;  ?></p>
    <p id="acc_number"><?php echo $acc_number;  ?></p>
    <p id="bank_id"><?php echo $bank;  ?></p>
    <p id="phone_number"><?php echo $phone_number;  ?></p>
    <p id="don_pending"><?php echo $don_pending;  ?></p>
    <p id="rec_pending"><?php echo $rec_pending;  ?></p>
    <p id="user_id"><?php echo $user_id;  ?></p>
    <input type="hidden" value="" id="all_profile_status">
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
	   ?> </div>
    <!-- ====================== FLOATING ACTION BUTTON ======================== -->
    <div class="fixed-action-btn click-to-toggle">
        <a class="tooltipped btn-floating btn-large red waves-effect waves-light" data-tooltip="Quick menu" data-position="left">
    <i class="fas fa-bars fa-2x" data-fa-transform="down-4"></i>
  </a>
        <ul>
           <li><a href="profile.php" class="btn-floating orange waves-effect waves-light tooltipped" data-tooltip="My Profile" data-position="left"><i class="fas fa-user fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a class="tooltipped btn-floating btn-large waves-effect waves-light blue modal-trigger pulse" data-tooltip="View Donations" data-position="left"><i class="fas fa-money-bill-wave fa-lg" data-fa-transform="down-1 grow-6"></i></a></li>
            <li><a href="eligibility.php" data-target="recieve_modal" class="tooltipped btn-floating waves-effect waves-light green modal-trigger" data-tooltip="View Eligibity" data-position="left"><i class="fas fa-money-check fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a href="support.php" class="tooltipped btn-floating teal waves-effect waves-light" data-tooltip="Help & Support" data-position="left"><i class="fas fa-cog fa-lg" data-fa-transform="grow-4 down-1"></i></a></li>
            <li><a href="logout.php" class="tooltipped btn-floating red waves-effect waves-light" data-tooltip="logout" data-position="left"><i class="fas fa-sign-in-alt fa-lg" data-fa-transform="down-1"></i></a></li>
        </ul>
    </div>
    <!-- ==================== END OF FLOATING ACTION BUTTON =================== -->
   
   <!-- ===================== PROFILE DETAILS SECTION ========================= -->
  
   <!-- ===================== END OF PROFILE DETAILS SECTION ====================== -->
    
    <!-- ================= FOOTER SECTION ================= -->
   <?php 
	
	include "../_assets/includes/footer.php";
	
	?>
   <!-- ================= FOOTER SECTION ================= -->
   <!-- ================= MODALS ==================-->
    
    <div id="donate_modal" class="modal">
    <form id="don_request_form">
    <div class="modal-content center">
    <h4 class="colortextbrand"><i class="fa fa-donate"></i>&nbsp; Make a Donation</h4>
   
		<p class="flow-text"> How much would you like to donate? &#8358;:</p>
        <div class="input-field">
          <input id="donation" type="number" pattern="[0-9]*" required>
           <label for="donation">Amount &nbsp;<span class="red-text" id="don"></span><span class="grey-text" id="loader_don" style="display:none;"> Sending Request <i class="fas fa-spinner fa-pulse"></i></span><span class="grey-text" id="error_don" style="display:none;"> Connection Error <i class="fas fa-broadcast-tower"></i></span></label>         
       </div>
       <p>
      <input type="checkbox" value="consent" id = "consent"/>
             <label for="consent">I accept the <a>terms and conditions</a>.&nbsp;<span class="red-text" id="don_consent"></span></label>
        </p>    
  </div>
      <div class="modal-footer center">
      <a class="btn red modal-close waves-effect waves-light" id="don_cancel">Cancel </a>
      <a type="submit" class="btn colorbrand waves-effect waves-light" id="don_agree">Agree</a>
    </div>
        </form>
  </div>
      
       
    <div id="don_change_modal" class="modal">
    <form id="don_change_form">
    <div class="modal-content center">
    <h4 class="colortextbrand"><i class="fa fa-edit"></i>&nbsp; Change Donation</h4>
   
		<p class="flow-text"> Change Donation Amount Offered? &#8358;</p>
       <div class="input-field">
          <input id="donoldamnt" type="number" value="" pattern="[0-9]*" required>
           <label id="donoldamnt">Amount &nbsp;<span class="red-text" id="don_change"></span><span class="grey-text" id="loader_don_change" style="display:none;"> Sending Request <i class="fas fa-spinner fa-pulse"></i></span><span class="grey-text" id="error_don_change" style="display:none;"> Connection Error <i class="fas fa-broadcast-tower"></i></span></label>         
       </div>
       
       <p>
      <input type="checkbox" value="consent2" id = "consent2"/>
             <label for="consent2">I accept the <a>terms and conditions</a>.&nbsp;<span class="red-text" id="don_consent2"></span></label>
        </p>    
        <input type="hidden" value="" id="don_update_id">
  </div>
      <div class="modal-footer center">
      <a class="btn red modal-close waves-effect waves-light" id="don_change_cancel">Cancel </a>
      <a type="submit" class="btn colorbrand waves-effect waves-light" id="don_change_agree">Agree</a>
    </div>
        </form>
  </div>
    
     
    <div id="don_success" class="modal">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h5 class="colortextbrand"><i class="fa fa-check-circle fa-sm"></i>&nbsp; Donation Request Successful</h5>
        <p class="flow-text"><strong>Hi <span id="fname2" class="orange-text text-darken-2"></span>, Thanks for offering to Donate</strong>. Your request has been registered and you will be notified via email once you are matched. Please <span class="colortextbrand">keep your <b>Profile details </b>updated</span> and <span class="colortextbrand">be reachable via phone/email.</span>  </p>
    </div>
    <div class="modal-footer">
      <a href="index.php" class=" modal-action modal-close waves-effect waves-light btn colorbrand">Okay</a>
    </div>
  </div>
  
   
      <div id="don_matched_modal" class="modal">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h5 class="red-text text-lighten-1"><i class="fa fa-times-circle fa-sm"></i>&nbsp; Cannot Change</h5>
        <p class="flow-text"><strong>Sorry <span id="fname10" class="orange-text text-darken-2"></span>,</strong> this Donation cannot be Changed because it has <strong class="colortextbrand"> already been matched</strong>. Donations offered can only be change <b class="colortextbrand">before</b> they are matched.</p>
    </div>
    <div class="modal-footer">
      <a class=" modal-action modal-close waves-effect waves-light btn colorbrand">Okay</a>
    </div>
  </div>
   
    <div id="profile_modal" class="modal">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h5 class="red-text"><i class="fa fa-user-edit fa-sm"></i>&nbsp; Incomplete Profile</h5>
        <p class="flow-text">Hello <span class="orange-text text-darken-2" id="fname5"></span>. It seems your profile is incomplete. Please Update Your Profile so you can perform this action. <br/></p><a href="profilearticle" target="_blank" class="colortextbrand">Why do I have to update my profile?</a>
    </div>
    <div class="modal-footer">
      <a class=" modal-action modal-close waves-effect waves-light btn red" onclick="Materialize.toast('Action Cancelled',1500)">Cancel</a>
    <a href="profile.php" class="modal-action modal-close waves-effect waves-light btn colorbrand">Profile</a>
    </div>
  </div>
  
   <div id="confirm_pay_modal" class="modal modal-fixed-footer">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h5 class="colortextbrand"><i class="fa fa-question-circle fa-sm"></i>&nbsp; Confirm Payment? <i class="fas fa-spinner loader_condon fa-pulse grey-text" style="display:none;"></i></h5>
        <span class="grey-text" id="loader_condon2" style="display:none;">Registering Payment <i class="fas fa-spinner fa-pulse"></i></span><span class="grey-text" id="error_condon2" style="display:none;">Connection Error <i class="fas fa-broadcast-tower"></i></span>
		<p class="flow-text">Confirm you've paid <b>&#8358;<span class="orange-text text-darken-2" id="confmatchamount"></span></b> to <b><span class="orange-text text-darken-2" id="confdonname"></span></b>, Account Number: <b><span class="orange-text text-darken-2" id="confaccnumber"></span></b>&nbsp;<b><span class="orange-text text-darken-2" id="confbank"></span>?</b> Please be sure to <b>make and keep with you</b> some sort of <b><span class="colortextbrand">Proof of Payment</span></b> For your own safety.<br/></p><a class="colortextbrand">Click here to view more donation guidelines.</a><input type="hidden" id="match_id10" value=""><input type="hidden" id="reciever_id10" value="">
    </div>
    <div class="modal-footer">
      <a id ="notyetpaid" class=" modal-action modal-close waves-effect waves-light red btn">NOT YET</a>
      <a id="ihavepaid" class="disabled waves-effect waves-light btn colorbrand">I've Paid </a>
    </div>
  </div>
     
    <!-- ================== END MODALS ===================-->
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
    <script type="text/javascript" src="../_assets/js/vue.js"></script>
    
    <script type="text/javascript" src="../_assets/js/preload.js"></script>
    <script type="text/javascript" src="../_assets/fonts/svg-with-js/js/fontawesome-all.min.js"></script>
    <script>$(document).ready(function(){
			
	var dfltpassword = 'Password1234';
			
	function status_check()
    {
     var firstname = $('#first_name').text();
     var email = $('#user_email').text() ;
     var user_id = $('#user_id').text();
     var password = $('#password').text();
     var acc_number = $('#acc_number').text();
     var profile_pic = $('#profile_pic').text();
     var phone_number = $('#phone_number').text();
     var bank_id = $('#bank_id').text();
     var state_id = $('#state_id').text();
        
    $('#fname1').html(firstname);
        $('#fname2').html(firstname);
        $('#fname3').html(firstname);
        $('#fname4').html(firstname);
        $('#fname5').html(firstname);
        $('#fname6').html(firstname);
        $('#fname7').html(firstname);
        $('#fname8').html(firstname);
        $('#fname9').html(firstname);
        $('#fname10').html(firstname);
        $('#fname11').html(firstname);
    var details = user_id + ' ' + firstname + ' ' + email + ' ' + password;
        $('#gotten_details').html(details);
        if(bank_id == '0' || password == dfltpassword || state_id == '0' ||  acc_number == '0000000000'){
            $('#quick_menu').addClass('pulse').removeClass('blue-grey').addClass('colorbrand');
            $('#profile').addClass('pulse').removeClass('blue-grey').addClass('colordon');
            $('#profile2').addClass('pulse');
            $('.profile_note').addClass('new badge').html('Incomplete');
            $('#all_profile_status').val('NOTOK');
            $('#start_here').show();
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
			
	function rec_status(){
		var reccnt = $('#user_rec_matches').text();
		console.log(reccnt);
		if (reccnt == "" || reccnt == "0"){
			$('#rec_notify').removeClass('pulse');
		}		
		else{
			$('#quick_menu').addClass('pulse').removeClass('blue-grey').addClass('colorbrand');
			$('#rec_notify').addClass('pulse').removeClass('blue-grey').addClass('colorrec');
		}
		
	}
	rec_status();		
			
			
			
			$('.modal').modal();   
	var timeout = 2000;		
	var donation, consent = "";
    var don_reg = /^[0-9]{4,}$/i;
    var name_reg = /^[a-z]{3,}$/i;
    var email_reg = /^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
    var password_reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
			
	//		 Donation Validation 
    $("#donation").focusin(function(){
		$("#error_don").hide();
		$("#loader_don").hide();
		$("#donation").removeClass("invalid").removeClass("valid");
		$("#don").html("");
	})
    $("#donation").focusout(function(){
        
        donation = $("#donation").val();
        if(donation.length == ""){
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Empty").removeClass("green-text").addClass("red-text");
            
        donation = "";
        }else if(donation > 200000){
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Maximum = 200000").removeClass("green-text").addClass("red-text");
            
            
        donation = "";
                }else if(donation < 1999){
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Minimum = 2000").removeClass("green-text").addClass("red-text");
            
            
        donation = "";
                }else if(donation > 1999 && donation < 200001 && don_reg.test(donation)){
            
            $("#donation").removeClass("invalid").addClass("valid");
            $("#don").html("OK").removeClass("red-text").addClass("green-text");
            
           
        }else{
            
            $("#donation").removeClass("valid").addClass("invalid");
			$("#don").html("Numbers only").removeClass("green-text").addClass("red-text");
            donation="";
          
            }
        });
//      End Donation Validation 
    
   
//      Donation cancel click
    $("#don_cancel").click(function(){
        $("#don").html("");
            $("#donation").removeClass("valid").removeClass("invalid");
            $("#don").removeClass("green-text").removeClass("red-text");
        $("#don_consent").html("");
            donation="";
        $('#don_request_form')[0].reset();
        Materialize.toast('Donation Cancelled', 1500);
        $("#don_agree").removeClass('disabled');
		$("#error_don").hide();
    })
//      End of Donation cancel click

//	     Donation agree click
    $("#don_agree").click(function(){
       $("#loader_don").show();
		$("#error_don").hide();
        var donation = $('#donation').val();
		       
        if (donation.length == ""){
            Materialize.toast('Please enter a Donation', 2500);
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Empty").removeClass("green-text").addClass("red-text");
			$("#loader_don").hide();
        };
        
        if(donation != "" && donation < 2000){
            Materialize.toast('Donation too Small', 2500);
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Minimum = 2000").removeClass("green-text").addClass("red-text");
            $("#loader_don").hide();
            };
        if(donation > 200000){
            Materialize.toast('Donation too large', 2500);
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Maximum = 200000").removeClass("green-text").addClass("red-text");
            $("#loader_don").hide();
            };
        if ($("#consent").is(':checked') == false){
            Materialize.toast('Consent is Required', 2500);
            $("#don_consent").html("Required").removeClass("green-text").addClass("red-text");
			$("#loader_don").hide();
        };
        if ($("#consent").is(':checked') == true){
            $("#don_consent").html("OK").removeClass("red-text").addClass("green-text");
        };
        if (donation != "" && $("#consent").is(':checked') == true && donation > 1999 && donation < 200001 && don_reg.test(donation) == true){
			$("#don_agree").addClass("disabled");
            var user_id = $("#user_id").text() ;
            var user_email = $("#user_email").text() ;
            var first_name = $("#first_name").text() ;
            
            $.ajax({
               url : '../ajax/donation.php',
               method : 'POST',
                dataType: 'text',
               data : {
                user_id : user_id,
                user_email : user_email,
                donation : donation,
                first_name : first_name,
                
            },
                success : function(response){
					$("#loader_don").hide();
                
                    if(response = 'successful'){
                         console.log(response);
                        $("#donation").addClass("valid").removeClass("invalid");
                        $("#don").addClass("green-text").removeClass("red-text").html("Request Successful");
                        $("#fname").html(first_name);
                        donation="";
                        $('#don_request_form')[0].reset();
                        Materialize.toast('Request Successful',500,'rounded', function(){
                             $('#don_success').modal('open');
                         });
                                                           
                    }else if(response = 'failed'){
                         console.log(response);
                       Materialize.toast('Request Unsuccessful',2500);
                        donation = "";
                        $('#don_request_form')[0].reset();
                    }
                    },
				error: function(){
					$("#error_don").show();
					$("#loader_don").hide();
					$("#don_agree").removeClass('disabled');
				},
				timeout: timeout
                }
            );           
            
		 }else if (donation != "" && $("#consent").prop(':checked') == false && donation > 2000 && don_reg.test(donation) == true){
            
            $("#donation").removeClass("invalid").addClass("valid");
			 $("#don").html("OK").removeClass("green-text").addClass("red-text");
            $("#don_consent").html("Required");
            donation="";
                $("#loader_don").hide();
                $("#error_don").hide();
            }
        }       
           
//      End of Donation agree click

    
    );
			
	
 $('.make_donation1').click(function(){
	 var profile_status = $("#all_profile_status").val();
	 console.log(profile_status);
	 if(profile_status =="NOTOK"){
		 $("#profile_modal").modal('open');
	 }else if(profile_status=="FINE"){
		  $("#donate_modal").modal('open');
	 }
 })		
			
// Change Donation Ajax
	$(document).on('click','.don_change', function(){
		var action ="check";
		var user_id = $("#user_id").text();
		var don_update_id = $(this).attr('id');
		$("#don_update_id").val(don_update_id);
		var don_update_amnt = $(this).attr('value');
		console.log(don_update_amnt);
		$('#don_change_modal').modal('open');
		$("#donoldamnt").val(don_update_amnt);
		Materialize.updateTextFields();
	});
// End of Change Donation Ajax
			
			
			
			 var user_id =  $("#user_id").text();
			console.log(user_id);
			$('#chat_submit').click(function(){
				console.log(user_id);
			});
			
		function get_don_matches(page){
			var action = "get_u_don_match_tab";
			$.ajax({
				url:'../ajax/donations.php',
				method:'POST',
				dataType : 'text',
				data:{action:action,
					 user_id:user_id,
					 page:page},
				success:function(data){
					console.log(data);
					$("#don_matches_tab").html(data);
				}
			})
		}
		get_don_matches();
			
		function get_don_requests(page){
			var action = "get_u_don_req_tab";
			$.ajax({
				url:'../ajax/donations.php',
				method:'POST',
				dataType:'text',
				data:{action:action, 
					 user_id:user_id, 
					 page:page},
				success:function(data){
					console.log(data);
					$("#don_requests_tab").html(data);
				}
			})
			
		};
		get_don_requests();	
			
		$(document).on('click','.don_req_page_link', function(){
			var page = $(this).attr('id');
			
			get_don_requests(page);
			
		});		
		$(document).on('click','.don_req_page_left', function(){
		
			var nxtpage =  $(this).val();
			var page =  $(this).attr('id');
			if(page == 1){
				Materialize.toast('No Previous Page',1000);
				return false;
			}else if(page != 1){
			get_don_requests(nxtpage);
			}
		});	
		$(document).on('click','.don_req_page_right', function(){
			
			var nxtpage =  $(this).val();
			var page =  $(this).attr('id');
			var last_page = $("#last_don_req_page").val();
				console.log(page+' '+last_page);
			if(page == last_page){
				Materialize.toast('No Next Page',1000);
				return false;
			}else if(page != last_page){
				get_don_requests(nxtpage);
			}
		});		
		
				
		$(document).on('click','.don_match_page_link', function(){
			var page = $(this).attr('id');
			
			get_don_matches(page);
			
		});		
		$(document).on('click','.don_match_page_left', function(){
		
			var nxtpage =  $(this).val();
			var page =  $(this).attr('id');
			if(page == 1){
				Materialize.toast('No Previous Page',1000);
				return false;
			}else if(page != 1){
			get_don_matches(nxtpage);
			}
		});	
		$(document).on('click','.don_match_page_right', function(){
			
			var nxtpage =  $(this).val();
			var page =  $(this).attr('id');
			var last_page = $("#last_don_match_page").val();
				console.log(page+' '+last_page);
			if(page == last_page){
				Materialize.toast('No Next Page',1000);
				return false;
			}else if(page != last_page){
				get_don_matches(nxtpage);
			}
		});		
	
			
  		$('.parallax').parallax();
		$('.scrollspy').scrollSpy();
		$('.collapsible').collapsible();
});
	</script>
</body>
</html>