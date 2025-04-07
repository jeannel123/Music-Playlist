<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Upload</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 70px; /* For navbar spacing */
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .playlist .box img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .playlist .box {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Music App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload_music.php">Upload Music</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Music Upload Form -->
    <section id="upload" class="content-section">
        <div class="container">
            <h2 class="text-center mb-4">Upload New Music</h2>
            <div class="form-container">
                <form action="upload_music.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="name">Music Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter music name" required maxlength="100">
                        <div class="invalid-feedback">Please provide a music name.</div>
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist Name</label>
                        <input type="text" name="artist" id="artist" class="form-control" placeholder="Enter artist name" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="music">Select Music File <span class="text-danger">*</span></label>
                        <input type="file" name="music" id="music" class="form-control-file" required accept="audio/*">
                        <div class="invalid-feedback">Please select a music file.</div>
                    </div>
                    <div class="form-group">
                        <label for="album">Select Album Image</label>
                        <input type="file" name="album" id="album" class="form-control-file" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Upload Music</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Playlist Section -->
    <section id="playlist" class="content-section">
        <div class="container">
            <h2 class="text-center mb-4">Music Playlist</h2>
            <div class="row">
                <?php
                $select_songs = $conn->prepare("SELECT * FROM `songs`");
                $select_songs->execute();
                if ($select_songs->rowCount() > 0) {
                    while ($fetch_song = $select_songs->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="box">
                        <?php if (!empty($fetch_song['album'])) { ?>
                            <img src="uploaded_album/<?= htmlspecialchars($fetch_song['album']); ?>" alt="Album Image">
                        <?php } else { ?>
                            <img src="images/disc.png" alt="Default Album">
                        <?php } ?>
                        <h5><?= htmlspecialchars($fetch_song['name']); ?></h5>
                        <p><?= htmlspecialchars($fetch_song['artist']); ?></p>
                        <div>
                            <a href="uploaded_music/<?= htmlspecialchars($fetch_song['music']); ?>" class="btn btn-success btn-sm" download>Download</a>
                            <button class="btn btn-primary btn-sm">Play</button>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center'>No songs available.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Bootstrap form validation
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>

