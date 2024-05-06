<?php
$host = 'db';
$username = 'root';
$password = 'lionPass';
$database = 'booksite';


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

   
    $sql = "DELETE FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);

 
    if ($stmt->execute()) {
       
        header("Location: editBooks.php");
        exit();
    } else {
        echo "Error deleting book.";
    }

    $stmt->close();
} else {
    echo "Book ID not provided.";
}

$conn->close();
?>
<a href="index.php">Back</a>

