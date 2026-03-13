<?php require_once __DIR__.DIRECTORY_SEPARATOR."Template.php";?>
<?php ob_start()?>
<p>
    test
</p>
<?php $content=ob_get_clean()?>
<?php Template::render($content)?>