@extends('layouts.base')
@section('mainContent')
<style>
    .disabled {
    background: gray;
    }
</style>
<div class="container">
    <div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow mt-5"> 
            <div class="card-body">
                <img style="width: 80px;float: right;" src="http://moodle.webhop.info/pluginfile.php/1/core_admin/logo/0x200/1694227863/msu-sulu.png" alt="">
             
                <form action="return false" id="submitvalidation">
               <div class="container p-5">
                <h6 style="font-weight:normal">MSU SULU-Learning Management System</h6>
               
                <h3>Password Recovery</h3>
               
                <h6 style="font-weight:normal">Enter any of the following:</h6>
                <div class="alert alert-dismissible fade show d-none" id="alert" role="alert">
                  <span id="message"></span>
                    <button type="button" class="btn-close"  id="alertclose" aria-label="Close"></button>
                  </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <h5 class="textLabel" >Email</h5>
                    </div>
                    <div class="col-md-8">
                        <input type="email" name="email" id="email" class="form-control form-control-lg inputs">
                    </div>
                    
                    <span> OR</span>

                    <div class="col-md-4">
                        <h5 class="textLabel">Username</h5>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="username" id="username" class="form-control form-control-lg inputs">
                    </div>

                    <div class="col-md-12">
                      
                    </div>
                </div>  
                <button class="btn btn-danger btn-lg mt-4 mb-5 " type="submit" style="float: right; font-size:17px;font-weight:bold"> SUBMIT</button>

               </div> </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
      $('#submitvalidation').on('submit',function(e){
        e.preventDefault();
        var email = e.target.email.value;
        var username = e.target.username.value;
        if(!email && !username){
            $('#alert').removeClass('d-none').addClass('alert-danger');
            $('#message').text('PLEASE ENTER ANY OF THE FOLLOWING');
            $('.inputs').addClass('is-invalid');
            return;
        }

        $.ajax({
        url:"{{route('verifyemailUsername')}}",
        method: 'POST',
        data: {
            email:email,
            username:username,
            _token:"{{csrf_token()}}"
        },
        success: function (data) {
         alert(data);
        },
        error: function (xhr, status, error) {
            // Handle errors
            console.error('AJAX request failed:', status, error);
        }
        });

      })

      $('#email').keyup(function(){
        var val = $(this).val();
    
        if (val == '') {
        $('#username').removeAttr('disabled');
        }else {
        $('#username').attr('disabled',true);
        }
      })

      $('#username').keyup(function(){
        var val = $(this).val();
    
        if (val == '') {
        $('#email').removeAttr('disabled');
        }else {
        $('#email').attr('disabled',true);
        }
      })
      $('#alertclose').click(function(){
        $('#alert').addClass('d-none').removeClass('alert-danger');
            $('#message').text('');
            $('.inputs').removeClass('is-invalid');
      })
    })
</script>
@endsection