/**
 * Script Index, creation tableau jeux et tableau classement
 */

debug=true;

/**
 * GLOBAL VARIABLES
 */

if (debug) {
    data_caroussel = [
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
        "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla"
    ];

    data_classement = [
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
} else {
    data_caroussel = [];
    data_classement = [];
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
    message = get_message_bienvenue();
    h1 = html_message_bienvenue(message);
    
    div_titre = document.querySelector(".titre");
    div_titre.appendChild(h1);
}

function html_message_bienvenue(message) {
    text = document.createTextNode(message);
    h1 = document.createElement("h1");

    h1.appendChild(text);
    return h1
}

function remove_message_bienvenue() {
    div_bienvenue = document.querySelector(".titre")
    div_bienvenue.children["0"].remove();
}

function change_message_bienvenue() { // Non utilisée, a remove si besoins.
    remove_message_bienvenue();
    add_message_bienvenue();
}

function get_message_bienvenue() {
    messages = [
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

    const index_message_random = Math.floor(Math.random() * messages.length);

    if (debug) {
        console.log(index_message_random, messages[index_message_random]);
    };

    return messages[index_message_random];
}




/**
 * CAROUSSEL JEUX
 */

function add_carrousel_jeux(data) {

    div_caroussel = document.querySelector(".caroussel_jeux");
    
    if (data.length > 0) {
        table = html_carrousel_jeux(data);
        div_caroussel.appendChild(table);
    } else {
        table = html_carrousel_jeux(["Something went wrong"])
        div_caroussel.appendChild(table)
    }
}


/**
 * data : ["blablabla", "blablabla", "blablabla", "blablabla", "blablabla"]
 * @param {Array} data 
 */

function html_carrousel_jeux(data) {
    table = document.createElement("table");
    tr = document.createElement("tr");

    for (let i = 0; i < data.length; i++) {
        td = document.createElement("td");   

        style_td = get_style_td();
        contenu_td = td_carrousel_jeux(data[i]);

        td.appendChild(style_td);
        td.appendChild(contenu_td);
        tr.appendChild(td);
    }
    table.appendChild(tr);
    return table
}

function td_carrousel_jeux(content) {
    p = document.createElement("p");

    contenu = document.createTextNode(content);
    p.appendChild(contenu);

    return p
}

function get_style_td() {
    div = document.createElement("div") ;

    rand = Math.random(); // 0 ou 1

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
    table = document.createElement("table");

    for (let i = 0; i < classement.length; i++) { // parcourt de la liste ligne par ligne
        utilisateur = classement[i];
        
        // on récupère la data
        id = utilisateur.id;
        pfp = utilisateur.lien_pp;
        pseudo = utilisateur.pseudo;
        pts = utilisateur.points;

        // creation tr
        tr = create_tr_user(id, pfp, pseudo, pts);
        table.appendChild(tr);
    }
    
    div_classement = document.querySelector(".classement");
    div_classement.appendChild(table);
}

/**
 * USER TABLE CREATION
 * 
 * /!\ LIENS PFP & LIENS PROFILS PEUVENT CHANGER /!\
 */

function create_tr_user(id, pfp, pseudo, pts) {
    tr = document.createElement("tr");
    
    link = document.createElement("a");
    
    span_pfp = document.createElement("span");
    span_pseudo = document.createElement("span");
    span_score = document.createElement("span");
    
    img_pfp = document.createElement("img");

    // data
    // img_pfp.src = pfp;
    span_pfp.appendChild(img_pfp);

    span_pseudo.appendChild(document.createTextNode(pseudo));

    span_score.appendChild(document.createTextNode(pts));

    // lien profil
    link.href = "#TODO"

    // append
    link.appendChild(span_pfp);
    link.appendChild(span_pseudo);
    link.appendChild(span_score);
    tr.appendChild(link);
    return tr
}
