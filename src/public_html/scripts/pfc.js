var time;
var cheat=false;
var cptr_fail = 0;
var est_j1;
var score;

var liste_choix_pfc = document.querySelectorAll(".bouton_pfc");

function handle_score(){
    let score1 = document.getElementById("pts_player1");
    let score2 = document.getElementById("pts_player2");
    if(est_j1){
        score1.innerHTML = score[0];
        score2.innerHTML = score[1];
    }
    else{
        score1.innerHTML = score[1];
        score2.innerHTML = score[0];
    }
}
function choix_pfc(){
    choix = this;
    preview = document.getElementById("choix_player1_preview");
    console.log(preview);
    if (choix.id === "rock_choice"){
        preview.src="../img/icons/rock.png"
    }
    else if (choix.id === "paper_choice"){
        preview.src="../img/icons/paper.png"
    }
    else if(choix.id === "scissors_choice"){
        preview.src="../img/icons/scissors.png"
    }
    else{
        preview.src="../img/icons/interrogation.png"
    }
}
function hanlde_red($data){
    window.location.href($data["red"]);
}

async function API_load() {
    const rep = await fetch("API/games/pfc.php?ID_Jeux="+encodeURIComponent(ID_Jeux)+"&token="+encodeURIComponent(token)+"&userID="+encodeURIComponent(UserID))
    const data = await rep.json();
    if(data["error"]){
        cptr_fail++;
        if(cptr_fail==3) location.reload();
        API_load();
        return;
    }
    cptr_fail = 0;
    if(data["action"]==="red") hanlde_red($data);
    time = data["time"];
    est_j1 = ! data["est_player2"];
    score = data["score"];
    handle_score();
    return data;
}

async function API_choix() {
    const rep = await fetch("API/games/pfc.php?ID_Jeux="+encodeURIComponent(ID_Jeux)+"&token="+encodeURIComponent(token)+"&userID="+encodeURIComponent(UserID))
    const data = await rep.json();
    return data;
}

async function API_cheatchoix() {
    const rep = await fetch("API/games/pfc.php?ID_Jeux="+encodeURIComponent(ID_Jeux)+"&token="+encodeURIComponent(token)+"&userID="+encodeURIComponent(UserID))
    const data = await rep.json();
    return data;
}

async function API_cheatinfo() {
    const rep = await fetch("API/games/pfc.php?ID_Jeux="+encodeURIComponent(ID_Jeux)+"&token="+encodeURIComponent(token)+"&userID="+encodeURIComponent(UserID))
    const data = await rep.json();
    return data;
}

async function API_cheatsus() {
    const rep = await fetch("API/games/pfc.php?ID_Jeux="+encodeURIComponent(ID_Jeux)+"&token="+encodeURIComponent(token)+"&userID="+encodeURIComponent(UserID))
    const data = await rep.json();
    return data;
}

action_to_handle_global = ["red", "error"]
lst_action_to_print = [ "load", "choix", "cheatchoix", "cheatinfo", "cheatsus"]
lst_action_to_handle = ["info", "time/err","time/err", "cheatinfo", "cheatsus"]