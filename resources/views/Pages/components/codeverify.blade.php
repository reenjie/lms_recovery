
<h5>We have successfully verified your account and have sent a reset code to your registered email.</h5>
<h6 style="font-size:14px;color:maroon" class="mt-3">Kindly provide the reset code below to change your password.</h6>
<br>
<input type="text" class="form-control form-control-lg" id="code" maxlength="6" style="text-align: center" autofocus placeholder="******" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
<div class="invalid-feedback">
    Invalid Reset Code
</div>

<script>
$('#code').keyup(function() {
    var code = $(this).val();

    $(this).removeClass('is-invalid');
    if (code.length === 6) {
        $.ajax({
        url:"{{route('verifyresetCode')}}",
        method: 'POST',
        data: {
            entryCode:code,
            _token:"{{csrf_token()}}"
        },
        success: function (data) {
            const res = data.message;
           switch (res) {
            case 'doesnotmatch':
               $('#code').addClass('is-invalid');
            break;
           
            case 'match':
            $('#code').addClass('is-valid');
            setTimeout(() => {
                location.reload();
            }, 2000);
                //
            break;
           
           }
        },
        error: function (xhr, status, error) {
            // Handle errors
            console.error('AJAX request failed:', status, error);
        }
        });

     return;
    }

    
});
</script>
