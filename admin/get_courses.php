<?php
    session_start();
    require('../connection/connect.php');
?>
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