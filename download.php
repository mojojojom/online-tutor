<?php
    session_start();
    require('connection/connect.php');

    $file = 'activity.pdf'; // name of the file to download
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo 'File not found.';
    }
?>
