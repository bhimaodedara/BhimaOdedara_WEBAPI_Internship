<?php

$host = 'localhost';
$dbname = 'test_db'; 
$user = 'root';      
$pass = '';          

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM users");
    $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><users/>');

    foreach ($usersData as $row) {
        $userNode = $xml->addChild('user');
        $userNode->addChild('id', $row['id']);
        $userNode->addChild('name', htmlspecialchars($row['name']));
        $userNode->addChild('email', htmlspecialchars($row['email']));
    }

    header('Content-Type: text/xml');
    echo $xml->asXML();

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>