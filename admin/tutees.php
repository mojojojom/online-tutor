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
                <h1>Tutees</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tutees</li>
                    </ol>
                </nav>
            </div>

            <section class="admin_tutees-wrap">
                <div class="card">
                    <div class="card-body">
                        
                    <table class="table table-striped table-bordered py-3" style="width:100%" id="tutees_table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="d-none d-md-table-cell">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col" class="d-none d-lg-table-cell">Email</th>
                                <th scope="col" class="d-none d-lg-table-cell">Program/Year</th>
                                <th scope="col" class="d-none d-md-table-cell">Phone No.</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_tutees = mysqli_query($db, 'SELECT * FROM tutees ORDER BY id ASC');
                            $count = 1;
                            if(mysqli_num_rows($get_tutees) > 0) {
                                while($row = mysqli_fetch_array($get_tutees))
                                {
                                    $name = $row['f_name']. " " .$row['l_name'];
                                    $yc = $row['course']. " - " .$row['y_lvl'];
                            ?>
                                    <tr>
                                        <th scope="row"><?=$count?></th>
                                        <td class="d-none d-md-table-cell"><img class="img-thumbnail" style="height: 50px; width: 50px; object-fit:cover;" src="../uploads/tutees/<?=$row['dp']?>" alt=""></td>
                                        <td><?=$name?></td>
                                        <td><?=$row['username']?></td>
                                        <td class="d-none d-lg-table-cell"><?=$row['email']?></td>
                                        <td class="d-none d-lg-table-cell"><?=$yc?></td>
                                        <td class="d-none d-md-table-cell"><?=$row['num']?></td>
                                        <td class="text-center">
                                            <a class="mx-1" href="#viewTutee-<?=$row['id']?>" data-bs-toggle="modal" data-bs-target="#viewTutee-<?=$row['id']?>"><i class="fas fa-eye"></i></a>
                                            <a class="mx-1 delete delete_user-btn" href="#" data-id="<?=$row['id']?>"><i class="fas fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                $count = $count+1;
                                }
                            } else {
                            ?>
                            <td colspan="9" class="text-center fw-bold text-danger">NO TUTEES AVAILABLE!</td>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                    </div>
                </div>
            </section>

        </main>


        <!-- VIEW/EDIT TUTEES -->
        <?php
        $get_tutee = mysqli_query($db, "SELECT * FROM tutees");
        while($row = mysqli_fetch_assoc($get_tutee)){
            $name = $row['f_name']. " " .$row['l_name'];
        ?>

        <div class="modal fade" id="viewTutee-<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" id="tutees_info">
                    
                    <form method="POST" class="edit-tutee-form-<?=$row['id']?>">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">TUTEE DETAILS</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- VIEW -->
                        <div class="modal-body" id="show_tutee-<?=$row['id']?>">
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
                                    <label for="" class="form-label">Program</label>
                                    <div class="form-control"><?=$row['course']?></div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="" class="form-label">Year Level</label>
                                    <div class="form-control"><?=$row['y_lvl']?></div>
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
                            </div>
                        </div>

                        <!-- EDIT -->
                        <div class="modal-body hidden" id="edit_tutee-<?=$row['id']?>">
                            <div class="row">
                                <input type="hidden" name="action" value="edit_tutee">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Account Status</label>
                                    <select name="status" id="status-<?=$row['id']?>" class="form-select">
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
                            <button type="submit" class="btn btn-primary edit-tutee-btn hidden" data-id="<?=$row['id']?>" data-bs-dismiss="modal">Save Changes</button>
                            <button type="button" class="btn btn-secondary show-view-tutee hidden" data-id="<?=$row['id']?>">Back</button>
                            <button type="button" class="btn btn-primary show-edit-tutee" data-id="<?=$row['id']?>">Edit Status</button>
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

            $('#tutees_table').DataTable();

            // Show and hide edit form
            $('body').on('click', '.show-edit-tutee, .show-view-tutee', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#edit_tutee-'+id).toggleClass('hidden');
                $('#show_tutee-'+id).toggle();
                $('.show-edit-tutee').toggle();
                $('.edit-tutee-btn, .show-view-tutee').toggleClass('hidden');
            });

            // DELETE USER
            $('body').on('click', '.delete_user-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure you want to delete this tutee?',
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
                            data: {id:id, action:'del_tutee'},
                            success: function (response) {
                                if(response === 'success')
                                {
                                    get_tutees();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: false
                                    })
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Tutee has been deleted!'
                                    })
                                }
                                else
                                {
                                    Swal.fire(
                                        'Something went wrong!',
                                        'Unable to delete tutee.',
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
            $('body').on('click', '.edit-tutee-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
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
                    data: {id:id, status:status, action:'edit_tutee'},
                    success: function (response) {
                        if(response === 'success')
                        {
                            get_tutees();

                            $('#show_tutee-' + id + ' #account-status').html(newStatus);
                            // Hide the edit mode
                            $('#show_tutee-' + id).toggle();
                            $('#edit_tutee-' + id).toggleClass('hidden');
                            $('.show-edit-tutee').toggle();
                            $('.edit-tutee-btn, .show-view-tutee').toggleClass('hidden');

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: false
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Tutee account status has been changed!'
                            })
                        }
                        else
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to update tutee account status.',
                                'error'
                            );
                            alert(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log(error);
                    }
                });

            })


            function get_tutees() {
                $.ajax({
                    type: "GET",
                    url: "get_tutees.php",
                    success: function (response) {
                        $('#tutees_table').empty().html(response);
                    }
                });
            }





        })
    })
</script>