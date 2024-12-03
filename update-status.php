<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery_list";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if 'id' and 'is_active' are set in the query string
    if (isset($_GET['id']) && isset($_GET['is_active'])) {
        $id = (int) $_GET['id'];
        $isActive = (int) $_GET['is_active'];

        // Update the is_active status in the database
        $sql = "UPDATE items SET is_active = :is_active WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':is_active', $isActive, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
