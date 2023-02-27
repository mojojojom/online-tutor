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
                    <a class="nav-link" href="tutees.php">
                        <i class="bi bi-person"></i>
                        <span>Tutees</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="courses.php">
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
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Courses</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Courses</li>
                    </ol>
                </nav>
            </div>

            <section class="admin_courses-wrap">
                <div class="card mb-3">
                    <div class="card-body" id="courses-wrap">

                        <table class="table table-bordered table-responsive mb-0" id="tutors_table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Course Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $get_course = mysqli_query($db, 'SELECT * FROM courses ORDER BY id ASC');
                                $count = 1;
                                if(mysqli_num_rows($get_course) > 0) {
                                    while($row = mysqli_fetch_array($get_course))
                                    {
                                ?>
                                        <tr>
                                            <th scope="row"><?=$count?></th>
                                            <td><?=$row['course_name']?></td>
                                            <td><?=$row['course_code']?></td>
                                            <td class="d-flex justify-content-around admin__table-actions">
                                                <a href="#editCourse<?=$row['id']?>" data-bs-toggle="modal" data-bs-target="#editCourse<?=$row['id']?>"><i class="fas fa-pen"></i></a>
                                                <a href="#" data-id="<?=$row['id']?>" class="delete delete_course-btn"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    $count = $count+1;
                                    }
                                } else {
                                ?>
                                <td colspan="4" class="text-center fw-bold text-danger">NO COURSES AVAILABLE!</td>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" id="add_course">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="course" class="form-label">COURSE NAME</label>
                                        <input type="text" name="course" class="form-control mb-2 course-fields" placeholder="Enter Course Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="course" class="form-label">COURSE CODE</label>
                                        <input type="text" name="code" class="form-control mb-2 course-fields" placeholder="Enter Course Name" required>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="add_course">
                                <button class="btn btn-primary d-inline-flex fw-bold" id="add_course-btn" type="submit">ADD COURSE</button>
                            </div>
                        </form>
                    </div>
                </div>

            </section>

        </main>

        <!-- EDIT MODAL -->
        <?php
        $get_courses = mysqli_query($db, "SELECT * FROM courses");
        while($row = mysqli_fetch_assoc($get_courses)){
        ?>
        <div class="modal fade" id="editCourse<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" id="edit_course-<?=$row['id']?>">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT COURSE</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="action" value="edit_course">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="" class="form-label">Course Name</label>
                                    <input type="text" class="form-control" name="course" value="<?=$row['course_name']?>">
                                </div>
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="" class="form-label">Course Code</label>
                                    <input type="text" class="form-control" name="code" value="<?=$row['course_code']?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary edit-course-btn" data-bs-dismiss="modal" data-id="<?=$row['id']?>">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

<?php
    include('footer.php');
?>

<script>

    jQuery(function($) {
        $(document).ready(function () {

            // ADD COURSE
            $('#add_course').submit(function(e) {
                e.preventDefault();

                var data = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: data,
                    success: function (response) {
                        if(response === 'success')
                        {
                            get_courses();
                            $('input.course-fields').val("");
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: false
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Course has been added!'
                            })
                        }
                        else if(response === 'err_insert')
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to add course.',
                                'error'
                            );
                        }
                        else if(response === 'err_exists')
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Course Exists.',
                                'info'
                            );
                        }
                        else
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to add course.',
                                'error'
                            );
                        }
                    }
                });

            })

            // DELETE COURSE
            $('body').on('click', '.delete_course-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure you want to delete this course?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    confirmButtonColor: '#dc3545',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "action.php",
                            data: {id:id, action:'del_course'},
                            success: function (response) {
                                if(response === 'success')
                                {
                                    get_courses();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: false
                                    })
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Course has been deleted!'
                                    })
                                }
                                else
                                {
                                    Swal.fire(
                                        'Something went wrong!',
                                        'Unable to delete course.',
                                        'error'
                                    );
                                }
                            }
                        });
                    }
                });

            })

            // EDIT COURSE
            $('body').on('click','.edit-course-btn',function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var formData = $('#edit_course-'+id).serialize();

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: formData,
                    success: function (response) {
                        if(response === 'success')
                        {
                            get_courses();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: false
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Course has been edited!'
                            })
                        }
                        else if(response === 'not_exists')
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Course doesn\'t exists.',
                                'error'
                            );
                        }
                        else
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to edit course.',
                                'error'
                            );
                        }
                    }
                });

            })


            function get_courses() {
                $.ajax({
                    type: "GET",
                    url: "get_courses.php",
                    success: function (response) {
                        $('#courses-wrap').empty().html(response);
                    }
                });
            }


        })
    })

</script>