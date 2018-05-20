<?php

try {
	$pdo = new PDO("mysql:dbname=fileshare;host=172.17.0.2", "honey", "d5d7");
	$sql = "DROP TABLE MyGuests";
	$pdo->query($sql);
	var_dump($pdo->query("show tables")->fetch());
} catch (PDOException $e) {
	var_dump($e->getMessage());
}