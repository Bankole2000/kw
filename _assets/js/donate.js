$(document).ready(function () {
    $('.modal').modal();   

    var donation, consent = "";
    var don_reg = /^[0-9]{4,}$/i;
    var name_reg = /^[a-z]{3,}$/i;
    var email_reg = /^[a-z]+(_|\.)?[a-z0-9]*@[a-z]+\.[a-z]{2,}$/i;
    var password_reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{6,}$/i;
    
//    Donation Validation 
    $("#donation").focusout(function(){
        
        donation = $("#donation").val();
        if(donation.length == ""){
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Empty").removeClass("green-text").addClass("red-text");
            
        donation = "";
        }else if(donation > 200000){
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Maximum = 200000").removeClass("green-text").addClass("red-text");
            
            
        donation = "";
                }else if(donation < 1999){
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Minimum = 2000").removeClass("green-text").addClass("red-text");
            
            
        donation = "";
                }else if(donation > 1999 && donation < 200001 && don_reg.test(donation)){
            
            $("#donation").removeClass("invalid").addClass("valid");
            $("#don").html("OK").removeClass("red-text").addClass("green-text");
            
           
        }else{
            
            $("#donation").removeClass("valid").addClass("invalid");
			$("#don").html("Numbers only").removeClass("green-text").addClass("red-text");
            donation="";
          
            }
        });
//      End Donation Validation 
    
   
//      Donation cancel click
    $("#don_cancel").click(function(){
        $("#don").html("");
            $("#donation").removeClass("valid").removeClass("invalid");
            $("#don").removeClass("green-text").removeClass("red-text");
        $("#don_consent").html("");
            donation="";
        $('#don_request_form')[0].reset();
        Materialize.toast('Donation Cancelled', 1500);
        
    })
//      End of Donation cancel click


	
	
//      Donation agree click
    $("#don_agree").click(function(){
       $("#loader_don").show();
        var donation = $('#donation').val();
		       
        if (donation.length == ""){
            Materialize.toast('Please enter a Donation', 2500);
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Empty").removeClass("green-text").addClass("red-text");
			$("#loader_don").hide();
        };
        
        if(donation != "" && donation < 2000){
            Materialize.toast('Donation too Small', 2500);
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Minimum = 2000").removeClass("green-text").addClass("red-text");
            $("#loader_don").hide();
            };
        if(donation > 200000){
            Materialize.toast('Donation too large', 2500);
            $("#donation").addClass("invalid").removeClass("valid");
            $("#don").html("Maximum = 200000").removeClass("green-text").addClass("red-text");
            $("#loader_don").hide();
            };
        if ($("#consent").is(':checked') == false){
            Materialize.toast('Consent is Required', 2500);
            $("#don_consent").html("Required").removeClass("green-text").addClass("red-text");
			$("#loader_don").hide();
        };
        if ($("#consent").is(':checked') == true){
            $("#don_consent").html("OK").removeClass("red-text").addClass("green-text");
        };
        if (donation != "" && $("#consent").is(':checked') == true && donation > 1999 && donation < 200001 && don_reg.test(donation) == true){
			
            var user_id = $("#user_id").text() ;
            var user_email = $("#user_email").text() ;
            var first_name = $("#first_name").text() ;
            
            $.ajax({
               url : '../ajax/donation.php',
               method : 'POST',
                dataType: 'text',
               data : {
                user_id : user_id,
                user_email : user_email,
                donation : donation,
                first_name : first_name,
                
            },
                success : function(response){
					$("#loader_don").hide();
                console.log(response);
                    if(response = 'successful'){
                         console.log(response);
                        $("#donation").addClass("valid").removeClass("invalid");
                        $("#don").addClass("green-text").removeClass("red-text").html("Request Successful");
                        $("#fname").html(first_name);
                        donation="";
                        $('#don_request_form')[0].reset();
                        Materialize.toast('Request Successful',500,'rounded', function(){
                             $('#don_success').modal('open');
                         });
                                                           
                    }else if(response = 'failed'){
                         console.log(response);
                       Materialize.toast('Request Unsuccessful',2500);
                        donation = "";
                        $('#don_request_form')[0].reset();
                    }
                    },
                }
            );           
            
		 }else if (donation != "" && $("#consent").prop(':checked') == false && donation > 2000 && don_reg.test(donation) == true){
            
            $("#donation").removeClass("invalid").addClass("valid");
			 $("#don").html("OK").removeClass("green-text").addClass("red-text");
            $("#don_consent").html("Required");
            donation="";
                $("#loader_don").hide();
            }
        }       
           
//      End of Donation agree click

    
    );
});
