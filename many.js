 if(don_reg.test(match_amount)){
                   if(donor_user_id == reciever_user_id){
                       
                        $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Same User');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_same_user').show('fast');
              window.setTimeout(function () { 
                            $("#match_same_user").hide('fast'); }, 2000);  
              console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched);
                      
                      }else{ if(match_amount > donation_amount_unmatched){
                          
                    $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Higher Than Donation');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_high_donation').show('fast');
              window.setTimeout(function () { 
                            $("#match_high_donation").hide('fast'); }, 2000);        
                   console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched);   
                      }else{if (match_amount > reciever_amount_unmatched){
                          
                          $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Higher Than Request');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_high_request').show('fast');
              window.setTimeout(function () { 
                            $("#match_high_request").hide('fast'); }, 2000);  
                        console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched);
                      }else{
                          
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
                                  console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched);
                                  if(response == "success"){
                                      
                        $("#match_amount").addClass('valid');
                $("#lmatch_amount").removeClass('text-danger');
                $("#lmatch_amount").html('Match OK');
                $("#match_amount").removeClass('invalid');
                $("#lmatch_amount").addClass('text-success');
                $('#match_success').show('fast');
              window.setTimeout(function () { 
                            $("#match_success").hide('fast'); }, 2000); 
                                      
                                  }else if(response == "failed"){
                                      console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched);
                                      
                         $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Database Error');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_failed').show('fast');
              window.setTimeout(function () { 
                            $("#match_failed").hide('fast'); }, 2000);  
                        
                                      
                                  }else if(response == "higher_than_donation") {
                                      console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched);
                                      
                                      $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Higher Than Donation');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_high_donation').show('fast');
              window.setTimeout(function () { 
                            $("#match_high_donation").hide('fast'); }, 2000);  
                                      
                                  }else if(response == "higher_than_reciever"){
                                      console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched);
                                      
                                          $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Higher Than Request');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_high_request').show('fast');
              window.setTimeout(function () { 
                            $("#match_high_request").hide('fast'); }, 2000);  
                                      
                                  }
                              }
                          })
                          
                          
                          
                      }
                          
                      }
                      
                      }
               }else{
                 $("#match_amount").addClass('invalid');
                $("#lmatch_amount").addClass('text-danger');
                $("#lmatch_amount").html('Numbers Only, at least 4');
                $("#match_amount").removeClass('valid');
                $("#lmatch_amount").removeClass('text-success');
                $('#match_empty').show('fast');
              window.setTimeout(function () { 
                            $("#match_empty").hide('fast'); }, 2000);  
                   console.log(match_amount+' '+donation_amount_unmatched+' '+reciever_amount_unmatched);
                
               }