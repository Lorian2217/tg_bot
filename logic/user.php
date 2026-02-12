<?php
$servername = "localhost";
$username = "cw809330";
$password = "uzhBMnT7";
$dbname   = "cw809330_test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Соединение не удалось: " . mysqli_connect_error());
}

echo "Соединение установлено успешно!";

// Здесь можно выполнять запросы к БД

mysqli_close($conn);
?>