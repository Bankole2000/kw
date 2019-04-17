<?php
session_start();

if(isset($_SESSION["email"]) && isset($_SESSION["user_id"]) && isset($_SESSION["loggedin"]) && isset($_SESSION["password"])){
    
    require_once('../scripts/connect.php');
    $sql= "SELECT * FROM gw.user_table WHERE email = '{$_SESSION['email']}' AND password = '{$_SESSION['password']}' LIMIT 1";
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
    <title>Records</title>
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
                    <img src="../_assets/img/bckgrnds/material-design-wallpaper-7.png" style="width:350px;" alt="">
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
        <li>
            <a href="profile.php">
                <div><i class="orange-text lighten-1 fas fa-user-edit fa-fw fa-lg"></i>&nbsp; &nbsp; My Profile<span class="new badge orange lighten-1 pulse">Incomplete</span></div>
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
                        <div><i class="red-text text-lighten-1 fas fa-user-friends fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; Matches<span class="new badge red lighten-1 pulse">99+</span></div>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="donations.php">
                                    <div><i class="blue-text text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg"></i> &nbsp; &nbsp; To Give<span class="new badge blue lighten-1 pulse">99+</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="eligibility.php">
                                    <div><i class="green-text text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg"></i> &nbsp; &nbsp; To Recieve<span class="new badge green lighten-1 pulse">99+</span></div>
                                </a>
                            </li>
                            <li class="grey lighten-2">
                                <a href="records.php">
                                    <div><i class="blue-grey-text text-lighten-1 fas fa-money-check-alt fa-fw fa-lg" data-fa-transform="grow-4"></i>&nbsp; &nbsp; &nbsp; <b>Records</b></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>


        </li>


        <div class="divider"></div>
        <li>
            <a href="#" class="subheader">
                <div>Information</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div><i class="blue-grey-text fas fa-info fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; Info and FAQ</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div><i class="blue-grey-text fas fa-newspaper fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; News and Updates</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div><i class="blue-grey-text fas fa-cog fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; Support </div>
            </a>
        </li>

    </ul>
    <!-- ====================== END OF SIDE BAR NAVIGATION ====================== -->
   
   <!-- ===================== BREADCRUMBS HERE ================================== -->
    <nav class="blue-grey darken-4" style="height:45px;">
        <div class="nav-wrapper ">
            <div class="col s12 container" >
                <h5><i class="fa fa-money-check-alt fa-sm" data-fa-transform="right-2 up-1"></i> &nbsp; Records <span class="right hide-on-small-only"><?php echo $email; ?></span></h5>
            </div>

        </div>
    </nav>
    <!-- ===================== END OF BREAD CRUMBS BREADCRUMBS ============== -->
    <a class="btn red waves-effect waves-light"  onclick="$('.tap-target').tapTarget('open')">open tap target</a>
    
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
    <!-- ====================== FLOATING ACTION BUTTON ======================== -->
    <div class="fixed-action-btn click-to-toggle">
        <a class="tooltipped btn-floating btn-large red waves-effect waves-light" data-tooltip="Quick menu" data-position="left">
    <i class="fas fa-power-off fa-2x" data-fa-transform="down-4"></i>
  </a>
        <ul>
           <li><a href="profile.php" class="btn-floating orange waves-effect waves-light tooltipped" data-tooltip="My Profile" data-position="left"><i class="fas fa-user fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a href="donations.php" class="tooltipped btn-floating waves-effect waves-light blue modal-trigger pulse" data-tooltip="View Donations" data-position="left"><i class="fas fa-money-bill-wave fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a href="eligibility.php" class="tooltipped btn-floating waves-effect waves-light green modal-trigger" data-tooltip="View Eligibity" data-position="left"><i class="fas fa-money-check fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a href="support.php" class="tooltipped btn-floating teal waves-effect waves-light" data-tooltip="Help & Support" data-position="left"><i class="fas fa-edit fa-lg" data-fa-transform="grow-4 down-1"></i></a></li>
            <li><a href="logout.php" class="tooltipped btn-floating red waves-effect waves-light" data-tooltip="logout" data-position="left"><i class="fas fa-sign-in-alt fa-lg" data-fa-transform="down-1"></i></a></li>
        </ul>
    </div>
    <!-- ==================== END OF FLOATING ACTION BUTTON =================== -->
   
   <!-- ===================== PROFILE DETAILS SECTION ========================= -->
   <section class="section" id="profile"></section>
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
    <script type="text/javascript" src="../_assets/js/status.js"></script>
    <script type="text/javascript" src="../_assets/js/preload.js"></script>
    <script type="text/javascript" src="../_assets/fonts/svg-with-js/js/fontawesome-all.min.js"></script>
</body>
</html>