<?php ob_start();?>
<li><a href="[[url]]">[[name]]</a></li>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>