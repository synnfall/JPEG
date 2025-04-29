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
            "nbLikes" : 5
        }, {
            "ID" : 2,
            "nomJeux" : "d&d",
            "nbLikes" : 100
        }, {
            "ID" : 3,
            "nomJeux" : "Chess",
            "nbLikes" : 1250
        }, {
            "ID" : 4,
            "nomJeux" : "Fortnite",
            "nbLikes" : 2
        }, {
            "ID" : 5,
            "nomJeux" : "Minecraft",
            "nbLikes" : 305981
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

    // charge la description du jeux actif
    add_description_jeux_actif(data_classement);
    fetch("API/api_jeux.php")
        .then(rep => rep.json())
        .then(data => 
        {
            data_caroussel = data.games; // FIXME
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

    ////////////
    // let div = document.createElement("div");
    // div.className = "jeux"


    // if (content["ID"] != -1) {
        
    //     let pContenu = get_nom_jeux_td(content["nomJeux"]);
    //     let pLikes = get_likes_td(content["nbLikes"]);
    //     let btn_jouer = get_btn_jeux("#test"); // TODO
    
    
    //     div.appendChild(pContenu);
    //     div.appendChild(pLikes);
    //     div.appendChild(btn_jouer);
    // } else {
    //     let pContenu = get_nom_jeux_td(content["nomJeux"]);
    //     div.appendChild(pContenu);
    // }
    
    
    // return div;
    ////////////
}

/* DESCCRIPTIONS */
