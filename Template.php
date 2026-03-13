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
            <?php include "header.php" ?>

            <div id="injected-content"> 
                <?php echo $content?>
            </div>

            <?php include "footer.html" ?>

        </body>
        </html>

    <?php
    }

}