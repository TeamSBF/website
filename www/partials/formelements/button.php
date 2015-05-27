<?php ob_start();?>
<button type="[[type]]" name="[[name]]" id="[[id]]">[[value]]</button>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>