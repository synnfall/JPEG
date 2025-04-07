

toggle_eye=document.querySelector(".toggle-eye");
toggle_eye.addEventListener("click",hide_and_show_password);

function hide_and_show_password(){
  let passwordInput = document.querySelector("#password");
  let eyeIcon = document.querySelector(".toggle-eye");

  if (passwordInput.type === "password"){
    passwordInput.type = "text";
    eyeIcon.src = "./img/icons/Show.png";
    eyeIcon.classList.add('rotated');
  } else{
    passwordInput.type = "password";
    eyeIcon.src = "./img/icons/Hide.png";
    eyeIcon.classList.remove('rotated');
  }
}

remeberme=document.querySelector(".remember input");
rememberme.addEventListener("click",rememberme_or_not);

function rememberme_or_not(){
  
}