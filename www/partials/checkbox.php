<?php ob_start();?>
<label><input type="checkbox" name="[[name]]" value="[[value]]" [[checked]] />[[text]]</label>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>