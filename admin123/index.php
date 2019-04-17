<?php 
session_start();
if (empty($_SESSION["admin_email"])) {
    header("location: login.php"); 
    exit();
    
    
 /*
// Be sure to check that this manager SESSION value is in fact in the database
$admin_id = preg_replace('#[^0-9]#i', '', $_SESSION["admin_id"]); // filter everything but numbers and letters
$admin_email = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["admin_email"]); // filter everything but numbers and letters
$admin_password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["admin_password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
require_once('') "../scripts/connect_to_mysql.php"; 
$result = mysqli_query($conn, "SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($result); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "Your login session data is not on record in the database.";
     exit();
}*/

    
};
?>




<!DOCTYPE html>
<html>

<head>

    <!--Import Font Awesome-->
    <link href="../_assets/fonts/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="../_assets/fonts/svg-with-js/css/fa-svg-with-js.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../_assets/css/main.css" />
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_assets/css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Title</title>

</head>

<body>

    <!-- ====================== FIXED HEADER NAVIGATION ====================== -->
    <div class="navbar-fixed">
        <nav class="white darken-4">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="" class="center brand-logo"><img src="../img/instagram.png" alt="" style="height: 45px; margin-top:10px;"></a>
                    <a href="#" data-activates="side-nav" class="button-collapse show-on-large">
                <i class="fas fa-bars fa-2x black-text" data-fa-transform="down-3 left-10"></i>
                </a>
                    <ul class="hide-on-med-and-down right">

                        <li><a href=""><span class="new badge blue lighten-1">4+</span><i class="fa fa-envelope-open fa-2x blue-text text-lighten-1" data-fa-transform="down-3 right-2"></i></a></li>
                        <li><a href=""><i class="fa fa-sign-in-alt fa-2x blue-grey-text" data-fa-transform="down-3 right-2"></i></a></li>
                        <li><a href=""><img src="../img/person4.jpg" style="width:50px; margin-top:7px;" class="circle" alt=""></a></li>


                    </ul>


                </div>
            </div>
        </nav>
    </div>
    <!-- ====================== END OF FIXED HEADER NAVIGATION ====================== -->

    <!-- ====================== SIDE BAR NAVIGATION ====================== -->
    <ul id="side-nav" class="side-nav white lighten-4">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="../_assets/img/bckgrnds/vintage-boards-1557993_1920.jpg" alt="" style="width:400px;">
                </div>
                <a href=""><img src="../_assets/img/person4.jpg" class="circle" alt=""></a>
                <a href=""><span class="name white-text">Username I.</span></a>
                <a href=""><span class="email white-text">email@host.com</span></a>

            </div>
        </li>
        <li class="active">
            <a href="#">
                <div><i class="blue-grey-text text-darken-4 fas fa-tachometer-alt fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; Dashboard</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div><i class="blue-text fas fa-user-friends fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; Users<span class="new badge blue lighten-1 pulse">No of users</span></div>
            </a>
        </li>
        <li>
                                <a href="#">
                                    <div><i class="green-text text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform=""></i> &nbsp; &nbsp; Donor Requests<span class="new badge green lighten-1 pulse">99+</span></div>
                                </a>
                            </li>
        <li>
                                <a href="#">
                                    <div><i class="orange-text text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform=""></i> &nbsp; &nbsp; VoAs &amp; Requests<span class="new badge orange lighten-1 pulse">99+</span></div>
                                </a>
                            </li>

        <div class="divider"></div>
        
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a href="#" class="collapsible-header">
                        <div><i class="green-text text-lighten-1 fas fa-user-friends fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; Matches<span class="new badge green lighten-1 pulse">99+</span></div>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="#">
                                    <div><i class="blue-text text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform=""></i> &nbsp; &nbsp; My Matches<span class="new badge blue lighten-1 pulse">99+</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div><i class="green-text text-lighten-1 fas fa-money-bill-alt fa-fw fa-lg" data-fa-transform=""></i> &nbsp; &nbsp; Matches with others<span class="new badge green lighten-1 pulse">99+</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
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
           <li>
            <a href="#">
                <div><i class="blue-grey-text fas fa-sign-in-alt fa-fw fa-lg" data-fa-transform=""></i>&nbsp; &nbsp; &nbsp; Logout </div>
            </a>
        </li>

    </ul>
    <!-- ====================== END OF SIDE BAR NAVIGATION ====================== -->
    <!--    <div class="card"><i class="blue-text fas fa-cog fa-3x" data-fa-transform="right-8"></i><p>This is a card</p></div>  -->

    <!-- ================================= BREADCRUMBS HERE ================================== -->

    <nav class="blue-grey darken-4" style="height:40px;">
        <div class="nav-wrapper ">
            <div class="col s12 container" >
                <h5><i class="fa fa-tachometer-alt fa-sm" data-fa-transform="right-2 up-1"></i> &nbsp; Dashboard <span class="right hide-on-med-and-down time">User_Email</span></h5>
            </div>

        </div>
    </nav>
    <!-- former section title 
      
      
       <section class="section center" style="margin-bottom: -50px;">
          <div class="row">
              <div class="col s12 m12 l12">
                  <div class="card-panel blue lighten-1 white-text center">
                      
                  </div>
              </div>
          </div> 
      </section> -->

    <!-- ================================= END OF BREADCRUMBS ================================== -->

    <!-- ================ ACCOUNT BALANCE SECTION HERE ==================== -->

    <section class="section section-stats center grey lighten-4" style="background:url(../_assets/img/bckgrnds/material3.jpg); background-size: cover; background-repeat: no-repeat;">
        <div class="row">
            <div class="col s12 m4 l4">
                <div class="card blue lighten-1 white-text">

                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fa fa-user-friends white-text" data-fa-transform="grow-5 left-10"></i>USERS</span>


                        <div class="divider"></div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">90000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <a href= "users.php" class="btn blue waves-effect waves-light">VIEW USERS</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="card green lighten-1 white-text center">
                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fas fa-money-bill-wave white-text" data-fa-transform="grow-5 left-10"></i>UNMATCHED DONS</span>


                        <div class="divider">do</div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">170000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button href="" data-target="recieve_modal" class="btn green waves-effect waves-light modal-trigger">VIEW DONATIONS</button>
                    </div>
                </div>
            </div>
               <div class="col s12 m4 l4">
                <div class="card amber lighten-1 white-text center">
                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title">PENDING VoAs<i class="fas fa-money-check white-text" data-fa-transform="grow-5 left-120"></i></span>


                        <div class="divider">do</div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">170000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button href="" data-target="recieve_modal" class="btn green waves-effect waves-light modal-trigger">VIEW VoAs</button>
                    </div>
                </div>
            </div>
            


        </div>
        <div class="row">
            <div class="col s12 m4 l4">
                <div class="card green lighten-1 white-text">

                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fa fa-money-bill-wave white-text" data-fa-transform="grow-5 left-10"></i>TOTAL DONATIONS</span>


                        <div class="divider"></div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">90000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button data-target="donate_modal" class="btn blue waves-effect waves-light modal-trigger">VIEW RECORDS</button>
                    </div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="card amber lighten-1 white-text center">
                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fas fa-money-check white-text" data-fa-transform="grow-5 left-10"></i>TOTAL PAYOUTS</span>


                        <div class="divider">do</div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">170000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button href="" data-target="recieve_modal" class="btn green waves-effect waves-light modal-trigger">VIEW RECORDS</button>
                    </div>
                </div>
            </div>
               <div class="col s12 m4 l4">
                <div class="card orange lighten-1 white-text center">
                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fas fa-user-friends white-text" data-fa-transform="grow-5 left-10"></i>CURRENT MATCHES</span>


                        <div class="divider">do</div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">170000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button href="" data-target="recieve_modal" class="btn green waves-effect waves-light modal-trigger">VIEW MATCHES</button>
                    </div>
                </div>
            </div>
            


        </div>
           <div class="row">
            <div class="col s12 m4 l4">
                <div class="card blue lighten-1 white-text">

                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fa fa-user-friends white-text" data-fa-transform="grow-5 left-10"></i>COMPLETED MATCHES</span>


                        <div class="divider"></div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">90000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button data-target="donate_modal" class="btn blue waves-effect waves-light modal-trigger">ARCHIVE</button>
                    </div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="card green lighten-1 white-text center">
                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fas fa-cog white-text" data-fa-transform="grow-5 left-10"></i>OPEN TICKETS</span>


                        <div class="divider">do</div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">170000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button href="" data-target="recieve_modal" class="btn green waves-effect waves-light modal-trigger">VIEW TICKETS</button>
                    </div>
                </div>
            </div>
               <div class="col s12 m4 l4">
                <div class="card green lighten-1 white-text center">
                    <div class="card-content" style="margin-bottom: 0px;">

                        <span class="card-title"><i class="fas fa-cog white-text" data-fa-transform="grow-5 left-10"></i>CLOSED TICKETS</span>


                        <div class="divider">do</div>
                        <strong><h4 class="left">&#8358;</h4><h4 class="right">.00</h4><h4 class="count right">170000</h4></strong>
                    </div>
                    <div class="card-action white" style="margin-top:30px;">
                        <button href="" data-target="recieve_modal" class="btn green waves-effect waves-light modal-trigger">ARCHIVE</button>
                    </div>
                </div>
            </div>
            


        </div>
    </section>



    <!--  ================= END OF ACCOUNT BALANCE SECTION ===================== -->


    <section class="section grey lighten-4">
        <div class="row">
            <div class="col s12 m8 l8">
                <ul class="collapsible popout">
                    <li>
                        <div class="collapsible-header waves-effect waves-blue">
                            <div><i class="fa fa-money-bill-alt blue-text text-lighten-1" data-fa-transform="grow-4"></i>&nbsp; &nbsp; You have Left to Donate</div>
                            <span class="new badge blue lighten-1">4</span></div>
                        <div class="collapsible-body">
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header waves-effect waves-green">
                            <div><i class="fa fa-money-bill-alt green-text text-lighten-1" data-fa-transform="grow-4"></i>&nbsp; &nbsp; You have Left to Recieve</div>
                            <span class="new badge green lighten-1">1</span></div>
                        <div class="collapsible-body">
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col s12 m4 l4">
                <div class="card center" style="padding:10px;">
                    <div class="col s4 m4 l4">
                        <div class="container">
                            <i class="fa fa-times-circle fa-3x red-text"></i>
                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">

                            <!-- <span class="card-title center">STRIKES</span> -->
                            <i class="fa fa-plus-circle green-text fa-3x"></i>


                        </div>
                    </div>
                    <div class="col s4 m4 l4">
                        <div class="container">

                            <!-- <span class="card-title center">STRIKES</span> -->
                            <i class="fa fa-plus-circle green-text fa-3x"></i>


                        </div>
                    </div>

                    <div class="" style="padding:0px;">
                        <p class="center" styling="padding-bottom:-20px;">You have 1 strikes. You're doing Great! <span class="blue-grey-text"><br/> What do these mean?</span></p>
                    </div>

                </div>
            </div>

        </div>
        <hr/>
        <section class="section">
        <div class="row">
            <div class="container">
                <h5 class="left"><a><i class="fa fa-money-bill-alt fa-sm blue-text text-lighten-1" data-fa-transform=" left-5"></i></a>Current Matches</h5>
                
            </div>

            <div class="col s12 m12 l12">

                <!-- =================================== PENDING DON (I HAVE DONE IT) TABLE HERE ================== -->

                <table class="striped responsive-table highlight centered green lighten-4">
                    <thead class="blue lighten-2 z-depth-2">
                        <tr>
                            <th>
                                <div>Donor Name</div>
                            </th>
                            <th>Phone Number</th>
                            <th><div>Recipient Name</div></th>
                            <th>Phone Number</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Paid</th>
                            <th>Confirmed</th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>08012345678</td>
                            <td><div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div></td>
                            <td>08012345678</td>
                            <td>&#8358;20000</td>
                            <td>2018-07-12</td>
                            <td><a class="btn waves-effect waves-light">paid</a></td>
                            <td><a class="btn orange waves-effect waves-light">Confirmed</a></td>
                        </tr>
                        
                       <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>08012345678</td>
                            <td><div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div></td>
                            <td>08012345678</td>
                            <td>&#8358;20000</td>
                            <td>2018-07-12</td>
                            <td><a class="btn waves-effect waves-light">paid</a></td>
                            <td><a class="btn orange waves-effect waves-light">Confirmed</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>08012345678</td>
                            <td><div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div></td>
                            <td>08012345678</td>
                            <td>&#8358;20000</td>
                            <td>2018-07-12</td>
                            <td><a class="btn waves-effect waves-light">paid</a></td>
                            <td><a class="btn orange waves-effect waves-light">Confirmed</a></td>
                        </tr>
                    </tbody>
                </table>
                <!-- ====== END OF PENDING DON (I HAVE DONE IT) TABLE HERE ================== -->

            </div>
        </div>
           <div class="row">
            <div class="container">
                <h5 class="left"><a><i class="fa fa-money-bill-alt fa-sm blue-text text-lighten-1" data-fa-transform=" left-5"></i></a>Matches with me</h5>
                
            </div>

            <div class="col s12 m12 l12">

                <!-- =================================== PENDING DON (I HAVE DONE IT) TABLE HERE ================== -->

                <table class="striped responsive-table highlight centered green lighten-4">
                    <thead class="amber lighten-2 z-depth-2">
                        <tr>
                            <th>
                                <div>Donor Name</div>
                            </th>
                            <th>Phone Number</th>
                            <th><div>Recipient Name</div></th>
                            <th>Phone Number</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Paid</th>
                            <th>Confirmed</th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>08012345678</td>
                            <td><div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div></td>
                            <td>08012345678</td>
                            <td>&#8358;20000</td>
                            <td>2018-07-12</td>
                            <td><a class="btn waves-effect waves-light">paid</a></td>
                            <td><a class="btn orange waves-effect waves-light">Confirmed</a></td>
                        </tr>
                        
                       <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>08012345678</td>
                            <td><div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div></td>
                            <td>08012345678</td>
                            <td>&#8358;20000</td>
                            <td>2018-07-12</td>
                            <td><a class="btn waves-effect waves-light">paid</a></td>
                            <td><a class="btn orange waves-effect waves-light">Confirmed</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>08012345678</td>
                            <td><div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div></td>
                            <td>08012345678</td>
                            <td>&#8358;20000</td>
                            <td>2018-07-12</td>
                            <td><a class="btn waves-effect waves-light">paid</a></td>
                            <td><a class="btn orange waves-effect waves-light">Confirmed</a></td>
                        </tr>
                    </tbody>
                </table>
                <!-- ====== END OF PENDING DON (I HAVE DONE IT) TABLE HERE ================== -->

            </div>
        </div>
        </section></section>

    <!-- ============ PENDING REC (CONFIRMATION) TABLE HERE ============== -->
