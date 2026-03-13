<?php
class Template
{

    public static function render(string $content) : void{?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>test</title>
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