/**
 * Script Index, creation tableau jeux et tableau classement
 */

data = [
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla",
    "Lorem ipsum dolor sit amet consectetur, adipisicing elit. blabla"
]


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
    }

}

function td_carrousel_jeux(content) {
    p = document.createElement("p");

    contenu = document.createTextNode(content);
    p.appendChild(contenu);

    return p
}

function get_style_td() {
    div = document.createElement("div") ;

    rand = Math.floor(Math.random()); // 0 ou 1

    if (rand === 0) {
        div.className = "backBlur bleu"
    } else {
        div.className = "backBlur vert"
    }

    return div
}
