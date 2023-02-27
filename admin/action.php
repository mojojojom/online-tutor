<?php
    session_start();
    require('../connection/connect.php');

    if(isset($_POST['action']))
    {

        // COURSES
        if($_POST['action'] === 'add_course')
        {
            $course = mysqli_real_escape_string($db, $_POST['course']);
            $code = mysqli_real_escape_string($db, $_POST['code']);

            $get_course = mysqli_query($db, "SELECT * FROM courses WHERE course_name = '$course' OR course_code = '$code'");
            if(!empty($course))
            {
                if(mysqli_num_rows($get_course) > 0)
                {
                    echo 'err_exists';
                }
                else
                {
                    $insert = mysqli_query($db, "INSERT INTO courses (course_name, course_code) VALUES ('$course', '$code') ");
                    if($insert)
                    {
                        echo 'success';
                    }
                    else
                    {
                        echo 'err_insert';
                    }
                }
            }
            else
            {
                echo 'error';
            }

        }
        if($_POST['action'] === 'del_course')
        {
            $id = mysqli_real_escape_string($db, $_POST['id']);

            $query = mysqli_query($db, "DELETE FROM courses WHERE id='$id'");
            if($query)
            {
                echo 'success';
            }
            else
            {
                echo 'error';
            }

        }
        if($_POST['action'] === 'edit_course')
        {
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $course = mysqli_real_escape_string($db, $_POST['course']);
            $code = mysqli_real_escape_string($db, $_POST['code']);

            $query = mysqli_query($db, "SELECT * FROM courses WHERE id='$id'");

            if(mysqli_num_rows($query) > 0)
            {
                $update_course = mysqli_query($db, "UPDATE courses SET course_name='$course', course_code='$code' WHERE id='$id'");
                if($update_course)
                {
                    echo 'success';
                }
                else
                {
                    echo 'error';
                }
            }
            else
            {
                echo 'not_exists';
            }
        }

        // TUTORS
        if($_POST['action'] === 'del_tutor')
        {
            $id = mysqli_real_escape_string($db, $_POST['id']);

            $query = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '$id'");
            if(mysqli_num_rows($query) > 0)
            {
                
                $delete = mysqli_query($db, "DELETE FROM tutors WHERE u_id = '$id'");
                if($delete)
                {
                    $get_old_dp = mysqli_query($db, "SELECT dp FROM tutors WHERE u_id='$id'");
                    if(mysqli_num_rows($get_old_dp) > 0)
                    {
                        $old_dp = mysqli_fetch_assoc($get_old_dp)['dp'];
                        if(file_exists("../uploads/tutors/".$old_dp))
                        {
                            unlink("../uploads/tutors/".$old_dp);
                        }
                    }
                    echo 'success';
                }
                else
                {
                    echo 'error';
                }
            }
            else
            {
                echo 'error';
            }
        }
        if($_POST['action'] === 'edit_tutor')
        {
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $status = mysqli_real_escape_string($db, $_POST['status']);

            $query = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '$id'");
            if(mysqli_num_rows($query) > 0)
            {
                $update_status = mysqli_query($db, "UPDATE tutors SET status='$status' WHERE u_id = '$id'");
                if($update_status)
                {
                    echo 'success';
                }
                else
                {
                    echo 'err'.mysqli_error($db);
                }
            }
            else
            {
                echo 'error'.mysqli_error($db);
            }

        }

        // TUTEES
        if($_POST['action'] === 'del_tutee')
        {
            $id = mysqli_real_escape_string($db, $_POST['id']);

            $query = mysqli_query($db, "SELECT * FROM tutees WHERE id = '$id'");
            if(mysqli_num_rows($query) > 0)
            {
                
                $delete = mysqli_query($db, "DELETE FROM tutees WHERE id = '$id'");
                if($delete)
                {
                    $get_old_dp = mysqli_query($db, "SELECT dp FROM tutees WHERE id='$id'");
                    if(mysqli_num_rows($get_old_dp) > 0)
                    {
                        $old_dp = mysqli_fetch_assoc($get_old_dp)['dp'];
                        if(file_exists("../uploads/tutees/".$old_dp))
                        {
                            unlink("../uploads/tutees/".$old_dp);
                        }
                    }
                    echo 'success';
                }
                else
                {
                    echo 'error'.mysqli_error($db);
                }
            }
            else
            {
                echo 'error'.mysqli_error($db);
            }
        }
        if($_POST['action'] === 'edit_tutee')
        {
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $status = mysqli_real_escape_string($db, $_POST['status']);

            $query = mysqli_query($db, "SELECT * FROM tutees WHERE id = '$id'");
            if(mysqli_num_rows($query) > 0)
            {
                $update_status = mysqli_query($db, "UPDATE tutees SET status='$status' WHERE id = '$id'");
                if($update_status)
                {
                    echo 'success';
                }
                else
                {
                    echo 'err';
                }
            }
            else
            {
                echo 'error';
            }

        }

        // APPOINTMENTS
        if($_POST['action'] === 'del_app')
        {
            $id = mysqli_real_escape_string($db, $_POST['id']);
            // echo 'success';
            $check_app = mysqli_query($db, "SELECT * FROM appointments WHERE sched_id='$id'");
            if(mysqli_num_rows($check_app) > 0)
            {
                $del_app = mysqli_query($db, "DELETE FROM appointments WHERE sched_id = '$id'");
                if($del_app)
                {
                    echo 'success';
                }
                else
                {
                    echo 'error';
                }
            }
            else
            {
                echo 'error';
            }
        }

        // SCHEDULES
        if($_POST['action'] === 'del_sched')
        {
            $id = mysqli_real_escape_string($db, $_POST['id']);
            // echo 'success';
            $check_sched = mysqli_query($db, "SELECT * FROM schedules WHERE sched_id='$id'");
            if(mysqli_num_rows($check_sched) > 0)
            {
                $del_sched = mysqli_query($db, "DELETE FROM schedules WHERE sched_id = '$id'");
                if($del_sched)
                {
                    echo 'success';
                }
                else
                {
                    echo 'error';
                }
            }
            else
            {
                echo 'error';
            }
        }


        // ADMIN
        if($_POST['action'] === 'edit_admin')
        {
            $id = $_SESSION['admin_id'];
            $user = mysqli_real_escape_string($db, $_POST['user']);
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $pass = mysqli_real_escape_string($db, $_POST['pass']);

            $check_admin = mysqli_query($db, "SELECT * FROM admin WHERE id = '$id'");
            if(mysqli_num_rows($check_admin) > 0)
            {
                if(empty($pass))
                {
                    $update_admin = mysqli_query($db, "UPDATE admin SET username = '$user', email = '$email' WHERE id = '$id'");
                    if($update_admin)
                    {
                        echo 'success';
                    }
                    else
                    {
                        echo 'error';
                    }
                }
                else
                {
                    if(strlen($pass) <= 7)
                    {
                        echo 'err_short';
                    }
                    else
                    {
                        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                        $update_admin = mysqli_query($db, "UPDATE admin SET username = '$user', email = '$email', password='$hashedPass' WHERE id = '$id'");
                        if($update_admin)
                        {
                            echo 'success';
                        }
                        else
                        {
                            echo 'error';
                        }
                    }
                }
            }
            else
            {
                echo 'error';
            }

        }


    }