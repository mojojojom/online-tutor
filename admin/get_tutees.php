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
                    <a class="mx-1" href="#" class="delete delete_user-btn" data-id="<?=$row['id']?>"><i class="fas fa-trash text-danger"></i></a>
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