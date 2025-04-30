var liste_choix_pfc = document.querySelectorAll(".bouton_pfc")
  
liste_choix_pfc.forEach(button => {
    button.addEventListener('click', choix_pfc);
});

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