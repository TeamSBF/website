<?php ob_start();?>
<input type="tel" name="[[name]]" value="[[value]]" size="[[size]]" [[required]] placeholder="[[placeholder]]" />
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>