<?php

include('connection/connect.php');

$sql = mysqli_query($db, "INSERT INTO courses (course_code, course_name)
VALUES
('PLF101', 'Program Logic Formulation'),
('CC101', 'Introduction to Computing'),
('GEC3A', 'The Contemporary World (Peace Education)'),
('GEC4', 'Mathematics in the Modern World'),
('GEE1', 'Environmental Science'),
('FILN1', 'Kontekstwalisadong Komunikasyon sa Filipino'),
('FMCS101', 'Fundamentals of Mathematics of Computer Science'),
('CC102', 'Computer Programming')");

if($sql) {
    echo 'success';
} else {
    echo 'Error : '.mysqli_error($db);
}