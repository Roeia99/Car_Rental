<?php

$errors = [];
$data = [];

$email = $_POST['email'];
$password = $_POST['password'];

// Empty Validations
if (empty($email) or empty($password)) {
    $data['success'] = false;
    echo json_encode($data);
    return;
}

$connection = mysqli_connect('localhost','root','','car_rental_system');
if (!$connection){ return; }

$password = md5($password);
$query = mysqli_query($connection,"SELECT * FROM customer WHERE email='".$email."' AND `password` ='".$password."'");
$num_rows = mysqli_num_rows($query);

if($num_rows!=0)
{
    while($row=mysqli_fetch_assoc($query))
    {
        $db_email = $row['email'];
        $db_password = $row['password'];
    }

    if($email == $db_email )
    {
        session_start();
        $data['success'] = true;
        $data['message'] = 'Login Successfully !';
    }else{
        $data['success'] = false;
        $errors['email'] = "Invalid Email or Password";
        $data['errors'] = $errors;
    }

} else {
    $data['success'] = false;
    $errors['email'] = "Invalid Email or Password";
    $data['errors'] = $errors;
}

mysqli_close($connection);
echo json_encode($data);
