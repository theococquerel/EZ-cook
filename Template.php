<?php
class Template{
    public static function render(String $content) : void{?>

        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>EZ'cook</title>
            <link rel="stylesheet" href="main.css">
        </head>
        <body>
            <?php include __DIR__.DIRECTORY_SEPARATOR."header.php" ?>

            <div id="injected-content"> 
                <?php echo $content?>
            </div>
            <?php include __DIR__.DIRECTORY_SEPARATOR."footer.php" ?>


        </body>
        <script src="main.js" defer></script>
        
        </html>
    <?php
    }
}