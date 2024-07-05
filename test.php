<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <p>Select the image to upload...</p>
        <input type="file" name="test_file" />
        <input type="submit" value="Upload File" name="upload" />
    </form>
</body>
</html>