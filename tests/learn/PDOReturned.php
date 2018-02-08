<?php

$dsn = 'mysql:dbname=fileshare;host=127.0.0.1';
$user = 'honey';
$password = 'd5d7';

$pdo = new PDO($dsn, $user, $password);
$query = "SELECT users.email, users.id, usersInfo.name,  usersInfo.avatarUri, usersSettings.accountStatus, usersSettings.accessLvl 
            FROM users LEFT JOIN usersInfo ON users.id = usersInfo.userId LEFT JOIN usersSettings 
            ON users.id = usersSettings.userId WHERE users.id = 'ssd'
           ";
$query = $pdo->query($query);
$query = $query->fetch();
var_dump($query);
echo 'endfile';