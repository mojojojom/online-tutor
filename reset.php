<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();
    include('styles.php');

    if(!isset($_GET['request_code']))
    {
        header('Location: index.php');
    }
?>


    <section class="r_reset-pass-wrap">
        <div class="container h-100">
            <div class="r_reset-pass-inner-wrap d-flex align-items-center justify-content-center h-100">
                <div class="r_reset-pass-form-wrap">
                    <h3 class="mb-1 fw-bold">Reset your password</h3>
                    <p class="mb-3">Strong passwords include numbers, letters, and panctuation marks.</p>
                    <form method="POST" class="r_reset-pass-form">
                        <input type="hidden" name="code" id="rcode" value="<?=$_GET['request_code']?>">
                        <div class="mb-3">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="pass" id="fpass" placeholder="New password">
                        </div>
                        <div class="mb-3">
                            <label for="pass">Repeat Password</label>
                            <input type="password" class="form-control" name="rpass" id="spass" placeholder="Repeat new password">
                        </div>
                        <div class="mb-3">
                            <input type="button" class="c-btn c-btn-inline c-btn-primary reset-pass" value="RESET PASSWORD">
                        </div>
                    </form>
                    <div class="mt-5">
                        <a href="/index.php" class="d-flex align-items-center gap-2" style="font-size: 14px;"><i class="fa-solid fa-arrow-left-long"></i> Back to homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
    include('scripts.php');
?>

<script>

    jQuery(($)=> {
        $(document).ready(()=> {
            $('body').on('click', '.reset-pass', (e)=> {
                e.preventDefault();
                
                var fpass = $('#fpass').val();
                var spass = $('#spass').val();
                var rcode = $('#rcode').val();

                if(fpass === '' || spass === '')
                {
                    Swal.fire(
                        'Unable to reset your password.',
                        'Please fill up all fields!',
                        'info'
                    );
                }
                else
                {
                    $.ajax({
                        type: "POST",
                        url: "action.php",
                        data: {fpass:fpass,spass:spass,rcode:rcode,action:'reset_pass'},
                        success: function (response) {
                            if(response === 'success')
                            {
                                Swal.fire(
                                    'Your password has been changed!',
                                    'You can now login with your new password.<br><b>Redirecting you to homepage.</b>',
                                    'success'
                                );
                                setTimeout(() => {
                                    window.location.href="/index.php";
                                }, 5000);
                            }
                            else if(response === 'short_pass')
                            {
                                Swal.fire(
                                    'Your password seems too short!',
                                    'Password must be at least 8 characters long.',
                                    'info'
                                );
                            }
                            else if(response === 'not_matched')
                            {
                                Swal.fire(
                                    'Password doesn\'t matched!',
                                    'Please make sure that all fields matched.',
                                    'info'
                                );
                            }

                            else
                            {
                                Swal.fire(
                                    'Something went wrong!',
                                    'Unable to change your password.<br>Please try again.',
                                    'error'
                                );
                            }
                        }
                    });
                }

            })
        })
    })

</script>