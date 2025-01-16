<?php

function init_bd() {
    include 'auth.php';
    $pdo = new PDO("mysql:host=servinfo-maria;dbname=DB$name", $name, $pwd);
    $table= "SCORE";
    $columns = "
    Id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, 
    Username VARCHAR( 50 ) NOT NULL, 
    Score INT, Question VARCHAR ( 50 ),
    Date_crea TIMESTAMP DEFAULT CURRENT_TIMESTAMP " ;
    $createTable = $pdo->exec("CREATE TABLE IF NOT EXISTS $table ($columns)");
    return $pdo;
}

function recreate_db() {
    include 'auth.php';
    $pdo = new PDO("mysql:host=servinfo-maria;dbname=DB$name", $name, $pwd);
    $table= "SCORE";
    $pdo->exec("DROP TABLE IF EXISTS $table");
    $columns = "
    Id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, 
    Username VARCHAR( 50 ) NOT NULL, 
    Score INT, Question VARCHAR ( 50 ),
    Date_crea TIMESTAMP DEFAULT CURRENT_TIMESTAMP " ;
    $createTable = $pdo->exec("CREATE TABLE IF NOT EXISTS $table ($columns)");
    return $pdo;
    
}

function give_user_score($username, $db) {
    $sql = "SELECT * FROM SCORE 
    WHERE Username = ? 
    ORDER BY Created_at DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username]);
    $rows = $stmt->fetchAll();
    return $rows;
}

$db = init_bd();
?>