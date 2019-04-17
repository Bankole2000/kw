$(document).ready(function(){
    alert("users js is working");
    $('.modal').modal();   
  //  $('.tap-target').tapTarget();
 //      $('.tap-target').tapTarget('open');
    $(".table-sm").dataTable();
 
    
    
    fetch_users();
    
    function fetch_users()
    {
     var action = "fetch";
        $.ajax({
            url:"../ajax/users.php",
            method:"POST",
            data:{action:action},
            success:function(users)
            {
                $('#users').html(users);
          
            }
            
        })
    };
    fetch_users();
    
    $('#add_users_btn').click(function(){
        $('#add_user_form')[0].reset();
//        $('#add_bank_form')[0].reset();
        
    });
    
    
    // add Bank Form submit
    $('#add_bank_form').submit(function(event){
        event.preventDefault();
        var bank_name = $('#bank_name').val();
        var image = $('#image').val();
        if(bank_name == '' || image == '')
            {
                Materialize.toast('Incomplete Details', 1500);
                return false;
            }
        else
            {
               var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                    {
                         Materialize.toast('Invalid Image Format', 1500);
                        $('#image').val('');
                return false;
                    }
                else
                    {
                        $.ajax({
                            url:'../ajax/users.php',
                            method:'POST',
                            data: new FormData(this),
                            contentType:false,
                            processData:false, 
                            success:function(data)
                            {
                                Materialize.toast(data, 1500);
                                $('#add_bank_form')[0].reset();
                                fetch_users();
                                
                            }
                            
                        })
                    }
            };
    });
    
    var firstname = $('#firstname').val();
    var lastname = $('#surname').val();
    var email = $('#email1').val();
    var gender = $('#gender').val();
    var name_reg=/^[a-z]{3,}$/i;
    var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
    var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
    
    
    
//  first name validation
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
        
        var storeemail = $("#email1").val();
        if(storeemail.length == ""){
            $("#email1").addClass("invalid");
            $("#email1").removeClass("valid");
            $("#semail").html("Required");
            $("#semail").removeClass("green-text");
            $("#semail").addClass("red-text");
//            email = "";
        }else if(email_reg.test(storeemail)){
            
            $.ajax({
               url : '../ajax/signup.php',
               method : 'POST',
               data : {
                    signupemail: storeemail,
                },
                success : function(response){
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
//             email = "";
                
            }
        })
//    End of signup email Validation
    
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
//        alert('youclicked me');
//   Check if fields are empty and alert user
        if(firstname.length == ""){
            $("#firstname").addClass("invalid");
            $("#firstname").removeClass("valid");
            $("#fname").html("Empty");
            $("#fname").removeClass("green-text");
            $("#fname").addClass("red-text");
            Materialize.toast('First Name field is Empty',2500);
//            alert('First Name is empty');
//            firstname = ""; 
        }
        if(lastname.length == ""){
            $("#surname").addClass("invalid");
            $("#surname").removeClass("valid");
            $("#sname").html("Empty");
            $("#sname").removeClass("green-text");
            $("#sname").addClass("red-text");
            Materialize.toast('Surname field is Empty',2500);
            
//            lastname = "";
        }
        if(email.length == ""){
             $("#email1").addClass("invalid");
            $("#email1").removeClass("valid");
            $("#semail").html("Required");
            $("#semail").removeClass("green-text");
            $("#semail").addClass("red-text");
            Materialize.toast('Email field is Required',2500);
//            email = "";
        }
        if(firstname.length != "" && firstname.length < 3){
            $("#firstname").addClass("invalid");
            $("#firstname").removeClass("valid");
            $("#fname").html("Abc! >2");
            $("#fname").removeClass("green-text");
            $("#fname").addClass("red-text");
            Materialize.toast('First Name - Letters Only - not less than 3',2500);
//            alert('First Name is empty');
            
        }
        if(lastname.length != "" && lastname.length < 3){
            $("#surname").addClass("invalid");
            $("#surname").removeClass("valid");
            $("#sname").html("Abc! >2");
            $("#sname").removeClass("green-text");
            $("#sname").addClass("red-text");
            Materialize.toast('SurName - Letters Only - not less than 3',2500);
            
            
        }
        
//        
        if(firstname.length > 2 && lastname.length > 2 && email.length > 2){
          gender = $("#gender").val();
          var sfirstname = $("#firstname").val();
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
                    if(response = 'successful'){
                         Materialize.toast('Registeration Successful',500, 'rounded');
                        fetch_users();
                        $('#add_user_form')[0].reset();
                                                             
                    }else if(response = 'failed'){
                       Materialize.toast('This Email is already Registered',2500);
                        firstname = "";
                        lastname="";
                        email="";
                    }
                    },
                }
            ); 
         
    }
    });
//    End of Signup Button onclick
    
// add User Form submit
    $('#add_user_form').submit(function(event){
        event.preventDefault();
    var firstname = $('#firstname').val();
    var lastname = $('#surname').val();
    var email = $('#email1').val();
    var gender = $('#gender').val();
    var password = $('#password').val();
    var phone_number = $('#phone_number').val();
    var acc_number = $('#acc_number').val();
    var bank = $('#bank').val();
    var location = $('#location').val();
    
    var name_reg=/^[a-z]{3,}$/i;
    var acc_reg=/^[0-9]{10}$/i;
    var phone_reg=/^[0-9]{11}$/i;
    var email_reg=/^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
    var password_reg=/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
        if(firstname == '' || lastname == '' || email == ''|| gender == '' || password == '' || phone_number == '' || acc_number == '' || bank == '' || location == '' )
            {
                Materialize.toast('Incomplete Details', 1500);
                return false;
            }
        else if (name_reg.test(firstname) && name_reg.test(lastname) && email_reg.test(email) && acc_reg.test(acc_number) && phone_reg.test(phone_number) && password_reg.test(password) && bank != '' && location != '' && gender != '')
            {  
                    $.ajax({
                            url:'../ajax/users.php',
                            method:'POST',
                            data: new FormData(this),
                            contentType:false,
                            processData:false, 
                            success:function(data)
                            {
                                Materialize.toast(data, 1500);
                                $('#add_user_form')[0].reset();
                                fetch_users();
                            }
                        });
            }
        
        else {
            Materialize.toast('Incomplete Details', 1500);
                return false;
            };
            });
    
   

  });

