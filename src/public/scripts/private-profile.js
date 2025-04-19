
const container = document.getElementById("container_pages_profile_buttons");


const button_settings = document.querySelector("#settings_button");
const button_friends = document.querySelector("#friends_button");
const button_stats = document.querySelector("#stats_button");

button_settings.addEventListener("click",button_settings_event);
button_friends.addEventListener("click",button_settings_event);
button_stats.addEventListener("click",button_settings_event);

function button_settings_event(){
    let bouton = this;
    let id_bouton = bouton.getAttribute('id');
    

    button_settings.classList.remove("bouton_courant");
    button_friends.classList.remove("bouton_courant");
    button_stats.classList.remove("bouton_courant");

    pages=document.querySelectorAll(".profile-page");
    console.log(id_bouton)
    console.log(pages)

    for (let i=0;i<pages.length;i++){
        pages[i].classList.add("hidden");
    }

    if (id_bouton === "settings_button"){
        pages[0].classList.remove("hidden");
    }else if (id_bouton === "friends_button"){
        pages[1].classList.remove("hidden");
    }else{
        pages[2].classList.remove("hidden");
    }

    bouton.classList.add("bouton_courant");
}