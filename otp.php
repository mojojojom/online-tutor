<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();
    
    include('header.php');
    if(empty($_SESSION['email']))
    {
        header('Location: index.php');
    }
    else
    {
?>

    <section class="sec-pad" style="height: 100vh;">
        <div class="container">

            <div class="row mt-5">

                <div class="d-flex justify-content-center align-items-center">
                    <div class="d-inline">
                        <!-- MESSAGE -->
                        <div class="alert alert-success fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                            PLEASE ENTER THE VERIFICATION CODE THAT WAS SENT TO <?=$_SESSION['email']?>.
                        </div>
                    </div>
                </div>

                <div class="col-lg-4"></div>
                <div class="col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" id="otp-form">
                                <div class="mb-3">
                                    <label for="vcode" class="form-label mb-1">Verification Code</label>
                                    <input type="number" class="form-control" name="vcode" placeholder="Enter code" required>
                                </div>
                                <input type="hidden" name="action" value="verify_account">
                                <input type="submit" id="vcode-btn" class="c-btn c-btn-primary c-btn-inline" value="CONFIRM">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
                <!-- <div class="d-flex justify-content-center align-items-center">
                    <div class="d-inline">
                        <p class="mb-0">Didn't Received Verification Code?</p>
                        <p class="mb-0 text-center"><a href="#" id="tutee-resend-code" class="t-primary fw-semibold">RESEND CODE</a> or <a href="#"class="t-primary fw-semibold">CONTACT US</a></p>
                    </div>
                </div> -->

            </div>

        </div>
    </section>

<?php
    }
    include('footer.php');
?>

<script>

    jQuery(function($) {
        $(document).ready(function () {
            
            $('#otp-form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: formData,
                    success: function (response) {
                        if(response === 'success_tutor')
                        {
                            // SHOW STATUS
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Your account has been verified!'
                            })

                            // REDIRECT TO PROFILE
                            setTimeout(() => {
                                window.location.href='dashboard.php'
                            }, 1500);
                        }
                        else if(response === 'success_tutee')
                        {
                            // SHOW STATUS
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Your account has been verified!'
                            })

                            // REDIRECT TO PROFILE
                            setTimeout(() => {
                                window.location.href='profile.php'
                            }, 1500);
                        }
                        else if(response === 'err_verify')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable to Verify Your Account.',
                                'error'
                            );
                        }
                        else if(response === 'err_code')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Invalid Code.',
                                'error'
                            );
                        }
                        else if(response === 'err_user')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'User Doesn\'t Exists.',
                                'error'
                            );
                        }
                        else
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable to Verify Your Account.',
                                'error'
                            );
                        }
                    }
                });

            })

        })
    })

</script>