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
            $user_location = $row["user_location"];
            $bank = $row["bank"];
            $acc_number = $row["acc_number"];
            $don_balance = $row["don_balance"];
            $total_don = $row["total_don"];
            $total_rec = $row["total_rec"];
            $rec_balance = $row["rec_balance"];
            $profile_pic = $row["profile_pic"];
            $user_strikes = $row["user_strikes"];
            $signup_date = $row["signup_date"];
            $loggedin = $_SESSION["loggedin"];
            }
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

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Donations</title>
</head>
<body>

    <!-- ====================== FIXED HEADER NAVIGATION ====================== -->
    <div class="navbar-fixed">
        <nav class="white darken-4">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="index.php" class="center brand-logo"><img src="../_assets/img/instagram.png" alt="" style="height: 45px; margin-top:10px;"></a>
                    <a data-activates="side-nav" data-position="right" class="btn z-depth-0 white button-collapse show-on-large">
                <i class="left fas fa-bars black-text" data-fa-transform="grow-18 down-25"></i>
                </a>
                    <ul class="hide-on-small-only right">

                        <li><a href="" data-tooltip="Notifications" data-position="right" class="tooltipped"><span class="new badge blue lighten-1">4+</span>&nbsp;<i class="fa fa-envelope-open fa-lg blue-text text-lighten-1" data-fa-transform="right-2"></i></a></li>
                        <li><a href="logout.php" data-tooltip="Logout" data-position="right" class="tooltipped"><i class="fa fa-sign-in-alt fa-lg blue-grey-text" data-fa-transform="grow-5 right-2"></i></a></li>
                        <li><a href="profile.php" data-tooltip="My Profile" data-position="right" class="tooltipped"><img src="<?php echo $profile_pic; ?>" style="width:50px; margin-top:7px;" class="circle" alt=""></a></li>


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
                <div class="background">
                    <img src="../_assets/img/bckgrnds/material1.png" style="width:600px;" alt="">
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
                <div><i class="blue-grey-text fas fa-tachometer-alt fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; Dashboard</div>
            </a>
        </li>
        <li>
            <a href="profile.php">
                <div><i class="orange-text lighten-1 fas fa-user-edit fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; My Profile<span class="new badge orange lighten-1 pulse">Incomplete</span></div>
            </a>
        </li>

        <div class="divider"></div>
        <li>
            <a class="subheader">
                <div>Pending Donations</div>
            </a>
        </li>
        <li class="active no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header">
                        <div><i class="red-text text-lighten-1 fas fa-user-friends fa-fw fa-lg" data-fa-transform="grow-4"></i>&nbsp; &nbsp;<b> Matches</b><span class="new badge red pulse">99+</span></div>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li class="grey lighten-2">
                                <a href="donations.php">
                                    <div><i class="blue-text fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform="grow-4"></i> &nbsp; &nbsp; <b>To Give</b><span class="new badge blue">99+</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="eligibility.php">
                                    <div><i class="green-text text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform=""></i> &nbsp; &nbsp; To Recieve<span class="new badge green lighten-1 pulse">99+</span></div>
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
                <div><i class="blue-grey-text fas fa-sign=in-alt fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; Logout </div>
            </a>
        </li>

    </ul>
    <!-- ====================== END OF SIDE BAR NAVIGATION ====================== -->
   
   <!-- ===================== BREADCRUMBS HERE ================================== -->
    <nav class="blue-grey darken-4" style="height:45px; background:url(../_assets/img/bckgrnds/material1.png); background-size: cover; background-repeat: no-repeat;">
        <div class="nav-wrapper ">
            <div class="col s12 container" >
                <h5><i class="fa fa-money-bill-wave fa-sm" data-fa-transform="right-2 up-1"></i> &nbsp; Chat <span class="right hide-on-small-only"><?php echo $email; ?></span></h5>
            </div>

        </div>
    </nav>
    <!-- ===================== END OF BREAD CRUMBS BREADCRUMBS ============== -->
    <section class="parallax-container section" style="height:250px;"><div style ="background-color: rgba(0,0,0,0.5);
    top:0;left:0; width: 100%;
    min-height: 500px; margin-top:-15px; margin-bottom:-35px; padding-top:20px;">
      

       <div class="row center" style="margin-top:180px;">
		   <div class="container"><h3 class="white-text">Chatroom</h3></div></div></div><div class="parallax" ><img src="../_assets/img/bckgrnds/euro.jpg" alt=""></div></section>
    
     <!-- ================= SYSTEM WATCH SECTION ================= -->
    <div class="section">
        
         <div class="row">
            <div class="col s12 m12 l4 grey lighten-4 hide-on-med-and-down" style="padding-bottom:20px;">
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
            <div class="col s12 m12 l8 grey lighten-4" style="height:610px;"><h5 class="flow-text center"><i class="fa fa-user-friends fa-sm"></i>&nbsp; KoboWise Chat</h5><div class="video-container" style="height:380px;"><iframe src="chat.html" frameborder="0" height ="800" width="450" id="chatframe"></iframe></div>
    
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
    <i class="fas fa-power-off fa-2x" data-fa-transform="down-4"></i>
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
    <footer class="page-footer grey darken-4">
        <div class="container ">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">About Instagram</h5>
                    <p class="grey-text text-lighten-4">This Website is about doing some thing. So so so and so. onward etc</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Instagram Support</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">News and Updates</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Contact Us</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Privacy Policy</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Terms and Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright black">
            <div class="container">
                © 2018 Copyright - <strong>Instagram</strong>
                <a class="right" href="#!"><i class="white-text fab fa-facebook-square fa-fw fa-lg" data-fa-transform="up-1"></i><i class="white-text fab fa-instagram fa-fw fa-lg" data-fa-transform="up-1"></i><i class="white-text fab fa-twitter fa-fw fa-lg" data-fa-transform="up-1"></i></a>
            </div>
        </div>
    </footer>
     <!-- ================= FOOTER SECTION ================= -->
    <!-- MODALS -->
    
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
			
  		$('.parallax').parallax();
		$('.scrollspy').scrollSpy();
		$('.collapsible').collapsible();
});
	</script>
</body>
</html>