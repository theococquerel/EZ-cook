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



            if (form){

            // récupération et vérification de la paire login/MDP
            form.addEventListener('submit', function(event){
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
                    result.style.color = "yellow";
                    result.innerText = "Identifiant ou mot de passe incorrect.";
                    } 
                })
        
            form.addEventListener('reset', function(){
                let result = document.getElementById("logResult");
                result.innerText = ""
            });
        }

           
                    

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