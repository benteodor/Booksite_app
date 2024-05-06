<?php
$host = 'db';
$username = 'root';
$password = 'lionPass';
$database = 'booksite';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO books (title, author, publishing_year, genre, description) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $title, $author, $year, $genre, $description);

$title = $_POST['title'];
$author = $_POST['author'];
$year = $_POST['year'];
$genre = $_POST['genre'];
$description = $_POST['description'];

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<a href="index.php">Back</a>

