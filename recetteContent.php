<!-- page contenant la recette choisie -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Recette</title>
</head>
<body>
    <?php include "header.php" ?>
    <br><br><br><br><br>
    <button id="backPage">Retour accueil</button>
    <div id="recettePage">
        <h1 id="titre-recette"></h1>
        <br>
        <div id="img-recette"></div>
        <br>
        <h2>Ingrédients</h2>
        <div id="listIngred"></div>
        <br>
        <h2>Description</h2>
        <p id="recette-txt"></p>
    </div>

    <?php include "footer.php" ?>

    <script>

            document.addEventListener('DOMContentLoaded', function(){

                let params = new URLSearchParams(window.location.search);
                let id = params.get("id");

                fetch("rechercheRecette.php?id=" + id)
                    .then(res => res.json())
                    .then(recette => {
                        console.log(recette);
                        if(!recette || recette.error){
                            document.body.innerHTML = "<h1>Recette introuvable</h1>";
                            return;
                        }

                        document.getElementById("titre-recette").innerText = recette.titre;

                        document.getElementById("img-recette").innerHTML =
                            `<img src="${recette.photo}" style="width:500px">`;

                        // ingrédients 
                        let ingredients = recette.ingredients || [];

                        document.getElementById("listIngred").innerHTML = ingredients.join(", ");

                        document.getElementById("recette-txt").innerText = recette.description;
                    });

                document.getElementById("backPage").addEventListener('click', function(){
                    window.location.href = "index.php";
                });

            });


    </script>
</body>
</html>