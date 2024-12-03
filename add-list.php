<?php
// Database connection using PDO
$dsn = 'mysql:host=localhost;dbname=grocery_list';
$username = 'root'; // Update with your DB username
$password = ''; // Update with your DB password

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $itemName = $_POST['item_name'];

        if (!empty($itemName)) {
            // Insert into 'items' table
            $sql = "INSERT INTO items (name, is_active) VALUES (:name, 0)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $itemName);

            if ($stmt->execute()) {
                header("Location: ../index.php"); // Redirect back to the main page
                exit();
            } else {
                echo "Error: Unable to add the item.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
