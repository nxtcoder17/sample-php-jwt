<?php
require "/app/modules/utils/db-connect.php";

$query = "
  CREATE TABLE IF NOT EXISTS users (
    userId INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(256),
    password VARCHAR(100),
    
    PRIMARY KEY(userId)
  );
";

if ($connection->query($query) === FALSE) {
  echo $connection->error;
}

$query = "
  CREATE TABLE IF NOT EXISTS tokens (
    userId INT,
    token VARCHAR(1000)
  );
";

if ($connection->query($query) === FALSE) {
  echo $connection->error;
}

?>