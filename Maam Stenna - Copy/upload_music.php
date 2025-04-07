<?php
include 'db.php';

// Ensure the upload directories exist
if (!file_exists('uploaded_album')) {
    mkdir('uploaded_album', 0777, true);
}

if (!file_exists('uploaded_music')) {
    mkdir('uploaded_music', 0777, true);
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $artist = $_POST['artist'];
    $albumImage = $_FILES['album']['name'];
    $musicFile = $_FILES['music']['name'];

    $albumTarget = 'uploaded_album/' . basename($albumImage);
    $musicTarget = 'uploaded_music/' . basename($musicFile);

    // Check for upload errors
    if ($_FILES['album']['error'] === UPLOAD_ERR_OK && $_FILES['music']['error'] === UPLOAD_ERR_OK) {
        // Move the uploaded files to the target directories
        if (move_uploaded_file($_FILES['album']['tmp_name'], $albumTarget) && move_uploaded_file($_FILES['music']['tmp_name'], $musicTarget)) {
            // Prepare and execute the SQL insert query
            $insert = $conn->prepare("INSERT INTO `songs` (`name`, `artist`, `album`, `music`) VALUES (?, ?, ?, ?)");
            $insert->execute([$name, $artist, $albumImage, $musicFile]);

            // Redirect after successful upload
            header("Location: index.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "Failed to move files.";
        }
    } else {
        echo "Error in file upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Upload Music</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <section class="form-container">

   <form action="upload_music.php" method="POST" enctype="multipart/form-data">
         <h1>Upload New Music</h1>
         <p>music name <span>*</span></p>
         <input type="text" name="name" placeholder="enter music name" required maxlength="100" class="box">
         <p>artist name</p>
         <input type="text" name="artist" placeholder="enter artist name" maxlength="100" class="box">
         <p>select music <span>*</span></p>
         <input type="file" name="music" class="box" required accept="audio/*">
         <p>select album</p>
         <input type="file" name="album" class="box" accept="image/*">
         <input type="submit" value="upload music" class="btn" name="submit">
         <a href="index.php" class="option-btn">go to home</a>
   </section>

   
</body>
</html>

<?php
include 'db.php';

// Ensure the upload directories exist
if (!file_exists('uploaded_album')) {
    mkdir('uploaded_album', 0777, true);
}

if (!file_exists('uploaded_music')) {
    mkdir('uploaded_music', 0777, true);
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $artist = $_POST['artist'];
    $albumImage = $_FILES['album']['name'];
    $musicFile = $_FILES['music']['name'];

    $albumTarget = 'uploaded_album/' . basename($albumImage);
    $musicTarget = 'uploaded_music/' . basename($musicFile);

    // Check for upload errors
    if ($_FILES['album']['error'] === UPLOAD_ERR_OK && $_FILES['music']['error'] === UPLOAD_ERR_OK) {
        // Move the uploaded files to the target directories
        if (move_uploaded_file($_FILES['album']['tmp_name'], $albumTarget) && move_uploaded_file($_FILES['music']['tmp_name'], $musicTarget)) {
            // Prepare and execute the SQL insert query
            $insert = $conn->prepare("INSERT INTO songs (name, artist, album, music) VALUES (?, ?, ?, ?)");
            $insert->execute([$name, $artist, $albumImage, $musicFile]);

            // Redirect after successful upload
            header("Location: index.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "Failed to move files.";
        }
    } else {
        echo "Error in file upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="mobile-web-app-capable" content="yes">
   <title>Upload Music</title>
   <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
   <section class="form-container">

      <form action="upload_music.php" method="POST" enctype="multipart/form-data">
         <h1>Upload New Music</h1>
         <p>music name <span>*</span></p>
         <input type="text" name="name" placeholder="enter music name" required maxlength="100" class="box">
         <p>artist name</p>
         <input type="text" name="artist" placeholder="enter artist name" maxlength="100" class="box">
         <p>select music <span>*</span></p>
         <input type="file" name="music" class="box" required accept="audio/*">
         <p>select album</p>
         <input type="file" name="album" class="box" accept="image/*">
         <input type="submit" value="upload music" class="input-btn" name="submit">
         <a href="index.php" class="option-btn">go to home</a>
      </form>
   </section>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

   
</body>
</html>