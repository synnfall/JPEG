const images = ['./img/pfp/default_pfp.jpg', './img/icons/image_waiting_1.png', './img/icons/image_waiting_2.png', './img/icons/image_waiting_3.png']; // Tableau d'images
let index = 0;
const imgElement = document.getElementById('pfp_player2');

setInterval(() => {
  index = (index + 1) % images.length;
  imgElement.src = images[index];
}, 500); 


const h2 = document.getElementById("id_player2");
const originalText = h2.textContent;
const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
let interval;

function randomChar() {
  return chars[Math.floor(Math.random() * chars.length)];
}

function scramble() {
  const scrambled = originalText
    .split("")
    .map(c => (c === " " ? " " : randomChar()))
    .join("");
  h2.textContent = scrambled;
}

interval = setInterval(scramble, 10);