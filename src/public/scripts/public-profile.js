var data_compte={
  "identifiant" : "John Doe",
  "password" : "1234",
  "chemin_pfp"  : "./img/pfp/duh.png",
  "date_join" : "10/10/2025",
  "parties_w" : 223,
  "parties_l" : 192,
  }
  
  var identifiant = data_compte["identifiant"];
  var password = data_compte["password"];
  var chemin_pfp = data_compte["chemin_pfp"];
  var date_join = data_compte["date_join"];
  var parties_w = data_compte["parties_w"];
  var parties_l = data_compte["parties_l"];
  var parties_totales = parties_l + parties_w;


  // ---------- Gestion préremplissage stats ----------
  document.querySelector("#id_stats").innerHTML = identifiant;

  document.querySelector("#pp_stats").src = chemin_pfp;

  document.querySelector("#date_join").innerHTML = date_join;
  document.querySelector("#nb_parties").innerHTML = parties_totales;

  document.querySelector("#nb_victoires").innerHTML = parties_w;
  document.querySelector("#nb_défaites").innerHTML = parties_l;


  // ---------- Gestion changement page profile ----------


  const button_friends = document.querySelector("#friends_button");
  const button_stats = document.querySelector("#stats_button");


  button_friends.addEventListener("click",button_settings_event);
  button_stats.addEventListener("click",button_settings_event);

  function button_settings_event(){
      let bouton = this;
      let id_bouton = bouton.getAttribute('id');
      

      button_friends.classList.remove("bouton_courant");
      button_stats.classList.remove("bouton_courant");

      pages=document.querySelectorAll(".profile-page");
      console.log(id_bouton)
      console.log(pages)

      for (let i=0;i<pages.length;i++){
          pages[i].classList.add("hidden");
      }

      if (id_bouton === "friends_button"){
          pages[0].classList.remove("hidden");
      }else{
          pages[1].classList.remove("hidden");
      }

      bouton.classList.add("bouton_courant");
  }



  // ----------Gestion stats win/loose Profile----------

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

