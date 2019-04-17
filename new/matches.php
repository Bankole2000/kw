<?php 

//Get Donors
 require_once('../scripts/connect.php');
 $get_donors = "SELECT * FROM donor_request_table JOIN user_table ON user_table.user_id = donor_request_table.donor_user_id JOIN states ON user_table.state_id = states.state_id WHERE amount_unmatched > 0 ORDER BY donor_request_table.amount_unmatched DESC";
        $resultd = $db->query($get_donors);
        $donors = '';
        while($rowd = $resultd->fetch_array())
        {   
            if($rowd['amount_unmatched'] < $rowd['amount_offered']){
                $disabled = 'disabled';
                $btnstyle = 'btn-secondary';
            }else {
                $disabled = '';
                $btnstyle = 'btn-primary';
            }
            $donors .= '<option userid="'.$rowd["donor_user_id"].'" value="'.$rowd["amount_unmatched"].'" donid="'.$rowd["donor_request_id"].'">'.$rowd["first_name"].' '.$rowd["last_name"].' '.$rowd["gender"].' &#8358;'.$rowd["amount_unmatched"].' '.$rowd["state"].' '.$rowd["user_strikes"].'</option>';
        };

//Get Recipients
require_once('../scripts/connect.php');
 $get_recs = "SELECT * FROM recieve_request_table JOIN user_table ON user_table.user_id = recieve_request_table.reciever_user_id JOIN states ON user_table.state_id = states.state_id WHERE amount_unmatched > 0 AND voa_approval = 1 ORDER BY recieve_request_table.amount_unmatched DESC";
        $resultr = $db->query($get_recs);
        $recievers = '';
        while($rowr = $resultr->fetch_array())
        {   
            if($rowr['amount_unmatched'] < $rowr['amount_to_recieve']){
                $disabled = 'disabled';
                $btnstyle = 'btn-secondary';
            }else {
                $disabled = '';
                $btnstyle = 'btn-primary';
            }
            $recievers .= '<option userid="'.$rowr["reciever_user_id"].'" value="'.$rowr["amount_unmatched"].'" recid="'.$rowr["recieve_request_id"].'">'.$rowr["first_name"].' '.$rowr["last_name"].' '.$rowr["gender"].' &#8358;'.$rowr["amount_unmatched"].' '.$rowr["state"].' '.$rowr["user_strikes"].'</option>';
            
            
        };
    

 require_once('../scripts/connect.php');
//get States & Banks
 $stateoptions = "";
 $bankoptions = "";

 $states = "SELECT * FROM states ORDER BY state_id";
 $banks = "SELECT * FROM banks ORDER BY bank_id";
$no_of_users = "SELECT * FROM match_table";
$no_of_uncon = "SELECT * FROM match_table WHERE is_confirmed = 0";

require_once('../scripts/connect.php');
        $result1 = $db->query($states);
        $result2 = $db->query($banks);
        $result3 = $db->query($no_of_users);
        $result4 = $db->query($no_of_uncon);
        while($row1 = $result1->fetch_array())
        {
            $stateoptions .= '<option value="'.$row1["state_id"].'">'.$row1["state"].'</option>';
        };
        while($row2 = $result2->fetch_array())
        {
            $bankoptions .= '<option value="'.$row2["bank_id"].'">'.$row2["bank"].'</option>';
        };
