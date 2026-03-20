<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="pageTitle"></title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?php session_start();?>

<header id="mainHeader">
        <h1 id="mainTitle">EZ'Cook</h1>
        <?php if (!isset($_SESSION['login'])):?>
        <div id="formConnect">

            <div id="adminTitle">Connexion</div>
            <form method="post", id="formCo" action="login.php">

                <label>Identifiant</label>      
                <input id="login" type="text" name="login"><br>

                <label>Mot de passe</label>
                <input id="password" type="password" name="password"><br>

                <div id="logResult"></div>

                <button id="connection" type="submit">Se connecter</button>
                <button id="reset" type="reset">Reset</button>
            </form>

        </div>
        <?php else:?>
            <form action="logout.php">
                <button id="disconnect">Logout</button>
            </form>
        <?php endif;?>
    </header>
    <script src="main.js"></script>
</body>
</html>