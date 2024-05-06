<?php

$dsn = 'mysql:host=db;dbname=booksite;charset=utf8';
$username = 'root';
$password = 'lionPass';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$books = [];

if ($searchTerm) {
    $sql = "SELECT * FROM books WHERE title LIKE :searchTerm OR author LIKE :searchTerm";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['searchTerm' => "%$searchTerm%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM books");
}


$books = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<form method="get" action="editBooks.php">
    <label for="search">Search Book:</label>
    <input type="text" id="search" name="search" value="<?= htmlentities($searchTerm) ?>">
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
            <td><?= htmlentities($book['title']); ?></td>
            <td><?= htmlentities($book['author']); ?></td>
            <td><?= htmlentities($book['genre']); ?></td>
            <td><?= htmlentities($book['description']); ?></td>
            <td>
                <a href="editBookForm.php?id=<?= $book['id']; ?>">Edit</a> |
                <a href="deleteBooks.php?id=<?= $book['id']; ?>" onclick="return confirm('Delete this book?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php">Back to Main Page</a>
