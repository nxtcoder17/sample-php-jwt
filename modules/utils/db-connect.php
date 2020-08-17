<?php
$USER="root";
$PASSWORD="sample";
$HOST="db";
$DB="sample";

$connection = new mysqli(
                  $HOST,
                  $USER,
                  $PASSWORD,
                  $DB);


// Checking the connection
if ($connection -> connect_error)
  die("Connection Failed: " . $connection -> connect_error);
# echo "Database Connection Successfull";
?>