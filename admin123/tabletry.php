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
    <link href="../_assets/fonts/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="../_assets/fonts/svg-with-js/css/fa-svg-with-js.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../_assets/css/main.css" />
    <link type="text/css" rel="stylesheet" href="../_assets/css/datatables.min.css" />
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_assets/css/materialize.min.css" media="screen,projection" />

               
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      
   
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users</title>
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

    </ul>
    <!-- ====================== END OF SIDE BAR NAVIGATION ====================== -->
   
   <!-- ===================== BREADCRUMBS HERE ================================== -->
    <nav style="height:90px; background:url(../_assets/img/bckgrnds/material1.png); background-size: cover; background-repeat: no-repeat; ">
        <div class="nav-wrapper" style="margin-top:45px; padding-top:0px;">
            <div class="col s12 container"  >
                <h4><i class="fa fa-user-friends fa-sm" data-fa-transform="right-2 up-1"></i> &nbsp; Users <span class="right"><button data-target="add_user" class="btn amber darken-4 waves-effect waves-light modal-trigger" id="add_users_btn">Add user</button></span></h4>
            </div>

        </div>
    </nav>
    <!-- ===================== END OF BREAD CRUMBS BREADCRUMBS ============== -->
    <!-- ===================== USERS TABLE ============== -->
    
    <section class="section">
           <div class="row">
            <div class="col s12 m12 l12">
            <table id = "datatable" class="">
                    <thead class="amber lighten-2 z-depth-2">
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                            <th>
                                <div>Email</div>
                            </th>
                            <th>Phone Number</th>
                            <th>Password</th>
                            <th>Gender</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Confirmed</th>
                            <th>Update</th>
                            <th>Delete</th>
                            <th>Delete</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php echo $output;?>
                       
                    </tbody>
                </table>
            </div>
        </div>
</section>

    
    <!-- ====================== FLOATING ACTION BUTTON ======================== -->
<!--
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
-->
    <!-- ==================== END OF FLOATING ACTION BUTTON =================== -->
   
   <!-- ===================== MODALS SECTION ========================= -->
<!--
   <div id="add_user" class="modal modal-fixed-footer">
    
    <div class="modal-content center">
    <h4>Add User</h4>
       <form action="" id="add_user_form">
        <div style="display:flex;">                       <div class="input-field" style="flex:1;">
<input id="firstname" type="text" name="firstname">
<label for="firstname"><i class="fa fa-user" data-fa-transform="left-5"></i>FirstName <span class="red-text" id="fname"></span></label>
</div>       <div class="input-field" style="flex:1;">

                                <input id="surname" type="text" name="surname">
                                <label for="surname"><i class="fa fa-user" data-fa-transform="left-5"></i>Surname <span class="red-text" id="sname"></span></label>
                                
                            </div> 
                            </div>
                            <div style="display:flex;">

                               <div class="input-field" style="flex:9;">

                                <input id="email1" type="email" name="email1">
                                <label for="email1"><i class="fa fa-envelope" data-fa-transform="left-5"></i>Email <span id="semail"></span></label>
                                
                            </div> 
                            <div class="input-field" style="flex:4;">
                            <select name="gender" id="gender" class="icons">
    <option value="Male" data-icon="../user/img/man.jpg">Male</option>
    <option value="Female" data-icon="../user/img/lady.jpg">Female</option>
    </select>
    <label>Gender</label>
                                
                            </div> 
                            </div>
                            <div style="display:flex;">                       <div class="input-field" style="flex:1;">
