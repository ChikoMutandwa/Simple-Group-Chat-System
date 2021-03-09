<?php
    $dbHost = 'localhost';
    $dbName = 'chat';
    $dbUser = 'root';
    $dbPassword = '';

    try {
        $db = new PDO("mysql:dbhost = $dbHost; dbname=$dbName", "$dbUser", "$dbPassword");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>