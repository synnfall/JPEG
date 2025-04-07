/**
 * Script Index, creation tableau jeux et tableau classement
 */


/**
 * GLOBAL VARIABLES
 */

data_caroussel = [
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla"
]

data_classement = [

]

/**
 * ONLOAD
 */


function html_onload() {
    // Charge le message de bienvenue
    // add_message_bienvenue(); // TODO


    // Charge le caroussel
    add_carrousel_jeux(data_caroussel);

    // Charge le classement
    // add_classement(data_classement); // TODO
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

