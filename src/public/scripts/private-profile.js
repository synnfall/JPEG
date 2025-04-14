
const triangle = document.getElementById("cursor_triangle");
const container = document.getElementById("container_pages_profile_buttons");

var coord_triangle = -225;

container.addEventListener("mousemove", (e) => {
    const y = e.clientY - (445);
    triangle.style.transform = `translateY(${y}px)`;
});

container.addEventListener("mouseleave", () => {
    triangle.style.transform = `translateY(${coord_triangle}px)`;
});

const button_settings = document.querySelector("#settings_button");
const button_friends = document.querySelector("#friends_button");
const button_stats = document.querySelector("#stats_button");

button_settings.addEventListener("click",button_settings_event);
button_friends.addEventListener("click",button_settings_event);
button_stats.addEventListener("click",button_settings_event);

function button_settings_event(){
    let bouton = this;
    let id_bouton = bouton.getAttribute('id');
    let coord = bouton.getBoundingClientRect();
    coord_triangle=(coord.top-445) + (coord.height/2);

    button_settings.style.backgroundColor = "";
    button_friends.style.backgroundColor = "";
    button_stats.style.backgroundColor = "";

    bouton.style.backgroundColor = "#FFB433";
}