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
            <?php include "index.html" ?>

            <div id="injected-content"> 
                <?php echo $content?>
            </div>


        </body>
        </html>

    <?php
    }

}