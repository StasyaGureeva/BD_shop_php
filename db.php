<?php $user = "root"; $password = ""; 
try {
$db = new PDO("mysql:host=localhost;dbname=dbnew", $user, $password);
} catch (Exception $e) {
echo $e->getMessage();
}