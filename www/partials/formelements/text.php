<?php ob_start();?>
<label>[[content]]<input type="text" name="[[name]]" value="[[value]]" size="[[size]]" [[required]] placeholder="[[placeholder]]" /></label>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>