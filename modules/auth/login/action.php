<?php
require '/app/vendor/autoload.php';
require "../models/user-table.php";

use \Firebase\JWT\JWT;

$secretKey = "my-secret";

$email = $_POST['email'];
$password = $_POST['password'];

$payload = array(
    "email" => $email,
);

$jwt = JWT::encode($payload, $secretKey);
$decoded = (array) JWT::decode($jwt, $secretKey, array('HS256'));

$result = $connection->query("SELECT * from users where email='$email' and password='$password'");

$loggedInUser = null;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      unset($row['password']);
      $loggedInUser = $row;
    }
}

$tokenPayload = array(
  'user' => $loggedInUser
);

// Generating Token
$authToken = JWT::encode($tokenPayload, $secretKey);

print_r($loggedInUser);
echo "<br/>";
echo "\nAuthToken: " . $authToken;

// Now, we have auth Token, so we need to save it in DB

$userId = $loggedInUser['userId'];
if ($connection->query("INSERT INTO tokens(userId, token) VALUES($userId,'$authToken'); ") === FALSE) {
  echo "Some Error occurred while dumping token to DB";
}