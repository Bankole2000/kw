<?php 
 require_once('../scripts/connect.php');
//get States & Banks
 $stateoptions = "";
 $bankoptions = "";

 $states = "SELECT * FROM states ORDER BY state_id";
 $banks = "SELECT * FROM banks ORDER BY bank_id";
$no_of_dons = "SELECT * FROM donor_request_table WHERE amount_unmatched > 0";
$unmdons = "SELECT SUM(amount_unmatched) AS amount_unmatched FROM donor_request_table";
$offdons = "SELECT SUM(amount_offered) AS amount_offered FROM donor_request_table";
$givdons = "SELECT SUM(amount_given) AS amount_given FROM donor_request_table";
require_once('../scripts/connect.php');
        $result1 = $db->query($states);
        $result2 = $db->query($banks);
        $result3 = $db->query($no_of_dons);
        $result4 = $db->query($unmdons);
        $result5 = $db->query($offdons);
        $result6 = $db->query($givdons);
        while($row1 = $result1->fetch_array())
        {
            $stateoptions .= '<option value="'.$row1["state_id"].'">'.$row1["state"].'</option>';
        };
        while($row2 = $result2->fetch_array())
        {
            $bankoptions .= '<option value="'.$row2["bank_id"].'">'.$row2["bank"].'</option>';
        };
