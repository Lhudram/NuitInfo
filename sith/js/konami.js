myAudio = new Audio('sound/konamiSound.ogg');
myAudio.addEventListener('ended', function() {
    this.currentTime = 0;
    this.play();
}, false);

cheet('↑ ↑ ↓ ↓ ← → ← → b a', function () {
  myAudio.play();
  var konami = document.getElementById("konami").style;
  konami.opacity = 1;
  konami.width = '200vh';
  konami.height = '200vh';
  konami.marginTop = '-100vh';
  konami.marginLeft = '-100vh';
  }
);
