<?php

// Attempt to connect to the MySQL database
$conn = mysqli_connect('localhost:3307', 'root', '', 'user_db');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
