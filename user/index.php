<?php
session_start();
//TODO: GOOGLE AND FACEBOOK LOGIN SYSTEM
//TODO: DYNAMIC PHP MATCH NOTIFICATIONS
//TODO: CHAT ROOM?
//TODO: CHANGE ALL STATIC ELEMENTS TO PHP DYNAMICS
//TODO: REPLACE STATIC ARTICLES WITH PHP DYNAMIC
//NOTE: DEVELOP INCLUDE FOOTER (WITH LINKS) AND CHANGE FOOTER
//NOTE: CHANGE DONATIONS TO GH AND PH
//TODO: Setup SYSTEM WATCH Charts & Graphics
//TODO: THEME COLORS
//TODO: All Changes of Final Production on Index.html page


if(isset($_SESSION["email"]) && isset($_SESSION["loggedin"]) && isset($_SESSION["password"])){
    
    require_once('../scripts/connect.php');
    $sql= "SELECT * FROM user_table WHERE email = '{$_SESSION['email']}' AND password = '{$_SESSION['password']}' LIMIT 1";
        $result = $db->query($sql);
        $strike_note = '';
        if($result->num_rows === 1 ){
            while($row =  $result->fetch_array()){
            $user_id = $row["user_id"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
            $password = $row["password"];
            $phone_number = $row["phone_number"];
            $gender = $row["gender"];
            $user_location = $row["state_id"];
            $bank = $row["bank_id"];
            $acc_number = $row["acc_number"];
            $don_balance = $row["don_balance"];
            $total_don = $row["total_don"];
            $total_rec = $row["total_rec"];
            $eligibility = $row["eligibility"];
            $rec_balance = $row["rec_balance"];
            $profile_pic = $row["profile_pic"];
            $user_strikes = $row["user_strikes"];
            $signup_date = $row["signup_date"];
            $loggedin = $_SESSION["loggedin"];
			$_SESSION['user_id'] = $row["user_id"];
				
//User Strkes notifications
				
            if($user_strikes == '0'){ $stike_note = '<div class="card center" style="padding:10px;">
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-plus-circle fa-3x colortextrec"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">
                           <i class="fa fa-plus-circle colortextrec fa-3x"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-plus-circle colortextrec fa-3x"></i>
                        </div>
                    </div>
                    <div class="" style="padding:0px;">
                        <p class="center" styling="padding-bottom:-20px;">You have 0 strikes. Your Account is Healthy! <a data-target="strike_modal" class="modal-trigger"><span class="blue-grey-text"><br/> What do these mean <i class="fa fa-question-circle"></i></span></a></p>
                    </div>

                </div>';}
            else if($user_strikes == '1'){$stike_note = '<div class="card center" style="padding:10px;">
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-times-circle fa-3x red-text"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">
                           <i class="fa fa-plus-circle colortextrec fa-3x"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-plus-circle colortextrec fa-3x"></i>
                        </div>
                    </div>
                    <div class="" style="padding:0px;">
                        <p class="center" styling="padding-bottom:-20px;">You have 1 strikes. Your account is still good! <a data-target="strike_modal" class="modal-trigger"><span class="blue-grey-text"><br/> What do these mean <i class="fa fa-question-circle"></i></span></a></p>
                    </div>

                </div>';}
            else if($user_strikes == '2'){$stike_note = '<div class="card center" style="padding:10px;">
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-times-circle fa-3x red-text"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">
                           <i class="fa fa-times-circle red-text fa-3x"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-plus-circle colortextrec fa-3x"></i>
                        </div>
                    </div>
                    <div class="" style="padding:0px;">
                        <p class="center" styling="padding-bottom:-20px;">You have 2 strikes. You Account is dying! <a data-target="strike_modal" class="modal-trigger"><span class="blue-grey-text"><br/> What do these mean <i class="fa fa-question-circle"></i></span></a></p>
                    </div>

                </div>';}
            else if($user_strikes == '3'){$stike_note = '<div class="card center" style="padding:10px;">
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-times-circle fa-3x red-text"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">
                           <i class="fa fa-times-circle red-text fa-3x"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-times-circle red-text fa-3x"></i>
                        </div>
                    </div>
                    <div class="" style="padding:0px;">
                        <p class="center" styling="padding-bottom:-20px;">You have 3 strikes. Could be deleted any moment! <a data-target="strike_modal" class="modal-trigger"><span class="blue-grey-text"><br/> What do these mean <i class="fa fa-question-circle"></i></span></a></p>
                    </div>

                </div>';}
                
            }
        };
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
	
    
//Don Requests tab in Main body
	
    $don_requests = '';
    $don_status = '';
    $sql2 = "SELECT * FROM donor_request_table WHERE donor_user_id = '{$_SESSION['user_id']}' AND amount_given < amount_offered ORDER BY date_offered DESC";
    require_once('../scripts/connect.php');
    $result2 = $db->query($sql2);
    if($result2->num_rows > 0){
        while($row2 = $result2->fetch_array()){
            if($row2["amount_offered"] == $row2["amount_unmatched"]){
                $don_status = '<span class="colortextdon text-lighten-1">Unmatched</span>';
				$donchnge = '<a class="don_change waves-effect waves-light right secondary-content text-lighten-1" id="'.$row2["donor_request_id"].'" value="'.$row2["amount_offered"].'">Change &nbsp; <i class="fa fa-edit"></i></a>';
            }else if($row2["amount_unmatched"] < $row2["amount_offered"] && $row2["amount_unmatched"] != 0){
                $don_status = '<span class="blue-text">Partially matched</span>';
				$donchnge = '<a class="don_p_matched waves-effect waves-light right secondary-content grey-text modal-trigger" data-target="don_matched_modal">Change &nbsp; <i class="fa fa-edit"></i></a>';
            }else if($row2["amount_unmatched"] == 0){
                $don_status = '<span class="colortextrec">Completely Matched</span>';
				$donchnge = '';
            };
            $don_requests .= ' 
            <li class="collection-item"><div><span class="colortextdon text-lighten-1"><strong>You:</strong> &nbsp;</span>'.$row2["date_offered"].' -&nbsp;<span class="colortextbrand">&#8358; '.$row2["amount_offered"].' &nbsp;</span> '.$don_status.' '.$donchnge.'</div></li>';
        }
    }else if($result2 -> num_rows == 0){
            $don_requests = '<li class="collection-item"><div><span class="colortextdark"><strong>You</strong> currently have no pending donation requests<a class="waves-effect waves-light right secondary-content make_donation1 colortextdon">Make a donation &nbsp;<i class="fa fa-caret-right" data-fa-transform = "right-2"></i></a></div></li>';
    };
	
//Rec Request Tab in Main Body
    $rec_requests = '';
    $rec_status = '';
    $voa_status ='';
	$voa_change = '';
    $sql3 = "SELECT * FROM recieve_request_table WHERE reciever_user_id = '{$_SESSION['user_id']}' AND amount_remaining > 0 ORDER BY date_requested DESC";
    require_once('../scripts/connect.php');
    $result3 = $db->query($sql3);
    if($result3->num_rows > 0){
        while($row3 = $result3->fetch_array()){
            if($row3["amount_to_recieve"] == $row3["amount_unmatched"]){
                $rec_status = '<span class="orange-text">Unmatched</span>';
            }else if($row3["amount_unmatched"] < $row3["amount_to_recieve"] && $row3["amount_unmatched"] != 0){
                $rec_status = '<span class="blue-text">Partially matched</span>';
            }else if($row3["amount_unmatched"] == 0){
                $rec_status = '<span class="green-text">Completely Matched</span>';
            };
            if($row3['voa_approval'] == 0){
                $voa_status ='<span class="orange-text">Not yet Approved</span>';
            }else if($row3['voa_approval'] == 1){
                $voa_status ='<span class="green-text">Approved</span>';
				$voa_change = '';
            }else if($row3['voa_approval'] == 2){
                $voa_status ='<span class="red-text">Unapproved</span>';
				$voa_change = '<a class="voa_change colortextrec modal-trigger" id="'.$row3["recieve_request_id"].'" data-target="voa_change_modal">Change VoA <i class="fa fa-edit"></i></a>';
				$rec_status = '';
            };
            $rec_requests .= ' 
            <li class="collection-item"><div><span class="orange-text text-darken-3"><strong>Request:</strong> &nbsp;</span>-&nbsp;<span class="blue-text">&#8358; '.$row3["amount_to_recieve"].' &nbsp;</span> '.$voa_status.' - '.$voa_change.' - '.$rec_status.'<a href="'.$row3["voa_link"].'" target ="_blank" class="waves-effect waves-light right secondary-content">View VoA &nbsp;<i class="fa fa-eye"></i></a></div></li>';
        }
    }else if($result3 -> num_rows === 0){
            $rec_requests = '<li class="collection-item"><div><span class="colortextdark"><strong>You</strong> have not requested to recieve any donations<a class="waves-effect waves-light right secondary-content modal-trigger colortextrec" data-target = "recieve_modal">Request donations &nbsp<i class="fa fa-caret-right"></i></a></div></li>';
    };
	
//Side Bar Notifications & Counts
	$nav_user_id = $_SESSION['user_id'];
	$navmatches ='';
	$navdonmatches = '';
	$navrecmatches = '';
	$pnotematches = '';
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
	
	if($matchesstore->num_rows == 1){
		$navmatches = '<span class="new badge colorbrand pulse">'.$matchcount.'</span>';
		$pnotematches = '<p class="flow-text" style="margin-top:10px; margin-bottom:-10px;"  id="mmutliple">You have <span class="colortextrec" style="font-weight:600;">'. $matchcount .'</span> Pending Match <i class="fas fa-sync-alt fa-spin grey-text"></i></p>';
	}else if($matchesstore->num_rows == 0 ){
		$navmatches = '';
		$pnotematches = '';
	}else if($matchesstore->num_rows > 1){
		$navmatches = '<span class="new badge colorbrand pulse">'.$matchcount.'</span>';
		$pnotematches = '<p class="flow-text" style="margin-top:10px; margin-bottom:-10px;" id="mmutliple">You have <span class="colortextrec" style="font-weight:600;">'. $matchcount .'</span> Pending Matches <i class="fas fa-sync-alt fa-spin grey-text"></i></p>';
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
	
	// Get Info Articles
	$sqlinfo = "SELECT * FROM articles WHERE category = 'info' ORDER BY article_id ASC LIMIT 3";
	$inforesult = $db->query($sqlinfo);
    $artinfo = '';
	$icard = 1;
	$dispcard ='';
        while($infrow = $inforesult->fetch_array())
        {
			if($icard == 3){
				$dispcard = 'hide-on-med-only';
			}else{
				$dispcard = '';
			}
            $artinfo .= '<div class="col s12 m4 l3 '.$dispcard.'">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="'.$infrow["image"].'">
                    <span class="card-title"><strong>'.$infrow["title"].'</strong></span>
                    
                </div>

                <div class="card-content">
					<p style="font-size:12px;" class="grey-text">'.$infrow["date_added"].'</p>
                    <p>'.$infrow["content"].'</p>
                </div>
                <div class="card-action">
                    <a href="'.$infrow["link"].'" target="_blank" class="btn colorrec waves-effect waves-light">Read More</a>
                </div>
            </div>
        </div>'; 
			$icard++;
        } 
	// End of info Articles
	
	// Get News Articles
	$sqlnews = "SELECT * FROM articles WHERE category = 'news' ORDER BY article_id DESC LIMIT 3";
	$newsresult = $db->query($sqlnews);
    $artnews = '';
	$ncard = 1;
	$dispcard2 ='';
        while($newsrow = $newsresult->fetch_array())
        {
			if($ncard == 3){
				$dispcard2 = 'hide-on-med-only';
			}else{
				$dispcard2 = '';
			}
            $artnews .= '<div class="col s12 m4 l3 '.$dispcard2.'">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="'.$newsrow["image"].'">
                    <span class="card-title"><strong>'.$newsrow["title"].'</strong></span>
                    
                </div>

                <div class="card-content">
					<p style="font-size:12px;" class="grey-text">'.$newsrow["date_added"].'</p>
                    <p>'.$newsrow["content"].'</p>
                </div>
                <div class="card-action">
                    <a href="'.$newsrow["link"].'" target="_blank" class="btn colordon waves-effect waves-light">Read More</a>
                </div>
            </div>
        </div>'; 
			$ncard++;
        } 
	// End of News Articles
        
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
<!--    <link type="text/css" rel="stylesheet" href="../_assets/css/main.css" />-->
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_assets/css/materialize.min.css" media="screen,projection" />
    <link sizes="192x192" rel="icon" href="https://i.imgur.com/gXBVYAM.png" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" contents="#26a69a">
    
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
    
    <title>KoboWise - Dashboard</title>
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
        <li class="active">
            <a href="index.php">
                <div><i class="grey-text text-darken-3 fas fa-tachometer-alt fa-fw fa-lg" data-fa-transform="grow-4 up-1"></i>&nbsp; &nbsp;<b>Dashboard</b></div>
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
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header">
                        <div><i class="colortextbrand fas fa-user-friends fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; Matches<?php echo $navmatches; ?></div>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="donations.php">
                                    <div><i class="colortextdon text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform=""></i> &nbsp; &nbsp; To Give<?php echo $navdonmatches;?></div>
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
    <nav class="imagebrand" style="height:45px; background-size: cover; background-repeat: no-repeat;">
        <div class="nav-wrapper ">
            <div class="col s12 container" >
                <h5><i class="fa fa-tachometer-alt fa-sm" data-fa-transform="right-2 up-1"></i> &nbsp; Dashboard <span class="right hide-on-small-only"><?php echo $email; ?></span></h5>
            </div>

        </div>
    </nav>
    <!-- ===================== END OF BREAD CRUMBS BREADCRUMBS ============== -->
    
    <!-- ================ ACCOUNT BALANCE SECTION HERE ======================== -->
    <section class="section section-stats center grey lighten-4" style=" background:url(https://i.imgur.com/AyOllvE.jpg); background-size: cover; background-repeat: no-repeat; "><div style ="background-color: rgba(0,0,0,0.5);
    top:0;left:0; width: 100%;
    min-height: 500px; margin-top:-15px; margin-bottom:-35px; padding-top:20px;">
      
<!--  NOTIFICATIONA GO HERE    -->
       <div class="row">
          <div class="container center">
            
			  <div class="card-panel" style="padding-top:5px; padding-bottom:5px;"><div class="row"><?php echo $pnotematches; ?></div>
                <div class="row" style="flex:1; <?php echo $donmatchsearch;?>"><p><b><span class="colortextdon text-lighten-1">&nbsp;Donation Request</span></b> from <b><span id="fname7" class="colortextdon text-lighten-1"></span>: Searching for matches for you - Please wait patiently</b> &#40;<i>This may take up to 72 hours</i>&#41;</p>
                            <div class="progress">
      <div class="indeterminate"></div>
  </div></div>
      <div class="row" style="flex:1; <?php echo $recmatchsearch;?> "><p><b><span class="colortextrec">&nbsp;Eligibility Request</span></b> from <b><span id="fname8" class="colortextdon text-lighten-1"></span>: Searching for matches for You - Please wait patiently</b> &#40;<i>This may take up to 72 hours</i>&#41;</p>
                            <div class="progress">
      <div class="indeterminate"></div>
  </div></div>
                 <div class="row" style="display:none; margin-top:0px;margin-bottom:0px;" id="start_here"><a class="btn waves-effect waves-light colorbrand lighten-1 pulse" onclick="$('.tap-target').tapTarget('open'); $('#start_here').hide('fast');" style="flex:1;">START HERE</a></div>
                 
             </div>
          </div>
          
       </div>
<div class="fixed-action-btn"><a id="menu" class="btn btn-floating btn-large colorbrand"><i class="fa fa-bars fa-lg" data-fa-transform="grow-10">     
 </i></a></div>
      
      <!--  END OF NOTIFICATIONS   -->
       
        <div class="row">
            <div class="col s12 m4 l4">
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
            <div class="col s12 m4 l4">
                <div class="card colordark white-text center">
                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fas fa-money-check colortextrec" data-fa-transform=" left-10"></i>ELIGIBILITY</span>


                        <div class="divider">do</div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right"><?php echo $rec_balance;?></h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button href="" data-target="recieve_modal" class="btn colorrec waves-effect waves-light modal-trigger" style="width:100%;">RECIEVE DONATION</button>
                    </div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="card colordon white-text center" style="padding-left:20px; padding-right:20px; padding-top:5px; padding-bottom:-10px">
                    <div class="card-title">
                        <strong><h4 class="right">.00</h4><h4 class="count right"><?php echo $total_don;?></h4><h4 class="right">&#8358;</h4></strong> </div>
                    <div class="card-content">

                        Total Donated


                    </div>
                </div>
                <div class="card colorrec white-text center" style="padding-left:20px; padding-right:20px; padding-top:5px; padding-bottom:-10px; margin-top:-10px;">
                    <div class="card-title"> <strong><h4 class="right">.00</h4><h4 class="count right"><?php echo $total_rec;?></h4><h4 class="right">&#8358;</h4></strong></div>
                    <div class="card-content">
                        Total Recieved


                    </div>
                </div>

            </div>


        </div>
        <div class="row">
            <div class="col s12 m8 l8">
                <ul class="collapsible popout">
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
                    </li>
                    <li>
                        <div class="collapsible-header waves-effect waves-teal">
                            <div><i class="fa fa-money-bill-alt colortextrec" data-fa-transform="grow-4"></i>&nbsp; &#8358;<?php echo $rec_amount_remaining;?> to Recieve &nbsp; <i class="fa fa-caret-right"></i></div>
                            <?php echo $navrecmatches;?></div>
                        
                            <div class="white collapsible-body">
                           <?php echo $rtm;?>
                           <span style="<?php echo $recmatchsearch;?>"><p><b>Searching for Matches for you.</b> &#40;<i>This may take up to, but no more than, 72 hours</i>&#41;</p>
                            <div class="progress">
      <div class="indeterminate"></div>
  </div></span>
								</div>
                        
                    </li>
                </ul>
            </div>
            <div class="col s12 m4 l4">
                <?php echo $stike_note;?>
            </div>

        </div>
		</div>
    </section>
	<!--  ============== END OF ACCOUNT BALANCE SECTION ======================= -->

	<section class="section bckgrndcolor"><div class="row"><div class="col s12 m9 l8">
    <ul class="collection with-header z-depth-1">
        <li class="collection-header"><h4>Donation Requests</h4></li>
        <?php echo $don_requests; ?>
      </ul>
</div><div class="col s12 m3 l4 hide-on-small-only"><div class="video-container z-depth-1"><img src="../_assets/img/bckgrnds/space5.jpg" class="responsive-img materialboxed" style ="width:100%; height:100%;" alt=""></div></div>
</div></section>
	<section class="section colordark">
      <div class="row">
            <div class="container">
                <h5 class="left colortitletext"><a><i class="fa fa-money-bill-alt fa-sm colortextdon text-lighten-1" data-fa-transform=" left-5"></i></a>To Donate:</h5>
                <h5 class="right hide-on-med-and-down colortitletext">.00</h5>
                <h5 class="count right colortitletext"><?php echo $tabdon_amount_remaining;?></h5>
                <h5 class="right colortitletext">&#8358;</h5>
            </div>

            <div class="col s12 m12 l12">

<!-- ==================== PENDING DONATIONS TABLE HERE ============== -->
                <table class=" responsive-table centered blue-grey darken-4 white-text">
                    <thead class="colordon z-depth-2 white-text">
                        <tr>
                            <th>
                                <div>Name</div>
                            </th>
                            <th>Phone Number</th>
                            <th>Amount to Donate</th>
                            <th>Bank</th>
                            <th>Account Number</th>
                            <th>Due Date</th>
                            <th>Confirmation</th>

                        </tr>
                    </thead>

                    <tbody id="">
                    <?php 
						$query = "SELECT * FROM match_table AS m INNER JOIN user_table AS r ON r.user_id = m.reciever_user_id INNER JOIN states AS sr ON r.state_id = sr.state_id INNER JOIN banks AS br ON br.bank_id = r.bank_id WHERE m.donor_user_id = '{$user_id}' AND is_confirmed = 0 ORDER BY m.is_paid ASC";
        $result = $db->query($query);
        $output2 = '';
        $pstatus = '';
        $mtime ='';
		$duetime='';
		
        while($row = $result->fetch_array())
        {   
            if($row['is_paid'] == 0){
                $pstatus = '<a class = "pay btn deep-orange lighten-1 waves-effect waves-light modal-trigger" id="'.$row["match_id"].'" data-target="pay_modal">I have paid</span>';
                
            }else if($row['is_paid'] == 1){
                            
                $pstatus = '<span class="deep-orange-text text-lighten-2">AWAITING CONFIRMATION </span>';
                    }
            $mtime = strtotime($row["date_matched"]);
			$duetime = strtotime("+72 hours", $mtime);
			$dtime = date("Y-m-d H:i:s", substr($duetime, 0, 10));
            $output2 .= '<tr><td>
                                <div class="chip">
                                    <img src="'.$row["profile_pic"].'" alt="'.$row["first_name"].' '.$row["last_name"].'"> '.$row["first_name"].' '.$row["last_name"].'
                                </div>
                            </td>
                            <td>'.$row["phone_number"].'</td>
                            <td>&#8358; '.$row["matched_amount"].'</td>
                            <td><div class="chip">
                                    <img src="data:image/jpeg;base64,'.base64_encode($row["logo"]).'" alt="'.$row["bank"].'"> '.$row["bank"].'
                                </div></td>
                            <td>'.$row["acc_number"].'</td>
                            <td><div class="data-countdown" data-countdown="'.$dtime.'"></div></td>
                            <td>'.$pstatus.'</td></tr>'; 
        } 
        echo $output2;
						?>
                    </tbody>
                </table>
<!-- ============= END OF PENDING DONATIONS TABLE HERE ================== -->
            </div>
            <div class="col s12 m12 l12" style="margin-top:-10px;">
            <div class="card-panel center"><span style="<?php echo $donmatchsearch;?>"><p><b>Searching for Matches for you.</b> &#40;<i>This may take up to, but no more than, 72 hours</i>&#41;</p>
                            <div class="progress">
      <div class="indeterminate"></div>
  </div></span>Donations that have been Paid and Confirmed Do not appear here. You can view Confirmed Donations  on the <a href="donations.php">'To Give'</a> and <a href="eligibility.php">'Records'</a> Pages</div></div>
        </div>
<!-- ============= AWAITING CONFIRMATIONS TABLE HERE ================== -->
</section>   
	<!-- ============= END OF AWAITING CONFIRMATIONS ================== -->
	<section class="section bckgrndcolor"><div class="row"><div class="col s12 m9 l8">
    <ul class="collection with-header z-depth-1">
        <li class="collection-header"><h4>Eligibility Requests</h4></li>
        <?php echo $rec_requests;?>
      </ul>
</div><div class="col s12 m3 l4 hide-on-small-only"><div class="video-container z-depth-1"><img class="materialboxed" src="../_assets/img/gifs/.gif" style="width:100%; height:100%;" alt=""></div></div></div></section>
  	<!-- ============== PENDING CONFIRMATION TABLE HERE ====== -->
    <section class="section colordark">
        <div class="row">
            <div class="container">
                <h5 class="left colortitletext"><a><i class="fa fa-money-bill-alt fa-sm colortextrec" data-fa-transform=" left-5"></i></a>To Recieve:</h5>
                <h5 class="right hide-on-med-and-down colortitletext">.00</h5>
                <h5 class="count right colortitletext"><?php echo $tabrec_amount_remaining;?></h5>
                <h5 class="right colortitletext">&#8358;</h5>
            </div>
            <div class="col s12 m12 l12">
                <table class="responsive-table centered blue-grey darken-4 white-text">
                    <thead class="colorrec z-depth-2 white-text">
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
            </div>
            <div class="col s12 m12 l12" style="margin-top:-10px;"><div class="card-panel center"><span style="<?php echo $recmatchsearch;?>"><p><b>Searching for Matches for you.</b> &#40;<i>This may take up to, but no more than, 72 hours</i>&#41;</p>
                            <div class="progress">
      <div class="indeterminate"></div>
  </div></span>Only Pending Payments and Confirmations appear here. You can view Confirmed Payments  on the <a href="donations.php">'To Recieve'</a> and <a href="eligibility.php">'Records'</a> Pages</div></div>
        </div>
      
    </section>
 	<!-- ============== END OF PENDING CONFIRMATION TABLE HERE ============== -->
 	<div class="divider"></div>
 
 	<!-- ================= VIDEOS SECTION ================= -->
	<section class="section bckgrndcolor"><div class="row card-panel"><div class="container"><div class="col s12 m12 l12">
	  <h5 class="colorsectiontext"><a><i class="fa fa-play-circle red-text text-lighten-2" data-fa-transform=" left-5"></i></a>Videos &nbsp; <a><span class="grey-text" id="hide_vide" style="font-size: 15px; display:none;">Hide <i class="fa fa-caret-right"></i></span><span class="grey-text" id="show_vide" style="font-size: 15px;">Show <i class="fa fa-caret-right"></i></span></a></h5></div>
</div></div></section>
	<div class="row section bckgrndcolor" style="margin-top:-20px; width: 100%;">
		<div id="vide_art" style="margin-top:-20px; display:none;">
			<div class="col s12 m3 l4"><p class="flow-text">Getting Started</p><div class="video-container z-depth-1"><iframe width="853" height="480" src="//www.youtube.com/embed/Q8TXgCzxEnw?rel=0" frameborder="0" allowfullscreen></iframe></div></div>
			<div class="col s12 m3 l4"><p class="flow-text">Step Two</p><div class="video-container z-depth-1"><video class="responsive-video" controls>
    <source src="../_assets/video.mp4" type="video/mp4">
  </video></div></div>
			<div class="col s12 m3 l4"><p class="flow-text">Some More</p> <div class="video-container z-depth-1"><iframe width="876" height="493" src="https://www.youtube.com/embed/EYzXHGA90Zc?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div></div>
			
			<div class="col s12 m3 l4"><p class="flow-text">How to do X</p><div class="video-container z-depth-1"><iframe width="853" height="480" src="//www.youtube.com/embed/Q8TXgCzxEnw?rel=0" frameborder="0" allowfullscreen></iframe></div></div>
			<div class="col s12 m3 l4"><p class="flow-text">Some Deeper Info</p><div class="video-container z-depth-1"><video class="responsive-video" controls>
    <source src="../_assets/video.mp4" type="video/mp4">
  </video></div></div>
			<div class="col s12 m3 l4"><p class="flow-text">Watch More</p> <div class="video-container z-depth-1"><img src="https://i.imgur.com/jaDP7VB.jpg" alt="" style="width:100%;"></div></div>
			
			
		</div>
		
	</div>

 
  	<!-- ================= INFOR/ARTICULES SECTION ================= -->
  	<section class="section bckgrndcolor" style="margin-top:-30px;"><div class="row card-panel"><div class="container"><div class="col s12 m12 l12">
	  <h5 class="colorsectiontext"><a><i class="fa fa-info-circle colortextrec" data-fa-transform=" left-5"></i></a>Information &nbsp; <a><span class="grey-text" id="hide_info" style="font-size: 15px; display:none;">Hide <i class="fa fa-caret-right"></i></span><span class="grey-text" id="show_info" style="font-size: 15px;">Show <i class="fa fa-caret-right"></i></span></a></h5></div>
</div></div></section>
   
    <div class="row section bckgrndcolor" style="margin-top:-20px;">

        
          <div id="info_art" style="display:none;">
           <?php echo $artinfo; ?>
        <div class="col s12 m4 l3">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="https://i.imgur.com/tBj91md.jpg">
                    <span class="card-title white colortextbrand"><strong>Getting Started</strong></span>
                    <a class="btn-floating halfway-fab waves-effect waves-indigo white"><i class="fa fa-info fa-2x colortextrec" data-fa-transform="shrink-3 down-2 right-8"></i></a>
                </div>

                <div class="card-content colorrec white-text">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action colorrec">
                    <a class="btn white colortextrec waves-effect waves-indigo">Read More &nbsp;<i class="fa fa-caret-right"></i></a>
                </div>
            </div>
			  </div></div>

    </div>
    
    <!-- ================= NEWS & UPDATES SECTION ================= -->
    <section class="section bckgrndcolor" style="margin-top:-30px;"><div class="row card-panel"><div class="container"><div class="col s12 m12 l12">
	  <h5 class="colorsectiontext"><a><i class="fa colortextdon text-lighten-1 fa-newspaper" data-fa-transform=" left-5"></i></a>News &nbsp; <a><span class="grey-text" id="hide_news" style="font-size: 15px; display:none;">Hide <i class="fa fa-caret-right"></i></span><span class="grey-text" id="show_news" style="font-size: 15px;">Show <i class="fa fa-caret-right"></i></span></a></h5></div>
</div></div></section>
    
    <div class="row section bckgrndcolor" style="margin-top:-20px; ">
       <div id="news_art" style="display:none;"> 
       
        <?php echo $artnews;?>
        <div class="col s12 m4 l3">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="https://i.imgur.com/jaDP7VB.jpg">
                    <span class="card-title white colortextdon text-lighten-1"><strong>Getting Started</strong></span>
                    <a class="btn-floating halfway-fab waves-effect waves-deep-orange white"><i class="fa fa-info fa-2x colortextdon text-lighten-1" data-fa-transform="shrink-3 down-2 right-8"></i></a>
                </div>

                <div class="card-content colordon white-text">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action colordon">
                    <a class="btn white colortextdon text-lighten-1 waves-effect waves-deep-orange">Read More &nbsp;<i class="fa fa-caret-right"></i></a>
                </div>
            </div>
        </div>

		   </div></div>
    <!-- ================= END OF INFO/ARTICLES SECTION ================= -->
    
    <!-- ================== TESTIMONIALS ======================== -->
<!--
    <div id="squareWidget"></div> <script src="//www.vocalreferences.com/js/squarewidget.min.js" type="text/javascript" id="squareWidgetJs"></script> 
    <script type="text/javascript"> VrSquare.init({ hashurl: 'myyux*8F44%7C%7C%7C3%7Bthfqwjkjwjshjx3htr4ox4xvzfwj%7Cniljy3rns3ox5', identify: '732869721b37519fe48ca4d49ec96376', container: '#squareWidget' }); </script>
-->
    <!-- ================== END OF TESTIMONIALS ======================== -->
        
    <!-- ================= SYSTEM WATCH SECTION ================= -->
	<section class="section bckgrndcolor" style="margin-top:-30px;"><div class="row card-panel"><div class="container"><div class="col s12 m12 l12">
	  <h5 class="colorsectiontext"><a><i class="fa fa-desktop colortextbrand" data-fa-transform="left-5"></i></a>Community &nbsp; <a><span class="grey-text" id="hide_syst" style="font-size: 15px; display:none;">Hide <i class="fa fa-caret-right"></i></span><span class="grey-text" id="show_syst" style="font-size: 15px;">Show <i class="fa fa-caret-right"></i></span></a></h5></div>
</div></div></section>    

    <div class="section" style="margin-top:-20px;">
         <div class="row" id="syst_art" style="display:none;">
            <div class="col s12 m12 l6 bckgrndcolor" style="padding-bottom:20px;">
                <h5 class="flow-text center"><i class="fa fa-user-friends fa-sm"></i>&nbsp; Your Recent Transactions</h5>
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
                <a href="records.php" class="btn waves-effect waves-light colorbrand" style="width:100%;"><i class="fa fa-money-check"></i>&nbsp; View Transactions</a>
            </div>
            <div class="col s12 m12 l6 bckgrndcolor" style="height:610px;"><h5 class="flow-text center"><i class="fa fa-user-friends fa-sm"></i>&nbsp; KoboWise Chat</h5><div class="video-container" style="height:380px;"><iframe src="chat.html" frameborder="0" height ="800" width="450" id="chatframe"></iframe></div>
    
        <div class="input-field col s12" style="padding-bottom:20px;">
          
          <textarea id="chat_message" class="materialize-textarea"></textarea>
          <label for="chat_message"><i class="fa fa-edit"></i>&nbsp;Chat Message</label>
          <button class="btn waves-effect waves-light colorbrand" id="chat_submit" style="width:100%; margin-top:-20px; "><i class="fa fa-paper-plane"></i>&nbsp;Send Message</button>
        </div>
     
   
  </div>
        </div>
    </div>
    <!-- ================= END OF SYSTEM WATCH SECTION ================= -->
     
      
	<div class="details" style="display:none;">
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
    <p id="user_don_matches" value="<?php echo $navdonmatches;  ?>"><?php echo $navdonmatches;  ?></p>
    <p id="user_rec_matches" value="<?php echo $navrecmatches;  ?>"><?php echo $navrecmatches;  ?></p>
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
    ?>
    
</div>
   
	<div id="gotten_details" style="display:none;"></div>    

    <!-- ====================== FLOATING ACTION BUTTON ======================== -->
    <div class="fixed-action-btn click-to-toggle">
        <a id = "quick_menu" class="btn-floating btn-large blue-grey darken-2 waves-effect waves-light">
    <i class="fas fa-bars fa-2x" data-fa-transform="down-4"></i>
  </a>
        <ul>
           <li><a id = "profile" href="profile.php" class="btn-floating blue-grey darken-2 waves-effect waves-light tooltipped" data-tooltip="My Profile" data-position="left"><i class="fas fa-user fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a id ="don_notify" href="donations.php" class="tooltipped btn-floating waves-effect waves-light blue-grey darken-2" data-tooltip="View Donations" data-position="left"><i class="fas fa-money-bill-wave fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a id="rec_notify" href="eligibility.php" class="tooltipped btn-floating waves-effect waves-light blue-grey darken-2" data-tooltip="View Eligibity" data-position="left"><i class="fas fa-money-check fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a id ="support_notify" href="support.php" class="tooltipped btn-floating blue-grey darken-2 waves-effect waves-light" data-tooltip="Help & Support" data-position="left"><i class="fas fa-cog fa-lg" data-fa-transform="grow-4 down-1"></i></a></li>
            <li><a href="logout.php" class="tooltipped btn-floating blue-grey darken-2 waves-effect waves-light" data-tooltip="logout" data-position="left"><i class="fas fa-sign-in-alt fa-lg" data-fa-transform="down-1"></i></a></li>
        </ul>
    </div>
    <!-- ==================== END OF FLOATING ACTION BUTTON =================== -->
   
    <?php 
	
	include "../_assets/includes/footer.php";
	
	?>
     
    <!-- ======================  MODALS ========================== -->
    
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
     
    <div id="recieve_modal" class="modal">
    <div class="modal-content center">
      <h4 class="colortextbrand"><i class="fa fa-hand-holding-usd"></i> &nbsp;Recieve Eligibility</h4>
      <p class="flow-text">Hello <span id="fname1" class="orange-text text-darken-2"></span>. You are eligible to recieve &#8358;<?php echo $rec_balance;?> <br> Please provide <b>VoA</b> link: </p>
      <form action="#" id="recieve_request_form">
      <input type="hidden" id="eligibility" value="<?php echo $eligibility;?>">
      <input type="hidden" id="rec_user_id" value="<?php echo $user_id;?>">
      <div class="input-field">
          <input id="voaurl" type="text" required>
           <label for="voaurl">VoA URL &nbsp;<span class="red-text" id="lvoaurl"></span><span class="grey-text" id="loader_rec" style="display:none;"> Requesting <i class="fas fa-spinner fa-pulse"></i></span><span class="grey-text" id="error_rec" style="display:none;"> Connection Error <i class="fas fa-broadcast-tower"></i></span></label>
        </div>
    <div class="file-field input-field" style="display:none;">
     <div class="btn colorbrand">
        <span>VoA File</span>
        <input type="file" id="lvoafile">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" value="Select File"  id="voafile" type="text">
      </div>
    </div>
    <p class="flow-text" style="margin-top: 0px;"><a data-target="voa_modal" class="grey-text text-lighten-1 modal-trigger">What's this <i class="fa fa-question-circle"></i></a></p>
    
  </form>
        
    </div>
    <div class="modal-footer">
      <a id="rec_cancel" class="btn red modal-close waves-effect waves-light">Cancel</a>
      <a id="rec_agree" class="btn colorbrand waves-effect waves-light">Agree</a>
    </div>
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
    
    <div id="rec_success" class="modal modal-fixed-footer">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h5 class="colortextbrand"><i class="fa fa-check-circle fa-sm"></i>&nbsp; Request Successful</h5>
        <p class="flow-text"><strong>Hi <span id="fname3" class="orange-text text-darken-2"></span>.</strong> Your request has been registered and you will be notified via email within 72 hours once your VoA is approved and you are matched with donors. Please <span class="colortextbrand">keep your <b>Profile details</b> updated</span> and <span class="colortextbrand">be reachable via phone and email</span>.  </p>
    </div>
    <div class="modal-footer">
      <a href="index.php" class=" modal-action modal-close waves-effect waves-light btn colorbrand">Okay</a>
    </div>
  </div>
   
    <div id="strike_modal" class="modal modal-fixed-footer">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h5 class="colortextbrand"><i class="fa fa-plus-circle fa-sm"></i>&nbsp; The Strike System</h5>
        <p class="flow-text">Designed to discourage users from misusing KoboWise. Accounts with fewer strikes are matched <b>quicker to give and recieve donations</b>. Right now <span class="blue-text"><b>You have <?php echo $user_strikes;?> Strikes</b></span>.<br/></p><a class="colortextbrand">Click here to find out more about the strike system.</a>
    </div>
    <div class="modal-footer">
      <a class=" modal-action modal-close waves-effect waves-light btn colorbrand">Okay</a>
    </div>
  </div>
   
    <div id="voa_modal" class="modal modal-fixed-footer">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h5 class="colortextbrand"><i class="fa fa-share-square fa-sm"></i>&nbsp; Voice of Appreciation &#40; VoA &#41;  System</h5>
        <p class="flow-text">A brief public statement acknowledging your use of KoboWise. This could be in the form of a URL to a <b>Facebook, Twitter, instagram, or blog post,</b>. However, there are also several other acceptable forms of VoA.<br/></p><a class="colortextbrand">Click here to find out more about VoAs.</a>
    </div>
    <div class="modal-footer">
      <a class=" modal-action modal-close waves-effect waves-light btn colorbrand">Okay</a>
    </div>
  </div>
  
    <div id="voa_change_modal" class="modal modal-fixed-footer">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h4 class="colortextbrand"><i class="fa fa-edit fa-sm"></i>&nbsp; Change VoA</h4>
        <form action="#" id="voa_change_form">
      
      <input type="hidden" id="voa_id" value="">
      <input type="hidden" id="voa_user_id" value="<?php echo $user_id;?>">
      <div class="input-field">
          <input id="voaurl2" type="text" required>
           <label for="voaurl2">VoA URL &nbsp;<span class="red-text" id="lvoaurl2"></span><span class="grey-text" id="loader_rec_change" style="display:none;"> Requesting <i class="fas fa-spinner fa-pulse"></i></span><span class="grey-text" id="error_rec_change" style="display:none;"> Connection Error <i class="fas fa-broadcast-tower"></i></span></label>
        </div>
    
    <p class="flow-text" style="margin-top: 0px;"><a data-target="voa_modal" class="grey-text text-lighten-1 modal-trigger">What's this <i class="fa fa-question-circle"></i></a></p>
    
  </form>
      
         <p class="flow-text">A brief public statement acknowledging your use of Instagram. This could be in the form of a URL to a <b>Facebook, Twitter, instagram, or blog post,</b>. Right now <span class="blue-text"><b>You have <?php echo $user_strikes;?> Strikes</b></span>.<br/></p><a class="colortextbrand">Click here to find out more about the strike system.</a>
    </div>
    <input type="hidden" value="" id="voa_change_id">
    <div class="modal-footer">
      <a class=" modal-action modal-close waves-effect waves-light btn red" id="voa_change_cancel">Cancel</a>
      <a class="waves-effect waves-light btn colorbrand" id="voa_change_agree">Change</a>
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
    
    <div id="confirm_recieve_modal" class="modal modal-fixed-footer">
    <div class="modal-content" style="padding-bottom: 0px; margin-bottom: 0px;">
        <h5 class="colortextbrand"><i class="fa fa-question-circle fa-sm"></i>&nbsp; Confirm payment <i class="fas fa-spinner fa-pulse grey-text" id="loader_reccon"></i></h5>
		<span class="grey-text" id="loader_reccon2" style="display:none;">Confirming Payment <i class="fas fa-spinner fa-pulse"></i></span><span class="grey-text" id="error_reccon2" style="display:none;"> Connection Error <i class="fas fa-broadcast-tower"></i></span>
		<p class="flow-text">Confirm you've recieved <b>&#8358;<span class="orange-text text-darken-2" id="confrecmatchamount"></span></b> from <b><span id="confrecname" class="orange-text text-darken-2"></span></b>. Gender: <b><span id="confrecgender" class="orange-text text-darken-2"></span></b>. Phone number: <b><span class="orange-text text-darken-2" id="confrecphonenumber"></span></b>. Under any circumstances, For your own safety, please <span class="red-text"><b>DO NOT Confirm donations you have not recieved</b></span>.<br/></p><a class="colortextbrand">View more guidelines on recieving Donations.</a>
   <input type="hidden" id="confmatch_donor_id" value ="">
   <input type="hidden" id="confmatch_reciever_id" value ="">
   <input type="hidden" id="confmatch_id" value ="">
   <input type="hidden" id="confmatch_don_request_id" value ="">
   <input type="hidden" id="confmatch_rec_request_id" value ="">
   <input type="hidden" id="confmatch_amount" value ="">
    </div>
    <div class="modal-footer">
      <a id="notyetrecd" class=" modal-action modal-close waves-effect waves-light btn red">Not yet</a>
      <a id = "confirmrecd" class="disabled modal-action waves-effect waves-light btn colorbrand">Confirm </a>
    </div>
  </div>
 
    <div class="tap-target-wrapper"><div class="tap-target colorbrand" data-activates="menu"><div class="tap-target-content white-text center">
       <h5>Hello <b><span id="fname9" class="yellow-text text-darken-2"></span></b></h5><p class="white-text flow-text">Right now it seems your profile is incomplete, please update your profile to get started.
     </p>
 </div></div></div>
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
<!--    <script type="text/javascript" src="../_assets/js/donate.js"></script> -->
    <script type="text/javascript" src="../_assets/js/jquery.countdown.js"></script>
    <script type="text/javascript" src="../_assets/fonts/svg-with-js/js/fontawesome-all.min.js"></script>
    
    <script>$(document).ready(function(){
	
			
// Copied from Donate.js			
	 $('.modal').modal();   
	timeout = 5000;
    var donation, consent = "";
    var don_reg = /^[0-9]{4,}$/i;
    var name_reg = /^[a-z]{3,}$/i;
    var email_reg = /^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
    var password_reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
    
//    Donation Validation 
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


	
	
//      Donation agree click
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
			
// end of Copy from donate.js			
			
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
	
//      Donation Change cancel click
    $("#don_change_cancel").click(function(){
        $("#don_change").html("");
            $("#donoldamnt").removeClass("valid").removeClass("invalid");
            $("#don_change").removeClass("green-text").removeClass("red-text");
        $("#don_consent2").html("");
            donation="";
        $('#don_change_form')[0].reset();
        $('#don_change_agree').removeClass('disabled');
        $('#loader_don_change').hide();
        $('#error_don_change').hide();
		Materialize.toast('Donation Change Cancelled', 1500);
		
    })
			
	$("#don_change_agree").click(function(){
		var action = "update_donation";
		var user_id = $("#user_id").text();
		var dontoup = $("#don_update_id").val();
		var don_reg=/^[0-9]{4,}$/i;
			
		$("#loader_don_change").show();
		$("#error_don_change").hide();
        var donation1 = $('#donoldamnt').val();
		       
        if (donation1.length == ""){
            Materialize.toast('Please enter a Donation', 2500);
            $("#donoldamnt").addClass("invalid").removeClass("valid");
            $("#don_change").html("Empty").removeClass("green-text").addClass("red-text");
			$("#loader_don_change").hide();
        };
        
        if(donation1 != "" && donation1 < 2000){
            Materialize.toast('Donation too Small', 2500);
            $("#donoldamnt").addClass("invalid").removeClass("valid");
            $("#don_change").html("Minimum = 2000").removeClass("green-text").addClass("red-text");
            $("#loader_don_change").hide();
            };
        if(donation1 > 200000){
            Materialize.toast('Donation too large', 2500);
            $("#donoldamnt").addClass("invalid").removeClass("valid");
            $("#don_change").html("Maximum = 200000").removeClass("green-text").addClass("red-text");
            $("#loader_don_change").hide();
            };
        if ($("#consent2").is(':checked') == false){
            Materialize.toast('Consent is Required', 2500);
            $("#don_consent2").html("Required").removeClass("green-text").addClass("red-text");
			$("#loader_don_change").hide();
        };
        if ($("#consent2").is(':checked') == true){
            $("#don_consent2").html("OK").removeClass("red-text").addClass("green-text");
        };
        if (donation1 != "" && $("#consent2").is(':checked') == true && donation1 > 1999 && donation1 < 200001 && don_reg.test(donation1) == true){
			$("#don_change_agree").addClass("disabled");
            var user_id = $("#user_id").text() ;
            var user_email = $("#user_email").text() ;
            var first_name = $("#first_name").text() ;
            
            $.ajax({
               url : '../ajax/donations.php',
               method : 'POST',
                dataType: 'text',
               data : {
				   action:action,
                   new_amount : donation1,
				   don_update_id: dontoup,
				   user_update_id:user_id,
                               
            },
                success : function(response){
					$("#loader_don_change").hide();
                
                    if(response = 'successful'){
                         console.log(response);
                        $("#donoldamnt").addClass("valid").removeClass("invalid");
                        $("#don_change").addClass("green-text").removeClass("red-text").html("Request Successful");
                        $("#fname").html(first_name);
                        donation1="";
                        $('#don_change_form')[0].reset();
                        Materialize.toast('Donation Change Successful',500,'rounded', function(){
                             location.reload();
                         });
                                                           
                    }else if(response = 'failed'){
                         console.log(response);
                       Materialize.toast('Request Unsuccessful',2500);
                        donation = "";
                        $('#don_request_form')[0].reset();
                    }
                    },
				error: function(){
					$("#error_don_change").show();
					$("#loader_don_change").hide();
					$("#don_change_agree").removeClass('disabled');
				},
				timeout: timeout
                }
            );           
            
		 }else if (donation1 != "" && $("#consent").prop(':checked') == false && donation1 > 2000 && don_reg.test(donation1) == true){
            
            $("#donoldamnt").removeClass("invalid").addClass("valid");
			 $("#don_change").html("OK").removeClass("green-text").addClass("red-text");
            $("#don_consent2").html("Required");
            donation="";
                $("#loader_don_change").hide();
                $("#error_don_change").hide();
            }
        })       
           
//      End of Donation agree click

	
//      End of Donation Change cancel click

// VoA Change Ajax
	$(document).on('click','.voa_change', function(){
		var request_update_id = $(this).attr('id');
		$("#voa_id").val(request_update_id);
		console.log(request_update_id);
		$('#voa_change_modal').modal('open');
	});
// End of VoA Change Ajax

//      Voa Change agree click
    $("#voaurl2").focusout(function(){
		$('#loader_rec_change').hide();
		$('#error_rec_change').hide();
		var newurl = $("#voaurl2").val();
		if(url_reg.test(newurl)){
			 $('#voaurl2').addClass('valid');
                $('#voaurl2').removeClass('invalid');
                $('#lvoaurl2').addClass('green-text');
                $('#lvoaurl2').removeClass('red-text');
                $('#lvoaurl2').html('Ok');
		}else{
			 $('#voaurl2').addClass('invalid');
                $('#voaurl2').removeClass('valid');
                $('#lvoaurl2').addClass('red-text');
                $('#lvoaurl2').removeClass('green-text');
                $('#lvoaurl2').html('Invalid Url');
		}
	})
    $("#voaurl2").focusin(function(){
		$('#voaurl2').removeClass('valid').removeClass('invalid');
                $('#lvoaurl2').html('');
		$('#loader_rec_change').hide();
		$('#error_rec_change').hide();
	})
			
		$("#voa_change_agree").click(function(){
		$('#loader_rec_change').show();
		$('#error_rec_change').hide();
		var voaurl2 = $('#voaurl2').val();
		var voa_id = $('#voa_id').val();
        var user_id = $("#rec_user_id").val();
        
        console.log(voaurl2+' '+voa_id+' '+user_id);
//        var consent = $('#consent').val();
        
        
            if(url_reg.test(voaurl2)){
				$("#voa_change_agree").addClass('disabled');
                var action="updateurl";
                $.ajax({
                    url:'../ajax/voas.php',
                    method:'POST',
                    dataType:'text',
                    data:{action: action, 
                          user_id:user_id, 
                          voa_url:voaurl2,
                          voa_id: voa_id},
                    success : function(response){
						$("#voa_change_agree").removeClass('disabled');
						$("#loader_rec_change").hide();
                        console.log(response);
                        if(response == "successful"){
                             $('#voa_change_form')[0].reset();
                Materialize.toast("Request Successful", 1500, 'rounded',function(){
                    location.reload();
                });
                $('#voaurl2').addClass('valid');
                $('#voaurl2').removeClass('invalid');
                $('#lvoaurl2').addClass('green-text');
                $('#lvoaurl2').removeClass('red-text');
                $('#lvoaurl2').html('Ok');
                           
                            
                        }else if(response =="failed"){
                            
                            Materialize.toast("Request Failed", 2500);
                $("#voaurl2").addClass("invalid");
                $("#voaurl2").removeClass("valid");
                $("#lvoaurl2").html("Invalid URL");
                $("#lvoaurl2").removeClass("green-text");
                $("#lvoaurl2").addClass("red-text");
                         $('#recieve_request_form')[0].reset();    
                            
                        }else{
                            Materialize.toast("Unknown Error", 2500);
                        }
                    }, 
					error: function(){
						$("#loader_rec_change").hide();
						$("#error_rec_change").show();
						$("#voa_change_agree").removeClass('disabled');
					},
					timeout: timeout
                })
                
            }else {
				$("#loader_rec").hide();
                Materialize.toast("Invalid URL", 2500);
                $("#voaurl2").addClass("invalid");
                $("#voaurl2").removeClass("valid");
                $("#lvoaurl2").html("Invalid URL");
                $("#lvoaurl2").removeClass("green-text");
                $("#lvoaurl2").addClass("red-text");
            }
        });
		
	
			
    $("#voa_change_cancel").click(function(){
        $("#loader_rec_change").hide();
		$("#error_rec_change").hide();
        $("#lvoaurl2").html("");
            $("#voaurl2").removeClass("valid").removeClass("invalid");
            $("#lvoaurl2").removeClass("green-text").removeClass("red-text");
        $("#voafile").html("");
            donation="";
        $('#voa_change_form')[0].reset();
        Materialize.toast('VoA Change Cancelled', 1500);
    })
//      End of Donation Change cancel click

	
	$('#hide_info').click(()=>{
         $('#hide_info').toggle(500);
         $('#info_art').toggle(500);
        $('#show_info').toggle(500);
    });
	$('#show_info').click(()=>{
         $('#show_info').hide(500).fadeOut(400);
         $('#info_art').show(500).fadeIn(400);
        $('#hide_info').show(500).fadeIn(600);
    });
			
	$('#hide_news').click(()=>{
         $('#hide_news').hide(500).fadeOut(400);
         $('#news_art').hide(500).fadeOut(400);
        $('#show_news').show(500).fadeIn(600);
    });
	$('#show_news').click(()=>{
         $('#show_news').hide(500).fadeOut(400);
         $('#news_art').show(500).fadeIn(400);
        $('#hide_news').show(500).fadeIn(600);
    });
	
		$('#hide_vide').click(()=>{
         $('#hide_vide').hide(500).fadeOut(400);
         $('#vide_art').hide(500).fadeOut(400);
        $('#show_vide').show(500).fadeIn(600);
    });
	$('#show_vide').click(()=>{
         $('#show_vide').hide(500).fadeOut(400);
         $('#vide_art').show(500).fadeIn(400);
        $('#hide_vide').show(500).fadeIn(600);
    });
		$('#hide_syst').click(()=>{
         $('#hide_syst').hide(500).fadeOut(400);
         $('#syst_art').hide(500).fadeOut(400);
        $('#show_syst').show(500).fadeIn(600);
    });
	$('#show_syst').click(()=>{
         $('#show_syst').hide(500).fadeOut(400);
         $('#syst_art').show(500).fadeIn(400);
        $('#hide_syst').show(500).fadeIn(600);
    });
    
			
	$('.data-countdown').each(function() {
  var $this = $(this), finalDate = $(this).attr('data-countdown');
  $this.countdown(finalDate, function(event) {
    $this.html(event.strftime('%D days %H:%M:%S'));
  });
});
	
	var dfltpassword = 'Password1234';
			
  function get_transactions(){
	   var user_id =  $("#user_id").text();
	 var action = "get_transactions";
	  $.ajax({
		  url:'../ajax/matches.php',
		  method:'POST',
		  dataType:'text',
		  data:{action:action,
			   user_id:user_id},
		  success:function(response){
			  $("#transactions").html(response);
		  },
		  error: function(){
			  $("#transactions").html('<tr><td>Connection</td><td>Error <i class="fas fa-broadcast-tower"></i></td></tr>')
		  }, 
		  
	  })
	  
  };
			get_transactions();
// Get the input field
var chat_message = $("#chat_message");

// Execute a function when the user releases a key on the keyboard
chat_message.on("keyup", function(event){
  // Cancel the default action, if needed
  event.preventDefault();
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Trigger the button element with a click
    $("#chat_submit").click();
  }});
			
			
			
$("#chat_submit").click(function(){
	 var message = $('#chat_message').val();
	 var user_id =  $("#user_id").text();
	 var action = "chat";
	
	if(message.length == ''){
		Materialize.toast('Empty Message',1500);
		$('#chat_message').val('');
	}else if(message.length != '' && message.length > 255){
		Materialize.toast('Message Too long',1500);
		$('#chat_message').val('');
	}
	else if(message.length != '' && message.length < 255){
		
		$.ajax({
			url:'achat.php',
			method:'POST',
			dataType:'text',
			data: {action:action,
				   message:message,
				   user_id:user_id
				
			},
			success: function(data){
				console.log(data);
				$('#chat_message').val('');
				Materialize.toast("Message sent",1500);
				
			},
		});
	};
  });
            
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
			
    function get_donors(){
        var user_id = $("#user_id").text();
        var action = "get_donors";
        
        $.ajax({
            url : '../ajax/matches.php', 
            method :'POST', 
            dataType : 'text',
            data : {user_id:user_id, 
                    action:action,
                    },
            success : function (response){
                $("#to_donate").html(response);
                 }
            
            
        })
    }; 
    get_donors();        
            
    function get_recievers(){
        var user_id = $("#user_id").text();
        var action = "get_recievers";
        
        $.ajax({
            url : '../ajax/matches.php', 
            method :'POST', 
            dataType : 'text',
            data : {user_id:user_id, 
                    action:action,
                    },
            success : function (response){
                $("#to_recieve").html(response);
                
            }
            
            
        })
    }; 
    get_recievers();        
            
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
    
// Voa validation;
        var url_reg = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\w]*))?)/; 
            
        $('#voaurl').focusin(function(){
			$("#loader_rec").hide();
		$("#error_rec").hide();
			$('#voaurl').removeClass('invalid').removeClass('valid');
                $('#lvoaurl').html('');
		})
        $('#voaurl').focusout(function(){
			$("#loader_rec").hide();
		$("#error_rec").hide();
            var voaurl = $('#voaurl').val();
            if(voaurl==''){
             $('#voaurl').addClass('invalid').removeClass('valid');
                $('#lvoaurl').addClass('red-text').removeClass('green-text').html('Empty');
            };
            
            if(voaurl != ''){if(url_reg.test(voaurl)){
                $('#voaurl').addClass('valid').removeClass('invalid');
                $('#lvoaurl').addClass('green-text').removeClass('red-text').html('Ok');
            } else {
                $('#voaurl').addClass('invalid').removeClass('valid');
                $('#lvoaurl').addClass('red-text').removeClass('green-text').html('Invalid URL');
                }}
        });
            
    //Recieve cancel click
    $("#rec_cancel").click(function(){
		$("#loader_rec").hide();
		$("#error_rec").hide();
        $("#lvoaurl").html("");
            $("#voaurl").removeClass("valid").removeClass("invalid");
            $("#lvoaurl").removeClass("green-text").removeClass("red-text");
        $("#voafile").html("");
            donation="";
        $('#recieve_request_form')[0].reset();
        Materialize.toast('Request Cancelled', 1500);
        
    })
//End of Recieve cancel click

 $('.make_donation1').click(function(){
	 var profile_status = $("#all_profile_status").val();
	 console.log(profile_status);
	 if(profile_status =="NOTOK"){
		 $("#profile_modal").modal('open');
	 }else if(profile_status=="FINE"){
		  $("#donate_modal").modal('open');
	 }
 })			
			
    //VoA agree click
    $("#rec_agree").click(function(){
		$("#loader_rec").show();
		$("#error_rec").hide();
        var voafile = $('#voafile').val();
        var voaurl = $('#voaurl').val();
        var eligibility = $('#eligibility').val();
        var user_id = $("#rec_user_id").val();
        
        console.log(voafile+' '+voaurl+' '+eligibility+' '+user_id);
//        var consent = $('#consent').val();
        
        if (eligibility == 0){
            Materialize.toast("Eligibility is too low (0)", 2500);
            $("#voaurl").addClass("invalid");
            $("#voaurl").removeClass("valid");
            $("#lvoaurl").html("No Eligibility");
            $("#lvoaurl").removeClass("green-text");
            $("#lvoaurl").addClass("red-text");
			$("#loader_rec").hide();
        };
             
        if (eligibility != 0 && voafile == 'Select File' && voaurl == ''){
            Materialize.toast('VoA Link or URL Requred', 2500);
            $('#voaurl').addClass('invalid');
                $('#voaurl').removeClass('valid');
              $('#voafile').addClass('invalid');
                $('#voafile').removeClass('valid');
                $('#lvoaurl').addClass('red-text');
                $('#lvoaurl').removeClass('green-text'); 
                $('#voafile').addClass('red-text');
                $('#voafile').removeClass('green-text');
                $('#lvoaurl').html('Empty');
			$("#loader_rec").hide();
        };
        if (eligibility != 0 && voaurl != '' && voafile == 'Select File'){
            if(url_reg.test(voaurl)){
				$("#rec_agree").addClass('disabled');
                var action="inserturl";
                $.ajax({
                    url:'../ajax/voas.php',
                    method:'POST',
                    dataType:'text',
                    data:{eligibility:eligibility, 
                          user_id:user_id, 
                          voa_url:voaurl,
                          action:action},
                    success : function(response){
						$("#loader_rec").hide();
                        console.log(response);
                        if(response == "successful"){
                             $('#recieve_request_form')[0].reset();
                Materialize.toast("Request Successful", 2500, 'rounded',function(){
                    $("#rec_success").modal('open');
                });
                $('#voaurl').addClass('valid');
                $('#voaurl').removeClass('invalid');
                $('#lvoaurl').addClass('green-text');
                $('#lvoaurl').removeClass('red-text');
                $('#lvoaurl').html('Ok');
                           
                            
                        }else if(response =="failed"){
                            
                            Materialize.toast("Request Failed", 2500);
                $("#voaurl").addClass("invalid");
                $("#voaurl").removeClass("valid");
                $("#lvoaurl").html("Invalid URL");
                $("#lvoaurl").removeClass("green-text");
                $("#lvoaurl").addClass("red-text");
                         $('#recieve_request_form')[0].reset();    
                            
                        }else{
                            Materialize.toast("Unknown Error", 2500);
                        }
                    }, 
					error: function(){
						$("#loader_rec").hide();
						$("#error_rec").show();
						$("#rec_agree").removeClass('disabled');
					},
					timeout: timeout
                })
                
            }else {
				$("#loader_rec").hide();
                Materialize.toast("Invalid URL", 2500);
                $("#voaurl").addClass("invalid");
                $("#voaurl").removeClass("valid");
                $("#lvoaurl").html("Invalid URL");
                $("#lvoaurl").removeClass("green-text");
                $("#lvoaurl").addClass("red-text");
            }
        };

        })       
    //End of VoA agree click
             
    // add Bank Form submit
//    $('#add_bank_form').submit(function(event){
//        event.preventDefault();
//        var bank_name = $('#bank_name').val();
//        var image = $('#image').val();
//        if(bank_name == '' || image == '')
//            {
//                Materialize.toast('Incomplete Details', 1500);
//                return false;
//            }
//        else
//            {
//               var extension = $('#image').val().split('.').pop().toLowerCase();
//                if (jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
//                    {
//                         Materialize.toast('Invalid Image Format', 1500);
//                        $('#image').val('');
//                return false;
//                    }
//                else
//                    {
//                        $.ajax({
//                            url:'../ajax/users.php',
//                            method:'POST',
//                            data: new FormData(this),
//                            contentType:false,
//                            processData:false, 
//                            success:function(data)
//                            {
//                                Materialize.toast(data, 1500);
//                                $('#add_bank_form')[0].reset();
//                                fetch_users();
//                                
//                            }
//                            
//                        })
//                    }
//            };
//    });
    
	// I have paid button click 
    $(document).on('click','.pay', function(){
		$(".loader_condon").show();
		$(".error_condon").hide();
				var action = 'confirmpay';
				var user_id = $("#user_id").text();
				var match_id = $(this).attr('id');
				
				$.ajax({
					url:'../ajax/matches.php',
					method:'POST',
					dataType:'json',
					data:{ action:action, 
						   user_id: user_id,
						    match_id:match_id},
					success: function(data){
						$("#ihavepaid").removeClass('disabled');
						
						console.log(data);
						
						$("#confmatchamount").html(data.matched_amount);
						$("#confdonname").html(data.firstname+' '+data.lastname);
						$("#confaccnumber").html(data.acc_number);
						$("#confbank").html(data.bank);
						$("#match_id10").val(data.match_id);
						$("#reciever_id10").val(data.user_id);
						$(".loader_condon").hide();
				}, 
					error: function(){
						$(".loader_condon").hide();
						$(".error_condon").show();
						$("#ihavepaid").addClass('disabled');
					},
					timeout: timeout
					
				})
				$("#confirm_pay_modal").modal('open');
			})
			
	// Yes, I have paid button click
    $('#ihavepaid').click(function(){
		$("#ihavepaid").addClass('disabled');
		$("#loader_condon2").show();
		$("#error_condon2").hide();
		var action = "is_paid";
		var match_id = $("#match_id10").val();
		var reciever_id = $("#reciever_id10").val();
		
		$.ajax({
			url:'../ajax/matches.php',
			method:'POST',
			dataType:'text',
			data:{action:action, 
				 match_id:match_id, 
				 reciever_id:reciever_id},
			success:function(response){
				console.log(response);
				if(response == 'success'){
					Materialize.toast('Payment Confirmed',1300,'rounded', function(){
						location.reload();
					})
				}else if(response == 'failed'){
					Materialize.toast('Could not update',2500);
				}else{
					Materialize.toast('Something went wrong',2500);
				}
			},
			error: function(){
				$("#loader_condon2").hide();
				$("#error_condon2").show();
				$("#ihavepaid").removeClass('disabled');
			},
			timeout: timeout
			
		})
		
		
	})
			
	$('#notyetpaid').click(function(){
	Materialize.toast('Payment Cancelled',2500);	
		$("#ihavepaid").addClass('disabled');
		
	});
			
	
			
     // Confirm button click 
	$(document).on('click','.confirm', function(){
		$("#loader_reccon").show();
		$("#error_reccon").hide();
				var action = 'confirmrec';
				var user_id = $("#user_id").text();
				var match_id = $(this).attr('id');
				
				$.ajax({
					url:'../ajax/matches.php',
					method:'POST',
					dataType:'json',
					data:{ action:action, 
						   user_id: user_id,
						    match_id:match_id},
					success: function(data){
						$("#loader_reccon").hide();
						$("#confirmrecd").removeClass('disabled');
						console.log(data);
												
						$("#confrecmatchamount").html(data.matched_amount);
						$("#confmatch_amount").val(data.matched_amount);
						$("#confrecname").html(data.firstname+' '+data.lastname);
						$("#confrecphonenumber").html(data.phone_number);
						$("#confrecgender").html(data.gender);
						$("#confmatch_donor_id").val(data.match_donor_id);
						$("#confmatch_reciever_id").val(data.match_reciever_id);
						$("#confmatch_id").val(data.match_id);
						$("#confmatch_don_request_id").val(data.match_donor_request_id);
						$("#confmatch_rec_request_id").val(data.match_recieve_request_id);

				},
					error: function(){
						$("#loader_reccon").hide();
						$("#error_reccon").show();
					},
					timeout: timeout
					
				})
				$("#confirm_recieve_modal").modal('open');
			});
//not yet recieved button click 	
	$('#notyetrecd').click(function(){
	Materialize.toast('Confirmation Cancelled',2500);	
		$("#confirmrecd").addClass('disabled');
	});
			
	$('#confirmrecd').click(function(){
		$("#loader_reccon2").show();
		$("#error_reccon2").hide();
		$("#confirmrecd").addClass('disabled');
			var don_id = $("#confmatch_donor_id").val();
			var rec_id = $("#confmatch_reciever_id").val();
			var match_id = $("#confmatch_id").val();
			var don_req_id = $("#confmatch_don_request_id").val();
			var rec_req_id = $("#confmatch_rec_request_id").val();
			var match_amount = $("#confmatch_amount").val();
			var action = 'finalconf';

		$.ajax({
			url:'../ajax/matches.php',
			method:'POST',
			dataType:'text',
			data:{don_id:don_id, 
				 rec_id:rec_id,
				 match_id: match_id,
				 don_req_id: don_req_id,
				 rec_req_id: rec_req_id,
				 match_amount:match_amount,
				 action:action},
			success: function(response){
				$("#loader_reccon2").hide();
				console.log(response);
				if(response == 'success'){
					Materialize.toast('Confirmation Successful',1200,'rounded',function(){
						location.reload();
					});
				}else if(response == 'failed'){
					Materialize.toast('Database Error', 2500);
				}else{
					Materialize.toast('Something Else Wrong', 2500);
				}
			},
			error: function(){
				$("#loader_reccon2").hide();
		$("#error_reccon2").show();
		$("#confirmrecd").removeClass('disabled');
			},
			timeout: timeout
		})
		
	});
				           
            
  });</script>
    
</body>
</html>
