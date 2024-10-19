<?php

$conn = mysqli_connect("localhost", "root", "", "expert_finder");


// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to Database: " . mysqli_connect_error();
} else {
    echo "success";
}
