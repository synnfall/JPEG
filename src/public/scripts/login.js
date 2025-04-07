

toggle_eye=document.querySelectorAll(".toggle-eye");
toggle_eye[0].addEventListener("click",hide_and_show_password);
toggle_eye[1].addEventListener("click",hide_and_show_password);

function hide_and_show_password(){
  let passwordInput = document.querySelectorAll(".password");
  let eyeIcon = document.querySelectorAll(".toggle-eye");

  for (let i=0;eyeIcon.length;i++){
    if (passwordInput[i].type === "password"){

      
        passwordInput[i].type = "text";
        eyeIcon[i].src = "./img/icons/show.png";
        eyeIcon[i].classList.add('rotated');
    

    } else{
      passwordInput[i].type = "password";
      eyeIcon[i].src = "./img/icons/hide.png";
      eyeIcon[i].classList.remove('rotated');
    }
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