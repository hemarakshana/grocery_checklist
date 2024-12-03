<?php
// Database connection using PDO
$dsn = 'mysql:host=localhost;dbname=grocery_list';
$username = 'root'; // Update with your DB username
$password = ''; // Update with your DB password

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if an ID is provided
    if (isset($_GET['id'])) {
        $itemId = $_GET['id'];

        // Delete from 'items' table
        $sql = "DELETE FROM items WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $itemId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: ../index.php"); // Redirect back to the main page
            exit();
        } else {
            echo "Error: Unable to delete the item.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