<section class="section">
           <div class="row">
            <div class="container">
                <h5 class="left"><a><i class="fa fa-money-bill-alt fa-sm blue-text text-lighten-1" data-fa-transform=" left-5"></i></a>Support Tickets</h5>
                
            </div>

            <div class="col s12 m12 l12">

                <!-- =================================== PENDING DON (I HAVE DONE IT) TABLE HERE ================== -->

                <table class="striped responsive-table highlight centered green lighten-4">
                    <thead class="amber lighten-2 z-depth-2">
                        <tr>
                           <th>ID</th>
                           <th>User Email</th>
                            <th>
                                <div>Donor Name</div>
                            </th>
                            <th>Phone Number</th>
                            <th>Subject</th>
                            <th>Issue</th>
                            <th>Date Reported</th>
                            <th>Status</th>
                            <th>Confirmed</th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>user@email.com</td>
                            <td><div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div></td>
                            <td>08012345678</td>
                            <td>Payment Issue</td>
                            <td>User refused to confirm payment</td>
                            <td>2018-07-12</td>
                            <td><a class="btn waves-effect waves-light">pending</a></td>
                            <td><a class="btn orange waves-effect waves-light">Confirmed</a></td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
</section>

    
    <!-- =========== END OF PENDING REC (CONFIRMATION) TABLE HERE ================ -->

    <!-- Vue Practice -->


    <!-- End of Vue Practice -->

    <!-- ===================== FLOATING ACTION BUTTON ===================== -->

    <div class="fixed-action-btn click-to-toggle">
        <a class="btn-floating btn-large red pulse waves-effect waves-light">
    <i class="fas fa-power-off fa-2x" data-fa-transform="down-4"></i>
  </a>
        <ul>
            <li><a data-target="donate_modal" class="btn-floating waves-effect waves-light blue modal-trigger pulse"><i class="fas fa-money-bill-wave fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a data-target="recieve_modal" class="btn-floating waves-effect waves-light green modal-trigger"><i class="fas fa-money-check fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a class="btn-floating teal waves-effect waves-light"><i class="fas fa-info fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a class="btn-floating orange waves-effect waves-light"><i class="fas fa-edit fa-lg" data-fa-transform="down-1"></i></a></li>
            <li><a class="btn-floating red waves-effect waves-light"><i class="fas fa-sign-in-alt fa-lg" data-fa-transform="down-1"></i></a></li>
        </ul>
    </div>

    <!-- ========================================== END OF FLOATING ACTION BUTTON ======================================-->

    <!-- ================= INFOR/ARTICULES SECTION ================= -->

    <div class="row section" style="margin-top:-20px;">

        <div class="row" style="margin-bottom:0px; margin-top:-10px;">
            <div class="container">
                <h5 class="left"><a><i class="fa fa-info-circle fa-lg" data-fa-transform=" left-5"></i></a>Information</h5>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <div class="card z-depth-3">
                <div class="card-image">
                    <img src="../img/img1.jpg">
                    <span class="card-title"><strong>Getting Started</strong></span>
                    
                </div>

                <div class="card-content">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                    <a class="btn red waves-effect waves-light">Read More</a>
                </div>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <div class="card z-depth-3">
                <div class="card-image">
                    <img src="../img/img2.jpg">
                    <span class="card-title"><strong>Getting Started</strong></span>
                    
                </div>

                <div class="card-content">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                    <a class="btn red waves-effect waves-light">Read More</a>
                </div>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <div class="card z-depth-3">
                <div class="card-image">
                    <img src="../img/img3.jpg">
                    <span class="card-title"><strong>Getting Started</strong></span>
                    
                </div>

                <div class="card-content">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                    <a class="btn red waves-effect waves-light">Read More</a>
                </div>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <div class="card z-depth-3">
                <div class="card-image">
                    <img src="../img/img4.jpg">
                    <span class="card-title"><strong>Getting Started</strong></span>
                    <a class="btn-floating halfway-fab waves-effect waves-indigo white"><i class="fa fa-info fa-2x indigo-text text-darken-4" data-fa-transform="shrink-3 down-2 right-8"></i></a>
                </div>

                <div class="card-content indigo darken-4 white-text">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action indigo darken-4">
                    <a class="btn white indigo-text waves-effect waves-indigo">Read More</a>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= NEWS & UPDATES SECTION ================= -->

    <div class="row section" style="margin-top:-20px; ">
        <hr/>
        <div class="row" style="margin-bottom:0px; margin-top:-10px;">
            <div class="container">
                <h5 class="left"><a><i class="fa fa-newspaper fa-lg" data-fa-transform=" left-5"></i></a>News/Updates</h5>
            </div>
        </div>


        <div class="col s12 m3 l3">
            <div class="card z-depth-3">
                <div class="card-image">
                    <img src="../img/img5.jpg">
                    <span class="card-title"><strong>Getting Started</strong></span>
                   
                </div>

                <div class="card-content">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                    <a class="btn red waves-effect waves-light">Read More</a>
                </div>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <div class="card z-depth-3">
                <div class="card-image">
                    <img src="../img/img6.jpg">
                    <span class="card-title"><strong>Getting Started</strong></span>
                    
                </div>

                <div class="card-content">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                    <a class="btn red waves-effect waves-light">Read More</a>
                </div>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <div class="card z-depth-3">
                <div class="card-image">
                    <img src="../img/img7.jpg">
                    <span class="card-title"><strong>Getting Started</strong></span>
                    
                </div>

                <div class="card-content">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                    <a class="btn red waves-effect waves-light">Read More</a>
                </div>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <div class="card z-depth-3">
                <div class="card-image">
                    <img src="../img/img8.jpg">
                    <span class="card-title"><strong>Getting Started</strong></span>
                    <a class="btn-floating halfway-fab waves-effect waves-orange white"><i class="fa fa-info fa-2x orange-text text-darken-4" data-fa-transform="shrink-3 down-2 right-8"></i></a>
                </div>

                <div class="card-content orange darken-4 white-text">

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action orange darken-4">
                    <a class="btn white orange-text waves-effect waves-deep-orange">Read More</a>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= END OF INFO/ARTICLES SECTION ================= -->

    <!-- ================= SYSTEM WATCH SECTION ================= -->

    <div class="section" style="margin-top:-20px; ">
        <hr/>
        <div class="row" style="margin-bottom:0px; margin-top:-10px;">
            <div class="container">
                <h5 class="left"><a><i class="fa fa-desktop fa-lg" data-fa-transform="left-5"></i></a>System Watch</h5>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m7 l7">
                <h5 class="flow-text center"><i class="fa fa-user-friends fa-sm"></i>&nbsp; Your Transactions</h5>
                <table class="highlight centered grey lighten-4">

                    <thead class="orange lighten-2">
                        <tr>
                            <th>
                                <div>Donor</div>
                            </th>

                            <th>
                                <div>Recipient</div>
                            </th>
                            <th>
                                <div>Amount</div>
                            </th>
                            <th>
                                <div>Date</div>
                            </th>
                        </tr>
                    </thead>


                    <tbody>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person1.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../img/person3.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>Eclair</td>
                            <td>$10000.87</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person4.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>Eclair</td>
                            <td>$10000.87</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person3.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../img/person1.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                            <td>Eclair</td>
                            <td>$10000.87</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col s12 m5 l5">
                <h5 class="flow-text center"><i class="fa fa-users fa-sm"></i>&nbsp; Recent Matches</h5>
                <table class="highlight centered grey lighten-4">

                    <thead class="orange lighten-2">
                        <tr>
                            <th>
                                <div>Donor</div>
                            </th>

                            <th>
                                <div>Recipient</div>
                            </th>

                        </tr>
                    </thead>


                    <tbody>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person1.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../img/person3.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person4.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../img/person2.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="chip">
                                    <img src="../img/person3.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>


                            <td>
                                <div class="chip">
                                    <img src="../img/person1.jpg" alt="Contact Person"> Jane Doe
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>






    <!-- ================= END OF SYSTEM WATCH SECTION ================= -->

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

    <!-- MODALS -->
    
    <div id="donate_modal" class="modal">
    <form action="">
    <div class="modal-content">
    
        <h4>Make a Donation</h4>
    <div class="col s12">
      How much would you like to donate? &#8358;:
       <div class="input-field inline">
          <input id="email" type="email" class="validate">
           <label for="email_inline">Donation Amount</label>
            
            <span class="helper-text" data-error="wrong" data-success="right">minimum =  &#8358;5000</span>
    
       </div>
        
    </div> 
    
  </div>
   
    <div class="modal-footer center">
      <a href="#!" class="btn red modal-close waves-effect waves-light">Cancel </a>
      <a href="#!" class="btn green modal-close waves-effect waves-light">Agree</a>
    </div>
        </form>
  </div>
    
    <div id="recieve_modal" class="modal">
    <div class="modal-content">
      <h4>Recieve Donations</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="btn red modal-close waves-effect waves-light">Cancel</a>
      <a href="#!" class="btn green modal-close waves-effect waves-light">Agree</a>
    </div>
  </div>
    
    <!-- Preloader -->
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



    <!-- ================ END OF FOOTER ========================= -->

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../_assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../_assets/js/materialize.min.js"></script>
    <script type="text/javascript" src="../_assets/js/vue.js"></script>
    <script type="text/javascript" src="../_assets/js/jquery.countdown.js"></script>
    <script type="text/javascript" src="../_assets/fonts/svg-with-js/js/fontawesome-all.min.js"></script>


    <script>
        // Hide Sections
        $('.section').hide();
        $('.page-footer').hide();

        setTimeout(function() {
            $(document).ready(function() {
                // Show sections
                $('.section').fadeIn(1000);
                $('.page-footer').fadeIn(1000);
                // Hide preloader
                $('.loader').fadeOut();

                //Init Side nav
                $('.button-collapse').sideNav();

                // Counter
                $('.count').each(function() {
                    $(this).prop('Counter', 0).animate({
                        Counter: $(this).text()
                    }, {
                        duration: 1250,
                        easing: 'swing',
                        step: function(now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
                });
                 $('.modal').modal();   
                $('select').material_select();
            
            });



        }, 0);
    </script>

</body>

</html>