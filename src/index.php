<?php
echo "<h1>Hello from Dockerized PHP!</h1>";
echo "PHP Version: " . phpversion() . "</br>";

$dbHost = getenv('DB_HOST');
$dbName = getenv('DB_DATABASE');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASSWORD');

echo "DB HOST: " . $dbHost . "</br>";

if ($dbHost && $dbName && $dbUser && $dbPass) {
    try {
        $pdo = new PDO("mysql:host={$dbHost};dbName={$dbName}", $dbUser, $dbPass);
        echo "Successfully connected to the database: {$dbName}!<br>";
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage() . "<br>";
    }
} else {
    echo "Database environment variables not fully set.<br>";
}

phpinfo();
