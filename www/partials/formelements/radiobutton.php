<?php ob_start();?>
<label><input type="radio" class="[[classes]]" name="[[name]]" value="[[value]]" id="[[id]]" [[checked]] [[required]] />[[text]]</label>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>