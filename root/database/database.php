<?php
$con = new mysqli("localhost", "root", "", "car_rental");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
