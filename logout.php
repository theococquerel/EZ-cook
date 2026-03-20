<?php require_once __DIR__.DIRECTORY_SEPARATOR."Template.php";

session_start();
session_destroy();
ob_start()?>
<h1>Vous etes deconnecte</h1>
<a href="index.php">Retour au debut</a>
<?php $content=ob_get_clean();
 Template::render($content)?>