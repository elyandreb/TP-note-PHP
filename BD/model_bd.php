<?php

namespace BD;

use \PDO;

class model_BD {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('sqlite:db.sqlite');
        // Permet de gérer le niveau des erreurs
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $table= "SCORE";
        $columns = "
        Id INTEGER( 11 ) PRIMARY KEY, 
        Username VARCHAR( 50 ) NOT NULL, 
        Score INT, Question VARCHAR ( 50 ),
        Date_crea TIMESTAMP DEFAULT CURRENT_TIMESTAMP " ;
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS $table ($columns)");
    }

    public function getBD():PDO {
        return $this->pdo;
    }

    public function recreate_db():void {
        include 'auth.php';
        $pdo = new PDO('sqlite:db.sqlite');
        // Permet de gérer le niveau des erreurs
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $table= "SCORE";
        $pdo->exec("DROP TABLE IF EXISTS $table");
        $columns = "
        Id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, 
        Username VARCHAR( 50 ) NOT NULL, 
        Score INT, Question VARCHAR ( 50 ),
        Date_crea TIMESTAMP DEFAULT CURRENT_TIMESTAMP " ;
        $createTable = $pdo->exec("CREATE TABLE IF NOT EXISTS $table ($columns)");
    }

    public function give_user_score($username): array {
        $sql = "SELECT * FROM SCORE 
        WHERE Username = ? 
        ORDER BY Created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
}

    public function add_score($username, $score, $question): void {
        $sql = "INSERT INTO SCORE (Username, Score, Question) 
                VALUES (?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username, $score, $question]);
}
}
$db = new model_BD();


?>