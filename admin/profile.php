<?php
    include('header.php');
?>

        <!-- SIDEBAR -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- End Dashboard Nav -->

                <li class="nav-heading">Users</li>

                <li class="nav-item">
                    <a class="nav-link" href="tutors.php">
                        <i class="bi bi-person"></i>
                        <span>Tutors</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="tutees.php">
                        <i class="bi bi-person"></i>
                        <span>Tutees</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="courses.php">
                    <i class='bi bi-book'></i>
                        <span>Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="schedules.php">
                    <i class='bi bi-calendar-event'></i>
                        <span>Tutor Schedules</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointments.php">
                    <i class='bi bi-calendar-check' ></i>
                        <span>Appointments</span>
                    </a>
                </li>
                <!-- End Error 404 Page Nav -->

            </ul>
        </aside>

        <!-- MAIN PAGE -->
        <main id="main" class="main main-wrap">
            <div class="pagetitle">
                <h1>Your Profile</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div>

            <section class="section dashboard">

                <?php
                $get_profile = mysqli_query($db, "SELECT * FROM admin WHERE id = '{$_SESSION['admin_id']}'");
                $row = mysqli_fetch_assoc($get_profile);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" id="edit_admin_form">
                                    <div class="row">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h5 class="fw-bold mb-0">ADMIN INFO</h5>
                                            <button class="btn btn-primary btn-sm fw-bold d-flex align-items-center gap-1" type="button" id="edit_admin_profile"><i class='bx bxs-edit-alt'></i> EDIT</button>
                                            <div class="d-flex align-items-center gap-2 d-none" id="submit-btn-wrap">
                                                <button class="btn btn-primary btn-sm fw-bold d-flex align-items-center gap-1" type="submit"><i class='bx bxs-save' ></i> SAVE</button>
                                                <button class="btn btn-danger btn-sm fw-bold d-flex align-items-center gap-1" type="button" id="edit_admin_back"><i class='bx bx-x-circle' ></i> CANCEL</button>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control edit_profile" name="username" disabled value="<?=$row['username']?>">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control edit_profile" name="email" disabled value="<?=$row['email']?>">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control edit_profile" name="pass" disabled placeholder="••••••••">
                                            <div class="show_password d-inline-flex align-items-center gap-1 mt-1 d-none">
                                                <input type="checkbox" class="form-check mb-0" id="show-pass">
                                                <label for="show" class="form-label mb-0" style="font-size: 14px;">Show Password</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </main>

<?php
    include('footer.php');
?>

<script>

    jQuery(function($) {
        $(document).ready(function () {
            
            $('body').on('click', '#edit_admin_profile',function(e) {
                e.preventDefault();
                $('.edit_profile').prop('disabled', false);
                $('#submit-btn-wrap').toggleClass('d-none');
                $('#repeat_pass').toggleClass('d-none');
                $('.show_password').toggleClass('d-none');
                $(this).toggleClass('d-none');
            })

            $('body').on('click', '#edit_admin_back',function(e) {
                e.preventDefault();
                $('.edit_profile').prop('disabled', true);
                $('#submit-btn-wrap').toggleClass('d-none');
                $('.show_password').toggleClass('d-none');
                $('#edit_admin_profile').toggleClass('d-none');
            })

            $('body').on('change', '#show-pass', function() {
                var isChecked = $(this).is(':checked');
                var passField = $('#edit_admin_form input[name="pass"]');
                passField.attr('type', isChecked ? 'text' : 'password');
                passField.attr('placeholder', isChecked ? 'Enter new password' : '••••••••');
            })

            $('#edit_admin_form').on('submit', function(e) {
                e.preventDefault();
                var user = $('#edit_admin_form input[name="username"]').val();
                var email = $('#edit_admin_form input[name="email"]').val();
                var pass = $('#edit_admin_form input[name="pass"]').val();

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {user:user,email:email,pass:pass,action:'edit_admin'},
                    success: function (response) {
                        if(response === 'success')
                        {
                            $('.edit_profile').prop('disabled', true);
                            $('#submit-btn-wrap').toggleClass('d-none');
                            $('#edit_admin_profile').toggleClass('d-none');
                            $('.show_password').toggleClass('d-none');
                            $('.show_password').prop('checked', false);
                            $('#edit_admin_form input[name="pass"]').prop('type', 'password');

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: false
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Profile has been edited!'
                            })
                        }
                        else if(response === 'err_short')
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Password must be at least 8 characters.',
                                'error'
                            );
                        }
                        else
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to edit profile.',
                                'error'
                            );
                        }
                    }
                });

            })

        })
    })

</script>