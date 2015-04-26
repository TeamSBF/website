<?php ob_start(); ?>
    <div class="article">
        <div class="title"><h1>[-title-]</h1></div>
        [-?edit-]<div class="edit"><img src="img/gear.png" /></div>[-edit-]
        <div class="content">[-content-]</div>
    </div>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>