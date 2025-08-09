function showRandomFlyer() {
  const flyer = document.getElementById('flyer');
  const screenW = window.innerWidth;
  const screenH = window.innerHeight;

  const randomX = Math.floor(Math.random() * (screenW - flyer.offsetWidth));
  const randomY = Math.floor(Math.random() * (screenH - flyer.offsetHeight));

  flyer.style.left = `${randomX}px`;
  flyer.style.top = `${randomY}px`;

  flyer.style.display = 'block';

  setTimeout(() => {
    flyer.style.display = 'none';
  }, 3000);
}

setInterval(() => {
  showRandomFlyer();
}, Math.floor(Math.random() * 10000) + 5000);
