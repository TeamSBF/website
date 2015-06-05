<?php ob_start();?>
<textarea type="text" name="[[name]]" rows="[[rows]]" cols="[[cols]]" [[required]] placeholder="[[placeholder]]" style="[[style]]">[[content]]</textarea>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>