<?php include 'db.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <meta name="mobile-web-app-capable" content="yes">

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- Link to CSS -->
   <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<section class="playlist">
   <h3 class="heading">Music Playlist</h3>
   <div class="box-container">
      <a href="upload_music.php" class="add-btn"><i class="fas fa-plus"></i></a>
      <?php
         $select_songs = $conn->prepare("SELECT * FROM songs");
         $select_songs->execute();
         if ($select_songs->rowCount() > 0) {
            while ($fetch_song = $select_songs->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="box">
         <?php if (!empty($fetch_song['album'])) { ?>
            <img src="uploaded_album/<?= htmlspecialchars($fetch_song['album']); ?>" alt="Album Image" class="album">
         <?php } else { ?>
            <img src="images/disc.png" alt="Default Album" class="album">
         <?php } ?>
         <div>
            <div class="name"><?= htmlspecialchars($fetch_song['name']); ?></div>
            <div class="artist"><?= htmlspecialchars($fetch_song['artist']); ?></div>
         </div>
         <div class="flex">
            <div class="play" data-src="uploaded_music/<?= htmlspecialchars($fetch_song['music']); ?>"><i class="fas fa-play"></i></div>
            <a href="uploaded_music/<?= htmlspecialchars($fetch_song['music']); ?>" download><i class="fas fa-download"></i></a>
         </div>
      </div>
      <?php
         }
      } else {
         echo "<p>No songs available.</p>";
      }
      ?>
   </div>
</section>

<div class="music-player">
   <i class="fas fa-times" id="close"></i>
   <div class="box">
      <img src="images/disc.png" class="album" alt="">
      <div class="name"></div>
      <div class="artist"></div>
      <audio src="" controls class="music"></audio>
   </div>
</div>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
