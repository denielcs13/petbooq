<?php

$conn = mysqli_connect("localhost", "root", "", "pet");
 if ($conn == FALSE) {
        die("Error:Could not connect" . mysqli_connect_error());
    }
?>