$match_count = $result3->num_rows;
$pend_count = $result4->num_rows;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Matches</title>
    <link rel="stylesheet" href="../_assets/css/bs/bootstrap.css">
    <link rel="stylesheet" href="../_assets/css/bs/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../_assets/fonts/css/fontawesome-all.min.css">
    <link href="../_assets/fonts/svg-with-js/css/fa-svg-with-js.css" rel="stylesheet">
    <link rel="stylesheet" href="../_assets/css/mainbs.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container">
            <a href="index.php" class="navbar-brand">Instagram</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target='#navbarCollapse'>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="users.php" class="nav-link">Users</a>
                    </li>
                <li class="nav-item">
                        <a href="donations.php" class="nav-link">Donations</a>
                    </li>
                <li class="nav-item">
                        <a href="voas.php" class="nav-link">VoAs</a>
                    </li>
                <li class="nav-item">
                        <a href="matches.php" class="nav-link active">Matches</a>
                        </li>
                <li class="nav-item">
                         <a href="matchm.php" class="nav-link">Match Me</a>
                    </li>
                       <li class="nav-item">
                        <a href="matcho.php" class="nav-link">Match Others</a>
                    </li>
                       <li class="nav-item">
                        <a href="support.php" class="nav-link">Support</a>
                    </li>
                <li class="nav-item">
                        <a href="articles.php" class="nav-link">Articles</a>
                    </li>
                <li class="nav-item">
                        <a href="sendmail.php" class="nav-link">Mail</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!--   Home Section -->
  <section style="padding-top:100px; padding-bottom:20px;">
      <div class="container"><div class="row center">
          <div class="col text-center">
              <form action="">
                  <div class="form-group">
    <label for="donor_select">Donor Select</label>
    <select class="form-control" id="donor_select">
      <?php echo $donors;?>
    </select>
  </div>
              <div class="form-group">
    <label for="reciever_select">Recipient Select</label>
    <select class="form-control" id="reciever_select">
      <?php echo $recievers;?>
    </select>
  </div>    
                
                 <label for="match_amount">Match Amount &nbsp; <span id="lmatch_amount"></span></label>
                  <div class="input-group mb-3">
    <div class="input-group-prepend"><span class="input-group-text">&#8358;</span></div>
    <input type="number" pattern="[0-9]*" class="form-control" id="match_amount" placeholder="100,000 Maximum">
  </div>
                 
              </form>
              <div class="container">
                       <div class="alert alert-success fade show" style="display:none;" id="match_success">
                          <strong>Great!</strong> Another Successful Match. 
                      </div>
                         <div class="alert alert-danger fade show" style="display:none;" id="match_same_user">
                          <strong>Warning!</strong> Don't Match the Same Users  
                      </div>
                      <div class="alert alert-danger" style="display:none;" id="match_empty">
                           <strong>Error!</strong> No Match Amount Entered 
                      </div>
                      <div class="alert alert-danger" style="display:none;" id="match_high_donation">
                           <strong>Error!</strong> Match amount Higher than Donation 
                      </div>
                    <div class="alert alert-danger" style="display:none;" id="match_high_request">
                           <strong>Error!</strong> Match amount Higher than Recieve request 
                      </div>
                        <div class="alert alert-danger" style="display:none;" id="match_failed">
                           <strong>Error!</strong> Match Data Base Error 
                      </div>
                   </div>
               <button class="btn btn-primary btn-block" id="make_match">MATCH</button>
          </div>
      </div></div>
  </section>
   <section>
       <div >
           <div><div class="container"><div class="row center">
               <div class="col text-center" style="padding:10px;">&nbsp; Total Matches = <?php echo $match_count; ?><br> Pending Matches = <?php echo $pend_count; ?></div>
               </div></div>
               <div class="container">
                   <div class="row">
                      <div class="table-responsive">
                  <table class="table table-striped table-hover" id="datatable">
                      <thead>
                          <tr>
                              <td>ID</td>
                              <td>Donor Name</td>
                              <td>Location</td>
                              <td>Matched Amount</td>
                              <td>Reciever Name</td>
                              <td>Location</td>
                              <td>Date Matched</td>
                              <td>Is paid?</td>
                              <td>Is Confirmed?</td>
                              <td>Update</td>
                              <td>View</td>
                              <td>Cancel</td>                       
                          </tr>
                      </thead>
                      <tbody id="all_matches">
                          
                      </tbody>
                  </table>
              </div>
                           
                            </div>
                        
                   </div>
               </div>
           
       </div>
   </section>
  
   
<footer id="main-footer" class="bg-dark">
    <div class="container">
        <div class="row">
        <div class="col text-center">
            <div class="py-4">
                <h1 class="h3">Instagram</h1><p>Copyright &copy; 2018</p>
                <button class="btn btn-primary" data-toggle ='modal' data-target="#contactmodal">Contact us</button>
            </div>
        </div>
        </div>
    </div>
