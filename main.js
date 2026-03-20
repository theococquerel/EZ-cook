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




            // récupération et vérification de la paire login/MDP
            form.addEventListener('submit', function(event){
                event.preventDefault();
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
                    if(form.login.value == "admin2026" && form.password.value == "projet3"){
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
                        }, 5000)

                        

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

           
                    

            // gestion de la barre de recherche
            let resButton = document.getElementById("resButton");
            let initialColor = resButton.style.color;
            let initialTextColor = resButton.innerText.style.color;

            resButton.addEventListener("mousemove", function(){
                this.style.background = "blue";
            })
            resButton.addEventListener("mouseout", function(){
                this.style.background = initialColor;
               // this.innerText.style.color = initialTextColor;
            })




        })