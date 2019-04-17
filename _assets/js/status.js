$(document).ready(function(){
    alert("status js is working");
  //  $('.tap-target').tapTarget();
 //      $('.tap-target').tapTarget('open');
    
    function status_check()
    {
     var firstname = $('#first_name').text();
     var email = $('#user_email').text() ;
     var user_id = $('#user_id').text();
     var password = $('#password').text();
     var acc_number = $('#acc_number').text();
     var profile_pic = $('#profile_pic').text();
     var phone_number = $('#phone_number').text();
     var bank_id = $('#bank_id').text();
     var state_id = $('#state_id').text();
//     var acc_number = ;
//     var acc_number = ;
//     var acc_number = ;
//     var acc_number = ;
//     var acc_number = ;
//     var acc_number = ;
//     var acc_number = ;
    var details = user_id + ' ' + firstname + ' ' + email + ' ' + password;
        $('#gotten_details').html(details);
        if(bank_id == '' || password == '' || state_id == '' || profile_pic == ''|| phone_number == '' || acc_number == ''){
            $('#quick_menu').addClass('pulse');
            $('#profile').addClass('pulse');
            $('#profile2').addClass('pulse');
            $('.profile_note').addClass('new badge');
            $('.profile_note').html('Incomplete');
            
        }; 
     }
    status_check();
    
  });