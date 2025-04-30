document.addEventListener('DOMContentLoaded', () => {
  fetch('./API/profil/get.php')
    .then(res => res.json())
    .then(data => {
      console.log("Données reçues :", data);

      if (data.error) throw new Error(data.error);

     
      var identifiant = data.identifiant;
      var password = "";
      var chemin_pfp = data.chemin_pfp || "./img/pfp/default_pfp.jpg";
      var date_join = data.date_join;
      var parties_w = data.parties_w;
      var parties_l = data.parties_l;
      var parties_totales = parties_w + parties_l;


  // ---------- Gestion préremplissage form update profile ----------



  document.querySelector("#identifiant").value = identifiant;
  document.querySelector("#password").value = password;
  document.querySelector("#pp_preview_edit").src = chemin_pfp;

  // ---------- Gestion préremplissage stats ----------
  document.querySelector("#id_stats").innerHTML = identifiant;

  document.querySelector("#pp_stats").src = chemin_pfp;

  document.querySelector("#date_join").innerHTML = date_join;
  document.querySelector("#nb_parties").innerHTML = parties_totales;

  document.querySelector("#nb_victoires").innerHTML = parties_w;
  document.querySelector("#nb_défaites").innerHTML = parties_l;



  const victories = parseInt(document.getElementById('nb_victoires').textContent);
  const defeats = parseInt(document.getElementById('nb_défaites').textContent);
  const total = victories + defeats;

  let victoryPercent;
  let defeatPercent
  if (total) {
    victoryPercent = (victories / total) * 100;
    defeatPercent = 100 - victoryPercent;
  } else {
    victoryPercent = 0;
    defeatPercent = 0;
  }


  document.getElementById('victory_bar').style.width = `${victoryPercent}%`;
  document.getElementById('defeat_bar').style.width = `${defeatPercent}%`;

  victoryPercent = Math.round(victoryPercent);
  defeatPercent = Math.round(defeatPercent);

  document.getElementById('percent_w').innerHTML = `${victoryPercent}`;
  document.getElementById('percent_l').innerHTML = `${defeatPercent}`;

  setTimeout(() => {
    document.body.offsetHeight; // force le reflow
  }, 0);
  
   }) 
    .catch(err => {
      console.error("Erreur lors de la récupération des données du compte : ", err);
      alert("Erreur lors de la récupération des données du compte. Veuillez réessayer.");
    }); 
  }); 

    // ---------- Gestion changement page profile ----------

    const button_settings = document.querySelector("#settings_button");
    const button_friends = document.querySelector("#friends_button");
    const button_stats = document.querySelector("#stats_button");
  
    button_settings.addEventListener("click",button_settings_event);
    button_friends.addEventListener("click",button_settings_event);
    button_stats.addEventListener("click",button_settings_event);
  
    function button_settings_event(){
        let bouton = this;
        let id_bouton = bouton.getAttribute('id');
        
  
        button_settings.classList.remove("bouton_courant");
        button_friends.classList.remove("bouton_courant");
        button_stats.classList.remove("bouton_courant");
  
        pages=document.querySelectorAll(".profile-page");
        console.log(id_bouton)
        console.log(pages)
  
        for (let i=0;i<pages.length;i++){
            pages[i].classList.add("hidden");
        }
  
        if (id_bouton === "settings_button"){
            pages[0].classList.remove("hidden");
        }else if (id_bouton === "friends_button"){
            pages[1].classList.remove("hidden");
        }else{
            pages[2].classList.remove("hidden");
        }
  
        bouton.classList.add("bouton_courant");
    }


  
    // ---------- Gestion envoie form (pfp) ----------
  
    var input_import_pfp = document.querySelector("#imgInput");
  
    var container_import_pfp = document.querySelector("#edit_img_container");
  
    var liste_listener_importation_pfp = [document.querySelector("#edit_img_container img"),document.querySelector("#edit_img_container div")];
  
    liste_listener_importation_pfp.forEach(child => {
        child.addEventListener('click', () => {
            input_import_pfp.click();
        });
    });
  
    input_import_pfp.addEventListener('change',preview_pfp);
  
  
  
    function preview_pfp(){
      if (input_import_pfp.files.length > 0){
        const new_pfp = input_import_pfp.files[0];
  
        const url_pfp_temp = URL.createObjectURL(new_pfp);
  
        document.querySelector("#pp_preview_edit").src=url_pfp_temp;
        
      }
    }
  
    var bouton_update = document.querySelector(".submit_button")
  
    bouton_update.addEventListener('click',envoie_donnees);
  
    function envoie_donnees(){
      if (input_import_pfp.files.length > 0){
        let formData = new FormData();
        formData.append('image', input.files[0]);
  
        fetch('upload.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(result => {
            console.log('Image envoyée avec succès :', result);
          })
          .catch(error => {
            console.error('Erreur lors de l’envoi :', error);
          });
      }
  }