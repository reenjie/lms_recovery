<form action="{{route('changepass')}}" method="POST">
    @csrf
    <div class="container">
        <h5>
           <span class="text-success">We have successfully verified your account.</span> 
            <br>
            <span style="font-size:15px" >Please provide a new password</span>
        </h5>
    
        <input type="password" name="newpass" autofocus required class="form-control form-control-lg" id="passnew" placeholder="Enter new password">
        <div id="restrict">
                                                         
            <div class="card">
                      <div class="container">
                         <ul>
                            <li id="upper">Must have Uppercase _Ex.(ABCDEFGHI)</li>  
                            <li id="lower">Must have a Lowercase _Ex. (abcdefghi)</li>
                            <li id="numb">Must have a Number _Ex.(123456789)</li>
                            <li id="chara">Must have at Least 8 Characters _Ex.(********)</li>
                         </ul>
                         
                      </div>     
                </div> 
                 <br>
                 </div> 
        <br>
        <input type="password" class="form-control form-control-lg" required id="repass" disabled placeholder="Re-Enter Password">
        <div id="pregmatch"></div> 
        <br>
        <button class="btn btn-danger btn-lg mt-4 mb-5 px-4" id="btnsavepass" disabled type="submit" style="float: right; font-size:17px;font-weight:bold"> SAVE PASSWORD</button>
     </div>
</form>
 @php
   //  session()->flush()
 @endphp

 <script>
         $('#passnew').keyup(function(){ 
                              var passval = $(this).val();

                              if(passval == '') {
                                    $('#numb').removeClass('d-none');
                                      $('#lower').removeClass('d-none');
                                       $('#upper').removeClass('d-none');
                                        $('#chara').removeClass('d-none');
                                         $('#restrict').removeClass('d-none');
                                         $('#repass').attr('disabled',true);
                              }else {
                                
                                   var lowerCaseLetters = /[a-z]/g;
                                   var upperCaseLetters = /[A-Z]/g;
                                    var numbers = /[0-9]/g;
                                   
                                     if(passval.match(lowerCaseLetters) && passval.match(upperCaseLetters) &&  passval.match(numbers) && passval.length >= 8 ) {
                                          $('#restrict').addClass('d-none');
                                          $('#repass').removeAttr('disabled');
                                        $('#repass').attr('required',true);
                                    }else {
                                       $('#restrict').removeClass('d-none');

                                     if(passval.match(lowerCaseLetters)) {
                                        $('#lower').addClass('d-none');
                                    }else {
                                        $('#lower').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                          if(passval.match(upperCaseLetters)) {
                                        $('#upper').addClass('d-none');
                                    }else {
                                        $('#upper').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                         if(passval.match(numbers)) {
                                        $('#numb').addClass('d-none');
                                    }else {
                                        $('#numb').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                       if(passval.length >= 8) { 
                                       $('#chara').addClass('d-none');
                                      
                                    }else {
                                         $('#chara').removeClass('d-none');
                                         $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    }

                                   

                              }
                              
                         })

                    
                         $('#repass').keyup(function(){ 
                              var valuenew = $('#passnew').val();
                              var reentervalue = $(this).val();

                              if(valuenew == reentervalue) {
                                   $('#pregmatch').html('<span style="color: Green">Password Match <i class="fas fa-check-circle"></i></span>');
                                  
                                 
                                   $('#btnsavepass').removeAttr('disabled');

                              } else {
                                    $('#pregmatch').html('<span style="color: red">Password does not Match <i class="fas fa-times-circle"></i> </span>');
                                     $('#btnsavepass').attr('disabled',true);
                              }    


                         })  
 </script>