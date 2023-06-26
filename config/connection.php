<?php
    $connection = mysqli_connect("localhost","root","","db_pariwisata_kendari");

    if (mysqli_connect_errno()) {
        echo "Connection Error : " . mysqli_connect_error();
    }
?>