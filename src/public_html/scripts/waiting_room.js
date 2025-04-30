const images = ['./img/pfp/default_pfp.jpg', './img/icons/image_waiting_1.png', './img/icons/image_waiting_2.png', './img/icons/image_waiting_3.png']; // Tableau d'images
let index = 0;
const imgElement = document.getElementById('pfp_player2');

setInterval(() => {
  index = (index + 1) % images.length;
  imgElement.src = images[index];
}, 500); 