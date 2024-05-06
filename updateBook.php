<?php
function getConnection()
{
    $host = 'db';
    $username = 'root';
    $password = 'lionPass';
    $database = 'booksite';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function updateBookDetails()
{
    $conn = getConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $book_id = $_POST['book_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];

        $sql = "UPDATE books SET title=?, author=?, genre=?, description=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $author, $genre, $description, $book_id);

        if ($stmt->execute()) {
            echo "Book details updated successfully";
        } else {
            echo "Error updating book details";
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: editBookForm.php");
        exit();
    }
}

updateBookDetails();
?>

<a href="index.php">Back to Main Page</a>
