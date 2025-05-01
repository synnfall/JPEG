/**
 * Script affichage liste jeux + descriptions
 */

debug=true;

/**
 * GLOBAL VARIABLES
 */

if (debug) { // test data sans API
    var data_caroussel = [
        {
            "ID" : 1,
            "nomJeux" : "MyAwesomeGames",
            "nbLikes" : 5,
            "description" : "Il s'agit d'un test d'envergure minimale, qui n'affectera en rien le cour du temps ou bien les évènements historiques"
        }, {
            "ID" : 2,
            "nomJeux" : "d&d",
            "nbLikes" : 100,
            "description" : "petit test"
        }, {
            "ID" : 3,
            "nomJeux" : "Chess",
            "nbLikes" : 1250,
            "description" : "N/A"
        }, {
            "ID" : 5,
            "nomJeux" : "Fortnite",
            "nbLikes" : 1,
            "description" : ""
        }, {
            "ID" : 150,
            "nomJeux" : "Minecraft",
            "nbLikes" : 305981,
            "description" : "test"
        }
    ];
} else {
    var json_data;
    var data_caroussel = [];
}
/**
 * ONLOAD
*/

function html_onload() {

    // Charge le caroussel
    add_carrousel_jeux(data_caroussel);

    fetch("API/api_jeux.php")
        .then(rep => rep.json())
        .then(data => 
        {
            data_caroussel = data;
            add_carrousel_jeux(data_caroussel);
        }
    );
}


/**
 * CAROUSSEL JEUX
 */

function add_carrousel_jeux(data) {

    let table_caroussel = document.querySelector(".caroussel");
    table_caroussel.innerHTML = "";
    if (data.length > 0) {
        let table = html_carrousel_jeux(data);
        table_caroussel.appendChild(table);
    } else {
        let table = html_carrousel_jeux([{
            "ID" : -1,
            "nomJeux" : "Chargement en cours...",
            "nbLikes" : -1
        }])
        table_caroussel.appendChild(table)
    }
}


/**
 * data : ["blablabla", "blablabla", "blablabla", "blablabla", "blablabla"]
 * @param {Array} data 
 */

function html_carrousel_jeux(data) {
    let tr = document.createElement("tr");

    for (let i = 0; i < data.length; i++) {

        let td = td_carrousel_jeux(data[i]);
        td.id = i;

        td.addEventListener("click", update_description);

        tr.appendChild(td);
    }
    return tr
}

function td_carrousel_jeux(content) { // ID; nomJeux; nbLikes.
    let td = document.createElement("td");

    let p_jeux = document.createElement("p");
    p_jeux.innerHTML = content["nomJeux"];

    // // // 
    let div_likes = document.createElement("div");
    
    let img_likes = document.createElement("img");
    img_likes.src = "img/icons/ratio_plus.svg"
    
    let p_likes = document.createElement("p");
    p_likes.innerHTML = content["nbLikes"];

    div_likes.appendChild(img_likes);
    div_likes.appendChild(p_likes)
    // // //

    let bouton = document.createElement("span");
    bouton.className = "bouton"
    bouton.innerHTML = "En savoir plus"

    td.appendChild(p_jeux);
    td.appendChild(div_likes);
    td.appendChild(bouton);

    return td
}

/**
 * DESCRIPTIONS 
 **/

function get_desc_jeux(data) {
    // nomjeux
    let titre = document.querySelector(".description h2");
    titre.innerHTML = data["nomJeux"];

    let div_contenu = document.querySelector(".contenu");
    
    let description = document.createElement("p");
    if (data["description"] === "") {
        description.innerHTML = "Aucune description"
    } else {
        description.innerHTML = data["description"]
    }

    let img_jeux = document.createElement("img");
    // img_jeux.src = "./img/games/"+data["nomJeux"];
    img_jeux.src = "./img/pfp/uther.jpg"

    
    div_contenu.appendChild(description);
    div_contenu.appendChild(img_jeux);
}


function update_description() {
    let bouton=this;
    try {document.querySelector(".active").className = ""}
    catch {console.log("aucun bouton actif")};

    bouton.className = "active";

    jouer=document.querySelector("#bouton_jouer");
    id_bouton = bouton.id
    jouer.href="waiting_room.php?ID_Jeux="+data_caroussel[id_bouton]["ID"];
    
    // on suprime la description actuelle
    delete_description();
    get_desc_jeux(data_caroussel[bouton.id]);

    ajoute_like(); 
}


function delete_description() {
    let div_contenu = document.querySelector(".contenu")
    while (div_contenu.firstChild) {
        div_contenu.removeChild(div_contenu.firstChild);
    }

    let titre = document.querySelector(".description h2");
    titre.innerHTML = "Chargement..."
}


function ajoute_like(){

    const boutonLike = document.querySelector("#bouton_like");
    boutonLike.addEventListener("click", () => {
        if (!data_caroussel[activeJeuIndex]) return;

        const jeu = data_caroussel[activeJeuIndex];

        fetch("API/api_like_jeux.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id_jeux=${encodeURIComponent(jeu.ID)}`
        })
        .then(rep => rep.json())
        .then(data => {
            if (data.result) {
                alert("Like ajouté !");
                add_carrousel_jeux(data_caroussel); 
            } else {
                alert("Erreur : " + data.message);
            }
        });
    });

}

