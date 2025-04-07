

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

bouton_toggle_login_into_signup=document.querySelector(".switch_login_into_signup");
bouton_toggle_login_into_signup.addEventListener("click",toggle_login_into_signup);

function toggle_login_into_signup(){
  let login_container=document.querySelector("#login_container");
  let signup_container=document.querySelector("#signup_container");
  login_container.classList.add('hidden');
  signup_container.classList.remove('hidden');
}

bouton_toggle_signup_into_login=document.querySelector(".switch_signup_into_login");
bouton_toggle_signup_into_login.addEventListener("click",toggle_signup_into_login);

function toggle_signup_into_login(){
  let login_container=document.querySelector("#login_container");
  let signup_container=document.querySelector("#signup_container");
  signup_container.classList.add('hidden');
  login_container.classList.remove('hidden');
}