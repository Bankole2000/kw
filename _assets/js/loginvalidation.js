$(document).ready(function(){
  
   $('.modal').modal();   
    
    var firstname="";
    var lastname="";
    var email="";
    var gender ="";
    var lemail="";
    var password ="";
    var name_reg=/^[a-z]{3,}$/i;
    var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
    var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
    var dfltpassword = "Password1234";
//    First Name Validation 
    $("#firstname").focusout(function(){
        
        var storefirstname = $("#firstname").val();
        if(storefirstname.length == ""){
            $("#firstname").addClass("invalid");
            $("#firstname").removeClass("valid");
            $("#fname").html("Empty");
            $("#fname").removeClass("green-text");
            $("#fname").addClass("red-text");
            firstname = storefirstname;
//            firstname = "";
        }else if(name_reg.test(storefirstname)){
            
            $("#firstname").removeClass("invalid");
            $("#firstname").addClass("valid");
            $("#fname").html("OK");
            $("#fname").removeClass("red-text");
            $("#fname").addClass("green-text");
            firstname = storefirstname;
           
        }else{
            $("#fname").html("Abc! >2");
            $("#firstname").removeClass("valid");
            $("#firstname").addClass("invalid");
            $("#fname").removeClass("green-text");
            $("#fname").addClass("red-text");
            firstname = storefirstname;
             firstname = "0";
                
            }
        })
//    End of First name Validation 
    
    //    Last Name Validation 
    $("#surname").focusout(function(){
        
        var storelastname = $("#surname").val();
        if(storelastname.length == ""){
            $("#surname").addClass("invalid");
            $("#surname").removeClass("valid");
            $("#sname").html("Empty");
            $("#sname").removeClass("green-text");
            $("#sname").addClass("red-text");
            lastname = storelastname;
//            lastname = "";
        }else if(name_reg.test(storelastname)){
            
            $("#surname").removeClass("invalid");
            $("#surname").addClass("valid");
            $("#sname").html("OK");
            $("#sname").removeClass("red-text");
            $("#sname").addClass("green-text");
            lastname = storelastname;
           
        }else{
            $("#sname").html("Abc! >2");
            $("#surname").removeClass("valid");
            $("#surname").addClass("invalid");
            $("#sname").removeClass("green-text");
            $("#sname").addClass("red-text");
//            lastname = storelastname;
             lastname = "0";
                
            }
        })
//    End of Last name Validation 
    
    //  Signup Email Validation 
    $("#email1").focusout(function(){
        $('#loader_signemail').show();
        var storeemail = $("#email1").val();
        if(storeemail.length == ""){
            $("#email1").addClass("invalid");
            $("#email1").removeClass("valid");
            $("#semail").html("Required");
            $("#semail").removeClass("green-text");
            $("#semail").addClass("red-text");
			$('#loader_signemail').hide();
//            email = "";
        }else if(email_reg.test(storeemail)){
            
            $.ajax({
               url : 'ajax/signup.php',
               method : 'POST',
               data : {
                    signupemail: storeemail,
                },
                success : function(response){
				$('#loader_signemail').hide();
                $("#semail").html(response);
                    if(response == 'success'){
                         $("#semail").html("OK");
                        $("#email1").addClass("valid");
                        $("#email1").removeClass("invalid");
                        $("#semail").removeClass("red-text");
                        $("#semail").addClass("green-text");
                        email = storeemail;
                    }else if(response == 'fail'){
                         $("#semail").html("Already Registered");
                        $("#email1").addClass("invalid");
                        $("#email1").removeClass("valid");
                        $("#semail").addClass("red-text");
                         $("#semail").removeClass("green-text");
                        email = "0";
                    }
                    },
                dataType : 'text'
            }
            );
                       
        }else{
            $("#semail").removeClass("green-text");
            $("#semail").html("Invalid Email");
            $("#email1").removeClass("valid");
            $("#email1").addClass("invalid");
            $("#semail").addClass("red-text");
			$('#loader_signemail').hide();
//             email = "";
                
            }
        })
//    End of signup email Validation
    
    //  Login Email Validation 
    $("#email2").focusout(function(){
        $('#loader_logemail').show();
        var storeemail2 = $("#email2").val();
        if(storeemail2.length == ""){
            $("#email2").addClass("invalid");
            $("#email2").removeClass("valid");
            $("#lemail").html("Please enter your email");
            $("#lemail").removeClass("green-text");
            $("#lemail").addClass("red-text");
			$('#loader_logemail').hide();
//            lemail = "";
        }else if(email_reg.test(storeemail2)){
            
            $.ajax({
               url : 'ajax/login.php',
               method : 'POST',
               data : {
                 loginemail: storeemail2,
                },
                success : function(response){
				$('#loader_logemail').hide();
                $("#lemail").html(response);
                    if(response == 'success'){
                         $("#lemail").html("OK");
                        $("#email2").addClass("valid");
                        $("#email2").removeClass("invalid");
                        $("#lemail").removeClass("red-text");
                        $("#lemail").addClass("green-text");
                    }else if(response == 'fail'){
                         $("#lemail").html("This Email is not registered");
                        $("#email2").addClass("invalid");
                        $("#email2").removeClass("valid");
                        $("#lemail").addClass("red-text");
                         $("#lemail").removeClass("green-text");
                    }
                    },
                dataType : 'text'
            }
            );
                       
        }else{
            $("#lemail").removeClass("green-text");
            $("#lemail").html("Invalid Email");
            $("#email2").removeClass("valid");
            $("#email2").addClass("invalid");
            $("#lemail").addClass("red-text");
			$('#loader_logemail').hide();
//             lemail = "";
                
            }
        })
//    End of login email Validation
    
    //    Password Validation 
    $("#password").focusout(function(){
        
        var storepassword = $("#password").val();
        if(storepassword.length == ""){
            $("#password").addClass("invalid");
            $("#password").removeClass("valid");
            $("#lpassword").html("");
//            password = "";
        }else if(password_reg.test(storepassword)){
            
            $("#password").removeClass("invalid");
            $("#password").addClass("valid");
            $("#lpassword").html("");
           
            password = storepassword;
           
        }else{
            $("#lpassword").html("");
            $("#password").removeClass("valid");
            $("#password").addClass("invalid");
//             password = "";
                
            }
        })
//    End of Password Validation 
    
//    Signup Button onclick
    $("#signupbtn").click(function(){
		$('#loader_signup').show();	
//   Check if fields are empty and alert user
        if(firstname.length == ""){
            $("#firstname").addClass("invalid");
            $("#firstname").removeClass("valid");
            $("#fname").html("Empty");
            $("#fname").removeClass("green-text");
            $("#fname").addClass("red-text");
            Materialize.toast('First Name field is Empty',2500);
			$('#loader_signup').hide();	
//            firstname = ""; 
        }
        if(lastname.length == ""){
            $("#surname").addClass("invalid");
            $("#surname").removeClass("valid");
            $("#sname").html("Empty");
            $("#sname").removeClass("green-text");
            $("#sname").addClass("red-text");
            Materialize.toast('Surname field is Empty',2500);
            $('#loader_signup').hide();	
//            lastname = "";
        }
        if(email.length == ""){
             $("#email1").addClass("invalid");
            $("#email1").removeClass("valid");
            $("#semail").html("Required");
            $("#semail").removeClass("green-text");
            $("#semail").addClass("red-text");
            Materialize.toast('Email field is Required',2500);
			$('#loader_signup').hide();	
//            email = "";
        }
        if(firstname.length != "" && firstname.length < 3){
            $("#firstname").addClass("invalid");
            $("#firstname").removeClass("valid");
            $("#fname").html("Abc! >2");
            $("#fname").removeClass("green-text");
            $("#fname").addClass("red-text");
            Materialize.toast('First Name - Letters Only - not less than 3',2500);
			$('#loader_signup').hide();	
            
        }
        if(lastname.length != "" && lastname.length < 3){
            $("#surname").addClass("invalid");
            $("#surname").removeClass("valid");
            $("#sname").html("Abc! >2");
            $("#sname").removeClass("green-text");
            $("#sname").addClass("red-text");
            Materialize.toast('SurName - Letters Only - not less than 3',2500);
			$('#loader_signup').hide();	
            
            
        }
        
//        
        if(firstname.length > 2 && lastname.length > 2 && email.length > 2){
		
          gender = $("#gender").val();
          var sfirstname = $("#firstname").val();
            $.ajax({
               url : 'ajax/signup.php',
               method : 'POST',
                dataType: 'text',
               data : {
                signupemail2 : email,
                signupfirstname : firstname,
                signupsurname : lastname,
                signupgender : gender,
                
            },
                success : function(response){
					$('#loader_signup').hide();	
                console.log(response);
                    if(response == 'successful'){
						
                         Materialize.toast('Registeration Successful',500, 'rounded', function(){
                             $('#modal1').modal('open');
                            
                         });
                        
                        $('#signupform')[0].reset();
                        $("#successname").html(sfirstname);
                        firstname="";
                        lastname="";
                        email="";
 //                       
                    }else if(response == 'failed'){
                       Materialize.toast('This Email is already Registered',2500);
                        firstname = "";
                        lastname="";
                        email="";
                    }
                    },
                }
            ); 
         
    }
    })
//    End of Signup Button onclick
    
        
    //    Login Button onclick
    $("#loginbtn").click(function(){
       $('#loader_login').show();	
        var loginemail2 = $('#email2').val();
        var loginpassword = $('#password').val();
        
        if (loginemail2.length == ""){
            Materialize.toast('Please enter your Email', 2500);
            $("#email2").addClass("invalid");
            $("#email2").removeClass("valid");
            $("#lemail").html("Please enter your email");
            $("#lemail").removeClass("green-text");
            $("#lemail").addClass("red-text");
			$('#loader_login').hide();	
        };
        
        if(loginpassword.length == ""){
            Materialize.toast('Please enter your Password', 2500);
            $("#password").addClass("invalid");
            $("#password").removeClass("valid");
            $("#lpassword").html("Enter your password");
            $("#lpassword").removeClass("green-text");
            $("#lpassword").addClass("red-text");
			$('#loader_login').hide();	
            
            };
        if (loginpassword.length != "" && loginpassword.length < 6){
            Materialize.toast('Password is too short', 2500);
            $("#password").addClass("invalid");
            $("#password").removeClass("valid");
            $("#lpassword").html("Password too short");
            $("#lpassword").removeClass("green-text");
            $("#lpassword").addClass("red-text");
			$('#loader_login').hide();	
            };
        
        if (loginemail2.length != "" && loginpassword.length > 5){
            if(email_reg.test(loginemail2)){
            if(password_reg.test(loginpassword)){
				
                
                $.ajax({
            method: 'POST',
            url: 'ajax/login.php',
            dataType: 'JSON',
            data: {
                loginemail2 : loginemail2,
                loginpassword : loginpassword, 
                        
            },
            success: function(data){
				$('#loader_login').hide();	
                console.log(data);
                if(data != ""){
                    if(loginpassword == dfltpassword){
                        $("#loginname").html(data.first_name);
                        $("#lpassword").html("");
                         Materialize.toast('Login Successful',500,'rounded', function(){
                             $('#modal2').modal('open');
                         });
                    }else if(loginpassword != dfltpassword){
                        $("#loginname2").html(data.first_name);
                        $("#lpassword").html("");
                         Materialize.toast('Login Successful',500,'rounded', function(){
                             $('#modal3').modal('open');
                         });
                    };
                    
                   
                                              
                        $('#loginform')[0].reset();
                        firstname="";
                        lastname="";
                        email="";
                };
                if(data == ""){
					
					Materialize.toast('Wrong Email & Password', 1500);
                    $("#password").addClass("invalid");
                    $("#password").removeClass("valid");
                    $("#lpassword").html("Wrong Password");
            $("#lpassword").removeClass("green-text");
            $("#lpassword").addClass("red-text");
                    $("#lemail").html("");
            $("#lemail").removeClass("green-text");
            $("#lemail").addClass("red-text");
           
					
                };
            }
        })
                
            }else{
				$('#loader_login').hide();	
				 Materialize.toast('Incorrect Email & Password', 2500);
                $("#password").addClass("invalid");
                $("#password").removeClass("valid");
                $("#lpassword").html("Wrong Password");
            $("#lpassword").removeClass("green-text");
            $("#lpassword").addClass("red-text");
                }
            
        }else{
			$('#loader_login').hide();	
            Materialize.toast('Invalid Email', 2500);
            $("#lemail").html("Invalid Email");
            $("#lemail").removeClass("green-text");
            $("#lemail").addClass("red-text");
        }
        }
        

    })
//    End of Login Button onclick
	
	
    
    
    });
    
    
