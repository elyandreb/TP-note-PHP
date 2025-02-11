<?php

namespace BD;

use \PDO;

class model_bd {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/db.sqlite'); # ligne pour obtenir le chemin vers la BD
        // Permet de gérer le niveau des erreurs
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $table= "SCORE";
        $columns = "
        Id INTEGER( 11 ) PRIMARY KEY, 
        Username VARCHAR( 50 ) NOT NULL, 
        Score INT,
        ScoreMax INT,
        Question VARCHAR ( 50 ),
        Created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP " ;
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS $table ($columns)");
    }

    public function getBD():PDO {
        return $this->pdo;
    }

    public function recreate_db():void {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/db.sqlite');
        // Permet de gérer le niveau des erreurs
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $table= "SCORE";
        $this->pdo->exec("DROP TABLE IF EXISTS $table");
        $columns = "
        Id INT( 11 ) PRIMARY KEY, 
        Username VARCHAR( 50 ) NOT NULL, 
        Score INT, 
        ScoreMax INT,
        Question VARCHAR ( 50 ),
        Created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP " ;
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS $table ($columns)");
    }

    public function give_user_score(string $username): array {
        $sql = "SELECT * FROM SCORE 
        WHERE Username = ? 
        ORDER BY Created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
}
    public function add_score(string $username, int $score, int $ScoreMax, string $question): void {
        $sql = "INSERT INTO SCORE (Username, Score, ScoreMax, Question) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username, $score, $ScoreMax, $question]);
    }
}
// $db = new model_BD();
// $db->add_score('lolo',5,"question1");
// $db->add_score('lolo',10,"question2");
// $db->add_score('lolo',4,"question3");


// $score = $db->give_user_score('lolo');
// print_r($score)
// foreach ($score as $monscore) {
//     foreach ($monscore as $monscore2) {
//         echo $monscore2, "\n";
//     };
// }

// print $score[0]["Username"];
// print $score[0]["Score"];

?>