<?php
require('PDOconnection.php');
$conn = Connection::getPDOconn();

$exampleVar = time();
$selectSomething = $conn->prepare("SELECT * FROM news WHERE date = ?");
$selectSomething->execute(array($exampleVar));
while($row = $selectSomething->fetch(PDO::FETCH_ASSOC)) {
	echo $row['title'];
}
?>