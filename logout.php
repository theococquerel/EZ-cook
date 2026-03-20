<?php require_once __DIR__.DIRECTORY_SEPARATOR."Template.php";

session_start();
session_destroy();
header("Location:index.php"); 
ob_start()?>
<br><br><br>
<h1>Vous etes deconnecte</h1>
<br><br><br>

<?php

$content=ob_get_clean();
 Template::render($content)
 ?>