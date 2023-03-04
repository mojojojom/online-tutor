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
                    <a class="nav-link active" href="tutors.php">
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
        <main id="main" class="main main-wrap px-1 px-md-4">

            <div class="pagetitle">
                <h1>Tutors</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tutors</li>
                    </ol>
                </nav>
            </div>

            <section class="admin_tutors-wrap">
                <div class="card">
                    <div class="card-body p-2 p-md-3 p-lg-4" id="tutors_list">
                        
                        <table class="table table-bordered table-striped py-3" style="width: 100%" id="tutors_table">
                            <thead>
                                <tr>
                                    <th scope="col" class="d-none d-md-table-cell">#</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Username</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Email</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Program/Year</th>
                                    <th scope="col" class="d-none d-md-table-cell">Phone No.</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $get_tutors = mysqli_query($db, 'SELECT * FROM tutors ORDER BY id ASC');
                                $count = 1;
                                if(mysqli_num_rows($get_tutors) > 0) {
                                    while($row = mysqli_fetch_array($get_tutors))
                                    {
                                        $name = $row['f_name']. " " .$row['l_name'];
                                        $yc = $row['course']. " - " .$row['y_lvl'];
                                ?>
                                        <tr>
                                            <th class="d-none d-md-table-cell" scope="row"><?=$count?></th>
                                            <td class="d-none d-lg-table-cell">
                                                <?php
                                                if(empty($row['dp']))
                                                {
                                                ?>
                                                <img class="img-thumbnail" style="height: 50px; width: 50px; object-fit:cover;" src="../images/DEFAULT/user_icon.png" alt="">
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <img class="img-thumbnail" style="height: 50px; width: 50px; object-fit:cover;" src="../uploads/tutors/<?=$row['dp']?>" alt="">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?=$name?></td>
                                            <td class="d-none d-lg-table-cell"><?=$row['username']?></td>
                                            <td class="d-none d-lg-table-cell"><?=$row['email']?></td>
                                            <td class="d-none d-lg-table-cell"><?=$yc?></td>
                                            <td class="d-none d-md-table-cell"><?=$row['num']?></td>
                                            <td class="text-center">
                                                <a href="#viewTutor-<?=$row['u_id']?>" class="mx-1" data-bs-toggle="modal" data-bs-target="#viewTutor-<?=$row['u_id']?>"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="delete delete_user-btn mx-1" data-id="<?=$row['u_id']?>"><i class="fas fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    $count = $count+1;
                                    }
                                } 
                                else 
                                {
                                ?>
                                <td colspan="9" class="text-center fw-bold text-danger">NO TUTORS AVAILABLE!</td>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>

        </main>

        <!-- VIEW/EDIT TUTORS -->
        <?php
        $get_tutor = mysqli_query($db, "SELECT * FROM tutors");
        while($row = mysqli_fetch_assoc($get_tutor)){
            $name = $row['f_name']. " " .$row['l_name'];
            ?>

            <div class="modal fade" id="viewTutor-<?=$row['u_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-lg">

                    <div class="modal-content tutors_info-wrap-<?=$row['u_id']?>" id="tutors_info-wrap-<?=$row['u_id']?>">
                        
                        <form method="POST" class="edit-tutor-form-<?=$row['u_id']?>">

                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">TUTOR DETAILS</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!-- VIEW -->
                                <div class="modal-body" id="show_tutor-<?=$row['u_id']?>">
                                    <div class="row">
                                        <!-- <div class="col-12 mb-3">
                                            <label for="" class="form-label d-block">Display Image</label>
                                            <img src="../uploads/tutors/<?=$row['dp']?>" alt="DISPLAY IMAGE" class=" img-thumbnail img-fluid" style="height:100px; width: 100px; object-fit:cover;">
                                        </div> -->
                                        <div class="col-md-6 mb-2">
                                            <label for="" class="form-label">Username</label>
                                            <div class="form-control"><?=$row['username']?></div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="" class="form-label">Name</label>
                                            <div class="form-control"><?=$name?></div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="" class="form-label">Email</label>
                                            <div class="form-control"><?=$row['email']?></div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="" class="form-label">Mobile Number</label>
                                            <div class="form-control"><?=$row['num']?></div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="" class="form-label">Account Status</label>
                                            <div class="form-control" id="account-status">
                                                <?php
                                                if($row['status'] === 'Yes')
                                                {
                                                ?>
                                                <span class="badge bg-success text-center">VERIFIED</span>
                                                <?php
                                                }
                                                else if($row['status'] === 'No')
                                                {
                                                ?>
                                                <span class="badge bg-danger text-center">NOT VERIFIED</span>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <span class="badge bg-secondary text-center">DISABLED</span>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="" class="form-label">Active Status</label>
                                            <div class="form-control">
                                                <?php
                                                if($row['active_status'] === '1')
                                                {
                                                ?>
                                                <span class="badge bg-success text-center">ONLINE</span>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <span class="badge bg-secondary text-center">OFFLINE</span>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="" class="form-label">Tagline</label>
                                            <div class="form-control">
                                                <?php
                                                if(empty($row['my_tagline']))
                                                {
                                                ?>
                                                Not Set
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <?=$row['my_tagline']?>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="" class="form-label">About Tutor</label>
                                            <div class="form-control disabled" style="pointer-events: none;" rows="3">
                                                <?php
                                                if(empty($row['about_me']))
                                                {
                                                ?>
                                                Not Set
                                                <?php
                                                }else{
                                                ?>
                                                <?=$row['about_me']?>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- EDIT -->
                                <div class="modal-body hidden" id="edit_tutor-<?=$row['u_id']?>">
                                    <div class="row">
                                        <input type="hidden" name="action" value="edit_tutor">
                                        <input type="hidden" name="id" value="<?=$row['u_id']?>">
                                        <div class="col-12 mb-3">
                                            <label for="" class="form-label">Account Status</label>
                                            <select name="status" id="status-<?=$row['u_id']?>" class="form-select">
                                                <option selected>
                                                    <?php
                                                    if($row['status'] === 'Yes')
                                                    {
                                                    ?>
                                                    Active
                                                    <?php
                                                    }
                                                    else if($row['status'] === 'No')
                                                    {
                                                    ?>
                                                    Inactive
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    Disabled
                                                    <?php
                                                    }
                                                    ?>
                                                </option>
                                                <option value="Yes">Active</option>
                                                <option value="No">Inactive</option>
                                                <option value="Disabled">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary edit-tutor-btn hidden" data-id="<?=$row['u_id']?>" data-bs-dismiss="modal">Save Changes</button>
                                    <button type="button" class="btn btn-secondary show-view-tutor hidden" data-id="<?=$row['u_id']?>">Back</button>
                                    <button type="button" class="btn btn-primary show-edit-tutor" data-id="<?=$row['u_id']?>">Edit Status</button>
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
        $(document).ready(function() {

            // $('#tutors_table').DataTable();

            // Show and hide edit form
            $('body').on('click', '.show-edit-tutor, .show-view-tutor', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#edit_tutor-'+id).toggleClass('hidden');
                $('#show_tutor-'+id).toggle();
                $('.show-edit-tutor').toggle();
                $('.edit-tutor-btn, .show-view-tutor').toggleClass('hidden');
            });

            // DELETE USER
            $('body').on('click', '.delete_user-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure you want to delete this tutor?',
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
                            data: {id:id, action:'del_tutor'},
                            success: function (response) {
                                if(response === 'success')
                                {
                                    get_tutors();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: false
                                    })
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Tutor has been deleted!'
                                    })
                                }
                                else
                                {
                                    Swal.fire(
                                        'Something went wrong!',
                                        'Unable to delete tutor.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                console.log(status);
                                console.log(error);
                            }
                        });
                    }
                });
            })

            // EDIT USER
            $('body').on('click', '.edit-tutor-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                // var formData = $('.edit-tutor-form-'+id).serialize();
                var status = $('#status-'+id).val();

                if(status === 'Yes')
                {
                    newStatus = '<span class="badge bg-success text-center">VERIFIED</span>';
                }
                else if(status === 'No')
                {
                    newStatus = '<span class="badge bg-danger text-center">NOT VERIFIED</span>';
                }
                else
                {
                    newStatus = '<span class="badge bg-secondary text-center">DISABLED</span>';
                }

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {id:id, status:status, action:'edit_tutor'},
                    success: function (response) {
                        if(response === 'success')
                        {
                            get_tutors();

                            $('#show_tutor-' + id + ' #account-status').html(newStatus);
                            // Hide the edit mode
                            $('#show_tutor-' + id).toggle();
                            $('#edit_tutor-' + id).toggleClass('hidden');
                            $('.show-edit-tutor').toggle();
                            $('.edit-tutor-btn, .show-view-tutor').toggleClass('hidden');

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: false
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Tutor account status has been changed!'
                            })
                        }
                        else
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to update tutor account status.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log(error);
                    }
                });

            })

            function get_tutors() {
                $.ajax({
                    type: "GET",
                    url: "get_tutors.php",
                    success: function (response) {
                        $('#tutors_table').empty().html(response);
                    }
                });
            }

        })
    })
</script>
