<!DOCTYPE html>
<html>
<head>
    <title>Image Editing Form</title>
</head>
<body>
    <h1>Image Editing Form</h1>

    <form method="POST" enctype="multipart/form-data" action="process.php">
        <label for="image">Select an Image:</label><br>
        <input type="file" name="image" id="image" required><br><br>

        <label for="text">Text:</label><br>
        <textarea name="text" id="text" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
