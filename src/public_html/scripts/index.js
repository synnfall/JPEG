/**
 * Script Index, creation tableau jeux et tableau classement
 */

debug=false;

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
        }
    ];
} else {
    var json_data;
    var data_caroussel = [];
    var data_classement = [];
}
/**
 * ONLOAD
*/

function html_onload() {
    // Charge le message de bienvenue
    add_message_bienvenue();

    // Charge le caroussel
    add_carrousel_jeux(data_caroussel);

    add_classement(data_classement);
    fetch("API/api_index.php")
        .then(rep => rep.json())
        .then(data => 
        {
            data_classement = data.classements;
            data_caroussel = data.games;
            add_classement(data_classement);
            add_carrousel_jeux(data_caroussel);
        }
    );
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
        "Gerbus Maxima !",
        "Eve a tenté d'intercepter la connexion 🫨",
        "Padolu Padolu",
        "Potato Pc",
        "Responsive ?",
        "Eddy pourquoi t'as ta capuche ?",
        "Eddy : 'Chépa comme ça.'",
        "Aline was here",
        "mdp : ADMIN1234 (non)",
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
        "Always wanna play, never wanna lose",
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
    div_caroussel.innerHTML = "";
    if (data.length > 0) {
        let table = html_carrousel_jeux(data);
        div_caroussel.appendChild(table);
    } else {
        let table = html_carrousel_jeux([{
            "ID" : -1,
            "nomJeux" : "Chargement en cours...",
            "nbLikes" : -1
        }])
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

function td_carrousel_jeux(content) { // ID; nomJeux; nbLikes.
    let div = document.createElement("div");
    div.className = "jeux"


    if (content["ID"] != -1) {
        
        let pContenu = get_nom_jeux_td(content["nomJeux"]);
        let pLikes = get_likes_td(content["nbLikes"]);
        let btn_jouer = get_btn_jeux("waiting_room.php?ID_Jeux="+content["ID"]);
    
    
        div.appendChild(pContenu);
        div.appendChild(pLikes);
        div.appendChild(btn_jouer);
    } else {
        let pContenu = get_nom_jeux_td(content["nomJeux"]);
        div.appendChild(pContenu);
    }
    
    
    return div;
}

function get_nom_jeux_td(nomJeux) {
    let pContenu = document.createElement("p");
    pContenu.className = "nomJeux";
    
    let contenu = document.createTextNode(nomJeux);

    pContenu.appendChild(contenu);
    return pContenu;
}

function get_likes_td(nbLikes) {
    let text_likes_gauche = document.createTextNode("Apprecié par ");
    let text_likes_droit = document.createTextNode(" personnes");
    let nb_likes = document.createTextNode(nbLikes);
    
    
    let likes = document.createElement("div");
    likes.className = "nbLikes";
    likes.appendChild(nb_likes);
    
    
    let pLikes = document.createElement("p");
    pLikes.className = "pLikes";

    pLikes.appendChild(text_likes_gauche);
    pLikes.appendChild(likes);
    pLikes.appendChild(text_likes_droit);
    return pLikes;
}

function get_btn_jeux(link) {
    let a = document.createElement("a");
    a.className = "btnJeux";
    a.href = link;

    a.appendChild(document.createTextNode("Jouer"));

    return a
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

    if (classement.length > 0) {        
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
    } else {
        let tr = document.createElement("tr");
        let td = document.createElement("td");
        td.appendChild(document.createTextNode("Chargement en cours.."));
        tr.appendChild(td);
        table.appendChild(tr);
        //table.appendChild(create_tr_user(0, "rang", "./img/pfp/default_pfp.jpg", "Une erreur est survenue", "pts"))
    }
        
    let div_classement = document.querySelector(".classement");
    div_classement.innerHTML = "";
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
    link.href = "./public-profile.php?id="+id;

    // append
    link.appendChild(span_pfp);
    link.appendChild(span_rank);
    link.appendChild(span_pseudo);
    link.appendChild(span_score);
    tr.appendChild(link);
    return tr
}