$don_count = $result3->num_rows;

	$res1row = $result4->fetch_array();
	$res2row = $result5->fetch_array();
	$res3row = $result6->fetch_array();
	$unmatched_dons = $res1row['amount_unmatched'];
	$offered_dons = $res2row['amount_offered'];
	$given_dons = $res3row['amount_given'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donations</title>
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
                        <a href="donations.php" class="nav-link active">Donations</a>
                    </li>
                <li class="nav-item">
                        <a href="voas.php" class="nav-link">VoAs</a>
                    </li>
                <li class="nav-item">
                        <a href="matches.php" class="nav-link">Matches</a>
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
   <section>
       <div style="padding-top:100px; padding-bottom:20px;">
           <div><div class="container"><div class="row center">
               <div class="col text-center" style="padding:10px;"><button class="btn btn-success" data-toggle="modal" data-target="#add_user">Add Users</button> &nbsp; Pending Donation Requests = <?php echo $don_count;?> <br> 
               Total Donations Offered = <?php echo $offered_dons;?><br>
               Total Donations Paid = <?php echo $given_dons;?><br>
               Total Donations Unmatched = <?php echo $unmatched_dons;?><br>
               </div>
               </div></div>
               <div class="container">
                   <div class="row">
                      <div class="table-responsive">
                  <table class="table table-striped table-hover" id="datatable">
                      <thead>
                          <tr>
                              <td>ID</td>
                              <td>Donor</td>
                              <td>Email</td>
                              <td>Phone Number</td>
                              <td>Amnt Offered</td>
                              <td>Date Offered</td>
                              <td>Amnt Unmatched</td>
                              <td>Change Amnt</td>
                              <td>View</td>
                              <td>Cancel</td>                       
                          </tr>
                      </thead>
                      <tbody id="donations">
                          
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
  
   <div class="modal fade text-dark" id="add_donation">
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
   
    <div class="modal fade text-dark" id="edit_donation">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="contactmodaltitle">Edit Donation</h5>
                   
               </div>
               <div class="modal-body">
                      
                       <form action="" id="edit_donation_form">
                           <div class="form-group">
                               <label for="donname">Name <span id="fname1"></span></label>
                               <input type="text" class="form-control" id="donname" disabled>
                           </div>
                        <div class="form-group">
                               <label for="donemail">Email <span id="lemail1"></span></label>
                               <input type="text" class="form-control" id="donemail" disabled>
                           </div>
                          <div class="form-group">
                               <label for="donphone">Phone Number </label>
                               <input type="text" class="form-control" id="donphone" disabled>
                           </div>
                              <div class="form-group">
                               <label for="donoldamnt">Old Amount &#8358;</label>
                               <input type="text" class="form-control" id="donoldamnt" disabled>
                           </div>
                              <div class="form-group">
                               <label for="donnewamnt">New Amount &#8358;<span id="donnewamnt1"></span></label>
                               <input type="text" class="form-control" id="donnewamnt">
                           </div>
                         
                       
                       <input type="hidden" id="don_idmod" value="insert">
                       <input type="hidden" id="user_idmod" value="insert">
                        
                       </form>
                       <button id="don_update_btn" class="btn btn-primary btn-block">Update Donation</button>
                   </div>
                   <div class="container">
                       <div class="alert alert-success fade show" style="display:none;" id="don_update_success">
                          <strong>Success!</strong> Donation Successfully Updated 
                      </div>
                         <div class="alert alert-warning fade show" style="display:none;" id="don_update_incomplete">
                          <strong>Warning!</strong> Incomplete Details 
                      </div>
                      <div class="alert alert-warning" style="display:none;" id="don_update_fail">
                           <strong>Oops!</strong> Something went wrong 
                      </div>
                   </div>
                   <div class="modal-footer">
                       <button id="close" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
                   </div>
           </div>
       </div>
   </div>
   
   <div class="modal fade text-dark" id="view_donation">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">Donation from <span id="viewmodaltitle" class="text-primary"></span></h5>
                   
               </div>
               <div class="modal-body">
                       <div class="container"><div class="row"><div class="col-md-6 col-lg-5 col-sm-12"><img id="profile_pic2" src="" alt="" style="width:150px;"><img id="profile_pic3" src="" alt="" style="width:150px;"> </div>
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
                       <div class="container"><div class="row"><div class="container"><div class="col"><h5 style="padding-top:10px;">Details</h5><hr/> </div></div></div>
                       <div class="row">
                       <div class="col-12">
                       <strong>Donation ID:&nbsp; </strong><span id="donation_id1"></span><br/>
                       <strong>Amount Offered:&nbsp; &#8358;</strong><span id="amount_offered1"></span><br/>
                       <strong>Date Offered:&nbsp;</strong><span id="date_offered1"></span><br/>
                       <strong>Amount Matched:&nbsp; &#8358;</strong><span id="amount_matched1"></span><br/>
                       <strong>Amount Unmatched:&nbsp; &#8358;</strong><span id="amount_unmatched1"></span><br/>
                       <strong>Amount Given: &nbsp; &#8358; </strong><span id="amount_given1"></span><br/>
                       <strong>Amount Remaining: &nbsp; &#8358;</strong><span id="amount_remaining1"></span><br/>
                       <strong>Date Matched: &nbsp;</strong><span id="date_matched1"></span><br/>
                       <strong>Notified:&nbsp;</strong><span id="notified1"></span><br/>
                       <strong>Number of matches:&nbsp;</strong><span id="number_of_matches1"></span><br/>
                       <strong>Number Paid:&nbsp;</strong><span id="no_paid1"></span><br/>
                       <strong>Number Confirmed:&nbsp;</strong><span id="no_confirmed1"></span><br/></div>
                       </div>
                        </div></div>
                   <div class="container" style="padding-bottom:10px;"><a href='' target="_blank" id="viewdetails" value="" class="btn btn-primary btn-block">View Record</a></div>
                   <div class="modal-footer">
                       <button id="close" type='submit' value="submit" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
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
    var don_reg=/^[0-9]{4,}$/i;
    var phone_reg=/^[0-9]{11}$/i;
    var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
       
        
        function fetch_donors(){
           var action = "fetch";
            $.ajax({
            url:"../ajax/donations.php",
            method:"POST",
            data:{action:action},
            success:function(donors)
            {
              
                $('#donations').html(donors);
                $('#datatable').DataTable({
                    "destroy":true,
                });
            }
            
        }); 
            
        };
        fetch_donors();
                
        $('#donnewamnt').focusout(function(){
            var donnewamnt = $('#donnewamnt').val();
            if(donnewamnt ==''){
             $('#donnewamnt').addClass('invalid');
                $('#donnewamnt').removeClass('valid');
                $('#donnewamnt1').addClass('text-danger');
                $('#donnewamnt1').removeClass('text-success');
                $('#donnewamnt1').html('Empty');
            };
            
            if(don_reg.test(donnewamnt)){
                if(donnewamnt < 2000)
                {
                $('#donnewamnt').addClass('invalid');
                $('#donnewamnt').removeClass('valid');
                $('#donnewamnt1').addClass('text-danger');
                $('#donnewamnt1').removeClass('text-success');
                $('#donnewamnt1').html('Donation too low');
                }else
                { if(donnewamnt > 200000)
                    {
                     $('#donnewamnt').addClass('invalid');
                $('#donnewamnt').removeClass('valid');
                $('#donnewamnt1').addClass('text-danger');
                $('#donnewamnt1').removeClass('text-success');
                $('#donnewamnt1').html('Donation too High');
                            } 
                    else {$('#donnewamnt').addClass('valid');
                $('#donnewamnt').removeClass('invalid');
                $('#donnewamnt1').addClass('text-success');
                $('#donnewamnt1').removeClass('text-danger');
                $('#donnewamnt1').html('Ok');}}
                
            } else { 
                $('#donnewamnt').addClass('invalid');
                $('#donnewamnt').removeClass('valid');
                $('#donnewamnt1').addClass('text-danger');
                $('#donnewamnt1').removeClass('text-success');
                $('#donnewamnt1').html('Digits only At least 4');
            }
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
        
        $(document).on('click','.change', function(){
            var action= 'check';
            $('#edit_donation').modal('show');
            
            var donid = $(this).attr('id');
            var userid = $(this).attr('value');
            $.ajax({
                url:'../ajax/donations.php',
                method:'POST',
                data:{donid:donid, 
                       userid:userid, 
                     action:action},
                dataType:'json',
                success:function(data){
                    console.log(data);    
                    $('#donname').val(data.firstname+' '+data.lastname);
                    $('#donemail').val(data.email);
                    $('#donphone').val(data.phonenumber);
                    $('#donoldamnt').val(data.amount_offered);
                    $('#don_idmod').val(data.donation_id);
                    $('#user_idmod').val(data.user_id);
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
        $('#don_update_btn').click(function(){
            
        
        var action = "update_donation";
        var user_id = $('#user_idmod').val();
        var don_id = $('#don_idmod').val();
        var donnewamnt = $('#donnewamnt').val();
        var don_reg=/^[0-9]{4,}$/i;
        console.log(user_id+' '+don_id+' '+donnewamnt+' '+action);
              if(donnewamnt ==''){
             $('#donnewamnt').addClass('invalid');
                $('#donnewamnt').removeClass('valid');
                $('#donnewamnt1').addClass('text-danger');
                $('#donnewamnt1').removeClass('text-success');
                $('#donnewamnt1').html('Empty');
            };
            
            if(don_reg.test(donnewamnt)){
                if(donnewamnt < 2000)
                {
                $('#donnewamnt').addClass('invalid');
                $('#donnewamnt').removeClass('valid');
                $('#donnewamnt1').addClass('text-danger');
                $('#donnewamnt1').removeClass('text-success');
                $('#donnewamnt1').html('Donation too low');
                }else
                { if(donnewamnt > 200000)
                    {
                     $('#donnewamnt').addClass('invalid');
                $('#donnewamnt').removeClass('valid');
                $('#donnewamnt1').addClass('text-danger');
                $('#donnewamnt1').removeClass('text-success');
                $('#donnewamnt1').html('Donation too High');
                            } 
                    else {
                        
                        $.ajax({
                           url:'../ajax/donations.php',
                            data:{
                                action:action,
                                  don_update_id:don_id,
                                  user_update_id:user_id,
                                    new_amount:donnewamnt},
                            method:'POST',
                            dataType:'text',
                            success:function(response){
                                console.log(response);
                            }
                        });
                        
                $('#donnewamnt').addClass('valid');
                $('#donnewamnt').removeClass('invalid');
                $('#donnewamnt1').addClass('text-success');
                $('#donnewamnt1').removeClass('text-danger');
                $('#donnewamnt1').html('Ok');}}
                
            } else { 
                $('#donnewamnt').addClass('invalid');
                $('#donnewamnt').removeClass('valid');
                $('#donnewamnt1').addClass('text-danger');
                $('#donnewamnt1').removeClass('text-success');
                $('#donnewamnt1').html('Digits only At least 4');
            }
        
            
          });

//    view button click
        $(document).on('click','.view', function(){
           var action= 'view_donation';
            $('#view_donation').modal('show');
            
            var donid = $(this).attr('id');
            var userid = $(this).attr('value');
            
            $.ajax({
                url:'../ajax/donations.php',
                method:'POST',
                data:{don_view_id:donid, 
                     user_view_id:userid,
                     action:action},
                dataType:'json',
                success:function(data){
                    console.log(data);
                    if(data.notified == 'Not yet notified'){
                         $("#notified1").removeClass('text-danger');  
                      $("#notified1").addClass('text-secondary');  
                    }else if(data.notified == 'Has been notified'){
                      $("#notified1").addClass('text-danger');  
                        $("#notified1").removeClass('text-secondary');  
                    };
                    $('#viewmodaltitle').html(data.firstname +' '+data.lastname);
                    $('#viewname').html(data.firstname +' '+data.lastname);
                    $('#profile_pic2').attr('src','../user/'+data.profilepic);
                    $('#profile_pic3').attr('src',data.profilepic);
                    $('#viewemail').html(data.email);
                    $('#donation_id1').html(data.donation_id);
                    $('#viewphone').html(data.phonenumber);
                    $('#amount_offered1').html(data.amount_offered);
                    $('#viewstate').html(data.state);
                    $('#viewgender').html(data.gender);
                    $('#date_offered1').html(data.date_offered);
                    $('#date_matched1').html(data.date_matched);
                    $('#viewid').html(data.user_id);
                    $('#amount_unmatched1').html(data.amount_unmatched);
                    $('#number_of_matches1').html(data.no_of_matches);
                    $('#no_paid1').html(data.no_paid);
                    $('#no_confirmed1').html(data.no_confirmed);
                    $('#amount_given1').html(data.amount_given);
                    $('#amount_remaining1').html(data.amount_remaining);
                    $('#amount_matched1').html(data.amount_matched);
                    $('#notified1').html(data.notified);
                    $('#viewdetails').attr('href','viewuser.php?user_id='+data.user_id);
                   
                    console.log($('#viewdetails').attr('href'));
                   
                   
                },
            })
        });
        
//    delete button click
        $(document).on('click','.cancel', function(){
            var id = $(this).attr('id');
            var action = 'admincancel';
        if(confirm("Delete "+id+". Are you Sure?")){
            $.ajax({
                url:'../ajax/donations.php',
                method: 'POST',
                data:{deleteid:id,
					 action:action},
                success:function(response){
                    console.log(response);
                    if(response == "deleted"){
                        
                        alert('deleted '+id);
                        $("#donation"+id).hide('slow');
                    }else if(response=="failed"){
                        alert('could not delete');
                    }else{
                        alert('something else wrong');
                    }
                }
            });

        }else{
            alert('You Canceled');
        }
            
//            $('#view_user').modal('show');
//            
//            var id = $(this).attr('id');
//            $.ajax({
//                url:'../ajax/update.php',
//                method:'POST',
//                data:{viewid:id},
//                dataType:'json',
//                success:function(data){
//                    $('#viewmodaltitle').html(data.firstname +' '+data.lastname);
//                    $('#viewname').html(data.firstname +' '+data.lastname);
//                    $('#profile_pic2').attr('src','../user/'+data.profilepic);
//                    $('#viewemail').html(data.email);
//                    $('#viewpassword').html(data.password);
//                    $('#viewphone').html(data.phonenumber);
//                    $('#viewaccount').html(data.acc_number);
//                    $('#viewstate').html(data.state);
//                    $('#viewgender').html(data.gender);
//                    $('#viewstrikes').html(data.strikes);
//                    $('#viewbank').html(data.bank);
//                    $('#viewid').html(data.user_id);
//                    $('#viewdonbalance').html(data.don_balance);
//                    $('#viewrecbalance').html(data.rec_balance);
//                    $('#viewtotaldon').html(data.total_don);
//                    $('#viewtotalrec').html(data.total_rec);
//                    $('#viewsignupdate').html(data.signup_date);
//                   
//                   
//                },
//            })
//            
        });
 
    
    });       
            
        
 </script>
</body>
</html>