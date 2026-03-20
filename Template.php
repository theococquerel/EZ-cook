<?php
class Template
{

    public static function render(String $content) : void{?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>EZ'cook</title>
        </head>
        <body>
            <?php include "header.php" ?>

            <div id="injected-content"> 
                <?php echo $content?>
            </div>
            <?php include "footer.php" ?>


        </body>
        </html>

    <?php
    }

}