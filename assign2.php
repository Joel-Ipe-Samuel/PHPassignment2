<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2</title>
</head>
<body>
    <h2>Add a New Post</h2>
    <form action="assign2.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required><br><br>

        <button type="submit">Submit Post</button>
    </form>

    <?php
    //Database connection parameters
    $host = 'localhost';
    $db = 'assign';
    $user = 'root';
    $pass = 'italia23as';

    //Connect to the database
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Could not connect to the database: " . $e->getMessage());
    }

    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];

        // Insert the post into the database
        //create a database with any name
        //use that database and create a table with the below parameters 
        //create table posts(title varchar(50),content(500),author(50));
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, author) VALUES (:title, :content, :author)");
        $stmt->execute([
            'title' => $title,
            'content' => $content,
            'author' => $author
        ]);

        echo "<p>Post added successfully!</p>";
    }
    ?>
</body>
</html>
