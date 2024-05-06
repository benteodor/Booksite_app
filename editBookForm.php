<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>

<h2>Edit Book</h2>

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

  
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
?>
        <form method="post" action="updateBook.php">
            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>"><br>

            <label for="author">Author:</label><br>
            <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>"><br>

            <label for="genre">Genre:</label><br>
            <input type="text" id="genre" name="genre" value="<?php echo $book['genre']; ?>"><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description"><?php echo $book['description']; ?></textarea><br>

            <input type="submit" name="submit" value="Update Book">
        </form>
<?php
    } else {
        echo "Book not found";
    }

    $stmt->close();
} else {
    echo "Book ID not provided";
}


$conn->close();
?>
<a href="index.php">Back</a>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Teodor</p>
</footer>

</body>
</html>
