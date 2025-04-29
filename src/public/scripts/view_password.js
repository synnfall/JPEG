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

