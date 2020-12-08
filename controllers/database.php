<?php
    $mysqli = new mysqli("localhost","root","Bagalkot@1","testing");

    // Check connection
    if ($mysqli -> connect_error) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
?>