<input id="password" type="password" name="password" placeholder="Password1234">
<label for="password"><i class="fa fa-user" data-fa-transform="left-5"></i>Password <span class="red-text" id="pword"></span></label>
</div>       <div class="input-field" style="flex:1;">

                                <input id="phone_number" type="text" name="phone_number" placeholder="08011111111">
                                <label for="phone_number"><i class="fa fa-user" data-fa-transform="left-5"></i>Phone Number <span class="red-text" id="sname"></span></label>
                                
                            </div> 
                            </div>
                            <div style="display:flex;">

                               <div class="input-field" style="flex:1;">

                                <input id="acc_number" type="text" name="acc_number" placeholder="0000000000">
                                <label for="acc_number" class="validate"><i class="fa fa-envelope" data-fa-transform="left-5"></i>Account Number <span id="anumber"></span></label>
                                
                            </div> 
                            <div class="input-field" style="flex:1;">
                            <select name="location" id="location" >
    <?php echo $stateoptions; ?>
    </select>
    <label>Location</label>
                                
                            </div> 
                            
                            </div>
                               <div style="display:flex;">
<div class="input-field" style="flex:1;">
                            <select name="bank" id="bank" class="icon">
    <?php echo $bankoptions; ?>
    </select>
    <label>Bank</label>
                        <input type="hidden" name="action" id="action" value="add_user">
                            </div> 
                               
                            
                            </div>
                            <button id="signupbtn" class="btn blue darken-4 waves-effect waves-light">Basic Sign up</button>
                            <button type="submit" onclick="" class="btn blue darken-4 waves-effect waves-light">Add User</button>
                            

                        </form> 
-->
<!--<hr/>
                        <form action="" id="add_bank_form" style="display:flex;" method="post" enctype="multipart/form-data">
                           <div class="input-field" style="flex:1;">

                                <input id="bank_name" type="text" name="bank_name" required>
                                <label for="bank_name"><i class="fa fa-envelope" data-fa-transform="left-5"></i>Bank Name <span id="semail"></span></label>
                                
                            </div> 
                            <div class="file-field input-field" style="flex:1;">
     <div class="btn blue-grey darken-2 waves-effect waves-light">
        <span>Logo</span>
        <input type="file" name="image" id="image" required>
        <input type="hidden" name="action" id="action" value="insert">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
                       <button type="submit" class="btn blue darken-4 waves-effect waves-light">Add Bank</button>
                        </form>
-->
                        
    
<!--
  </div>
   
    <div class="modal-footer">
      <a class="btn red waves-effect waves-light" id="don_cancel">Close</a>
      </div>
        
  </div>
-->
   <!-- ===================== END OF PROFILE DETAILS SECTION ====================== -->
    
    <!-- ================= FOOTER SECTION ================= -->
<!--
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
                © 2018 Copyright - <strong>Kobowise</strong>
                <a class="right" href="#!"><i class="white-text fab fa-facebook-square fa-fw fa-lg" data-fa-transform="up-1"></i><i class="white-text fab fa-instagram fa-fw fa-lg" data-fa-transform="up-1"></i><i class="white-text fab fa-twitter fa-fw fa-lg" data-fa-transform="up-1"></i></a>
            </div>
        </div>
    </footer>
-->
     <!-- ================= FOOTER SECTION ================= -->
    <!-- MODALS -->
    
    <!-- ==================== Preloader ============================== -->
<!--
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
-->
    <!-- ===================== End of Preloader ===================== -->
      
    <script type="text/javascript" src="../_assets/js/jquery-3.2.1.min.js"></script>
<!--
    <script type="text/javascript" src="../_assets/js/materialize.min.js"></script>
    <script type="text/javascript" src="../_assets/js/vue.js"></script>
    
    <script type="text/javascript" src="../_assets/js/preload.js"></script>
    <script type="text/javascript" src="../_assets/fonts/svg-with-js/js/fontawesome-all.min.js"></script>
    
-->
    
    <script type="text/javascript" src="../_assets/js/datatables.min.js"></script>
    <script type="text/javascript" src="../_assets/js/jquery.dataTables.min.js"></script>
    
   

    <script type="text/javascript" src="../_assets/js/users.js"></script>
    <script>
    $(document).ready(function(){
       $('#datatable').DataTable(); 
    });
    </script>
</body>
</html>