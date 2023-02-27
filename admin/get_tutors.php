<?php
session_start();
require('../connection/connect.php');
?>
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
    $get_tutors = mysqli_query($db, 'SELECT * FROM tutors ORDER BY id ASC');
    $count = 1;
    if(mysqli_num_rows($get_tutors) > 0) {
        while($row = mysqli_fetch_array($get_tutors))
        {
            $name = $row['f_name']. " " .$row['l_name'];
            $yc = $row['course']. " - " .$row['y_lvl'];
    ?>
            <tr>
                <th scope="row"><?=$count?></th>
                <td class="d-none d-md-table-cell"><img class="img-thumbnail" style="height: 50px; width: 50px; object-fit:cover;" src="../uploads/tutors/<?=$row['dp']?>" alt=""></td>
                <td><?=$name?></td>
                <td><?=$row['username']?></td>
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