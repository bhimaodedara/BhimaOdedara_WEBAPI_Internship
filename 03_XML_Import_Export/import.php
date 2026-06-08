<?php

$host = 'localhost';
$dbname = 'xmldb'; 
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $filename = 'import.xml';
    
    if (file_exists($filename)) {
        $xml = simplexml_load_file($filename);

        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");

        $count = 0;
        foreach ($xml->user as $userNode) {
            $stmt->execute([
                ':name'  => (string) $userNode->name,
                ':email' => (string) $userNode->email
            ]);
            $count++;
        }
        
        echo "<h3>Success!</h3>";
        echo "<p>Imported $count new users into the database.</p>";
        
    } else {
        echo "<h3>Error</h3>";
        echo "<p>The file <strong>$filename</strong> does not exist in this folder.</p>";
    }

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>