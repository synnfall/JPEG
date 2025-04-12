/**
 * Script Index, creation tableau jeux et tableau classement
 */

debug=true;

/**
 * GLOBAL VARIABLES
 */

if (debug) {
    var data_caroussel = [
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla"
    ];

    var data_classement = [
        {
            "pseudo" : "Aline",
            "points" : 1234,
            "id"     : 2,
            "lien_pp": "./img/pfp/default_pfp.jpg"
        }, {
            "pseudo" : "Teva",
            "points" : 123,
            "id"     : 1,
            "lien_pp": "./img/pfp/default_pfp.jpg"
        }, {
            "pseudo" : "Eddy",
            "points" : 112,
            "id"     : 3,
            "lien_pp": "./img/pfp/default_pfp.jpg"
        }, {
            "pseudo" : "Lucas",
            "points" : 2,
            "id"     : 4,
            "lien_pp": "./img/pfp/default_pfp.jpg"
        }, {
            "pseudo" : "Evan",
            "points" : -125642,
            "id"     : 5,
            "lien_pp": "./img/pfp/default_pfp.jpg"
        },     
    ];
    const json_data = fetch("../API/api_index.php").then(console.log);
} else {

    var data_caroussel = [];
    var data_classement = [];
}
/**
 * ONLOAD
 */


function html_onload() {
    // Charge le message de bienvenue
    add_message_bienvenue(); // TODO

    // Charge le caroussel
    add_carrousel_jeux(data_caroussel);

    // Charge le classement
    add_classement(data_classement); // TODO
}


/**
 * MESSAGE BIENVENUE
 */

function add_message_bienvenue() {
    let message = get_message_bienvenue();
    let h1 = html_message_bienvenue(message);
    
    let div_titre = document.querySelector(".titre");
    div_titre.appendChild(h1);
}

function html_message_bienvenue(message) {
    let text = document.createTextNode(message);
    let h1 = document.createElement("h1");

    h1.appendChild(text);
    return h1
}

function remove_message_bienvenue() {
    let div_bienvenue = document.querySelector(".titre")
    div_bienvenue.children["0"].remove();
}

function change_message_bienvenue() { // Non utilisée, a remove si besoins.
    remove_message_bienvenue();
    add_message_bienvenue();
}

function get_message_bienvenue() {
    let messages = [
        "EsT-cE qUe cE sItE eST cOnvErtIt eN PdF ?!?",
        "Aline was here",
        ":3",
        "Message de malvenue.md",
        "Google 'en passant'.",
        "Minecraft 2.0 is out !",
        "Made with love !",
        "echo 'bonjour {$user}'",
        "Il est ou le 20/20?",
        "The lie is a cake?",
        "The cake is a lie.",
        "Veni Vidi Vici.",
        "Tricher ?!? Nous ?",
        "Perdre ? C'est du passé.",
        "Vous allez aimer gagner.",
        "La gloire est uniquement dans la victoire!",
        "Jouer c'est bien, Gagner c'est mieux!",
        "Jouer. Pour. Être. Gagnant.",
        "J.P.E.G.",
    ];

    let index_message_random = Math.floor(Math.random() * messages.length);

    if (debug) {
        console.log(index_message_random, messages[index_message_random]);
    };

    return messages[index_message_random];
}




/**
 * CAROUSSEL JEUX
 */

function add_carrousel_jeux(data) {

    let div_caroussel = document.querySelector(".caroussel_jeux");
    
    if (data.length > 0) {
        let table = html_carrousel_jeux(data);
        div_caroussel.appendChild(table);
    } else {
        let table = html_carrousel_jeux(["Something went wrong"])
        div_caroussel.appendChild(table)
    }
}


/**
 * data : ["blablabla", "blablabla", "blablabla", "blablabla", "blablabla"]
 * @param {Array} data 
 */

function html_carrousel_jeux(data) {
    let table = document.createElement("table");
    let tr = document.createElement("tr");

    for (let i = 0; i < data.length; i++) {
        let td = document.createElement("td");   

        let style_td = get_style_td();
        let contenu_td = td_carrousel_jeux(data[i]);

        td.appendChild(style_td);
        td.appendChild(contenu_td);
        tr.appendChild(td);
    }
    table.appendChild(tr);
    return table
}

function td_carrousel_jeux(content) {
    let p = document.createElement("p");

    let contenu = document.createTextNode(content);
    p.appendChild(contenu);

    return p
}

function get_style_td() {
    let div = document.createElement("div") ;

    let rand = Math.random(); // 0 ou 1

    if (rand > 0.5) {
        div.className = "backBlur bleu"
    } else {
        div.className = "backBlur vert"
    }

    return div
}

/**
 * CLASSEMENTS
 */

/**
 * @param {[{"pseudo" : string,"points" : int,"id" : int,"lien_pp": string}]} classement 
 */
function add_classement(classement) {
    let table = document.createElement("table");

    for (let i = 0; i < classement.length; i++) { // parcourt de la liste ligne par ligne
        let utilisateur = classement[i];
        
        // on récupère la data
        let id = utilisateur.id;
        let pfp = utilisateur.lien_pp;
        let pseudo = utilisateur.pseudo;
        let pts = utilisateur.points;

        // creation tr
        let tr = create_tr_user(id, i+1, pfp, pseudo, pts);
        table.appendChild(tr);
    }
    
    let div_classement = document.querySelector(".classement");
    div_classement.appendChild(table);
}

/**
 * USER TABLE CREATION
 * 
 * /!\ LIENS PFP & LIENS PROFILS PEUVENT CHANGER /!\
 */

function create_tr_user(id, rank, pfp, pseudo, pts) {
    let tr = document.createElement("tr");
    
    let link = document.createElement("a");
    
    let span_pfp = document.createElement("span");
    let span_rank = document.createElement("span");
    let span_pseudo = document.createElement("span");
    let span_score = document.createElement("span");
    
    let img_pfp = document.createElement("img");

    // data
    img_pfp.src = pfp;
    span_pfp.appendChild(img_pfp);

    span_rank.appendChild(document.createTextNode(rank));

    span_pseudo.appendChild(document.createTextNode(pseudo));

    span_score.appendChild(document.createTextNode(pts));

    // lien profil
    link.href = "#TODO"

    // append
    link.appendChild(span_pfp);
    link.appendChild(span_rank);
    link.appendChild(span_pseudo);
    link.appendChild(span_score);
    tr.appendChild(link);
    return tr
}



/**
 * DATA RETRIEVING
 */


function get_caroussel() {



    return
}