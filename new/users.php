<?php 
 require_once('../scripts/connect.php');
//get States & Banks
 $stateoptions = "";
 $bankoptions = "";

 $states = "SELECT * FROM states ORDER BY state_id";
 $banks = "SELECT * FROM banks ORDER BY bank_id";
 $no_of_users = "SELECT * FROM user_table";

require_once('../scripts/connect.php');
        $result1 = $db->query($states);
        $result2 = $db->query($banks);
        $result3 = $db->query($no_of_users);
        while($row1 = $result1->fetch_array())
        {
            $stateoptions .= '<option value="'.$row1["state_id"].'">'.$row1["state"].'</option>';
        };
        while($row2 = $result2->fetch_array())
        {
            $bankoptions .= '<option value="'.$row2["bank_id"].'">'.$row2["bank"].'</option>';
        };
		$user_count = $result3->num_rows;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
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
                        <a href="users.php" class="nav-link active">Users</a>
                    </li>
                <li class="nav-item">
                        <a href="donations.php" class="nav-link">Donations</a>
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
               <div class="col text-center" style="padding:10px;"><button class="btn btn-success" data-toggle="modal" data-target="#add_user">Add Users</button> &nbsp;<button class="btn btn-warning" data-toggle="modal" data-target="#resetmodal">Reset Users</button> &nbsp; Total Users = <?php echo $user_count;?></div>
               </div></div>
               <div class="container">
                   <div class="row">
                      <div class="table-responsive">
                  <table class="table table-striped table-hover" id="datatable">
                      <thead>
                          <tr>
                              <td>ID</td>
                              <td>Full Name</td>
                              <td>Email</td>
                              <td>Phone Number</td>
                              <td>Gender</td>
                              <td>Date Joined</td>
                              <td>Update</td>
                              <td>View</td>
                              <td>Delete</td>                       
                          </tr>
                      </thead>
                      <tbody id="users">
                          
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
 
 
   <div class="modal fade text-dark" id="resetmodal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="contactmodaltitle">Reset Users</h5>
                   
               </div>
               <div class="modal-body">
                      <p>Reset All Users? This will set all User accounts to zero,  delete all matches and delete all donation and eligibility requests</p>
                      <div class="alert alert-success fade show" style="display:none;" id="reset_success">
                          <strong>Success!</strong> All User Accounts Reset Updated 
                      </div>
                         <div class="alert alert-warning fade show" style="display:none;" id="reset_failed">
                          <strong>Warning!</strong> User Reset Failed 
                      </div>
                          <div class="alert alert-warning fade show" style="display:none;" id="othererror">
                          <strong>Warning!</strong> Something else went wrong 
                      </div>
                      
                   </div>
                   <div class="modal-footer">
                       <button id= "reset_all" class="btn btn-secondary">Reset</button> 
                       <button class="btn btn-primary" data-dismiss = "modal">Cancel</button>
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
                   <div class="container" style="padding-bottom:10px;"><a href='viewuser.php?user_id=' target="_blank" id="viewdetails" value="" class="btn btn-primary btn-block">View Record</a></div>
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
    var phone_reg=/^[0-9]{11}$/i;
    var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
       
        
        function fetch_users(){
           var action = "mini";
            $.ajax({
            url:"../ajax/users.php",
            method:"POST",
            data:{action:action},
            success:function(users)
            {
                $('#users').html(users);
                $('#datatable').DataTable({
                    "destroy":true,
                });
            }
            
        }); 
            
        };
        fetch_users();
                
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
		$('#reset_all').click(function(){
            var action = "reset_all";        
			$.ajax({
				url:"../ajax/matches.php",
				method:'POST',
				dataType:'text',
				data:{action:action},
				success:function(response){
					console.log(response);
					if(response == 'all reset'){
						  $('#reset_success').show('fast');
              window.setTimeout(function () { 
                            $("#reset_success").hide('fast'); }, 2000);   
					} else if(response == 'reset_failed'){
						  $('#reset_failed').show('fast');
              window.setTimeout(function () { 
                            $("#reset_failed").hide('fast'); }, 2000);   
					}else {
						  $('#othererror').show('fast');
              window.setTimeout(function () { 
                            $("#othererror").hide('fast'); }, 2000);   
					}
				}
						
					})
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
                    $('#location1').val(data.state_id);
                    $('#bank1').val(data.bank_id);
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
                 userid: user_id1,
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
                    $('#profile_pic3').attr('src',data.profilepic);
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
                    $('#viewdetails').attr('href','viewuser.php?user_id='+data.user_id);
                   
                    console.log($('#viewdetails').attr('href'));
                   
                },
            })
        });
        
//    delete button click
        $(document).on('click','.delete', function(){
            var id = $(this).attr('id');
        if(confirm("Delete "+id+". Are you Sure?")){
            $.ajax({
                url:'../ajax/update.php',
                method: 'POST',
                data:{deleteid:id},
                success:function(response){
                    console.log(response);
                    if(response == "deleted"){
                        
                        alert('deleted '+id);
                        $("#user"+id).hide('slow');
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
            
        });
 
    
    });       
            
        
 </script>
</body>
</html>