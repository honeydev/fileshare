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

$query = $pdo->query("DELETE FROM users WHERE id = '666'");
var_dump($query);

echo 'endfile';

class Test
{
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    public function selectUserIdByEmail(string $email)
    {
        $selectId = "SELECT id FROM users WHERE email = '$email'";
        $selectId = $this->db->query($selectId);
        $selectId = $selectId->fetch();
        if ($selectId === false) {
            return false;
        } else {
            return $selectId[0];
        }
    }
}

var_dump((new Test($pdo))->selectUserIdByEmail('devspades@gmail.com'));

