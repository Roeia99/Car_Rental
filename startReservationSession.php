<?php

session_start();
$_SESSION['carId'] = $_POST['carID'];
$_SESSION['PickupDate'] = $_POST['pickDate'];
$_SESSION['ReturnDate']   = $_POST['endDate'];

$data['msg'] = ["Logged in successfully"];

echo json_encode($data);
