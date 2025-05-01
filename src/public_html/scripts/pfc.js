var time;
var cheat=false;
var cptr_fail = 0;
var est_j1;
var score;
var countdownInterval = null;
var choix_adv = false;


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

function handle_red(data){
    window.location.href(data["red"]);
}

function affiche_choix(choix){
    if ([1, 2, 3].includes(choix)) {
        link = choix_to_link[choix];
    }
    else link = choix_to_link[0];
    document.getElementByIchoix_advd("choix_player1_preview").src = link;
}

function affiche_choix_adv(choix){
    if (["1", "2", "3"].includes(choix)) {
        link = choix_to_link[choix];
    }
    else link = choix_to_link[0];
    document.getElementById("choix_player2_preview").src = link;
}

async function API_load() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=load");
    try{ 
        const data = await rep.json();
        if(data["error"]){
            cptr_fail++;
            if(cptr_fail==3) location.reload();
            await API_load();
            return;
        }
        cptr_fail = 0;
        if(data["action"]==="red") handle_red(data);
        let date_temp = new Date(data["time"]["date"]);
        time = new Date(date_temp.getTime());
        est_j1 = ! data["est_player2"];
        score = data["score"];
        startCountdown();
        handle_score();
        return;
    }
    catch(e) {
        cptr_fail++;
        if(cptr_fail==3) location.reload();
        API_load();
        return;
    }

}

async function API_choix(choix) {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=choix&choix="+choix);
    try{ const data = await rep.json();
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
        time = new Date(date_temp.getTime());
        return;
    }
    catch(e) {
        cptr_fail++;
        if(cptr_fail==3) location.reload();
        API_choix(choix);
        return;
    }
    return;
}

async function API_choix_adv() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=choix_adv");
    try{ const data = await rep.json();
        if(data["error"]){
            cptr_fail++;
            if(cptr_fail==3) location.reload();
            API_choix_adv();
            return;
        }
        cptr_fail = 0;
        if(data["action"]==="red") handle_red(data);
        affiche_choix_adv(data["choix_adv"]);
        choix_adv = true;
        let date_temp = new Date(data["time"]["date"]);
        time = new Date(date_temp.getTime());
        return;
    }
    catch(e){
        cptr_fail++;
        if(cptr_fail==3) location.reload();
        API_choix_adv();
        return;
    }
    
}

async function API_cheatchoix() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=cheatchoix");
    try{ const data = await rep.json();
    }
    catch(e) {
        cptr_fail++;
        if(cptr_fail==3) location.reload();
        API_cheatchoix();
        return;
    }
}

async function API_cheatinfo() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=cheatinfo");
    try{ const data = await rep.json();
    }
    catch(e) {
    }
    return data;
}

async function API_cheatsus() {
    const rep = await fetch("../API/games/pfc.php?idPartie="+encodeURIComponent(idPartie)+"&token="+encodeURIComponent(token)+"&action=cheatsus");
    try{ const data = await rep.json();
    }
    catch(e) {
    }
    return data;
}

action_to_handle_global = ["red", "error"]
lst_action_to_print = [ "load", "choix", "cheatchoix", "cheatinfo", "cheatsus"]
lst_action_to_handle = ["info", "time/err","time/err", "cheatinfo", "cheatsus"]

["rock_choice", "paper_choice", "scissors_choice"]
function handleClickChoix(event){
    switch (event.target.alt) {
        case "rock":
            API_choix(1);
            break;
        case "paper":
            API_choix(2);
            break;
        case "scissors":
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

function reset_choix(){
    document.getElementById("choix_player1_preview").src = "../img/icons/interrogation.png";
    document.getElementById("choix_player2_preview").src = "../img/icons/interrogation.png";
}

function hide_cheat(){
    document.getElementById("bouton_tricher").classList.add("hidden");
}

function show_cheat(){
    document.getElementById("bouton_tricher").className = "";
}

function hide_den(){
    document.getElementById("bouton_den").classList.add("hidden");
}

function show_den(){
    document.getElementById("bouton_den").className = "";
}

function startCountdown() {
    if (countdownInterval !== null) {
        clearInterval(countdownInterval);
    }
    countdownInterval = setInterval(() => {
      const currentDate = new Date();
      let decompteur = Math.floor((currentDate - time)/1000);
      if (decompteur < 13) {
        choix_adv = false;
        if(decompteur==0 || decompteur==1 ){
            reset_choix();
        }
        hide_cheat();
        hide_den();
        console.log("étape 1");
        active_choix()
        cheat=false;
        update_timer(13 - decompteur);
        API_load()
      }
      else if(decompteur < 20){
        show_cheat();
        hide_den();
        console.log("étape 2");
        if(cheat){
            update_timer(20 - decompteur);
            active_choix();
            API_load()
        }
        else{
            
            update_timer(20 - decompteur);
            disable_choix();
            API_load();
        }
      }
      else if(decompteur < 25){
        hide_cheat();
        show_den();
        update_timer(25 - decompteur);
        console.log("étape 3");
        if(! choix_adv){
            API_choix_adv();
        }
        disable_choix()
      }
      else{
        choix_adv = false;
        API_load();
        reset_choix();
        hide_cheat();
        hide_den();
      }
    }, 1000);
}
API_load();