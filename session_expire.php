<?php
session_start();
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {

    if(isset($_SESSION['t_uid']))
    {
        $select_tut = mysqli_query($db, "UPDATE tutors SET active_status='0' WHERE u_id='".$_SESSION['t_uid']."'");
        if($select_tut)
        {
            session_unset();
            session_destroy();
        
            $url = 'index.php';
            header('Location: ' . $url);
            exit();
        }
    }
    else if(isset($_SESSION['uid']))
    {
        $select_t = mysqli_query($db, "UPDATE tutees SET active_status='0' WHERE id='".$_SESSION['uid']."'");
        if($select_t)
        {
            session_unset();
            session_destroy();
        
            $url = 'index.php';
            header('Location: ' . $url);
            exit();
        }
    }
    else
    {
        session_unset();
        session_destroy();
    
        $url = 'index.php';
        header('Location: ' . $url);
        exit();
    }

}

$_SESSION['last_activity'] = time();
?>
