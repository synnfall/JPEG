/**
 * Script Classements, creation div jeux & tableaux
 */

debug=false;

/**
 * TEST DATA
 */

if (debug) {

    var data_classements = [
        {
            "nomJeux" : "Echecs",
            "classement" : [
                {
                    "identifiant" : "Th3_Warior",
                    "pts" : 1234
                },
                {
                    "identifiant" : "Teva",
                    "pts" : 1233
                },
                {
                    "identifiant" : "Bounci",
                    "pts" : 122
                },
                {
                    "identifiant" : "Eddy",
                    "pts" : 120
                }
            ]
        },
        {
            "nomJeux" : "Minecraft",
            "classement" : [
                {
                    "identifiant" : "Th3_Warior",
                    "pts" : 1234
                },
                {
                    "identifiant" : "Teva",
                    "pts" : 1233
                },
                {
                    "identifiant" : "Bounci",
                    "pts" : 122
                },
                {
                    "identifiant" : "Eddy",
                    "pts" : 120
                }
            ]
        }
    ];

} else {
    /**
     * GLOBAL VARIABLE.S
     */

    var data_classements;
}

/**
 * ONLOAD
 */

function html_onload() {
    // charge les classements
    add_classements_par_jeux(data_classements);

    fetch("API/api_classements.php")
        .then(rep => rep.json())
        .then(data =>
        {
            data_classements = data;
            add_classements_par_jeux(data_classements);
        }
    );
}

function add_classements_par_jeux(data_classements) {
    let div_classement = document.querySelector(".classements");
    for (let jeux in data_classements) {
        let div = html_classement_jeux(data_classements[jeux]);

        div_classement.appendChild(div);
    }
}

function html_classement_jeux(jeux) {
    let div = document.createElement("div");
    div.className = "jeux";

    let h3 = document.createElement("h3");
    h3.innerHTML = jeux["nomJeux"];

    let a = document.createElement("a");
    a.className = "succes";
    a.innerHTML = "Voir le Jeux";
    a.href = ""; // TODO

    let table = html_table(jeux["classement"]);
    
    div.appendChild(h3);
    // div.appendChild(a); // TODO
    div.appendChild(table);

    return div;
}

function html_table(classement) {
    let table = document.createElement("table");
    let thead = html_thead();
    let tbody = document.createElement("tbody");
    

    for (let i=0;i<classement.length;i++) {
        let tr = html_tr(classement[i], i+1);
        tbody.appendChild(tr);
    }
    table.appendChild(thead)
    table.appendChild(tbody);
    return table;
}

function html_thead() {
    let thead = document.createElement("thead");
    let tr = document.createElement("tr");
    let joueur = document.createElement("th");
    joueur.innerHTML = "Joueur"
    let rang = document.createElement("th");
    rang.innerHTML = "Rang"
    let pts = document.createElement("th");
    pts.innerHTML = "Points"

    tr.appendChild(joueur);
    tr.appendChild(rang);
    tr.appendChild(pts);
    thead.appendChild(tr)
    return thead
}

function html_tr(joueur, i) {
    let tr = document.createElement("tr");
    let identifiant = html_td(joueur["identifiant"]);
    let rang = html_td(i);
    let pts = html_td(joueur["pts"]);

    tr.appendChild(identifiant);
    tr.appendChild(rang);
    tr.appendChild(pts);
    return tr;
}

function html_td(elt) {
    let td = document.createElement("td");
    td.innerHTML = elt;
    return td;
}