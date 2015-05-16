<?php ob_start();?>
<input type="hidden" name="[[name]]" value="[[value]]" />
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>