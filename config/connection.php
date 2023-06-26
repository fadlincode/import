<?php
    $host = $this->getConnection()['host'];
    $user = $this->getConnection()['user'];
    $pass = $this->getConnection()['pass'];
    $db   = $this->getConnection()['database'];

    $connection = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        echo "Connection Error : " . mysqli_connect_error();
    }
?>