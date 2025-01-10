<?php
include 'auth.php';

$db = new PDO("mysql://$name:$pwd@$ds/DB$name");

$table= "SCORE";
$columns = "Id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, Username VARCHAR( 50 ) NOT NULL, Score INT, Question VARCHAR ( 50 ) " ;


$createTable = $db->exec("CREATE TABLE IF NOT EXISTS mydb.$table ($columns)");

if ($createTable) 
{
    echo "Table $table - Created!<br /><br />";
}
else { echo "Table $table not successfully created! <br /><br />";
}

?>