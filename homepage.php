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
if ($email == 'John.admin22@gmail.com' and $password == '123456') {
    session_start();
    $data['admin'] = true;
    $data['customer'] = false;
    $data['message'] = 'Login Successfully as Admin!';
    echo json_encode($data);

} else {
    $connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
    if (!$connection) {
        return;
    }

    $password = md5($password);
    $query = mysqli_query($connection, "SELECT * FROM customer WHERE email='" . $email . "' AND `password` ='" . $password . "'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows != 0) {
        session_start();

        while ($row = mysqli_fetch_assoc($query)) {
            $db_email = $row['email'];
            $db_password = $row['password'];
            $_SESSION['email'] = $db_email;
            $_SESSION['customer_id'] = $row['customer_id'];
        }

        if ($email == $db_email) {
            $data['customer'] = true;
            $data['admin'] = false;
            $data['message'] = 'Login Successfully !';

        } else {
            $data['admin'] = false;
            $data['customer'] = false;
            $errors['email'] = "Invalid Email or Password";
            $data['errors'] = $errors;
        }

    } else {
        $data['admin'] = false;
        $data['customer'] = false;
        $data['message'] = "Invalid Email or Password";
    }

    mysqli_close($connection);
}
echo json_encode($data);