document.addEventListener('DOMContentLoaded', function(){
            // préparation de la page (mode visiteur)
            let modeAdministrateurActif = false;
            let pageTitle = document.getElementById("pageTitle");
            pageTitle.innerText = "EZ'Cook";

            let form = document.getElementById("formCo");

            // récupération du conteneur du formulaire d'authentification
            let connect = document.getElementById("formConnect");
            // sauvegarde du contenu d'origine
            let connectInit = connect.innerHTML;

            // liste des tags sélectionnés (vide au départ)
            let selectedTags = [];


            // récupération et vérification de la paire login/MDP
                if(form){
                    form.addEventListener('submit', function(event){
                    //event.preventDefault();
                    let result = document.getElementById("logResult");


                    if(form.login.value == ""){
                        event.preventDefault();
                        result.style.color = "yellow";
                        result.innerText = "L'identifiant ne peut pas être vide !";
                    } else if(form.password.value == ""){
                        event.preventDefault();
                        result.style.color = "yellow";
                        result.innerText = "Le mot de passe ne peut pas être vide !";
                    }
                    else{
                        if(form.login.valeur == "admin2026" && form.password.value == "projet3"){
                            result.style.color = "lightgreen";
                            pageTitle.innerText = "EZ'Cook (administrateur)";
                            result.innerText = "Connexion réussie : entrée en mode administrateur.";
                            window.setTimeout(function(){
                                result.innerText = "";
                                let admin = document.getElementById("adminTitle");
                                admin.innerText = "Mode administrateur";
                                modeAdministrateurActif = true;
                                form.password.value = "";
                                form.login.value = "";
                                connect.innerHTML = `
                                <div id="adminTitle">Mode administrateur</div><br>
                                <button id="disconnect">Se déconnecter</button>`;

                                // gestion du cas déconnexion
                                let disco = document.getElementById("disconnect");
                                disco.addEventListener('click', function(){
                                    connect.innerHTML = connectInit;
                                    modeAdministrateurActif = false;
                                    pageTitle.innerText = "EZ'Cook";
                                })
                            }, 3000)

                            
                        } else{
                            result.style.color = "yellow";
                            result.innerText = "Identifiant ou mot de passe incorrect.";
                        } 
                    }
                })

                form.addEventListener('reset', function(){
                    let result = document.getElementById("logResult");
                    result.innerText = ""
                })
            }
           
                    
            // gestion de la barre de recherche
                // gestion du bouton
            let resButton = document.getElementById("resButton");
            
            if(resButton){
                let initialColor = resButton.style.background;

                resButton.addEventListener("mousemove", function(){
                    this.style.background = "blue";
                })
                resButton.addEventListener("mouseout", function(){
                    this.style.background = initialColor;
                // this.innerText.style.color = initialTextColor;
                })
            }

                // gestion de la barre (version JS)
            function research(){

                let valeur = document.getElementById("research").value.trim();


                 fetch("search.php?q=" + encodeURIComponent(valeur ) + "&tags=" + selectedTags.join(","))
                    .then(response => response.json())
                    .then(data => {
                        afficher(data);
                    })
                    .catch(error => console.error("Erreur : ", error));
                    
            }

            document.getElementById("formRes").addEventListener("submit", function(e){
                e.preventDefault()
                research()
            })



            function afficher(liste){
                let container = document.getElementById("templateCook");
                container.innerHTML = "";

                liste.forEach((recette, index) => {
                    let tags = [];

                    try {
                        tags = JSON.parse(recette.listeTag);
                    } catch(e) {
                        tags = [];
                    }

                    container.innerHTML += `
                    <div class="recette" onclick="ouvrirRecette(${recette.id})">
                        <img src="${recette.photo}" alt="${recette.titre}">
                        <h3>${recette.titre}</h3>
                        <p>${tags.join(", ")}</p>
                    </div>`;
                });
            }   


            


            // structuration de l'affichage
            let container = document.getElementById("templateCook")

            if(container){
                container.style.display = "grid"
                container.style.gridTemplateColumns = "repeat(3, 1fr)"
                container.style.gap = "20px"
                container.style.padding = "20px"

                document.getElementById("research").addEventListener("input", research)
                
                research();
            }
            // ouverture d'une recette
            window.ouvrirRecette = function(id){
                window.location.href = "recetteContent.php?id=" + id
            }



            // tags
            
            let tagsContainer = document.getElementById("tags");
            
            if(tagsContainer){
                fetch("get_tags.php?t=" + Date.now())
                .then(response => response.json())
                .then(data => {
                    let tagsContainer = document.getElementById("tags");

                    data.forEach(tag => {
                        tagsContainer.innerHTML += `
                            <button class="tag-btn" data-tag="${tag.nomTag}">
                                ${tag.nomTag}
                            </button>
                        `;
                    });

                    // ajouter les events après création
                    document.querySelectorAll(".tag-btn").forEach(btn => {
                        // quand on coche un tag en cliquant dessus
                        btn.addEventListener('click', function(){
                            let tag = this.dataset.tag;

                            if(selectedTags.includes(tag)){
                                selectedTags = selectedTags.filter(t => t !== tag);
                                this.style.background = "";
                            } else {
                                selectedTags.push(tag);
                                this.style.background = "yellow";
                            }

                            research();
                        });
                    });

                })
                .catch(error => console.error("Erreur tags :", error));
            }      
                /*document.querySelectorAll(".tag-btn").forEach(btn => {
                            // quand on coche un tag en cliquant dessus
                            btn.addEventListener('click', function(){
                                let tag = this.dataset.tag;

                                // ajout/suppression
                                if(selectedTags.includes(tag)){
                                    selectedTags = selectedTags.filter(t => t !== tag);
                                    this.style.background = "";
                                } else {
                                    selectedTags.push(tag);
                                    this.style.background = "yellow";
                                
                                }
                                research();
                            })    

                        })*/
                    
        })
