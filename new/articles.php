<?php 
 require_once('../scripts/connect.php');
//get States & Banks
 $stateoptions = "";
 $bankoptions = "";

 $states = "SELECT * FROM states ORDER BY state_id";
 $banks = "SELECT * FROM banks ORDER BY bank_id";


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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles</title>
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
                        <a href="articles.php" class="nav-link active">Articles</a>
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
               <div class="col text-center" style="padding:10px;"><button class="btn btn-success" data-toggle="modal" data-target="#add_article">Add Article</button></div>
               </div></div>
               <div class="container">
                   <div class="row">
                     <h2>News / Updates</h2>
                      <div class="table-responsive">
                  
                  <table class="table table-striped table-hover" id="datatable1">
                      <thead>
                          <tr>
                              <td>ID</td>
                              <td>Title</td>
                              <td>Category</td>
                              <td>Date Added</td>
                              <td>Image Link</td>
                              <td>Article Link</td>
                              <td>Edit</td>
                              <td>View</td>
                              <td>Delete</td>                       
                          </tr>
                      </thead>
                      <tbody id="news">
                          
                      </tbody>
						  </table></div></div> <hr><br>
                  <div class="row">
                     <h2>Information</h2>
                      <div class="table-responsive">
                  <table class="table table-striped table-hover" id="datatable2">
                      <thead>
                          <tr>
                              <td>ID</td>
                              <td>Title</td>
                              <td>Category</td>
                              <td>Date Added</td>
                              <td>Image Link</td>
                              <td>Article Link</td>
                              <td>Edit</td>
                              <td>View</td>
                              <td>Delete</td>                       
                          </tr>
                      </thead>
                      <tbody id="info">
                          
                      </tbody>
						  </table></div></div>
                  
                        
                   </div>
               </div>
           
       </div>
       <div class="countdown"></div>
       <div id="squareWidget"></div> <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" type="text/javascript"></script> <script src="//www.vocalreferences.com/js/squarewidget.min.js" type="text/javascript" id="squareWidgetJs"></script> <script type="text/javascript"> VrSquare.init({ hashurl: 'myyux*8F44%7C%7C%7C3%7Bthfqwjkjwjshjx3htr4ox4xvzfwj%7Cniljy3rns3ox5', identify: '732869721b37519fe48ca4d49ec96376', container: '#squareWidget' }); </script>
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
   
   <div class="modal fade text-dark" id="add_article">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="contactmodaltitle">Add Article</h5>
                   
               </div>
               <div class="modal-body">
                      <div class="alert alert-success fade show" style="display:none;" id="add_success">
                          <strong>Success!</strong> Article Successfully Added 
                      </div>
                         <div class="alert alert-warning fade show" style="display:none;" id="incomplete">
                          <strong>Warning!</strong> Incomplete Details 
                      </div>
                      <div class="alert alert-danger" style="display:none;" id="add_fail">
                           <strong>Sorry!</strong> This email is already registered
                      </div>
                       <form action="" id="add_article_form">
                           <div class="form-group">
                               <label for="atitle">Title <span id="fname"></span></label>
                               <input type="text" class="form-control title" id="atitle" maxlength="20">
                           </div>
                       <div class="form-group">
                               <label for="acontent">Content <span id="lname"></span></label>
						   <textarea type="text" class="form-control content" id="acontent" maxlength="160"></textarea>
                           </div>
                       <div class="form-group">
                               <label for="aalink">Article Link <span id="lemail"></span></label>
                               <input type="text" class="form-control" id="aalink">
                           </div>
                       <div class="form-group">
                               <label for="ailink">Image Link <span id="lemail"></span></label>
                               <input type="text" class="form-control" id="ailink">
                           </div>
                       <div class="form-group">
                               <label for="category">Category</label>
                                 <select class="form-control" name="" id="category">
                                  <option value="info">Information</option>
                                  <option value="news">News / Updates</option>
                              </select>
                              
                          
                           </div>
                       <input type="hidden" id="action" value="a_insert" name="action">
                       </form>
                   </div>
                   <div class="container"><button id="add_article_btn" type='submit' value="submit" class="btn btn-success btn-block">Add Article</button></div>
                   <div class="modal-footer">
                       <button type='submit' value="submit" class="reload btn btn-primary btn-block">Close</button>
                   </div>
           </div>
       </div>
   </div> 
    
   <div class="modal fade text-dark" id="edit_article">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="contactmodaltitle">Edit "<span id="edit_article1" class="text-primary"></span>"</h5>
                   
               </div>
               <div class="modal-body">
                      <div class="alert alert-success fade show" style="display:none;" id="art_edit_success">
                          <strong>Success!</strong> Article Successfully Edited 
                      </div>
                         <div class="alert alert-warning fade show" style="display:none;" id="art_edit_incomplete">
                          <strong>Warning!</strong> Incomplete Details 
                      </div>
                      <div class="alert alert-danger" style="display:none;" id="art_edit_fail">
                           <strong>Sorry!</strong> This email is already registered
                      </div>
                       <form action="" id="edit_article_form">
                           <div class="form-group">
                               <label for="atitle1">Title <span id="fname"></span></label>
                               <input type="text" class="form-control title" id="atitle1" maxlength="20">
                           </div>
                       <div class="form-group">
                               <label for="acontent1">Content <span id="lname"></span></label>
						   <textarea type="text" class="form-control content" id="acontent1" maxlength="160"></textarea>
                           </div>
                       <div class="form-group">
                               <label for="aalink1">Article Link <span id="lemail"></span></label>
                               <input type="text" class="form-control" id="aalink1">
                           </div>
                       <div class="form-group">
                               <label for="ailink1">Image Link <span id="lemail"></span></label>
                               <input type="text" class="form-control" id="ailink1">
                           </div>
                       <div class="form-group">
                               <label for="category1">Category</label>
                                 <select class="form-control" name="" id="category1">
                                  <option value="info">Information</option>
                                  <option value="news">News / Updates</option>
                              </select>
                              
                          
                           </div>
                       <input type="hidden" id="article_id" value="" name="article_id">
                       </form>
                   </div>
                   <div class="container"><button id="update_article_btn" type='submit' value="submit" class="btn btn-success btn-block">Update Article</button></div>
                   <div class="modal-footer">
                       <button id="close" type='submit' value="submit" class="btn btn-primary btn-block reload" data-dismiss="modal">Close</button>
                   </div>
           </div>
       </div>
   </div> 
   
   <div class="modal fade text-dark" id="view_article">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title text-primary" id="viewmodaltitle"></h5>
                   
               </div>
               <div class="modal-body">
                       <div class="container"><img id="view_image" src="" alt="" style="width:400px;">
                       </div>
                   
                       <div class="container">
                       <div class="row">
                       <div class="col-12"><br><h2 id="view_art_title"></h2><br/>
                       <strong>Content: &nbsp;</strong><span id="view_art_content"></span><br/>
                       <strong>Category: &nbsp;</strong><span id="view_art_category"></span><br/>
                       <strong>image Link: &nbsp;</strong><span id="view_art_image"></span><br/>
                       <strong>Article Link: &nbsp;</strong><span id="view_art_link"></span><br/>
                       <strong>Date Added: &nbsp;</strong><span id="view_art_date"></span><br/><br>
                       </div>
                       </div>
                        </div>
                        <div class="container"><a href='http://localhost' target="_blank" id="go_to_article" value="" class="btn btn-primary btn-block">View Article</a></div>
                        </div>
                   
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
    <script type="text/javascript" src="../_assets/js/jquery.countdown.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/bootstrap-maxlength.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/popper.min.js.map"></script>
    <script type="text/javascript" src="../_assets/js/bs/jquery.dataTables.js"></script>

    <script type="text/javascript" src="../_assets/js/bs/dataTables.bootstrap4.js"></script>
    
    <script>
    $(document).ready(function(){
	$('.countdown').countdown('2020/10/10', function(event){
		$(this).html(event.strftime('%D days %H:%M:%S'));
	});	
	
   	$('.content').maxlength({
		alwaysShow: true, 
		validate: false, 
		allowOverMax: false, 
		customMaxAttribute: "160"
		});
	$('.title').maxlength({
		alwaysShow: true, 
		validate: false, 
		allowOverMax: false, 
		customMaxAttribute: "20"
	});
    
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
		
		function fetch_info(){
           var action = "ainfofetch";
            $.ajax({
            url:"../ajax/articles.php",
            method:"POST",
            data:{action:action},
            success:function(info)
            {
                $('#info').html(info);
                $('#datatable2').DataTable({
                    "destroy":true,
                });
            }
            
        }); 
            
        };
        fetch_info();
		
		function fetch_news(){
           var action = "anewsfetch";
            $.ajax({
            url:"../ajax/articles.php",
            method:"POST",
            data:{action:action},
            success:function(news)
            {
                $('#news').html(news);
                $('#datatable1').DataTable({
                    "destroy":true,
                });
            }
            
        }); 
            
        };
        fetch_news();
                
        
        $('#add_article_btn').click(function(){
	var action= "art_insert";
    var atitle = $('#atitle').val();
    var acontent = $('#acontent').val();
    var aalink = $('#aalink').val();
    var ailink = $('#ailink').val();
    var category = $('#category').val();
    var name_reg=/^[a-z]{3,}$/i;
    var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
	var url_reg = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\w]*))?)/; 
            
    if(atitle.length == ""){
            $("#atitle").addClass("invalid").removeClass("valid");
            $("#fname").html("Empty").removeClass("text-success").addClass("text-danger");
     $('#incomplete').show('fast');            
              window.setTimeout(function () { 
          $("#incomplete").hide('fast'); }, 2000);               
            }
        if(acontent.length == ""){
            $("#acontent").addClass("invalid").removeClass("valid");
            $("#lname").html("Empty").removeClass("text-success").addClass("text-danger");
     $('#incomplete').show('fast');
              window.setTimeout(function () { 
          $("#incomplete").hide('fast'); }, 2000);
            }
        if(aalink.length == ""){
             $("#aalink").addClass("invalid").removeClass("valid");
            $("#lemail").html("Required").removeClass("text-success").addClass("text-danger");
            $('#incomplete').show('fast');
          window.setTimeout(function () { 
            $("#incomplete").hide('fast'); }, 2000);
        }
        if(ailink.length == ""){
            $("#ailink").addClass("invalid").removeClass("valid");
            $("#fname").html("Too Short");
            $("#fname").removeClass("text-success");
            $("#fname").addClass("text-danger");
           $('#incomplete').show('fast');
            window.setTimeout(function () { 
                  $("#incomplete").hide('fast'); }, 2000);
              }
              
     
        if(atitle.length > 2 && acontent.length > 2){
            if(url_reg.test(ailink) && url_reg.test(aalink)){
          category = $("#category").val();
            $.ajax({
               url : '../ajax/articles.php',
               method : 'POST',
                dataType: 'text',
               data : {
                title : atitle,
                content : acontent,
                image : ailink,
                link : aalink,
				category: category,
				action:action
                
            },
                success : function(response){
                console.log(response);
                    if(response == 'successful'){
                         $('#add_success').show('fast', function(){
                            fetch_users();
                         });
            
              window.setTimeout(function () { 
                            $("#add_success").hide('fast'); }, 2000);  
                       
                        $('#add_article_form')[0].reset();
                        }else if(response == 'failed'){
                      $('#add_fail').show('fast');
                  window.setTimeout(function () { 
                            $("#add_fail").hide('fast'); }, 2000); 
                        $('#add_article_form')[0].reset();
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
            
        $('.reload').click(function(){
                    location.reload();
                });

// Edit Button Preview Article to update
        $(document).on('click','.update', function(){
            $('#edit_article').modal('show');
            var action = "artgetup";
            var id = $(this).attr('id');
            $.ajax({
				
                url:'../ajax/articles.php',
                method:'POST',
                data:{id:id, 
					 action:action},
                dataType:'json',
                success:function(data){
                    $('#atitle1').val(data.title);
                    $('#edit_article1').html(data.title);
                    $('#acontent1').val(data.content);
                    $('#aalink1').val(data.link);
                    $('#ailink1').val(data.image);
                    $('#category1').val(data.category);
					
                    $('#article_id').val(data.article_id);
                    $('#artimg').attr('src',data.image);
                   
                },
            })
        });
        
// Update Article 
        $('#update_article_btn').click(function(){
	var article_id = $('#article_id').val();
	var action= "art_update";
    var atitle1 = $('#atitle1').val();
    var acontent1 = $('#acontent1').val();
    var aalink1 = $('#aalink1').val();
    var ailink1 = $('#ailink1').val();
    var category1 = $('#category1').val();
	console.log(article_id);
    var name_reg=/^[a-z]{3,}$/i;
    var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
	var url_reg = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\w]*))?)/; 
            
    if(atitle1.length == ""){
            $("#atitle1").addClass("invalid").removeClass("valid");
            $("#fname1").html("Empty").removeClass("text-success").addClass("text-danger");
     $('#art_edit_incomplete').show('fast');            
              window.setTimeout(function () { 
          $("#art_edit_incomplete").hide('fast'); }, 2000);               
            }
        if(acontent1.length == ""){
            $("#acontent1").addClass("invalid").removeClass("valid");
            $("#lname1").html("Empty").removeClass("text-success").addClass("text-danger");
     $('#art_edit_incomplete').show('fast');
              window.setTimeout(function () { 
          $("#art_edit_incomplete").hide('fast'); }, 2000);
            }
        if(aalink1.length == ""){
             $("#aalink1").addClass("invalid").removeClass("valid");
            $("#lemail1").html("Required").removeClass("text-success").addClass("text-danger");
            $('#art_edit_incomplete').show('fast');
          window.setTimeout(function () { 
            $("#art_edit_incomplete").hide('fast'); }, 2000);
        }
        if(ailink1.length == ""){
            $("#ailink1").addClass("invalid").removeClass("valid");
            $("#fname").html("Too Short");
            $("#fname").removeClass("text-success");
            $("#fname").addClass("text-danger");
           $('#art_edit_incomplete').show('fast');
            window.setTimeout(function () { 
                  $("#art_edit_incomplete").hide('fast'); }, 2000);
              }
              
     
        if(atitle1.length > 2 && acontent1.length > 2){
            
          category1 = $("#category1").val();
            $.ajax({
               url : '../ajax/articles.php',
               method : 'POST',
                dataType: 'text',
               data : {
				id: article_id,
                title : atitle1,
                content : acontent1,
                image : ailink1,
                link : aalink1,
				category: category1,
				action:action
                
            },
                success : function(response){
                console.log(response);
                    if(response == 'success'){
                         $('#art_edit_success').show('fast', function(){
                            fetch_users();
                         });
            
              window.setTimeout(function () { 
                            $("#art_edit_success").hide('fast'); }, 2000);  
                       
                        $('#update_article_form')[0].reset();
                        }else if(response == 'failed'){
                      $('#art_edit_fail').show('fast');
                  window.setTimeout(function () { 
                            $("#art_edit_fail").hide('fast'); }, 2000); 
                        $('#update_article_form')[0].reset();
                        firstname = "";
                        lastname="";
                        email="";
                    }} 
                    });
                }else {
                 $('#art_edit_incomplete').show('fast');
            
              window.setTimeout(function () { 
                            $("#art_edit_incomplete").hide('fast'); }, 2000);  
                
            }; 
         
    });
       
//    view button click
        $(document).on('click','.view', function(){
            $('#view_article').modal('show');
            var action = 'artgetview';
            var id = $(this).attr('id');
            $.ajax({
                url:'../ajax/articles.php',
                method:'POST',
                data:{id:id, 
					 action: action},
                dataType:'json',
                success:function(data){
                    $('#viewmodaltitle').html(data.title);
                    $('#view_art_content').html(data.content);
                    $('#view_art_title').html(data.title);
                    $('#view_image').attr('src',data.image);
                    $('#go_to_article').attr('href',data.link);
                    $('#view_art_link').html(data.link);
                    $('#view_art_category').html(data.category);
                    $('#view_art_image').html(data.image);
                    $('#view_art_date').html(data.date);
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