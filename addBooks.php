<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
</head>
<body>

<h2>Add New Book</h2>

<form action="addBookAction.php" method="post">
    <label>Title:</label><br>
    <input type="text" name="title" required><br>
    
    <label>Author:</label><br>
    <input type="text" name="author" required><br>
    
    <label>Year:</label><br>
    <input type="number" name="year" required><br>
    
    <label>Genre:</label><br>
    <input type="text" name="genre" required><br>
    
    <label>Description:</label><br>
    <textarea name="description" required></textarea><br>
    
    <input type="submit" value="Add Book">
</form>

<a href="index.php">Back</a>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Dana Popa</p>
</footer>

</body>
</html>
