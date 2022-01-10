<?php
$data['msg'] = 'Logging IN';

session_start();
$_SESSION['carId'] = $_POST['carID'];
$_SESSION['PickupDate'] = $_POST['pickDate'];
$_SESSION['ReturnDate']   = $_POST['endDate'];

echo json_encode($data);