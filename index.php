<?php require_once __DIR__.DIRECTORY_SEPARATOR."Template.php";
session_start();
ob_start()?>

<div id=LogResult >
    <?php
    if (isset($_SESSION['error'])){
        ?><br> <br> <br> <br><?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    else if (isset($_SESSION['login'])):?>
        <p style="color:red"> <br><br><br><br><br> Authentification reussi<br>Mode Admin Active</p>
    <?php endif ?>
</div>
<?php

$content=ob_get_clean();
 Template::render($content)?>