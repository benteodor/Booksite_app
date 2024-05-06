<!DOCTYPE html>
<html>
<head>
    <title>List of Books</title>
</head>
<body>

<h2>List of Books</h2>

<?php

$servername = "db";
$username = "root";
$password = "lionPass";
$dbname = "booksite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$books = [];
if (isset($_GET['search'])) {
    $searchTerm = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM books WHERE title LIKE '%$searchTerm%' OR author LIKE '%$searchTerm%'";
} else {
    $sql = "SELECT * FROM books";
}
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $books = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "No books found";
}

$conn->close();
?>

<form method="get" action="editBooks.php">
    <label for="search">Search Book:</label>
    <input type="text" id="search" name="search">
    <input type="submit" value="Search">
</form>

<table border="1">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    <?php foreach ($books as $book) : ?>
        <tr>
            <td><?= $book['title']; ?></td>
            <td><?= $book['author']; ?></td>
            <td><?= $book['genre']; ?></td>
            <td><?= $book['description']; ?></td>
            <td><a href="editBookForm.php?id=<?= $book['id']; ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php">Back to Main Page</a>

<footer>
    <p>&copy; <?= date("Y"); ?> Teodor</p>
</footer>

</body>
</html>
