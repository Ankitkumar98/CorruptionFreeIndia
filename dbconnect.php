<?php
    $DB_HOST = 'localhost';
    $DB_DATABASE = 'corruptionfreeindia';
    $DB_USER = 'root';
    $DB_PASSWORD = '';

    $dbc = mysqli_connect($DB_HOST ,$DB_USER ,$DB_PASSWORD ,$DB_DATABASE) or die("Couldn't connect to the database");

?>