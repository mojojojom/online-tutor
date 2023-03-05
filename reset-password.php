<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();
    include('styles.php');
    ?>
    
    <section class="r_reset-wrap">
        <div class="container h-100">
            <div class="r_reset-inner-wrap d-flex align-items-center justify-content-center h-100">
                <div class="r_reset-form-wrap">
                    <div class="r_reset-logo-wrap text-center">
                        <a href="index.php" class="fw-bold">LOGO</a>
                    </div>
                    <form id="reset_form" class="r_reset-form">
                        <p>Enter the email address associated with your account and we'll send you a link to reset your password.</p>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email_placeholder" placeholder="Enter your email" required>
                        </div>
                        <div class="r_reset-btn-wrap">
                            <input type="button" class="c-btn c-btn-primary c-btn-inline check_email_btn mb-1" value="Continue">
                            <p class="text-danger text-center not-received">Resend link in <span class="fw-bold countdown-timer">1:00</span> minute</p>
                        </div>
                    </form>
                    <div class="r_reset-signup-label text-center">
                        <p class="mb-0">Don't have an account?</p>
                        <p class="r_reset-signup-links fw-semibold"><a href="register.php?type=tutor">Sign up as a Tutor</a> | <a href="register.php?type=tutee">Sign up as a Tutee</a></p>
                    </div>
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

            $('.not-received').hide();

            $('body').on('click', '.check_email_btn',(e)=> {
                e.preventDefault();

                let email = $('#email_placeholder').val();

                if(email === '')
                {
                    Swal.fire(
                        'Unable to send reset email',
                        'Please enter your Email!',
                        'info'
                    );
                }
                else
                {
                    $.ajax({
                        type: "POST",
                        url: "action.php",
                        data: {email: email, action:'check_email'},
                        success: function (response) {
                            if (response === 'success') {
                                $('.not-received').show();
                                var countDownTime = 60;
                                function startCountDown() {
                                    countDownTime--;
                                    var minutes = Math.floor(countDownTime / 60);
                                    var seconds = countDownTime % 60;
                                    $('.countdown-timer').text(minutes + ':' + (seconds < 10 ? '0' : '') + seconds);
                                    if (countDownTime == 0) {
                                        clearInterval(timer);
                                        $('.not-received').addClass('d-none');
                                        $('.check_email_btn').prop('disabled', false);
                                    }
                                }
                                var timer = setInterval(startCountDown, 1000);
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                })
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Reset password link has been sent to your email.'
                                })
                                $('.check_email_btn').attr('disabled', true).addClass('bg-secondary border border-1 border-bg-secondary').val('Code sent');
                                setTimeout(function(){
                                    $('.check_email_btn').attr('disabled', false).removeClass('bg-secondary border border-1 border-bg-secondary').val('Resend');
                                }, 60000);
                            }
                            else if(response === 'err_exists')
                            {
                                Swal.fire(
                                    'Unable to process your request.',
                                    'User doesn\'t exists!',
                                    'error'
                                );
                            }
                            else
                            {
                                Swal.fire(
                                    'Unable to process your request at the moment.',
                                    'Please try again later.',
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