</footer>
   
   <div class="modal fade text-dark" id="contactmodal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="contactmodaltitle">Contact Us</h5>
                   
               </div>
               <div class="modal-body">
                       <form action="">
                           <div class="form-group">
                               <label for="name">Name</label>
                               <input type="text" class="form-control">
                           </div>
                       <div class="form-group">
                               <label for="email">email</label>
                               <input type="text" class="form-control">
                           </div>
                       <div class="form-group">
                               <label for="Phone Number">Phone Number</label>
                               <input type="text" class="form-control">
                           </div>
                       <div class="form-group">
                               <label for="message">Message</label>
                           <textarea class="form-control"></textarea>
                           </div>
                       
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button class="btn btn-primary btn-block">submit</button>
                   </div>
           </div>
       </div>
   </div>
 
   <div class="modal fade text-dark" id="add_user">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="contactmodaltitle">Add user</h5>
                   
               </div>
               <div class="modal-body">
                      <div class="alert alert-success fade show" style="display:none;" id="add_success">
                          <strong>Success!</strong> User Successfully Added 
                      </div>
                         <div class="alert alert-warning fade show" style="display:none;" id="incomplete">
                          <strong>Warning!</strong> Incomplete Details 
                      </div>
                      <div class="alert alert-danger" style="display:none;" id="add_fail">
                           <strong>Sorry!</strong> This email is already registered
                      </div>
                       <form action="" id="add_user_form">
                           <div class="form-group">
                               <label for="firstname">First Name <span id="fname"></span></label>
                               <input type="text" class="form-control" id="firstname">
                           </div>
                       <div class="form-group">
                               <label for="lastname">Last Name <span id="lname"></span></label>
                               <input type="text" class="form-control" id="lastname">
                           </div>
                       <div class="form-group">
                               <label for="email">Email <span id="lemail"></span></label>
                               <input type="text" class="form-control" id="email">
                           </div>
                       <div class="form-group">
                               <label for="gender">Gender</label>
                                 <select class="form-control" name="" id="gender">
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                              </select>
                              
                          
                           </div>
                       <input type="hidden" id="action" value="insert" name="action">
                       </form>
                   </div>
                   <div class="container"><button id="add_btn" type='submit' value="submit" class="btn btn-success btn-block">Add User</button></div>
                   <div class="modal-footer">
                       <button id="close" type='submit' value="submit" class="btn btn-primary btn-block">Close</button>
                   </div>
           </div>
       </div>
   </div> 
   
    <div class="modal fade text-dark" id="edit_user">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="contactmodaltitle">Edit <span id="edit_user1" class="text-primary"></span></h5>
                   
               </div>
               <div class="modal-body">
                      
                       <form action="" id="edit_user_form">
                           <div class="form-group">
                               <label for="firstname1">First Name <span id="fname1"></span></label>
                               <input type="text" class="form-control" id="firstname1">
                           </div>
                       <div class="form-group">
                               <label for="lastname1">Last Name <span id="lname1"></span></label>
                               <input type="text" class="form-control" id="lastname1">
                           </div>
                       <div class="form-group">
                               <label for="email1">Email <span id="lemail1"></span></label>
                               <input type="text" class="form-control" id="email1" disabled>
                           </div>
                          <div class="form-group">
                               <label for="phonenumber1">Phone Number <span id="lphone1"></span></label>
                               <input type="text" class="form-control" id="phonenumber1">
                           </div>
                               <div class="form-group">
                               <label for="gender1">Gender</label>
                                 <select class="form-control" name="" id="gender1">
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                              </select>
                              
                          
                           </div>
                               <div class="form-group">
                               <label for="password1">Password <span id="pword1"></span></label>
                               <input type="text" class="form-control" id="password1">
                           </div>
                        <div class="form-group">
                               <label for="location1">Location</label>
                                 <select class="form-control" name="" id="location1">
                                  <?php echo $stateoptions;?>
                              </select>
                              
                          
                           </div>
                       <div class="form-group">
                               <label for="account1">Account Number <span id="acc_1"></span></label>
                               <input type="text" class="form-control" id="account1">
                           </div>
                       <div class="form-group">
                               <label for="bank1">Bank</label>
                                 <select class="form-control" name="" id="bank1">
                                 <?php echo $bankoptions;?>
                           </select> 
                             </div>
                              <div class="form-group">
                               <label for="strikes1">Number of Strikes</label>
                                 <select class="form-control" name="" id="strikes1">
                                  <option value="0">0 </option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                 </select>
                              
                          
                           </div>
                       <input type="hidden" id="action" value="insert" name="action">
                       <input type="hidden" id="user_id1" value="insert" name="action">
                       </form>
                   </div>
                   <div class="container">
                       <div class="alert alert-success fade show" style="display:none;" id="edit_success">
                          <strong>Success!</strong> User Successfully Updated 
                      </div>
                         <div class="alert alert-warning fade show" style="display:none;" id="incomplete1">
                          <strong>Warning!</strong> Incomplete Details 
                      </div>
                      <div class="alert alert-warning" style="display:none;" id="add_fail">
                           <strong>Oops!</strong> Something went wrong 
                      </div>
                   </div>
                   <div class="container"><button id="update_btn" type="button" name="button" class="btn btn-primary btn-block">Update User</button></div> <hr/>
                   <div class="container"><img id="profile_pic1" src="" alt="">
                   </div>
                   <form action="" method ="POST" enctype="multipart/form-data">
                   <div class="form-group container">
    <label for="exampleFormControlFile1">Example file input</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
                  <div class="container" style="padding-bottom:10px;"><button id="" type='submit' value="submit" class="btn btn-primary btn-block" name="submit">Update Picture</button></div></form>
                   <div class="modal-footer">
                       <button id="close" type='submit' value="submit" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
                   </div>
           </div>
       </div>
   </div>
   
   <div class="modal fade text-dark" id="view_user">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title text-primary" id="viewmodaltitle"></h5>
                   
               </div>
               <div class="modal-body">
                       <div class="container"><div class="row"><div class="col-md-6 col-lg-5 col-sm-12"><img id="profile_pic2" src="" alt="" style="width:150px;"> </div>
                       <div class="col-lg-7 col-sm-12 col-md-6">
                       <strong>User ID: &nbsp;</strong><span id="viewid"></span><br/>
                       <strong>Name: &nbsp;</strong><span id="viewname"></span><br/>
                       <strong>Email: &nbsp;</strong><span id="viewemail"></span><br/>
                       <strong>Phone: &nbsp;</strong><span id="viewphone"></span><br/>
                       <strong>Gender: &nbsp;</strong><span id="viewgender"></span><br/>
                       <strong>Location: &nbsp;</strong><span id="viewstate"></span><br/>
                       </div>
                       </div>
                   </div>
                       <div class="container"><div class="row"><div class="container"><div class="col"><h5 style="padding-top:10px;">Details</h5></div></div></div>
                       <div class="row">
                       <div class="col-12"><strong>Signed Up: &nbsp;</strong><span id="viewsignupdate"></span><br/>
                       <strong>Password: &nbsp;</strong><span id="viewpassword"></span><br/>
                       <strong>Bank: &nbsp;</strong><span id="viewbank"></span><br/>
                       <strong>Account Number: &nbsp;</strong><span id="viewaccount"></span><br/>
                       <strong>Donation Balance: &#8358; &nbsp;</strong><span id="viewdonbalance"></span><br/>
                       <strong>Eligibility Balance: &#8358; &nbsp;</strong><span id="viewrecbalance"></span><br/>
                       <strong>Total Donations: &#8358; &nbsp;</strong><span id="viewtotaldon"></span><br/>
                       <strong>Total Eligibility: &#8358; &nbsp;</strong><span id="viewtotalrec"></span><br/>
                       <strong>Total Strikes: &nbsp;</strong><span id="viewstrikes"></span><br/></div>
                       </div>
                        </div></div>
                   <div class="container" style="padding-bottom:10px;"><a href='http://localhost' target="_blank" id="viewdetails" value="" class="btn btn-primary btn-block">View Record</a></div>
                   <div class="modal-footer">
                       <button id="close" type='submit' value="submit" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
                   </div>
           </div>
       </div>
   </div>
 
     
   <div class="modal fade text-dark" id="match_reverse_modal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title text-primary"> Delete match?</h5>
                   
               </div>
               <div class="modal-body">
                      Delete This match?
                       </div>
                   <input type="hidden" id="revmatch_id" value="">
                   <input type="hidden" id="revmatch_donor_id" value="">
                   <input type="hidden" id="revmatch_recieve_id" value="">
                   <input type="hidden" id="revmatch_donor_user_id" value="">
                   <input type="hidden" id="revmatch_recieve_user_id" value="">
                   <input type="hidden" id="revmatch_amount" value="">
                   <div class="modal-footer">
                       <button id="reversematch" type='button' class="btn btn-danger btn-block" data-dismiss="modal">Delete</button>
                       <button id="close" type='submit' value="submit" class="btn btn-primary btn-block" data-dismiss="modal">Cancel</button>
                   </div>
           </div>
       </div>
   </div>
   
    
    <script type="text/javascript" src="../_assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/bootstrap.min.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/popper.min.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/popper.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/popper.min.js.map"></script>
    <script type="text/javascript" src="../_assets/js/bs/jquery.dataTables.js"></script>

    <script type="text/javascript" src="../_assets/js/bs/dataTables.bootstrap4.js"></script>
    
    <script>
    $(document).ready(function(){
   
        
    var lastname = $('#surname').val();
    var email = $('#email1').val();
    var gender = $('#gender').val();
    var name_reg=/^[a-z]{3,}$/i;
    var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
    var acc_reg=/^[0-9]{10}$/i;
    var phone_reg=/^[0-9]{11}$/i;
    var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
       
    //FIXME: FIX MATCH TABLE, MATCH TABLE NOT SHOWING USER AND RECIEVER DETAILS ON ADMIN MATCH PAGE 
    //TODO: CHECK HOW TO DISPLAY DATA FROM SAME TABLE IN SEPERATE JOINS 
        function fetch_all_matches(){
           var action = "mini";
            $.ajax({
            url:"../ajax/matches.php",
            method:"POST",
            data:{action:action},
            success:function(users)
            {
                $('#all_matches').html(users);
                $('#datatable').DataTable({
                    "destroy":true,
                });
            }
            
        }); 
            
        };
        fetch_all_matches();
                
        $('#firstname').focusout(function(){
            var firstname = $('#firstname').val();
            if(firstname==''){
             $('#firstname').addClass('invalid');
                $('#firstname').removeClass('valid');
                $('#fname').addClass('text-danger');
                $('#fname').removeClass('text-success');
                $('#fname').html('Empty');
            };
            
            if(firstname != ''){if(name_reg.test(firstname)){
                $('#firstname').addClass('valid');
                $('#firstname').removeClass('invalid');
                $('#fname').addClass('text-success');
                $('#fname').removeClass('text-danger');
                $('#fname').html('Ok');
            } else { 
                $('#firstname').addClass('invalid');
                $('#firstname').removeClass('valid');
                $('#fname').addClass('text-danger');
                $('#fname').removeClass('text-success');
                $('#fname').html('Letters Only, more than 2');
                }}
        });
        
        $('#lastname').focusout(function(){
            var lastname = $('#lastname').val();
            if(lastname==''){
             $('#lastname').addClass('invalid');
                $('#lastname').removeClass('valid');
                $('#lname').addClass('text-danger');
                $('#lname').removeClass('text-success');
                $('#lname').html('Empty');
            };
            
            if(lastname != ''){if(name_reg.test(lastname)){
                $('#lastname').addClass('valid');
                $('#lastname').removeClass('invalid');
                $('#lname').addClass('text-success');
                $('#lname').removeClass('text-danger');
                $('#lname').html('Ok');
            } else { 
                $('#lastname').addClass('invalid');
                $('#lastname').removeClass('valid');
                $('#lname').addClass('text-danger');
                $('#lname').removeClass('text-success');
                $('#lname').html('Letters Only, more than 2');
                }}
        });
        
        $('#email').focusout(function(){
            var email = $('#email').val();
            if(email==''){
             $('#email').addClass('invalid');
                $('#email').removeClass('valid');
                $('#lemail').addClass('text-danger');
                $('#lemail').removeClass('text-success');
                $('#lemail').html('Empty');
            };
            
            if(email != ''){if(email_reg.test(email)){
                 $.ajax({
               url : '../ajax/signup.php',
               method : 'POST',
               data : {
                    signupemail: email,
                },
                success : function(response){
                $("#lemail").html(response);
                    if(response == 'success'){
                         $("#lemail").html("OK");
                        $("#email").addClass("valid");
                        $("#email").removeClass("invalid");
                        $("#lemail").removeClass("text-danger");
                        $("#lemail").addClass("text-success");
                    
                    }else if(response == 'fail'){
                         $("#lemail").html("Already Registered");
                        $("#email").addClass("invalid");
                        $("#email").removeClass("valid");
                        $("#lemail").addClass("text-danger");
                         $("#lemail").removeClass("text-success");
                    
                    }
                    },
                dataType : 'text'
            }
            );             
            } else { 
                $('#email').addClass('invalid');
                $('#email').removeClass('valid');
                $('#lemail').addClass('text-danger');
                $('#lemail').removeClass('text-success');
                $('#lemail').html('Invalid Email address');
                }}
        });
        
        $('#add_btn').click(function(){
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var email = $('#email').val();
    var gender = $('#gender').val();
    var name_reg=/^[a-z]{3,}$/i;
    var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
            
    if(firstname.length == ""){
            $("#firstname").addClass("invalid");
            $("#firstname").removeClass("valid");
            $("#fname").html("Empty");
            $("#fname").removeClass("text-success");
            $("#fname").addClass("text-danger");
     $('#incomplete').show('fast');            
              window.setTimeout(function () { 
          $("#incomplete").hide('fast'); }, 2000);               
            }
        if(lastname.length == ""){
            $("#lastname").addClass("invalid");
            $("#lastname").removeClass("valid");
            $("#lname").html("Empty");
            $("#lname").removeClass("text-success");
            $("#lname").addClass("text-danger");
     $('#incomplete').show('fast');
              window.setTimeout(function () { 
          $("#incomplete").hide('fast'); }, 2000);
            }
        if(email.length == ""){
             $("#email").addClass("invalid");
            $("#email").removeClass("valid");
            $("#lemail").html("Required");
            $("#lemail").removeClass("text-success");
            $("#lemail").addClass("text-danger");
            $('#incomplete').show('fast');
          window.setTimeout(function () { 
            $("#incomplete").hide('fast'); }, 2000);
        }
        if(firstname.length != "" && firstname.length < 3){
            $("#firstname").addClass("invalid");
            $("#firstname").removeClass("valid");
            $("#fname").html("Too Short");
            $("#fname").removeClass("text-success");
            $("#fname").addClass("text-danger");
           $('#incomplete').show('fast');
            window.setTimeout(function () { 
                  $("#incomplete").hide('fast'); }, 2000);
              }
        if(lastname.length != "" && lastname.length < 3){
            $("#lastname").addClass("invalid");
            $("#lastname").removeClass("valid");
            $("#lname").html("Too Short");
            $("#lname").removeClass("text-success");
            $("#lname").addClass("text-danger");
           $('#incomplete').show('fast');
            
              window.setTimeout(function () { 
                            $("#incomplete").hide('fast'); }, 2000);
            
        }
        
     
        if(firstname.length > 2 && lastname.length > 2 && email.length > 2){
            if(name_reg.test(firstname) && name_reg.test(lastname) && email_reg.test(email)){
          gender = $("#gender").val();
            $.ajax({
               url : '../ajax/signup.php',
               method : 'POST',
                dataType: 'text',
               data : {
                signupemail2 : email,
                signupfirstname : firstname,
                signupsurname : lastname,
                signupgender : gender,
                
            },
                success : function(response){
                console.log(response);
                    if(response == 'successful'){
                         $('#add_success').show('fast', function(){
                            fetch_users();
                         });
            
              window.setTimeout(function () { 
                            $("#add_success").hide('fast'); }, 2000);  
                       
                        $('#add_user_form')[0].reset();
                        }else if(response == 'failed'){
                      $('#add_fail').show('fast');
                  window.setTimeout(function () { 
                            $("#add_fail").hide('fast'); }, 2000); 
                        $('#add_user_form')[0].reset();
                        firstname = "";
                        lastname="";
                        email="";
                    }} 
                    });
                }else {
                 $('#incomplete').show('fast');
            
              window.setTimeout(function () { 
                            $("#incomplete").hide('fast'); }, 2000);  
                
            }}; 
         
    });
            
        $('#close').click(function(){
                    location.reload();
                });
        
        $(document).on('click','.update', function(){
            $('#edit_user').modal('show');
            
            var id = $(this).attr('id');
            $.ajax({
                url:'../ajax/update.php',
                method:'POST',
                data:{id:id},
                dataType:'json',
                success:function(data){
//                    $('#action').text("edit");
//                    $('#user_id').val(id);
                    $('#firstname1').val(data.firstname);
                    $('#edit_user1').html(data.firstname);
                    $('#lastname1').val(data.lastname);
                    $('#email1').val(data.email);
                    $('#password1').val(data.password);
                    $('#phonenumber1').val(data.phonenumber);
                    $('#account1').val(data.acc_number);
                    $('#state').val(data.state);
                    $('#gender1').val(data.gender);
                    $('#strikes1').val(data.strikes);
                    $('#email1').val(data.email);
                    $('#user_id1').val(data.user_id);
                    $('#profile_pic1').attr('src','../user/'+data.profilepic);
                   
                },
            })
        });
        
        $('#firstname1').focusout(function(){
            var firstname1 = $('#firstname1').val();
            if(firstname1 ==''){
             $('#firstname1').addClass('invalid');
                $('#firstname1').removeClass('valid');
                $('#fname1').addClass('text-danger');
                $('#fname1').removeClass('text-success');
                $('#fname1').html('Empty');
            };
            
            if(firstname1 != ''){if(name_reg.test(firstname1)){
                $('#firstname1').addClass('valid');
                $('#firstname1').removeClass('invalid');
                $('#fname1').addClass('text-success');
                $('#fname1').removeClass('text-danger');
                $('#fname1').html('Ok');
            } else { 
                $('#firstname1').addClass('invalid');
                $('#firstname1').removeClass('valid');
                $('#fname1').addClass('text-danger');
                $('#fname1').removeClass('text-success');
                $('#fname1').html('Letters Only, more than 2');
                }}
        });
        
        $('#lastname1').focusout(function(){
            var lastname1 = $('#lastname1').val();
            if(lastname1 ==''){
             $('#lastname1').addClass('invalid');
                $('#lastname1').removeClass('valid');
                $('#lname1').addClass('text-danger');
                $('#lname1').removeClass('text-success');
                $('#lname1').html('Empty');
            };
            
            if(lastname1 != ''){if(name_reg.test(lastname1)){
                $('#lastname1').addClass('valid');
                $('#lastname1').removeClass('invalid');
                $('#lname1').addClass('text-success');
                $('#lname1').removeClass('text-danger');
                $('#lname1').html('Ok');
            } else { 
                $('#lastname1').addClass('invalid');
                $('#lastname1').removeClass('valid');
                $('#lname1').addClass('text-danger');
                $('#lname1').removeClass('text-success');
                $('#lname1').html('Letters Only, more than 2');
                }}
        });
        
        $('#email1').focusout(function(){
            var email1 = $('#email1').val();
            if(email1 ==''){
             $('#email1').addClass('invalid');
                $('#email1').removeClass('valid');
                $('#lemail1').addClass('text-danger');
                $('#lemail1').removeClass('text-success');
                $('#lemail1').html('Empty');
            };
            
            if(email1 != ''){if(email_reg.test(email1)){
                 $.ajax({
               url : '../ajax/signup.php',
               method : 'POST',
               data : {
                    signupemail: email,
                },
                success : function(response){
                $("#lemail").html(response);
                    if(response == 'success'){
                         $("#lemail1").html("OK");
                        $("#email1").addClass("valid");
                        $("#email1").removeClass("invalid");
                        $("#lemail1").removeClass("text-danger");
                        $("#lemail1").addClass("text-success");
                    
                    }else if(response == 'fail'){
                         $("#lemail1").html("Already Registered");
                        $("#email1").addClass("invalid");
                        $("#email1").removeClass("valid");
                        $("#lemail1").addClass("text-danger");
                         $("#lemail1").removeClass("text-success");
                    
                    }
                    },
                dataType : 'text'
            }
            );             
            } else { 
                $('#email1').addClass('invalid');
                $('#email1').removeClass('valid');
                $('#lemail1').addClass('text-danger');
                $('#lemail1').removeClass('text-success');
                $('#lemail1').html('Invalid Email address');
                }}
        });
        
        $('#phonenumber1').focusout(function(){
            var phonenumber1 = $('#phonenumber1').val();
            if(phonenumber1 ==''){
             $('#phonenumber1').addClass('invalid');
                $('#phonenumber1').removeClass('valid');
                $('#lphone1').addClass('text-danger');
                $('#lphone1').removeClass('text-success');
                $('#lphone1').html('Empty');
            };
            
            if(phonenumber1 != ''){if(phone_reg.test(phonenumber1)){
                $('#phonenumber1').addClass('valid');
                $('#phonenumber1').removeClass('invalid');
                $('#lphone1').addClass('text-success');
                $('#lphone1').removeClass('text-danger');
                $('#lphone1').html('Ok');
            } else { 
                $('#phonenumber1').addClass('invalid');
                $('#phonenumber1').removeClass('valid');
                $('#lphone1').addClass('text-danger');
                $('#lphone1').removeClass('text-success');
                $('#lphone1').html('Numbers Only, exactly 11');
                }}
        });
        
        $('#password1').focusout(function(){
            var password1 = $('#password1').val();
            if(password1 ==''){
             $('#password1').addClass('invalid');
                $('#password1').removeClass('valid');
                $('#pword1').addClass('text-danger');
                $('#pword1').removeClass('text-success');
                $('#pword1').html('Empty');
            };
            
            if(password1 != ''){if(password_reg.test(password1)){
                $('#password1').addClass('valid');
                $('#password1').removeClass('invalid');
                $('#pword1').addClass('text-success');
                $('#pword1').removeClass('text-danger');
                $('#pword1').html('Ok');
            } else { 
                $('#password1').addClass('invalid');
                $('#password1').removeClass('valid');
                $('#pword1').addClass('text-danger');
                $('#pword1').removeClass('text-success');
                $('#pword1').html('1 Uppercase, 1 LowerCase, 1 Number, Not less than 6');
                }}
        });
        
        $('#account1').focusout(function(){
            var account1 = $('#account1').val();
            if(account1 ==''){
             $('#account1').addClass('invalid');
                $('#account1').removeClass('valid');
                $('#acc_1').addClass('text-danger');
                $('#acc_1').removeClass('text-success');
                $('#acc_1').html('Empty');
            };
            
            if(account1 != ''){if(acc_reg.test(account1)){
                $('#account1').addClass('valid');
                $('#account1').removeClass('invalid');
                $('#acc_1').addClass('text-success');
                $('#acc_1').removeClass('text-danger');
                $('#acc_1').html('Ok');
            } else { 
                $('#account1').addClass('invalid');
                $('#account1').removeClass('valid');
                $('#acc_1').addClass('text-danger');
                $('#acc_1').removeClass('text-success');
                $('#acc_1').html('0-9 Exactly 10');
                }}
        });
       
//    update button click      
        $('#update_btn').click(function(){
        var firstname1 = $('#firstname1').val();
        var lastname1 = $('#lastname1').val();
        var email1 = $('#email1').val();
        var gender1 = $('#gender1').val();
        var phonenumber1 = $('#phonenumber1').val();
        var password1 = $('#password1').val();
        var account1 = $('#account1').val();
        var state_id1 = $('#location1').val();
        var user_id1 = $('#user_id1').val();
        var bank_id1 = $('#bank1').val();
        var strikes1 = $('#strikes1').val();
        var name_reg=/^[a-z]{3,}$/i;
        var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
        var acc_reg=/^[0-9]{10}$/i;
        var phone_reg=/^[0-9]{11}$/i;
        var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;        
        
            if(firstname1.length == ""){
            $("#firstname1").addClass("invalid");
            $("#firstname1").removeClass("valid");
            $("#fname1").html("Empty");
            $("#fname1").removeClass("text-success");
            $("#fname1").addClass("text-danger");
            $('#incomplete1').show('fast');
              window.setTimeout(function () { 
                            $("#incomplete1").hide('fast'); }, 2000);               
        }
        if(lastname1.length == ""){
            $("#lastname1").addClass("invalid");
            $("#lastname1").removeClass("valid");
            $("#lname1").html("Empty");
            $("#lname1").removeClass("text-success");
            $("#lname1").addClass("text-danger");
             $('#incomplete1').show('fast');
          window.setTimeout(function(){ 
                            $("#incomplete1").hide('fast'); }, 2000);
        }
        if(email1.length == ""){
             $("#email1").addClass("invalid");
            $("#email1").removeClass("valid");
            $("#lemail1").html("Required");
            $("#lemail1").removeClass("text-success");
            $("#lemail1").addClass("text-danger");
            $('#incomplete1').show('fast');
          window.setTimeout(function () { 
                            $("#incomplete1").hide('fast'); }, 2000);
        }
        if(firstname1.length != "" && firstname1.length < 3){
            $("#firstname1").addClass("invalid");
            $("#firstname1").removeClass("valid");
            $("#fname1").html("Too Short");
            $("#fname1").removeClass("text-success");
            $("#fname1").addClass("text-danger");
           $('#incomplete1').show('fast');
              window.setTimeout(function () { 
                            $("#incomplete1").hide('fast'); }, 2000);
        }
        if(lastname1.length != "" && lastname1.length < 3){
            $("#lastname1").addClass("invalid");
            $("#lastname1").removeClass("valid");
            $("#lname1").html("Too Short");
            $("#lname1").removeClass("text-success");
            $("#lname1").addClass("text-danger");
           $('#incomplete1').show('fast');
              window.setTimeout(function () { 
                            $("#incomplete1").hide('fast'); }, 2000);
        }
             
        if(firstname1.length > 2 && lastname1.length > 2 && email1.length > 2 && password1.length > 6 && account1.length == 10 && phonenumber1.length == 11 ){
            if(name_reg.test(firstname1) && name_reg.test(lastname1) && email_reg.test(email1) && password_reg.test(password1) && acc_reg.test(account1) && phone_reg.test(phonenumber1)){
          
            $.ajax({
               url : '../ajax/update.php',
               method : 'POST',
                dataType: 'text',
               data : {
                 user_id: user_id1,
                email : email1,
                firstname : firstname1,
                lastname : lastname1,
                gender : gender1,
                  phonenumber : phonenumber1,
                password : password1,
                state_id : state_id1,
                acc_number : account1,
                bank_id : bank_id1,
                strikes : strikes1,
                
            },
                success : function(response){
                console.log(response);
                    if(response == 'successful'){
                         $('#edit_success').show('fast', function(){
                             $('#datatable').DataTable({
                                 'destroy':true,
                             });
                            fetch_users();
                         });
            
              window.setTimeout(function () { 
                            $("#edit_success").hide('fast'); }, 2000);  
                       
                        $('#edit_user_form')[0].reset();
                        firstname1="";
                        lastname1="";
                        email1="";
                         window.setTimeout(function () { 
                            location.reload(); }, 1500);  
                        
                                       
                    }else if(response == 'failed'){
                      $('#add_fail').show('fast');
            
              window.setTimeout(function () { 
                            $("#add_fail").hide('fast'); }, 2000); 
                        $('#edit_user_form')[0].reset();
                        firstname1 = "";
                        lastname1 ="";
                        email1 ="";
                    }} 
                    });
                }else {
                 $('#incomplete1').show('fast');
                  window.setTimeout(function () { 
                            $("#incomplete1").hide('fast'); }, 2000);  
            }}; 
          });

//    view button click
        $(document).on('click','.view', function(){
            $('#view_user').modal('show');
            
            var id = $(this).attr('id');
            $.ajax({
                url:'../ajax/update.php',
                method:'POST',
                data:{viewid:id},
                dataType:'json',
                success:function(data){
                    $('#viewmodaltitle').html(data.firstname +' '+data.lastname);
                    $('#viewname').html(data.firstname +' '+data.lastname);
                    $('#profile_pic2').attr('src','../user/'+data.profilepic);
                    $('#viewemail').html(data.email);
                    $('#viewpassword').html(data.password);
                    $('#viewphone').html(data.phonenumber);
                    $('#viewaccount').html(data.acc_number);
                    $('#viewstate').html(data.state);
                    $('#viewgender').html(data.gender);
                    $('#viewstrikes').html(data.strikes);
                    $('#viewbank').html(data.bank);
                    $('#viewid').html(data.user_id);
                    $('#viewdonbalance').html(data.don_balance);
                    $('#viewrecbalance').html(data.rec_balance);
                    $('#viewtotaldon').html(data.total_don);
                    $('#viewtotalrec').html(data.total_rec);
                    $('#viewsignupdate').html(data.signup_date);
                   
                   
                },
            })
        });
        
//    delete button click
        $(document).on('click','.delete', function(){
			 $('#match_reverse_modal').modal('show');
            var id = $(this).attr('id');
			var action = 'get_for_cancel';
			var rev_don_id = '';
			var rev_rec_id = '';
			var rev_don_user_id = '';
			var rev_rec_user_id = '';
			var rev_match_amount = '';
		$.ajax({
			url:'../ajax/matches.php',
			method:'POST',
			dataType:'json',
			data:{
				match_id:id,
				action:action
			},
			success: function(data){
				console.log(data);
				var match_id = data.match_id;
				$("#revmatch_id").val(data.match_id);
				$("#revmatch_donor_id").val(data.donor_request_id);
				$("#revmatch_donor_user_id").val(data.donor_user_id);
				$("#revmatch_recieve_id").val(data.recieve_request_id);
				$("#revmatch_recieve_user_id").val(data.reciever_user_id);
				$("#revmatch_amount").val(data.matched_amount);
 
			 	rev_don_user_id = data.donor_user_id;
				rev_rec_user_id = data.reciever_user_id;
				rev_don_id = data.donor_request_id;
				rev_rec_id = data.recieve_request_id;
				rev_match_amount = data.matched_amount;
				console.log(rev_don_id+' '+rev_rec_id+' '+rev_don_user_id+' '+rev_rec_user_id+' '+rev_match_amount);
			}			
		})});
		
		$("#reversematch").click(function(){
			
			 var id = $("#revmatch_id").val();
			var action ='reversematch';
			var rev_don_id = $("#revmatch_donor_id").val();
			var rev_rec_id = $("#revmatch_recieve_id").val();
			var rev_don_user_id = $("#revmatch_donor_user_id").val();
			var rev_rec_user_id = $("#revmatch_recieve_user_id").val();
			var rev_match_amount = $("#revmatch_amount").val();
			  $.ajax({
                url:'../ajax/matches.php',
                method: 'POST',
                data:{reverseid:id, 
					 matched_amount:rev_match_amount,
					 reciever_user_id:rev_rec_user_id,
					 reciever_request_id:rev_rec_id,
					 donation_user_id:rev_don_user_id, 
					 donation_request_id:rev_don_id,
					  action:action,
					 },
                success:function(response){
                    console.log(response);
                    if(response == "reversed"){
                        
                        alert('deleted '+id);
                        $("#user"+id).hide('slow');
                    }else if(response=="failed"){
                        alert('could not delete');
                    }else{
                        alert('something else wrong');
                    }
                }
            });

		});
			
		
       
        $("#make_match").click(function(){
            var don_reg = /^[0-9]{4,}$/i;
            var donor_user_id = $('option:selected',"#donor_select").attr('userid');
            var donation_id = $('option:selected',"#donor_select").attr('donid');
            var donation_amount_unmatched = $('option:selected',"#donor_select").attr('value');
            var reciever_user_id = $('option:selected',"#reciever_select").attr('userid');
            var reciever_request_id = $('option:selected',"#reciever_select").attr('recid');
            var reciever_amount_unmatched = $('option:selected',"#reciever_select").attr('value');
            var match_amount = $("#match_amount").val();
            if(match_amount == 0 || match_amount == ''){
                $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Empty');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_empty').show('fast');
              window.setTimeout(function () { 
                            $("#match_empty").hide('fast'); }, 2000);
                console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched+' '+donation_id+' '+reciever_user_id);
               };
           
            if(donor_user_id == reciever_user_id){
                
                $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Same User');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_same_user').show('fast');
              window.setTimeout(function () { 
                            $("#match_same_user").hide('fast'); }, 2000);  
             console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched+' '+donation_id+' '+reciever_user_id);
                
            };

             
            if(don_reg.test(match_amount) && donor_user_id != reciever_user_id){
           console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched+' '+donation_id+' '+reciever_user_id);
                var action = "insert_match";
                          
                          $.ajax({
                              
                              url:'../ajax/matches.php',
                              method:'POST',
                              dataType:'text',
                              data:{
                                  action:action,
                                  match_amount:match_amount,
                                  donation_user_id:donor_user_id,
                                  donation_id: donation_id,
                                  reciever_user_id: reciever_user_id,
                                  recieve_request_id:reciever_request_id,
                            donation_amount_unmatched:donation_amount_unmatched,
                            reciever_amount_unmatched:reciever_amount_unmatched
                                  
                              },
                              success:function(response){
                                  console.log(response);
                                  console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched+' '+donation_id+' '+reciever_user_id);
                                  if(response == "success"){
                                      
                        $("#match_amount").addClass('valid');
                $("#lmatch_amount").removeClass('text-danger');
                $("#lmatch_amount").html('Match OK');
                $("#match_amount").removeClass('invalid');
                $("#lmatch_amount").addClass('text-success');
                $('#match_success').show('fast');
              window.setTimeout(function () { 
                            $("#match_success").hide('fast'); }, 2000);
                  location.reload();                    
                                  }
                                
                                }
        });
                };
           
            
        })
      
        });
    
//      Match Button Click 
        
          
            
        
 </script>
</body>
</html>