<?php ob_start();?>
<ul>[[items]]</ul>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>