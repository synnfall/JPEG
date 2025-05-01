var time;
var cheat=false;
var cptr_fail = 0;
var est_j1;
var score;
var countdownInterval = null;

var liste_choix_pfc = document.querySelectorAll(".bouton_pfc");

choix_to_link ={
    0: "../img/icons/interrogation.png",
    1: "../img/icons/rock.png",
    2: "../img/icons/paper.png",
    3: "../img/icons/scissors.png"
}
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
lst_bouton_choix = ["rock_choice", "paper_choice", "scissors_choice"]

function update_timer(temps){
    document.getElementById("timer").innerHTML = temps;
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
function handle_red(data){
    window.location.href(data["red"]);
}

function affiche_choix(choix){
    if ([1, 2, 3].includes(choix)) {
        link = choix_to_link[choix];
    }
    else link = choix_to_link[0];
    document.getElementById("choix_player1_preview").src = link;
}

function affiche_choix_adv(choix){
    if ([1, 2, 3].includes(choix)) {
        link = choix_to_link[choix];
    }
    else link = choix_to_link[0];
    document.getElementById("choix_player2_preview").src = link;
}

async function API_load() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=load");
    try{ const data = await rep.json();
        console.log(data);
    }
    catch(e) {
        console.log("echec");
        console.log(rep.text());
    }
    if(data["error"]){
        cptr_fail++;
        if(cptr_fail==3) location.reload();
        await API_load();
        return;
    }
    cptr_fail = 0;
    if(data["action"]==="red") handle_red(data);
    let date_temp = new Date(data["time"]["date"]);
    time = new Date(date_temp.getTime() + 25 * 1000);
    est_j1 = ! data["est_player2"];
    score = data["score"];
    startCountdown();
    handle_score();
    return;
}

async function API_choix(choix) {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=choix&choix="+choix);
    var data
    try{ data = await rep.json();
        console.log(data);
    }
    catch(e) {
        console.log("echec");
        console.log(rep.text());
    }
    if(data["error"]){
        cptr_fail++;
        if(cptr_fail==3) location.reload();
        API_choix(choix);
        return;
    }
    cptr_fail = 0;
    if(data["action"]==="red") handle_red(data);
    affiche_choix(choix);
    let date_temp = new Date(data["time"]["date"]);
    time = new Date(date_temp.getTime() + 25 * 1000);
    return;
}

async function API_choix_adv() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=choix_adv");
    try{ const data = await rep.json();
        console.log(data);
    }
    catch(e) {
        console.log("echec");
        console.log(rep.text());
    }
    if(data["error"]){
        cptr_fail++;
        if(cptr_fail==3) location.reload();
        API_choix_adv();
        return;
    }
    cptr_fail = 0;
    if(data["action"]==="red") handle_red(data);
    affiche_choix_adv(data["choix_adv"]);
    let date_temp = new Date(data["time"]["date"]);
    time = new Date(date_temp.getTime() + 25 * 1000);
    return;
}

async function API_cheatchoix() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=cheatchoix");
    try{ const data = await rep.json();
        console.log(data);
    }
    catch(e) {
        console.log("echec");
        console.log(rep.text());
    }
    return data;
}

async function API_cheatinfo() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=cheatinfo");
    try{ const data = await rep.json();
        console.log(data);
    }
    catch(e) {
        console.log("echec");
        console.log(rep.text());
    }
    return data;
}

async function API_cheatsus() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=cheatsus");
    try{ const data = await rep.json();
        console.log(data);
    }
    catch(e) {
        console.log("echec");
        console.log(rep.text());
    }
    return data;
}

action_to_handle_global = ["red", "error"]
lst_action_to_print = [ "load", "choix", "cheatchoix", "cheatinfo", "cheatsus"]
lst_action_to_handle = ["info", "time/err","time/err", "cheatinfo", "cheatsus"]

["rock_choice", "paper_choice", "scissors_choice"]
function handleClickChoix(event){
    switch (event.target.id) {
        case "rock_choice":
            API_choix(1);
            break;
        case "paper_choice":
            API_choix(2);
            break;
        case "scissors_choice":
            API_choix(3);
            break;
    }
}

function active_choix(){
    lst_bouton_choix.forEach(element => {
        document.getElementById(element).addEventListener("click", handleClickChoix);
    });
}

function disable_choix(){
    lst_bouton_choix.forEach(element => {
        document.getElementById(element).removeEventListener("click", handleClickChoix);
    });  
}

function startCountdown() {
    if (countdownInterval !== null) {
        clearInterval(countdownInterval);
    }
    countdownInterval = setInterval(() => {
      const currentDate = new Date();
      console.log(currentDate)
      console.log(time)
      let decompteur = Math.floor((currentDate - time)/1000);
      if (decompteur < 13) {
        active_choix()
        cheat=false;
        update_timer(13 - decompteur);
        API_load()
      }
      else if(decompteur < 20){
        if(cheat){
            update_timer(20 - decompteur);
            active_choix();
            API_load()
        }
        else{
            update_timer(25 - decompteur);
            disable_choix();
            API_load()
        }
      }
      else {
        API_choix_adv()
        disable_choix()
      }
    }, 1000);
}
API_load();