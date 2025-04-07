let playBtn = document.querySelectorAll('.playlist .box-container .box .play');
let musicPlayer = document.querySelector('.music-player');
let musicAlbum = musicPlayer.querySelector('.album');
let musicName = musicPlayer.querySelector('.name');
let musicArtist = musicPlayer.querySelector('.artist');
let music = musicPlayer.querySelector('.music');

playBtn.forEach(play => {
   play.onclick = () => {
      // Get the music file source from data-src
      let src = play.getAttribute('data-src');
      let box = play.parentElement.parentElement;
      let name = box.querySelector('.name');
      let album = box.querySelector('.album');
      let artist = box.querySelector('.artist');

      // Log values for debugging
      console.log('Music Source:', src);
      console.log('Album Image Source:', album.src);
      console.log('Song Name:', name.innerHTML);
      console.log('Artist Name:', artist.innerHTML);

      // Ensure that src is not empty or invalid
      if (src) {
         // Set the album image for the music player
         musicAlbum.src = album.src; // This sets the album image for the player

         // Set the music name and artist in the player
         musicName.innerHTML = name.innerHTML;
         musicArtist.innerHTML = artist.innerHTML;

         // Set the audio source and make sure it's updated
         music.src = src;

         // Ensure the audio source is loaded
         music.load(); // Reload the audio element to make sure the new src is loaded

         // Log the new audio source
         console.log('Audio Source Set:', music.src);

         // Show the music player and start playing
         musicPlayer.classList.add('active');

         // Add an event listener to handle successful playback and errors
         music.play()
            .then(() => {
               console.log('Music is playing');
            })
            .catch(error => {
               console.error('Error playing audio:', error);
               // Optional: Display an error message to the user
               alert('Sorry, there was an error playing the audio.');
            });

      } else {
         console.error('Invalid audio source');
         alert('Audio source is invalid.');
      }
   }
});

// Close the music player
document.querySelector('#close').onclick = () => {
   musicPlayer.classList.remove('active');
   music.pause(); // Pause the music when closing the player
   music.src = ''; // Clear the audio source when closing
   console.log('Player closed and audio source cleared');
};
