<?php
$connect_error = "Nous sommes désolés, nous avons des problèmes techniques.";
mysqli_connect('localhost', 'root', 'root') or die($connect_error);
mysqli_select_db('rdshe507_members') or die($connect_error);

try {
	$pdo = new PDO('mysql:host=localhost;dbname=rdshe507_members', 'root', 'root');
} catch(PDOException $e) {
	exit('Database error.');
}
?>