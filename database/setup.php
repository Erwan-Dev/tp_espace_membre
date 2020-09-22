<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=test", "root","");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

    $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS tp_espace_membre (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        pseudo VARCHAR(30) NOT NULL,
        email VARCHAR (255) NOT NULL,
        password TEXT NOT NULL
        )");

    $stmt->execute();

    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>