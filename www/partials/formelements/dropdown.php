<?php ob_start();?>
<select name="[[name]]">[[options]]</select>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>