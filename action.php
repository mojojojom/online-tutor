<?php

    // Load PHPMailer classes
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require 'vendor/autoload.php';


    session_start();

    function display_message($message) {
        $_SESSION['message'] ='
            <div class="alert alert-primary alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                '.$message.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
        if(isset($_SESSION['t_uid']))
        {
            header("location: profile-tutor.php");
            exit();
        }
        else
        {
            header("location: profile.php");
            exit();
        }
    }

    if(isset($_POST['action'])) {

        //*************** REGISTRATION ***************//
        // TUTOR REGISTRATION
        if($_POST['action'] === 'r_tutor') {
            include('connection/connect.php');

            $username = mysqli_real_escape_string($db, $_POST['username']);
            $fname = mysqli_real_escape_string($db, $_POST['f_name']);
            $lname = mysqli_real_escape_string($db, $_POST['l_name']);
            $course = mysqli_real_escape_string($db, $_POST['course']);
            $lvl = mysqli_real_escape_string($db, $_POST['level']);
            $pass = mysqli_real_escape_string($db, $_POST['password']);
            $cpass = mysqli_real_escape_string($db, $_POST['c_password']);
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $num = mysqli_real_escape_string($db, $_POST['phone']);

            // IMAGE
            $img_name = $_FILES['dp']['name'];
            $img_temp = $_FILES['dp']['tmp_name'];
            $img_size = $_FILES['dp']['size'];
            $extension = explode('.',$img_name);
            $extension = strtolower(end($extension));
            $new_img = uniqid().'.'.$extension;
    
            $store = "uploads/tutors/".basename($new_img);

            // CHECK USER
            $check_user = mysqli_query($db, "SELECT * FROM tutors WHERE username = '$username'");
            $check_email = mysqli_query($db, "SELECT * FROM tutors WHERE email = '$email'");
            $check_phone = mysqli_query($db, "SELECT * FROM tutors WHERE num = '$num'");

            $check_tut = mysqli_query($db, "SELECT * FROM tutees WHERE username = '$username'");
            $check_tut_email = mysqli_query($db, "SELECT * FROM tutees WHERE email = '$email'");
            $check_tut_phone = mysqli_query($db, "SELECT * FROM tutees WHERE num = '$num'");

            if(mysqli_num_rows($check_user) > 0) 
            {
                // echo 'user_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        USER ALREADY EXISTS!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutor');
                exit();
            } 
            else if(mysqli_num_rows($check_email) > 0) 
            {
                // echo 'email_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        EMAIL ALREADY IN USED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutor');
                exit();
            } 
            else if(mysqli_num_rows($check_phone) > 0) 
            {
                // echo 'num_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        PHONE NUMBER ALREADY IN USED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutor');
                exit();
            } 
            else if(mysqli_num_rows($check_tut) > 0) 
            {
                // echo 'user_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        USER ALREADY EXISTS!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutor');
                exit();
            } 
            else if(mysqli_num_rows($check_tut_email) > 0) 
            {
                // echo 'email_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        EMAIL ALREADY IN USED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutor');
                exit();
            } 
            else if(mysqli_num_rows($check_tut_phone) > 0) 
            {
                // echo 'num_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        PHONE NUMBER ALREADY IN USED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutor');
                exit();
            } 
            else 
            {
                if(isset($_FILES['dp']) && $_FILES['dp']['error'] === 0)
                {
                    if($extension === 'jpg' || $extension === 'png' || $extension === 'gif')
                    {
                        if($img_size > 5242880)
                        {
                            $_SESSION['message'] ='
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                    INVALID IMAGE SIZE!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            ';
                            header('Location: register.php?type=tutor');
                            exit();
                        }
                        else
                        {
                            if($pass === $cpass)
                            {
                                if(strlen($pass) <= 7) {
                                    $_SESSION['message'] ='
                                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                            PASSWORD MUST BE AT LEAST 8 CHARACTERS LONG!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    ';
                                    header('Location: register.php?type=tutor');
                                    exit();
                                }
                                else
                                {
                                    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
            
                                    $u_code = rand(999999, 111111);
                                    $status = "No";
                                    $as = '0';
                                    $uid = uniqid('ot');
                                    $am = '';
                                    $mt = '';

                                    $query = mysqli_query($db, "INSERT INTO tutors(u_id, username, f_name, l_name, email, about_me, my_tagline, course, y_lvl, password, num, dp, code, status, active_status) VALUES('$uid','$username','$fname', '$lname','$email', '$am', '$mt', '$course', '$lvl', '$hashedPass','$num','$new_img','$u_code','$status','$as')");
                                    if($query) 
                                    {

                                        $name = $fname. " " .$lname;

                                        // Create a new PHPMailer object
                                        $mail = new PHPMailer(true);

                                        // Configure PHPMailer
                                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                        $mail->isSMTP();
                                        $mail->Host = 'smtp.hostinger.com';
                                        $mail->SMTPAuth = true;
                                        $mail->Username = 'prmsuccitmta@prmsuccitmobiletutoringapp.com';
                                        $mail->Password = 'r*239@*vBwHY';
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                        $mail->Port = 465;

                                        // Set the recipients and message content
                                        $mail->setFrom('prmsuccitmta@prmsuccitmobiletutoringapp.com', 'PRMSU CCIT MTA');
                                        $mail->addAddress($email, $name);
                                        $mail->Subject = 'Verification Code';
                                        $mail->Body = 'Your OTP : "'.$u_code.'"';
                                            
                                        // Send the email
                                        if (!$mail->send()) {
                                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                                        } else {
                                            // echo 'Message sent!';
                                            $_SESSION['email'] = $email;
                                            header('Location: otp.php');
                                            exit();
                                        }
                                    } 
                                    else 
                                    {
                                        // echo 'error'.mysqli_error($db);
                                        $_SESSION['message'] ='
                                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                                UNABLE TO REGISTER!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        ';
                                        header('Location: register.php?type=tutor');
                                        exit();
                                    }
            
                                }
                            }
                            else
                            {
                                // echo 'pass_match'.mysqli_error($db);
                                $_SESSION['message'] ='
                                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                        PASSWORD DOESN\'T MATCHED!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                ';
                                header('Location: register.php?type=tutor');
                                exit();
                            }
                        }
                    }
                    else
                    {
                        // echo 'error_type'.mysqli_error($db);
                        $_SESSION['message'] ='
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                INVALID IMAGE TYPE!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        ';
                        header('Location: register.php?type=tutor');
                        exit();
                    }
                }
                else
                {
                    if($pass === $cpass)
                    {
                        if(strlen($pass) <= 7) {
                            $_SESSION['message'] ='
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                    PASSWORD MUST BE AT LEAST 8 CHARACTERS LONG!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            ';
                            header('Location: register.php?type=tutor');
                            exit();
                        }
                        else
                        {
                            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    
                            $u_code = rand(999999, 111111);
                            $status = "No";
                            $as = '0';
                            $uid = uniqid('ot');
                            $am = '';
                            $mt = '';

                            $query = mysqli_query($db, "INSERT INTO tutors(u_id, username, f_name, l_name, email, about_me, my_tagline, course, y_lvl, password, num, dp, code, status, active_status) VALUES('$uid','$username','$fname', '$lname','$email', '$am', '$mt', '$course', '$lvl', '$hashedPass','$num','','$u_code','$status','$as')");
                            if($query) 
                            {
                                move_uploaded_file($img_temp, $store);

                                $name = $fname. " " .$lname;

                                // Create a new PHPMailer object
                                $mail = new PHPMailer(true);

                                // Configure PHPMailer
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                $mail->isSMTP();
                                $mail->Host = 'smtp.hostinger.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'prmsuccitmta@prmsuccitmobiletutoringapp.com';
                                $mail->Password = 'r*239@*vBwHY';
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                $mail->Port = 465;

                                // Set the recipients and message content
                                $mail->setFrom('prmsuccitmta@prmsuccitmobiletutoringapp.com', 'PRMSU CCIT MTA');
                                $mail->addAddress($email, $name);
                                $mail->Subject = 'Verification Code';
                                $mail->Body = 'Your OTP : "'.$u_code.'"';
                                    
                                // Send the email
                                if (!$mail->send()) {
                                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                                } else {
                                    // echo 'Message sent!';
                                    $_SESSION['email'] = $email;
                                    header('Location: otp.php');
                                    exit();
                                }
                            } 
                            else 
                            {
                                $_SESSION['message'] ='
                                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                        UNABLE TO REGISTER!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                ';
                                header('Location: register.php?type=tutor');
                                exit();
                            }
    
                        }
                    }
                    else
                    {
                        // echo 'pass_match'.mysqli_error($db);
                        $_SESSION['message'] ='
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                PASSWORD DOESN\'T MATCHED!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        ';
                        header('Location: register.php?type=tutor');
                        exit();
                    }
                }
            }

        }
        // TUTEE REGISTRATION
        if($_POST['action'] === 'r_tutee') {
            include('connection/connect.php');

            $username = mysqli_real_escape_string($db, $_POST['username']);
            $fname = mysqli_real_escape_string($db, $_POST['f_name']);
            $lname = mysqli_real_escape_string($db, $_POST['l_name']);
            $course = mysqli_real_escape_string($db, $_POST['course']);
            $lvl = mysqli_real_escape_string($db, $_POST['level']);
            $pass = mysqli_real_escape_string($db, $_POST['password']);
            $cpass = mysqli_real_escape_string($db, $_POST['c_password']);
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $num = mysqli_real_escape_string($db, $_POST['phone']);

            $img_name = $_FILES['dp']['name'];
            $img_temp = $_FILES['dp']['tmp_name'];
            $img_size = $_FILES['dp']['size'];
            $extension = explode('.',$img_name);
            $extension = strtolower(end($extension));
            $new_img = uniqid().'.'.$extension;
    
            $store = "uploads/tutees/".basename($new_img);

            // CHECK USER
            $check_user = mysqli_query($db, "SELECT * FROM tutees WHERE username = '$username'");
            $check_email = mysqli_query($db, "SELECT * FROM tutees WHERE email = '$email'");
            $check_phone = mysqli_query($db, "SELECT * FROM tutees WHERE num = '$num'");

            $check_tut = mysqli_query($db, "SELECT * FROM tutors WHERE username = '$username'");
            $check_tut_email = mysqli_query($db, "SELECT * FROM tutors WHERE email = '$email'");
            $check_tut_phone = mysqli_query($db, "SELECT * FROM tutors WHERE num = '$num'");

            if(mysqli_num_rows($check_user) > 0) 
            {
                // echo 'user_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        USER ALREADY EXISTS!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutee');
                exit();
            } 
            else if(mysqli_num_rows($check_email) > 0) 
            {
                // echo 'email_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        EMAIL ALREADY IN USED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutee');
                exit();
            } 
            else if(mysqli_num_rows($check_phone) > 0) 
            {
                // echo 'num_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        PHONE NUMBER ALREADY IN USED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutee');
                exit();
            } 
            else if(mysqli_num_rows($check_tut) > 0) 
            {
                // echo 'user_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        USER ALREADY EXISTS!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutee');
                exit();
            } 
            else if(mysqli_num_rows($check_tut_email) > 0) 
            {
                // echo 'email_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        EMAIL ALREADY IN USED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutee');
                exit();
            } 
            else if(mysqli_num_rows($check_tut_phone) > 0) 
            {
                // echo 'num_exists'.mysqli_error($db);
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        PHONE NUMBER ALREADY IN USED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: register.php?type=tutee');
                exit();
            } 
            else 
            {
                if(isset($_FILES['dp']) && $_FILES['dp']['error'] === 0)
                {
                    if($extension === 'jpg' || $extension === 'png' || $extension === 'gif')
                    {
                        if($img_size > 5242880)
                        {
                            $_SESSION['message'] ='
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                    INVALID IMAGE SIZE!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            ';
                            header('Location: register.php?type=tutee');
                            exit();
                        }
                        else
                        {
                            if($pass === $cpass)
                            {
                                if(strlen($pass) <= 7) {
                                    $_SESSION['message'] ='
                                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                            PASSWORD MUST BE 8 CHARACTERS LONG!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    ';
                                    header('Location: register.php?type=tutee');
                                    exit();
                                }
                                else
                                {
                                    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
            
                                    $u_code = rand(999999, 111111);
                                    $status = "No";
                                    $as = '0';
            
                                    $query = mysqli_query($db, "INSERT INTO tutees(username, f_name, l_name, email, course, y_lvl, password, num, dp, code, status, active_status) VALUES('$username','$fname', '$lname','$email', '$course', '$lvl', '$hashedPass','$num','$new_img','$u_code','$status','$as')");
                                    if($query) 
                                    {
                                        move_uploaded_file($img_temp, $store);

                                        $name = $fname. " " .$lname;

                                        // Create a new PHPMailer object
                                        $mail = new PHPMailer(true);

                                        // Configure PHPMailer
                                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                        $mail->isSMTP();
                                        $mail->Host = 'smtp.hostinger.com';
                                        $mail->SMTPAuth = true;
                                        $mail->Username = 'prmsuccitmta@prmsuccitmobiletutoringapp.com';
                                        $mail->Password = 'r*239@*vBwHY';
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                        $mail->Port = 465;

                                        // Set the recipients and message content
                                        $mail->setFrom('prmsuccitmta@prmsuccitmobiletutoringapp.com', 'PRMSU CCIT MTA');
                                        $mail->addAddress($email, $name);
                                        $mail->Subject = 'Verification Code';
                                        $mail->Body = 'Your OTP : "'.$u_code.'"';
                                            
                                        // Send the email
                                        if (!$mail->send()) {
                                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                                        } else {
                                            // echo 'Message sent!';
                                            $_SESSION['email'] = $email;
                                            header('Location: otp.php');
                                            exit();
                                        }
                                    } 
                                    else 
                                    {
                                        // echo 'error'.mysqli_error($db);
                                        $_SESSION['message'] ='
                                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                                UNABLE TO REGISTER!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        ';
                                        header('Location: register.php?type=tutee');
                                        exit();
                                    }
            
                                }
                            }
                            else
                            {
                                // echo 'pass_match';
                                $_SESSION['message'] ='
                                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                        PASSWORD DOESN\'T MATCHED!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                ';
                                header('Location: register.php?type=tutee');
                                exit();
                            }
                        }
                    }
                    else
                    {
                        // echo 'error_type'.mysqli_error($db);
                        $_SESSION['message'] ='
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                INVALID IMAGE TYPE!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        ';
                        header('Location: register.php?type=tutee');
                        exit();
                    }
                }
                else
                {
                    if($pass === $cpass)
                    {
                        if(strlen($pass) <= 7) {
                            $_SESSION['message'] ='
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                    PASSWORD MUST BE 8 CHARACTERS LONG!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            ';
                            header('Location: register.php?type=tutee');
                            exit();
                        }
                        else
                        {
                            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    
                            $u_code = rand(999999, 111111);
                            $status = "No";
                            $as = '0';
    
                            $query = mysqli_query($db, "INSERT INTO tutees(username, f_name, l_name, email, course, y_lvl, password, num, dp, code, status, active_status) VALUES('$username','$fname', '$lname','$email', '$course', '$lvl', '$hashedPass','$num','','$u_code','$status','$as')");
                            if($query) 
                            {

                                $name = $fname. " " .$lname;

                                // Create a new PHPMailer object
                                $mail = new PHPMailer(true);

                                // Configure PHPMailer
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                $mail->isSMTP();
                                $mail->Host = 'smtp.hostinger.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'prmsuccitmta@prmsuccitmobiletutoringapp.com';
                                $mail->Password = 'r*239@*vBwHY';
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                $mail->Port = 465;

                                // Set the recipients and message content
                                $mail->setFrom('prmsuccitmta@prmsuccitmobiletutoringapp.com', 'PRMSU CCIT MTA');
                                $mail->addAddress($email, $name);
                                $mail->Subject = 'Verification Code';
                                $mail->Body = 'Your OTP : "'.$u_code.'"';
                                    
                                // Send the email
                                if (!$mail->send()) {
                                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                                } else {
                                    // echo 'Message sent!';
                                    $_SESSION['email'] = $email;
                                    header('Location: otp.php');
                                    exit();
                                }
                            } 
                            else 
                            {
                                // echo 'error'.mysqli_error($db);
                                $_SESSION['message'] ='
                                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                        UNABLE TO REGISTER!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                ';
                                header('Location: register.php?type=tutee');
                                exit();
                            }
    
                        }
                    }
                    else
                    {
                        // echo 'pass_match';
                        $_SESSION['message'] ='
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                                PASSWORD DOESN\'T MATCHED!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        ';
                        header('Location: register.php?type=tutee');
                        exit();
                    }
                }
            }

        }
        //*************** LOGIN ***************//
        // TUTOR LOGIN
        if($_POST['action'] === 'tutor_login')
        {
            include('connection/connect.php');

            $user = mysqli_real_escape_string($db, $_POST['user']);
            $pass = mysqli_real_escape_string($db, $_POST['pass']);

            $check_user = mysqli_query($db, "SELECT * FROM tutors WHERE (BINARY username='$user' OR BINARY email='$user')") or die(mysql_error());
            if(mysqli_num_rows($check_user) > 0)
            {
                $fetch = mysqli_fetch_assoc($check_user);
                $fetch_pass = $fetch['password'];
                $fetch_email = $fetch['email'];
                $fetch_status = $fetch['status'];

                if($fetch_status === 'Yes')
                {
                    if(password_verify($pass,$fetch_pass))
                    {
                        $update_status = mysqli_query($db, "UPDATE tutors SET active_status='1' WHERE u_id='".$fetch['u_id']."'");
                        $_SESSION['t_uid'] = $fetch['u_id'];
                        echo 'success';
                    }
                    else
                    {
                        echo 'err_pass';
                    }
                }
                else if($fetch_status === 'No')
                {
                    $_SESSION['email'] = $fetch_email;
                    echo 'err_verify';
                }
                else
                {
                    echo 'err_disabled';
                }

            }
            else
            {
                echo 'err_exists';
            }
        }
        // TUTEE LOGIN
        if($_POST['action'] === 'tutee_login')
        {
            include('connection/connect.php');

            $user = mysqli_real_escape_string($db, $_POST['user']);
            $pass = mysqli_real_escape_string($db, $_POST['pass']);

            $check_user = mysqli_query($db, "SELECT * FROM tutees WHERE (BINARY username='$user' OR BINARY email='$user')") or die(mysql_error());
            if(mysqli_num_rows($check_user) > 0)
            {
                $fetch = mysqli_fetch_assoc($check_user);
                $fetch_pass = $fetch['password'];
                $fetch_email = $fetch['email'];
                $fetch_status = $fetch['status'];

                if($fetch_status === 'Yes')
                {
                    if(password_verify($pass,$fetch_pass))
                    {
                        $update_status = mysqli_query($db, "UPDATE tutees SET active_status='1' WHERE id='".$fetch['id']."'");
                        $_SESSION['uid'] = $fetch['id'];
                        echo 'success';
                    }
                    else
                    {
                        echo 'err_pass';
                    }
                }
                else if($fetch_status === 'No')
                {
                    $_SESSION['email'] = $fetch_email;
                    echo 'err_verify';
                }
                else
                {
                    echo 'err_disabled';
                }

            }
            else
            {
                echo 'err_exists';
            }

        }
        // ADMIN LOGIN
        if($_POST['action'] === 'admin_login')
        {
            include('connection/connect.php');

            $user = mysqli_real_escape_string($db, $_POST['user']);
            $pass = mysqli_real_escape_string($db, $_POST['pass']);

            $check_user = mysqli_query($db, "SELECT * FROM admin WHERE (BINARY username='$user' OR BINARY email='$user')") or die(mysql_error());
            if(mysqli_num_rows($check_user) > 0)
            {
                $fetch = mysqli_fetch_assoc($check_user);
                $fetch_pass = $fetch['password'];
                $fetch_email = $fetch['email'];

                if(password_verify($pass,$fetch_pass))
                {
                    $_SESSION['admin_id'] = $fetch['id'];
                    echo 'success';
                }
                else
                {
                    echo 'err_pass';
                }

            }
            else
            {
                echo 'err_exists';
            }

        }
        //*************** VERIFY ***************//
        if($_POST['action'] === 'verify_account')
        {
            include('connection/connect.php');
            $email = mysqli_real_escape_string($db, $_SESSION['email']);
            $code = mysqli_real_escape_string($db, $_POST['vcode']);

            $check_tutor = mysqli_query($db, "SELECT * FROM tutors WHERE email='$email'");
            $check_tutee = mysqli_query($db, "SELECT * FROM tutees WHERE email='$email'");
            // $user = mysqli_fetch_array($check_user);

            if(!empty($email))
            {
                if(mysqli_num_rows($check_tutor) > 0)
                {
                    $user = mysqli_fetch_array($check_tutor);
                    if($user['code'] === $code)
                    {
                        $change_status = mysqli_query($db, "UPDATE tutors SET code='', status='Yes' WHERE email='$email'");
                        if($change_status)
                        {
                            $change_active = mysqli_query($db, "UPDATE tutors SET active_status = '1' WHERE email = '$email'");
                            if($change_active)
                            {
                                $_SESSION['t_uid'] = $user['u_id'];
                                echo 'success_tutor';
                            }
                            else
                            {
                                echo 'error';
                            }
                        }
                        else
                        {
                            echo 'err_verify';
                        }
                    }
                    else
                    {
                        echo 'err_code';
                    }
                }
                else if(mysqli_num_rows($check_tutee) > 0)
                {
                    $user = mysqli_fetch_array($check_tutee);
                    if($user['code'] === $code)
                    {
                        $change_status = mysqli_query($db, "UPDATE tutees SET code='', status='Yes' WHERE email='$email'");
                        if($change_status)
                        {
                            $change_active = mysqli_query($db, "UPDATE tutees SET active_status = '1' WHERE email = '$email'");
                            if($change_active)
                            {
                                $_SESSION['uid'] = $user['id'];
                                echo 'success_tutee';
                            }
                            else
                            {
                                echo 'error';
                            }
                        }
                        else
                        {
                            echo 'err_verify'.mysqli_error($db);
                        }
                    }                        
                    else
                    {
                        echo 'err_code';
                    }
                }
                else
                {
                    echo 'err_user';
                }
            }
            else
            {
                echo 'err_empty';
            }

        }
        //*************** APPOINTMENT FUNCTIONS ***************//
        // APPROVE APPLICANT
        if($_POST['action'] === 'approve')
        {
            include('connection/connect.php');
            $id = mysqli_real_escape_string($db, $_POST['id']);

            // echo 'success';
            if(empty($id))
            {
                echo 'err_empty';
            }
            else
            {
                $check_user = mysqli_query($db, "SELECT * FROM appointments WHERE sched_id = '$id'");
                if(mysqli_num_rows($check_user) > 0)
                {
                    $update_status = mysqli_query($db, "UPDATE appointments SET status='1', app_status = 'Pending' WHERE sched_id = '$id'");
                    if($update_status)
                    {
                        echo 'success';
                    }
                    else
                    {
                        echo 'err_update';
                    }
                }
                else
                {
                    echo 'err_exists';
                }
            }

        }
        // DENY APPLICANT
        if($_POST['action'] === 'cancel')
        {
            include('connection/connect.php');
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $tutee = mysqli_real_escape_string($db, $_POST['t_id']);

            // echo 'success';
            if(empty($id))
            {
                echo 'err_empty';
            }
            else
            {
                $check_user = mysqli_query($db, "SELECT * FROM appointments WHERE sched_id = '$id'");
                if(mysqli_num_rows($check_user) > 0)
                {
                    $schedId = $schedId = uniqid('sc');
                    $update_status = mysqli_query($db, "UPDATE appointments SET status='0', sched_id = '$schedId', app_status = 'Denied' WHERE tutee_id = '$tutee' AND sched_id = '$id'");
                    if($update_status)
                    {
                        
                        // echo 'success';
                        $update_sched = mysqli_query($db, "UPDATE schedules SET status = 'Active', sched_id = '$schedId' WHERE sched_id = '$id'");
                        if($update_sched)
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
                        echo 'err_update'.mysqli_error($db);
                    }
                }
                else
                {
                    echo 'err_exists';
                }
            }

        }
        //*************** TUTEE FUNCTIONS ***************//
        if($_POST['action'] === 'book_sched')
        {
            include('connection/connect.php');
            $id = mysqli_real_escape_string($db, $_POST['id']);

            if(empty($_SESSION['uid']))
            {
                echo 'error_user';
            }
            else if(isset($_SESSION['t_uid']) || isset($_SESSION['admin_id']))
            {
                echo 'error_admin';
            }
            else
            {
                if(empty($id))
                {
                    echo 'error_id';
                }
                else
                {
                    $get_sched = mysqli_query($db, "SELECT * FROM schedules WHERE sched_id = '$id'");
                    $sched = mysqli_fetch_array($get_sched);
    
                    $t_id = $sched['tutor_id'];
                    $code = $sched['course_name'];
                    $id = $_SESSION['uid'];
                    $sid = $sched['sched_id'];
                    $date = $sched['sched_date'];
                    $stime = $sched['app_time_start'];
                    $etime = $sched['app_time_end'];
                    $status = '0';
                    $astatus = 'Checking';
                    $link = '';
    
    
                    if(mysqli_num_rows($get_sched) > 0)
                    {
                        $make_appointment = mysqli_query($db, "INSERT INTO appointments(tutor_id, course_code, tutee_id, sched_id, app_date, app_time_start, app_time_end, status, app_status, app_link) VALUES('$t_id','$code','$id','$sid', '$date', '$stime', '$etime','$status','$astatus', '$link')");
                        if($make_appointment)
                        {
                            $update_sched = mysqli_query($db, "UPDATE schedules SET status = 'Inactive' WHERE sched_id = '$sid'");
                            if($update_sched)
                            {
                                echo 'success';
                            }
                            else
                            {
                                echo 'error_update';
                            }
                        }
                        else
                        {
                            echo 'error_insert'.mysqli_error($db);
                        }
                    }
                    else
                    {
                        echo 'error_item';
                    }
                }
            }

        }
        //*************** TUTOR FUNCTIONS ***************//
        if($_POST['action'] === 'set_meeting')
        {
            require('connection/connect.php');
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $status = mysqli_real_escape_string($db, $_POST['status']);
            $link = mysqli_real_escape_string($db, $_POST['link']);

            $query = mysqli_query($db, "SELECT * FROM appointments WHERE sched_id = '$id'");
            if(mysqli_num_rows($query) > 0)
            {
                $update_app = mysqli_query($db, "UPDATE appointments SET app_status = '$status', app_link = '$link' WHERE sched_id = '$id'");
                if($update_app)
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
        //*************** TUTOR EDIT PROFILE ***************//
        if($_POST['action'] === 'edit_tutor')
        {
            require('connection/connect.php');
            $uid = $_SESSION['t_uid'];
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $fname = mysqli_real_escape_string($db, $_POST['fname']);
            $lname = mysqli_real_escape_string($db, $_POST['lname']);
            $num = mysqli_real_escape_string($db, $_POST['phone']);
            $pass = mysqli_real_escape_string($db, $_POST['pass']);
            $cpass = mysqli_real_escape_string($db, $_POST['r_pass']);
            $course = mysqli_real_escape_string($db, $_POST['course']);
            $lvl = mysqli_real_escape_string($db, $_POST['level']);
            $mt = mysqli_real_escape_string($db, $_POST['tagline']);
            $am = mysqli_real_escape_string($db, $_POST['intro']);
            $img_name = $_FILES['dp']['name'];
            $img_temp = $_FILES['dp']['tmp_name'];
            $img_size = $_FILES['dp']['size'];
            $extension = explode('.',$img_name);
            $extension = strtolower(end($extension));
            $new_img = uniqid().'.'.$extension;
            $store = "uploads/tutors/".basename($new_img);
            
            if($extension !== 'jpg' && $extension !== 'png' && $extension !== 'gif')
            {
                $new_img = '';
            }
            if(empty($pass) && empty($new_img)) // Update other items if both password and dp are empty
            {
                $query = mysqli_query($db, "UPDATE tutors SET username='$username', f_name='$fname', l_name='$lname', about_me='$am', my_tagline='$mt', course='$course', y_lvl='$lvl', num='$num' WHERE u_id='$uid'");
                if($query) 
                {
                    display_message("YOUR PROFILE HAS BEEN UPDATED!");
                } 
                else 
                {
                    display_message("UNABLE TO UPDATE YOUR PROFILE!" . mysqli_error($db));
                }
            }
            else if(empty($pass)) // Update other items including dp if password is empty
            {
                if($img_size > 5242880)
                {
                    display_message("INVALID IMAGE SIZE!");
                }
                else
                {
                    $get_old_dp = mysqli_query($db, "SELECT dp FROM tutors WHERE u_id='$uid'");
                    $old_dp = mysqli_fetch_assoc($get_old_dp)['dp'];
                    $query = mysqli_query($db, "UPDATE tutors SET username='$username', f_name='$fname', l_name='$lname', about_me='$am', my_tagline='$mt', course='$course', y_lvl='$lvl', num='$num', dp='$new_img' WHERE u_id='$uid'");
                    if($query) 
                    {
                        if(file_exists("uploads/tutors/".$old_dp))
                        {
                            unlink("uploads/tutors/".$old_dp);
                            move_uploaded_file($img_temp, $store);
                            display_message("YOUR PROFILE HAS BEEN UPDATED!");
                        }
                    } 
                    else 
                    {
                        display_message("UNABLE TO UPDATE YOUR PROFILE!" . mysqli_error($db));
                    }
                }
            }
            else if(empty($new_img))
            {
                if($pass === $cpass)
                {
                    if(strlen($pass) <= 7) 
                    {
                        display_message("PASSWORD MUST BE AT LEAST 8 CHARACTERS LONG!");
                    }
                    else
                    {
                        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                        $query = mysqli_query($db, "UPDATE tutors SET username='$username', f_name='$fname', l_name='$lname', about_me='$am', my_tagline='$mt', course='$course', y_lvl='$lvl', password='$hashedPass', num='$num' WHERE u_id='$uid'");

                        if($query)
                        {
                            display_message("YOUR PROFILE HAS BEEN UPDATED!");
                        }
                        else
                        {
                            display_message("UNABLE TO UPDATE YOUR PROFILE!" . mysqli_error($db));
                        }
                    }
                }
                else
                {
                    display_message("PASSWORD DOESN'T MATCHED!");
                }
            }
            else // Update all items including password and dp if both are empty
            {
                if($pass === $cpass)
                {
                    if(strlen($pass) <= 7)
                    {
                        display_message("PASSWORD MUST BE AT LEAST 8 CHARACTERS LONG!");
                    }
                    else
                    {
                        if($extension === 'jpg' || $extension === 'png' || $extension === 'gif')
                        {
                            if($img_size > 5242880)
                            {
                                display_message("INVALID IMAGE SIZE!");
                            }
                            else
                            {
                                $get_old_dp = mysqli_query($db, "SELECT dp FROM tutors WHERE u_id='$uid'");
                                $old_dp = mysqli_fetch_assoc($get_old_dp)['dp'];
                                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                                $query = mysqli_query($db, "UPDATE tutors SET username='$username', f_name='$fname', l_name='$lname', about_me='$am', my_tagline='$mt', course='$course', y_lvl='$lvl', password='$hashedPass', num='$num', dp='$new_img' WHERE u_id='$uid'");
                                
                                if($query)
                                {
                                    if(file_exists("uploads/tutors/".$old_dp))
                                    {
                                        unlink("uploads/tutors/".$old_dp);
                                        move_uploaded_file($img_temp, $store);
                                        display_message("YOUR PROFILE HAS BEEN UPDATED!");
                                    }
                                }
                                else
                                {
                                    display_message("UNABLE TO UPDATE YOUR PROFILE!" . mysqli_error($db));
                                }
                            }
                        }
                    }
                }
                else
                {
                    display_message("PASSWORD DOESN'T MATCHED!");
                }
            }
        }
        if($_POST['action'] === 'upload_cv')
        {
            require('connection/connect.php');

            // CV
            $file_name = $_FILES['cv']['name'];
            $file_size = $_FILES['cv']['size'];
            $file_tmp = $_FILES['cv']['tmp_name'];
            $file_type = $_FILES['cv']['type'];

            // Open the file for reading
            $fp = fopen($file_tmp, 'r');
            $content = fread($fp, filesize($file_tmp));
            fclose($fp);

            // Escape special characters in the content
            $content = mysqli_real_escape_string($db, $content);

            $query = mysqli_query($db, "INSERT INTO tutors_cv (u_id, cv_name, cv_size, cv_type, cv_content) VALUES ('{$_SESSION['t_uid']}', '$file_name', '$file_size', '$file_type', '$content')");
            if($query)
            {
                $_SESSION['message'] ='
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        YOUR CV HAS BEEN UPLOADED!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: profile-tutor.php');
                exit();
            }
            else
            {
                $_SESSION['message'] ='
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center fw-bold" role="alert">
                        UNABLE TO PLOAD CV!'.mysqli_error($db).'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                header('Location: profile-tutor.php');
                exit();
            }

        }
        //*************** TUTEE EDIT PROFILE ***************//
        if($_POST['action'] === 'edit_tutee')
        {
            require('connection/connect.php');
            $uid = $_SESSION['uid'];
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $fname = mysqli_real_escape_string($db, $_POST['fname']);
            $lname = mysqli_real_escape_string($db, $_POST['lname']);
            $num = mysqli_real_escape_string($db, $_POST['phone']);
            $pass = mysqli_real_escape_string($db, $_POST['pass']);
            $cpass = mysqli_real_escape_string($db, $_POST['r_pass']);
            $course = mysqli_real_escape_string($db, $_POST['course']);
            $lvl = mysqli_real_escape_string($db, $_POST['level']);
            
            $img_name = $_FILES['dp']['name'];
            $img_temp = $_FILES['dp']['tmp_name'];
            $img_size = $_FILES['dp']['size'];
            $extension = explode('.',$img_name);
            $extension = strtolower(end($extension));
            $new_img = uniqid().'.'.$extension;
            $store = "uploads/tutees/".basename($new_img);
            
            if($extension !== 'jpg' && $extension !== 'png' && $extension !== 'gif')
            {
                $new_img = '';
            }
            if(empty($pass) && empty($new_img)) // Update other items if both password and dp are empty
            {
                $query = mysqli_query($db, "UPDATE tutees SET username='$username', f_name='$fname', l_name='$lname', course='$course', y_lvl='$lvl', num='$num' WHERE id='$uid'");
                if($query) 
                {
                    display_message("YOUR PROFILE HAS BEEN UPDATED!");
                } 
                else 
                {
                    display_message("UNABLE TO UPDATE YOUR PROFILE!" . mysqli_error($db));
                }
            }
            else if(empty($pass)) // Update other items including dp if password is empty
            {
                if($img_size > 5242880)
                {
                    display_message("INVALID IMAGE SIZE!");
                }
                else
                {
                    $get_old_dp = mysqli_query($db, "SELECT dp FROM tutees WHERE id='$uid'");
                    $old_dp = mysqli_fetch_assoc($get_old_dp)['dp'];
                    $query = mysqli_query($db, "UPDATE tutees SET username='$username', f_name='$fname', l_name='$lname', course='$course', y_lvl='$lvl', num='$num', dp='$new_img' WHERE id='$uid'");
                    if($query) 
                    {
                        if(file_exists("uploads/tutees/".$old_dp))
                        {
                            unlink("uploads/tutees/".$old_dp);
                            move_uploaded_file($img_temp, $store);
                            display_message("YOUR PROFILE HAS BEEN UPDATED!");
                        }
                    } 
                    else 
                    {
                        display_message("UNABLE TO UPDATE YOUR PROFILE!" . mysqli_error($db));
                    }
                }
            }
            else if(empty($new_img))
            {
                if($pass === $cpass)
                {
                    if(strlen($pass) <= 7) 
                    {
                        display_message("PASSWORD MUST BE AT LEAST 8 CHARACTERS LONG!");
                    }
                    else
                    {
                        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                        $query = mysqli_query($db, "UPDATE tutees SET username='$username', f_name='$fname', l_name='$lname', course='$course', y_lvl='$lvl', password='$hashedPass', num='$num' WHERE id='$uid'");

                        if($query)
                        {
                            display_message("YOUR PROFILE HAS BEEN UPDATED!");
                        }
                        else
                        {
                            display_message("UNABLE TO UPDATE YOUR PROFILE!" . mysqli_error($db));
                        }
                    }
                }
                else
                {
                    display_message("PASSWORD DOESN'T MATCHED!");
                }
            }
            else // Update all items including password and dp if both are empty
            {
                if($pass === $cpass)
                {
                    if(strlen($pass) <= 7)
                    {
                        display_message("PASSWORD MUST BE AT LEAST 8 CHARACTERS LONG!");
                    }
                    else
                    {
                        if($extension === 'jpg' || $extension === 'png' || $extension === 'gif')
                        {
                            if($img_size > 5242880)
                            {
                                display_message("INVALID IMAGE SIZE!");
                            }
                            else
                            {
                                $get_old_dp = mysqli_query($db, "SELECT dp FROM tutees WHERE id='$uid'");
                                $old_dp = mysqli_fetch_assoc($get_old_dp)['dp'];
                                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                                $query = mysqli_query($db, "UPDATE tutees SET username='$username', f_name='$fname', l_name='$lname', course='$course', y_lvl='$lvl', password='$hashedPass', num='$num', dp='$new_img' WHERE id='$uid'");
                                
                                if($query)
                                {
                                    if(file_exists("uploads/tutees/".$old_dp))
                                    {
                                        unlink("uploads/tutees/".$old_dp);
                                        move_uploaded_file($img_temp, $store);
                                        display_message("YOUR PROFILE HAS BEEN UPDATED!");
                                    }
                                }
                                else
                                {
                                    display_message("UNABLE TO UPDATE YOUR PROFILE!" . mysqli_error($db));
                                }
                            }
                        }
                    }
                }
                else
                {
                    display_message("PASSWORD DOESN'T MATCHED!");
                }
            }
        }


    }

