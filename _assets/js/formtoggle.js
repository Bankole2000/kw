$(document).ready(function(){
    $('.formsignup').click(function(){
         $('.logincover').hide(500);
        $('.logincover').fadeOut(400);
        $('.signupcover').show(500);
        $('.signupcover').fadeIn(600);
    });
    $('.formlogin').click(function(){
         $('.logincover').show(500) ;
        $('.logincover').fadeIn(600) ;
        $('.signupcover').hide(500);
        $('.signupcover').fadeOut(400);
    });
   
}); 