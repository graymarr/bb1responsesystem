<?php
$pdo = new PDO("mysql:host=localhost:3307;dbname=simple_crud", "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['delete'])) {
        // Delete a message
        $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
        echo "Message deleted!";
    } elseif (isset($_POST['id'])) {
        // Edit an existing message
        $stmt = $pdo->prepare("UPDATE messages SET content = :content WHERE id = :id");
        $stmt->execute(['content' => $_POST['content'], 'id' => $_POST['id']]);
        echo "Message updated!";
    } else {
        // Insert new message
        $stmt = $pdo->prepare("INSERT INTO messages (content) VALUES (:content)");
        $stmt->execute(['content' => $_POST['content']]);
        echo "Message posted!";
    }
    exit;
}

// Fetch all messages
$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
