<?php

require_once './connection.php';

    $stmt = $conn->prepare(
        "CREATE TABLE members(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        pseudo VARCHAR(30) NOT NULL,
        email VARCHAR (255) NOT NULL,
        password TEXT NOT NULL )"
    );
    $stmt->execute(); 

    
?>