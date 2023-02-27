<?php
session_start();
require('../connection/connect.php');

$get_tutee = mysqli_query($db, "SELECT * FROM tutees");
while($row = mysqli_fetch_assoc($get_tutee)){
    $name = $row['f_name']. " " .$row['l_name'];
?>
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
                <div class="form-control">
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
<?php
}
?>