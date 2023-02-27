<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();

    include('header.php');

    if(empty($_SESSION['uid']))
    {
        header('Location: index.php');
    }
    else
    {
?>

        <section class="t_banner-wrap sec-pad">
            <div class="container">

                <div class="row">

                    <!-- APPOINTMENTS DETAIL -->
                    <div class="col-lg-6">

                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="t-dark fw-bold titles">ACTIVE APPOINTMENTS</h4>

                                <div class="list-group active-lists">

                                    <?php
                                        $check_app = mysqli_query($db, "SELECT * FROM appointments WHERE tutee_id = '{$_SESSION['uid']}' AND app_status IN ('Pending','In-Progress', 'Queue', 'Checking') ORDER BY app_id DESC");
                                        // $check_app = mysqli_query($db, "SELECT * FROM appointments WHERE tutee_id = '{$_SESSION['uid']}' AND app_status IN ('In-Progress', 'Queue', NULL)");

                                        if(mysqli_num_rows($check_app) > 0)
                                        {
                                            while($app = mysqli_fetch_assoc($check_app)) 
                                            {

                                                // $get_name = mysli_query($db, "SELECT * FROM appointments WHERE tutee_id = '{$_SESSION['uid']}'");
                                                // $code = mysqli_fetch_assoc($get_name);

                                                $getDate = $app['app_date'];
                                                $date = date('F j, Y', strtotime($getDate));
                                                $day = date('l', strtotime($getDate));
                                                $stime = $app['app_time_start'];
                                                $etime = $app['app_time_end'];
                                                $startTime = date('h:i:s A', strtotime($stime));
                                                $endTime = date('h:i:s A', strtotime($etime));

                                                $get_course = mysqli_query($db, "SELECT * FROM courses WHERE course_code = '{$app['course_code']}'");
                                                $course = mysqli_fetch_assoc($get_course);

                                                if($app['app_status'] === 'Done')
                                                {
                                                    $card_class = 'bg-success';
                                                    $text_class = 'text-light';
                                                }
                                                else if($app['app_status'] === 'Pending')
                                                {
                                                    $card_class = 'bg-primary';
                                                    $text_class = 'text-light';
                                                }
                                                else if($app['app_status'] === 'Queue')
                                                {
                                                    $card_class = 'bg-warning';
                                                    $text_class = 'text-light';
                                                }
                                                else if($app['app_status'] === 'In-Progress')
                                                {
                                                    $card_class = 'bg-info';
                                                    $text_class = 'text-light';
                                                }
                                                else if($app['app_status'] === 'Cancelled')
                                                {
                                                    $card_class = 'bg-danger';
                                                    $text_class = 'text-light';
                                                }
                                                else
                                                {
                                                    $card_class = 'bg-light';
                                                    $text_class = 'text-dark';
                                                }


                                                if($app['app_status'] === 'Done' || $app['app_status'] === 'Cancelled' || $app['app_status'] === 'Denied')
                                                {
                                    ?>
                                    <?php
                                                }
                                                else
                                                {
                                    ?>
                                                    <a href="#app_modal-<?=$app['course_code']?>" class="list-group-item list-group-item-action <?=$card_class?> <?=$app['app_status']?>" aria-current="true"data-bs-toggle="modal" data-bs-target="#app_modal-<?=$app['course_code']?>">
                                                        <div class="d-md-flex w-100 justify-content-between">
                                                            <?php
                                                            if($app['status'] === '1')
                                                            {
                                                            ?>
                                                            <small class="<?=$text_class?> d-block d-md-none" style="font-size: 12px;">APPOINTMENT APPROVED</small>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <small class=" <?=$text_class?> d-block d-md-none" style="font-size: 12px;">WAITING FOR APPROVAL</small>
                                                            <?php
                                                            }
                                                            ?>

                                                            <h6 class="mb-1 fw-bold <?=$text_class?>"><?=$course['course_name']?></h6>

                                                            <?php
                                                            if($app['status'] === '1')
                                                            {
                                                            ?>
                                                            <small class="<?=$text_class?>  d-none d-md-block" style="font-size: 12px;">APPOINTMENT APPROVED</small>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <small class=" <?=$text_class?>  d-none d-md-block" style="font-size: 12px;">WAITING FOR APPROVAL</small>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <p class="mb-1 <?=$text_class?>"><?=$date." - ".$day?></p>
                                                    </a>
                                    <?php
                                                }

                                                $get_tutor = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '{$app['tutor_id']}'");
                                                $tut = mysqli_fetch_assoc($get_tutor);
                                                $name = $tut['f_name']." ".$tut['l_name'];
                                                
                                                $status = '';
                                                if($app['status'] === '0')
                                                {
                                                    $status = 'FOR APPROVAL';
                                                }
                                                else
                                                {
                                                    $status = 'APPROVED';
                                                }

                                                $app_status = '';
                                                if($app['app_status'] === '')
                                                {
                                                    $app_status = 'PENDING APPOINTMENT';
                                                }
                                                else
                                                {
                                                    $app_status = $app['app_status'];
                                                }

                                                $link = '';
                                                if($app['app_link'] === '')
                                                {
                                                    $link = 'PLEASE WAIT...';
                                                }
                                                else
                                                {
                                                    $link = $app['app_link'];
                                                }
                                    ?>


                                    <!-- MODAL -->
                                    <div class="modal fade" id="app_modal-<?=$app['course_code']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-6" id="exampleModalLabel"><?=$course['course_name']?> Appointment Details</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <span class="d-flex justify-content-center align-items-center fw-bold alert alert-warning">PLEASE STANDBY 10 MINUTES BEFORE YOUR APPOINTMENT.</span>
                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <small for="tname" class="fw-bold">TUTOR NAME</small>
                                                            <div class="form-control"><?=$name?></div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <small for="tname" class="fw-bold">COURSE</small>
                                                            <div class="form-control"><?=$course['course_name']?></div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <small for="tname" class="fw-bold">START TIME</small>
                                                            <div class="form-control"><?=$startTime?></div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <small for="tname" class="fw-bold">TIME END</small>
                                                            <div class="form-control"><?=$endTime?></div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <small for="tname" class="fw-bold">APPOINTMENT STATUS</small>
                                                            <div class="form-control fw-bold"><?=$status?></div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <small for="tname" class="fw-bold">STATUS</small>
                                                            <div class="form-control fw-bold"><?=$app_status?></div>
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                            <small for="tname" class="fw-bold">MEETING LINK</small>
                                                            <?php
                                                            if(empty($app['app_link']))
                                                            {
                                                            ?>
                                                            <div class="form-control"><?=$link?></div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <a href="<?=$link?>" class="form-control"><?=$link?></a>
                                                            <a href="<?=$link?>" id="copy-link" data-link="<?=$link?>" class="t-primary fw-bold" style="font-size: 14px;">COPY LINK</a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                            <small for="tname" class="fw-bold d-block">ACTIVITY</small>
                                                            <?php
                                                            $get_activity = mysqli_query($db, "SELECT * FROM activities WHERE sched_id='{$app['sched_id']}'");
                                                            if(mysqli_num_rows($get_activity) > 0)
                                                            {
                                                                $activity = mysqli_fetch_assoc($get_activity);
                                                                $item = $activity['filename'];
                                                                $get_passes = mysqli_query($db, "SELECT * FROM activities_submitted WHERE sched_id = '{$activity['sched_id']}'");

                                                                if(mysqli_num_rows($get_passes) > 0)
                                                                {
                                                            ?>
                                                                    <a href="uploads/activity/<?=$item?>" class="d-inline-flex align-items-center gap-2 disabled fw-bold text-success" target="_blank"><?=$item?><span class="badge bg-success text-light">TURNED IN</span></a>
                                                            <?php
                                                                }
                                                                else
                                                                {
                                                            ?>
                                                                    <a href="uploads/activity/<?=$item?>" class="d-block fw-bold" target="_blank"><?=$item?></a>
                                                            <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <span class="alert alert-danger fw-bold d-flex align-items-center justify-content-center">NO AVAILABLE ACTIVITY</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class=" c-btn c-btn-primary c-btn-sm bg-danger border border-1 border-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                            } 
                                        } 
                                        else
                                        {
                                    ?>
                                            <span class="alert alert-danger d-flex align-items-center justify-content-center fw-bold">NO ACTIVE APPOINTMENT</span>
                                    <?php
                                        }
                                    ?>

                                </div>

                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="t-dark fw-bold titles">APPOINTMENTS HISTORY</h4>

                                <div class="list-group active-lists">
                                    <?php
                                        // $check_app = mysqli_query($db, "SELECT * FROM appointments WHERE tutee_id = '{$_SESSION['uid']}' AND status = '{Done, Cancelled,NULL}'");
                                        $check_app = mysqli_query($db, "SELECT * FROM appointments WHERE tutee_id = '{$_SESSION['uid']}' AND app_status IN ('Done', 'Cancelled', 'Denied')");
                                        if(mysqli_num_rows($check_app) > 0)
                                        {
                                            while($app = mysqli_fetch_assoc($check_app)) 
                                            {
                                                $get_course = mysqli_query($db, "SELECT * FROM courses WHERE course_code = '{$app['course_code']}'");
                                                $course = mysqli_fetch_assoc($get_course);

                                                $getDate = $app['app_date'];
                                                $date = date('F j, Y', strtotime($getDate));
                                                $day = date('l', strtotime($getDate));
                                                $stime = $app['app_time_start'];
                                                $etime = $app['app_time_end'];
                                                $startTime = date('h:i:s A', strtotime($stime));
                                                $endTime = date('h:i:s A', strtotime($etime));


                                                if($app['app_status'] === 'Done')
                                                {
                                                    $card_class = 'bg-success';
                                                    $text_class = 'text-light';
                                                }
                                                else if($app['app_status'] === 'Pending')
                                                {
                                                    $card_class = 'bg-secondary';
                                                    $text_class = 'text-light';
                                                }
                                                else if($app['app_status'] === 'Queue')
                                                {
                                                    $card_class = 'bg-warning';
                                                    $text_class = 'text-light';
                                                }
                                                else if($app['app_status'] === 'In-Progress')
                                                {
                                                    $card_class = 'bg-info';
                                                    $text_class = 'text-light';
                                                }
                                                else if($app['app_status'] === 'Cancelled')
                                                {
                                                    $card_class = 'bg-danger';
                                                    $text_class = 'text-light';
                                                }
                                                else
                                                {
                                                    $card_class = 'bg-light';
                                                    $text_class = 'text-dark';
                                                }
                                    ?>
                                        <a href="#" class="list-group-item list-group-item-action <?=$card_class?> <?=$app['app_status']?>" aria-current="true">
                                            <div class="d-flex w-100 justify-content-between flex-wrap">
                                                <h6 class="mb-1 fw-bold d-inline d-md-flex <?=$text_class?>"><?=$course['course_name']?></h6>
                                                <?php
                                                if($app['status'] === '1')
                                                {
                                                ?>
                                                <small class="<?=$text_class?> d-none" style="font-size: 12px;">APPOINTMENT APPROVED</small>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <small class=" <?=$text_class?> d-none" style="font-size: 12px;">WAITING FOR APPROVAL</small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <p class="mb-1 <?=$text_class?>"><?=$date." - ".$day?></p>
                                        </a>
                                    <?php
                                            } 
                                        } 
                                        else
                                        {
                                    ?>
                                            <span class="alert alert-danger d-flex align-items-center justify-content-center fw-bold">NO APPOINTMENT HAS BEEN SET</span>
                                    <?php
                                        }
                                    ?>

                                </div>
                                
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="t-dark fw-bold titles">ACTIVITIES</h4>

                                <ol class="list-group list-group-numbered">
                                    <?php
                                    $get_activity = mysqli_query($db, "SELECT * FROM activities WHERE tutee_id='{$_SESSION['uid']}'");
                                    if(mysqli_num_rows($get_activity) > 0)
                                    {
                                        while($task = mysqli_fetch_assoc($get_activity))
                                        {
                                    ?>
                                        <li class="list-group-item d-flex">
                                            <span class="d-flex align-items-center justify-content-between w-100">
                                                <span class="fw-bold text-decoration-none ms-1"><?=$task['title']?></span>
                                                <?php
                                                $get_passes = mysqli_query($db, "SELECT * FROM activities_submitted WHERE sched_id = '{$task['sched_id']}'");
                                                if(mysqli_num_rows($get_passes) > 0)
                                                {
                                                ?>
                                                <span class="badge bg-success text-light">TURNED IN</span>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <a href="#" class="badge bg-primary text-light turn-in-btn" data-id="<?=$task['sched_id']?>">TURN IN</a>
                                                <?php
                                                }
                                                ?>
                                            </span>
                                        </li>
                                    <?php
                                        }
                                    }
                                    else
                                    {
                                    ?>
                                    <span class="alert alert-danger fw-bold d-flex align-items-center justify-content-center">NO AVAILABLE ACTIVITY</span>
                                    <?php
                                    }
                                    ?>
                                </ol>

                            </div>
                        </div>

                    </div>

                    <!-- PROFILE DETAILS -->
                    <div class="col-lg-6">

                        <!-- MESSAGE -->
                        <?php
                            if(isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                        ?>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="t-dark fw-bold titles">YOUR PROFILE</h4>

                                <?php
                                    $get_info = mysqli_query($db, "SELECT * FROM tutees WHERE id='{$_SESSION['uid']}'");
                                    $info = mysqli_fetch_assoc($get_info);
                                ?>

                                <div class="card">
                                    <div class="card-body">
                                        <div id="show_profile">
                                            <div class="row">

                                                <div class="col-12 mb-3 text-center">
                                                    <img class=" border border-3 border-primary p-1" src="uploads/tutees/<?=$info['dp']?>" alt="Display Picture" style="width:150px; height: 150px;object-fit:cover;border-radius: 50%;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">USERNAME</label>
                                                    <input type="text" class="form-control disabled" value="<?=$info['username']?>">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">NAME</label>
                                                    <input type="text" class="form-control disabled" value="<?=$info['f_name']." ".$info['l_name']?>">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">EMAIL</label>
                                                    <input type="text" class="form-control disabled" value="<?=$info['email']?>">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">PHONE</label>
                                                    <input type="text" class="form-control disabled" value="<?=$info['num']?>">
                                                </div>

                                                <div class="col-md mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">PROGRAM & YEAR</label>
                                                    <input type="text" class="form-control disabled" value="<?=$info['course']." ".$info['y_lvl']?>">
                                                </div>

                                                <div class="col-12 text-center">
                                                    <button class=" c-btn c-btn-sm c-btn-primary" id="edit_profile-btn"><i class="fa-solid fa-pen-to-square"></i> EDIT PROFILE</button>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="POST" action="action.php" id="edit_profile-form">

                                            <div class="row">

                                                <input type="hidden" name="action" value="edit_tutee">

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">USERNAME</label>
                                                    <input type="text" class="form-control" name="username" value="<?=$info['username']?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">PHONE NUMBER</label>
                                                    <input type="text" class="form-control" name="phone" value="<?=$info['phone']?>">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">FIRST NAME</label>
                                                    <input type="text" class="form-control" name="fname" value="<?=$info['f_name']?>">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">LAST NAME</label>
                                                    <input type="text" class="form-control" name="lname" value="<?=$info['l_name']?>">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">PASSWORD</label>
                                                    <input type="password" class="form-control" name="pass" value="" placeholder="********">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">REPEAT PASSWORD</label>
                                                    <input type="password" class="form-control" name="r_pass" value="" placeholder="********">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">PROGRAM</label>
                                                    <input type="text" class="form-control" name="course" id="tutee_course" placeholder="Enter your course" value="<?=$info['course']?>">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">YEAR LEVEL</label>
                                                    <select id="tutee_level" class="form-select" name="level" aria-label="Default select">
                                                        <option selected><?=$info['y_lvl']?></option>
                                                        <option value="1">I</option>
                                                        <option value="2">II</option>
                                                        <option value="3">III</option>
                                                        <option value="4">IV</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="username" class=" fw-semibold t-desc" style="font-size: 14px;">YOUR IMAGE</label>
                                                    <input class="form-control" name="dp" type="file" id="tutee_image" accept="image/*">
                                                </div>

                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class=" c-btn c-btn-sm c-btn-primary" type="submit">SAVE</button>
                                                    <button class=" c-btn c-btn-sm c-btn-primary bg-danger border border-danger" id="cancel_edit">CANCEL</button>
                                                </div>

                                            </div>

                                        </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

<?php
    }

?>


<?php
    include('footer.php');
?>

<script>

    jQuery(function($) {
        $(document).ready(function () {

            $('#edit_profile-form').hide();

            $('#edit_profile-btn').on('click', function(e) {
                e.preventDefault();
                $('#edit_profile-form').show();
                // $(this).hide();
                $('#show_profile').hide();
            })

            $('#cancel_edit').on('click', function(e) {
                e.preventDefault();
                $('#edit_profile-form').hide();
                $('#show_profile').show();
            })

            $('body').on('click', '.turn-in-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Turn in activity',
                    html:
                        '<input type="file" class="form-control" name="activity_file" id="activity_file">' +
                        '<input type="hidden" class="form-control" name="sched_id" value="'+id+'">',
                    showCancelButton: true,
                    confirmButtonText: 'TURN IN',
                    preConfirm: () => {
                        const fileInput = document.getElementById('activity_file');
                        const file = fileInput.files[0];
                        const schedIdInput = document.querySelector('input[name="sched_id"]');
                        const formData = new FormData();
                        formData.append('activity_file', file);
                        formData.append('sched_id', schedIdInput.value);
                        return fetch('turn-in.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                        })
                        .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                    })
                    .then(result => {
                    if (result.value) {
                        Swal.fire({
                            title: 'File uploaded',
                            text: result.value.message,
                            icon: 'success'
                        });
                    }
                });

            })



            $("#copy-link").click(function(e) {
                e.preventDefault();
                var linkUrl = $(this).attr("href");

                var tempInput = $("<input>");

                tempInput.val(linkUrl);

                $("body").append(tempInput);

                tempInput.select();

                document.execCommand("copy");

                tempInput.remove();

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                })
                Toast.fire({
                    icon: 'success',
                    title: 'LINK COPIED TO CLIPBOARD!'
                })
            });



        })
    })

</script>